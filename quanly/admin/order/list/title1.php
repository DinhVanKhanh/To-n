<?php
include('../../apps/bootstrap.php');
$a = new apps_libs_Dbconn();


// Cập nhật
if(!empty($_POST['sua'])){
	$id = $_GET['id'];
    $hinh1 = $_POST['col1'];
    $hinh2 = $_POST['col2'];  
    $hinh3 = $_POST['col3'];
    if(isset($_POST['sua'])){
    $sql = "update title1 set hinh1 = '{$_POST['col1']}', hinh2 = '$hinh2', hinh3 = '$hinh3' where id = $id";
    $a->Querry($sql);
	}
}

$sql = "select * from title1";
$run = $a->Querry($sql);
$dong = mysqli_fetch_array($run);

 ?>
 <form method="post" action="#" onclick="get_data()">
<div class="h-padding">
	<div class="row">
        <h1 class="page-header">Chỉnh sửa title1</h1>
    </div>
	<div class="row" >
		 <div class="h-block h-padding">
		 	<div class="row">
			    <div class="col-sm-4">
			      <h3>Hình 1</h3>
			      <div id="editor1" contenteditable="true" style="min-height:300px">
		             <?php echo $dong['hinh1']?>            
		          </div>
		          <textarea id="col1" name="col1" style="display:none"></textarea>  
		         	
			    </div>
			    <div class="col-sm-4">
			      <h3>Hình 2</h3>
			      <div id="editor2" contenteditable="true" style="min-height:300px">
		              <?php echo $dong['hinh2']?>
		          </div>
		          <textarea id="col2" name="col2" style="display:none"></textarea>           
			    </div>
			     <div class="col-sm-4">
			      <h3>Hình 3</h3>
			      <div id="editor3" contenteditable="true" style="min-height:300px">
		              <?php echo $dong['hinh3']?>
		          </div>          
		          <textarea id="col3" name="col3" style="display:none"></textarea>   
			    </div>
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
    function get_data(){
        var val1 = $('#editor1').html();
        var val2 = $('#editor2').html();
        var val3 = $('#editor3').html();
        $('#col1').val(val1);
        $('#col2').val(val2);
        $('#col3').val(val3);
    }
    // Turn off automatic editor creation first.
    CKEDITOR.disableAutoInline = true;
     CKEDITOR.inline( 'editor1' );
     CKEDITOR.inline( 'editor2' );
     CKEDITOR.inline( 'editor3' );
</script>