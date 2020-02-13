<h1>SỬA KHÓA HỌC</h1>
<form action="" method="post" name="dp_add_product" class="dp-add-cate">
	<input type="text" id="product-name" name="product_name" placeholder="Tên khóa học" value="{@name}" />
	<select name="product_cate">
		<option>Chọn danh mục</option>
		{@cates}
	</select><br /><br />
	<label>Hình ảnh: </label>
	{@images}
	<input type="file" class="js_upload-input" multiple />
	<input type="hidden" class="js_upload-output" name="product_image" value="{@image}" readonly />
	<input type="text" name="product_price" placeholder="Giá" value="{@price}" />
	<input type="hidden" name="product_id" value="{@id}" />
	<textarea name="product_short_des" placeholder="Mô tả ngắn">{@short_des}</textarea><br /><br />
	<textarea rows="10" cols="50" name="product_long_des" placeholder="Mô tả">{@des}</textarea>
	<input type="submit" id="js_edit-new-product-btn" name="save_new_product" value="Lưu khóa học" />
</form>
