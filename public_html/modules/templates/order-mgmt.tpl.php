<div class="row" style="height: 50px;">
	<div class="col-md-4 col-md-offset-4" style="margin-top: 13px;">
		<span>Trang </span><input type="number" min="1" value="1" style="width: 35px;" name="orderPage">
	</div>
</div>
<div>
<!-- <table class="dp-user-mgmt"> -->
	<!-- <tr>
		<td>STT</td>
		<td>Email người mua</td>
		<td>Người mua</td>
		<td>Địa chỉ giao hàng</td>
		<td>Số điện thoại liên hệ</td>
		<td>Khóa học</td>
		<td>Ngày đặt hàng</td>
		<td>Tình trạng</td>
		<td>Báo đã xử lý</td>
	</tr> -->
	{@orders}
<!-- </table>
 -->
 </div>
 <style type="text/css">
 	.wrap-detail{
 		display: none;
		position: fixed;
		width: 90%;
		height: 100%;
		top:0;
		left: 5%;
		background: white;
		z-index: 1001;
 	}
	/*.detail.dp-user-mgmt{
		
	}*/
	.bg-overlay{
		display: none;
		width: 100%;
		height: 100%;
		position: fixed;
		top: 0;
		z-index: 1000;
		background: black;
		opacity: .5;
		left: 0
	}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		$('#table-donhang').DataTable();
		$('table.detail').each(function(){
			$(this).DataTable();
		});
		$('.xulytatca_btn').click(function(){
            
            if(confirm('Bạn có chắc xử lý tất cả?')){
            $(this).attr('disabled',true);
            setTimeout(function(){
                location.reload();
            },1500);
            parent = $(this).parents('.wrap-detail');
            children = parent.find('table tr.order_id');
            children.each(function(){
          	 	orderID = $(this).attr('id');
          	 	// console.log(orderID);
	            $.ajax({
					url: '/modules/includes/confirm-order.inc.php',
					data: {orderID},
					type: 'POST',
				});
            });
            }
        });
		//Xóa tất cả đơn đã duyệt
        $('.xoatatca_btn').click(function(){    
            if(confirm('Bạn có chắc xóa tất cả đon đã duyệt?')){
            $(this).attr('disabled',true);
            // setTimeout(function(){
            //     location.reload();
            // },1500);
            parent = $(this).parents('.wrap-detail');
            children = parent.find("tr.order_id[data-status='1']");
            children.each(function(){
          	 	orderID = $(this).attr('id');

	            $.ajax({
					url: '/modules/includes/order-delete.inc.php',
					data: {orderID},
					type: 'POST',
				});
            });
            }
        });
	});
	$('td.email').click(function(e){
		slot = $(this).data('slot');
		detail = $('.wrap-detail[data-slot='+slot+']');
		detail.show();
		bg_overlay = $('.bg-overlay');
		bg_overlay.show();
		bg_overlay.click(function(){
			bg_overlay.hide();
			detail.hide();
		});
		// $(this).parent('table').sibling('.detail.dp-user-mgmt').show();
	});

</script>