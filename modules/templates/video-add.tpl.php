<form action="" method="post" name="dp_add_video" class="dp-add-cate">
	<input type="text" id="video-name" name="video_name" placeholder="Tên video" />
	<label>Chọn khóa học:</label><select name="video_product">
		<option>Chọn khóa học</option>
		{@products}
	</select><br />
	<label>Video: </label>
	<input type="file" class="js_upload-input" accept="video/*" />
	<input class="product_add js_upload-output" type="hidden" name="video_source" readonly />
	<textarea class="product_add center-block" rows="10" cols="50" name="video_des" placeholder="Mô tả" style="width: 50%"></textarea>

	<br /><br />
	<input type="submit" id="js_add-new-video-btn" name="save_new_video" value="Thêm Video" />
</form>
