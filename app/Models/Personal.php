<?php

namespace App\Models;

use Faker\Provider\ar_EG\Person;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Personal extends Model
{
    use HasFactory;
    protected $timestamp = false;


    // store personal details
    public static function storePersonalDetails ($post)
    {
        try {
            $isCitEmployee = 'N';
            if(isset($post['iscitemployee'])){
                $isCitEmployee = 'Y';
            }
            $personalDetailsArray = [
                'userid' => $post['userid'],
                'nfirstname' => $post['nfirstname'],
                'nmiddlename' => $post['nmiddlename'],
                'nlastname' => $post['nlastname'],
                'efirstname' => $post['efirstname'],
                'emiddlename' => $post['emiddlename'],
                'elastname' => $post['elastname'],
                'dateofbirthbs' => $post['dateofbirthbs'],
                'dateofbirthad' => $post['dateofbirthad'],
                'gender' => $post['gender'],
                'fatherfirstname' => $post['fatherfirstname'],
                'fathermiddlename' => $post['fathermiddlename'],
                'fatherlastname' => $post['fatherlastname'],
                'motherfirstname' => $post['motherfirstname'],
                'mothermiddlename' => $post['mothermiddlename'],
                'motherlastname' => $post['motherlastname'],
                'grandfatherfirstname' => $post['grandfatherfirstname'],
                'grandfathermiddlename' => $post['grandfathermiddlename'],
                'grandfatherlastname' => $post['grandfatherlastname'],
                'citizenshipnumber' => $post['citizenshipnumber'],
                'citizenshipissuedistrictid' => $post['citizenshipissuedistrictid'],
                'citizenshipissuedate' => $post['citizenshipissuedate'],
                'iscitemployee' => $isCitEmployee,
                'postedby' => $post['userid'],
                'posteddatetime' => date('Y-m-d H:i:s')
            ];

            DB::beginTransaction();
            $personalid = $post['personaldetailid'];

            if (empty($post['personaldetailid'])) {
                $result = DB::table('personals')->insertGetId($personalDetailsArray);
                $personalid = $result;

                $isUpdated = DB::table('users')->where('id', $post['userid'])->update(['personalid' => $personalid]);

                if (!$isUpdated) {
                    throw new Exception ('Something went wrong.Please, try again.', 1);
                }
            } else {
                $result = DB::table('personals')->where('id', $post['personaldetailid'])->update($personalDetailsArray);
            }
            $response = [
                "success" => true,
                "id" => $personalid
            ];
           
            session()->put('personalid', $personalid);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            $response = [
                "success" => true,
                "id" => $e->getMessage()
            ];
        }
        return $response;
    }


    public function documents()
    {
    }
    public function otherdetails()
    {
    }
    public function contactdetails()
    {
    }
    public function qulifications()
    {
    }


    // get previous data
    public static function previousAllData ($post)
    {
        try {
            $result = DB::table('personals')->where('userid', $post['userid'])->first();
            return $result;

        } catch (Exception $e) {
            throw $e;
        }
    }
}