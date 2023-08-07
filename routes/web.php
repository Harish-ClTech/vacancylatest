<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplyJobsController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\ContactDetailsController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ExtradetailController;
use App\Http\Controllers\OtherdetailsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\SignatureSetupController;
use App\Http\Controllers\AdmitCardController;
use App\Http\Controllers\ApplicantProfileController;
use App\Http\Controllers\ExamCenterController;
use App\Http\Controllers\SymbolNumberController;
use App\Http\Controllers\VacancyDateMasterController;
use PhpParser\Node\Expr;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::prefix('/')->group(function () {
    // =========================================Login=======================================================
    Route::match(['get', 'post'], '/', [AdminController::class, 'login'])->name('login');
//    Route::match(['get', 'post'], '/login', [AdminController::class, 'login'])->name('login');
    Route::post('/adminlogin', [AdminController::class, 'loginadmin'])->name('loginadmin');
    Route::get('/register', [AdminController::class, 'userRegister'])->name('userRegister');
    Route::any('register/user', [AdminController::class, 'registerUser'])->name('registerUser');
    Route::get('/register/otp/{email}/{message}', [AdminController::class, 'registerVerify'])->name('verifyregisteredemail');
    Route::post('/register/otp/verify', [AdminController::class, 'registerVerifyOtp'])->name('verifyRegisterUserOtp');
    Route::get('refresh_captcha', [AdminController::class, 'refreshCaptcha'])->name('refresh_captcha');
    // =========================================Forgot password====================================================================
    Route::match(['get', 'post'], '/forgotPassword', [AdminController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/register/otp/resend', [AdminController::class, 'resendOtp'])->name('resendOtp');

    // =========================================End Login=======================================================

    Route::group(['middleware' => ['auth']], function () {
        // ========================================== Begin:Admit Card ======================================================
        Route::match(['get', 'post'],'/admit-card', [AdmitCardController::class, 'admitCard'])->name('admitcard');
        Route::match(['get', 'post'],'/getadmitcartusers', [AdmitCardController::class, 'getAdmitCard']);
        Route::match(['get', 'post'],'/admit-card/getapplicant', [AdmitCardController::class, 'getApplicantData']);
        Route::match(['get', 'post'], '/admit-card/print', [AdmitCardController::class, 'printAdmitCard'])->name('printAdmitCard');
        Route::post('/updateimage', [AdmitCardController::class, 'updateImage'])->name('updateImage');
        Route::get('/getcropmodal', [AdmitCardController::class, 'getCropModal'])->name('getCropModal');
        // Route::get('/updateimage', [AdmitCardController::class, 'updateImage'])->name('updateImage');
        // ========================================== End:Admit Card========================================================


	// =========================================Vacancy Criteria Validator =======================================================
        Route::get('checkVacancy/{id}', [ApplyJobsController::class, 'vacancyCriteriaValidator']);
        // =========================================End Vacancy Criteria Validator =======================================================

        // ========================================= Module Access Modifier =======================================================
        Route::get('accessModifier/{name}/{value}', [ApplicantController::class, 'accessChanger']);
	Route::post('requestAccess', [ApplicantController::class, 'requestAccess']);
        // =========================================End Module Access Modifier =======================================================

        // =========================================Dashboard==========================================================
        Route::match(['get', 'post'], '/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/dashboardDetails', [AdminController::class, 'dashboardDetails'])->name('dashboardDetails');
	Route::any('/dashboardpfadminpsup', [AdminController::class, 'dashboardAdmin'])->name('dashboardAdmin');

        // =========================================End Dashboard=======================================================

        // =========================================Personal Setup==========================================================
        Route::match(['post'], '/personal', [PersonalController::class, 'personalForm'])->name('personal');
        Route::match(['get', 'post'], '/storepersonal/details', [PersonalController::class, 'storePersonalDetails'])->name('storePersonalDetails');
    //    Route::match(['post'], '/date/convert/bs', [PersonalController::class, 'dateConversion'])->name('dateConvert');
	Route::match(['post'], '/date/convert/ad', [PersonalController::class, 'getEnglishDate'])->name('convertdate');

        // =========================================End Personal Setup=======================================================

        // =========================================Other Personal Setup==========================================================
        Route::match(['post'], '/otherdetailForm', [ExtradetailController::class, 'otherdetailForm'])->name('otherdetailForm');
        Route::post('/otherdetail/store', [ExtradetailController::class, 'storeExtraDetailsData'])->name('storeExtraDetailsData');
        // =========================================Other Personal Setup==========================================================

       // ========================================== Begin:Access Logs ======================================================
        Route::match(['get', 'post'],'/accesslogs', [CommonController::class, 'accesslogs'])->name('accesslogs');
        Route::match(['get', 'post'],'/getAccesslogs', [CommonController::class, 'getAccesslogs']);
	Route::match(['get', 'post'], '/accesslogs/changelogqueue', [CommonController::class, 'changelogqueue'])->name('changelogqueue');
	Route::get('/getprofileid', [CommonController::class, 'getProfileIds'])->name('getprofileid');
        // ========================================== End:Access Logs ========================================================	


        // =========================================Contact Details==========================================================

        Route::match(['get', 'post'], '/contactdetailForm', [ContactDetailsController::class, 'contactdetailForm'])->name('contactdetailForm');
        Route::match(['post'], '/contactdetail/store', [ContactDetailsController::class, 'storeContactDetails'])->name('storeContactDetails');

        // =========================================End Contact Setup=======================================================

        // =========================================Get Applied Jobs Users==================================================
        Route::match(['post'], '/getappliedusers', [ApplyJobsController::class, 'getappliedusers'])->name('getappliedusers');
        // ==========================================End Applied Jobs Users=================================================

        // =========================================Document Setup==========================================================
        Route::match(['post'], '/document', [DocumentController::class, 'index'])->name('document');
        Route::match(['get', 'post'], '/document/form', [DocumentController::class, 'documentForm'])->name('documentForm');
        Route::match(['get', 'post'], '/document/imageinfo', [DocumentController::class, 'imageInfo'])->name('document.imageinfo');
         Route::match(['post'], '/document/store', [DocumentController::class, 'storeDocumentDetails'])->name('documentStore');
        // =========================================End Document Setup=======================================================

        // =========================================Education Setup==========================================================
        Route::match(['post'], '/education', [EducationController::class, 'index'])->name('education');
        Route::match(['get', 'post'], '/education/form', [EducationController::class, 'educationForm'])->name('educationForm');
        Route::match(['get', 'post'], '/store/educationdetails', [EducationController::class, 'storeEducationDetails'])->name('storeEducationDetails');
        Route::match(['get', 'post'], '/geteducationdetails', [EducationController::class, 'getEducationDetailsData'])->name('getEducationDetailsData');
        Route::any('/educationdetails/delete', [EducationController::class, 'deleteEducationDetailsData'])->name('deleteEducationDetailsData');
        // =========================================End Education Setup=======================================================

        // =========================================Training Setup==========================================================
        Route::match(['post'], '/training', [TrainingController::class, 'index'])->name('training');
        Route::match(['get', 'post'], '/training/form', [TrainingController::class, 'trainingForm'])->name('trainingForm');
        Route::match(['get', 'post'], '/store/trainingdetails', [TrainingController::class, 'storeTrainingDetails'])->name('storeTrainingDetails');
        Route::match(['get', 'post'], '/gettrainingdetails', [TrainingController::class, 'getTrainingDetailsData'])->name('getTrainingDetailsData');
        Route::any('/trainingdetails/delete', [TrainingController::class, 'deleteTrainingDetailsData'])->name('deleteTrainingDetailsData');
        // =========================================End Training Setup=======================================================

        // =========================================Experiene Setup==========================================================
        Route::match([ 'post'], '/experience', [ExperienceController::class, 'index'])->name('experience');
        Route::match(['get', 'post'], '/experience/form', [ExperienceController::class, 'experienceForm'])->name('experienceForm');
        Route::match(['get', 'post'], '/store/experiencedetails', [ExperienceController::class, 'storeExperienceDetails'])->name('storeExperienceDetails');
        Route::match(['get', 'post'], '/getexperiencedetails', [ExperienceController::class, 'getExperienceDetailsData'])->name('getExperienceDetailsData');
        Route::any('/experiencedetails/delete', [ExperienceController::class, 'deleteExperienceDetailsData'])->name('deleteExperienceDetailsData');
        // =========================================End Training Setup=======================================================

        // =========================================Document Setup==========================================================
        // Route::match(['post'], '/document', [DocumentController::class, 'index'])->name('document');
        // Route::match(['get', 'post'], '/document/form', [DocumentController::class, 'documentForm'])->name('documentForm');
        // Route::match(['post'], '/document/store', [DocumentController::class, 'storeDocumentDetails'])->name('documentStore');
        // =========================================End Document Setup=======================================================

        // =========================================Preview and Submit Setup==========================================================
        Route::match(['post'], '/preview', [PreviewController::class, 'preview'])->name('preview');
        Route::match(['post'], '/submit', [PreviewController::class, 'submit'])->name('submit');
        // Route::match(['post'], '/applicantadmitcard', [PreviewController::class, 'applicantAdmitCard'])->name('applicantadmitcard');
        Route::get('/printapplicantadmitcard', [PreviewController::class, 'printApplicantAdmitCard'])->name('printapplicantadmitcard');
        Route::post('/getadmitcardholder', [PreviewController::class, 'getAdmitcardHolder'])->name('getadmitcardholder');
        Route::post('/applicantadmitcard', [PreviewController::class, 'applicantAdmitCard'])->name('applicantadmitcard');
        // =========================================End Document Setup=======================================================
        // =========================================Apply Jobs Setup==========================================================
        Route::match(['get','post'], '/applyJobsForm', [ApplyJobsController::class, 'applyJobsForm'])->name('applyJobsForm');
        Route::post('/getjobdetails', [ApplyJobsController::class, 'getjobdetails'])->name('getjobdetails');
        Route::post('/storeApplyJobsDetails', [ApplyJobsController::class, 'storeApplyJobsDetails'])->name('storeApplyJobsDetails');
        // =========================================End Apply Jobs Setup=======================================================

        // =========================================Profile=============================================================
        Route::match(['get', 'post'], '/profile', [ProfileController::class, 'profile'])->name('profile');
        // =========================================End Profile=========================================================

        // =========================================Profile Update======================================================

        Route::match(['get', 'post'], 'update/profile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
        Route::match(['get', 'post'], 'store/profile', [ProfileController::class, 'storeProfile'])->name('storeProfile');
        // =========================================End Profile Update===================================================

        // =========================================Password Setting=====================================================
        Route::match(['get', 'post'], 'password/setting', [ProfileController::class, 'passwordSettings'])->name('passwordSettings');
	    Route::match(['post'], '/updatepassword', [ProfileController::class, 'clientPasswordUpdate'])->name('clientPasswordUpdate');
        // Checking Password
        Route::post('/update/password/check-password', [ProfileController::class, 'chkUserPassword'])->name('chkUserPassword');
        // Updating Password
        Route::post('update/password', [ProfileController::class, 'passwordUpdate'])->name('passwordUpdate');
        // =========================================End Password Setting==================================================



        //==========================================Province wise district===============================================================
        Route::post('/provincewisedistrict', [CommonController::class, 'getDistrict'])->name('getDistrict');
        Route::post('/getlevels', [CommonController::class, 'getLevels'])->name('getlevels');
        Route::post('/getdesignations', [CommonController::class, 'getDesignations'])->name('getdesignations');


        //==========================================End Province wise district===============================================================
        //==========================================District wise vdcormunicipality===============================================================
        Route::any('/districtwisevdcormunicipality', [CommonController::class, 'getVdcorMunicipality'])->name('getVdcorMunicipality');

        //==========================================End District wise vdcormunicipality===============================================================

	// =========================================Manage User ==========================================================
        Route::match(['get', 'post'], '/usersetup', [ManageUserController::class, 'index'])->name('user');
        Route::match(['get', 'post'], '/usersetup/form', [ManageUserController::class, 'userForm'])->name('userForm');
        Route::match(['get', 'post'], '/store/usersetup', [ManageUserController::class, 'storeUserDetails'])->name('storeUserDetails');
        Route::match(['get', 'post'], '/getusersetuplist', [ManageUserController::class, 'getUserDetailsData'])->name('getUserDetailsData');
        Route::any('/usersetup/delete', [ManageUserController::class, 'deleteUserDetailsData'])->name('deleteUserDetailsData');
        Route::post('/usersetup/updatestatus', [ManageUserController::class, 'updateStatus'])->name('updateStatus');
        // =========================================End Manage User =======================================================

        // =========================================Vancacy Setup==========================================================
        Route::match(['get', 'post'], '/vancacysetup', [VacancyController::class, 'index'])->name('vancacy');
        Route::match(['get', 'post'], '/vancacysetup/form', [VacancyController::class, 'vacancyForm'])->name('vacancyForm');
        Route::match(['get', 'post'], '/store/vancacysetup', [VacancyController::class, 'storeVacancyDetails'])->name('storeVacancyDetails');
        Route::match(['get', 'post'], '/getvancacysetuplist', [VacancyController::class, 'getVacancyDetailsData'])->name('getVancacyDetailsData');
        Route::any('/vancacysetup/delete', [VacancyController::class, 'deleteVacancyDetailsData'])->name('deleteVacancyDetailsData');
        Route::get('/vacancyrestrictionsetup', [VacancyController::class, 'vacancyRestrictionSetupForm'])->name('vacancyrestrictionsetup');
        // =========================================End Vancacy Setup=======================================================
        
        // =========================================VancacyDateMaster Setup==========================================================
        Route::match(['get', 'post'], '/vacancydatemastser', [VacancyDateMasterController::class, 'index'])->name('vacancydatemastser.index');
        Route::match(['get', 'post'], '/vacancydatemastser/form', [VacancyDateMasterController::class, 'form'])->name('vacancydatemastser.form');
        Route::match(['get', 'post'], '/store/vacancydatemastser', [VacancyDateMasterController::class, 'store'])->name('vacancydatemastser.store');
        Route::match(['get', 'post'], '/getvacancydatemastserlist', [VacancyDateMasterController::class, 'getVacancyDateList'])->name('getvacancydatemastserlist');
        Route::any('/vacancydatemastser/delete', [VacancyDateMasterController::class, 'delete'])->name('vacancydatemastser.delete');
        Route::any('/vacancydatemastser/allowregistration', [VacancyDateMasterController::class, 'allowRegistration'])->name('allowregistration');
        // =========================================End VancacyDateMaster Setup=======================================================
        
        
        // =========================================Khalti=======================================================
        Route::any('/payment',[PaymentController::class, 'paymentKhalti']);
        Route::post('/khalti/verify/payment',[PaymentController::class, 'VerifyKhaltiPayment']);
        Route::any('/khalti/store_payment', [PaymentController::class,'StorePayment']);
        Route::get('/payment/khalti', [PaymentController::class, 'khaltiDetails'])->name('khaltiDetails');
        Route::get('/getKhaltiDetails', [PaymentController::class, 'getKhaltiDetails']);
        // =========================================End Khalti=======================================================

           // =========================================E-sewa=======================================================
           // Route::any('/payment-verify',[
           //  'uses'=>'PaymentController@verifyEsewa',
           //  'as' => 'payment.verify',]);
           // Route::post('/khalti/verify/payment',[PaymentController::class, 'VerifyKhaltiPayment']);
           // Route::any('/khalti/store_payment', [PaymentController::class,'StorePayment']);

        Route::post('initiate-payment', [ApplyJobsController::class, 'initiatePurchase']);
        Route::get('verify-esewa/{callback}', [ApplyJobsController::class, 'verifyEsewa'])->name('verifyEsewa');

        Route::post('/khalti/verify/payment', [PaymentController::class, 'VerifyKhaltiPayment']);
        Route::any('/khalti/store_payment', [PaymentController::class, 'StorePayment']);
	Route::get('/payment/esewa-connectips', [PaymentController::class, 'esewaIpsDetails'])->name('esewaIpsDetails');
        Route::get('/getesewaconnectips', [PaymentController::class,'getEsewaConnectipsDetails']);
           // =========================================End E-sewa=======================================================

        // =========================================Connect IPS=======================================================
           Route::post('initiate-connectips', [ApplyJobsController::class, 'initiateIps']);
           Route::get('verify-connectips', [ApplyJobsController::class, 'verifyConnectIps'])->name('verifyConnectIps');
        // =========================================End Connect IPS=======================================================   
       
        
	// =========================================Khalti =======================================================
                Route::post('pay-with-khalti', [ApplyJobsController::class, 'payWithKhalti'])->name('payWithKhalti');
                Route::post('initiate-khalti', [ApplyJobsController::class, 'initiateKhalti']);
                Route::get('verify-khalti', [ApplyJobsController::class, 'verifyKhalti'])->name('verifyKhalti');
        // =========================================End Khalti =======================================================
        
        
        // =========================================Application=======================================================
        Route::any('/applicant',[ApplicantController::class, 'applicantDetails'])->name('applicantDetails');
        Route::match(['get', 'post'], '/getapplicationlist', [ApplicantController::class, 'getApplicantListData'])->name('getApplicantListData');
        Route::match(['get', 'post'], '/getpreview', [ApplicantController::class, 'getPreviewData']);
        Route::match(['get', 'post'], '/storeuserstatus', [ApplicantController::class, 'storeUsersDetails'])->name('storeUsersDetails');

	Route::post('/getcancelapplicationform', [ApplicantController::class, 'getCancelApplicationForm'])->name('getCancelApplicationForm');
        Route::post('/updateApplicationStatus', [ApplicantController::class, 'storeRemarksToCancelApplication'])->name('storeRemarksToCancelApplication');
	
	Route::match(['get', 'post'], '/getregisteredcandidates', [ApplicantController::class, 'registeredCandidates'])->name('registeredCandidatesDetails');
        Route::match(['get', 'post'], '/getregisteredcandidatesdetails', [ApplicantController::class, 'getRegisteredCandidateDetails']);
        Route::match(['get','post'], '/changeapplyjobpost',[ApplicantController::class, 'changeApplyJobTitle']);

	Route::post('/verifyaction', [ApplicantController::class, 'verifyAction']);
	Route::match(['get','post'], '/export',[ApplicantController::class, 'exportApplicant'])->name('exportApplicant');

        Route::any('/vacancyreport',[ApplicantController::class, 'vacancyReport'])->name('vacancyReport');
        Route::match(['get', 'post'], '/getvacancyreport', [ApplicantController::class, 'getVacancyReport'])->name('getVacancyReport');

        Route::any('/insufficientpaymentreport',[ApplicantController::class, 'insufficientPaymentReport'])->name('insufficientPaymentReport');
        Route::match(['get', 'post'], '/getinsufficientpaymentreport', [ApplicantController::class, 'getInsufficientPaymentReport'])->name('getInsufficientPaymentReport');
        
        Route::match(['get', 'post'], '/pscreport',[ApplicantController::class, 'getPscReprt'])->name('getPscReprt');
        Route::match(['get', 'post'], '/getpscreport',[ApplicantController::class, 'getPscReprtData'])->name('getPscReprtData');
        // =========================================End Application======================================================= 

	// =========================================Modified Vancacy Setup==========================================================
        Route::match(['get', 'post'], '/modifyApplication', [ApplicantController::class, 'modifyApplication'])->name('modifyApplication');
        Route::post('/checkVacancyif/{id}', [ApplicantController::class, 'checkVacancyif'])->name('checkVacancyif');
        Route::post('/storeModifiedForm', [ApplicantController::class, 'storeModifiedForm'])->name('storeModifiedForm');
	// =========================================End Vancacy Setup=======================================================
        
        
        // =========================================Message Display=======================================================
        Route::any('/errormessage',[ApplyJobsController::class, 'displayErrorMessage'])->name('displayErrorMessage');
        Route::any('/successmessage',[ApplyJobsController::class, 'displaySuccessMessage'])->name('displaySuccessMessage');
        // =========================================End Message Display======================================================= 

        // ========================================= Start ApplicantProfile ====================================================================
        Route::get('/applicantprofile', [ApplicantProfileController::class, 'index'])->name('applicantprofile');
                // Route::get('/myapplication', [ApplicantProfileController::class, 'myApplication'])->name('myapplication');
                Route::post('/getapplicantprofiledata', [ApplicantProfileController::class, 'getApplicatData'])->name('getapplicantprofiledata');
                Route::any('/myapplication', [ApplicantProfileController::class, 'myApplication'])->name('myApplication');
                Route::any('/availablevacancy', [ApplicantProfileController::class, 'availableVacancy'])->name('availableVacancy');
                Route::get('/availablevacancylist', [ApplicantProfileController::class, 'getAvailableVacancyList'])->name('getAvailableVacancyList');
     
        // ======================================== End ApplicantProfile ==================================================================
      
        // =========================================Setup Routes====================================================================
        Route::group(['prefix'=>'setup'], function(){
        
                Route::match(['get', 'post'], '/examcenter', [ExamCenterController::class, 'index'])->name('examcenter');
                Route::match(['get', 'post'], '/examcenter/form', [ExamCenterController::class, 'examcCenterForm'])->name('examcenter.form');
                Route::match(['get', 'post'], '/examcenter/assignform', [ExamCenterController::class, 'examcCenterAssignForm'])->name('examcenter.assignform');
                Route::match(['get', 'post'], '/store/examcenter', [ExamCenterController::class, 'storeExamCenter'])->name('examcenter.store');
                Route::match(['get', 'post'], '/getexamcenterlist', [ExamCenterController::class, 'examCenterList'])->name('examcenter.list');
                Route::any('/examcenter/delete', [ExamCenterController::class, 'deleteExamCenter'])->name('examcenter.delete');
                Route::post('/getsymbolnumberswithexamcenter', [ExamCenterController::class, 'getSymbolnumbersWithExamcenter'])->name('getsymbolnumberswithexamcenter');
                Route::post('/examcenter/assignexamcenter', [ExamCenterController::class, 'assignExamCenter'])->name('examcenter.assignexamcenter');

                // =========================================End ExamCenter Setup=======================================================

                // ========================================== Begin:Symbol Number ======================================================
                Route::get('/symbolnumbers', [SymbolNumberController::class, 'index'])->name('symbolnumbers');
                Route::post('/getapplicants', [SymbolNumberController::class, 'getApplicants'])->name('get_applicants');
                Route::post('/generatesymbolnumber', [SymbolNumberController::class, 'generateSymbolNumber'])->name('generate_symbol_number');
                Route::post('/getsymbolnumbers', [SymbolNumberController::class, 'getSymbolNumber'])->name('get_symbol_numbers');
                // ========================================== End:Symbol Number ========================================================	
        
        
                // =========================================Signature Setup ==========================================================
                Route::get('/signaturesetup', [SignatureSetupController::class, 'index'])->name('signaturesetup');
                Route::post('/signaturesetup/store', [SignatureSetupController::class, 'store'])->name('signaturesetup.store');
                Route::any('/signaturesetup/delete', [SignatureSetupController::class, 'delete'])->name('signaturesetup.delete');
                // =========================================End Signature Setup =======================================================

        });


        // =========================================Setup Routes====================================================================
        
    });


    // =========================================Logout====================================================================
    Route::match(['get', 'post'], '/logout', [AdminController::class, 'logout'])->name('logout');
    // ========================================End Logout==================================================================

});

// Route::get('/{any}', function ($any) {
//     return redirect()->route('dashboard');
// })->where('any', '.*');
