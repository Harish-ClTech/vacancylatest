<?php

namespace App\Exports;

use App\Models\Applicant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class VacancyReportExportNew implements FromCollection,WithHeadings,ShouldAutoSize,WithStrictNullComparison
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
        dd($results);
        foreach ($results as $row) { 
            $applicant_data []=[
                "#" => $i + 1,
                "दर्ता नं."=> @$row->registrationnumber,
                "नाम"=> @$row->nepalifullname,
                "लिङ्ग"=> @$row->gender,
                "जन्म मिति"=> @$row->dateofbirthbs,
                "नागरिकता नम्बर"=> @$row->citizenshipnumber,
                "ईमेल"=> @$row->email,
                "संपर्क नम्बर"=> @$row->contactnumber,
                "पद"=> @$row->designationtitle,
                "खुला / समावेशी"=> @$row->jobcategory,
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
            "लिङ्ग",
            "जन्म मिति",
            "नागरिकता नम्बर",
            "ईमेल",
            "संपर्क नम्बर",
            "पद",
            "खुला / समावेशी",
            "Aprove Status",
        ];
    
        
    }
}