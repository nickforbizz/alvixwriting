<?php

namespace App\Http\Controllers\Admin;


use App\Models\Role;
use App\Models\User;
use App\Models\Admin;
use App\Models\Category;
use App\Models\PaperType;
use App\Models\Assignment;
use App\Models\OrderFormat;
use Illuminate\Http\Request;
use App\Models\MediaFileAssg;
use App\Models\OrderLanguage;
use App\Models\MediaFilesAssg;
use App\Models\ReviewRevision;
use App\Notifications\NewOrder;
use App\Models\AdminMediaProfile;
use App\Models\AssgPendingPayment;
use Illuminate\Support\Facades\DB;
use App\Models\Completedassignment;
use App\Models\ReasignedAssignment;
use App\Http\Controllers\Controller;
use App\Models\Onrevisionassignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\TestNotification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DashboardGetDataController extends Controller
{
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return array
     */
    public  function  getUser($id){
        $user = \App\Models\User::find($id);
        return ([
            "code" => 1,
            "status" => "success",
            "data" => $user
        ]);
    }

    /**
     * @param $id
     * @return array
     */
    public  function getAdmin($id){
        $admin = \App\Models\Admin::find($id);
        return ([
            "code" => 1,
            "status" => "success",
            "data" => $admin
        ]);
    }

    /**
     * @param $id
     * @return array
     */
    public  function getRole($id){
        $role = \App\Models\Role::find($id);
        return ([
            "code" => 1,
            "status" => "success",
            "data" => $role
        ]);
    }

    /**
     * @param $id
     * @return array
     */
    public  function delRole($id){
        try {
            DB::beginTransaction();
            $rolenDetails = Role::find($id);

            $rolenDetails->status = 0;
            $rolenDetails->update();
            DB::commit();
            return ([
                "code" => 1,
                "status" => "success",
                "data" => $rolenDetails
            ]);
        } catch (\Exeption $e) {
            DB::rollback();
            report($e);
            return ([
                "code" => -1,
                "status" => "failed",
                "data" => $e->getMessage()
            ]);

        }



    }

    /**
     * @param Request $request
     * @return array
     */
    public function editRole(Request $request)
    {
        try {
            DB::beginTransaction();
            $validate = Validator::make($request->all(), [
                'role_id'=> 'required|exists:roles,id',
                'name' => 'required|string|max:255',
                'description' => 'required|string',

            ]);
            if ($validate->fails()) {
                return ([
                    'code'=> -1,
                    'errs'=>$validate->errors()
                ]);
            }

            $roleDetails = Role::find($request->role_id);

            $roleDetails->name = $request->name;
            $roleDetails->description = $request->description;



            $roleDetails->update();

            $roleDetails->save();
            DB::commit();
            return [
                "code" => 1,
                "status" => "success",
                "data" => $roleDetails
            ];
        } catch (\Exeption $e) {
            DB::rollback();
            report($e);
            return [
                "code" => 0,
                "status" => "failed",
                "data" => $e->getMessage()
            ];

        }
    }


    /**
     * Undocumented function
     *
     * @param Request $request
     * @return array
     */
    public function addRole(Request $request)
    {
        try {
            DB::beginTransaction();
            $validate = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:roles',
                'description' => 'required|string',
            ]);
            if ($validate->fails()) {
                return ([
                    'code'=> -1,
                    'errs'=>$validate->errors()
                ]);
            }

            $role = new Role([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            $role->save();
            DB::commit();
            return [
                "code" => 1,
                "status" => "success",
                "data" => $role
            ];
        } catch (\Exeption $e) {
            DB::rollback();
            report($e);
            return [
                "code" => 0,
                "status" => "failed",
                "data" => $e->getMessage()
            ];

        }
    }





    /**
     * @param $id
     * @return array
     */
    public  function getCategories($id){
        $category = \App\Models\Category::find($id);
        return ([
            "code" => 1,
            "status" => "success",
            "data" => $category
        ]);
    }

    /**
     * @param $id
     * @return array
     */
    public  function delCategories($id){
        try {
            DB::beginTransaction();
            $categoryDetails = Category::find($id);

            $categoryDetails->status = 0;
            $categoryDetails->active = 0;
            $categoryDetails->update();
            DB::commit();
            return ([
                "code" => 1,
                "status" => "success",
                "data" => $categoryDetails
            ]);
        } catch (\Exeption $e) {
            DB::rollback();
            report($e);
            return ([
                "code" => -1,
                "status" => "failed",
                "data" => $e->getMessage()
            ]);

        }



    }

    /**
     * @param Request $request
     * @return array
     */
    public function editCategories(Request $request)
    {
        try {
            DB::beginTransaction();
            $validate = Validator::make($request->all(), [
                'category_id'=> 'required|exists:categories,id',
                'name' => 'required|string|max:255',
                'description' => 'required|string',

            ]);
            if ($validate->fails()) {
                return ([
                    'code'=> -1,
                    'errs'=>$validate->errors()
                ]);
            }

            $categoryDetails = Category::find($request->category_id);

            $categoryDetails->name = $request->name;
            $categoryDetails->description = $request->description;



            $categoryDetails->update();

            $categoryDetails->save();
            DB::commit();
            return [
                "code" => 1,
                "status" => "success",
                "data" => $categoryDetails
            ];
        } catch (\Exeption $e) {
            DB::rollback();
            report($e);
            return [
                "code" => 0,
                "status" => "failed",
                "data" => $e->getMessage()
            ];

        }
    }


    /**
     * Undocumented function
     *
     * @param Request $request
     * @return array
     */
    public function addCategories(Request $request)
    {
        try {
            DB::beginTransaction();
            $validate = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:categories',
                'description' => 'required|string',
            ]);
            if ($validate->fails()) {
                return ([
                    'code'=> -1,
                    'errs'=>$validate->errors()
                ]);
            }

            $category = new Category([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            $category->save();
            DB::commit();
            return [
                "code" => 1,
                "status" => "success",
                "data" => $category
            ];
        } catch (\Exeption $e) {
            DB::rollback();
            report($e);
            return [
                "code" => 0,
                "status" => "failed",
                "data" => $e->getMessage()
            ];

        }
    }


    /**
     * Undocumented function
     *
     * @param Request $request
     * @return array
     */
    public function registerAdmin(Request $request)
    {
        try {
            DB::beginTransaction();
            $validate = Validator::make($request->all(), [
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:admins',
                'password' => 'required|string|min:6|confirmed',
                'mobile' => 'required',
                'national_id' => 'required',
                'username'=> 'required'
            ]);
            if ($validate->fails()) {
                return ([
                    'code'=> -1,
                    'errs'=>$validate->errors()
                ]);
            }

            $admin = new Admin([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'sname' => $request->sname,
                'email' => $request->email,
                'age' => $request->age,
                'gender' => $request->gender,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'mobile' => $request->mobile,
                'national_id' => $request->national_id,
                'username'=> $request->username
            ]);

            $admin->save();
            DB::commit();
            return [
                "code" => 1,
                "status" => "success",
                "data" => $admin
            ];
        } catch (\Exeption $e) {
            DB::rollback();
            report($e);
            return [
                "code" => 0,
                "status" => "failed",
                "data" => $e->getMessage()
            ];

        }
    }



    public function editUser(Request $request)
    {
        try {
            DB::beginTransaction();
            $validate = Validator::make($request->all(), [
                'user_id'=> 'required|exists:users,id',
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'mobile' => 'required',
                'national_id' => 'required',
                'username'=> 'required'
            ]);
            if ($validate->fails()) {
                return ([
                    'code'=> -1,
                    'errs'=>$validate->errors()
                ]);
            }

            $userDetails = User::find($request->user_id);

            $userDetails->national_id = $request->national_id;
            $userDetails->email = $request->email;
            $userDetails->username = $request->username;
            $userDetails->mobile = $request->mobile;
            $userDetails->fname = $request->fname;
            $userDetails->lname = $request->lname;
            $userDetails->mobile = $request->mobile;
            $userDetails->roles = $request->roles;


            $userDetails->update();

            $userDetails->save();
            DB::commit();
            return [
                "code" => 1,
                "status" => "success",
                "data" => $userDetails
            ];
        } catch (\Exeption $e) {
            DB::rollback();
            report($e);
            return [
                "code" => 0,
                "status" => "failed",
                "data" => $e->getMessage()
            ];

        }
    }

    public function editAdmin(Request $request)
    {
        try {
            DB::beginTransaction();
            $validate = Validator::make($request->all(), [
                'admin_id'=> 'required|exists:admins,id',
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'mobile' => 'required',
                'national_id' => 'required',
                'username'=> 'required'
            ]);
            if ($validate->fails()) {
                return ([
                    'code'=> -1,
                    'errs'=>$validate->errors()
                ]);
            }

            $adminDetails = Admin::find($request->admin_id);

            $adminDetails->national_id = $request->national_id;
            $adminDetails->email = $request->email;
            $adminDetails->username = $request->username;
            $adminDetails->mobile = $request->mobile;
            $adminDetails->fname = $request->fname;
            $adminDetails->lname = $request->lname;
            $adminDetails->mobile = $request->mobile;
            $adminDetails->roles = $request->roles;


            $adminDetails->update();

            $adminDetails->save();
            DB::commit();
            return [
                "code" => 1,
                "status" => "success",
                "data" => $adminDetails
            ];
        } catch (\Exeption $e) {
            DB::rollback();
            report($e);
            return [
                "code" => 0,
                "status" => "failed",
                "data" => $e->getMessage()
            ];

        }
    }



    /**
     * Undocumented function
     *
     * @param Request $request
     * @return array
     */
    public function createOrder(Request $request, User $user)
    {
        try {
            DB::beginTransaction();

            $validate = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'order_format_id' => 'required|exists:order_formats,id',
                'paper_type_id' => 'required|exists:paper_types,id',
                'lang_id' => 'required|exists:order_languages,id',
                'description' => 'required|string|min:1',
                'pages' => 'required',
                'deadline' => 'required',
                // 'docs' => 'required|array|min:1',
                // 'docs.*' => 'required|file',
            ]);

            
            if ($validate->fails()) {
                return ([
                    'code'=> -1,
                    'errs'=>$validate->errors()
                ]);
            }


            $words = (int)$request->pages * 273;

            /** @var Assignment $assg */
            $assg = new Assignment([
                'admin_id' => Auth::guard('admin')->user()->id,
                'words' => $words,
                'amount' => $request->amount,
                'title' => $request->title,
                'category_id' => $request->category_id,
                'order_format_id' => $request->order_format_id,
                'paper_type_id' => $request->paper_type_id,
                'lang_id' => $request->lang_id, 
                'description' => $request->description,
                'pages' => $request->pages,
                'deadline' => $request->deadline,
                'notes' => $request->notes,
                'instructions' => $request->instructions
                

            ]);
            

            // notify users
            
            // return ['docs'=>$request->file('docs')];
            
            $us_notify = \App\Models\Writer::all();
            foreach ($us_notify as $us) {
                $us->notify(new TestNotification());
            }
            
            // save the assg
            $assg->save();
            
            // Auth::guard('admin')->user()->notify(new TestNotification());

            if ($request->file('docs') != null) {
                // return ['docs' => $request->file('docs')];
                foreach ($request->file('docs') as $doc){
                    $assg->mediaFilesAssgs()->create([
                        'admin_id'=>Auth::guard('admin')->user()->id,
                        'assg_id'=>$assg->id,
                        'name'=>$doc->getClientOriginalName(),
                        'media_link'=>Storage::putFile('public/orders_docs', $doc),
                        'type'=>$doc->getClientOriginalExtension()
                    ]);
                } 
            }
            

            DB::commit();
            return [
                "code" => 1,
                "status" => "success",
            ];
        } catch (\Exeption $e) {
            DB::rollback();
            report($e);
            return [
                "code" => 0,
                "status" => "failed",
                "data" => $e->getMessage()
            ];

        }
    }

    public function updateAssg(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $validate = Validator::make($request->all(), [
                'deadline' => 'required',
                'docs' => 'required|array|min:1',
                'docs.*' => 'required|file',
            ]);
            if ($validate->fails()) {
                return ([
                    'code'=> -1,
                    'errs'=>$validate->errors()
                ]);
            }


            $words = (int)$request->pages * 273;

            /** @var Assignment $assg */
            $assg = Assignment::where('id', $id)->update([

                'pages' => $request->pages,
                'deadline' => $request->deadline,
                'amount' => $request->amount,
                'description' => $request->description,
            ]);
            
            // return $assg;

            foreach ($request->file('docs') as $doc){
                MediaFilesAssg::create([
                    'admin_id'=>Auth::guard('admin')->user()->id,
                    'assg_id'=>$id,
                    'name'=>$doc->getClientOriginalName(),
                    'media_link'=>Storage::putFile('public/writer_docs', $doc),
                    'type'=>$doc->getClientOriginalExtension()
                ]);
            }

            DB::commit();
            return [
                "code" => 1,
                "status" => "success",
                "data" => $assg
            ];
        } catch (\Exeption $e) {
            DB::rollback();
            report($e);
            return [
                "code" => 0,
                "status" => "failed",
                "data" => $e->getMessage()
            ];

        }
    }



    public function payOrder(Request $request){
        try{
            DB::beginTransaction();
            $validate = Validator::make($request->all(), [
                'order' => 'required|exists:assg_pending_payment,id',
            ]);
            if ($validate->fails()) {
                $errors = ([
                    'code'=> -1,
                    'errs'=>$validate->errors()
                ]);

                return $errors;
//
            }
            $completedAssg= new Completedassignment([
                'pending_pay_id' => $request->order,
            ]);
            $completedAssg->save();

            /** @var $pending_pay $pending_pay */
            $pending_pay = AssgPendingPayment::find($request->order);
            $pending_pay->update([
                'active' => 0
            ]);

            DB::commit();

            return [
                'code'=> 1,
                'data' =>$completedAssg
            ];

        }catch (\Exception $e){
            DB::rollBack();
            report($e);
            return [
                'code'=>-1,
                'data'=>$e->getMessage()
            ];
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return mixed
     */
    public function updateAdmin(Request $request, $id)
    {
        $updateUser = Admin::where('id', $id)->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'username' => $request->username,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'bio' => $request->bio
        ]);
        if($updateUser){
            return [
                'code' => 1,
                'msg' => 'Succesfully Updated'
            ];
        }else{
            return [
                'code' => -1,
                'msg' => 'Error while Updating'
            ];
        }
    }

    /**
     * @param Request $request
     * @return array|string
     */
    public function saveAdminImg(Request $request){

        $validate = Validator::make($request->all(), [

            'img_prf.*' => 'required|file',

        ]);
        if ($validate->fails()) {
            $errors = ([
                'code'=> -1,
                'errs'=>$validate->errors()
            ]);
            return $errors;
        }

        $doc = $request->img_prf;

        if (AdminMediaProfile::where('admin_id', Auth::guard('admin')->user()->id)->first() != null ){


            AdminMediaProfile::where('admin_id', Auth::guard('admin')->user()->id )
                ->where('status', 1)
                ->update([
                    'name' => $doc->getClientOriginalName(),
                    'media_link' => Storage::putFile('public/adminProfileImg', $doc),
                    'type' => $doc->getClientOriginalExtension()
                ]);


            return [
                    'code' => 1,
                    'message' => "profile updated"
                ];

        }else{
            AdminMediaProfile::create([
                'admin_id' => Auth::guard('admin')->user()->id,
                'name' => $doc->getClientOriginalName(),
                'media_link' => Storage::putFile('public/adminProfileImg', $doc),
                'type' => $doc->getClientOriginalExtension()
            ]);
            
            return [
                'code' => 1,
                'message' => "profile created"
            ];

        }

    }



    public function orderPrerequests(Request $request)
    {

        // return response()->json([$request->all()]);
        $validate = Validator::make($request->all(), [
            'id' => 'required|string',
            'name' => 'required|string',
        ]);

        if ($validate->fails()) {
            return [
                'code' => -1,
                'errors' => $validate->errors(),
            ];
        }

        if ($request->id == 'order_formats') {
            OrderFormat::create([
                'admin_id' => Auth::guard('admin')->user()->id,
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }elseif ($request->id == 'order_languages') {
            OrderLanguage::create([
                'admin_id' => Auth::guard('admin')->user()->id,
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }elseif ($request->id == 'paper_types') {
            PaperType::create([
                'admin_id' => Auth::guard('admin')->user()->id,
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }else{
            return [
                'code' => 0,
                'error' => 'somethig is not right'
            ];
        }
        return response()->json([
            'code' => 1
        ]);
    }

    public function reasignOrder(Request $request){

        try{
            DB::beginTransaction();

            if ($request->type == 'revisionreview') {

                ReviewRevision::where('id', (int) $request->reviewrevision_id)->update([
                    'toreasignment' => 1,
                    'active' => 0,
                    'status' => 0,
                ]);

                $reasign = ReasignedAssignment::create([
                    'reason' => $request->description,
                    'order_id' => $request->order_id,
                    'writer_id' => $request->writer_id,
                    ]);
                
                if ($reasign) {
                    
                    Assignment::where('id', (int)$request->order_id)
                       ->update([
                           'deadline' => $request->deadline,
                           'active' => 1,
                           'status' => 1,
                           'reasigned' => 1
                       ]);
                }

            }

            if ($request->type == 'progressreview') {
                # code...
            }

            DB::commit();
            return [
                'code' => 1,
                'message' => 'success'
            ];
        } Catch(\Exeption $e){
            report ($e);
            DB::rollback();

            return [
                'code' => -1,
                'message' => $e->getMessage()
            ];
        }
    }



}
//class ends











//{{--this website was made by Wainaina Nicholas Waruingi of Mombex Ent contact him through +254707722247 or email nickforbiz@gmail.com--}}