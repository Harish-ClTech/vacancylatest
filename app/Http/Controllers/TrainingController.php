<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Training, Common};
use App\Traits\ImageProcessTrait;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\QueryException;
use Image;
use Validator;

class TrainingController extends Controller
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
        $this->message = 'Training Details Saved Successfully.';
        $this->response = false;
        $this->queryExceptionMessage = "Something went wrong.Please, try again.";
    }


    // show main page
    public function index ()
    {
        return view('admin.pages.training.viewtrainingsetup');
    }


    // show training form
    public function trainingForm (Request $request)
    {
        try {
            $post = $request->all();
            $personalDetailsId = DB::table('personals')->select('id')->where('userid', auth()->user()->id)->first()->id;
            if (!empty(@$post['trainingdetailid'])) {
                $previousData = Training::previousAllData($post);
            }
            $data = [
                'previousData' => @$previousData,
                'saveurl' => route('storeTrainingDetails'),
                'personalid' => @$personalDetailsId
            ];
             
        } catch (QueryException $e) {
            $data = [];
        } catch (Exception $e) {
            $data = [];
        }
        return view('admin.pages.training.addtrainingsetup', $data);
    }


    // store training details 
    public function storeTrainingDetails (Request $request)
    {
        try {
            $post = $request->all();
            $rules = [
                'trainingproviderinstitutionalname' => 'required|string',
                'trainingname' => 'required|string',
                'fromdatebs' => 'required',
                'enddatebs' => 'required'
            ];
            $messages = [
                'trainingproviderinstitutionalname.required' => 'तपाईले प्रशिक्षण प्रदायक संस्थाको नाम भर्नुभएको छैन |',
                'trainingproviderinstitutionalname.string' => 'तपाईले प्रशिक्षण प्रदायक संस्थाको नाम भर्नुभएको छैन |',
                'trainingname.required' => 'तपाईले तालिमको नाम भर्नुभएको छैन |',
                'trainingname.string' => 'तपाईले तालिमको नाम भर्नुभएको छैन |',
                'fromdatebs.required' => 'तपाईले तालिम सुरू भएको मिति भर्नुभएको छैन |',
                'enddatebs.required' => 'तपाईले तालिम अन्त्य भएको मिति भर्नुभएको छैन |',
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
                    $originalFilename = explode('.', $file->getClientOriginalName())[0];
                    $current = date('Ymd');
                    $folder = 'uploads/training/';
                    $name = auth()->user()->id.$originalFilename . '-' . $current . '-' . rand(111, 99999);
                    $filename = $name. '.' . $extension;

                    $imagesize = $file->getSize();
                    if (strtolower($extension) == 'jpg' || strtolower($extension) == 'jpeg' || strtolower($extension) == 'png' || strtolower($extension) == 'pdf') {
                        $this->uploadImage($file, $folder, $name);
                        $post['documents'][$id] = $filename;
                    } else {
                        throw new Exception("तालिमको प्रमाणपत्रको फाईल प्रकार jpeg,jpg,png,pdf हुनु पर्नेछ । ", 1);
                    } 
                    
                    if ($imagesize/1024 > 1024) {
                        throw new Exception("तालिमको प्रमाणपत्रको फाईल साइज अधिकतम 1 mb हुनु पर्नेछ ।", 1);
                    }
                }
            }
            $filtereddata['documents'] = $post['documents'];
            $filtereddata['back_document'] = $request->back_document;
            $filtereddata['userid'] = auth()->user()->id;
            $result = Training::storeTrainingDetails($filtereddata);
            if (!$result) {
                throw new Exception ("Couldn't save information.Please, try again.", 1);
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


    // get traingin details data in datatable
    public function getTrainingDetailsData (Request $request)
    {
        try {
            $post = $request->all();
            $post['userid'] = auth()->user()->id;
            $data = Training::getTrainingDetailsData($post);
            $i = 0;
            $array = array();
            $filtereddata = (@$data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : @$data["totalrecs"]);
            $totalrecs = @$data["totalrecs"];
    
            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
    
    
            $verifyInfoDetails = Common::checkJobApplyDetails($post);
            
            foreach ($data as $row) {
                $array[$i]["sn"] = $i + 1;
                $array[$i]["trainingproviderinstitutionalname"] = $row->trainingproviderinstitutionalname;
                $array[$i]["trainingname"] = $row->trainingname;
                $array[$i]["gradedivisionpercent"] = $row->gradedivisionpercent;
                $array[$i]["fromdatebs"] = $row->fromdatebs;
                $array[$i]["enddatebs"] = $row->enddatebs;
                $images = json_decode(@$row->document);
                $urls = '';
                if (!empty($images)) {
                    foreach ($images as $image){
                        $urls .= '<a style="padding-left:10px;" title="'.@$image.'" href="'.asset('uploads/training/' . @$image).'" download><i class="fa fa-download"></i></a>';
                    }
                }
                $array[$i]["document"] = $urls;
                $action = "";
               
                // edit
                $action .= '<a href="javascript:;" class="editTrainingDetail" title="Edit Detail" data-trainingdetail="' . $row->id . '"  data-user="' . $row->userid . '"  data-persional="' . $row->personalid . '"><i class="fa fa-edit fa-lg text-primary"></i></a>';
                
                // delete
                $action .= ' | <a href="javascript:;" class="deleteTrainingDetail"  title="Delete Detail" data-trainingdetail="' . $row->id . '" data-user="' . $row->userid . '"  data-persional="' . $row->personalid . '"><i class="fa fa-trash fa-lg text-danger"></i></a>';
                $array[$i]["action"] = ((auth()->user()->is_submitted == 0) || (auth()->user()->is_submitted == 1 and auth()->user()->training_enabled == 1)) ? $action : '';
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


    // delete training details
    public function deleteTrainingDetailsData (Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                    'trainingdetailid' => 'required|numeric'
                ], [
                    'trainingdetailid.required' => "Couldn't delete detail.",
                    'trainingdetailid.numeric' => "Couldn't delete detail."
                ]);
            if ($validate->fails()) {
                throw new Exception ($validate->errors()->first(), 1);
            }
            $this->message = 'Training Details has been Deeted Successfully.';
            $post = $request->all();
            $result = Training::deleteTrainingDetailsData($post);
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