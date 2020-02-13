<table class="dp-cate-mgmt">
	<tr>
		<td>Tên khóa học</td>
		<td>Danh mục</td>
		<td>Hình ảnh</td>
		<td>Giá</td>
		<td>Mô tả ngắn</td>
		<td>Mô tả</td>
		<td>Biên tập</td>
	</tr>
	{@products}
</table>
<!-- Modal -->
<div class="modal fade" id="viewAllKeys" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Danh sách key đã xuất của khóa học</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row" style="height: 50px;">
			<div class="col-md-4 col-md-offset-4" style="margin-top: 13px;">
				<span>Trang </span><input type="number" min="1" value="1" style="width: 50px;" name="allKeyPage">
			</div>
		</div>
        <table class="table table-striped table-bordered">
					<thead>
						<th width="5%">STT</th>
						<th width="40%">Mã key</th>
						<th width="20%">Ngày xuất</th>
						<th width="30%">Trạng thái</th>
					</thead>
					<tbody id="allKeyList">

					</tbody>
				</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
