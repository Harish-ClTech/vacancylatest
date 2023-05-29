<?php

namespace App\Exports;

use App\Models\Applicant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class ApplicantDetailsExport implements FromCollection,WithHeadings,ShouldAutoSize,WithStrictNullComparison
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
                "आवेदन मिति"=> @$row->applieddatead,
                "रसिद नं."=> @$row->receipnumber,
                "नाम"=> @$row->fullname,
                "रकम"=> @$row->applyamount,
                "भुक्तानी स्रोत"=> '',
                "संपर्क नम्बर"=> @$row->contactnumber,
                "पद"=> @$row->designation,
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
            '#',
            'दर्ता नं.',
            'आवेदन मिति',
            'रसिद नं.',
            'नाम',
            'रकम',
            'भुक्तानी स्रोत',
            'संपर्क नम्बर',
            'पद',
            'Aprove Status',
        ];
    
        
    }
}
