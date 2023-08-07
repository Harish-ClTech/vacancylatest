<?php

namespace App\Exports;

use App\Models\Applicant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class PscReportExport implements FromCollection,WithHeadings,ShouldAutoSize,WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function collection()
    {
        $results = $this->data;
        $i = 0; 
        $applicant_data =     [];
        foreach ($results as $row) { 
            $applicant_data []=[
                "S.N." => $i + 1,
                "Master ID" => $row->userid,
                "Symbol Number" => !empty($row-> symbolnumber) ? $row-> symbolnumber : '-',
                "English Full Name" => !empty($row-> englishfullname) ? $row-> englishfullname : '-',
                "Nepali Full Name" => !empty($row-> nepalifullname) ? $row-> nepalifullname : '-', 
                "Father Full Name" => !empty($row-> fatherfullname) ? $row-> fatherfullname : '-',
                "Mother Full Name" => !empty($row-> motherfullname) ? $row-> motherfullname : '-', 
                "Grandfather Full Name" => !empty($row-> grandfatherfullname) ? $row-> grandfatherfullname : '-', 
                "Gender" => !empty($row-> gender) ? $row-> gender : '-',
                "Full address" => !empty($row-> fulladdress) ? $row-> fulladdress : '-', 
                "Level" => !empty($row-> labelname) ? $row-> labelname : '-', 
                "Designation" => !empty($row-> designationtitle) ? $row-> designationtitle : '-', 
                "Job Category" => !empty($row-> jobcategory) ? $row-> jobcategory : '-',
                "Vacancy Number" => !empty($row-> vacancynumber) ? $row-> vacancynumber : '-', 
                "Applicant Type" => ($row->isinternalvacancy == 'Y') ? 'आ.प्र.': 'खुला प्र.'
            ];
            $i++;
        }

        $result = collect($applicant_data);
        return $result;
    }

    public function headings(): array
    {

        return [
            "S.N.",
            "Master ID",
            "Symbol Number",
            "English Full Name",
            "Nepali Full Name", 
            "Father Full Name",
            "Mother Full Name", 
            "Grandfather Full Name", 
            "Gender",
            "Full address", 
            "Level", 
            "Designation", 
            "Job Category",
            "Vacancy Number", 
            "Applicant Type"
        ];        
    }
}
