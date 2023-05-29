<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ApplyDetail, Common, SymbolNumber, SymbolNumberManage};
use Illuminate\Database\QueryException;
use Exception, Batch, DB;
use Illuminate\Support\Facades\Validator;

class SymbolNumberController extends Controller
{

    protected $type;
    protected $message;
    protected $response;
    protected $queryExceptionMessage;

    // constructor
    public function __construct()
    {
        $this->type = 'success';
        $this->message = '';
        $this->response = false;
        $this->queryExceptionMessage = 'तपाईको डाटामा समस्या भेटिएको छ । कृपया डाटालाई सच्याएर पुन: प्रयास गर्नुहोला ।';
    }

    
    // show main page 
    public function index ()
    {   
        try {
            $data = [];
            $data['fiscalyears'] = Common::getFiscalYears();

        } catch (QueryException $e) {
            $data = [];
        } catch (Exception $e) {
            $data = [];
        }
        return view ('admin.symbolnumber.index', $data);
    }

    
    // returns counts of Applicants with symbol number generated/ having no symbolnumber generated
    public function getApplicants (Request $request)
    {
        try {
            $this->message = 'Data fetched Successfully.';
            $rules = [
                'fiscalyearid' => 'required|integer',
                'levelid' => 'required|integer',
            ];
            $messages = [
                'fiscalyearid.required' => 'Please select fiscalyear',
                'levelid.required' => 'Please select level',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first(), 1);
            }
            $post = $request->all();
            // $post['isSymbolNumber'] = 'Y';
            // $applicantSymbol = SymbolNumber::getApplicants($post);  
            $applicants = SymbolNumber::getApplicants($post);  
            $applicantWithSymbol = [];
            $applicantWithOutSymbol = [];
            foreach($applicants as $applicant){
                if($applicant->symbolnumber == ''){
                    $applicantWithOutSymbol[] = $applicant;
                }else{
                    $applicantWithSymbol[] = $applicant;
                }
            }
            // dd($applicants, $applicantWithSymbol, $applicantWithOutSymbol);  
            // $post['isSymbolNumber'] = 'N';
            // $applicantNoSymbol = SymbolNumber::getApplicants($post);
            // dd($applicantNoSymbol, $applicantSymbol);
            $applicantsCount = 0;

            $array = [];

            // applicants with no symbol 
            $applicantWithNoSymbolCount = count($applicantWithOutSymbol);

            $array['applicantWithNoSymbolCount'] = $applicantWithNoSymbolCount; 
            if($applicantWithNoSymbolCount>=1){
                $array['designation'] = $applicantWithOutSymbol[0]->designationtitle;
            }

            //  applicants with symbol generated
            $applicantWithSymbolCount = count($applicantWithSymbol);
            if($applicantWithSymbolCount>=1){
                $array['applicantWithSymbolCount'] = $applicantWithSymbolCount; 
                $totalApplicants = $applicantWithSymbolCount+$applicantWithNoSymbolCount; 
                // if(!empty($post['showexamcenter'])){
                //     $colsix = '<th>परिक्षाकेन्द्र</th>';
                //     $dataColSix = $applicant->examcenter;
                // }else{
                //     $colsix = '<th>सिम्बोल नम्बर संख्या</th>';
                //     $dataColSix = $applicantWithSymbolCount;
                // }
                $table ='<table class="table-bordered table-striped table-condensed cf" id="examCenterTable" width="100%">
                    <thead class="cf">
                        <tr>
                            <th>क्र.सं. </th>
                            <th>आर्थिक बर्ष</th>
                            <th>पद</th>
                            <th>सुरुको सिम्बोल नम्बर </th>
                            <th>अन्तिम सिम्बोल नम्बर</th>
                            <th>सिम्बोल नम्बर संख्या</th>
                            <th>परिक्षार्थी संख्या</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>'.$applicantWithSymbol[0]->fiscalyearname.'</td>
                            <td>'.$applicantWithSymbol[0]->designationtitle.'</td>
                            <td>'.$applicantWithSymbol[0]->symbolnumber.'</td>
                            <td>'.$applicantWithSymbol[$applicantWithSymbolCount-1]->symbolnumber.'</td>
                            <td>'.$applicantWithSymbolCount.'</td>
                            <td>'.$totalApplicants.'</td>
                        </tr>
                    </tbody>
                </table>';
                $array['table'] = $table;
            }
            $this->response = $array;

        } catch (QueryException $e) {
            $this->type = 'error';
            $this->message = $this->queryExceptionMessage;
        } catch(Exception $e){
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }


    // generate symbol numbers
    public function generateSymbolNumber (Request $request)
    {
        try {
            $rules = [
                'fiscalyearid' => 'required|integer',
                'levelid' => 'required|integer',
                'designationid' => 'required|integer',
            ];
            $messages = [
                'fiscalyearid.required' => 'कृपया आर्थिक बर्ष छान्नुहोस् ।',
                'fiscalyearid.integer' => 'कृपया आर्थिक बर्ष छान्नुहोस् ।',
                'levelid.required' => 'कृपया तह छान्नुहोस् ।',
                'levelid.integer' => 'कृपया तह छान्नुहोस् ।',
                'designationid.required' => 'कृपया पद छान्नुहोस् ।',
                'designationid.integer' => 'कृपया पद छान्नुहोस् ।'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first(), 1);
            }
            $this->message = 'तपाईले छान्नुभएको सम्पुर्ण परिक्षार्थीको सिम्बोल नम्बर सफलतापुर्वक जेनेरेट भएको छ ।';
            DB::beginTransaction();
            $post = $request->all();
            // $post['isSymbolNumber'] = 'N';
            // $applicantNoSymbol = SymbolNumber::getApplicants($post);
            // $post['isSymbolNumber'] = 'Y';
            // $applicantSymbol = SymbolNumber::getApplicants($post);

            $applicants = SymbolNumber::getApplicants($post);  
            $applicantWithSymbol = [];
            $applicantWithOutSymbol = [];
            foreach ($applicants as $applicant) {
                if ($applicant->symbolnumber == '') {
                    $applicantWithOutSymbol[] = $applicant;
                } else {
                    $applicantWithSymbol[] = $applicant;
                }
            }

            if (!empty($applicantWithOutSymbol)) {
                $first = $post['levelid'];
                if ($post['designationcount'] > 1) {
                    $second = $post['designationserial']+1;
                } else {
                    $second = 0;
                }
                $symbolNumberInsertArray = [];
                // if(!empty($applicantWithSymbol)){
                //     $lastSymbolNumber = $applicantWithSymbol[count($applicantWithSymbol)-1]->symbolnumber;
                //     $startingSymbol = $lastSymbolNumber+1;

                // }else{
                //     $startingSymbol = (int)($first.$second.'0001');
                // }
                $startingSymbol = 1;

                foreach ($applicantWithOutSymbol as $ad)
                {
                    $symbolData = [];
                    $symbolData['userid']= $ad->userid;
                    $symbolData['designationid']= $ad->designationid;
                    $symbolData['symbolnumber']= $startingSymbol;
                    $symbolData['status']= 'Y';
                    $symbolData['created_at']= now();
                    $symbolNumberInsertArray[] = $symbolData;;
                    $startingSymbol++;
                }


                // $applyDetailUpdateArray = [];
                // if($applicantSymbol->isNotEmpty()){
                //     $lastSymbolNumber = $applicantSymbol[count($applicantSymbol)-1]->symbolnumber;
                //     $startingSymbol = $lastSymbolNumber+1;

                // }else{
                //     $startingSymbol = (int)($first.$second.'0001');
                // }
                // foreach($applicantNoSymbol as $ad){
                //     $applydata = [];
                //     $applydata ['id']= $ad->applydetailid;
                //     $applydata ['symbolnumber']= $startingSymbol;
                //     $applyDetailUpdateArray[] = $applydata;
                //     $startingSymbol++;
                // }

                if (!empty($symbolNumberInsertArray)) {
                    if (!SymbolNumberManage::insert($symbolNumberInsertArray)) {
                        throw new Exception ('माफ गर्नुहोला ! सिम्बोल नम्बर जेनेरेट हुन सकेन ।', 1);
                    }
                }
            } else {
                throw new Exception('माफ गर्नुहोला ! सिम्बोल नम्बर जेनेरेट नभएको कुनै पनि रेकर्ड भेटिएन।', 1);
            }
            DB::commit();
        }catch (QueryException $e) {
            $this->type = 'error';
            $this->message = $this->queryExceptionMessage;
        }  catch (Exception $e) {
            DB::rollback();
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }

    //returns symbolnumbers
    public function getSymbolNumber(Request $request)
    {
        try{
            $rules = [
                'fiscalyearid' => 'required|integer',
                'levelid' => 'required|integer',
                'designationid' => 'required|integer',
            ];
            $messages = [
                'fiscalyearid.required' => 'कृपया आर्थिक बर्ष छान्नुहोस् ।',
                'fiscalyearid.integer' => 'कृपया आर्थिक बर्ष छान्नुहोस् ।',
                'levelid.required' => 'कृपया तह छान्नुहोस् ।',
                'levelid.integer' => 'कृपया तह छान्नुहोस् ।',
                'designationid.required' => 'कृपया पद छान्नुहोस् ।',
                'designationid.integer' => 'कृपया पद छान्नुहोस् ।'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first(), 1);
            }
            $this->message = 'सिम्बोल नम्बर Fetch गरिएको छ ।';
            $post = $request->all();
            $symbols = SymbolNumber::getSymbolNumber($post);  
            $applicantWithEc = [];
            $applicantWithOutEc = [];
            $data = [];
            if(!empty($symbols)){
                foreach ($symbols as $value) {
                    if ($value->examcenterid == '' || $value->examcenterid == 0) {
                        $applicantWithOutEc[] = $value;
                    } else {
                        $applicantWithEc[] = $value;
                    }
                }
                if (!empty($applicantWithOutEc)) {
                    $data['startingSymbol'] = $applicantWithOutEc[0]->symbolnumber;
                    $data['lastSymbol'] = $applicantWithOutEc[count($applicantWithOutEc)-1]->symbolnumber;
                } else {
                    throw new Exception('माफ गर्नुहोला ! तपाईले छान्नुभएको पदकोलागी परिक्षाकेन्द्र तोक्न बाँकी कुनै पनि सिम्बोल नम्बर भेटिएन ।', 1);
                }
            }else {
                throw new Exception('माफ गर्नुहोला ! तपाईले छान्नुभएको पदकोलागी कुनै पनि सिम्बोल नम्बर जनेरेट गरेको भेटिएन ।', 1);
            }
            
            $this->response = $data;
        }catch (QueryException $e) {
            $this->type = 'error';
            $this->message = $this->queryExceptionMessage;
            $this->response = $data;
        }  catch (Exception $e) {
            $this->type = 'error';
            $this->message = $e->getMessage();
            $this->response = $data;
        }
        Common::getJsonData($this->type, $this->message, $this->response);

    }
}
