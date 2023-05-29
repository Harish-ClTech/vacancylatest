<?php

    function sanitizeData ($post = [])
    {
        foreach ($post as $key=>$data)
        {
            $val = [];
            if (is_array($data)) {
                $var = '';
                foreach ($data as $rkey => $rval) {
                    $var = stripslashes($rval);
                    $var = strip_tags($var);
                    $var = htmlspecialchars($var);
                    $val[$rkey] = $var;
                } 
            } else {
                $val = trim($data);
                $val = stripslashes($val);
                $val = strip_tags($val);
                $val = htmlspecialchars($val);
            }
            $post[$key] = $val;
        }
        return $post;
    }


    function generateSymbolNumber ($fiscalyear, $level)
    {
        


    }


    function titleFontSize ($text, $fontSize)
    {
        $textLength = strlen($text);
        return $fontSize - ($textLength * 0.05);
    }

    function en_to_nep($number){
        $eng_number = ['0','1','2','3','4','5','6','7','8','9'];
        $nep_number = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];
        return str_replace($eng_number, $nep_number, $number);
    }
    
    function nep_to_en($number){
        $eng_number = ['0','1','2','3','4','5','6','7','8','9'];
        $nep_number = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];
        return str_replace($nep_number, $eng_number,  $number);
    }
