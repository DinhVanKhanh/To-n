<div class="form-group dp-cate-mgmt"> 
	<label class="control-label col-sm-2" for="email">Chọn khóa học:</label>
    <div class="col-sm-offset-2 col-sm-10">
		<div class="checkbox">
			<select onchange="select_product_video()" style="width:80%;" class="form-control" id="select_product_video">
			
			</select>
		</div>
    </div>
</div>
<table id="table_video" class="dp-cate-mgmt">
	<tr>
		<td>Tên video</td>
		<td>Khóa học</td>
		<td>Xem thử</td>
		<td>Mô tả</td>
		<td>Biên tập</td>
	</tr>
	{@videos}
</table>
