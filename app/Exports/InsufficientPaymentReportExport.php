<?php

namespace App\Exports;

use App\Models\Applicant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class InsufficientPaymentReportExport implements FromCollection,WithHeadings,ShouldAutoSize,WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($data)
    {
        $this->data =$data;
        dd($this->data);
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
                "आवेदन मिति"=> @$row->applieddatebs,
                "नाम"=> @$row->fullname,
                "लिङ्ग"=> @$row->gender,
                "ईमेल"=> @$row->email,
                "संपर्क नम्बर"=> @$row->contactnumber,
                "तह"=> @$row->level,
                "पद"=> @$row->designation,
                "खुला / समावेशी"=> @$row->jobcategory,
                "विज्ञापनको दर"=> @$row->vacancyrate,
                "भुक्तानी भएको रकम"=> @$row->paidamount,
                "बाँकी रकम"=> @$row->vacancyrate-$row->paidamount,
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
            "आवेदन मिति",
            "नाम",
            "लिङ्ग",
            "ईमेल",
            "संपर्क नम्बर",
            "तह",
            "पद",
            "खुला / समावेशी",
            "विज्ञापनको दर",
            "भुक्तानी भएको रकम",
            "बाँकी रकम",
        ];
    
        
    }
}
