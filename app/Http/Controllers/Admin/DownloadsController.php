<?php

namespace App\Http\Controllers\Admin;


use App\Models\WriterMediaFilesAssg;
use App\Models\MediaFilesAssg;
use Illuminate\Http\Request;
use App\Models\Onreviewassignment;
use App\Http\Controllers\Controller;

class DownloadsController extends Controller
{

    protected   $file_path;
    protected   $file_ext;


    /**
     * @param $file
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($id)
    {

        /** @var MediaFilesAssg $assignment_file */
        $assignment_file = MediaFilesAssg::where('id', $id)->first();

        $file_name = $assignment_file->media_link;
        $name = $assignment_file->name;

        $this->file_path = storage_path('app/'.$file_name);
        return response()->download($this->file_path, $name);
    }

    function downloadable($file){
        /** @var MediaFilesAssg $assignment_file */
        $assignment_file = MediaFilesAssg::where('assg_id', $file)->get();
        $data= [];
        foreach ($assignment_file as $fileItem){

            array_push($data, ['id'=>$fileItem->id, 'name'=>$fileItem->name]);
        }
        return [
            'code' => 1,
            'data' => $data
        ];
    }

    public function previewDoc($file)
    {
        $assignment = Onreviewassignment::find($file);
        $file_name = $assignment->OnprogressAssignment->Assignment->image_link;
        $this->file_path = storage_path('app/'.$file_name);

        $name = $assignment->OnprogressAssignment->Assignment->title;
        $this->file_ext = \File::extension($file_name);

        return
            response()
            ->file($this->file_path, $name.'.'.$this->file_ext,
                [
                    'Content-Type' => 'application/octet-stream'
                ]);
    }
}
