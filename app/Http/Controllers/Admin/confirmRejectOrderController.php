<?php

namespace App\Http\Controllers\Admin;

use App\Models\Assignment;
use App\Models\RejectedAssg;
use App\Models\WriterRating;
use Illuminate\Http\Request;
use App\Events\OrderApprovalEvent;

use App\Models\AssgPendingPayment;
use App\Models\Onreviewassignment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Onprogressassignment;
use App\Models\Onrevisionassignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class confirmRejectOrderController extends Controller
{


    /**
     * @param Request $request
     * @param $id
     * @param $writer_id
     * @return array|string
     */
    public function confirmOrder(Request $request, $id, $writer_id)
    {
        try {
            DB::beginTransaction();
            $validate = Validator::make($request->all(), [
                'review_id' => $id,
                'user_id' => $writer_id
            ], [
                'review_id' => 'required|exists:onreviewassignment,id',
                'user_id' => 'required|exists:writers,id'
                ]);
                
            if ($validate->fails()) {
                return ([
                    'code' => -1,
                    'errs' => $validate->errors()
                    ]);
                }
                
            $review = Onreviewassignment::find($id);
            $assg_id = $review->onprogressassignment->assignment->id;
            
            /** @var AssgPendingPayment $pending_pay */
            $pending_pay = new AssgPendingPayment([
                'writer_id' => $writer_id,
                'review_id' => $id,
                'assg_id' => $assg_id
                
                ]);
                    
            $pending_pay->save();
                    
                    
            $check_id = $pending_pay->onreviewassignment->onprogressassignment->assignment->id;

            /** @var WriterRating $rating */
            $rating = new WriterRating([
                'writer_id' => $writer_id,
                'assg_id' => $check_id,
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);

            $rating->save();


            /** @var WriterRating $cc */
            $cc = WriterRating::where('assg_id', $check_id)
                    ->where('writer_id', $writer_id)
                    ->exists();

            if ($cc){
                $cd = WriterRating::where('assg_id',$check_id)
                        ->first();
                if ($cd->count == 0){
                    $cd->update([
                        'count'=>2,
                        'warn'=>0
                    ]);
                } elseif ($cd->count == -1){
                    $cd->update([
                        'count'=>1,
                        'warn'=>1
                    ]);
                }
               $cd->save();
            }else{
                return "User or Assignment Not Found";
            }

            $underReview = Onreviewassignment::find($id);
            $underReview->update([
                'active'=>0
            ]);
            $underReview->save();

            // variables to send to event
            $order_event =  $underReview->onprogressassignment->assignment->first();

            $writer_event = $underReview->writer->first();

            $admin_event = $underReview->onprogressassignment->assignment->admin->first();

            event(new OrderApprovalEvent($writer_event, $order_event , $admin_event, 'confirmed'));

            DB::commit();
            return [
                "code" => 1,
                "status" => "success",
                "data" => $pending_pay
            ];
        }catch(\Exeption $e) {
//            DB::rollback();
            report($e);
            return [
                "code" => 0,
                "status" => "failed",
                "data" => $e->getMessage()
            ];

        }
    }

    /**
     * @param Request $request
     * @param $id
     * @param $writer_id
     * @return array
     */
    public function rejectOrder(Request $request){
        try {
            DB::beginTransaction();
            $validate = Validator::make($request->all(), [
                'review_id' =>  'required|exists:onreviewassignment,id',
                'writer_id' =>  'required|exists:writers,id',
                'reason_revised' => 'required'
            ]);

            if ($validate->fails()) {
                return ([
                    'code' => -1,
                    'errs' => $validate->errors()
                ]);
            }


            /** @var Onrevisionassignment $itsRevision */
            $itsRevision = new Onrevisionassignment([
                'writer_id' => $request->writer_id,
                'admin_id' => Auth::guard('admin')->user()->id,
                'review_id' => $request->review_id,
                'reason_revised' => $request->reason_revised

            ]);
            
            $itsRevision->save();

            $check_id = $itsRevision->onreviewassignment->onprogressassignment->assignment->id;


            /** @var WriterRating $cc */
            $cc = WriterRating::where('assg_id', $check_id)
                ->where('writer_id', $request->writer_id)
                ->exists();
            if ($cc){
                $cd = WriterRating::where('assg_id',$check_id)
                    ->first();
                if ($cd->count == 0){
                    $cd->update([
                        'count'=>-1,
                        'warn'=>1
                    ]);
                } elseif ($cd->count == -1){
                    $cd->update([
                        'count'=>-2,
                        'warn'=>2
                    ]);
                }
            }else{
                /** @var WriterRating $rating */
                $rating = new WriterRating([
                    'user_id' => $request->writer_id,
                    'assg_id' => $check_id,
                ]);

            }

            $underReview = Onreviewassignment::find($request->review_id)->update([
                'active'=>0,
                'status'=>0
            ]);

            // variables to send to event
            $review_event = Onreviewassignment::find($request->review_id);
            $order_event =  $review_event->onprogressassignment->assignment->first();

            $writer_event = $review_event->writer->first();

            $admin_event = $review_event->onprogressassignment->assignment->admin->first();


            event(new OrderApprovalEvent($writer_event, $order_event , $admin_event, 'rejected'));

            DB::commit(); 
            return [
                "code" => 1,
                "status" => "success",
                "data" => $itsRevision
            ];
        }catch(\Exeption $e) {
//            DB::rollback();
            report($e);
            return [
                "code" => 0,
                "status" => "failed",
                "data" => $e->getMessage()
            ];

        }
    }
}

