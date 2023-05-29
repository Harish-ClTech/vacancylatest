<?php

namespace App\Http\Controllers;

use App\Models\{ExamCenter, Common, SymbolNumber, SymbolNumberManage};
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use Validator;

class ExamCenterController extends Controller
{
    protected $type;
    protected $queryExceptionMessage;
    protected $message;
    protected $response;


    // constructor 
    public function __construct ()
    {
        $this->type = 'success';
        $this->message = "परिक्षा केन्द्र सेभ भएको छ ।";
        $this->queryExceptionMessage = "तपाईको डाटामा समस्या छ। कृपया फारम रुजु गर्नुहोस् ।";
        $this->response = false;
    }


    // show main page 
    public function index ()
    {
        if (session()->get('roleid') != 1) {
            return redirect()->route('login'); 
        } else {
            return view('admin.examCenter.index');
        }
    }


    // show exam center form
    public function examcCenterForm (Request $request)
    {
        try {
            if (session()->get('roleid') != 1) {
                return redirect()->route('login');
            }
        
            $post = $request->all();
            if (!empty(@$post['examcenterid'])) {
                $previousData = ExamCenter::previousAllData($post);
            }
    
            $data = [
                'previousData' => @$previousData,
                'saveurl' => route('examcenter.store')
            ];

        } catch (QueryException $e) {
            $data = [];
        } catch (Exception $e) {
            $data = [];
        }
        return view('admin.examCenter.form', $data);
    }

    // show exam center assign form
    public function examcCenterAssignForm (Request $request)
    {
        try {
            $data = [];
            $post = sanitizeData($request->all());
            $data['examcenterid'] = $post['examcenterid'];

            if (session()->get('roleid') != 1) {
                return redirect()->route('login');
            }
       
            $data['fiscalyears'] = Common::getFiscalYears();
    

        } catch (QueryException $e) {
            $data = [];
        } catch (Exception $e) {
            $data = [];
        }
        return view('admin.examCenter.assignForm', $data);
    }

     
    // returns counts of symbol numbers with examcenter assigned
    public function getSymbolnumbersWithExamcenter (Request $request)
    {
        try {
            $this->message = 'Data fetched Successfully.';
            $rules = [
                'examcenterid' => 'required|integer',
            ];
            $messages = [
                'examcenterid.required' => 'Please select fiscalyear',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first(), 1);
            }

            $post = $request->all();
            $applicants = SymbolNumber::getSymbolNumberWithExamcenter($post);  
            $applicantArray = [];
            foreach($applicants as $applicant){
                $applicantArray[$applicant->designation][] = $applicant;
            }
            $array = [];
            //  applicants with symbol generated
            $applicantArrayCount = count($applicantArray);
            $row = '';
            $i=1;
            $totalApplicants = 0;
            if($applicantArrayCount>=1){
                foreach($applicantArray as $key=>$val){
                    $designation = $val[0]->designation;
                    $startingSymbol = $val[0]->symbolnumber;
                    $arrayCount = count($val);
                    $lastSymbol = $val[$arrayCount-1]->symbolnumber;
                    $row .= '<tr>
                            <td>'.en_to_nep($i).'</td>
                            <td>'.$designation.'</td>
                            <td>'.$startingSymbol.'</td>
                            <td>'.$lastSymbol.'</td>
                            <td>'.en_to_nep($arrayCount).'</td>
                        </tr>';
                    $i++;
                    $totalApplicants += $arrayCount;
                }
                $row .='<tr style="color:#144380;">
                            <td colspan="4" class="text-right text-bold">जम्मा परिक्षार्थी संख्या</td>
                            <td>'.en_to_nep($totalApplicants).'</td>
                        </tr>';

            }else{
                $row ='<tr><td colspan="5" class="text-center text-danger text-bold">No Data Found</td></tr>';
            }
            $table ='<h5> यस परिक्षाकेन्द्रमा परिक्षा तोकिएका पदहरुको सूची ।</h5>
                <table class="table-bordered table-striped table-condensed cf" id="examCenterTable" width="100%">
                <thead class="cf">
                    <tr>
                        <th>क्र.सं. </th>
                        <th>पद</th>
                        <th>सुरुको सिम्बोल नम्बर </th>
                        <th>अन्तिम सिम्बोल नम्बर</th>
                        <th>परिक्षार्थी संख्या</th>
                    </tr>
                </thead>
                <tbody>
                '.$row.'
                </tbody>
            </table>';
            $array['table'] = $table;
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




    // store exam center
    public function storeExamCenter (Request $request)
    {
        try {
            $post = $request->all();
            $rules = [
                'examcentername' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'status' => 'required|string|max:1',
            ];
            $messages = [
                'examcentername.required' => 'कृपया परिक्षा केन्द्रको नाम प्रविष्ट गर्नु्होस् |',
                'examcentername.string' => 'कृपया परिक्षा केन्द्रको नाम प्रविष्ट गर्नु्होस् |',
                'address.required' => 'कृपया परिक्षा केन्द्रको ठेगाना प्रविष्ट गर्नु्होस् |',
                'address.string' => 'कृपया परिक्षा केन्द्रको ठेगाना प्रविष्ट गर्नु्होस् |'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first(), 1);
            }
            $result = ExamCenter::storeExamCenter($post);
            if (!$result) {
                throw new Exception ('Something went wrong.Please, try again.', 1);
            }

        } catch (QueryException $e) {
            $this->type = 'error';
            $this->message = $this->queryExceptionMessage;
        } catch (Exception $e) {
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }


    // show exam center list
    public function examCenterList (Request $request)
    {
        try {
            if (session()->get('roleid') != 1) {
                return redirect()->route('login'); 
            }
        
            $post = $request->all();
            $post['userid'] = auth()->user()->id;
            $data = ExamCenter::examCenterList($post);
            $i = 0;
            $array = array();
            $filtereddata = (@$data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : @$data["totalrecs"]);
            $totalrecs = @$data["totalrecs"];
        
            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            foreach ($data as $row) {
                $array[$i]["sn"] = $i + 1 ;
                $array[$i]["examcentername"] = $row->examcentername;
                $array[$i]["address"] = $row->address;
                $status = "";
                $action = "";
                $action .= '<a href="javascript:;" class="editExamCenter" title="सम्पादन गर्नुहोस् ।" data-data="' . $row->id . '"  ><i class="fa fa-edit fa-lg text-primary"></i></a>';
                $action .= '&nbsp; <a href="javascript:;" class="deleteExamCenter" title="डिलिट गर्नुहोस् ।"  data-data="' . $row->id . '" ><i class="fa fa-trash fa-lg text-danger"></i></a>';
                if(!empty($row->status)){
                    if($row->status=='Y'){
                        $action .= '&nbsp; <a href="javascript:;" class="assignExamCenter" title="परिक्षाकेन्द्र तोक्नुहोस् ।"  data-data="' . $row->id . '" data-name="' . $row->examcentername . '"  data-address="' . $row->address . '" ><i class="fa fa-tasks fa-lg text-warning" aria-hidden="true"></i></a>';
                        $status .= '<a href="javascript:;" class="changeStatus" title="स्थिति परिवर्तन गर्नुहोस् ।" data-data="' . $row->id . '"   ><span class="badge badge-success">सकृय</span></a>';
                    }else{
                        $status .= '<a href="javascript:;" class="changeStatus" title="स्थिति परिवर्तन गर्नुहोस् ।" data-data="' . $row->id . '"  ><span class="badge badge-danger">निष्कृय</span></a>';
                    }
                }
                $array[$i]["status"] = $status;
                
                $array[$i]["action"] = $action;
                $i++;
            }
            if (!$filtereddata) $filtereddata = 0;
            if (!$totalrecs) $totalrecs = 0;
          
        }catch(QueryException $qe){
            $filtereddata = 0;
            $totalrecs = 0;
            $array = [];
        }catch(Exception $e){
            $filtereddata = 0;
            $totalrecs = 0;
            $array = [];
        }
        echo json_encode(array("recordsFiltered" => @$filtereddata, "recordsTotal" => @$totalrecs, "data" => $array));
        exit;

    }
    public function deleteExamCenter(Request $request)
    {
        try {
            $this->message = 'परिक्षा केन्द्र डिलिट भयो ।';
            $post = $request->all();
            $response = ExamCenter::deleteExamCenter($post);
            if (!$response) {
                throw new Exception ('Something went wrong.Please, try again.', 1);
            }
        } catch (QueryException $e) {
            $this->type = 'error';
            $this->message = $this->queryExceptionMessage;
        }  catch (Exception $e) {
            $this->type = 'error';
            $this->message = $e->getMessage();
            $this->response = false;
        }
        Common::getJsonData($this->type, $this->message, $this->response);

    }


    // assign ExamCenter 
    public function assignExamCenter (Request $request)
    {
        try {
            $post = $request->all();
            $this->message = "तपाईले छान्नु भएको पदका लागि परिक्षाकेन्द्र तोकिएको छ ।";
            $rules = [
                'examcenterid' => 'required|integer',
                'fiscalyearid' => 'required|integer',
                'designationid' => 'required|integer',
                'startingsymbolnumber' => 'required',
                'lastsymbolnumber' => 'required',
            ];
            $messages = [
                'examcenterid.required' => "कृपया परिक्षाकेन्द्र छान्नुहोस् ।",
                'fiscalyearid.required' => "कृपया आर्थिक बर्ष छान्नुहोस् ।",
                'designationid.required' => "कृपया पद छान्नुहोस् ।",
                'startingsymbolnumber.required' => "कृपया सुरुको सिम्बोल नम्बर प्रविष्ट गर्नुहोस् ।",
                'lastsymbolnumber.required' => "कृपया अन्तिम सिम्बोल नम्बर प्रविष्ट गर्नुहोस् ।",
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first(), 1);
            }
            $result = SymbolNumberManage::assignExamCenter($post);
            if (!$result) {
                throw new Exception ('माफ गर्नुहोला ! परिक्षाकेन्द्र तोक्न सकिएन । कृपया पुन: प्रयास गर्नुहोला ।', 1);
            }
        // } catch (QueryException $e) {
        //     $this->type = 'error';
        //     $this->message = $this->queryExceptionMessage;
        } catch (Exception $e) {
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }
}
