<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{
    use HasFactory;

    public static function StorePaymentDetails($post)
    {
        try {
            $paymentDetailsArray = [
                'userid' => auth()->user()->id,
                'personalid' => session()->get('personalid'),
                'vacancyname' => $post['response']['productname'],
                'vacancynumber' => $post['response']['prodcutid'],
                'transactionid' => $post['response']['idx'],
                'token' => $post['response']['token'],
                '_token' => $post['response']['_token'],
                'amount' => ($post['response']['amount']/100),
                'paymenttype' => 'Khalti',
                'date' => date('Y-m-d H:i:s'),
                'postedby' => auth()->user()->id,
                'posteddatetime' => date('Y-m-d H:i:s'),
            ];
            DB::beginTransaction();
            if (!empty($paymentDetailsArray)) {
                $result = DB::table('transcations')->insert($paymentDetailsArray);
            }
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public static function storeApplyJobDetails($post){
        try{
            DB::beginTransaction();
            $insertArrayApplyJobs=[
                'userid'=>auth()->user()->id,
                'registrationnumber'=>rand(111, 99999) ,// Unique Regis Number 
                'receipnumber'=>$post['_token'] ,// Khalti Token Number
                'applieddatebs' =>date('Y-m-d H:i:s'),
                'applieddatead' =>date('Y-m-d H:i:s'),
                'applyamount' =>$post['response']['totalsum'],
                'postedby' =>auth()->user()->id,
                'posteddatetime' =>date('Y-m-d H:i:s')
            ];


                $result = DB::table('apply_jobs')->insertGetId($insertArrayApplyJobs);
            foreach ($post['response']['appliedVacancyNo'] as $vaccancyno) {
                $insertArrayApplyDetails[]=[
                    'applymasterid'=>$result,// Apply Jobs Id 
                    'jobpostid'=>$post['response']['designationId'] ,// Designation ID
                    'vacancnumber' =>$vaccancyno,
                    'vacancyrate'=>Vacancy::where('vacancynumber',$vaccancyno)->first()->vacancyrate,
                    'postedby' =>auth()->user()->id,
                    'posteddatetime' =>date('Y-m-d H:i:s')
                ];
            }

            $result = DB::table('applydetails')->insert($insertArrayApplyDetails);

            DB::commit();
            return true;
        }catch(Exception $e){
            DB::rollback();
            throw $e;
        }
    }
}
