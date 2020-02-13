<form action="" method="post" name="dp_add_video" class="dp-add-cate">
	<input type="text" id="video-name" name="video_name" placeholder="Tên video" value="{@name}" />
	<label>Chọn khóa học:</label><select name="video_product">
		<option>Chọn khóa học</option>
		{@products}
	</select><br />
	<label>Video: </label>
	{@videos}
	<input type="file" class="js_upload-input" accept="video/*" />
	<input class="product_add js_upload-output" type="hidden" name="video_source" value={@video} readonly />
	<input class="product_add" type="hidden" name="video_id" value={@id} readonly />


	<textarea class="product_add" rows="10" cols="50" name="video_des" placeholder="Mô tả">{@des}</textarea>

	<br /><br />
	<input type="submit" id="js_edit-video-btn" name="save_new_video" value="Lưu" />
</form>
