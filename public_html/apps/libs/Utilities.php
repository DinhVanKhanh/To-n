<?php
class apps_libs_Utilities
{
    public function apps_libs_Utilities()
    {

    }
    public function GetMonthNow()
    {
        $date = Date('m/Y');
        $tach = explode("/", $date);
        $result = [
            "month" => $tach[0],
            "year" => $tach[1]
        ];
        return $result;
    }
    public function GetDateMonth($time)
    {
        if (!$time) return null;
        if (count(explode("-", $time)) != 2) return null;
        $cup = explode("-", $time);
        $result = [
            "month" => $cup[1],
            "year" => $cup[0]
        ];
        return $result;
    }
    public function PlusDateMonth($time)
    {
        if (!$time) return null;

        if ($time["month"] == 12) {
            $time["month"] = 1;
            $time["year"]++;
        } else $time["month"]++;
        return $time;
    }

    public function MinusDateMonth($time)
    {
        if (!$time) return null;

        if ($time["month"] == 1) {
            $time["month"] = 12;
            $time["year"]--;
        } else $time["month"]--;
        return $time;
    }

    public function GetDateMonthInDataBase($time, $edit = false)
    {
        if (!$time) return null;
        $time = explode(" ", $time)[0];
        $time = explode("-", $time);
        $time = $time[0] . "-" . $time[1];
        return $edit ? $this->GetDateMonth($time) : $time;
    }

    public function EditNumber($string)
    {
        $string = (string)$string;
        $new_string = '';
        $j = 0;
        for ($i = strlen($string) - 1; $i >= 0; $i--) {
            if ($j % 3 == 0 && $j != 0) $new_string .= ',';
            $new_string .= $string[$i];
            $j++;
        }
        $new_string = strrev($new_string);
        return $new_string;
        //return strrev($string);
    }

    public function EditNumberPercent($string)
    {
        $string = (string)$string;
        return $string += " %";
    }

    public function EditDataImportDB($data, $delete = true)
    {
        $data = (string)$data;
        $data = str_replace('\"','"' , $data);
        $data = str_replace("\'","'" , $data);
        if ($delete) {
            $data = str_replace("\"", "", $data);
            $data = str_replace("'", "", $data);
            return $data;
        } else {
            $data = str_replace("\"", '\"', $data);
            $data = str_replace("'", "\'", $data);
            return $data;
        }

    }

    public function EditTimeImportDB($time)
    {
        if (!$time) return null;
        $result = explode(":", $time);
        if ($result) {
            return $result[0] . $result[1] . "00";
        } else return null;
    }

    public function EditTimeShowNoti($time)
    {
        $time = explode(" ", $time);
        $time1 = explode("-", $time[0]);
        $time2 = explode(":", $time[1]);

        $time_edit = [
            "year" => $time1[0],
            "month" => $time1[1],
            "day" => $time1[2],
            "h" => $time2[0],
            "m" => $time2[1],
            "s" => $time2[2],
        ];

        $year_now = date('Y');
        $month_now = date('m');
        $day_now = date('d');

        if ($year_now == $time_edit["year"] && $month_now == $time_edit["month"] && $day_now == $time_edit["day"])
            return "Hôm nay lúc " . $time_edit["h"] . ":" . $time_edit["m"] . ":" . $time_edit["s"];

        if ($year_now == $time_edit["year"] && $month_now == $time_edit["month"] && (((int)$day_now) - 1) == ((int)$time_edit["day"]))
            return "Hôm qua lúc " . $time_edit["h"] . ":" . $time_edit["m"] . ":" . $time_edit["s"];

        return $time_edit["year"] . "-" . $time_edit["month"] . "-" . $time_edit["day"] . " lúc " . $time_edit["h"] . ":" . $time_edit["m"] . ":" . $time_edit["s"];
    }

    public function GetSOn2Date($date1, $date2)
    {
        $date1 = $this->CupDate($date1);
        $date2 = $this->CupDate($date2);

        return mktime($date1["h"], $date1["m"], $date1["s"], $date1["month"], $date1["day"], $date1["year"]) - mktime($date2["h"], $date2["m"], $date2["s"], $date2["month"], $date2["day"], $date2["year"]);
    }

    public function CupDate($date)
    {
        $date = explode(" ", $date);
        $date1 = explode("-", $date[0]);
        $date2 = explode(":", $date[1]);

        $date_edit = [
            "year" => $date1[0],
            "month" => $date1[1],
            "day" => $date1[2],
            "h" => $date2[0],
            "m" => $date2[1],
            "s" => $date2[2],
        ];

        return $date_edit;
    }

    function StripUnicode($str)
    {
        if (!$str) return false;
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd' => 'đ',
            'D' => 'Đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            '' => ',|.|?|!|@|#|$|%|^|&|*|(|)'
        );
        foreach ($unicode as $khongdau => $codau) {
            $arr = explode("|", $codau);
            $str = str_replace($arr, $khongdau, $str);
        }
        $str = str_replace(" ", "", $str);
        return $str;
    }

    function StripUnicodeTitle($str)
    {
        if (!$str) return false;
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd' => 'đ',
            'D' => 'Đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            '' => ',|.|?|!|@|#|$|%|^|&|*|(|)'
        );
        foreach ($unicode as $khongdau => $codau) {
            $arr = explode("|", $codau);
            $str = str_replace($arr, $khongdau, $str);
        }
        $str = str_replace(" ", "-", $str);
        return strtolower($str);
    }

    public function CreateTitle($id,$title)
    {
        return '<script>
        $("#'.$id.'").html("'.$title.'");
    </script>';
    }
}

?>