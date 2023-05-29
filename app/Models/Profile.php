<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Profile extends Model
{
    use HasFactory;
    public $timestamps = false;

    public static function storeProfileData($post)
    {
        try {
            $insertArray = [
                'firstname' => $post['firstname'],
                'middlename' => $post['middlename'],
                'lastname' => $post['lastname'],
                'email' => $post['email'],
                'contactnumber' => $post['contactnumber'],
                'permanentaddress' => $post['permanentaddress'],
                'currentaddress' => $post['currentaddress'],
                'gender' => $post['gender'],
                'designationid' => $post['designationid'],
                'image' => $post['image']
            ];

            $result = DB::table('profiles')->where('userid', $post['userid'])->update($insertArray);
            return $result;
        } catch (Exception $e) {
        }
    }

    public static function updatePasswordDatas($post)
    {
        try {
            $old_password = User::where('id', auth()->user()->id)->first();
            $current_password = $post['currentpassword'];
            if (Hash::check($current_password, $old_password->password)) {
                $new_pwd = bcrypt($post['confirmpassword']);
                DB::table('users')->where('id', auth()->user()->id)->update(['password' => $new_pwd]);
            } else {
                throw new Exception("Old Password does not match with our database");
            }
            return true;
        } catch (Exception $e) {
        }
    }
}
