<form action="" method="post" name="dp_add_product" class="dp-add-cate">
	<input class="product_add" type="text" id="product-name" name="product_name" placeholder="Tên khóa học" />
	<select class="product_add center-block" name="product_cate">
		<option class="product_add">Chọn danh mục</option>
		{@cates}
	</select class="product_add"><br />
	<label>Hình ảnh: </label>	<input type="file" class="js_upload-input" multiple accept="image/*" />
	<input class="product_add js_upload-output" type="hidden" name="product_image" readonly />
	<input class="product_add" type="text" name="product_price" placeholder="Giá" />
	<textarea class="product_add center-block" name="product_short_des" placeholder="Mô tả ngắn" style="width: 50%"></textarea><br /><br />
	<textarea class="product_add center-block" rows="10" cols="50" name="product_long_des" placeholder="Mô tả" style="width: 50%"></textarea>
	<input type="submit" id="js_add-new-product-btn" name="save_new_product" value="Thêm khóa học" />
</form>
