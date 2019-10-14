<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Writer;
use App\Models\Assignment;
use App\Models\OrderComment;
use Illuminate\Http\Request;
use App\Models\ReviewRevision;
use App\Models\Onreviewassignment;
use App\Models\WriterMediaProfile;
use App\Http\Controllers\Controller;
use App\Models\Onprogressassignment;
use App\Models\Onrevisionassignment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewAssgn()
    {
        return view('Admin.assg.viewAssg');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function underReview()
    {
        return view('Admin.assg.underReview');
        # code...
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function uploadAssg()
    {
        return view('Admin.assg.uploadAssg');
    }

    public function order($id)
    {

        // $assg_id = Onprogressassignment::find($id)->assg_id;
        $comments = OrderComment::where('active', 1)->where('order_id', $id)->latest()->limit(10)->get();

        $assg = Assignment::find($id);

        $profileadmin= 'adminProfileImg/default.png'; 
        $profilewriter= 'webProfileImg/default.png'; 
        $writer='';

        if(!empty(OrderComment::where('active', 1)
                    ->where('order_id', $assg->id)
                    ->first())){
            $writer_id = OrderComment::where('active', 1)
                        ->where('order_id', $assg->id)
                        ->first()->writer_id;
        }else{
            return view('admin.assg.order', compact('assg', 'comments', 'profileadmin', 'profilewriter', 'writer'));

        }

        $writer_id = OrderComment::where('active', 1)
                        ->where('order_id', $assg->id)
                        ->first()->writer_id;

        $writer = Writer::find($writer_id);

        $pf = "public/";
        $profileadmin = '';

        if(!empty(Auth::guard('admin')->user()->adminMediaProfiles->first())){
            $profileadmin = str_replace($pf, '', Auth::guard('admin')->user()->adminMediaProfiles()->first()->media_link);

        }else{
            $profileadmin= str_replace($pf, '','public/adminProfileImg/default.png'); 
        }

        $profilewriter = '';



        if(!empty(


            WriterMediaProfile::where('writer_id', $writer_id)
                            ->first()
            
            
            
            )){

            $profilewriter = str_replace($pf, '', 
                WriterMediaProfile::where('writer_id',$writer_id)
                    ->first()
                    ->media_link);

        }else{
            $profilewriter= str_replace($pf, '','public/writerProfileImg/default.png'); 
        }

        return view('admin.assg.order', compact('assg', 'comments', 'profileadmin', 'profilewriter', 'writer'));
    }


    public function addfiles($id)
    {

        // $assg_id = Onprogressassignment::find($id)->assg_id;

        $assg = Assignment::find($id);

        return view('admin.assg.addfiles', compact('assg'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function paidAssg()
     {
         return view('Admin.assg.paidAssg');
     }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function onProgress()
    {
        return view('Admin.assg.onProgress');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function onRevision()
    {

        $revisions = Onrevisionassignment::where('status', 1)->get();

        return view('Admin.assg.onRevision', compact('revisions'));
    }

    public function revisionReview()
    {

        $revisionreviews = ReviewRevision::where('status', 1)->get();
        return view('Admin.assg.revisionReview', compact('revisionreviews'));
    }


    public function orderReasign($type, $id)
    {

        $review_revision = 0;
        $review_progress = 0;
        $progress_order = Onprogressassignment::find($id);
        $order = Assignment::find($progress_order->assg_id);
        $writer = Writer::find($progress_order->writer_id);

        
        if ($type == 'revisionreview') {

            $review_revision = ReviewRevision::where('on_revision_assg_id' ,Onrevisionassignment::where('review_id',
                            Onreviewassignment::where('on_progress_assg_id', $id)->first()->id)
                            ->first()->id)
                        ->first()->id;

            return view('Admin.assg.orderReasign', compact('order', 'writer', 'type', 'review_revision', 'review_progress'));

        }

        if ($type == 'progressreview') {
            
            return $request->all();

        }
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewUsers()
     {
         $writers  = Writer::where('status', 1)->get();
         return view('Admin.users.viewUsers', compact('writers')); 
     }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editUsers()
    {
        return view('Admin.users.editUsers');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addAdmins()
    {
        return view('Admin.adminfiles.addAdmins');
    }

    //some return function to a page
    public function viewAdmins()
    {
        return view('Admin.adminfiles.viewAdmins');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editAdmins()
    {
        $admins = Admin::where('status', 1)->get();
        return view('Admin.adminfiles.editAdmins', compact('admins'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function roles()
    {
        return view('Admin.roles');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function categories()
    {
        return view('Admin.categories');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settings()
    {
        $pf = "public/";
        $profileadmin = '';

        if(!empty(Auth::guard('admin')->user()->adminMediaProfiles->first())){
            $profileadmin = str_replace($pf, '', Auth::guard('admin')->user()->adminMediaProfiles()->first()->media_link);

        }else{
            $profileadmin= str_replace($pf, '','public/adminProfileImg/default.png'); 
        }
        return view('Admin.settings', compact('profileadmin'));
    }
}
