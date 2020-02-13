<?php
include_once("../../apps/libs/Dbconn.php");
$db=new apps_libs_Dbconn();

$cityValue=$_POST["cityValue"];
$select=isset($_POST["select"])?$_POST["select"]:"";
$select=trim($select);

$param=[
    "from"=>"devvn_quanhuyen",
    "select"=>"*",
    "where"=>"matp='$cityValue'"
];
$result=$db->Select($param);

$html = '
      <select id="reg_district" name="district"><option value="-1">Chọn quân huyện</option>
  ';
while($row=mysqli_fetch_assoc($result)){
    $select_t="";
    if($select)
        if($row["maqh"]==$select) $select_t="selected";
    $html .= '<option '.$select_t.' class="district" id="'.$row["maqh"].'" value="'.$row["maqh"].'">'. $row["name"] .'</option>';
};
$html .= '</select>';
echo $html;
?>