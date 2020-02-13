<?php
$database = new Database(HOST, USER, PASS, DBNAME);
$conn = $database->get_connection();

$data = unserialize($_SESSION['data']);
$userId = $data['end_user_id'];
$sql = "SELECT product_id FROM bought_products WHERE user_id = :user ORDER BY product_id ASC;";
$query1 = $conn->prepare($sql);
$query1->execute(array(
	':user' => $userId
));

$html = '
		<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Tên khóa học đã mua</th>
						<th>Tên tài liệu khóa học</th>
						<th>Tải xuống</th>
					</tr>
				</thead>
				<tbody>
	';
while ($r = $query1->fetch(PDO::FETCH_ASSOC)) {

		//Get product
	$sql1 = "SELECT * FROM products WHERE product_id = :id;";
	$query2 = $conn->prepare($sql1);
	$query2->execute(array(
		':id' => $r['product_id']
	));
	$product = $query2->fetch(PDO::FETCH_ASSOC);

		//Get Product Document

	$sql2 = "SELECT * FROM course_document WHERE product_id = :id;";
	$query3 = $conn->prepare($sql2);
	$query3->execute(array(
		':id' => $product['product_id']
	));
	while ($document = $query3->fetch(PDO::FETCH_ASSOC)) {
		$html .= '
		<tr>
			<td>' . $product['product_name'] . '</td>';
		if ($document['document_url']) {
			$html .= '<td>' . $document['document_name'] . '</td>';
			$html .= '<td><a href="' . $document['document_url'] . '" download>Tải tài liệu khóa học</a></td>';
		} else {
			$html .= '<td>Chưa có tài liệu cho khóa học này</td>';
		};
		$html .= '</tr>';
	}


};
$html .= '
		</tbody>
	</table>';

echo $html;
?>
