<?php
include_once("../../autoload.php");
$database = new Database(HOST, USER, PASS, DBNAME);
$conn = $database->get_connection();

$sql = 'SELECT * FROM products;';
$query = $conn->prepare($sql);
$query->execute();

$productList = $query->fetchAll();

?>

<div class="container">
	<div class="row text-center" style="margin-top: 13px;">
		<form method="post" action="/modules/includes/document-add.inc.php" enctype="multipart/form-data">
			<input class="form-control center-block" type="text" placeholder="Tên tài liệu" name="documentName" style="max-height: 60px; max-width: 50%">
			<h3>Chọn file</h3>
			<input type="file" name="documentFile" class="center-block" style="margin-top: 20px;">

			<h3 style="margin-top: 20px;">Chọn khóa học</h3>
			<select name="productID">
				<option>Chọn khóa học cho tài liệu</option>
				<?php
					foreach($productList as $key => $product){
						echo '<option value="'.$product['product_id'].'">'.$product['product_name'].'</option>';
					};
				?>
			</select>
			<input type="submit" class="btn btn-success center-block" style="margin-top: 20px;" value="Tải tài liệu lên khóa học">
		</form>
	</div> 
</div>