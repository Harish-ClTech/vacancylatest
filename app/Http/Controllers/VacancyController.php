<?php

namespace App\Http\Controllers;

use App\Models\{Vacancy, Common};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Exception;
use Image;
use Validator;

class VacancyController extends Controller
{
    protected $type;
    protected $message;
    protected $queryExceptionMessage;
    protected $response;


    // constructor 
    public function __construct ()
    {
        $this->type = 'success';
        $this->message = 'रिक्त स्थान सफलतापूर्वक सम्मिलित गरियो ।';
        $this->queryExceptionMessage = 'केही गडबड भयो। कृपया फेरि प्रयास गर्नुहोस् ।';
        $this->response = false;
    }


    // show main page
    public function index ()
    {
        if(session()->get('roleid') != 1) {
            return redirect()->route('login'); 
        } else {
            return view('admin.vacancy.viewvacancysetup');  
        }
    }

            
    // show vacancy form
    public function vacancyForm (Request $request)
    {
        try {
            if (session()->get('roleid') != 1) {
                return redirect()->route('login'); 
            }
    
            $post = $request->all();
            $levels = DB::table('levels')->where('status','Y')->get();
            $servicegroups = DB::table('servicegroups')->where('status','Y')->get();
            $jobcategories = DB::table('jobcategories')->where('status','Y')->get();
            $designations = DB::table('designations')->where('status','Y')->get();
            $academics = DB::table('academics')->where('status','Y')->get();
    
            if (!empty($post['vacancysetupid'])) {
                $previousData = Vacancy::previousAllData($post);
            }
    
            $data = [
                'previousData'=>@$previousData,
                'saveurl'=>route('storeVacancyDetails'),
                'levels' => $levels,
                'servicegroups' => $servicegroups,
                'jobcategories' => $jobcategories,
                'designations' => $designations,
                'academics' => $academics
            ];
            
        } catch (QueryException $e) {
            $data = [];
        } catch (Exception $e) {
            $data = [];
        }
        return view('admin.vacancy.addvacancysetup', $data);
    }


    // store vacancy details
    public function storeVacancyDetails (Request $request)
    {
        try {
            $rules = [
                'vacancynumber' => 'required',
                'level' => 'required|numeric',
                'designation' => 'required|numeric',
                'servicesgroup'=>'required|numeric',
                'jobcategory'=>'required|numeric',
                'academicid' => 'required|numeric',
                'vacancyrate'=>'required|numeric',
                'numberofvacancy' => 'required|numeric',
                'vacancypublishdate' => 'required',
                'vacancyenddate' => 'required',
                'extendeddate' => 'required',
                'jobstatus' => 'required'
            ];
            
            if (!empty($request->vacancysetupid)) {
                $rules['vacancysetupid'] = 'required|numeric';
                $this->message = "रिक्तता सफलतापूर्वक अद्यावधिक गरियो ।";
            }
            $messages = [
                'vacancysetupid.required' => 'तपाईले रिक्त स्थान आईडी भर्नुभएको छैन |',
                'vacancysetupid.numeric' => 'तपाईले रिक्त स्थान आईडी भर्नुभएको छैन |',
                'vacancynumber.required' => 'तपाईले रिक्त स्थान नम्बर भर्नुभएको छैन |',
                'level.required' => 'तपाईले स्तर भर्नुभएको छैन |',
                'level.numeric' => 'तपाईले स्तर भर्नुभएको छैन |',
                'designation.required' => 'तपाईले पदनाम भर्नुभएको छैन |',
                'designation.numeric' => 'तपाईले पदनाम भर्नुभएको छैन |',
                'servicesgroup.required' => 'तपाईले सेवा समूह भर्नुभएको छैन |',
                'servicesgroup.numeric' => 'तपाईले सेवा समूह भर्नुभएको छैन |',
                'jobcategory.required' => 'तपाईले काम को श्रेणी भर्नुभएको छैन |',
                'jobcategory.numeric' => 'तपाईले काम को श्रेणी भर्नुभएको छैन |',
                'academicid.required' => 'तपाईले योग्यता भर्नुभएको छैन |',
                'academicid.numeric' => 'तपाईले योग्यता भर्नुभएको छैन |',
                'vacancyrate.required' => 'तपाईले रिक्तता दर भर्नुभएको छैन |',
                'vacancyrate.numeric' => 'रिक्तता दर अंकमा मात्र हुनुपर्छ |',
                'numberofvacancy.required' => 'तपाईले रिक्तता संख्या भर्नुभएको छैन |',
                'numberofvacancy.numeric' => 'रिक्तता संख्या अंकमा मात्र हुनुपर्छ |',
                'vacancypublishdate.required' => 'तपाईले रिक्त पद प्रकाशित मिति भर्नुभएको छैन |',
                'vacancyenddate.required' => 'तपाईले रिक्तता समाप्ति मिति भर्नुभएको छैन |',
                'extendeddate.required' => 'तपाईले विस्तारित मिति भर्नुभएको छैन |',
                'jobstatus.required' => 'तपाईले कामको स्थिति भर्नुभएको छैन |'
            ];
            

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first(), 1);
            }

            $post = $request->all();
            $filtereddata = sanitizeData($post);
            $result = Vacancy::storeVacancyDetails($filtereddata);
            if (!$result)
                throw new Exception ("विवरण सुरक्षित गर्न सकिएन। कृपया फेरि प्रयास गर्नुहोस् ।", 1);

            $this->response = true;

        } catch (QueryException $e) {
            $this->type = 'error';
            $this->message = $this->queryExceptionMessage;
        } catch (Exception $e){
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }


    // list vacancies data in datatable
    public function getVacancyDetailsData (Request $request)
    {
        try {
            if(session()->get('roleid') != 1) {
                return redirect()->route('login'); 
            }
    
            $post = $request->all();
            $post['userid'] = auth()->user()->id;
            $data = Vacancy::getVacancyDetailsData($post);
            $i = 0;
            $array = array();
            $filtereddata = (@$data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : @$data["totalrecs"]);
            $totalrecs = @$data["totalrecs"];
            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            
            foreach ($data as $row) {
                $array[$i]["sn"] = $i + 1 ;
                $array[$i]["vacancynumber"] = $row->vacancynumber;
                $array[$i]["level"] = $row->labelname;
                $isVacant = 'होइन';
                if($row->isinternalvacancy == 'Y'){
                    $isVacant = 'हो';
                }
                $array[$i]["isinternalvacancy"] = $isVacant;
                $array[$i]["designation"] = $row->title;
                $array[$i]["servicesgroup"] = $row->servicegroupname;
                $array[$i]["jobcategory"] = $row->name;
                $array[$i]["vacancyrate"] = $row->vacancyrate;
                $array[$i]["numberofvacancy"] = $row->numberofvacancy;
                $array[$i]["vacancypublishdate"] = $row->vacancypublishdate;
                $array[$i]["vacancyenddate"] = $row->vacancyenddate;
                $array[$i]["extendeddate"] = $row->extendeddate;
                $array[$i]["jobstatus"] = $row->jobstatus;
                $array[$i]["qualification"] = $row->qualification;
    
                $action = "";

                // edit
                $action .= '<a href="javascript:;" class="editVacancySetup" title="रिक्तता सम्पादन" data-vacancysetup="' . $row->id . '"  ><i class="fa fa-edit fa-lg text-primary"></i></a>';
                
                // delete
                $action .= ' | <a href="javascript:;" class="deleteVacancySetup" title="रिक्तता मेटाउने" data-vacancysetup="' . $row->id . '" ><i class="fa fa-trash fa-lg text-danger"></i></a>';
                $array[$i]["action"] = $action;
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
            $filtereddata = 0;
            $totalrecs = 0;
        } catch (Exception $e) {
            $array = [];
            $filtereddata = 0;
            $totalrecs = 0;
        }
        echo json_encode(array("recordsFiltered" => @$filtereddata, "recordsTotal" => @$totalrecs, "data" => $array));
        exit;
    }


    // delete vacancy details
    public function deleteVacancyDetailsData (Request $request)
    {
        try {
            $this->message = 'भ्यान्केसी सफलतापूर्वक हटाइयो ।';
            $post = $request->all();
            $response = Vacancy::deleteVacancyDetailsData($post);
            if (!$response) 
                throw new Exception ("रिक्तता मेटाउन सकिएन ।", 1);

        } catch (QueryException $e) {
            $this->type = 'error';
            $this->message = $this->queryExceptionMessage;
        } catch (Exception $e) {
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }
    
    // show vacancy-restriction form
    public function vacancyRestrictionSetupForm (Request $request)
    {
        try {
            if (session()->get('roleid') != 1) {
                return redirect()->route('login'); 
            }
    
            $post = $request->all();
            $fiscalyears = DB::table('fiscal_years')->where('status','Y')->get();

            $levels = DB::table('levels')->where('status','Y')->get();
            $servicegroups = DB::table('servicegroups')->where('status','Y')->get();
            $jobcategories = DB::table('jobcategories')->where('status','Y')->get();
            $designations = DB::table('designations')->where('status','Y')->get();
            $academics = DB::table('academics')->where('status','Y')->get();
    
            if (!empty($post['vacancysetupid'])) {
                $previousData = Vacancy::previousAllData($post);
            }
    
            $data = [
                'previousData'=>@$previousData,
                'saveurl'=>route('storeVacancyDetails'),
                'levels' => $levels,
                'servicegroups' => $servicegroups,
                'jobcategories' => $jobcategories,
                'designations' => $designations,
                'academics' => $academics,
                'fiscalyears' => $fiscalyears
            ];

        } catch (QueryException $e) {
            $data = [];
        } catch (Exception $e) {
            $data = [];
        }
        return view('admin.vacancyrestriction.index', $data);
    }
}
