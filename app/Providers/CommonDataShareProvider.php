<?php

namespace App\Providers;

use App\Models\Vacancy;
use App\Models\VacancyDateMaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Bsdate;
class CommonDataShareProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $vacanydates = DB::table('vacancy_date_masters')->select('fiscalyearid', 'vacancypublishdate', 'vacancyenddate', 'vacancyextendeddate', 'allow_registration')->where(['status'=>'Y'])->get();
        $today_nep =  Bsdate::eng_to_nep(date('Y-m-d'));
        View::share([
            'vacanydates' => $vacanydates,
            'today_nep' => $today_nep
        ]);

    }
}
