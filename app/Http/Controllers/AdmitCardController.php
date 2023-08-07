<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{AdmitCard, Common, Document};
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Exception;
use Validator;
use PDF;
use PDFMerger;
use Auth;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Barryvdh\Snappy\PdfWrapper;

use Image;
use File;
use Illuminate\Support\Facades\Response;

use function PHPUnit\Framework\throwException;

class AdmitCardController extends Controller
{
    
    protected $type;
    protected $message;
    protected $response;
    protected $queryExceptionMessage;


    // constructor
    public function __construct ()
    {
        $this->type = 'success';
        $this->message = 'प्रवेश पत्र सफलतापूर्वक लोड भयो ।';
        $this->response = false;
        $this->queryExceptionMessage = 'केही गडबड भयो। कृपया फेरि प्रयास गर्नुहोस् ।';
    }

    
    // show main page
    public function admitCard ()
    {
        try {
            $levels = DB::table('levels')->where('status','Y')->get();
            $designations = DB::table('designations')->where('status','Y')->orderBy('ordernumber', 'ASC')->get();
    
            $data = [
                'levels' => $levels,
                'designations' => $designations
            ];
        } catch (QueryException $e) {
            $data = [];
        } 
        return view('admin.admitcard.list',$data);
    }


    // get admit card
    public function getAdmitCard (Request $request)
    {
        try {
            $rules = [
                'designationid' => 'required|numeric',
                'vacancytype' => 'required'
            ];
            $messages = [
                'designationid.required' => 'पद छान्नुहोस् ।',
                'designationid.numeric' => 'पद छान्नुहोस् ।',
                'vacancytype.required' => 'रिक्तता प्रकार छान्नुहोस् ।'
            ];
            $validation = Validator::make($request->all(), $rules, $messages);
            
            if ($validation->fails()) 
                throw new Exception ($validation->errors()->first(), 1);
            
            $post = $request->all();
            $data = [
                'post' => $post
            ];
        } catch (Exception $e) {
            $data = [];
        }
        return view('admin.admitcard.usersdetaillist', $data);
    }


    // get admit cards in datatable
    public function getApplicantData (Request $request)
    {
        try {
            $post = $request->all();
            $post['userid'] = auth()->user()->id;
              
            $data = AdmitCard::getApplicantData($post);
            $i = 0;
            $array = array();
            $filtereddata = (@$data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : @$data["totalrecs"]);
            $totalrecs = @$data["totalrecs"];
    
            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);

            // $newArr = [];
            // foreach($data as $row){
            //     $newArr[$row->userid][$row->designationid][$row->isinternalvacancy] = $row;
            // }


            // foreach ($newArr as $userkey => $userrow) {
            //     foreach ($userrow as $degkey=>$degval) {
            //         foreach ($degval as $typekey=>$row) {
            //             $array[$i]["sn"] = $i + 1;
            //             $array[$i]["fullname"] = $typeval->fullname;
            //             $array[$i]["labelname"] = $typeval->labelname;
            //             $compType = (!empty($typeval->isinternalvacancy)&& $typeval->isinternalvacancy=='Y')?' (आ.प्र.) ':'';
            //             $array[$i]["designation"] = $typeval->designation.$compType;
            //             $array[$i]["appliedstatus"] = $typeval->appliedstatus;
        
            //             $action = "";
            //             $action .= ' <a href="javascript:;" title="प्रिन्ट कार्ड" class="printAdmitCard"  data-userid="' . $typeval->userid . '" data-isinternalvacancy="'.$typeval->isinternalvacancy.'"  data-designationid="'.$typeval->designationid.'" ><i class="fa fa-print fa-xl text-danger"> </i></a>';
            //             $array[$i]["action"] = $action;
            //             $i++;
            //         }
            //     }
            // }
            // $totalrecs =  $i;
            // $filtereddata = $i;

            // New Added
            $array = [];
            $i = 0;
            foreach ($data as $row) {
                $array[$i]["sn"] = $i + 1;
                $array[$i]["fullname"] = $row->nepalifullname;
                $array[$i]["labelname"] = $row->labelname;
                $compType = (!empty($row->isinternalvacancy)&& $row->isinternalvacancy == 'Y')?' (आ.प्र.) ':' (खुला प्र.)';
                $array[$i]["designation"] = $row->designationtitle . $compType;
                $array[$i]["symbolnumber"] = !empty($row->symbolnumber) ? $row->symbolnumber : '-';

                $action = "";
                $action .= ' <a href="javascript:;" title="प्रिन्ट कार्ड" class="printAdmitCard"  data-userid="' . $row->userid . '" data-isinternalvacancy="'.$row->isinternalvacancy.'"  data-designationid="'.$row->designationid.'" ><i class="fa fa-print fa-xl text-danger"> </i></a>';
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


    // print all admit card (PDF)
    public function printAdmitCard (Request $request)
    {
        try {
            $post = $request->all();
            $newArray = [];
            $dataArray = AdmitCard::printAdmitCard($post);  
            $signatureSetupInfo = DB::table('signature_setups')->where(['status'=>'Y'])->first();
            $authorizedOfficer = '';
            $authorizedDesignation = '';
            $authorizedSignatureSrc = '';
            $signatureDate = '';
            if(!empty($signatureSetupInfo)){
                $authorizedOfficer =  $signatureSetupInfo->fullname;
                $authorizedDesignation =  $signatureSetupInfo->designation;
                $signatureDate =  $signatureSetupInfo->signaturedate;
                $authorizedSignatureSrc = asset('uploads/signaturesetup').'/'.@$signatureSetupInfo->signature;
            }
            $levelArray = [ '1'=> 'प्रथम', '2'=> 'दोश्रो', '3'=> 'तेश्रो', '4'=> 'चाैथो', '5'=> 'पाँचौं', '6'=> 'छैटौं', '7'=> 'सातौं', '8'=> 'आठौं', '9'=> 'नवौं'];  
            ini_set('memory_limit', '-1');
            ini_set('max_execution_time', 1800); 

            $folderpath = storage_path("app/pdf/");
            $merged_path = '';
            
            $designation_title ='';
            if (!empty($dataArray)) {
                $designation_title = $dataArray[0]->designation;
                $merged_path = $folderpath."merged/".$designation_title;
               
                // if(!empty($fileArray = glob( "$merged_path/*.pdf"))){
                //     return response()->download($fileArray[0]);
                // }
                foreach ($dataArray as $value) {
                    $newArray[$value->userid]['userid']=$value->userid;
                    $newArray[$value->userid]['fullname']=$value->fullname;
                    $newArray[$value->userid]['signature']=$value->signature;
                    $newArray[$value->userid]['citizenshipfront']=$value->citizenshipfront;
                    $newArray[$value->userid]['citizenshipback']=$value->citizenshipback;
                    $newArray[$value->userid]['photography']=$value->photography;
        
                    $newArray[$value->userid]['cropped_signature']=$value->cropped_signature;
                    $newArray[$value->userid]['cropped_citizenshipfront']=$value->cropped_citizenshipfront;
                    $newArray[$value->userid]['cropped_citizenshipback']=$value->cropped_citizenshipback;
                    $newArray[$value->userid]['cropped_photograph']=$value->cropped_photograph;
        
                    $newArray[$value->userid]['registrationnumber']=$value->registrationnumber;
                    $newArray[$value->userid]['appliedstatus']=$value->appliedstatus;
                    $newArray[$value->userid]['designationid']=$value->designationid;
                    $compType = (!empty($value->isinternalvacancy)&& $value->isinternalvacancy=='Y')?' (आ.प्र.) ':'';
                    $newArray[$value->userid]['designation']=$value->designation.$compType;
                    $newArray[$value->userid]['labelname']=!empty($value->labelname)?$levelArray[$value->labelname]:'';
                    $newArray[$value->userid]['servicegroupname']=$value->servicegroupname;
                    $newArray[$value->userid]['rollnumber']=$value->symbolnumber;
                    $newArray[$value->userid]['examcentername']=$value->examcentername;
                    $newArray[$value->userid]['authorizedOfficer'] = $authorizedOfficer;
                    $newArray[$value->userid]['authorizedDesignation'] = $authorizedDesignation;
                    $newArray[$value->userid]['authorizedSignatureSrc'] = $authorizedSignatureSrc;
                    $newArray[$value->userid]['signatureDate'] = $signatureDate;
                    $newArray[$value->userid]['job'][$value->designation][$value->vacancynumber]= $value->jobcategoryname;
                    // $data['results'] = $newArray;
                    // $dataView['data'][] = view('admin.admitcard.printadmitcard', $data);
                }

             
                $data['results'] = $newArray;
                $dataView['data']= view('admin.admitcard.printadmitcard', $data);
                return view('admin.admitcard.newadmitcard', ['data' => $dataView]);
                
                $perPage = 100; // Number of records per page
                $currentPage = 1; // Initial page
                
              

                array_map('unlink', glob("$folderpath/*.pdf")); // delete previously generated files for selected designation before creating new file

                $chunkArray = array_chunk($newArray, $perPage);
               
                foreach ($chunkArray as $chunk) {
                    // Render view with current chunk data
                    $dataView = [];
                    $data['results'] = $chunk;
                    $dataView['data']= view('admin.admitcard.printadmitcard', $data);
                    // dd($dataView);
                    
                    $view = view('admin.admitcard.newadmitcard', ['data' => $dataView])->render();

                    // Generate PDF for current chunk
                    $pdf = PDF::loadHTML($view);
                    if (!file_exists($folderpath)) {
                        mkdir($folderpath, 0777, true);
                    }
                    
                    $pdf->save($folderpath."admitcard_pdf_".rand(0001,999999999)."{$currentPage}.pdf");
                    $currentPage++;
                }
                $pdf_files = glob($folderpath.'*.pdf'); // Get all PDF files

                //instance of pdfmerger - this will merge all multiple pdf files 
                $pMerge = PDFMerger::init();
                foreach($pdf_files as $pf){
                    $pMerge->addPDF($pf, 'all');
                }

                $pMerge->merge();
                array_map('unlink', glob("$merged_path/*.pdf")); // delete previously generated files for selected designation before creating new file
                if (!file_exists($merged_path)) {
                    mkdir($merged_path, 0777, true);
                }

                $pMerge->save($merged_path."/merged_admitcard_pdf_".rand(0001,999999999)."{$currentPage}.pdf");
                $pMerge->stream();

                // $pdf = PDF::loadView('admin.admitcard.newadmitcard', $dataView);   
                // $pdf->setOption('disable-javascript', true);
                // $pdf->setOption('enable-local-file-access', true);
                // $pdf->setOption('orientation', 'portrait');
                // $pdf->setOption('keep-relative-links', true); 
                // $pdf->setOption('enable-external-links', true);
                // $pdf->setOption('enable-internal-links', true);
                // $filename = "AdmitCard.pdf";
                // return $pdf->stream($filename, array('Attachment' => 0));


                // return view('admin.admitcard.newadmitcard', $dataView);
    
            } else {
                return back()->with('error', 'माफ गर्नुहोला ! तपाईले छान्नु भएको पदको लागि कुनै पनि डाडा भेटिएन ।');
            }
        } catch (QueryException $e) {
            return back()->with('error', 'माफ गर्नुहोला ! तपाईले छान्नु भएको पदको लागि कुनै पनि डाडा भेटिएन ।');
        }
    }


    public function getCropModal()
    {
        return view('admin.pages.preview.imageCropModal');
    }


    public function updateImage(Request $request)
    {
        try {
            $post = $request->all();
            
            $status = Document::updateCroppedImage($post);
            if (!$status) {
                throw new Exception('माफ गर्नुहोला Image अपडेट हुन सकेन । कृपया पुन: प्रयास गर्नुहोला ।.', 1);
            }
        } catch (QueryException $qe) {
            $this->type = 'error';
            $this->queryExceptionMessage;
        } catch (Exception $e) {
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }
}

