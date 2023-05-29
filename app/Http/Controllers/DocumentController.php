<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Document, Common};
use Illuminate\Support\Facades\DB;
use App\Traits\ImageProcessTrait;
use Exception;
use Illuminate\Database\QueryException;
use Image;
use File;
use Validator;
use Auth;

class DocumentController extends Controller
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
        $this->message = 'Document Details Saved Successfully.';
        $this->response = false;
        $this->queryExceptionMessage = "Something went wrong.Please, try again.";
    }


    // show main page
    public function index (Request $request)
    {
        try {
            $post = $request->all();
            $document = Document::where('userid', auth()->user()->id)->first();
            $previousData = [];
            $userid = auth()->user()->id;
            $verifyInfoDetails = [];
    
            if (!empty($userid)) {
                $tabledata = DB::table('documents')->where('userid', $userid)->first();
                $post['userid']    = $userid;
                $verifyInfoDetails = Common::checkJobApplyDetails($post);
                if ($tabledata) {
                    $previousData = $tabledata;
                }
            }
            $data = [
                'previousData' => @$previousData,
                'document' => $document,
                'verifydoctdetails' => $verifyInfoDetails
            ];
        } catch (QueryException $e) {
            $data = [];
        } catch (Exception $e) {
            $data = [];
        }
        return view('admin.pages.document.viewdocumentsetup', $data);
    }

    
    // store document details
    public function storeDocumentDetails (Request $request)
    {
        try {
            $post = $request->all();
            $rules = [
                'photographys' => 'required',
                'citizenshipfronts' => 'required',
                'citizenshipbacks' => 'required',
                'signatures' => 'required'
            ];
            $messages = [
                'photographys.required' => 'तपाईले फोटो राख्नुभएको छैन |',
                'citizenshipfronts.required' => 'तपाईले नागरिकताको अगाडी भाग भर्नुभएको छैन |',
                'citizenshipbacks.required' => 'तपाईले नागरिकताको पछाडी भाग भर्नुभएको छैन |',
                'signatures.required' => 'तपाईले हस्तक्षयार भर्नुभएको छैन |'
            ];

            if (empty($post['documentdetailid'])) {
                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails()) {
                    throw new Exception($validator->errors()->first(), 1);
                }
            }

            if(empty($post['back_photographys'] || $post['back_citizenshipfronts'] || $post['citizenshipbacks'] ||  $post['signatures'])){
                $post['back_photographys'] = null;
                $post["back_citizenshipfronts"] = null;
                $post["back_citizenshipbacks"] = null;
                $post["back_inclusiongroupcertificateadibashi"] = null;
                $post["back_inclusiongroupcertificatejanajati"] = null;
                $post["back_inclusiongroupcertificatedalit"] = null;
                $post["back_inclusiongroupcertificatepixadiyeko"] = null;
                $post["back_inclusiongroupcertificatemadesi"] = null;
                $post["back_signatures"] = null;
            }

            // photography
            if ($request->hasFile('photographys')) {
                $image_tmp = $request->file('photographys');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $name = auth()->user()->id.'photographys' . rand(111, 99999);
                    $filename = $name . '.' . $extension;
                    $imagesize = $image_tmp->getSize();
                    if ($imagesize/1024 > 1024) {
                        throw new Exception("Image size greater than 1 MB", 1);
                    }
                    $folder = 'uploads/document/photography/';
                    if (strtolower($extension) == 'jpg'|| strtolower($extension) == 'jpeg') {
                        $this->uploadImage($image_tmp, $folder, $name);
                        $post['photographys'] = $filename;
                    } else {
                        throw new Exception("Please upload the JPG/JPEG File. ", 1);
                    }
                }
            }
           
            // citizenship front
            if ($request->hasFile('citizenshipfronts')) {
                $image_tmp = $request->file('citizenshipfronts');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $name = auth()->user()->id.'citizenshipfronts' . rand(111, 99999);
                    $filename = $name . '.' . $extension;
                    $folder = 'uploads/document/citizenshipfront/';
                    $imagesize = $image_tmp->getSize();
                    if ($imagesize/1024 > 1024) {
                        throw new Exception("Image size greater than 1 MB", 1);
                    }
                    if (strtolower($extension) == 'jpg' || strtolower($extension) == 'jpeg') {
                        $this->uploadImage($image_tmp, $folder, $name);
                        $post['citizenshipfronts'] = $filename;
                    } else {
                        throw new Exception("Please upload the JPG/JPEG File. ", 1);
                    }
                }
            }

            // citizenship back
            if ($request->hasFile('citizenshipbacks')) {
                $image_tmp = $request->file('citizenshipbacks');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $name = auth()->user()->id.'citizenshipbacks' . rand(111, 99999);
                    $filename = $name . '.' . $extension;
                    $folder = 'uploads/document/citizenshipback/';
                    $imagesize = $image_tmp->getSize();
                    if ($imagesize/1024 > 1024){
                        throw new Exception("Image size greater than 1 MB", 1);
                    }
                    if (strtolower($extension) == 'jpg' || strtolower($extension) == 'jpeg') {
                        $this->uploadImage($image_tmp, $folder, $name);
                        $post['citizenshipbacks'] = $filename;
                    } else {
                        throw new Exception("Please upload the JPG/JPEG File. ", 1);
                    }
                }
            }

            // signature
            if ($request->hasFile('signatures')) {
                $image_tmp = $request->file('signatures');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $name = auth()->user()->id.'signatures' . rand(111, 99999);
                    $filename = $name . '.' . $extension;
                    $folder = 'uploads/document/signature/';
                    $imagesize = $image_tmp->getSize();

                    if ($imagesize/1024 >1024) {
                        throw new Exception("Image size greater than 1 MB", 1);
                    }
                    if (strtolower($extension) == 'jpg' || strtolower($extension) == 'jpeg') {
                        $this->uploadImage($image_tmp, $folder, $name);
                        $post['signatures'] = $filename;
                    } else {
                        throw new Exception("Please upload the JPG/JPEG File. ", 1);
                    }
                }
            }

            // inclusion group certificate (ADIBASHI)
            if ($request->hasFile('inclusiongroupcertificateadibashi')) {
                $image_tmp = $request->file('inclusiongroupcertificateadibashi');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $name = auth()->user()->id.'inclusiongroupcertificateadibashi' . rand(111, 99999);
                    $filename = $name  . '.' . $extension;
                    $folder = 'uploads/document/inclusiongroupcertificate/';
                    $imagesize = $image_tmp->getSize();
                    if ($imagesize/1024 > 1024) {
                        throw new Exception("Image size greater than 1 MB", 1);
                    }
                    if (strtolower($extension) == 'jpg' || strtolower($extension) == 'jpeg') {
                        $this->uploadImage($image_tmp, $folder, $name);
                        $post['inclusiongroupcertificateadibashi'] = $filename;
                    } else {
                        throw new Exception("Please upload the JPG/JPEG File. ", 1);
                    }
                }
            }

            // inclusion group certificate (JANAJATI)
            if ($request->hasFile('inclusiongroupcertificatejanajati')) {
                $image_tmp = $request->file('inclusiongroupcertificatejanajati');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $name = auth()->user()->id.'inclusiongroupcertificatejanajati' . rand(111, 99999);
                    $filename = $name  . '.' . $extension;
                    $folder = 'uploads/document/inclusiongroupcertificate/';
                    $imagesize = $image_tmp->getSize();
                    if ($imagesize/1024 > 1024) {
                        throw new Exception("Image size greater than 1 MB", 1);
                    }
                    if (strtolower($extension) == 'jpg' || strtolower($extension) == 'jpeg') {
                        $this->uploadImage($image_tmp, $folder, $name);
                        $post['inclusiongroupcertificatejanajati'] = $filename;
                    } else {
                        throw new Exception("Please upload the JPG/JPEG File. ", 1);
                    }
                }
            }

            // inclusion group certificate (DALIT)
            if ($request->hasFile('inclusiongroupcertificatedalit')) {
                $image_tmp = $request->file('inclusiongroupcertificatedalit');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $name = auth()->user()->id.'inclusiongroupcertificatedalit' . rand(111, 99999);
                    $filename = $name  . '.' . $extension;
                    $folder = 'uploads/document/inclusiongroupcertificate/';
                    $imagesize = $image_tmp->getSize();
                    if ($imagesize/1024 > 1024) {
                        throw new Exception("Image size greater than 1 MB", 1);
                    }
                    if (strtolower($extension) == 'jpg' || strtolower($extension) == 'jpeg'){
                        $this->uploadImage($image_tmp, $folder, $name);
                        $post['inclusiongroupcertificatedalit'] = $filename;
                    } else {
                        throw new Exception("Please upload the JPG/JPEG File. ", 1);
                    }
                }
            }

            // inclusion group certificate (PIXADIYEKO)
            if ($request->hasFile('inclusiongroupcertificatepixadiyeko')) {
                $image_tmp = $request->file('inclusiongroupcertificatepixadiyeko');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $name = auth()->user()->id.'inclusiongroupcertificatepixadiyeko' . rand(111, 99999);
                    $filename = $name  . '.' . $extension;
                    $folder = 'uploads/document/inclusiongroupcertificate/';
                    $imagesize = $image_tmp->getSize();
                    if ($imagesize/1024 > 1024) {
                        throw new Exception("Image size greater than 1 MB", 1);
                    }
                    if (strtolower($extension) == 'jpg' || strtolower($extension) == 'jpeg'){
                        $this->uploadImage($image_tmp, $folder, $name);
                        $post['inclusiongroupcertificatepixadiyeko'] = $filename;
                    } else {
                        throw new Exception("Please upload the JPG/JPEG File. ", 1);
                    }
                }
            }

            // inclusion group certificate (MADESI)
            if ($request->hasFile('inclusiongroupcertificatemadesi')) {
                $image_tmp = $request->file('inclusiongroupcertificatemadesi');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $name = auth()->user()->id.'inclusiongroupcertificatemadesi' . rand(111, 99999);
                    $filename = $name  . '.' . $extension;
                    $folder = 'uploads/document/inclusiongroupcertificate/';
                    $imagesize = $image_tmp->getSize();
                    if ($imagesize/1024 > 1024) {
                        throw new Exception("Image size greater than 1 MB", 1);
                    }
                    if (strtolower($extension) == 'jpg' || strtolower($extension) == 'jpeg'){
                        $this->uploadImage($image_tmp, $folder, $name);
                        $post['inclusiongroupcertificatemadesi'] = $filename;
                    } else {
                        throw new Exception("Please upload the JPG/JPEG File. ", 1);
                    }
                }
            }

            // inclusion group certificate (MADESI)
            if ($request->hasFile('inclusiongroupcertificateapanga')) {
                $image_tmp = $request->file('inclusiongroupcertificateapanga');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $name = auth()->user()->id.'inclusiongroupcertificateapanga' . rand(111, 99999);
                    $filename = $name  . '.' . $extension;
                    $folder = 'uploads/document/inclusiongroupcertificate/';
                    $imagesize = $image_tmp->getSize();
                    if ($imagesize/1024 > 1024) {
                        throw new Exception("Image size greater than 1 MB", 1);
                    }
                    if (strtolower($extension) == 'jpg' || strtolower($extension) == 'jpeg'){
                        $this->uploadImage($image_tmp, $folder, $name);
                        $post['inclusiongroupcertificateapanga'] = $filename;
                    } else {
                        throw new Exception("Please upload the JPG/JPEG File. ", 1);
                    }
                }
            }
            
            $result = Document::storeDocumentDetails($post);
            if (!$result) {
                throw new Exception ("Couldn't save document details.Please, try again.", 1);
            }
        // } catch (QueryException $e) {
        //     $this->type = 'error';
        //     $this->message = $this->queryExceptionMessage;
        } catch (Exception $e){
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }


    public function imageInfo(Request $request)
    {
        $post = $request->all();
        $data = [];
        if(!empty($post['image_type'])){
            if($post['image_type'] == 'photograph'){
                $data['image_path'] = asset('adminAssets/assets/images/samples/photograph.png');
                $data['description'] = "<ul> उदाहरणमा देखाए जस्तै आफ्नो फोटो अपलोड गर्दा निम्न कुराहरुमा ध्यान दिनुहोला । 
                                            <li> - फोटोको लम्बाई: ४.५ से.मी. र चाैडाई: ३.५ से.मी. हुनुपर्ने छ । </li>
                                            <li> - फोटोको साईज 1mb भन्दा कमको हुनुपर्ने छ । </li>
                                            <li> - फाईलको प्रकार jpg/png/pdf हुनुपर्ने छ । </li>
                                        </ul>";
            }
            else if($post['image_type'] == 'citizenship_front'){
                $data['image_path'] = asset('adminAssets/assets/images/samples/citizenship_front.png');
                $data['description'] = "<ul> उदाहरणमा देखाए जस्तै आफ्नो नागरिकताको अगाडीको भागको  अपलोड गर्दा निम्न कुराहरुमा ध्यान दिनुहोला
                                            <li> - फोटोको लम्बाई: ५.९८ से.मी. र चाैडाई: ८.०५ से.मी. हुनुपर्ने छ । </li>
                                            <li> - फोटोको साईज 1mb भन्दा कमको हुनुपर्ने छ । </li>
                                            <li> - फाईलको प्रकार jpg/png/pdf हुनुपर्ने छ । </li>
                                        </ul>
                                        ";
            }
            else if($post['image_type'] == 'citizenship_back'){
                $data['image_path'] = asset('adminAssets/assets/images/samples/citizenship_back.png');
                $data['description'] = "<ul>login
                                            <li>उदाहरणमा देखाए जस्तै, आफ्नो नागरिकताको पछाडीको भागको फोटो अपलोड गर्दा फोटोको लम्बाई: ५.९८ से.मी. र चाैडाई: ८.०५ से.मी. हुनुपर्ने छ । </li> 
                                        </ul>";
            }
            else if($post['image_type'] == 'signature'){
                $data['image_path'] = asset('adminAssets/assets/images/samples/signature.png');
                $data['description'] = "<ul> 
                                            <li>उदाहरणमा देखाए जस्तै, आफ्नो हस्ताक्षरको फोटो अपलोड गर्दा फोटोको लम्बाई: २.२२ से.मी. र चाैडाई: ४.२३ से.मी. हुनुपर्ने छ । </li>
                                        </ul>";
            }
        }
        return view('admin.pages.document.imageInfo', $data);
    }
}