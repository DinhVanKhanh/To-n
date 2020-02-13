<?php
include_once("../../apps/libs/Dbconn.php");
$db=new apps_libs_Dbconn();

$cityValue=$_POST["cityValue"];
$select=isset($_POST["select"])?$_POST["select"]:"";
$select=trim($select);

$param=[
    "from"=>"devvn_xaphuongthitran",
    "select"=>"*",
    "where"=>"maqh='$cityValue'"
];
$result=$db->Select($param);

$html = '
      <select id="reg_ward" name="ward"><option value="-1">Chọn xã phường</option>
  ';
while($row=mysqli_fetch_assoc($result)){
    $select_t="";
    if($select)
        if($row["xaid"]==$select) $select_t="selected";
    $html .= '<option '.$select_t.' class="ward" id="'.$row["xaid"].'" value="'.$row["xaid"].'">'. $row["name"] .'</option>';
};
$html .= '</select>';
echo $html;
?>