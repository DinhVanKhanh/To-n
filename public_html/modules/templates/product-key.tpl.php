<div class="row" style="height: 50px;">
	<div class="col-md-4 col-md-offset-4" style="margin-top: 13px;">
		<span>Trang </span><input type="number" min="1" value="1" style="width: 50px;" name="mainKeyPage">
	</div>
</div>
<div class="form-group dp-cate-mgmt"> 
	<label class="control-label col-sm-2" for="email">Chọn khóa học:</label>
    <div class="col-sm-offset-2 col-sm-10">
		<div class="checkbox">
			<select onchange="select_product_key()" style="width:80%;" class="form-control" id="select_product_key">
			
			</select>
		</div>
    </div>
</div>
<table id="table_key" class="dp-cate-mgmt">
	<tr>
		<td>STT</td>
		<td>Code</td>
		<td>Khóa học</td>
		<td>Tình trạng</td>
		<td>Ngày tạo</td>
		<td>Biên tập</td>
	</tr>
	{@codes}
</table>
