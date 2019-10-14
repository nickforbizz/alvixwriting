<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class KloveController extends Controller
{



    public function index(Request $request,$toString=null)
    {
        $data[] = $this->getKloveCommands('mysql');

        if ($toString==null){
            return $data;
        }else{
            $seperator="\n";
            switch ($toString){
                case "web": $seperator="<br>  ";break;
                case "text": $seperator="\n  ";break;

            }

            return collect($data)->map(function ($item) use ($seperator){
            return collect($item)->implode($seperator);

            })->flatten()->implode($seperator);
        }
    }
    public function getKloveCommands($connection){
        $tables = DB::connection($connection)->select('SHOW TABLES');
        $tables = array_map('current',$tables);


        if($connection=="mysql")
            $folder="Models";
        else
            $folder="Models\\".title_case($connection);

        foreach ($tables as $table) {
            $classname=studly_case(str_singular($table));
            $table_name=$table;
            $command="php artisan krlove:generate:model $classname --output-path=$folder --namespace=App\\$folder --table-name=$table_name --connection=$connection";
//            $command="truncate $table_name;";
//            $command="ALTER TABLE `$table_name` ADD COLUMN `deleted_at` DATETIME NULL AFTER `updated_at`;";
            $data[]=$command;
        }

        return $data;
    }
}
