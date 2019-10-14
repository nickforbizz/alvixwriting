<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApproveWritersController extends Controller
{
    public function viewWriters()
    {
        $writers_pending = User::where('active', 0)->get();

        return view('Admin.adminfiles.newWriters', compact('writers_pending'));
    }


    public function veiwWritersTest($id)
    {

        $writer = User::find($id);
        return view('Admin.adminfiles.writersTest', compact('writer'));
    }

}
