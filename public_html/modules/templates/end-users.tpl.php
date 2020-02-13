<ul class="dp-2nd-menu">
	<li class="dp-2nd-menu-item">Quản lý thành viên</li>
</ul>
<div class="dp-2nd-main" id=userEditDiv>
	<div class="container">
		<div class="row" style="height: 50px;">
			<div class="col-md-4 col-md-offset-4" style="margin-top: 13px;">
				<span>Trang </span><input type="number" min="1" value="1" style="width: 35px;" name="memberPage">
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<table class="table table-striped table-bordered">
					<thead>
						<th width="5%">STT</th>
						<th width="10%">Tên tài khoản</th>
						<th width="15%">Ngày đăng ký</th>
						<th width="15%">Trạng thái</th>
						<th width="40%">Thao tác</th>
						<th width="15%">Khóa học đã mua</th>
					</thead>
					<tbody id="memberTableBody">

					</tbody>
				</table>
			</div>
		</div>
	</div>	
</div>

<!-- Modal -->
<div class="modal fade" id="viewUserOrders" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Danh sách khóa học đã mua của thành viên</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-bordered">
					<thead>
						<th width="5%">STT</th>
						<th width="40%">Tên khóa học</th>
						<th width="20%">Ngày mua</th>
						<th width="10%">Số lượng</th>
						<th width="30%">Xem trạng thái đơn hàng</th>
					</thead>
					<tbody id="memberOrderList">

					</tbody>
				</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>