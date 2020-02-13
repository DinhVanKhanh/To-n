<?php
include_once("../../autoload.php");
$database = new Database(HOST, USER, PASS, DBNAME);
$conn = $database->get_connection();

$sql = 'SELECT course_document.document_name AS TEN_TAI_LIEU, course_document.document_url AS LINK_TAI ,course_document.id AS ID, products.product_name AS TEN_KHOA_HOC FROM course_document JOIN products ON course_document.product_id = products.product_id;';

$query = $conn->prepare($sql);

$query->execute();

$table = $query->fetchAll();

?>

<div class="container">
	<div class="row" style="margin-top: 13px;">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên tài liệu</th>
					<th>Tên khóa học</th>
					<th>Thao tác</th>
				</tr>
			</thead>
			<tbody id="documentList">
				<?php
					foreach($table as $key => $document){
						echo '<tr>
							<td>'.$key.'</td>
							<td>'.$document['TEN_TAI_LIEU'].'</td>
							<td>'.$document['TEN_KHOA_HOC'].'</td>
							<td><a  href="'.$document['LINK_TAI'].'" class="btn btn-primary" download>Tải về</a><button class="btn btn-danger" value="'.$document['ID'].'" name="deleteDocument" style="margin-left: 20px">Xóa</button></td>
							</tr>
						';
					};
				?>
			</tbody>
		</table>
	</div> 
</div>