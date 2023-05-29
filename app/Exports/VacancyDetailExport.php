<?php

namespace App\Exports;

use App\Models\Applicant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class VacancyDetailExport implements FromCollection,WithHeadings,ShouldAutoSize,WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($data)
    {
        $this->data =$data;
    }
    public function collection()
    {
        $results = $this->data;
        $i = 0; 
        $applicant_data =     [];
        foreach ($results as $row) { 
            $applicant_data []=[
                "#" => $i + 1,
                "दर्ता नं."=> @$row->registrationnumber,
                "नाम"=> @$row->nepalifullname,
                "नाम (अङ्ग्रेजीमा)"=> @$row->englishfullname,
                "लिङ्ग"=> @$row->gender,
                "जन्म मिति"=> @$row->dateofbirthbs,
                "नागरिकता नम्बर"=> @$row->citizenshipnumber,
                "ईमेल"=> @$row->email,
                "संपर्क नम्बर"=> @$row->contactnumber,
                "तह"=> @$row->leveltitle,
                "पद"=> @$row->designationtitle,
                "खुला / समावेशी"=> @$row->jobcategory,
                "रसिद न‌."=> @$row->receipnumber,
                "भुक्तानीको श्रोत"=> @$row->paymentsource,
                "भुक्तानी गरेको रकम"=> @$row->applyamount,
                "Aprove Status"=> @$row->appliedstatus,
            ];
            $i++;
        }

        $result = collect($applicant_data);
        return $result;
    }

    public function headings(): array
    {

        return [
            "#",
            "दर्ता नं.",
            "नाम",
            "नाम (अङ्ग्रेजीमा)",
            "लिङ्ग",
            "जन्म मिति",
            "नागरिकता नम्बर",
            "ईमेल",
            "संपर्क नम्बर",
            "तह",
            "पद",
            "खुला / समावेशी",
            "रसिद न‌.",
            "भुक्तानीको श्रोत",
            "भुक्तानी गरेको रकम",
            "Aprove Status",

        ];
    
        
    }
}