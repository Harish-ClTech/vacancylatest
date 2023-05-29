<?php

namespace App\Http\Controllers;

use App\Models\{Vacancy, Common, VacancyDateMaster};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Exception;
use Image;
use Validator;

class VacancyDateMasterController extends Controller
{
    protected $type;
    protected $message;
    protected $queryExceptionMessage;
    protected $response;


    // constructor 
    public function __construct ()
    {
        $this->type = 'success';
        $this->message = '';
        $this->queryExceptionMessage = 'माफ गर्नुहोला ! तपाईको डाटामा समस्या देखिएको छ । कृपया फेरि प्रयास गर्नुहोस् ।';
        $this->response = false;
    }


    // show vacancy-date-master main page
    public function index ()
    {
        if(session()->get('roleid') != 1) {
            return redirect()->route('login'); 
        } else {
            return view('admin.vacancydatemaster.index');  
        }
    }

            
    // show vacancy-date-master form
    public function form (Request $request)
    {
        try {
            if (session()->get('roleid') != 1) {
                return redirect()->route('login'); 
            }
    
            $post = $request->all();
            $fiscalyears = DB::table('fiscal_years')->where('status','Y')->get();
            if (!empty($post['dataid'])) {
                $previousData = VacancyDateMaster::previousAllData($post);
            }
            
            $data = [
                'previousData'=>@$previousData,
                'saveurl'=>route('vacancydatemastser.store'),
                'fiscalyears' => $fiscalyears
            ];

        } catch (QueryException $e) {
            $data = [];
        } catch (Exception $e) {
            $data = [];
        }
        return view('admin.vacancydatemaster.form', $data);
    }


    // store vacancy details
    public function store (Request $request)
    {
        try {
            $rules = [
                'fiscalyearid' => 'required',
                'vacancypublishdate' => 'required',
                'vacancyenddate' => 'required',
                'vacancyextendeddate' => 'required',
            ];

            if (!empty($request->vacancysetupid)) {
                $rules['vacancysetupid'] = 'required|numeric';
                $this->message = "विवरण अद्यावधिक गरियो ।";
            }
            $messages = [
                'vacancysetupid.required' => 'तपाईले विज्ञापन आईडी भर्नुभएको छैन |',
                'fiscalyearid.required' => 'तपाईले आर्थिक वर्ष छान्नु भएको छैन |',
                'vacancypublishdate.required' => 'तपाईले विज्ञापन प्रकाशित मिति भर्नुभएको छैन |',
                'vacancyenddate.required' => 'तपाईले विज्ञापन समाप्ति मिति भर्नुभएको छैन |',
                'vacancyextendeddate.required' => 'तपाईले विस्तारित मिति भर्नुभएको छैन |',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first(), 1);
            }

            $post = $request->all();
            $filtereddata = sanitizeData($post);
            $result = VacancyDateMaster::storeVacancyDate($filtereddata);
            if (!$result)
                throw new Exception ("विवरण सुरक्षित गर्न सकिएन। कृपया फेरि प्रयास गर्नुहोस् ।", 1);

            $this->response = true;

        // } catch (QueryException $e) {
        //     $this->type = 'error';
        //     $this->message = $this->queryExceptionMessage;
        } catch (Exception $e){
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }


    // list vacancy dates
    public function getVacancyDateList (Request $request)
    {
        try {
            if(session()->get('roleid') != 1) {
                return redirect()->route('login'); 
            }
    
            $post = $request->all();

            $post['userid'] = auth()->user()->id;
            $data = VacancyDateMaster::getVacancyDateList($post);
            $i = 0;
            $array = array();
            $filtereddata = (@$data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : @$data["totalrecs"]);
            $totalrecs = @$data["totalrecs"];
            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            
            foreach ($data as $row) {
                $array[$i]["sn"] = $i + 1 ;
                $array[$i]["fiscalyearname"] = $row->fiscalyearname;
                $array[$i]["vacancypublishdate"] = $row->vacancypublishdate;
                $array[$i]["vacancyenddate"] = $row->vacancyenddate;
                $array[$i]["vacancyextendeddate"] = $row->vacancyextendeddate;
                if($row->allow_registration !='Y'){
                    $allow_status = '<a href="#" class="badge badge-danger p-1">फारम भर्न नदिने</a>';
                }else{
                    $allow_status = '<a href="#" class="badge badge-success p-1">फारम भर्न दिने</a>';
                }
                $array[$i]["allow_registration"] = $allow_status;
    
                $action = "";

                // edit
                $action .= '<a href="javascript:;" class="editVacancyDateSetup" title="विज्ञापन मिति सम्पादन" data-vacancydatesetup="' . $row->vacancydatemasterid . '"  ><i class="fa fa-edit fa-lg text-primary"></i></a>';
                
                // delete
                $action .= ' | <a href="javascript:;" class="deleteVacancyDateSetup" title="विज्ञापन मिति मेटाउने" data-vacancydatesetup="' . $row->vacancydatemasterid . '" ><i class="fa fa-trash fa-lg text-danger"></i></a>';
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
    public function delete (Request $request)
    {
        try {
            $this->message = 'विवरण सफलतापूर्वक हटाइयो ।';
            $post = $request->all();
            $response = VacancyDateMaster::deleteVacancyDateMaster($post);
            if (!$response) 
                throw new Exception ("विवरण मेटाउन सकिएन ।", 1);

        } catch (QueryException $e) {
            $this->type = 'error';
            $this->message = $this->queryExceptionMessage;
        } catch (Exception $e) {
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }

    // allow registration -- update flag
    public function allowRegistration (Request $request)
    {
        try {
            $this->message = 'विवरण सफलतापूर्वक हटाइयो ।';
            $post = $request->all();
            $response = VacancyDateMaster::allowRegistration($post);
            if (!$response) 
                throw new Exception ("विवरण मेटाउन सकिएन ।", 1);

        } catch (QueryException $e) {
            $this->type = 'error';
            $this->message = $this->queryExceptionMessage;
        } catch (Exception $e) {
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }
   
}
