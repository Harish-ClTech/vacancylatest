<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\Role::insert([
            [
                'name' => 'Super Admin',
                'status' => 'Y',
                'createdatetime' => now(),

            ],
            [
                'name' => 'User',
                'status' => 'Y',
                'createdatetime' => now(),
            ]
        ]);

        //==========================================Designation=========================================================
        \App\Models\Designation::insert([
            [
                'title' => 'व्यवस्थापक',
                'ordernumber' => 1,
                'status' => 'Y',
                'createdatetime' => now(),

            ],

            [
                'title' => 'उप-व्यवस्थापक',
                'ordernumber' => 2,
                'status' => 'Y',
                'createdatetime' => now(),
            ],
            [
                'title' => 'अधिकृत',
                'ordernumber' => 3,
                'status' => 'Y',
                'createdatetime' => now(),
            ],
            [
                'title' => 'सहायक अधिकृत',
                'ordernumber' => 4,
                'status' => 'Y',
                'createdatetime' => now(),

            ],
            [
                'title' => 'सहायक कम्युटर अधिकृत',
                'ordernumber' => 5,
                'status' => 'Y',
                'createdatetime' => now(),

            ],

            [
                'title' => 'बरिष्ठ सहायक',
                'ordernumber' => 6,
                'status' => 'Y',
                'createdatetime' => now(),

            ],

            [
                'title' => 'सहायक',
                'ordernumber' => 7,
                'status' => 'Y',
                'createdatetime' => now(),

            ],


            [
                'title' => 'सहायक कम्प्युटर अपरेटर',
                'ordernumber' => 8,
                'status' => 'Y',
                'createdatetime' => now(),

            ],

            [
                'title' => 'सहायक',
                'ordernumber' => 9,
                'status' => 'Y',
                'createdatetime' => now(),

            ]

        ]);

         //==========================================Label=========================================================
         \App\Models\Level::insert([
            [
                'labelname' => '4',
                'status' => 'Y',
                'posteddatetime' => now(),
            ],
            [
                'labelname' => '5',
                'status' => 'Y',
                'posteddatetime' => now(),
            ],
            [
                'labelname' => '6',
                'status' => 'Y',
                'posteddatetime' => now(),
            ],
            [
                'labelname' => '7',
                'status' => 'Y',
                'posteddatetime' => now(),
            ],
            [
                'labelname' => '8',
                'status' => 'Y',
                'posteddatetime' => now(),
            ],
            [
                'labelname' => '9',
                'status' => 'Y',
                'posteddatetime' => now(),
            ],
            [
                'labelname' => '10',
                'status' => 'Y',
                'posteddatetime' => now(),
            ]

        ]);


        \App\Models\User::insert([
            [
                'email' => 'info@cltech.com.np',
                'password' => bcrypt('password'),
                'status' => 'Y',
                'createdby' => 1,
            ],
            [
                'email' => 'umeshpaneru@nlk.org.np',
                'password' => bcrypt('password'),
                'status' => 'Y',
                'createdby' => 1,
            ],
            [
                'email' => 'bimal@nlk.org.np',
                'password' => bcrypt('password'),
                'status' => 'Y',
                'createdby' => 1,
            ]
        ]);
        \App\Models\Profile::insert([
            [
                'userid' => 1,
                'firstname' => 'Code',
                'middlename' => 'Logic',
                'lastname' => 'Technologies',
                'email' => 'info@cltech.com.np',
                'contactnumber' => '',
                'status' => 'Y',
                'createdatetime' => now(),
            ],
            [
                'userid' => 2,
                'firstname' => 'Umesh',
                'middlename' => '',
                'lastname' => 'Paneru',
                'email' => 'umeshpaneru@nlk.org.np',
                'contactnumber' => '',
                'status' => 'Y',
                'createdatetime' => now(),
            ],
            [
                'userid' => 3,
                'firstname' => 'Bimal',
                'middlename' => '',
                'lastname' => 'Yadav',
                'email' => 'bimal@nlk.org.np',
                'contactnumber' => '',
                'status' => 'Y',
                'createdatetime' => now(),
            ]
        ]);


        \App\Models\Userrole::insert([
            [
                'userid' => 1,
                'roleid' => 1,
                'status' => 'Y',
                'createdatetime' => now(),
            ],
            [
                'userid' => 2,
                'roleid' => 1,
                'status' => 'Y',
                'createdatetime' => now(),
            ],
            [
                'userid' => 3,
                'roleid' => 1,
                'status' => 'Y',
                'createdatetime' => now(),
            ]
        ]);
       

        \App\Models\Jobcategory::insert([
            [
                'name' => 'खुला',
                'status' => 'Y',
                'posteddatetime' => now(),

            ],
            [
                'name' => 'महिला',
                'status' => 'Y',
                'posteddatetime' => now(),
            ],
            [
                'name' => 'आदिवासी-जनजाती',
                'status' => 'Y',
                'posteddatetime' => now(),
            ],
            [
                'name' => 'मधेशी',
                'status' => 'Y',
                'posteddatetime' => now(),
            ],
            [
                'name' => 'दलित',
                'status' => 'Y',
                'posteddatetime' => now(),
            ],
            [
                'name' => 'पिछिडिएका क्षेत्र',
                'status' => 'Y',
                'posteddatetime' => now(),
            ],
            [
                'name' => 'अपाङ्ग',
                'status' => 'Y',
                'posteddatetime' => now(),
            ]

        ]);

        \App\Models\Servicegroup::insert([
            [
                'servicegroupname' => 'प्रशासन',
                'status' => 'Y',
                'posteddatetime' => now(),

            ],
            [
                'servicegroupname' => 'प्राविधिक',
                'status' => 'Y',
                'posteddatetime' => now(),
            ]

        ]);

        \App\Models\Academic::insert([
            [
                'name' => 'Master',
                'status' => 'Y',
                'posteddatetime' => now(),
            ],
            [
                'name' => 'Bachelor',
                'status' => 'Y',
                'posteddatetime' => now(),
            ],
            [
                'name' => '10+2',
                'status' => 'Y',
                'posteddatetime' => now(),
            ],
            [
                'name' => 'SLC',
                'status' => 'Y',
                'posteddatetime' => now(),
            ]

        ]);


        \App\Models\Province::insert([
            [
                'provincename' => 'कोशी प्रदेश',
                'status' => 'Y',
            ],
            [
                'provincename' => 'मधेस प्रदेश',
                'status' => 'Y',

            ],
            [
                'provincename' => 'बागमती  प्रदेश',
                'status' => 'Y',

            ],
            [
                'provincename' => 'गण्डकी प्रदेश',
                'status' => 'Y',

            ],

            [
                'provincename' => 'लुम्विनी प्रदेश',
                'status' => 'Y',

            ],

            [
                'provincename' => 'कर्णाली प्रदेश',
                'status' => 'Y',

            ],


            [
                'provincename' => 'सुदुर पश्चिम प्रदेश',
                'status' => 'Y',

            ]

        ]);

        \App\Models\District::insert([
            [
                'districtname' => 'ताप्लेजुङ',
                'provinceid' => '1',
                'status' => 'Y',

            ],

            [
                'districtname' => 'पाँचथर',
                'provinceid' => '1',
                'status' => 'Y',


            ],

            [
                'districtname' => 'ईलाम',
                'provinceid' => '1',
                'status' => 'Y',


            ],

            [
                'districtname' => 'झापा',
                'provinceid' => '1',
                'status' => 'Y',


            ],

            [
                'districtname' => 'मोरंग',
                'provinceid' => '1',
                'status' => 'Y',


            ],

            [
                'districtname' => 'सुनसरी',
                'provinceid' => '1',
                'status' => 'Y',


            ],

            [
                'districtname' => 'धनकुटा',
                'provinceid' => '1',
                'status' => 'Y',


            ],

            [
                'districtname' => 'तेहथुम',
                'provinceid' => '1',
                'status' => 'Y',


            ],

            [
                'districtname' => 'संखुवासभा',
                'provinceid' => '1',
                'status' => 'Y',


            ],

            [
                'districtname' => 'भोजपुर',
                'provinceid' => '1',
                'status' => 'Y',


            ],

            [
                'districtname' => 'सोलुखुम्बु',
                'provinceid' => '1',
                'status' => 'Y',


            ],

            [
                'districtname' => 'ओखलढुंगा',
                'provinceid' => '1',
                'status' => 'Y',


            ],

            [
                'districtname' => 'खोटाङ',
                'provinceid' => '1',
                'status' => 'Y',


            ],

            [
                'districtname' => 'उदयपुर',
                'provinceid' => '1',
                'status' => 'Y',


            ],

            [
                'districtname' => 'सप्तरी',
                'provinceid' => '2',
                'status' => 'Y',


            ],

            [
                'districtname' => 'सिराहा',
                'provinceid' => '2',
                'status' => 'Y',


            ],

            [
                'districtname' => 'धनुषा',
                'provinceid' => '2',
                'status' => 'Y',


            ],

            [
                'districtname' => 'महोत्तरी',
                'provinceid' => '2',
                'status' => 'Y',


            ],

            [
                'districtname' => 'सर्लाही',
                'provinceid' => '2',
                'status' => 'Y',


            ],

            [
                'districtname' => 'सिन्धुली',
                'provinceid' => '3',
                'status' => 'Y',


            ],

            [
                'districtname' => 'रामेछाप',
                'provinceid' => '3',
                'status' => 'Y',


            ],

            [
                'districtname' => 'दोलखा',
                'provinceid' => '3',
                'status' => 'Y',


            ],

            [
                'districtname' => 'सिन्धुपाल्चोक',
                'provinceid' => '3',
                'status' => 'Y',


            ],

            [
                'districtname' => 'काभ्रेपलान्चोक',
                'provinceid' => '3',
                'status' => 'Y',


            ],

            [
                'districtname' => 'ललितपुर',
                'provinceid' => '3',
                'status' => 'Y',


            ],

            [
                'districtname' => 'भक्तपुर',
                'provinceid' => '3',
                'status' => 'Y',


            ],

            [
                'districtname' => 'काठमाण्डौ',
                'provinceid' => '3',
                'status' => 'Y',


            ],

            [
                'districtname' => 'नुवाकोट',
                'provinceid' => '3',
                'status' => 'Y',


            ],

            [
                'districtname' => 'रसुवा',
                'provinceid' => '3',
                'status' => 'Y',


            ],

            [
                'districtname' => 'धादिङ',
                'provinceid' => '3',
                'status' => 'Y',


            ],

            [
                'districtname' => 'मकवानपुर',
                'provinceid' => '3',
                'status' => 'Y',


            ],

            [
                'districtname' => 'रौतहट',
                'provinceid' => '2',
                'status' => 'Y',


            ],

            [
                'districtname' => 'वारा',
                'provinceid' => '2',
                'status' => 'Y',


            ],

            [
                'districtname' => 'पर्सा',
                'provinceid' => '2',
                'status' => 'Y',


            ],

            [
                'districtname' => 'चितवन',
                'provinceid' => '3',
                'status' => 'Y',


            ],

            [
                'districtname' => 'गोरखा',
                'provinceid' => '4',
                'status' => 'Y',


            ],

            [
                'districtname' => 'लमजुङ',
                'provinceid' => '4',
                'status' => 'Y',


            ],

            [
                'districtname' => 'तनहुँ',
                'provinceid' => '4',
                'status' => 'Y',


            ],

            [
                'districtname' => 'स्याङजा',
                'provinceid' => '4',
                'status' => 'Y',


            ],

            [
                'districtname' => 'कास्की',
                'provinceid' => '4',
                'status' => 'Y',


            ],

            [
                'districtname' => 'मनाङ',
                'provinceid' => '4',
                'status' => 'Y',


            ],

            [
                'districtname' => 'मुस्ताङ',
                'provinceid' => '4',
                'status' => 'Y',


            ],

            [
                'districtname' => 'म्याग्दी',
                'provinceid' => '4',
                'status' => 'Y',


            ],

            [
                'districtname' => 'पर्वत',
                'provinceid' => '4',
                'status' => 'Y',


            ],

            [
                'districtname' => 'वाग्लुङ',
                'provinceid' => '4',
                'status' => 'Y',


            ],

            [
                'districtname' => 'गुल्मी',
                'provinceid' => '5',
                'status' => 'Y',


            ],

            [
                'districtname' => 'पाल्पा',
                'provinceid' => '5',
                'status' => 'Y',


            ],

            [
                'districtname' => 'रुपन्देही',
                'provinceid' => '5',
                'status' => 'Y',


            ],

            [
                'districtname' => 'कपिलबस्तु',
                'provinceid' => '5',
                'status' => 'Y',


            ],

            [
                'districtname' => 'अर्घाखाँची',
                'provinceid' => '5',
                'status' => 'Y',


            ],

            [
                'districtname' => 'प्यूठान',
                'provinceid' => '5',
                'status' => 'Y',


            ],

            [
                'districtname' => 'रोल्पा',
                'provinceid' => '5',
                'status' => 'Y',


            ],

            [
                'districtname' => 'रुकुम (पश्चिम भाग)',
                'provinceid' => '6',
                'status' => 'Y',


            ],

            [
                'districtname' => 'रुकुम (पूर्वी भाग)',
                'provinceid' => '5',
                'status' => 'Y',


            ],

            [
                'districtname' => 'सल्यान',
                'provinceid' => '6',
                'status' => 'Y',


            ],

            [
                'districtname' => 'दाङ',
                'provinceid' => '5',
                'status' => 'Y',


            ],

            [
                'districtname' => 'बाँके',
                'provinceid' => '5',
                'status' => 'Y',


            ],

            [
                'districtname' => 'बर्दिया',
                'provinceid' => '5',
                'status' => 'Y',


            ],

            [
                'districtname' => 'सुर्खेत',
                'provinceid' => '6',
                'status' => 'Y',


            ],

            [
                'districtname' => 'दैलेख',
                'provinceid' => '6',
                'status' => 'Y',


            ],

            [
                'districtname' => 'जाजरकोट',
                'provinceid' => '6',
                'status' => 'Y',


            ],

            [
                'districtname' => 'डोल्पा',
                'provinceid' => '6',
                'status' => 'Y',


            ],

            [
                'districtname' => 'जुम्ला',
                'provinceid' => '6',
                'status' => 'Y',


            ],

            [
                'districtname' => 'कालिकोट',
                'provinceid' => '6',
                'status' => 'Y',


            ],

            [
                'districtname' => 'मुगु',
                'provinceid' => '6',
                'status' => 'Y',


            ],

            [
                'districtname' => 'हुम्ला',
                'provinceid' => '6',
                'status' => 'Y',


            ],

            [
                'districtname' => 'बाजुरा',
                'provinceid' => '7',
                'status' => 'Y',


            ],

            [
                'districtname' => 'बझाङ',
                'provinceid' => '7',
                'status' => 'Y',


            ],

            [
                'districtname' => 'अछाम',
                'provinceid' => '7',
                'status' => 'Y',


            ],

            [
                'districtname' => 'डोटी',
                'provinceid' => '7',
                'status' => 'Y',


            ],

            [
                'districtname' => 'कैलाली',
                'provinceid' => '7',
                'status' => 'Y',


            ],

            [
                'districtname' => 'कञ्चनपुर',
                'provinceid' => '7',
                'status' => 'Y',


            ],

            [
                'districtname' => 'डडेलधुरा',
                'provinceid' => '7',
                'status' => 'Y',


            ],

            [
                'districtname' => 'बैतडी',
                'provinceid' => '7',
                'status' => 'Y',


            ],

            [
                'districtname' => 'दार्चुला',
                'provinceid' => '7',
                'status' => 'Y',


            ],

            [
                'districtname' => 'नवलपरासी (बर्दघाट सुस्ता पूर्व)',
                'provinceid' => '4',
                'status' => 'Y',


            ],

            [
                'districtname' => 'नवलपरासी (बर्दघाट सुस्ता पश्चिम)',
                'provinceid' => '5',
                'status' => 'Y',


            ],


        ]);

        // ================================= VDC and Municipalities ==============================================================
        \App\Models\Vdcormunicipality::insert([
            [
                'vdcormunicipalitiename' => 'फुङलिङ नगरपालिका',
                'districtid' => '1',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'आठराई त्रिवेणी गाउँपालिका',
                'districtid' => '1',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सिदिङ्वा गाउँपालिका',
                'districtid' => '1',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'फक्ताङलुङ गाउँपालिका',
                'districtid' => '1',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मिक्वाखोला गाउँपालिका',
                'districtid' => '1',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मेरिङदेन गाउँपालिका',
                'districtid' => '1',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मैवाखोला गाउँपालिका',
                'districtid' => '1',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पाथीभरा याङवरक गाउँपालिका',
                'districtid' => '1',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सिरीजङ्घा गाउँपालिका',
                'districtid' => '1',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'फिदिम नगरपालिका',
                'districtid' => '2',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'फालेलुङ गाउँपालिका',
                'districtid' => '2',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'फाल्गुनन्द गाउँपालिका',
                'districtid' => '2',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'हिलिहाङ गाउँपालिका',
                'districtid' => '2',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कुम्मायक गाउँपालिका',
                'districtid' => '2',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मिक्लाजुङ गाउँपालिका',
                'districtid' => '2',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'तुम्बेवा गाउँपालिका',
                'districtid' => '2',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'याङवरक गाउँपालिका',
                'districtid' => '2',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ईलाम नगरपालिका',
                'districtid' => '3',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'देउमाई नगरपालिका',
                'districtid' => '3',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'माई नगरपालिका',
                'districtid' => '3',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सूर्योदय नगरपालिका',
                'districtid' => '3',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'फाकफोकथुम गाउँपालिका',
                'districtid' => '3',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चुलाचुली गाउँपालिका',
                'districtid' => '3',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'माईजोगमाई गाउँपालिका',
                'districtid' => '3',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'माङसेबुङ गाउँपालिका',
                'districtid' => '3',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रोङ गाउँपालिका',
                'districtid' => '3',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सन्दकपुर गाउँपालिका',
                'districtid' => '3',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मेचीनगर नगरपालिका',
                'districtid' => '4',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'दमक नगरपालिका',
                'districtid' => '4',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कन्काई नगरपालिका',
                'districtid' => '4',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भद्रपुर नगरपालिका',
                'districtid' => '4',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'अर्जुनधारा नगरपालिका',
                'districtid' => '4',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'शिवशताक्षी नगरपालिका',
                'districtid' => '4',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गौरादह नगरपालिका',
                'districtid' => '4',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'विर्तामोड नगरपालिका',
                'districtid' => '4',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कमल गाउँपालिका',
                'districtid' => '4',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गौरीगंज गाउँपालिका',
                'districtid' => '4',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बाह्रदशी गाउँपालिका',
                'districtid' => '4',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'झापा गाउँपालिका',
                'districtid' => '4',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बुद्धशान्ति गाउँपालिका',
                'districtid' => '4',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'हल्दिवारी गाउँपालिका',
                'districtid' => '4',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कचनकवल गाउँपालिका',
                'districtid' => '4',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'विराटनगर महानगरपालिका',
                'districtid' => '5',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बेलवारी नगरपालिका',
                'districtid' => '5',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लेटाङ नगरपालिका',
                'districtid' => '5',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पथरी शनिश्चरे नगरपालिका',
                'districtid' => '5',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रंगेली नगरपालिका',
                'districtid' => '5',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रतुवामाई नगरपालिका',
                'districtid' => '5',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सुनवर्षि नगरपालिका',
                'districtid' => '5',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'उर्लावारी नगरपालिका',
                'districtid' => '5',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सुन्दरहरैचा नगरपालिका',
                'districtid' => '5',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बुढीगंगा गाउँपालिका',
                'districtid' => '5',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'धनपालथान गाउँपालिका',
                'districtid' => '5',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ग्रामथान गाउँपालिका',
                'districtid' => '5',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'जहदा गाउँपालिका',
                'districtid' => '5',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कानेपोखरी गाउँपालिका',
                'districtid' => '5',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कटहरी गाउँपालिका',
                'districtid' => '5',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'केरावारी गाउँपालिका',
                'districtid' => '5',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मिक्लाजुङ गाउँपालिका',
                'districtid' => '5',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ईटहरी उपमहानगरपालिका',
                'districtid' => '6',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'धरान उपमहानगरपालिका',
                'districtid' => '6',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ईनरुवा नगरपालिका',
                'districtid' => '6',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'दुहवी नगरपालिका',
                'districtid' => '6',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रामधुनी नगरपालिका',
                'districtid' => '6',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बराहक्षेत्र नगरपालिका',
                'districtid' => '6',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'देवानगञ्ज गाउँपालिका',
                'districtid' => '6',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कोशी गाउँपालिका',
                'districtid' => '6',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गढी गाउँपालिका',
                'districtid' => '6',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बर्जु गाउँपालिका',
                'districtid' => '6',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भोक्राहा नरसिंह गाउँपालिका',
                'districtid' => '6',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'हरिनगर गाउँपालिका',
                'districtid' => '6',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पाख्रिबास नगरपालिका',
                'districtid' => '7',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'धनकुटा नगरपालिका',
                'districtid' => '7',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'महालक्ष्मी नगरपालिका',
                'districtid' => '7',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'साँगुरीगढी गाउँपालिका',
                'districtid' => '7',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सहिदभूमि गाउँपालिका',
                'districtid' => '7',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'छथर जोरपाटी गाउँपालिका',
                'districtid' => '7',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चौविसे गाउँपालिका',
                'districtid' => '7',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'म्याङलुङ नगरपालिका',
                'districtid' => '8',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लालीगुराँस नगरपालिका',
                'districtid' => '8',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'आठराई गाउँपालिका',
                'districtid' => '8',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'छथर गाउँपालिका',
                'districtid' => '8',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'फेदाप गाउँपालिका',
                'districtid' => '8',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मेन्छयायेम गाउँपालिका',
                'districtid' => '8',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चैनपुर नगरपालिका',
                'districtid' => '9',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'धर्मदेवी नगरपालिका',
                'districtid' => '9',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'खाँदवारी नगरपालिका',
                'districtid' => '9',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मादी नगरपालिका',
                'districtid' => '9',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पाँचखपन नगरपालिका',
                'districtid' => '9',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भोटखोला गाउँपालिका',
                'districtid' => '9',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चिचिला गाउँपालिका',
                'districtid' => '9',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मकालु गाउँपालिका',
                'districtid' => '9',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सभापोखरी गाउँपालिका',
                'districtid' => '9',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सिलीचोङ गाउँपालिका',
                'districtid' => '9',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भोजपुर नगरपालिका',
                'districtid' => '10',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'षडानन्द नगरपालिका',
                'districtid' => '10',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'टेम्केमैयुङ गाउँपालिका',
                'districtid' => '10',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रामप्रसाद राई गाउँपालिका',
                'districtid' => '10',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'अरुण गाउँपालिका',
                'districtid' => '10',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पौवादुङमा गाउँपालिका',
                'districtid' => '10',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'साल्पासिलिछो गाउँपालिका',
                'districtid' => '10',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'आमचोक गाउँपालिका',
                'districtid' => '10',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'हतुवागढी गाउँपालिका',
                'districtid' => '10',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सोलुदुधकुण्ड नगरपालिका',
                'districtid' => '11',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'माप्य दुधकोशी गाउँपालिका',
                'districtid' => '11',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'खुम्वु पासाङल्हमु गाउँपालिका',
                'districtid' => '11',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'थुलुङ दुधकोशी गाउँपालिका',
                'districtid' => '11',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'नेचासल्यान गाउँपालिका',
                'districtid' => '11',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'माहाकुलुङ गाउँपालिका',
                'districtid' => '11',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लिखु पिके गाउँपालिका',
                'districtid' => '11',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सोताङ गाउँपालिका',
                'districtid' => '11',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सिद्दिचरण नगरपालिका',
                'districtid' => '12',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'खिजिदेम्बा गाउँपालिका',
                'districtid' => '12',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चम्पादेवी गाउँपालिका',
                'districtid' => '12',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चिशंखुगढी गाउँपालिका',
                'districtid' => '12',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मानेभञ्याङ गाउँपालिका',
                'districtid' => '12',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मोलुङ गाउँपालिका',
                'districtid' => '12',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लिखु गाउँपालिका',
                'districtid' => '12',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सुनकोशी गाउँपालिका',
                'districtid' => '12',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'हलेसी तुवाचुङ नगरपालिका',
                'districtid' => '13',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'दिक्तेल रुपाकोट मझुवागढी नगरपालिका',
                'districtid' => '13',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ऐसेलुखर्क गाउँपालिका',
                'districtid' => '13',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रावा बेसी गाउँपालिका',
                'districtid' => '13',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'जन्तेढुंगा गाउँपालिका',
                'districtid' => '13',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'खोटेहाङ गाउँपालिका',
                'districtid' => '13',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'केपिलासगढी गाउँपालिका',
                'districtid' => '13',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'दिप्रुङ चुइचुम्मा गाउँपालिका',
                'districtid' => '13',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'साकेला गाउँपालिका',
                'districtid' => '13',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'वराहपोखरी गाउँपालिका',
                'districtid' => '13',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कटारी नगरपालिका',
                'districtid' => '14',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चौदण्डीगढी नगरपालिका',
                'districtid' => '14',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'त्रियुगा नगरपालिका',
                'districtid' => '14',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'वेलका नगरपालिका',
                'districtid' => '14',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'उदयपुरगढी गाउँपालिका',
                'districtid' => '14',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ताप्ली गाउँपालिका',
                'districtid' => '14',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रौतामाई गाउँपालिका',
                'districtid' => '14',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लिम्चुङ्बुङ गाउँपालिका',
                'districtid' => '14',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'राजविराज नगरपालिका',
                'districtid' => '15',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कञ्चनरुप नगरपालिका',
                'districtid' => '15',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'डाक्नेश्वरी नगरपालिका',
                'districtid' => '15',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बोदेबरसाईन नगरपालिका',
                'districtid' => '15',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'खडक नगरपालिका',
                'districtid' => '15',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'शम्भुनाथ नगरपालिका',
                'districtid' => '15',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सुरुङ्‍गा नगरपालिका',
                'districtid' => '15',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'हनुमाननगर कङ्‌कालिनी नगरपालिका',
                'districtid' => '15',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सप्तकोशी नगरपालिका',
                'districtid' => '15',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'अग्निसाइर कृष्णासरवन गाउँपालिका',
                'districtid' => '15',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'छिन्नमस्ता गाउँपालिका',
                'districtid' => '15',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'महादेवा गाउँपालिका',
                'districtid' => '15',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'तिरहुत गाउँपालिका',
                'districtid' => '15',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'तिलाठी कोईलाडी गाउँपालिका',
                'districtid' => '15',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रुपनी गाउँपालिका',
                'districtid' => '15',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'राजगढ गाउँपालिका',
                'districtid' => '15',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बिष्णुपुर गाउँपालिका',
                'districtid' => '15',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बलान-बिहुल गाउँपालिका',
                'districtid' => '15',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लहान नगरपालिका',
                'districtid' => '16',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'धनगढीमाई नगरपालिका',
                'districtid' => '16',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सिरहा नगरपालिका',
                'districtid' => '16',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गोलबजार नगरपालिका',
                'districtid' => '16',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मिर्चैयाँ नगरपालिका',
                'districtid' => '16',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कल्याणपुर नगरपालिका',
                'districtid' => '16',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कर्जन्हा नगरपालिका',
                'districtid' => '16',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सुखीपुर नगरपालिका',
                'districtid' => '16',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भगवानपुर गाउँपालिका',
                'districtid' => '16',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'औरही गाउँपालिका',
                'districtid' => '16',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'विष्णुपुर गाउँपालिका',
                'districtid' => '16',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बरियारपट्टी गाउँपालिका',
                'districtid' => '16',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लक्ष्मीपुर पतारी गाउँपालिका',
                'districtid' => '16',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'नरहा गाउँपालिका',
                'districtid' => '16',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सखुवानान्कारकट्टी गाउँपालिका',
                'districtid' => '16',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'अर्नमा गाउँपालिका',
                'districtid' => '16',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'नवराजपुर गाउँपालिका',
                'districtid' => '16',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'जनकपुरधाम उपमहानगरपालिका',
                'districtid' => '17',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'क्षिरेश्वरनाथ नगरपालिका',
                'districtid' => '17',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गणेशमान चारनाथ नगरपालिका',
                'districtid' => '17',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'धनुषाधाम नगरपालिका',
                'districtid' => '17',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'नगराइन नगरपालिका',
                'districtid' => '17',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'विदेह नगरपालिका',
                'districtid' => '17',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मिथिला नगरपालिका',
                'districtid' => '17',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'शहीदनगर नगरपालिका',
                'districtid' => '17',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सबैला नगरपालिका',
                'districtid' => '17',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कमला नगरपालिका',
                'districtid' => '17',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मिथिला बिहारी नगरपालिका',
                'districtid' => '17',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'हंसपुर नगरपालिका',
                'districtid' => '17',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'जनकनन्दिनी गाउँपालिका',
                'districtid' => '17',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बटेश्वर गाउँपालिका',
                'districtid' => '17',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मुखियापट्टी मुसहरमिया गाउँपालिका',
                'districtid' => '17',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लक्ष्मीनिया गाउँपालिका',
                'districtid' => '17',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'औरही गाउँपालिका',
                'districtid' => '17',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'धनौजी गाउँपालिका',
                'districtid' => '17',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'जलेश्वर नगरपालिका',
                'districtid' => '18',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बर्दिबास नगरपालिका',
                'districtid' => '18',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गौशाला नगरपालिका',
                'districtid' => '18',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लोहरपट्टी नगरपालिका',
                'districtid' => '18',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रामगोपालपुर नगरपालिका',
                'districtid' => '18',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मनरा शिसवा नगरपालिका',
                'districtid' => '18',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मटिहानी नगरपालिका',
                'districtid' => '18',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भँगाहा नगरपालिका',
                'districtid' => '18',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बलवा नगरपालिका',
                'districtid' => '18',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'औरही नगरपालिका',
                'districtid' => '18',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'एकडारा गाउँपालिका',
                'districtid' => '18',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सोनमा गाउँपालिका',
                'districtid' => '18',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'साम्सी गाउँपालिका',
                'districtid' => '18',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'महोत्तरी गाउँपालिका',
                'districtid' => '18',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पिपरा गाउँपालिका',
                'districtid' => '18',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ईश्वरपुर नगरपालिका',
                'districtid' => '19',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मलंगवा नगरपालिका',
                'districtid' => '19',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लालबन्दी नगरपालिका',
                'districtid' => '19',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'हरिपुर नगरपालिका',
                'districtid' => '19',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'हरिपुर्वा नगरपालिका',
                'districtid' => '19',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'हरिवन नगरपालिका',
                'districtid' => '19',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बरहथवा नगरपालिका',
                'districtid' => '19',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बलरा नगरपालिका',
                'districtid' => '19',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गोडैटा नगरपालिका',
                'districtid' => '19',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बागमती नगरपालिका',
                'districtid' => '19',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कविलासी नगरपालिका',
                'districtid' => '19',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चक्रघट्टा गाउँपालिका',
                'districtid' => '19',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चन्द्रनगर गाउँपालिका',
                'districtid' => '19',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'धनकौल गाउँपालिका',
                'districtid' => '19',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ब्रह्मपुरी गाउँपालिका',
                'districtid' => '19',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रामनगर गाउँपालिका',
                'districtid' => '19',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'विष्णु गाउँपालिका',
                'districtid' => '19',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कौडेना गाउँपालिका',
                'districtid' => '19',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पर्सा गाउँपालिका',
                'districtid' => '19',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बसबरीया गाउँपालिका',
                'districtid' => '19',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कमलामाई नगरपालिका',
                'districtid' => '20',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'दुधौली नगरपालिका',
                'districtid' => '20',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गोलन्जर गाउँपालिका',
                'districtid' => '20',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'घ्याङलेख गाउँपालिका',
                'districtid' => '20',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'तीनपाटन गाउँपालिका',
                'districtid' => '20',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'फिक्कल गाउँपालिका',
                'districtid' => '20',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मरिण गाउँपालिका',
                'districtid' => '20',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सुनकोशी गाउँपालिका',
                'districtid' => '20',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'हरिहरपुरगढी गाउँपालिका',
                'districtid' => '20',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मन्थली नगरपालिका',
                'districtid' => '21',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रामेछाप नगरपालिका',
                'districtid' => '21',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'उमाकुण्ड गाउँपालिका',
                'districtid' => '21',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'खाँडादेवी गाउँपालिका',
                'districtid' => '21',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गोकुलगङ्गा गाउँपालिका',
                'districtid' => '21',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'दोरम्बा गाउँपालिका',
                'districtid' => '21',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लिखु तामाकोशी गाउँपालिका',
                'districtid' => '21',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सुनापती गाउँपालिका',
                'districtid' => '21',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'जिरी नगरपालिका',
                'districtid' => '22',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भिमेश्वर नगरपालिका',
                'districtid' => '22',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कालिन्चोक गाउँपालिका',
                'districtid' => '22',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गौरीशङ्कर गाउँपालिका',
                'districtid' => '22',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'तामाकोशी गाउँपालिका',
                'districtid' => '22',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मेलुङ्ग गाउँपालिका',
                'districtid' => '22',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'विगु गाउँपालिका',
                'districtid' => '22',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'वैतेश्वर गाउँपालिका',
                'districtid' => '22',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'शैलुङ्ग गाउँपालिका',
                'districtid' => '22',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चौतारा साँगाचोकगढी नगरपालिका',
                'districtid' => '23',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बाह्रविसे नगरपालिका',
                'districtid' => '23',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मेलम्ची नगरपालिका',
                'districtid' => '23',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ईन्द्रावती गाउँपालिका',
                'districtid' => '23',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'जुगल गाउँपालिका',
                'districtid' => '23',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पाँचपोखरी थाङपाल गाउँपालिका',
                'districtid' => '23',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बलेफी गाउँपालिका',
                'districtid' => '23',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भोटेकोशी गाउँपालिका',
                'districtid' => '23',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लिसङ्खु पाखर गाउँपालिका',
                'districtid' => '23',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सुनकोशी गाउँपालिका',
                'districtid' => '23',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'हेलम्बु गाउँपालिका',
                'districtid' => '23',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'त्रिपुरासुन्दरी गाउँपालिका',
                'districtid' => '23',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'धुलिखेल नगरपालिका',
                'districtid' => '24',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बनेपा नगरपालिका',
                'districtid' => '24',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पनौती नगरपालिका',
                'districtid' => '24',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पाँचखाल नगरपालिका',
                'districtid' => '24',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'नमोबुद्ध नगरपालिका',
                'districtid' => '24',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मण्डनदेउपुर नगरपालिका',
                'districtid' => '24',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'खानीखोला गाउँपालिका',
                'districtid' => '24',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चौंरीदेउराली गाउँपालिका',
                'districtid' => '24',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'तेमाल गाउँपालिका',
                'districtid' => '24',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बेथानचोक गाउँपालिका',
                'districtid' => '24',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भुम्लु गाउँपालिका',
                'districtid' => '24',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'महाभारत गाँउपालिका',
                'districtid' => '24',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रोशी गाउँपालिका',
                'districtid' => '24',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ललितपुर महानगरपालिका',
                'districtid' => '25',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गोदावरी नगरपालिका',
                'districtid' => '25',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'महालक्ष्मी नगरपालिका',
                'districtid' => '25',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कोन्ज्योसोम गाउँपालिका',
                'districtid' => '25',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बागमती गाउँपालिका',
                'districtid' => '25',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'महाङ्काल गाउँपालिका',
                'districtid' => '25',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चाँगुनारायण नगरपालिका',
                'districtid' => '26',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भक्तपुर नगरपालिका',
                'districtid' => '26',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मध्यपुर थिमी नगरपालिका',
                'districtid' => '26',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सूर्यविनायक नगरपालिका',
                'districtid' => '26',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'काठमाण्डौं महानगरपालिका',
                'districtid' => '27',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कागेश्वरी मनोहरा नगरपालिका',
                'districtid' => '27',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कीर्तिपुर नगरपालिका',
                'districtid' => '27',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गोकर्णेश्वर नगरपालिका',
                'districtid' => '27',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चन्द्रागिरी नगरपालिका',
                'districtid' => '27',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'टोखा नगरपालिका',
                'districtid' => '27',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'तारकेश्वर नगरपालिका',
                'districtid' => '27',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'दक्षिणकाली नगरपालिका',
                'districtid' => '27',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'नागार्जुन नगरपालिका',
                'districtid' => '27',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बुढानिलकण्ठ नगरपालिका',
                'districtid' => '27',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'शङ्खरापुर नगरपालिका',
                'districtid' => '27',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'विदुर नगरपालिका',
                'districtid' => '28',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बेलकोटगढी नगरपालिका',
                'districtid' => '28',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ककनी गाउँपालिका',
                'districtid' => '28',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'किस्पाङ गाउँपालिका',
                'districtid' => '28',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'तादी गाउँपालिका',
                'districtid' => '28',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'तारकेश्वर गाउँपालिका',
                'districtid' => '28',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'दुप्चेश्वर गाउँपालिका',
                'districtid' => '28',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पञ्चकन्या गाउँपालिका',
                'districtid' => '28',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लिखु गाउँपालिका',
                'districtid' => '28',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'म्यगङ गाउँपालिका',
                'districtid' => '28',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'शिवपुरी गाउँपालिका',
                'districtid' => '28',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सुर्यगढी गाउँपालिका',
                'districtid' => '28',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'उत्तरगया गाउँपालिका',
                'districtid' => '29',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कालिका गाउँपालिका',
                'districtid' => '29',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गोसाईकुण्ड गाउँपालिका',
                'districtid' => '29',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'नौकुण्ड गाउँपालिका',
                'districtid' => '29',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'आमाछोदिङमो गाउँपालिका',
                'districtid' => '29',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'धुनीबेंशी नगरपालिका',
                'districtid' => '30',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'निलकण्ठ नगरपालिका',
                'districtid' => '30',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'खनियाबास गाउँपालिका',
                'districtid' => '30',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गजुरी गाउँपालिका',
                'districtid' => '30',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गल्छी गाउँपालिका',
                'districtid' => '30',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गङ्गाजमुना गाउँपालिका',
                'districtid' => '30',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ज्वालामूखी गाउँपालिका',
                'districtid' => '30',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'थाक्रे गाउँपालिका',
                'districtid' => '30',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'नेत्रावती डबजोङ गाउँपालिका',
                'districtid' => '30',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बेनीघाट रोराङ्ग गाउँपालिका',
                'districtid' => '30',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रुवी भ्याली गाउँपालिका',
                'districtid' => '30',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सिद्धलेक गाउँपालिका',
                'districtid' => '30',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'त्रिपुरासुन्दरी गाउँपालिका',
                'districtid' => '30',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'हेटौडा उपमहानगरपालिका',
                'districtid' => '31',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'थाहा नगरपालिका',
                'districtid' => '31',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'इन्द्रसरोबर गाउँपालिका',
                'districtid' => '31',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कैलाश गाउँपालिका',
                'districtid' => '31',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बकैया गाउँपालिका',
                'districtid' => '31',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बाग्मति गाउँपालिका',
                'districtid' => '31',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भिमफेदी गाउँपालिका',
                'districtid' => '31',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मकवानपुरगढी गाउँपालिका',
                'districtid' => '31',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मनहरी गाउँपालिका',
                'districtid' => '31',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'राक्सिराङ्ग गाउँपालिका',
                'districtid' => '31',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चन्द्रपुर नगरपालिका',
                'districtid' => '32',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गरुडा नगरपालिका',
                'districtid' => '32',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गौर नगरपालिका',
                'districtid' => '32',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बौधीमाई नगरपालिका',
                'districtid' => '32',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बृन्दावन नगरपालिका',
                'districtid' => '32',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'देवाही गोनाही नगरपालिका',
                'districtid' => '32',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गढीमाई नगरपालिका',
                'districtid' => '32',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गुजरा नगरपालिका',
                'districtid' => '32',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कटहरिया नगरपालिका',
                'districtid' => '32',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'माधव नारायण नगरपालिका',
                'districtid' => '32',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मौलापुर नगरपालिका',
                'districtid' => '32',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'फतुवाबिजयपुर नगरपालिका',
                'districtid' => '32',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ईशनाथ नगरपालिका',
                'districtid' => '32',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'परोहा नगरपालिका',
                'districtid' => '32',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'राजपुर नगरपालिका',
                'districtid' => '32',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'राजदेवी नगरपालिका',
                'districtid' => '32',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'दुर्गा भगवती गाउँपालिका',
                'districtid' => '32',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'यमुनामाई गाउँपालिका',
                'districtid' => '32',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कलैया उपमहानगरपालिका',
                'districtid' => '33',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'जीतपुर सिमरा उपमहानगरपालिका',
                'districtid' => '33',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कोल्हवी नगरपालिका',
                'districtid' => '33',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'निजगढ नगरपालिका',
                'districtid' => '33',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'महागढीमाई नगरपालिका',
                'districtid' => '33',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सिम्रौनगढ नगरपालिका',
                'districtid' => '33',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पचरौता नगरपालिका',
                'districtid' => '33',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'आदर्श कोटवाल गाउँपालिका',
                'districtid' => '33',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'करैयामाई गाउँपालिका',
                'districtid' => '33',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'देवताल गाउँपालिका',
                'districtid' => '33',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'परवानीपुर गाउँपालिका',
                'districtid' => '33',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'प्रसौनी गाउँपालिका',
                'districtid' => '33',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'फेटा गाउँपालिका',
                'districtid' => '33',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बारागढी गाउँपालिका',
                'districtid' => '33',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सुवर्ण गाउँपालिका',
                'districtid' => '33',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'विश्रामपुर गाउँपालिका',
                'districtid' => '33',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बिरगंज महानगरपालिका',
                'districtid' => '34',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पोखरिया नगरपालिका',
                'districtid' => '34',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बहुदरमाई नगरपालिका',
                'districtid' => '34',
                'status' => 'Y',
            ],


            [
                'vdcormunicipalitiename' => 'पर्सागढी नगरपालिका',
                'districtid' => '34',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ठोरी गाउँपालिका',
                'districtid' => '34',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'जगरनाथपुर गाउँपालिका',
                'districtid' => '34',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'धोबीनी गाउँपालिका',
                'districtid' => '34',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'छिपहरमाई गाउँपालिका',
                'districtid' => '34',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पकाहा मैनपुर गाउँपालिका',
                'districtid' => '34',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बिन्दबासिनी गाउँपालिका',
                'districtid' => '34',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सखुवा प्रसौनी गाउँपालिका',
                'districtid' => '34',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पटेर्वा सुगौली गाउँपालिका',
                'districtid' => '34',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कालिकामाई गाउँपालिका',
                'districtid' => '34',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'जिरा भवानी गाउँपालिका',
                'districtid' => '34',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भरतपुर महानगरपालिका',
                'districtid' => '35',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कालिका नगरपालिका',
                'districtid' => '35',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'खैरहनी नगरपालिका',
                'districtid' => '35',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'माडी नगरपालिका',
                'districtid' => '35',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रत्ननगर नगरपालिका',
                'districtid' => '35',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'राप्ती नगरपालिका',
                'districtid' => '35',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'इच्छाकामना गाउँपालिका',
                'districtid' => '35',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गोरखा नगरपालिका',
                'districtid' => '36',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पालुङटार नगरपालिका',
                'districtid' => '36',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बारपाक सुलिकोट गाउँपालिका',
                'districtid' => '36',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सिरानचोक गाउँपालिका',
                'districtid' => '36',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'अजिरकोट गाउँपालिका',
                'districtid' => '36',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'आरूघाट गाउँपालिका',
                'districtid' => '36',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गण्डकी गाउँपालिका',
                'districtid' => '36',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चुमनुव्री गाउँपालिका',
                'districtid' => '36',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'धार्चे गाउँपालिका',
                'districtid' => '36',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भिमसेनथापा गाउँपालिका',
                'districtid' => '36',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'शहिद लखन गाउँपालिका',
                'districtid' => '36',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बेसीशहर नगरपालिका',
                'districtid' => '37',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मध्यनेपाल नगरपालिका',
                'districtid' => '37',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रार्इनास नगरपालिका',
                'districtid' => '37',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सुन्दरबजार नगरपालिका',
                'districtid' => '37',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'क्व्होलासोथार गाउँपालिका',
                'districtid' => '37',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'दूधपोखरी गाउँपालिका',
                'districtid' => '37',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'दोर्दी गाउँपालिका',
                'districtid' => '37',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मर्स्याङदी गाउँपालिका',
                'districtid' => '37',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भानु नगरपालिका',
                'districtid' => '38',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भिमाद नगरपालिका',
                'districtid' => '38',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'व्यास नगरपालिका',
                'districtid' => '38',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'शुक्लागण्डकी नगरपालिका',
                'districtid' => '38',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'आँबुखैरेनी गाउँपालिका',
                'districtid' => '38',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ऋषिङ्ग गाउँपालिका',
                'districtid' => '38',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'घिरिङ गाउँपालिका',
                'districtid' => '38',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'देवघाट गाउँपालिका',
                'districtid' => '38',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'म्याग्दे गाउँपालिका',
                'districtid' => '38',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'वन्दिपुर गाउँपालिका',
                'districtid' => '38',
                'status' => 'Y',
            ],


            [
                'vdcormunicipalitiename' => 'गल्याङ नगरपालिका',
                'districtid' => '39',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चापाकोट नगरपालिका',
                'districtid' => '39',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पुतलीबजार नगरपालिका',
                'districtid' => '39',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भीरकोट नगरपालिका',
                'districtid' => '39',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'वालिङ नगरपालिका',
                'districtid' => '39',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'अर्जुनचौपारी गाउँपालिका',
                'districtid' => '39',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'आँधिखोला गाउँपालिका',
                'districtid' => '39',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कालीगण्डकी गाउँपालिका',
                'districtid' => '39',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'फेदीखोला गाउँपालिका',
                'districtid' => '39',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बिरुवा गाउँपालिका',
                'districtid' => '39',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'हरिनास गाउँपालिका',
                'districtid' => '39',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पोखरा महानगरपालिका',
                'districtid' => '40',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'अन्नपूर्ण गाउँपालिका',
                'districtid' => '40',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'माछापुच्छ्रे गाउँपालिका',
                'districtid' => '40',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मादी गाउँपालिका',
                'districtid' => '40',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रूपा गाउँपालिका',
                'districtid' => '40',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चामे गाउँपालिका',
                'districtid' => '41',
                'status' => 'Y',
            ],


            [
                'vdcormunicipalitiename' => 'नार्पा भूमि गाउँपालिका',
                'districtid' => '41',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'नासोँ गाउँपालिका',
                'districtid' => '41',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मनाङ ङिस्याङ गाउँपालिका',
                'districtid' => '41',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'घरपझोङ गाउँपालिका',
                'districtid' => '42',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'थासाङ गाउँपालिका',
                'districtid' => '42',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लो-घेकर दामोदरकुण्ड गाउँपालिका',
                'districtid' => '42',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लोमन्थाङ गाउँपालिका',
                'districtid' => '42',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'वारागुङ मुक्तिक्षेत्र गाउँपालिका',
                'districtid' => '42',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बेनी नगरपालिका',
                'districtid' => '43',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'अन्नपुर्ण गाउँपालिका',
                'districtid' => '43',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'धवलागिरी गाउँपालिका',
                'districtid' => '43',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मंगला गाउँपालिका',
                'districtid' => '43',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मालिका गाउँपालिका',
                'districtid' => '43',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रघुगंगा गाउँपालिका',
                'districtid' => '43',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कुश्मा नगरपालिका',
                'districtid' => '44',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'फलेवास नगरपालिका',
                'districtid' => '44',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'जलजला गाउँपालिका',
                'districtid' => '44',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पैयूं गाउँपालिका',
                'districtid' => '44',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'महाशिला गाउँपालिका',
                'districtid' => '44',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मोदी गाउँपालिका',
                'districtid' => '44',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'विहादी गाउँपालिका',
                'districtid' => '44',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बागलुङ नगरपालिका',
                'districtid' => '45',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गल्कोट नगरपालिका',
                'districtid' => '45',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'जैमूनी नगरपालिका',
                'districtid' => '45',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ढोरपाटन नगरपालिका',
                'districtid' => '45',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'वरेङ गाउँपालिका',
                'districtid' => '45',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'काठेखोला गाउँपालिका',
                'districtid' => '45',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'तमानखोला गाउँपालिका',
                'districtid' => '45',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ताराखोला गाउँपालिका',
                'districtid' => '45',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'निसीखोला गाउँपालिका',
                'districtid' => '45',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'वडिगाड गाउँपालिका',
                'districtid' => '45',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मुसिकोट नगरपालिका',
                'districtid' => '46',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रेसुङ्गा नगरपालिका',
                'districtid' => '46',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ईस्मा गाउँपालिका',
                'districtid' => '46',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कालीगण्डकी गाउँपालिका',
                'districtid' => '46',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गुल्मी दरबार गाउँपालिका',
                'districtid' => '46',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सत्यवती गाउँपालिका',
                'districtid' => '46',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चन्द्रकोट गाउँपालिका',
                'districtid' => '46',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रुरुक्षेत्र गाउँपालिका',
                'districtid' => '46',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'छत्रकोट गाउँपालिका',
                'districtid' => '46',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'धुर्कोट गाउँपालिका',
                'districtid' => '46',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मदाने गाउँपालिका',
                'districtid' => '46',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मालिका गाउँपालिका',
                'districtid' => '46',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रामपुर नगरपालिका',
                'districtid' => '47',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'तानसेन नगरपालिका',
                'districtid' => '47',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'निस्दी गाउँपालिका',
                'districtid' => '47',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पूर्वखोला गाउँपालिका',
                'districtid' => '47',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रम्भा गाउँपालिका',
                'districtid' => '47',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'माथागढी गाउँपालिका',
                'districtid' => '47',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'तिनाउ गाउँपालिका',
                'districtid' => '47',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बगनासकाली गाउँपालिका',
                'districtid' => '47',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रिब्दिकोट गाउँपालिका',
                'districtid' => '47',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रैनादेवी छहरा गाउँपालिका',
                'districtid' => '47',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बुटवल उपमहानगरपालिका',
                'districtid' => '48',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'देवदह नगरपालिका',
                'districtid' => '48',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लुम्बिनी सांस्कृतिक नगरपालिका',
                'districtid' => '48',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सैनामैना नगरपालिका',
                'districtid' => '48',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सिद्धार्थनगर नगरपालिका',
                'districtid' => '48',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'तिलोत्तमा नगरपालिका',
                'districtid' => '48',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गैडहवा गाउँपालिका',
                'districtid' => '48',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कन्चन गाउँपालिका',
                'districtid' => '48',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कोटहीमाई गाउँपालिका',
                'districtid' => '48',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मर्चवारी गाउँपालिका',
                'districtid' => '48',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मायादेवी गाउँपालिका',
                'districtid' => '48',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ओमसतिया गाउँपालिका',
                'districtid' => '48',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रोहिणी गाउँपालिका',
                'districtid' => '48',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सम्मरीमाई गाउँपालिका',
                'districtid' => '48',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सियारी गाउँपालिका',
                'districtid' => '48',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'शुद्धोधन गाउँपालिका',
                'districtid' => '48',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कपिलवस्तु नगरपालिका',
                'districtid' => '49',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बुद्धभुमी नगरपालिका',
                'districtid' => '49',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'शिवराज नगरपालिका',
                'districtid' => '49',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'महाराजगंज नगरपालिका',
                'districtid' => '49',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कृष्णनगर नगरपालिका',
                'districtid' => '49',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बाणगंगा नगरपालिका',
                'districtid' => '49',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मायादेवी गाउँपालिका',
                'districtid' => '49',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'यसोधरा गाउँपालिका',
                'districtid' => '49',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सुद्धोधन गाउँपालिका',
                'districtid' => '49',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'विजयनगर गाउँपालिका',
                'districtid' => '49',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सन्धिखर्क नगरपालिका',
                'districtid' => '50',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'शितगंगा नगरपालिका',
                'districtid' => '50',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भूमिकास्थान नगरपालिका',
                'districtid' => '50',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'छत्रदेव गाउँपालिका',
                'districtid' => '50',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पाणिनी गाउँपालिका',
                'districtid' => '50',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मालारानी गाउँपालिका',
                'districtid' => '50',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'प्यूठान नगरपालिका',
                'districtid' => '51',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'स्वर्गद्वारी नगरपालिका',
                'districtid' => '51',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गौमुखी गाउँपालिका',
                'districtid' => '51',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'माण्डवी गाउँपालिका',
                'districtid' => '51',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सरुमारानी गाउँपालिका',
                'districtid' => '51',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मल्लरानी गाउँपालिका',
                'districtid' => '51',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'नौवहिनी गाउँपालिका',
                'districtid' => '51',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'झिमरुक गाउँपालिका',
                'districtid' => '51',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ऐरावती गाउँपालिका',
                'districtid' => '51',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रोल्पा नगरपालिका',
                'districtid' => '52',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'त्रिवेणी गाउँपालिका',
                'districtid' => '52',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'परिवर्तन गाउँपालिका',
                'districtid' => '52',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'माडी गाउँपालिका',
                'districtid' => '52',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रुन्टीगढी गाउँपालिका',
                'districtid' => '52',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लुङग्री गाउँपालिका',
                'districtid' => '52',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गंगादेव गाउँपालिका',
                'districtid' => '52',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सुनछहरी गाउँपालिका',
                'districtid' => '52',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सुनिल स्मृति गाउँपालिका',
                'districtid' => '52',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'थवाङ गाउँपालिका',
                'districtid' => '52',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मुसिकोट नगरपालिका',
                'districtid' => '53',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चौरजहारी नगरपालिका',
                'districtid' => '53',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'आठबिसकोट नगरपालिका',
                'districtid' => '53',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पुथा उत्तरगंगा गाउँपालिका',
                'districtid' => '54',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भूमे गाउँपालिका',
                'districtid' => '54',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सिस्ने गाउँपालिका',
                'districtid' => '54',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बाँफिकोट गाउँपालिका',
                'districtid' => '53',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'त्रिवेणी गाउँपालिका',
                'districtid' => '53',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सानी भेरी गाउँपालिका',
                'districtid' => '53',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'शारदा नगरपालिका',
                'districtid' => '55',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बागचौर नगरपालिका',
                'districtid' => '55',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बनगाड कुपिण्डे नगरपालिका',
                'districtid' => '55',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कालिमाटी गाउँपालिका',
                'districtid' => '55',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'त्रिवेणी गाउँपालिका',
                'districtid' => '55',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कपुरकोट गाउँपालिका',
                'districtid' => '55',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'छत्रेश्वरी गाउँपालिका',
                'districtid' => '55',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सिद्ध कुमाख गाउँपालिका',
                'districtid' => '55',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कुमाख गाउँपालिका',
                'districtid' => '55',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'दार्मा गाउँपालिका',
                'districtid' => '55',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'तुल्सीपुर उपमहानगरपालिका',
                'districtid' => '56',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'घोराही उपमहानगरपालिका',
                'districtid' => '56',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लमही नगरपालिका',
                'districtid' => '56',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बंगलाचुली गाउँपालिका',
                'districtid' => '56',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'दंगीशरण गाउँपालिका',
                'districtid' => '56',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गढवा गाउँपालिका',
                'districtid' => '56',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'राजपुर गाउँपालिका',
                'districtid' => '56',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'राप्ती गाउँपालिका',
                'districtid' => '56',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'शान्तिनगर गाउँपालिका',
                'districtid' => '56',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बबई गाउँपालिका',
                'districtid' => '56',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'नेपालगंज उपमहानगरपालिका',
                'districtid' => '57',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कोहलपुर नगरपालिका',
                'districtid' => '57',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'नरैनापुर गाउँपालिका',
                'districtid' => '57',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'राप्ती सोनारी गाउँपालिका',
                'districtid' => '57',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बैजनाथ गाउँपालिका',
                'districtid' => '57',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'खजुरा गाउँपालिका',
                'districtid' => '57',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'डुडुवा गाउँपालिका',
                'districtid' => '57',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'जानकी गाउँपालिका',
                'districtid' => '57',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गुलरिया नगरपालिका',
                'districtid' => '58',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मधुवन नगरपालिका',
                'districtid' => '58',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'राजापुर नगरपालिका',
                'districtid' => '58',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ठाकुरबाबा नगरपालिका',
                'districtid' => '58',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बाँसगढी नगरपालिका',
                'districtid' => '58',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बारबर्दिया नगरपालिका',
                'districtid' => '58',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बढैयाताल गाउँपालिका',
                'districtid' => '58',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गेरुवा गाउँपालिका',
                'districtid' => '58',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बीरेन्द्रनगर नगरपालिका',
                'districtid' => '59',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भेरीगंगा नगरपालिका',
                'districtid' => '59',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गुर्भाकोट नगरपालिका',
                'districtid' => '59',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पञ्चपुरी नगरपालिका',
                'districtid' => '59',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लेकवेशी नगरपालिका',
                'districtid' => '59',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चौकुने गाउँपालिका',
                'districtid' => '59',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बराहताल गाउँपालिका',
                'districtid' => '59',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चिङ्गाड गाउँपालिका',
                'districtid' => '59',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सिम्ता गाउँपालिका',
                'districtid' => '59',
                'status' => 'Y',
            ],


            [
                'vdcormunicipalitiename' => 'नारायण नगरपालिका',
                'districtid' => '60',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'दुल्लु नगरपालिका',
                'districtid' => '60',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चामुण्डा विन्द्रासैनी नगरपालिका',
                'districtid' => '60',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'आठबीस नगरपालिका',
                'districtid' => '60',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भगवतीमाई गाउँपालिका',
                'districtid' => '60',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गुराँस गाउँपालिका',
                'districtid' => '60',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'डुंगेश्वर गाउँपालिका',
                'districtid' => '60',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'नौमुले गाउँपालिका',
                'districtid' => '60',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'महावु गाउँपालिका',
                'districtid' => '60',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भैरवी गाउँपालिका',
                'districtid' => '60',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ठाँटीकाँध गाउँपालिका',
                'districtid' => '60',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भेरी नगरपालिका',
                'districtid' => '61',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'छेडागाड नगरपालिका',
                'districtid' => '61',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'नलगाड नगरपालिका',
                'districtid' => '61',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बारेकोट गाउँपालिका',
                'districtid' => '61',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कुसे गाउँपालिका',
                'districtid' => '61',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'जुनीचाँदे गाउँपालिका',
                'districtid' => '61',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'शिवालय गाउँपालिका',
                'districtid' => '61',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ठूली भेरी नगरपालिका',
                'districtid' => '62',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'त्रिपुरासुन्दरी नगरपालिका',
                'districtid' => '62',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'डोल्पो बुद्ध गाउँपालिका',
                'districtid' => '62',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'शे फोक्सुन्डो गाउँपालिका',
                'districtid' => '62',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'जगदुल्ला गाउँपालिका',
                'districtid' => '62',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मुड्केचुला गाउँपालिका',
                'districtid' => '62',
                'status' => 'Y',
            ],


            [
                'vdcormunicipalitiename' => 'काईके गाउँपालिका',
                'districtid' => '62',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => ' छार्का ताङसोङ गाउँपालिका',
                'districtid' => '62',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चन्दननाथ नगरपालिका',
                'districtid' => '63',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कनकासुन्दरी गाउँपालिका',
                'districtid' => '63',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सिंजा गाउँपालिका',
                'districtid' => '63',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'हिमा गाउँपालिका',
                'districtid' => '63',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'तिला गाउँपालिका',
                'districtid' => '63',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गुठिचौर गाउँपालिका',
                'districtid' => '63',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'तातोपानी गाउँपालिका',
                'districtid' => '63',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पातारासी गाउँपालिका',
                'districtid' => '63',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'खाँडाचक्र नगरपालिका',
                'districtid' => '64',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रास्कोट नगरपालिका',
                'districtid' => '64',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'तिलागुफा नगरपालिका',
                'districtid' => '64',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पचालझरना गाउँपालिका',
                'districtid' => '64',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सान्नी त्रिवेणी गाउँपालिका',
                'districtid' => '64',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'नरहरिनाथ गाउँपालिका',
                'districtid' => '64',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'शुभ कालीका गाउँपालिका',
                'districtid' => '64',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'महावै गाउँपालिका',
                'districtid' => '64',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पलाता गाउँपालिका',
                'districtid' => '64',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'छायाँनाथ रारा नगरपालिका',
                'districtid' => '65',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मुगुम कार्मारोंग गाउँपालिका',
                'districtid' => '65',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सोरु गाउँपालिका',
                'districtid' => '65',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'खत्याड गाउँपालिका',
                'districtid' => '65',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सिमकोट गाउँपालिका',
                'districtid' => '66',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'नाम्खा गाउँपालिका',
                'districtid' => '66',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'खार्पुनाथ गाउँपालिका',
                'districtid' => '66',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सर्केगाड गाउँपालिका',
                'districtid' => '66',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चंखेली गाउँपालिका',
                'districtid' => '66',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'अदानचुली गाउँपालिका',
                'districtid' => '66',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ताँजाकोट गाउँपालिका',
                'districtid' => '66',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बडीमालिका नगरपालिका',
                'districtid' => '67',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'त्रिवेणी नगरपालिका',
                'districtid' => '67',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बुढीगंगा नगरपालिका',
                'districtid' => '67',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बुढीनन्दा नगरपालिका',
                'districtid' => '67',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गौमुल गाउँपालिका',
                'districtid' => '67',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'जगन्‍नाथ गाउँपालिका',
                'districtid' => '67',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'स्वामीकार्तिक खापर गाउँपालिका',
                'districtid' => '67',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'खप्तड छेडेदह गाउँपालिका',
                'districtid' => '67',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'हिमाली गाउँपालिका',
                'districtid' => '67',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'जयपृथ्वी नगरपालिका',
                'districtid' => '68',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बुंगल नगरपालिका',
                'districtid' => '68',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'तलकोट गाउँपालिका',
                'districtid' => '68',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मष्टा गाउँपालिका',
                'districtid' => '68',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'खप्तडछान्ना गाउँपालिका',
                'districtid' => '68',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'थलारा गाउँपालिका',
                'districtid' => '68',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'वित्थडचिर गाउँपालिका',
                'districtid' => '68',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सूर्मा गाउँपालिका',
                'districtid' => '68',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'छबिसपाथिभेरा गाउँपालिका',
                'districtid' => '68',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'दुर्गाथली गाउँपालिका',
                'districtid' => '68',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'केदारस्युँ गाउँपालिका',
                'districtid' => '68',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'साइपाल गाउँपालिका',
                'districtid' => '68',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मंगलसेन नगरपालिका',
                'districtid' => '69',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कमलबजार नगरपालिका',
                'districtid' => '69',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'साँफेबगर नगरपालिका',
                'districtid' => '69',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पन्चदेवल विनायक नगरपालिका',
                'districtid' => '69',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => ' चौरपाटी गाउँपालिका',
                'districtid' => '69',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मेल्लेख गाउँपालिका',
                'districtid' => '69',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बान्निगढी जयगढ गाउँपालिका',
                'districtid' => '69',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रामारोशन गाउँपालिका',
                'districtid' => '69',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ढकारी गाउँपालिका',
                'districtid' => '69',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'तुर्माखाँद गाउँपालिका',
                'districtid' => '69',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'दिपायल सिलगढी नगरपालिका',
                'districtid' => '70',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'शिखर नगरपालिका',
                'districtid' => '70',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पूर्वीचौकी गाउँपालिका',
                'districtid' => '70',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बडीकेदार गाउँपालिका',
                'districtid' => '70',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'जोरायल गाउँपालिका',
                'districtid' => '70',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सायल गाउँपालिका',
                'districtid' => '70',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'आदर्श गाउँपालिका',
                'districtid' => '70',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'के.आई.सिं. गाउँपालिका',
                'districtid' => '70',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बोगटान फुड्सिल गाउँपालिका',
                'districtid' => '70',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'धनगढी उपमहानगरपालिका',
                'districtid' => '71',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'टिकापुर नगरपालिका',
                'districtid' => '71',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'घोडाघोडी नगरपालिका',
                'districtid' => '71',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लम्कीचुहा नगरपालिका',
                'districtid' => '71',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भजनी नगरपालिका',
                'districtid' => '71',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गोदावरी नगरपालिका',
                'districtid' => '71',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गौरीगंगा नगरपालिका',
                'districtid' => '71',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'जानकी गाउँपालिका',
                'districtid' => '71',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बर्दगोरिया गाउँपालिका',
                'districtid' => '71',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मोहन्याल गाउँपालिका',
                'districtid' => '71',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कैलारी गाउँपालिका',
                'districtid' => '71',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'जोशीपुर गाउँपालिका',
                'districtid' => '71',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'चुरे गाउँपालिका',
                'districtid' => '71',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भीमदत्त नगरपालिका',
                'districtid' => '72',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पुर्नवास नगरपालिका',
                'districtid' => '72',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'वेदकोट नगरपालिका',
                'districtid' => '72',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'महाकाली नगरपालिका',
                'districtid' => '72',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'शुक्लाफाँटा नगरपालिका',
                'districtid' => '72',
                'status' => 'Y',
            ],


            [
                'vdcormunicipalitiename' => 'बेलौरी नगरपालिका',
                'districtid' => '72',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कृष्णपुर नगरपालिका',
                'districtid' => '72',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बेलडाडी गाउँपालिका',
                'districtid' => '72',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लालझाडी गाउँपालिका',
                'districtid' => '72',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'अमरगढी नगरपालिका',
                'districtid' => '73',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'परशुराम नगरपालिका',
                'districtid' => '73',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'आलिताल गाउँपालिका',
                'districtid' => '73',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'भागेश्वर गाउँपालिका',
                'districtid' => '73',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'नवदुर्गा गाउँपालिका',
                'districtid' => '73',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'अजयमेरु गाउँपालिका',
                'districtid' => '73',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गन्यापधुरा गाउँपालिका',
                'districtid' => '73',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'दशरथचन्द नगरपालिका',
                'districtid' => '74',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पाटन नगरपालिका',
                'districtid' => '74',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मेलौली नगरपालिका',
                'districtid' => '74',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पुर्चौडी नगरपालिका',
                'districtid' => '74',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सुर्नया गाउँपालिका',
                'districtid' => '74',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सिगास गाउँपालिका',
                'districtid' => '74',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'शिवनाथ गाउँपालिका',
                'districtid' => '74',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पञ्चेश्वर गाउँपालिका',
                'districtid' => '74',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'दोगडाकेदार गाउँपालिका',
                'districtid' => '74',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'डीलासैनी गाउँपालिका',
                'districtid' => '74',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'महाकाली नगरपालिका',
                'districtid' => '75',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'शैल्यशिखर नगरपालिका',
                'districtid' => '75',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मालिकार्जुन गाउँपालिका',
                'districtid' => '75',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'अपिहिमाल गाउँपालिका',
                'districtid' => '75',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'दुहुँ गाउँपालिका',
                'districtid' => '75',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'नौगाड गाउँपालिका',
                'districtid' => '75',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मार्मा गाउँपालिका',
                'districtid' => '75',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'लेकम गाउँपालिका',
                'districtid' => '75',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'ब्याँस गाउँपालिका',
                'districtid' => '75',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'कावासोती नगरपालिका',
                'districtid' => '76',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'गैडाकोट नगरपालिका',
                'districtid' => '76',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'देवचुली नगरपालिका',
                'districtid' => '76',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'मध्यविन्दु नगरपालिका',
                'districtid' => '76',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बौदीकाली गाउँपालिका',
                'districtid' => '76',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बुलिङटार गाउँपालिका',
                'districtid' => '76',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'विनयी त्रिवेणी गाउँपालिका',
                'districtid' => '76',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'हुप्सेकोट गाउँपालिका',
                'districtid' => '76',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'बर्दघाट नगरपालिका',
                'districtid' => '77',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'रामग्राम नगरपालिका',
                'districtid' => '77',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सुनवल नगरपालिका',
                'districtid' => '77',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सुस्ता गाउँपालिका',
                'districtid' => '77',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'पाल्हीनन्दन गाउँपालिका',
                'districtid' => '77',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'प्रतापपुर गाउँपालिका',
                'districtid' => '77',
                'status' => 'Y',
            ],

            [
                'vdcormunicipalitiename' => 'सरावल गाउँपालिका',
                'districtid' => '77',
                'status' => 'Y',
            ],
        ]);
    }
}
