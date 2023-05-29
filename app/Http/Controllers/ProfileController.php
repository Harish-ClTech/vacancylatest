<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        $userid = Auth::user()->id;
        $profiles = DB::table('profiles as p')->join('users as u', 'u.id', '=', 'p.userid')
            ->selectRaw("p.id as profileid,p.firstname,p.middlename ,p.lastname ,p.gender,p.image,p.email,p.contactnumber")
            ->where(['p.userid' => $userid, 'u.status' => 'Y', 'p.status' => 'Y'])->first();
        $data = [
            'profiles' => $profiles,
            'saveurl' => route('passwordUpdate'),

        ];
       
        return view('admin.profile.index', $data);
    }
   
   // Checking User Current Password
    public function chkUserPassword(Request $request)
    {
        $post = $request->all();
        $current_password = $post['current_password'];
        $user_id = Auth::guard('web')->user()->id;
        $check_password = User::where('id', $user_id)->first();
        if (Hash::check($current_password, $check_password->password)) {
            return "true";
            die;
        } else {
            return "false";
            die;
        }
    }

    // Updating Password
    public function passwordUpdate(Request $request)
    {
        try {
            $post = $request->all();
            $type = 'success';
            $message = 'Password Updated Successfully';
            $response = Profile::updatePasswordDatas($post);
        } catch (Exception $e) {
            $type = 'error';
            $message = $e->getMessage();
            $response = false;
        }
        echo json_encode(['type' => $type, 'message' => $message]);
    }

    public function clientPasswordUpdate(Request $request)
    {
        $post=$request->all();
        $data = [
            'saveurl' => route('passwordUpdate'),
        ]; 
        return view('admin.pages.changepassword', $data);
    }
}
