<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Education, Common};
use App\Traits\ImageProcessTrait;
use Illuminate\Support\Facades\{Date, DB};
use Exception;
use Illuminate\Database\QueryException;
use Image;
use Validator;
use Storage;

class EducationController extends Controller
{
    use ImageProcessTrait;

    protected $type;
    protected $message;
    protected $response;
    protected $queryExceptionMessage;


    // constructor
    public function __construct ()
    {
        $this->type = 'success';
        $this->message = 'Education Details Saved Successfully.';
        $this->response = false;
        $this->queryExceptionMessage = "Something went wrong.Please, try again.";
    }


    // show education details main page
    public function index ()
    {
        try {
            $post = [];
            $post['userid']    = auth()->user()->id;
            $verifyInfoDetails = Common::checkJobApplyDetails($post);
            
            $data = [
                'verifydoctdetails' => $verifyInfoDetails
            ];
        } catch (QueryException $e) {
            $data = [];
        } catch (Exception $e) {
            $data = [];
        }
        return view('admin.pages.education.vieweducationsetup', $data);
    }
 

    // show add education form
    public function educationForm (Request $request)
    {
        try {
            $post = $request->all();
            $academics = DB::table('academics')->where('status','Y')->get();
            $personalDetails = DB::table('personals')->select('id')->where('userid',auth()->user()->id)->first();
    
            $post['userid']    = auth()->user()->id;
            $verifyInfoDetails = Common::checkJobApplyDetails($post);
    
            if (!empty(@$post['educationdetailid'])) {
                $previousData = Education::previousAllData($post);
            }
            $data = [
                'previousData' => @$previousData,
                'saveurl' => route('storeEducationDetails'),
                'personalid' => @$personalDetails->id,
                'academics'  =>  $academics,
                'verifydoctdetails' => $verifyInfoDetails
            ];
        } catch (QueryException $e) {
            $data = [];
        } catch (Exception $e) {
            $data = [];
        }
        return view('admin.pages.education.addeducationsetup', $data);
    }


    // store education details
    public function storeEducationDetails (Request $request)
    {
        try{
            $post = $request->all();
            $rules = [
                'universityboardname' => 'required',
                'educationlevel' => 'required|numeric',
                'educationfaculty' => 'required',
                'educationinstitution' => 'required',
                'devisiongradepercentage' => 'required',
                'mejorsubject' => 'required',
                'educationaltype' => 'required',
                'passoutdatead' => 'required',
                'passoutdatebs' => 'required',
                // 'academicdocument' => 'required|mimes:jpeg,jpg,png,pdf|max:1024'
            ];
            $messages =  [
                'universityboardname.required' => 'तपाईले विश्वविद्यालयको नाम भर्नुभएको छैन |',
                'educationlevel.required' => 'तपाईले शिक्षाको स्तर भर्नुभएको छैन |',
                'educationlevel.numeric' => 'तपाईले शिक्षाको स्तर भर्नुभएको छैन |',
                'educationfaculty.required' => 'तपाईले शिक्षाको संकाय भर्नुभएको छैन |',
                'educationinstitution.required' => 'तपाईले शिक्षाको संस्था भर्नुभएको छैन |',
                'devisiongradepercentage.required' => 'तपाईले शिक्षाको डिभिजन/ग्रेड/प्रतिशत भर्नुभएको छैन |',
                'mejorsubject.required' => 'तपाईले प्रमुख विषय भर्नुभएको छैन |',
                'educationaltype.required' => 'तपाईले शिक्षा को प्रकार भर्नुभएको छैन |',
                'passoutdatead.required' => 'तपाईले पासआउट मिति (अंग्रेजीमा) भर्नुभएको छैन |',
                'passoutdatebs.required' => 'तपाईले पासआउट मिति (नेपालीमा) भर्नुभएको छैन |',
                // 'academicdocument.required' => 'तपाईले शैक्षिक योग्यताको प्रमाणपत्र अपलोड गर्नुभएको छैन |',
                // 'academicdocument.mimes' => 'शैक्षिक योग्यताको प्रमाणपत्रमा फाईलको प्रकार jpeg,jpg,png,pdf हुनु पर्नेछ |',
                // 'academicdocument.max' => 'शैक्षिक योग्यताको प्रमाणपत्रमा फाईल साइज अधिकतम 1 mb sहुनु पर्नेछ |',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first(), 1);
            }
 
            unset($post['academicdocument']);
            unset($post['back_academicdocument']);
            unset($post['equivalentdocument']);
            unset($post['back_equivalentdocument']);

            $filtereddata = sanitizeData ($post);


            // academic documents
            if ($request->hasFile('academicdocument')) 
            {
                $image_tmp = $request->file('academicdocument');
                foreach ($image_tmp as $id => $file) 
                {
                    $extension = $file->getClientOriginalExtension();
                    $originalFilename = explode('.',$file->getClientOriginalName())[0];
                    $originalFilename = str_replace(' ', '', $originalFilename);
                    $current = date('Ymd');
                    $name = auth()->user()->id.$originalFilename.'-'.$current.'-' . rand(111, 99999);
                    $folder = '/uploads/education/';
                    $filePath = $name. '.' . $extension;
                    $imagesize = $file->getSize();
                    if (strtolower($extension) == 'jpg' || strtolower($extension) == 'jpeg' || strtolower($extension) == 'png' || strtolower($extension) == 'pdf') {
                        $this->uploadImage($file, $folder, $name);
                        $filtereddata['academicdocument'][$id] = $filePath;
                    } else {
                        throw new Exception("शैक्षिक योग्यताको प्रमाणपत्रको फाईलको प्रकार jpeg,jpg,png,pdf  हुनु पर्नेछ । ", 1);
                    } 
                    
                    if ($imagesize/1024 > 1024) {
                        throw new Exception("शैक्षिक योग्यताको प्रमाणपत्रको फाईल साइज अधिकतम 1 mb हुनु पर्नेछ ।", 1);
                    }
                    
                    // $this->uploadImage($file, $folder, $name);
                    // $filtereddata['academicdocument'][$id] = $filePath;
                }
                $filtereddata['academicdocument'] = $filtereddata['academicdocument'];
            }else{
                throw new Exception("कृपया शैक्षिक योग्यताको प्रमाणपत्रको फाईल अपलोड गर्नुहोस् । ", 1);
            }
            
            // equivalent document
            if ($request->hasFile('equivalentdocument')) {
                $file = $request->file('equivalentdocument');
                $extension = $file->getClientOriginalExtension();
                $name = auth()->user()->id.'equivalentdocument' . rand(111, 999999999);
                $folder = 'uploads/education/';
                $filePath = $name. '.' . $extension;
                $this->uploadImage($file, $folder, $name);
                $filtereddata['equivalentdocument'] = $filePath;
            }
            $filtereddata['back_academicdocument'] = $request->back_academicdocument;
            $filtereddata['back_equivalentdocument'] = $request->back_equivalentdocument;
            $filtereddata['userid'] = auth()->user()->id;
            $result = Education::storeEducationDetails ($filtereddata);
            $this->response = true;

        } catch (QueryException $e) {
            $this->type = 'error';
            $this->message = $this->queryExceptionMessage;
        } catch (Exception $e) {
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }


    // get educational details in datatables
    public function getEducationDetailsData (Request $request)
    {
        try {
            $post = $request->all();
            $post['userid'] = auth()->user()->id;
            $data = Education::getEducationDetailsData($post);
            // dd($data);
            $verifyInfoDetails = Common::checkJobApplyDetails($post);
            $i = 0;
            $array = array();
            $filtereddata = (@$data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : @$data["totalrecs"]);
            $totalrecs = @$data["totalrecs"];
    
            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            foreach ($data as $row) {
                $array[$i]["sn"] = $i + 1 ;
                $array[$i]["universityboardname"] = $row->universityboardname;
                $array[$i]["educationlevel"] = $row->name;
                $array[$i]["educationfaculty"] = $row->educationfaculty;
                $array[$i]["devisiongradepercentage"] = $row->devisiongradepercentage;
                $array[$i]["mejorsubject"] = $row->mejorsubject;
                $array[$i]["passoutdatead"] = $row->passoutdatead;
                $array[$i]["educationaltype"] = $row->educationaltype;
                $images = json_decode(@$row->academicdocument);
                $urls = '';
                if(!empty($images)){
                foreach ($images as $image){
                    $urls .= '<a style="padding-left:10px;" title="'.@$image.'" href="'.asset('uploads/education/' . @$image).'" download><i class="fa fa-download"></i></a>';
                }}
                
                $array[$i]["academicdocument"] = $urls;
    
                $array[$i]["equivalentdocument"] ='<a href="'.asset('uploads/education/' . @$row->equivalentdocument).'" download><i class="fa fa-download"></i></a>';
                
                $action = "";
                $action .= '<a href="javascript:;" class="editEducationSetup"  title="Edit Details" data-educationdetail="' . $row->id . '"  data-user="' . $row->userid . '"  data-personalid="'.$row->personalid.'"><i class="fa fa-edit fa-lg text-primary"></i></a>';
                
                $action .= ' | <a href="javascript:;" class="deleteEducationDetail"  title="Delete Details" data-educationdetail="' . $row->id . '" data-user="' . $row->userid . '"  data-personalid="'.$row->personalid.'"><i class="fa fa-trash fa-lg text-danger"></i></a>';
                $array[$i]["action"] = ((auth()->user()->is_submitted == 0) || (auth()->user()->is_submitted == 1 and auth()->user()->education_enabled == 1))? $action : '';
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


    // delete educational data
    public function deleteEducationDetailsData (Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'educationdetailid' => 'required|numeric'
            ], [
                'educationdetailid.required' => "Couldn't delete detail.",
                'educationdetailid.numeric' => "Couldn't delete detail."
            ]);
            if ($validate->fails()) {
                throw new Exception ($validate->errors()->first(), 1);
            }
            $this->message = 'Education Details has been Deeted Successfully.';
            $post = $request->all();
            $result = Education::deleteEducationDetailsData($post);
            if (!$result) {
                throw new Exception ("Couldn't delete educaional detail.Please, try again.", 1);
            }
            $this->response = true;
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