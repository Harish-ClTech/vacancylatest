<?php

namespace App\Models;

use App\Mail\EmployeeProvidentFund;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{DB, Mail};
use Exception;

class Payment extends Model
{
    use HasFactory;


    // store payment details
    public static function StorePaymentDetails ($post)
    {
        try {
            $userid = !empty($post['appliedby'])?$post['appliedby']:auth()->user()->id;
            $paymentDetailsArray = [
                'userid' => $userid,
                'personalid' => session()->get('personalid'),
                'vacancyname' => $post['response']['productname'],
                'vacancynumber' => $post['response']['prodcutid'],
                'transactionid' => $post['response']['idx'],
                'token' => $post['response']['token'],
                '_token' => $post['response']['_token'],
                'amount' => ($post['response']['amount']/100),
                'paymenttype' => 'Khalti',
                'date' => date('Y-m-d H:i:s'),
                'postedby' => $userid,
                'posteddatetime' => date('Y-m-d H:i:s')
            ];

            $result = false;
            if (!empty($paymentDetailsArray)) {
                $result = DB::table('transcations')->insert($paymentDetailsArray);
            }
            return $result;

        } catch (Exception $e) {
            throw $e;
        }
    }


    // store applyJob details
    public static function storeApplyJobDetails ($post)
    {
        try {
            $userid = !empty($post['appliedby'])?$post['appliedby']:auth()->user()->id;

            $insertArrayApplyJobs = [
                'userid' => $userid, 
                'receipnumber' => $post['idx'], //Khalti/ESEWA/CONNECTIPS Token Number
                'paymentsource' => $post['paymentsource'], // Khalti/ESEWA/CONNECTIPS
                'applieddatebs' => date('Y-m-d H:i:s'),
                'applieddatead' => date('Y-m-d H:i:s'),
                'applyamount' => $post['response']['totalsum'],
                'postedby' => $userid,
                'posteddatetime' => date('Y-m-d H:i:s')
            ];

            DB::beginTransaction();
            $result = DB::table('apply_jobs')->insertGetId($insertArrayApplyJobs);
            $vacnyNums = [];
            if(!empty($post['vacancyid'])) {
                foreach ($post['vacancyid'] as $vacancyid) {
                    $vacancy = Vacancy::where('id',$vacancyid)->first();
                    $insertArrayApplyDetails[] = [
                        'applymasterid'=>$result,// Apply Jobs Id 
                        'jobpostid'=>$vacancyid,// Vacancy ID
                        'postedby' =>$userid,
                        'posteddatetime' =>date('Y-m-d H:i:s')
                    ];
                    $vacnyNums[] = $vacancy->vacancynumber;
                }
            } else {
                foreach ($post['response']['appliedVacancyNo'] as $vaccancyno) {
                    $vacancy = Vacancy::where('vacancynumber',$vaccancyno)->first();
                    $insertArrayApplyDetails[] = [
                        'applymasterid'=>$result,// Apply Jobs Id 
                        'jobpostid'=>$vacancy->id, // Vacancy ID
                        'vacancnumber' =>$vaccancyno,
                        'vacancyrate'=>$vacancy->vacancyrate,
                        'postedby' =>$userid,
                        'posteddatetime' =>date('Y-m-d H:i:s')
                    ];
                    $vacnyNums[] = $vacancy->vacancynumber;
                }
            }

            $vacnynumbers = '';
            if (!empty($vacnyNums)) {
                $vacnynumbers = implode(", ", $vacnyNums);
            }


            // if(\Auth::user()->id==4){
            //     // echo $request->callback;
            //     echo \Auth::user()->id;
            //     dd($post);
            // }
 

            $response2 = DB::table('apply_jobs')->where(['id'=>$result,'userid'=>$userid])->update(['registrationnumber' => $result]);
            $response1 = DB::table('applydetails')->insert($insertArrayApplyDetails);
            $response3 = DB::table('users')->where(['id'=>$userid])->update(['is_submitted' => '1']);
   
            $post['message']="The payment of RS ".$post['response']['totalsum']." for the vacancy number [".$vacnynumbers."] has been received and your registration number is ".$result.". Please keep visiting your account (https://vacancy.nlk.org.np) for further update on application status.";
            $post['thankyou']="Thank you";


      
            DB::commit();
            if(!empty($post['appliedby'])){
                $email = User::where(['id'=>$post['appliedby']])->first();
            }else{
                $email = auth()->user()->email;
            }
            Mail::to($email)->send(new EmployeeProvidentFund($post));
            // if(\Auth::user()->id==4){
            //     // echo $request->callback;
            //     echo \Auth::user()->id;
            //     dd($post);
            // }
            return true;

        } catch (Exception $e){
            DB::rollback();
            throw $e;
        }
    }


    // get eSewa-ConnectIPS details
    public static function getEsewaConnectipsDetails ($post) 
    {
        try {
            $cond = " WHERE 1=1 ";
            $get = $post;
            foreach ($get as $key => $value) {
                $get[$key] = trim(strtolower(htmlspecialchars($get[$key], ENT_QUOTES)));
            }

            $limit = 10;
            $offset = 0;
            if (!empty($get["iDisplayLength"])) {
                $limit = $get['iDisplayLength'];
                $offset = $get["iDisplayStart"];
            }
            $sorting = $get['sSortDir_0'] ? $get['sSortDir_0'] : 'desc';
            $orderby = "fullname " . $sorting . "";
    
            if ($get['iSortCol_0']) {
                if ($get['iSortCol_0'] == 1) {
                    $orderby = " fullname " . $sorting . "";
                }
            }
    
            if ($get['sSearch_1'])
                $cond .= " AND lower(td.fullname) like '%" . $get['sSearch_1'] . "%'";
    
            if ($get['sSearch_2'])
                $cond .= " AND lower(td.contactnumber) like '%" . $get['sSearch_2'] . "%'";
    
            if ($get['sSearch_3'])
                $cond .= " AND lower(td.transactioncode) like '%" . $get['sSearch_3'] . "%'";
    
            if ($get['sSearch_4'])
                $cond .= " AND lower(td.usedthrough) like '%" . $get['sSearch_4'] . "%'";
    
            if ($get['sSearch_5'])
                $cond .= " AND lower(td.amount) like '%" .$get['sSearch_5'] . "%'";
    
            if ($get['sSearch_6'])
                $cond .= " AND lower(td.purchasedatetime) like '%" . $get['sSearch_6'] . "%'";
    
            if ($get['sSearch_7'])
                $cond .= " AND lower(td.status) like '%" . $get['sSearch_7'] . "%'";
    
            if ($get['sSearch_8'])
                $cond .= " AND lower(td.referenceid) like '%" . $get['sSearch_8'] . "%'";
    
            $sql = "SELECT
                        COUNT(*) OVER () AS totalrecs,
                        td.* 
                    FROM
                        (
                        SELECT
                            tec.id,
                            tec.userid,
                            tec.vacancyid,
                            CONCAT_WS( ' ', firstname, middlename, lastname ) AS fullname,
                            p.contactnumber,
                            transactionid,
                            transactioncode,
                            usedthrough,
                            amount,
                            purchasedatetime,
                            tec.status,
                            referenceid 
                        FROM
                            transactions AS tec
                            INNER JOIN PROFILES AS p ON p.userid = tec.userid 
                        ) AS td $cond
                        ORDER BY
                            td.id DESC ";

                        // echo $sql;exit;
            
            if ($limit > -1) {
                $sql = $sql . ' limit ' . $limit . ' offset ' . $offset . '';
            }

            $result = DB::select($sql);
            $ndata = $result;
            $ndata['totalrecs'] = @$result[0]->totalrecs ? $result[0]->totalrecs : 0;
            $ndata['totalfilteredrecs'] = @$result[0]->totalrecs ? $result[0]->totalrecs : 0;
            return $ndata;

        } catch (Exception $e) {
            throw $e;
        }
    }


    // get Khalti details
    public static function getKhaltiDetails ($post) 
    {
        try {
            $cond = " WHERE 1=1 ";
            $limit = 10;
            $offset = 0;
            $get = $_GET;
            foreach ($get as $key => $value) {
                $get[$key] = trim(strtolower(htmlspecialchars($get[$key], ENT_QUOTES)));
            }
            if (!empty($_GET["iDisplayLength"])) {
                $limit = $_GET['iDisplayLength'];
                $offset = $_GET["iDisplayStart"];
            }
            $sorting = $get['sSortDir_0'] ? $get['sSortDir_0'] : 'desc';
            $orderby = "fullname " . $sorting . "";
        
            if ($get['iSortCol_0']) {
                if ($get['iSortCol_0'] == 1) {
                    $orderby = " fullname " . $sorting . "";
                }
            }
        
            if ($get['sSearch_1'])
                $cond .= " AND lower(td.fullname) like '%" . $get['sSearch_1'] . "%'";
        
            if ($get['sSearch_2'])
                $cond .= " AND lower(td.contactnumber) like '%" . $get['sSearch_2'] . "%'";
        
            if ($get['sSearch_3'])
                $cond .= " AND lower(td.transactionid) like '%" . $get['sSearch_3'] . "%'";
        
            if ($get['sSearch_4'])
                $cond .= " AND lower(td.amount) like '%" . $get['sSearch_4'] . "%'";
        
            if ($get['sSearch_5'])
                $cond .= " AND lower(td.posteddatetime) like '%" . $get['sSearch_5'] . "%'";
        
            if ($get['sSearch_6'])
                $cond .= " AND lower(td.status) like '%" . $get['sSearch_6'] . "%'";
        
            $sql = "SELECT 
                        COUNT(*) OVER() AS totalrecs,
                        td.* 
                    FROM (
                        SELECT CONCAT_WS(' ', firstname, middlename, lastname)
                        as fullname,
                            p.contactnumber,
                            transactionid,
                            amount,
                            posteddatetime,
                            tec.status
                        FROM  transcations as tec
                            INNER JOIN  profiles as p
                            on p.userid = tec.userid ORDER BY tec.id DESC) as td ".$cond;
            
            if ($limit > -1) {
                $sql = $sql . ' limit ' . $limit . ' offset ' . $offset . '';
            }
            $result = DB::select($sql);
            $ndata = $result;
            $ndata['totalrecs'] = @$result[0]->totalrecs ? $result[0]->totalrecs : 0;
            $ndata['totalfilteredrecs'] = @$result[0]->totalrecs ? $result[0]->totalrecs : 0;
            return $ndata;

        } catch (Exception $e) {
           throw $e; 
        }
    }
}