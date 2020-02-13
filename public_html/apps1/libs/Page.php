<?php 
define("PARAM", "page");
class apps_libs_Page
{
    public $col;
    public $index;
    public $tablename;
    public $maxrow;
    public function apps_libs_Page($col, $index, $maxrow)
    {
        $this->col = $col;
        $this->index = $index;
        $this->tablename = $col['table'];
        $this->maxrow = $maxrow;
    }
    /*
    public function CreateTableA()
    {
        $data = $this->GetData();
        $table = "<table class='table table-bordered table-hover'>";
        $table .= "<tr>";
        foreach ($this->col['col'] as $key => $item) {
            if ($this->CheckBreak($item)) continue;
            $table .= "<th style='word-wrap: break-word;width:100px;'>";
            $table .= $key;
            $table .= "</th>";
        }
        $table .= "</tr>";

        if ($data)
            foreach ($data as $item) {
            $table .= "<tr>";
            foreach ($this->col['col'] as $key => $it) {
                if ($this->CheckBreak($it)) continue;
                if ($this->CupString($it) == $this->col['function']['in']) {
                    $table .= "<td style='word-wrap: break-word; width:100px;'><a href=\"" . $this->col['function']['link'] . $item[$this->col['function']['out']] . "\">";
                    $table .= $item[$this->CupString($it)];
                    $table .= "</a></td>";
                } else {
                    if ($this->CupString($it) == "timecreate") {
                        $table .= "<td>";
                        $table .= $this->FomatDate($item[$this->CupString($it)]);
                        $table .= "</td>";
                    } else {
                        $table .= "<td>";
                        $table .= $item[$this->CupString($it)];
                        $table .= "</td>";
                    }
                }
            }
            $table .= "</tr>";
        }

        $table .= "</table> ";

        return $table;
    }
    public function CreateTableFunction()
    {
        $data = $this->GetData();
        $table = "<table id='table' class='table table-striped table-hover'>";
        $table .= "<tr>";
        foreach ($this->col['col'] as $key => $item) {
            if ($this->CheckBreak($item)) continue;
            $table .= "<th>";
            $table .= $key;
            $table .= "</th>";
        }
        $table .= "</tr>";


        foreach ($data as $item) {
            if ($this->CheckBreakRow($item["id"])) {
                continue;
            }
            $table .= "<tbody><tr id=\"tr" . $item[$this->col['function']['out']] . "\">";
            foreach ($this->col['col'] as $key => $it) {
                if ($this->CheckBreak($it)) continue;
                if ($this->CupString($it) == $this->col['function']['in']) {
                    $table .= "<td><div class=\"checkbox\"><label><input class='h-cheack' type='checkbox' id=\"" . $item[$this->col['function']['out']] . "\">";
                    $table .= $item[$this->CupString($it)];
                    $table .= "</label>
                    </div></td>";
                } else {
                    $table .= "<td>";
                    $table .= $item[$this->CupString($it)];
                    $table .= "</td>";
                }
            }
            $table .= "</tr></tbody>";
        }

        $table .= "</table> ";

        return $table;
    }
    public function CreateListNumberFunction()
    {
        $count = $this->GetCount();
        $maxindex = (int)($count / $this->maxrow);
        if ($maxindex != $count / $this->maxrow) $maxindex += 1;

        $div = "<div class=\"\">";
        if ($this->index - 3 > 1) {
            $div .= "<button onclick=\"load_ajax('1')\" class='list-index btn' ><span>1</span></button>";
            $div .= "<button class='list-index btn' ><span>...</span></button>";
          }
        for ($i = 1; $i <= $maxindex; $i++)
            if ($i == $this->index)
            $div .= "<button onclick=\"load_ajax('" . $i . "')\" style='background-color:#337ab7;color:#fff' class='list-index btn'><span>" . $i . "</span></button>";
        else {
            if ($i >= $this->index - 3 && $i <= $this->index + 3)
                $div .= "<button onclick=\"load_ajax('" . $i . "')\" class='list-index btn' ><span>" . $i . "</span></button>";
        }
        if ($this->index + 3 < $maxindex) {
            $div .= "<button class='list-index btn' ><span>...</span></button>";
            $div .= "<button onclick=\"load_ajax('" . $maxindex . "')\" class='list-index btn' ><span>" . $maxindex . "</span></button>";
        }
        $div .= "</div>";

        return $div;
    }
    public function CreateTable()
    {
        $data = $this->GetData();
        $table = "<table class='table table-striped table-hover'>";
        $table .= "<tr>";
        foreach ($this->col['col'] as $key => $item) {
            if ($this->CheckBreak($item)) continue;
            $table .= "<th>";
            $table .= $key;
            $table .= "</th>";
        }
        $table .= "</tr>";


        foreach ($data as $item) {
            $table .= "<tr>";
            foreach ($this->col['col'] as $key => $it) {
                if ($this->CheckBreak($it)) continue;
                $table .= "<td>";
                $table .= $item[$this->CupString($it)];
                $table .= "</td>";
            }
            $table .= "</tr>";
        }

        $table .= "</table> ";

        return $table;
    }
    public function CreateListNumber()
    {
        $count = $this->GetCount();
        $maxindex = (int)($count / $this->maxrow);
        if ($maxindex != $count / $this->maxrow) $maxindex += 1;

        $div = "<div><ul class=\"h-ul\">";

        for ($i = 1; $i <= $maxindex; $i++)
            if ($i == $this->index)
            $div .= "<li><a style='background-color:#337ab7;color:#fff' class='list-index' href='?" . $this->GetLinkNow() . "&" . PARAM . "=" . $i . "'><span>" . $i . "</span></a></li>";
        else $div .= "<li><a class='list-index' href='?" . $this->GetLinkNow() . "&" . PARAM . "=" . $i . "'><span>" . $i . "</span></a></li>";
        $div .= "</div></ul>";

        return $div;
    }
    */
    function CheckBreakRow($cheack)
    {
        if (isset($this->col["breakrow"]))
            if ($this->col["breakrow"])
            foreach ($this->col['breakrow'] as $item) {
            if ($cheack == $item) return true;
        }
        return false;
    }

    function CheckBreak($cheack)
    {
        foreach ($this->col['break'] as $item) {
            if ($cheack == $item) return true;
        }
        return false;
    }
    public function FomatDate($date)
    {
        return explode(" ", $date)[0];
        //return is_string($date)?"string":"nostring";
    }
    public function GetLinkNow()
    {
        $string = explode("&" . PARAM, $_SERVER['QUERY_STRING'])[0];
        if (sizeof(explode("&" . PARAM, $_SERVER['QUERY_STRING'])) > 1)
            $string .= strstr(explode("&" . PARAM, $_SERVER['QUERY_STRING'])[1], "&");
        return $string;
    }
    public function GetData()
    {
        $select = '';
        foreach ($this->col['col'] as $item) $select .= $item . ',';
        $select = rtrim($select, ",");
        $param = [
            "select" => $select,
            "from" => $this->tablename,
            "where" => $this->col['where'],
            "limit" => $this->GetFirt() . "," . $this->GetMax()
        ];

        $db = new apps_libs_Dbconn();
        $result = $db->Select($param);
        var_dump($result);die;
        $data = null;
        
        $i = 0;
        if ($result)
            while ($row = mysqli_fetch_assoc($result)) {
            $data[$i] = array("" => "");
            foreach ($this->col['col'] as $key => $item) {
                $data[$i] = array_merge($data[$i], [
                    $this->CupString($item) => $row[$this->CupString($item)]
                ]);
            }
            $i++;
        }
        return $data;
    }

    function CupString($string)
    {
        $string = explode(" as ", $string);
        if (sizeof($string) > 1) return $string[1];
        else $string = $string[0];

        $string = explode(".", $string);
        if (sizeof($string) > 1) return $string[1];
        else return $string[0];
    }

    function GetMax()
    {
        $count = $this->GetCount();
        $maxindex = (int)($count / $this->maxrow);
        if ($maxindex != $count / $this->maxrow) $maxindex += 1;
        if ($this->index > $maxindex) return 0;
        if ($this->index == $maxindex) return ($count - (($this->index - 1) * $this->maxrow));
        if ($this->index < $maxindex) return $this->maxrow;
    }
    function GetFirt()
    {
        $count = $this->GetCount();
        return ($this->index - 1) * $this->maxrow;
    }
    function GetCount()
    {
        $param;
        if (isset($this->col['tablechild'])) {
            $select = '';
            foreach ($this->col['col'] as $item) $select .= $item . ',';
            $select = rtrim($select, ",");
            $db = new apps_libs_Dbconn();
            $querymini = $db->Select([
                "select" => $select,
                "from" => $this->col['table'],
                "where" => $this->col['where']
            ], 1);

            $param = [
                "select" => "COUNT(*) as number",
                "from" => "(" . $querymini . ") as a"
            ];
        } else {
            $param = [
                "select" => "COUNT(*) as number",
                "from" => $this->GetTable(),
                "where" =>$this->col['where']
            ];
        }

        $db = new apps_libs_Dbconn();
        $result = $db->SelectOne($param);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row['number']) return $row['number'];
        } else return 0;
    }
    function GetCols()
    {
        return $this->col["col"];
    }
    function GetTable()
    {
        return $this->col["table"];
    }
}
?>