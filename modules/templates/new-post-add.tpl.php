<section class="dp-new-post">
	<form action="" method="post"> 
		<input type="text" name="post_title" placeholder="Tên bài viết" />
		<select name="post_cate">
			<option>Danh mục</option>
			{@cates}
		</select>
		<input type="text" name="post_tags" placeholder="Từ khóa (phân cách bằng dấu phẩy)" />
		<input type="hidden" name="inserting" value="1" />
		<input type="submit" name="post_btn" id="post-btn" value="Xuất bản" />
		<textarea name="post_content" id="dp-wysiwyg" class="dp-wysiwyg"></textarea>


	</form>
</section>