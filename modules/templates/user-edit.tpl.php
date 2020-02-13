<form class="dp-add-user">
	<input type="text" name="username" placeholder="Tên đăng nhập" value="{@username}" />
	<input type="text" name="email" placeholder="Email" value="{@email}" />
	<select name="type" style="margin-left: 0; width: 40%; margin-bottom: 0;">
		<option value="">Chọn loại</option>
		{@types}
	</select>
	<input type="hidden" name="id" value="{@id}" />
	<input type="text" name="password" placeholder="Mật khẩu" value="{@password}" />
	<input type="submit" value="Lưu" id="user-edit-btn" />
</form>
