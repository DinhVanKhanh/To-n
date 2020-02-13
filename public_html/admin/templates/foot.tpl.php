	<script src="js/jquery-2.1.4.js"></script>
	<script src="js/tinymce/tinymce.min.js"></script>
	<script src="js/admin.js"></script>
	<script src="js/datatables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="js/datatables.min.css"/>

	<script>
		$(document).ready(function(){
			var pageNumber = $('input[name=memberPage]').val();

			$.ajax({
					url: '/modules/includes/member-page-render.inc.php',
					data: {pageNumber},
					dataType: 'JSON',
					type: 'POST',
					success: function(result){
							row = '';
						result.forEach(function(value, index){

							if (value[10] == 1) {
								userStatus = 'Đang hoạt động';
							} else {
								userStatus = 'Đang khóa';
							};

							row += '<tr>';
							row += '<td>'+(index+1)+'</td>';
							row += '<td>'+value[1]+'</td>';
							row += '<td>'+value[11]+'</td>';
							row += '<td class="userStatus">'+userStatus+'</td>';
							row += '<td><button class="btn btn-primary lockUser" status="'+value[10]+'" value="'+value[0]+'">Khóa / Mở</button> <button class="btn btn-warning" name="editUser" value="'+value[0]+'">Sửa</button> <button class="btn btn-info" name="showPassword" value="'+value[2]+'">Mật khẩu</button> <button class="btn btn-danger" name="deleteUser" value="'+value[0]+'">Xóa</button></td>';
							row += '<td><button type="button" name="viewUserOrders" data-toggle="modal" data-target="#viewUserOrders" value="'+value[0]+'" class="btn btn-primary">Xem</button></td>';
							row += '</tr>';

						});

						$('tbody#memberTableBody').html(row);
					}
				});
		});

		$(document).ready(function() {
			$('input[name=memberPage]').change(function(){
				var pageNumber = $(this).val();
				$.ajax({
					url: '/modules/includes/member-page-render.inc.php',
					data: {pageNumber},
					dataType: 'JSON',
					type: 'POST',
					success: function(result){
							row = '';
						result.forEach(function(value, index){
							if (value[10] == 1) {
								userStatus = 'Đang hoạt động';
							} else {
								userStatus = 'Đang khóa';
							};

							row += '<tr>';
							row += '<td>'+(index+1)+'</td>';
							row += '<td>'+value[1]+'</td>';
							row += '<td>'+value[11]+'</td>';
							row += '<td class="userStatus">'+userStatus+'</td>';
							row += '<td><button class="btn btn-primary lockUser" status="'+value[10]+'" value="'+value[0]+'">Khóa / Mở</button> <button class="btn btn-warning" name="editUser" value="'+value[0]+'">Sửa</button> <button class="btn btn-info" name="showPassword" value="'+value[2]+'">Mật khẩu</button> <button class="btn btn-danger" name="deleteUser" value="'+value[0]+'">Xóa</button></td>';
							row += '<td><button type="button" name="viewUserOrders" data-toggle="modal" data-target="#viewUserOrders" value="'+value[0]+'" class="btn btn-primary">Xem</button></td>';
							row += '</tr>';

						});

						$('tbody#memberTableBody').html(row);
					}
				});
			});
		});

		$(document).ready(function() {
			$(document).on('click', 'button.lockUser', function(){
				var targetUser = $(this).val();
				var userStatus = $(this).attr('status');
				$.ajax({
					url: '/modules/includes/lock-unlock-user.inc.php',
					data: {targetUser, userStatus},
					type: 'POST',
					dataType: 'JSON',

					success: function(result){
						alert(result['message']);
					}
				});

				var currentStatus = $(this).closest('td').siblings('.userStatus').text();

				if (currentStatus == 'Đang khóa'){
					$(this).attr('status', 1);
					$(this).closest('td').siblings('.userStatus').text('Đang hoạt động');
				} else {
					$(this).attr('status', 0);
					$(this).closest('td').siblings('.userStatus').text('Đang khóa');
				};
			})
		});

		$(document).ready(function(){
			$(document).on('click', 'button[name=showPassword]', function(){
				var userPassword = $(this).val();
				alert('Mật khẩu là: '+userPassword);
			});
		});

		$(document).ready(function(){
			$(document).on('click', 'button[name=deleteUser]', function(){
				var userID = $(this).val();
				$.ajax({
					url: '/modules/includes/delete-users.inc.php',
					data: {userID},
					type: 'POST',
					dataType: 'JSON',

					success: function(result){
						alert(result['message']);
					}
				});
				$(this).closest('tr').addClass('hidden');
				
			});
		});
		function select_product_video()
		{
			$.ajax({
			url: '/modules/includes/video-ajax.inc.php',
			data: {
				id:$("#select_product_video").val()
			},
			type: 'POST',
			dataType: 'TEXT',

				success: function(result){
					$("#table_video").html(result);
				}
			});
		}
		function select_product_key()
		{
			$.ajax({
			url: '/modules/includes/product-key-ajax.inc.php',
			data: {
				id:$("#select_product_key").val()
			},
			type: 'POST',
			dataType: 'TEXT',

				success: function(result){
					$("#table_key").html(result);
				}
			});
		}
		$(document).ready(function(){
			$(document).on('click', 'button[name=viewUserOrders]', function(){
				var userID = $(this).val();
				$.ajax({
					url: '/modules/includes/order-list-render.inc.php',
					data: {userID},
					dataType: 'JSON',
					type: 'POST',
					success: function(result){
							row = '';
						result.forEach(function(value, index){
							if (value[4] == 1){
								status = '<span style="padding: 3px; background-color: grey; color: #fff; font-size: 12px;">Đã xử lý</span>';
							} else {
								status = '<span style="padding: 3px; background-color: green; color: #fff; font-size: 12px;">Chưa xử lý</span>';
							};

							row += '<tr>';
							row += '<td>'+(index +1)+'</td>';
							row += '<td>'+value[0]+'</td>';
							row += '<td>'+value[3]+'</td>';
							row += '<td>'+value[2]+'</td>';
							row += '<td>'+status+'</td>';
							row += '</tr>';

						});

						$('tbody#memberOrderList').html(row);
					}
				});
			});
		});

		$(document).ready(function(){
			$(document).on('change', 'input[name=orderPage]', function(){
				orderPage = $(this).val();

				$.ajax({
					url: '/modules/includes/order-mgmt.inc.php',
					data: {orderPage},
					type: 'POST',

					success: function(html){
						result = '<tr>\
									<td>STT</td>\
									<td>Người mua</td>\
									<td>Địa chỉ giao hàng</td>\
									<td>Số điện thoại liên hệ</td>\
									<td>Khóa học</td>\
									<td>Ngày đặt hàng</td>\
									<td>Tình trạng</td>\
									<td>Báo đã xử lý</td>\
								</tr>';
						result += html
						$('.dp-user-mgmt tbody').html(result);
					}
				})
			});
		})



		$(document).ready(function(){
			$(document).on('click', 'button[name=confirmOrder]', function(){
				orderID = $(this).val();
				$.ajax({
					url: '/modules/includes/confirm-order.inc.php',
					data: {orderID},
					type: 'POST',

					success: function(result) {
						alert(result);
					}
				});
				$(this).closest('td').prev().html('<span style="padding: 3px; background-color: grey; color: #fff; font-size: 12px;">Đã xử lý</span>');
			});
		});


		$(document).ready(function(){
			$(document).on('click', 'button[name=deleteOrder]', function(){
				orderID = $(this).val();
				if(confirm("Bạn chắc chắn muốn xóa?"))
				{
					$.ajax({
						url: '/modules/includes/order-delete.inc.php',
						data: {orderID},
						type: 'POST',

						success: function(result) {
							$("tr#"+orderID).addClass("fade");
							setTimeout(function()
							{
								$("tr#"+orderID).remove();
							},500);
						}
					});
				}
			});
		});

		$(document).ready(function(){
			$(document).on('click', 'button[name=viewAllKeys]', function(){
				product_id = $(this).val();
				$('input[name=allKeyPage]').attr('product_id', product_id);

				$.ajax({
					url: '/modules/includes/view-all-keys.inc.php',
					data: {product_id},
					type: 'POST',

					success: function(result){

						$('tbody#allKeyList').html(result);
					}
				});
			});
		})

		$(document).ready(function(){
			$(document).on('change', 'input[name=allKeyPage]', function(){
				allKeyPage = $(this).val();
				product_id = $(this).attr('product_id');

				$.ajax({
					url: '/modules/includes/view-all-keys.inc.php',
					data: {product_id, allKeyPage},
					type: 'POST',

					success: function(result){

						$('tbody#allKeyList').html(result);
					}
				});
			});
		})

		$(document).ready(function(){
			$(document).on('change', 'input[name=mainKeyPage]', function(){
				mainKeyPage = $(this).val();

				$.ajax({
					url: '/modules/includes/product-key.inc.php',
					data: {mainKeyPage},
					type: 'POST',

					success: function(result){
						html = '<tr>\
									<td>STT</td>\
									<td>Code</td>\
									<td>Khóa học</td>\
									<td>Tình trạng</td>\
									<td>Ngày tạo</td>\
									<td>Biên tập</td>\
								</tr>';

						html += result;

						$('table.dp-cate-mgmt').html(html);
					}
				});
			});
		})

		$(document).ready(function(){
			$(document).on('click', 'button[name=editUser]', function(){
				userID = $(this).val();
				$(this).closest('div.dp-2nd-main').html('');

				$.ajax({
					url: 'modules/includes/user-edit-panel.inc.php',
					data: {userID},
					type: 'POST',

					success: function(result){
						$('div#userEditDiv').html(result);
					}
				});
			})
		})

		$(document).ready(function() {
        $(document).on('change', 'select#reg_city', function(){
            cityValue = $(this).val();
            $.ajax({
                url:'default/includes/get-district.inc.php',
                data:{'cityValue': cityValue},
                dataType:'TEXT',
                method: 'POST',
                success: function(result){
                    $('select#reg_district').html(result);
                }
            });

        });
    });
    $(document).ready(function() {
        $(document).on('change', 'select#reg_district', function(){
            cityValue = $(this).val();
            $.ajax({
                url:'default/includes/get-ward.inc.php',
                data:{'cityValue': cityValue},
                dataType:'TEXT',
                method: 'POST',
                success: function(result){
                    $('select#reg_ward').html(result);
                }
            });

        });
    });

    $(document).ready(function(){
    	$(document).on('click', 'button[name=deleteDocument]', function(){
    		documentID = $(this).val();
    		$.ajax({
    			url : '/modules/includes/delete-course-document.inc.php',
    			type: 'POST',
    			data: {documentID},

    			success: function(result){
    				alert(result);
    			}
    		});
    		$(this).closest('tr').addClass('hidden');
    	})
    })

    


	</script>
	</body>
</html>