<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Exception;
use Illuminate\Http\Request;
use Image;
use Validator;
use App\Models\Common;

use Auth;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{

    public function index(Request $request)
    {
        $post=$request->all();
        $document = Document::where('userid', auth()->user()->id)->first();

        $previousData=[];
        $userid = auth()->user()->id;
        $verifyInfoDetails = [];

        if(!empty($userid)){
            $tabledata=DB::table('documents')->where('userid', $userid)->first();

            $post['userid']    = $userid;
            $verifyInfoDetails = Common::checkJobApplyDetails($post);

            if($tabledata){
                $previousData=$tabledata;
            }
        }
        $data=[
            'previousData'=>@$previousData,
            'document' => $document,
            'verifydoctdetails'=>$verifyInfoDetails
        ];
        return view('admin.pages.document.viewdocumentsetup',$data);
    }

   /**
    * A function that is used to add school setup data.
    *
    * @param Request request The request object.
    */
    public function documentForm(Request $request)
    {
        $post = $request->all();

        return view('admin.pages.document.adddocumentsetup');
    }

    public function storeDocumentDetails(Request $request){
        try{
            $post=$request->all();

            $rules = [
                'photographys' => 'required',
                'citizenshipfronts' => 'required',
                'citizenshipbacks' => 'required',
                'signatures' => 'required'

                // 'inclusiongroupcertificateadibashi' => 'required',
                // 'inclusiongroupcertificatejanajati' => 'required',
                // 'inclusiongroupcertificatedalit' => 'required',
                // 'inclusiongroupcertificatepixadiyeko' => 'required',
            ];
            $messages = [
                'photographys.required' => 'तपाईले फोटो राख्नु भएको छैन |',
                'citizenshipfronts.required' => 'तपाईले नागरिकताको अगाडी भाग भर्नुभएको छैन |',
                'citizenshipbacks.required' => 'तपाईले नागरिकताको पछाडी भाग भर्नुभएको छैन |',
                'signatures.required' => 'तपाईले हस्तक्षयार भर्नुभएको छैन |'

                // 'inclusiongroupcertificateadibashi.required' => 'तपाईले आदिबाशी प्रमाणपत्र भर्नुभएको छैन |',
                // 'inclusiongroupcertificatejanajati.required' => 'तपाईले जनजाति प्रमाणपत्र भर्नुभएको छैन |',
                // 'inclusiongroupcertificatedalit.required' => 'तपाईले दलित प्रमाणपत्र भर्नुभएको छैन |',
                // 'inclusiongroupcertificatepixadiyeko.required' => 'तपाईले पिचडिएको प्रमाणपत्र भर्नुभएको छैन |',
            ];

            if(empty($post['documentdetailid'])){
                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails()) {
                    throw new Exception($validator->errors()->first(), 1);
                }
            }
           

            $type="success";
            $message="Document Details has been saved Successfully.";

            if ($request->hasFile('photographys')) {
                $image_tmp = $request->file('photographys');

                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = 'photographys' . rand(111, 99999) . '.' . $extension;
                    $image_path = public_path('uploads/document/photography/' . $filename);
                    Image::make($image_tmp)->save($image_path);
                    $post['photographys'] = $filename;
                }
            }

            if ($request->hasFile('citizenshipfronts')) {
                $image_tmp = $request->file('citizenshipfronts');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = 'citizenshipfronts' . rand(111, 99999) . '.' . $extension;
                    $image_path = public_path('uploads/document/citizenshipfront/' . $filename);
                    Image::make($image_tmp)->save($image_path);
                    $post['citizenshipfronts'] = $filename;
                }
            }
            if ($request->hasFile('citizenshipbacks')) {
                $image_tmp = $request->file('citizenshipbacks');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = 'citizenshipbacks' . rand(111, 99999) . '.' . $extension;
                    $image_path = public_path('uploads/document/citizenshipback/' . $filename);
                    Image::make($image_tmp)->save($image_path);
                    $post['citizenshipbacks'] = $filename;
                }
            }
            if ($request->hasFile('inclusiongroupcertificateadibashi')) {
                $image_tmp = $request->file('inclusiongroupcertificateadibashi');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = 'inclusiongroupcertificateadibashi' . rand(111, 99999) . '.' . $extension;
                    $image_path = public_path('uploads/document/inclusiongroupcertificate/' . $filename);
                    Image::make($image_tmp)->save($image_path);
                    $post['inclusiongroupcertificateadibashi'] = $filename;
                }
            }
            if ($request->hasFile('inclusiongroupcertificatejanajati')) {
                $image_tmp = $request->file('inclusiongroupcertificatejanajati');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = 'inclusiongroupcertificatejanajati' . rand(111, 99999) . '.' . $extension;
                    $image_path = public_path('uploads/document/inclusiongroupcertificate/' . $filename);
                    Image::make($image_tmp)->save($image_path);
                    $post['inclusiongroupcertificatejanajati'] = $filename;
                }
            }
            if ($request->hasFile('inclusiongroupcertificatedalit')) {
                $image_tmp = $request->file('inclusiongroupcertificatedalit');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = 'inclusiongroupcertificatedalit' . rand(111, 99999) . '.' . $extension;
                    $image_path = public_path('uploads/document/inclusiongroupcertificate/' . $filename);
                    Image::make($image_tmp)->save($image_path);
                    $post['inclusiongroupcertificatedalit'] = $filename;
                }
            }
            if ($request->hasFile('inclusiongroupcertificatepixadiyeko')) {
                $image_tmp = $request->file('inclusiongroupcertificatepixadiyeko');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = 'inclusiongroupcertificatepixadiyeko' . rand(111, 99999) . '.' . $extension;
                    $image_path = public_path('uploads/document/inclusiongroupcertificate/' . $filename);
                    Image::make($image_tmp)->save($image_path);
                    $post['inclusiongroupcertificatepixadiyeko'] = $filename;
                }
            }
            if ($request->hasFile('inclusiongroupcertificatemadesi')) {
                $image_tmp = $request->file('inclusiongroupcertificatemadesi');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = 'inclusiongroupcertificatemadesi' . rand(111, 99999) . '.' . $extension;
                    $image_path = public_path('uploads/document/inclusiongroupcertificate/' . $filename);
                    Image::make($image_tmp)->save($image_path);
                    $post['inclusiongroupcertificatemadesi'] = $filename;
                }
            }
            if ($request->hasFile('signatures')) {
                $image_tmp = $request->file('signatures');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = 'signatures' . rand(111, 99999) . '.' . $extension;
                    $image_path = public_path('uploads/document/signature/' . $filename);
                    Image::make($image_tmp)->save($image_path);
                    $post['signatures'] = $filename;
                }
            }


            // dd($post);
            $response=Document::storeDocumentDetails($post);

        }catch(Exception $e){
            $response=false;
            $type='error';
            $message=$e->getMessage();

        }
        echo json_encode(array('type'=>$type,'message'=>$message,'response'=>$response));

    }

}
