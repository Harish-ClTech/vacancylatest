<?php

namespace App\Http\Controllers;

use App\Models\{Experience, Common};
use Illuminate\Http\Request;
use Image, Exception, Validator, DB;
use App\Traits\ImageProcessTrait;
use Illuminate\Database\QueryException;


class ExperienceController extends Controller
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
        $this->message = 'Experience Details Saved Successfully.';
        $this->response = false;
        $this->queryExceptionMessage = "Something went wrong.Please, try again.";
    }


    // show main page
    public function index ()
    {
        return view('admin.pages.experience.viewexperiencesetup');
    }


    // show experience form
    public function experienceForm (Request $request)
    {
        try {
            $post = $request->all();
            $personalDetailsId = DB::table('personals')->where('userid', auth()->user()->id)->first()->id;
            if (!empty(@$post['experiencedetailid'])) {
                $previousData = Experience::previousAllData($post);
            }
            $data = [
                'previousData' => @$previousData,
                'saveurl' => route('storeExperienceDetails'),
                'personalid' => @$personalDetailsId
            ];
        } catch (QueryException $e) {
            $data = [];
        } catch (Exception $e) {
            $data = [];
        }
        return view('admin.pages.experience.addexperiencesetup', $data);
    }


    // store experience details
    public function storeExperienceDetails (Request $request)
    {
        try {
            $post = $request->all();
            $rules = [
                'officename' => 'required',
                'officeaddress' => 'required',
                'jobtype' => 'required',
                'designation' => 'required',
                'fromdatebs' => 'required',
                'enddatebs' => 'required',
                'workingstatus' => 'required',
            ];

            $messages = [
                'officename.required' => 'तपाईले कार्यालयको नाम भर्नुभएको छैन |',
                'officeaddress.required' => 'तपाईले कार्यालय ठेगाना भर्नुभएको छैन |',
                'jobtype.required' => 'तपाईले कामको प्रकार भर्नुभएको छैन |',
                'designation.required' => 'तपाईले पद भर्नुभएको छैन |',
                'fromdatebs.required' => 'तपाईले सुरू मिति (नेपालीमा) भर्नुभएको छैन |',
                'enddatebs.required' => 'तपाईले अन्त्य मिति (नेपालीमा) भर्नुभएको छैन |',
                'workingstatus.required' => 'तपाईले काम गर्ने स्थिति भर्नुभएको छैन |',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first(), 1);
            }

            unset($post['document']);
            unset($post['back_document']);
            $filtereddata = sanitizeData ($post);

            $post['documents'] = [];

            if ($request->hasFile('document')) {
                $image_tmp = $request->file('document');
                foreach ($image_tmp as $id => $file) {
                    $extension = $file->getClientOriginalExtension();
                    $originalFilename = explode('.',$file->getClientOriginalName())[0];
                    $current = date('Ymd');
                    $name = auth()->user()->id.$originalFilename.'-'.$current.'-' . rand(111, 99999);
                    $filename = $name . '.' . $extension;
                    $folder = 'uploads/experience/';
                    $imagesize = $file->getSize();
                    if (strtolower($extension) == 'jpg' || strtolower($extension) == 'jpeg' || strtolower($extension) == 'png' || strtolower($extension) == 'pdf') {
                        $this->uploadImage($file, $folder, $name);
                        $post['documents'][$id] = $filename;
                    } else {
                        throw new Exception("अनुभवको प्रमाणपत्रको फाईल प्रकार jpeg,jpg,png,pdf हुनु पर्नेछ । ", 1);
                    } 
                    
                    if ($imagesize/1024 > 1024) {
                        throw new Exception("अनुभवको प्रमाणपत्रको फाईल साइज अधिकतम 1 mb हुनु पर्नेछ ।", 1);
                    }
                }
                $filtereddata['document'] = $post['documents'];
            }
            $filtereddata['back_document'] = $request->back_document;
            $filtereddata['userid'] = auth()->user()->id;
            $result = Experience::storeExperienceDetails($filtereddata);
            if (!$result) {
                throw new Exception ("Couldn't save information.Please, try again.", 1);
            }
            $this->response = true;
        } catch (QueryException $e) {
            $this->type = 'error';
            $this->message = $this->queryExceptionMessage;
        } catch(Exception $e){
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }


    // get experience details in datatables
    public function getExperienceDetailsData (Request $request)
    {
        try {
            $post = $request->all();
            $post['userid']=auth()->user()->id;
            $data = Experience::getExperienceDetailsData($post);
            $i = 0;
            $array = array();
            $filtereddata = (@$data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : @$data["totalrecs"]);
            $totalrecs = @$data["totalrecs"];
    
            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            foreach ($data as $row) {
                $array[$i]["sn"] = $i + 1 ;
                $array[$i]["officename"] = $row->officename;
                $array[$i]["officeaddress"] = $row->officeaddress;
                $array[$i]["jobtype"] = $row->jobtype;
                $array[$i]["designation"] = $row->designation;
                $array[$i]["ranklabel"] = $row->ranklabel;
                $array[$i]["workingstatuslabel"] = $row->workingstatuslabel;
                $array[$i]["workingstatus"] = $row->workingstatus;
                $array[$i]["fromdatebs"] = $row->fromdatebs;
                $array[$i]["enddatebs"] = $row->enddatebs;
                $images = json_decode(@$row->document);
                $urls = '';
                if(!empty($images)){
                foreach (@$images as $image){
                    $urls .= '<a style="padding-left:10px;" title="'.@$image.'" href="'.asset('uploads/experience/' . @$image).'" download><i class="fa fa-download"></i></a>';
                }}
                $array[$i]["document"] = $urls;
                $action = "";
                // edit
                $action .= '<a href="javascript:;" class="editExperienceDetail" title="Edit Details" data-experiencedetail="' . $row->id . '"  data-user="' . $row->userid . '"  data-persional="'.$row->personalid.'"><i class="fa fa-edit fa-lg text-primary"></i></a>';
                // delete
                $action .= '&nbsp | &nbsp <a href="javascript:;" class="deleteExperienceDetail" title="Delete Details" data-experiencedetail="' . $row->id . '" data-user="' . $row->userid . '"  data-persional="'.$row->personalid.'"><i class="fa fa-trash fa-lg text-danger"></i></a>';
                $array[$i]["action"] = ((auth()->user()->is_submitted == 0) || (auth()->user()->is_submitted == 1 and auth()->user()->experience_enabled == 1)) ? $action : '';
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


    // delete experience details 
    public function deleteExperienceDetailsData (Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'experiencedetailid' => 'required|numeric'
            ], [
                'experiencedetailid.required' => "Couldn't delete detail.",
                'experiencedetailid.numeric' => "Couldn't delete detail."
            ]);
            if ($validate->fails()) {
                throw new Exception ($validate->errors()->first(), 1);
            }
            $this->message = 'Experience Details has been Deeted Successfully.';
            $post = $request->all();
            $result = Experience::deleteExperienceDetailsData($post);
            if (!$result) {
                throw new Exception ("Couldn't delete educaional detail.Please, try again.", 1);
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
}
