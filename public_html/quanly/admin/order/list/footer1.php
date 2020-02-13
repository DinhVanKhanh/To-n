<!-- footer -->
<?php
if (!isset($rt)) die();
include('../../apps/bootstrap.php');
$a = new apps_libs_Dbconn();
$id = $_GET['id'];
if(!empty($_POST['sua'])){
    $cot1 = $_POST['col1'];
    $cot2 = $_POST['col2'];
    $cot3 = $_POST['col3'];
    if(isset($_POST['sua'])){
        $sql = "update optionn set cot1 = '{$_POST['col1']}', cot2 = '$cot2', cot3 = '$cot3' where id = $id";
        $a->Querry($sql);
    }
}
//connect & select database
$sql = "select * from optionn";                     
$run = $a->Querry($sql);

while ($dong=mysqli_fetch_assoc($run)){  
 ?>
 <form method="post" onsubmit="get_data()"> <!--get_data(): phần xử lý trong srcipt phía dưới: xử lí trong get data trước r-->
    <div class="h-padding">
        <div class="row">
            <h1 class="page-header">Chỉnh sửa footer</h1>
        </div>
        <div class="row">  
            <div class="h-block h-padding">
                <div class="row">
                    <!--  -->
                    <div class="col-sm-4"  >
                        <h3>Cột 1</h3>
                        <div id="editor1" contenteditable="true" style="border: 1px solid  black; min-height:300px">
                            <?php echo $dong['cot1'];?>
                        </div>
                        <textarea id="col1" name="col1" style="display:none"></textarea>
                    </div>
                    <div class="col-sm-4"  >
                        <h3>Cột 2</h3>
                        <div id="editor2" contenteditable="true"  style="border: 1px solid  black; min-height:300px">
                            <?php echo $dong['cot2'];?>
                        </div>
                        <textarea id="col2" name="col2" style="display:none"></textarea>
                    </div>
                    <div class="col-sm-4"  >
                        <h3>Cột 3</h3>
                        <div id="editor3" contenteditable="true"  style="padding:10px;border: 1px solid  black;height:300px;overflow-y:auto;overflow-x:hidden">
                            <?php echo $dong['cot3'];?>
                        </div>
                        <textarea id="col3" name="col3" style="display:none"></textarea>
                    </div>
                    <?php 
                          
                            echo "\n";
                            }
                    ?>
    </div>
        </div>
                <div class="col-sm-4 col-sm-push-10" style="margin-top:20px;">             
                    <input type="submit" name="sua" value="Cập nhật" class="btn btn-success" >
                </div>
         </div>
</form>

<?php
    // $tenloai = json_encode($tenloai);
    // var_dump($_POST);
    
    
   
?>


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

