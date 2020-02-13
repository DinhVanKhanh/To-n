<?php
include('../../apps/bootstrap.php');
$a = new apps_libs_Dbconn();


// Cập nhật
// var_dump($_POST);
if(!empty($_POST['sua'])){
	$id = $_GET['id'];
	$cont = htmlspecialchars($_POST['col1'], ENT_QUOTES);
	// die($cont);
    if(isset($_POST['sua'])){
	    $sql = "update lienhe set noidung = '$cont' where id = $id"; 
	    $a->Querry($sql);
	}
}

$sql = "select * from lienhe";
$run = $a->Querry($sql);
while($dong = mysqli_fetch_assoc($run)){
	
	// var_dump(unserialize($dong['content']));die;
 ?>

<form method="post" id="main_form" action="#">
<div class="h-padding">
	<div class="row">
        <h1 class="page-header">Chỉnh sửa Phần liên hệ</h1>
    </div>
	<div class="row">
		 <div class="h-block h-padding">
		 	<div class="row">
			    <div class="col-sm-11">
			      <h3>Nội dung</h3>		         
					
		          <textarea id="col1" name="col1" style="display:none"><?=htmlspecialchars_decode($dong['noidung']);?></textarea>  
			    </div>	
			   	<?php }?>
			</div>	
		</div>
    </div>
    </div>
                <div class="col-sm-4 col-sm-push-10" style="margin-top:20px;">             
                    <input type="submit" name="sua" value="Cập nhật" class="btn btn-success" onclick='onsub($(this))'>
                </div>
         </div>
</div>
</form>

<script>
    // function get_data(){
    //     var val1 = $('#editor1').html();
    //     $('#col1').val(val1);
    //   }
    // Turn off automatic editor creation first.
    // CKEDITOR.disableAutoInline = true;
     // CKEDITOR.inline( 'editor1' );
     CKEDITOR.replace('col1'); // lấy name của textarea là col1
    function onsub(obj){
   
    	$('#main_form').submit();
    }
</script>