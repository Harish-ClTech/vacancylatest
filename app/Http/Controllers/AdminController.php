<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\{Auth, DB, Hash, Mail};
use App\Mail\ForgetPassword;
use App\Mail\VerifyEmail;
use App\Models\{User, Vacancy, Common, Applicant};
use Illuminate\Support\Str;
use Exception;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException; 
use Image;
use Validator;
use Carbon\Carbon;


class AdminController extends Controller
{
   
    protected $type;
    protected $message;
    protected $queryExceptionMessage;
    protected $response;


    // constructor
    public function __construct ()
    {
        $this->type = 'success';
        $this->message = 'Succefully Requested. Please check your registered mail for new Password.';
        $this->queryExceptionMessage = 'Something went wrong.Please, try again.';
        $this->response = false;
    }


    // show dashboard main page
    public function dashboard ()
    {
        $data = [];
        $personalIds = Common::getProfileIds();
        $personalId = !empty($personalIds->personalid) ? 1:0;
        $otherdetailId =!empty($personalIds->otherdetailid) ? 1:0;
        $contactId = !empty($personalIds->contactid) ? 1:0;
        $educationId = !empty($personalIds->educationid) ? 1:0;
        $experienceId = !empty($personalIds->experienceid) ? 1:0;
        $documentId = !empty($personalIds->documentid) ? 1:0;
        $trainingId = !empty($personalIds->trainingid) ? 1:0;
        $total = $personalId + $otherdetailId + $contactId +$educationId + $experienceId + $documentId +$trainingId;
        $data['updatePercentage'] = round(($total*100)/7);
        $today = Carbon::now()->toDateString();

        if ((session()->get('roleid') == 1)) {
            $totalTodayRecs = DB::table('apply_jobs AS AJ')
                ->join('applydetails AS AD', 'AJ.id', '=', 'AD.applymasterid')
                ->where('AJ.STATUS', '=', 'Y')
                ->where('AD.STATUS', '=', 'Y')
                ->whereDate('applieddatead', '=', $today)
                ->where('vacancycanceled', '=', 'N')
                ->count();

            $totalRecs = DB::table('apply_jobs AS AJ')
                ->join('applydetails AS AD', 'AJ.id', '=', 'AD.applymasterid')
                ->where('AJ.STATUS', '=', 'Y')
                ->where('AD.STATUS', '=', 'Y')
                ->where('vacancycanceled', '=', 'N')
                ->count();
                
            $totalPendingRecs = DB::table('apply_jobs AS AJ')
                ->join('applydetails AS AD', 'AJ.id', '=', 'AD.applymasterid')
                ->where('AJ.STATUS', '=', 'Y')
                ->where('AD.STATUS', '=', 'Y')
                ->where('appliedstatus', '=', 'Pending')
                ->where('vacancycanceled', '=', 'N')
                ->count();

            $totalRegisteredUsers = DB::table('users')
                ->where('STATUS', '=', 'Y')
                ->count();

            $data['totalTodayRecs'] = $totalTodayRecs;
            $data['totalRecs'] = $totalRecs;
            $data['totalPendingRecs'] = $totalPendingRecs;
            $data['totalRegisteredUsers'] = $totalRegisteredUsers;
            
            $data['newvac'] = Vacancy::getCurrentVacancy();
            // $data['appliedData'] = Common::getVacancywiseAppliedJobsDetails($post);
        }

        return view('admin.dashboard', $data);
        // return view('admin.layouts.admin_designs');
    }


    // show admin dashboard
    public function dashboardAdmin ()
    {
        try {
            if ((session()->get('roleid') != 1)) {
                return redirect()->route('login');
            }
    
            // if (auth()->user()->id != 4826) {
            //     return redirect()->route('login');
            // }
    
            $data = [];
            $data['summary']  = Applicant::getApplicantStatusSummary();  
            
            $staffdetails     = Applicant::getUserWiseApplicantStatus();
            $dataArray = [];
            foreach($staffdetails as $row){
                $dataArray[$row->id]['fullname'] = $row->username;
                $dataArray[$row->id]['contactnumber'] = $row->contactnumber;
                $dataArray[$row->id]['email'] = $row->email;
                $dataArray[$row->id]['userlevel'] = $row->userlevel;
                $dataArray[$row->id]['appliedstatus'][$row->appliedstatus] = $row->total;
            }
            $data['userdetails'] = $dataArray;
        } catch (QueryException $e) {
            $data = [];
        } catch (Exception $e) {
            $data = [];
        }
        return view('admin.applicant.dashboard', $data);
    }


    // show user dashboard
    public function dashboardDetails ()
    {
        try {
            $post = [];
            $post['userid'] = auth()->user()->id;
            $data['newvac'] = Vacancy::getCurrentVacancy();
            $data['appliedData'] = Common::getVacancywiseAppliedJobsDetails($post);

        } catch (QueryException $e) {
            $data = [];
        } catch (Exception $e) {
            $data = [];
        }
        return view('admin.dashboard', $data);
    }


    // show admin login page
    public function login ()
    {
        if (empty(session()->has('LoginSession'))) {
            return view('admin.auth.login');
        } else {
            return redirect()->route('dashboard');
        }
        return view('admin.auth.login');
    }
    
    
    // chack admin login details
    public function loginadmin (Request $request)
    {
        try{
            $post = $request->all();
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required'
            ], [
                'email.required' => 'Please enter email address.',
                'email.email' => 'Please enter valid email address.',
                'password.required' => 'Please enter password.'
            ]);

            $usersEmailCheck = DB::table('users')->where(['email'=>$post['email'], 'status'=>'Y'])->first();
            if (!empty($usersEmailCheck)) {
                if (auth()->attempt(['email' => $post['email'], 'password' => $post['password'], 'status' => 'Y'])) {
                    $response = url('/') . ('/dashboard');
                    $request->session()->put('LoginSession', $post['email']);
                    $roleid = DB::table('userroles')->select('roleid')->where('userid', auth()->user()->id)->first();
                    $userprofile = DB::table('profiles')->selectRaw("CONCAT_WS(' ',firstname, middlename, lastname) as username")->where('userid', auth()->user()->id)->first();
                    $personalIds = Common::getProfileIds();
                    session()->put([
                        'username'=> !empty($userprofile->username) ?$userprofile->username:'',
                        // 'userimage'=> !empty($userprofile->userimage) ? asset('adminAssets/uploads/document/photography/'.$userprofile->userimage) : asset('adminAssets/assets/media/avatars/300-1.jpg'),
                        'roleid'=> !empty($roleid) ?$roleid->roleid:'',
                        'personalid'=> !empty($personalIds) ?$personalIds->personalid:'',
                        'documentid'=> !empty($personalIds) ?$personalIds->documentid:'',
                        'otherdetailid'=> !empty($personalIds) ?$personalIds->otherdetailid:'',
                        'contactid'=> !empty($personalIds) ?$personalIds->contactid:'',
                        'experienceid'=> !empty($personalIds) ?$personalIds->experienceid:'',
                        'trainingid'=> !empty($personalIds) ?$personalIds->trainingid:'',
                        'educationid'=> !empty($personalIds) ?$personalIds->educationid:'',
                    ]);
                    session()->save();

                    return redirect('/dashboard')->with('success', 'Successfully logged in.');
                } else {
                    throw new Exception ('Oops ! Credentials doesnot match.', 1);
                }
            } else {
                throw new Exception('Oops ! User with this email doesnot exist.', 1);
            }

            if (empty($usersEmailCheck)) {
                return view('admin.auth.login')->with('error', 'Oops ! User with this email doesnot exist.');;
            }

            if (empty(session()->has('LoginSession'))) {
                return view('admin.auth.login');
            } else {
                return redirect()->route('dashboard');
            }
        }catch(QueryException $qe){
            return redirect()->back()->with('error', $this->queryExceptionMessage);
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    // logout
    public function logout ()
    {
        auth()->logout();
        session()->flush();
        return redirect('/');
    }


    // show user register page
    public function userRegister ()
    {
        if (session()->has('LoginSession')) {
            return redirect()->route('dashboard');
        }
        // if (date("Y-m-d H:i:s") > '2022-08-08 23:59:59') {
        //     return redirect()->route('login')->with('error', 'माफ गर्नुहोला ! हाल लाई नयाँ आवेदन दर्ता प्रकृया रोकिएको छ । कृपया अर्को सूचना प्रकाशित भए पश्चात पुन: प्रयास गर्नुहोला । धन्यबाद ।');
        // } 
        return view('admin.auth.register');
    }


    // refresh captcha
    public function refreshCaptcha ()
    {
        $rand_num = rand(1111, 9999);
        session()->put('captchavalue', $rand_num);
        $layer = imagecreatetruecolor(60, 30);
        $captcha_bg = imagecolorallocate($layer, 255, 160, 120);
        imagefill($layer, 0, 0, $captcha_bg);
        $captcha_text_color = imagecolorallocate($layer, 0, 0, 0);
        $img = imagestring($layer, 5, 5, 5, $rand_num, $captcha_text_color);
        header('Content-Type:image/jpeg');
        imagejpeg($layer);
    }


    // register user
    public function registerUser (Request $request)
    {
        try {
            $this->validate($request, [
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'gender' => 'required|string',
                'email' => 'required|email',
                'contactnumber' => 'required|numeric',
                'password' => 'required',
                'retypepassword' => 'required|same:password',
                'captcha' => 'required'
            ], [
                'firstname.required' => 'Please enter firstname.',
                'firstname.string' => 'Firstname must be characters only.',
                'lastname.required' => 'Please enter lastname.',
                'lastname.string' => 'Lastname must be characters only.',
                'gender.required' => 'Please choose gender name.',
                'gender.string' => 'Please choose gender name.',
                'email.required' => 'Please enter email address.',
                'email.email' => 'Please enter valid email address.',
                'contactnumber.required' => 'Please enter contact number.',
                'contactnumber.numeric' => 'Contact number must be numeric only.',
                'password.required' => 'Please enter password.',
                'captcha.required' => 'Please enter captcha.'
            ]);
            DB::beginTransaction();

            $post = $request->all();
            $filtereddata = sanitizeData ($post);
            if (session()->get('captchavalue') != $filtereddata['captcha']) {
                return redirect()->back()->with('flash_error', 'Captch does not match');
            }
            $usersCount = DB::table('users')->where('email', $filtereddata['email'])->count();
            if ($usersCount > 0) {
                return redirect()->back()->with('flash_error', 'Email Already Exists');
            }
            $otp = rand(000000, 999999);
            $userArray = [
                'email' => strtolower($filtereddata['email']),
                'password' => bcrypt($filtereddata['password']),
                'otp' => strval($otp)
            ];
            $userId = DB::table('users')->insertGetId($userArray);

            // $userresult = DB::table('profiles')->orderBy('userid', 'DESC')->first();
            // $userresult = DB::table('users')->orderBy('id', 'DESC')->first();
            // $newuserid = 1;
            // if (!empty($userresult)) {
            //     $newuserid = $userresult->id + 1;
            // }
            $profileArray = [
                'userid' => $userId,
                'firstname' => $filtereddata['firstname'],
                'lastname' => $filtereddata['lastname'],
                'middlename' => $filtereddata['middlename'],
                'gender' => $filtereddata['gender'],
                'contactnumber' => $filtereddata['contactnumber'],
                'email' => strtolower($filtereddata['email']),
                'createdatetime' => date('Y-m-d H:i:s')
            ];
            $profileId = DB::table('profiles')->insertGetId($profileArray);

            $personalArray = [
                'userid' => $userId,
                'efirstname' => $filtereddata['firstname'],
                'elastname' => $filtereddata['lastname'],
                'emiddlename' => $filtereddata['middlename'],
                'gender' => $filtereddata['gender'],
                'posteddatetime' => date('Y-m-d H:i:s')
            ];
            $personalId = DB::table('personals')->insertGetId($personalArray);
            $contactArray = [
                'personalid' => $personalId,
                'userid' => $userId,
                'mobilenumber' => $filtereddata['contactnumber'],
                'email' => strtolower($filtereddata['email']),
                'posteddatetime' => date('Y-m-d H:i:s')
            ];
            $contactId = DB::table('contactdetails')->insertGetId($contactArray);

            $userUpdate = DB::table('users')->where(['id'=>$userId])->update(['personalid'=>$personalId]);
            if(!$userUpdate)
                throw new Exception("Couldn't register User", 1);
            
            // $lastroleid = DB::table('userroles')->orderBy('id', 'DESC')->first()->id;

            $userRoleInsert = [
                'userid' => $userId,
                'roleid' => 2,
                'createdatetime' => date('Y-m-d H:i:s')
            ];

            Mail::to($filtereddata['email'])->send(new VerifyEmail($filtereddata['email'], $otp));

            // $userResponse = User::create($userArray);
            // $profileResponse = DB::table('profiles')->insert($profileArray);
            $isInserted = DB::table('userroles')->insert($userRoleInsert);
            if (!$isInserted) {
                throw new Exception ($this->queryExceptionMessage, 1);
            }
            $authenticated = Auth::login(User::findOrFail($userId));
            if ($authenticated) {
                session()->put('LoginSession', $userArray['email']);
                session()->put('roleid', 2);
            }
            DB::commit();
            return redirect()->route('verifyregisteredemail', ['email' => $filtereddata['email'], 'message' => 'OTP sent successfully. Please check your email.']);
        } catch (QueryException $e) {
            DB::rollback();
            return back()->with('failure', $this->queryExceptionMessage);
        } 
    }


    // show user verification page
    public function registerVerify ($email, $message) 
    {
        return view('admin.auth.verifyEmail', ['email' => $email, 'message' => $message]);
    }


    // verify registered using OTP
    public function registerVerifyOtp (Request $request) 
    {
        try {
            $this->validate($request, [
                'otp' => 'required'
            ], [
                'otp.required' => 'Please enter OTP.'
            ]);

            $user = User::where(['email' => $request->registeredemail, 'otp' => $request->otp])->first();

            if (empty($user)) {
                throw new Exception('Please, enter valid OTP.', 1);
            } else {
                $user->otp = NULL;
                $user->status = 'Y';
            }
            $result = $user->save();
            if (!$result) {
                throw new Exception ($this->queryExceptionMessage, 1);
            }
            return redirect()->route('dashboard');
        } catch (QueryException $e) {
            return back()->with('failure', $this->queryExceptionMessage);
        } catch (Exception $e) {
            return back()->with('failure', $e->getMessage());
        }
    }


    // update password 
    public function forgotPassword (Request $request)
    {
        if ($request->isMethod('post')) {
            try {
                $this->validate($request, [
                    'email' => 'required|email'
                ], [
                    'email.required' => 'Please provide email address.',
                    'email.email' => 'Please provide valid email address.'
                ]);
                $this->message = "Succefully Requested. Please check your registered mail for new Password.";
                DB::beginTransaction();
                $randompassword = Str::random(8);
                $useremail = $request->email;
                $password = Hash::make($randompassword);
                $user = User::where('email', $useremail)->first();
                if(empty($user)) {
                    throw new Exception('User does not exist.', 1);
                }
                $user->password = $password;
                $user->save();
                Mail::to($user->email)->send(new ForgetPassword($useremail, $randompassword));
                $this->response = route('storeProfile'); 

                DB::commit();
    
            } catch (QueryException $e) {
                DB::rollback();
                $this->type = 'error';
                $this->message = $this->queryExceptionMessage; 
            } catch (Exception $e) {
                DB::rollback();
                $this->type = 'error';
                $this->message = $e->getMessage(); 
            }
            echo json_encode(['type' => $this->type, 'message' => $this->message, 'url' => $this->response]);
            exit;
        }
        return view('admin.auth.forgotPassword');
    }
}
