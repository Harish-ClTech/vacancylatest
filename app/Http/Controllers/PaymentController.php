<?php

namespace App\Http\Controllers;

use App\Models\{Payment, Common};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Exception;
use Validator;

class PaymentController extends Controller
{
    protected $type;
    protected $message;
    protected $response;
    protected $queryExceptionMessage;


    // constructor
    public function __construct ()
    {
        $this->type = 'success';
        $this->message = 'भुक्तानी सफल भयो ।';
        $this->response = false;
        $this->queryExceptionMessage = 'केही गडबड भयो। कृपया फेरि प्रयास गर्नुहोस् ।';
    }


    // show Khalti main page
    public function paymentKhalti ()
    {
        return view('admin.payment.index');
    }


    // verify Khalti payment
    public function VerifyKhaltiPayment (Request $request)
    {
        try {
            $post = $request->all();
    
            $args = http_build_query(array(
                'token' => $post['token'],
                'amount' => $post['amount'],
            ));
    
            $url = "https://khalti.com/api/v2/payment/verify/";
    
            # Make the call using API.
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
            $keys = config('app.khalti_secret_key');
            $headers = ['Authorization: Key ' . $keys . ''];
            // $headers = ['Authorization: Key test_secret_key_97db055019bb457a93a27a4b60cddd60'];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
            // Response
            $response = curl_exec($ch);
            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
        } catch (Exception $e) {
            $post = [];
        }
        return  $post;
    }


    // store payment details
    public function StorePayment (Request $request)
    {
        try {
            $post = $request->all();
            DB::beginTransaction();
            $result = Payment::StorePaymentDetails($post);
            if (!$result) {
                throw new Exception("डेटा बचत गर्न सकिएन। कृपया पुन: प्रयास गर्नुहोस् ।", 1);
            }
            $this->response = true;
            DB::commit();

        } catch (QueryException $e) {
            DB::rollback();
            $this->type = 'error';
            $this->message = $this->queryExceptionMessage;
        } catch (Exception $e) {
            DB::rollback();
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }


    // show eSewa main page
	public function esewaIpsDetails () 
    {
        if(session()->get('roleid') != 1) {
            return redirect()->route('login'); 
        } else {
            return view('admin.payment.esewaconnectips');
        }
    }


    // get eSewa transaction details in datatable
    public function getEsewaConnectipsDetails (Request $request) 
    {
        try {
            if(session()->get('roleid') != 1){
                return redirect()->route('login'); 
            }
    
            $post = $request->all();
            $data = Payment::getEsewaConnectipsDetails($post);
            $i = 0;
            $array = array();
            $filtereddata = (@$data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : @$data["totalrecs"]);
            $totalrecs = @$data["totalrecs"];
    
            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            foreach ($data as $row) {
                $array[$i]["sn"] = $i + 1;
                $array[$i]["fullname"] = $row->fullname;
                $array[$i]["contactnumber"] = $row->contactnumber;
                $array[$i]["transactioncode"] = $row->transactioncode;
                $array[$i]["usedthrough"] = $row->usedthrough;
                $array[$i]["amount"] = $row->amount;
                $puchaseDate = '-';
                if(!empty($row->purchasedatetime)){
                    $puchaseDate = date('Y-m-d H:i', strtotime($row->purchasedatetime));
                }
                $array[$i]["purchasedatetime"] = $puchaseDate;
                $array[$i]["status"] = $row->status;
                $refId = $row->referenceid;
                if(!empty($refId)){
                    $array[$i]["referenceid"] = $refId;
                }else{
                    $array[$i]["referenceid"] = '<a href="javascript:;" title="Reconcile Payment" class="btn btn-sm btn-danger reconcilePaymentBtn" data-usedthrough="'.$row->usedthrough.'" data-vacancyid="'.$row->vacancyid.'" data-transactionid="'.$row->transactionid.'" data-transactioncode="'.$row->transactioncode.'" data-amount="'.$row->amount.'" data-applicantid="'.$row->userid.'"><i class="fa fa-rotate-left">&nbsp;</i> Reconcile</a>';
                }
    
                $i++;
            }
            if (!$filtereddata) {
                $filtereddata = 0;
            }
            if (!$totalrecs) {
                $totalrecs = 0;
            }
        } catch (QueryException $e) {
            $array = [];
            $totalrecs = 0;
            $filtereddata = 0;
        } catch (Exception $e) {
            $array = [];
            $totalrecs = 0;
            $filtereddata = 0;
        }
        echo json_encode(array("recordsFiltered" => @$filtereddata, "recordsTotal" => @$totalrecs, "data" => $array));
        exit;
    }


    // show Khalti main page
    public function khaltiDetails () 
    {
        if(session()->get('roleid') != 1) {
            return redirect()->route('login'); 
        } else {
            return view('admin.payment.khalti');
        }
    }


    // get Khalti details in datatable
    public function getKhaltiDetails (Request $request) 
    {
        try {
            if(session()->get('roleid') != 1) {
                return redirect()->route('login'); 
            }
            $post = $request->all();
            $data = Payment::getKhaltiDetails($post);
            $i = 0;
            $array = array();
            $filtereddata = (@$data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : @$data["totalrecs"]);
            $totalrecs = @$data["totalrecs"];

            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            foreach ($data as $row) {
                $array[$i]["sn"] = $i + 1;
                $array[$i]["fullname"] = $row->fullname;
                $array[$i]["contactnumber"] = $row->contactnumber;
                $array[$i]["transactionid"] = $row->transactionid;
                $array[$i]["amount"] = $row->amount;
                $array[$i]["posteddatetime"] = $row->posteddatetime;
                $array[$i]["status"] = $row->status;

                $i++;
            }
            if (!$filtereddata) {
                $filtereddata = 0;
            }
            if (!$totalrecs) {
                $totalrecs = 0;
            }
        } catch (QueryException $e) {
            $array = [];
            $totalrecs = 0;
            $filtereddata = 0;
        } catch (Exception $e) {
            $array = [];
            $totalrecs = 0;
            $filtereddata = 0;
        }
        echo json_encode(array("recordsFiltered" => @$filtereddata, "recordsTotal" => @$totalrecs, "data" => $array));
        exit;
    }
}