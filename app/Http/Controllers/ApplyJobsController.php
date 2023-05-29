<?php

namespace App\Http\Controllers;

use App\Models\ApplyJobs;
use App\Models\Payment;
use App\Models\Vacancy;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplyJobsController extends Controller
{

    function __construct()
    {
        
        $ipsCredMaster = [
            'dev' => ['merchantid' => 151, 'appid' => 'CIT-151-EXM-13', 'appname' => 'CIT Exam Fee Collection', 'privatekey' => 'CREDITOR.pfx', 'privatekeypassword' => '123', 'username' => 'CIT-151-EXM-13', 'password' => 'Abcd@123', 'baseurl' => 'https://uat.connectips.com'],
            'live' => ['merchantid' => 151, 'appid' => 'CIT-151-EXM-13', 'appname' => 'CIT Recruitment', 'privatekey' => 'CITREC.pfx', 'privatekeypassword' => '765555', 'username' => 'CIT-151-EXM-13', 'password' => 'CIt345$23', 'baseurl' => 'https://login.connectips.com']
        ];        
        
        $this->ipsCred = $ipsCredMaster['live'];
        
        
       
        $esewaCredMaster = [
            'live' => ['appid' => 'NP-ES-CITRUST', 'payurl' => 'https://esewa.com.np/'], 
            'dev' => ['appid' => 'EPAYTEST', 'payurl' => 'https://uat.esewa.com.np/']
        ];
        $this->esewaCred = $esewaCredMaster['live'];
    }

    public function getjobdetails(Request $request)
        {

        $post = $request->all();
        
        $checkForEmployeeCond = " AND isinternalvacancy = 'N' ";
        if($post['ifjobforcitemployee'] == 1){
            $checkForEmployeeCond = " AND isinternalvacancy = 'Y' ";
        }

        $userid = auth()->user()->id;
        $sql  = "SELECT vdd.*, JB.jobpostid FROM 
        (SELECT
                        V.id,
                        V.vacancynumber,
                        V.level,
                        V.designation,
                        V.servicesgroup,
                        V.jobcategory,
                        V.vacancyrate,
                        V.numberofvacancy,
                        V.vacancypublishdate,
                        V.vacancyenddate,
                        V.extendeddate,
                        D.title,
                        S.servicegroupname,
                        J.name,
                        L.labelname,
                        D.id AS designationid,
                        S.id AS servicegroupid
                    FROM
                        vacancies AS V
                        JOIN designations AS D ON D.id = V.designation
                        JOIN servicegroups AS S ON S.id = V.servicesgroup
                        JOIN jobcategories AS J ON J.id = V.jobcategory 
                        JOIN levels AS L ON L.id = V.level 
                    WHERE
                        designation =  ".$post['designationid']."
                        AND servicesgroup = ".$post['servicesgroupid']." $checkForEmployeeCond
                        AND V.jobstatus = 'Active' AND V.status ='Y') as vdd 
                                        LEFT JOIN(
                                        SELECT jobpostid FROM apply_jobs as jb 
                                        INNER JOIN applydetails AS ad ON ad.applymasterid = jb.id
                                        WHERE jb.status = 'Y' and ad.status = 'Y' AND userid = ".$userid." AND jobpostid IN(SELECT id FROM vacancies WHERE designation =  ".$post['designationid']." AND servicesgroup = ".$post['servicesgroupid']." AND jobstatus = 'Active')) AS JB 
                                    ON JB.jobpostid = vdd.id";

        // echo $sql;
        // exit;
        $vacancy['data'] = DB::select($sql);

        // dd($vacancy);

        $sqld = " SELECT max(V.vacancyrate)  as maxval, min(V.vacancyrate) as minval FROM vacancies AS V JOIN designations AS D ON D.id = V.designation JOIN servicegroups AS S ON S.id = V.servicesgroup JOIN jobcategories AS J ON J.id = V.jobcategory JOIN levels AS L ON L.id = V.level WHERE designation = '".$post['designationid']."' AND servicesgroup = '".$post['servicesgroupid']."' AND jobstatus = 'Active'";

        $datamaxmin = DB::select($sqld);

        $maxVal = 0;
        $minVal = 0;

        if(!empty($datamaxmin)){
            if($datamaxmin[0]->maxval < $datamaxmin[0]->minval){
                $maxVal = $datamaxmin[0]->minval;
                $minVal = $datamaxmin[0]->maxval;
            }else{
                $maxVal = $datamaxmin[0]->maxval;
                $minVal = $datamaxmin[0]->minval;
            }
        }

        $currentDate = date('Y-m-d');
        $vacancyEndDate = $vacancy['data'][0]->vacancyenddate;
        $vacancyEndDateAD = \BsDate::nep_to_eng($vacancyEndDate);
        
        if($vacancyEndDateAD < $currentDate){
            $low = $minVal*2;
            $high = $maxVal*2;
        } else {
            $low = $minVal;
            $high = $maxVal;
        }
        $vacancy['low']= $low;
        $vacancy['high']= $high;
        // dd($vacancy);

        $result = DB::table('profiles')->select('firstname','middlename','lastname')->where('userid',auth()->user()->id)->first();
        $data=[
            'productId'=> auth()->user()->id .'-'. $result->firstname .' '.$result->middlename.' '.$result->lastname .' CIT-Vacancy .',
            'vacancy' => $vacancy
        ];

        $data['esewa'] = $this->esewaCred;
        $data['connectIps'] = $this->ipsCred;
        $data['currentDate'] = $currentDate;
        $data['vacancyEndDateAD'] = $vacancyEndDateAD;

        return view('admin.pages.applyjobs.jobdetails',$data);
    }

    public function storeApplyJobsDetails(Request $request){
        try{
            $post=$request->all();
            $type='success';
            $message='Apply Jobs Saved To Database';
            DB::beginTransaction();
            $response=Payment::storeApplyJobDetails($post);
            // // json_decode($post['appliedJobdetails'],true);
            // return $response;
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            $response=false;
            $type='errro';
            $message=$e->getMessage();

        } 
        echo json_encode(array('type'=>$type,'message'=>$message,'response'=>$response));

    }

    public function getappliedusers(Request $request) {
        try {
            $post = $request->all();
            $status = 'success';
            $message = 'User has applied jobs.';
            $user = ApplyJobs::where('userid', $post['userid'])->first();
            if (!$user) {
                throw new Exception('User has not applied any jobs.', 1);
            }
        } catch (Exception $e) {
            $status = 'error';
            $message = $e->getMessage();
        }
    }


    public function verifyEsewa(Request $request)
    {
        try {
            // DB::beginTransaction();
            if($request->is_reconcile==true){
                $post['transactionid'] = $request->transactioncode;
                $post['amount'] = $request->amount;
                $post['appliedby'] = $request->appliedby;

                $result =  $this->checkEsewaTransacton($post);
                // dd($result);
                if($result->status == 'COMPLETE'){
                    $txncode = $result->pid;
                    $refId = $result->refId;
                    $response = 'Success';
                    $transaction = Transaction::where('transactioncode', $txncode)->first();

                }else if($result->status == 'NOT_FOUND'){
                    return redirect()->back()->withError('Sorry, No transaction found in Esewa.');
                }else if($result->status == 'FAILED'){
                    return redirect()->back()->withError('Sorry, the transaction is failed.');
                }
            }else{
                if ($request->callback == 'failed')
                    throw new Exception("Payment could not be processed", 1);
            

                $txncode = $request->oid;
                $refId = $request->refId;
                $amount = $request->amt;
                
                $transaction = Transaction::where('transactioncode', $txncode)->first();
                
                if (!$transaction)
                    throw new Exception("Invalid transaction", 1);
                if ($transaction->status != 'P')
                    throw new Exception("Transaction has been processed already", 1);
                if ($amount != $transaction->amount)
                    throw new Exception("Transaction amount does not match", 1);


                $url = $this->esewaCred['payurl'] . "epay/transrec";
                $data = [
                    'amt' => $transaction->amount,
                    'rid' => $refId,
                    'pid' => $txncode,
                    'scd' => $this->esewaCred['appid']
                ];

                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($curl);
                curl_close($curl);
                $xml = simplexml_load_string($result);
                $response = trim((string) $xml->response_code);
            }

            // $response = 'Success';
            if ($response=='Success') {
                $type = 'success';
                $message = 'Purchase successfull.';

                $thisTransactionVacancyArray = explode(',', $transaction->vacancyid); //vacancy ids converted to array (current)
                if(!empty($post['appliedby'])){
                    $applicationTransaction = Transaction::where(['userid'=>$post['appliedby'], 'status'=>'Y'])->get();
                    if(!empty($applicationTransaction)){
                        foreach($applicationTransaction as $value){
                            $appliedVacancyArray = explode(",", $value->vacancyid); //vacancy ids converted to array (already found in transaction table)
                            $diff = array_diff($thisTransactionVacancyArray, $appliedVacancyArray);
                            if (empty($diff)) {
                                Transaction::where('transactioncode', $txncode)->update(['status' => 'C', 'referenceid' => $refId, 'purchasedatetime' => date('Y-m-d H:i:s')]);
                                return redirect()->back()->withError('Sorry, already applied for this vacancy.');
                            }
                        }
                    }
                }
                Transaction::where('transactioncode', $txncode)->update(['status' => 'Y', 'referenceid' => $refId, 'purchasedatetime' => date('Y-m-d H:i:s')]);
                
                $appliedVacancyNo = Vacancy::whereIn('id', $thisTransactionVacancyArray)->get()->pluck('vacancynumber')->toArray();;
                // $post = ['_token' => $refId, 'response' => ['totalsum' =>$transaction->amount, 'designationId' => $transaction->designationid, 'appliedVacancyNo' => $appliedVacancyNo]];
                $post['_token'] = $refId;
                $post['response'] = ['totalsum' =>$transaction->amount, 'designationId' => $transaction->designationid, 'appliedVacancyNo' => $appliedVacancyNo];
                $post['paymentsource'] = 'Esewa';
                $post['idx']  = $refId;

        
                $response = Payment::storeApplyJobDetails($post);

    

                if ($response)
                    return redirect('successmessage');

            } else {
                $transaction->update(['status' => 'F']);
                throw new Exception("Payment could not be processed", 1);
            }
            // DB::commit();
        } catch (Exception $e) {
            // DB::rollback();
            $type = 'error';
            $message = $e->getMessage();
            $response = false;
            return redirect('errormessage');
        }
        return $this->displaySuccessMessage(); //echo json_encode(array('type' => $type, 'message' => $message, 'response' => $response));
    }    


    // Create transaction code and initiate purchase
    function initiatePurchase(Request $request)
    {
        try {
            // DB::beginTransaction();
            $type = 'success';
            $message = 'Purchase initiated.';
            $txncode = 'CITREC-' . strtoupper(\Str::random(9));
            $userid = \Auth::user()->id;
            // dd($request->vacancyid);
            if(empty($request->vacancyid))
                throw new Exception("Please select vacancy.", 1);    

            $vacancy = Vacancy::whereIn('id', $request->vacancyid)->get();
            if (!$vacancy)
                throw new Exception("Vacancy not found", 1);

	        $amount = $request->finalamount;

            if(\Auth::user()->id==4){
                $amount = 10;
            }
       
            $transactionarr = [ 
                'userid' => $userid, 
                'transactionid' => '80100-'.auth()->user()->id, 
                'transactioncode' => $txncode, 
                'status' => 'P', 
                'usedthrough' => $request->usedthrough, 
                'amount' =>$amount, 
                'vacancyid' => implode(',', $request->vacancyid), 
                'ipaddress' => $request->ip(), 
                'created_at' => date('Y-m-d H:i'), 
                'designationid' => $request->designationid
            ];
            
            $response = Transaction::create($transactionarr);
            if (@$request->returnTransaction)
                return $response;


            // DB::commit();
        } catch (Exception $e) {
            // DB::rollback();
            $type = 'error';
            $message = $e->getMessage();
            $response = false;
        }
        echo json_encode(array('type' => $type, 'message' => $message, 'response' => $response));
    }    

    function initiateIps(Request $request)
    {
        // ($transaction->amount * 100)
        try {
            DB::beginTransaction();
            $type = 'success';
            $message = 'Purchase initiated.';
            if(empty($request->vacancyid))
                throw new Exception("Please select vacancy.", 1); 

            $result =DB::table('profiles')->select('firstname','lastname', 'middlename')->where('userid',auth()->user()->id)->first();
            $request->returnTransaction = true;
            $transaction = $this->initiatePurchase($request);

            $transaction->particulars = auth()->user()->id .'-'. $result->firstname .' '.$result->middlename .' '.$result->lastname .' CIT Vacancy.';
            $transaction->remarks = '80100-'.auth()->user()->id.'-'.$result->firstname .' '.$result->middlename .' '.$result->lastname;
            $data = ['merchantid' => $this->ipsCred['merchantid'], 'appid' => $this->ipsCred['appid'], 'appname' => $this->ipsCred['appname'], 'txnid' => $transaction->transactioncode, 'txndate' => date('d-m-Y', strtotime($transaction->created_at)), 'txncrncy' => 'NPR', 'txnamt' => (($transaction->amount * 100)), 'REFERENCEID' => $transaction->transactioncode, 'remarks' => $transaction->remarks, 'particulars' => $transaction->particulars, 'token' => 'TOKEN'];
            $tokenmessage = '';
            foreach ($data as $key => $d) {
                $tokenmessage .= strtoupper($key) . '=' . $d . ',';
            }
            $tokenmessage = trim($tokenmessage, ',');
            $token = $this->generateIpsToken($tokenmessage);
            $data['token'] = $token;
        
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            $type = 'error';
            $message = $e->getMessage();
            $response = false;
            $data['token'] = false;
        }

        echo json_encode(array('type' => $type, 'message' => $message, 'response' => $data));
    }
    
    function generateIpsToken($tokenmessage = null)
    {
        // dd($tokenmessage);
        $key = file_get_contents($this->ipsCred['privatekey']);
        $certPassword = $this->ipsCred['privatekeypassword'];
        openssl_pkcs12_read($key, $certs, $certPassword);
        $private_key = $certs['pkey'];
        $binary_signature = "";
        $algo = "SHA256";
        openssl_sign($tokenmessage, $binary_signature, $private_key, $algo);
        return base64_encode($binary_signature);
    }

    function verifyConnectIps(Request $request)
    {
        try {
            $type = 'success';
            $message = 'Payment processed successfully';

            // DB::beginTransaction();

            $transaction = Transaction::where('transactioncode', $request->TXNID)->first();

            if (!$request)
                throw new Exception("Invalid transaction", 1);

            if ($transaction->status == 'Y')
                throw new Exception("Transaction has been processed already", 1);
            

            /** Validate ConnectIps transaction */
            // $transaction->amount * 100
            $verifyurl = $this->ipsCred['baseurl'] . "/connectipswebws/api/creditor/validatetxn";
            $tokenmessage = 'MERCHANTID=' . $this->ipsCred['merchantid'] . ',APPID=' . $this->ipsCred['appid'] . ',REFERENCEID=' . $request->TXNID . ',TXNAMT=' . $transaction->amount * 100;
            $token = $this->generateIpsToken($tokenmessage);
            $data = ["merchantId" => $this->ipsCred['merchantid'], 'appId' => $this->ipsCred['appid'], 'referenceId' => $request->TXNID, 'txnAmt' => $transaction->amount * 100, 'token' => $token];
            $postdata = json_encode($data);
            $jsonresult = $this->requestIpsCurl($verifyurl, $postdata);
            $result = json_decode($jsonresult);
            // dd($request->all(), $result);
            if (!empty($result->status)){
                if($result->status == "SUCCESS") {
                    // echo 'echo test a';
                    /**  Get ConnectIps transaction details and update transactionid in table */
                    $verifyurl = $this->ipsCred['baseurl'] . "/connectipswebws/api/creditor/gettxndetail";
                    $transactionJson = $this->requestIpsCurl($verifyurl, $postdata);
                    $ipsTransaction = json_decode($transactionJson);

                    
                    $transaction->update(['status' => 'Y', 'referenceid' => $ipsTransaction->txnId, 'purchasedatetime' => date('Y-m-d H:i:s.u')]);

                    /**  Store job applied details */
                    // $transaction->amount
                    
                    $appliedVacancyNo = Vacancy::whereIn('id', explode(',', $transaction->vacancyid))->get()->pluck('vacancynumber')->toArray();
                    $post = ['_token' => $ipsTransaction->txnId, 'response' => ['totalsum' => $transaction->amount, 'designationId' => $transaction->designationid, 'appliedVacancyNo' => $appliedVacancyNo]];

                    $post['paymentsource'] = 'ConnectIPS';
                    $post['idx']  = $ipsTransaction->txnId;
                    $post['appliedby'] = !empty($request->appliedby)?$request->appliedby:'';

                    $response = Payment::storeApplyJobDetails($post);
                    
                    $type = 'success';
                    $response = true;
                    if ($response)
                        return redirect('successmessage'); //$message = 'Successfully completed your transection.'; //return redirect('dashboard');
                }else {
                    if(!empty($request->is_reconcile) && $request->is_reconcile==true){
                        if($result->status == "ERROR") {
                            $transaction->update(['status' => 'F']);
                            return redirect()->back()->withError($result->statusDesc);
                        }else if($result->status == "FAILED") {
                            $transaction->update(['status' => 'F']);
                            return redirect()->back()->withError($result->statusDesc);
                        }
                    }else{
                        $transaction->update(['status' => 'F']);
                        throw new Exception("Payment could not be processed", 1);
                    }
                }
            } else {
                $transaction->update(['status' => 'F']);
                throw new Exception("Payment could not be processed", 1);
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
            return redirect('errormessage');
        }

        return redirect('errormessage');
    }

    function requestIpsCurl($verifyurl, $postdata)
    {
        $curl = curl_init($verifyurl);

        // print_r($curl);

        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($curl, CURLOPT_USERPWD, $this->ipsCred['username'] . ":" . $this->ipsCred['password']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $jsonresult = curl_exec($curl);
        $information = curl_getinfo($curl);
        // dd($information);
        curl_close($curl);

        // dd($jsonresult);
        return $jsonresult;
    }

    function displaySuccessMessage(Request $request){
        return view('message.success');
    }

    function displayErrorMessage(Request $request){
        return view('message.error');
    } 

    function vacancyCriteriaValidator(Request $request, $id)
    {
        $reqestedCriteria = DB::table('vacancies')
            ->where('id', $id)->first()->jobcategory;
        $criterialname = DB::table('jobcategories')->where('id', $reqestedCriteria)->first()->name;
        $response = [
            'success' => true,
            'message' => 'You are not eligible for ' . $criterialname
        ];
        $response['message'] = 'You are not eligible for ' . $criterialname;

        if ($criterialname == 'महिला') {
            if ((DB::table('personals')->where('userid', auth()->user()->id)->first()->gender) != "Female") {
                $response['success'] = false;
            }
        }
        $documents=DB::table('documents')
        ->where('personalid', auth()->user()->personalid)
        ->where('userid', auth()->user()->id)
        ->first();
        if ($criterialname == 'आदिवासीजनजाती') {
            if (empty(($documents->inclusiongroupcertificateadibashi)) && empty($documents->inclusiongroupcertificatejanajati)) {
                    $response['success'] = false;
            }
        }
        if ($criterialname == 'मधेशी') {
            if (empty($documents->inclusiongroupcertificatemadesi)) {
                $response['success'] = false;
            }
        }
        if ($criterialname == 'पिछिडिएकाक्षेत्र') {
            if (empty($documents->inclusiongroupcertificatepixadiyeko)) {
                $response['success'] = false;
            }
        }
        if ($criterialname == 'दलित') {
            if (empty($documents->inclusiongroupcertificatedalit)) {
                $response['success'] = false;
            }
        }
        if ($criterialname == 'अपाङ्ग') {
            if (empty($documents->disabilitydocument)) {
                $response['success'] = false;
            }
        }
        if($response['success']){
            $response['message'] = 'You are eligible for ' . $criterialname;
        }

        return $response;

	}

    

    // function to check esewa transaction is completed or not (payment reconcile)
    function checkEsewaTransacton($post)
    {
        $curl = curl_init();
        $pid = $post['transactionid'];
        $totalAmount = $post['amount'];
        $scd = $this->esewaCred['appid'];
        $urldata = "pid=".$pid."&totalAmount=".$totalAmount."&scd=".$scd."";
        $url =  "https://esewa.com.np/api/epay/txn_status/v2?".$urldata;

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Cookie: 
                    f5avraaaaaaaaaaaaaaaa_session_=GCGJAANKAGPDJOHNPFOCFLHKBALLPHEBFIMOKACJKLIOAPBKEBJAHKLBENFFHHCMLEODBNCBBDIJIOGCCAJAFCNGJIHEBNCDDGENHGHBBPABOBAJHOGOIBANPFDGNFPF; 
                    BIGipServerprod-user-pool=1440615690.36895.0000; 
                    TS01ecd5f8=01fe04f52767c74541c8838f171d7b33be2e7346ffd5135c2245569667632da02b0f7f53bb18f0f32b54813e5e7a1820518c0bdfd60de875d330fb8a4a646bce9972b631b1759294d583a7b09cf03f5b2238d171e1'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        return $response;
    }
   
}
