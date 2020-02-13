<?php
include('../../apps/bootstrap.php');
$a = new apps_libs_Dbconn();


// Cập nhật
if(!empty($_POST['sua'])){
	$id = $_GET['id'];
    if(isset($_POST['sua'])){
    	$cont = $_POST['col1'];
	    $sql = "update part_ttd set content = '$cont' where id = $id"; // $_POST['col1'] là name của textarea
	    $a->Querry($sql);
	}
}

$sql = "select * from part_ttd";
$run = $a->Querry($sql);
while($dong = mysqli_fetch_assoc($run)){
	// var_dump(unserialize($dong['content']));die;
 ?>
 <form method="post" onsubmit="get_data()">
<div class="h-padding">
	<div class="row">
        <h1 class="page-header">Chỉnh sửa Phần toán tư duy</h1>
    </div>
	<div class="row" >
		 <div class="h-block h-padding">
		 	<div class="row">
			    <div class="col-sm-11">
			      <h3>Nội dung</h3>		      
			     <!--  -->        
		          <textarea id="col1" name="col1" style="display:none"><?= $dong['content']?></textarea>  
			    </div>	
			   	<?php }?>
			</div>	
		</div>
    </div>
    </div>
                <div class="col-sm-4 col-sm-push-10" style="margin-top:20px;">             
                    <input type="submit" name="sua" value="Cập nhật" class="btn btn-success" >
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
     CKEDITOR.replace('col1');
    
</script>