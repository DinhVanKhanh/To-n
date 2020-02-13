$( document ).ready( function() {

	/*Assigning $_GET when click on sidebar items
	==================================================*/
	$( '.dp-menu' ).click( function() {
		var mod = $( this ).data( 'mod' ); //This var is global
		window.location = 'admin.php?mod=' + mod;
	} )

	/*Highlight sidebar items when click
	================================================*/
	var mod = location.href.split( '=' )[1];
	mod = mod === undefined ? 'home' : mod; //Fix issue when right now access admin page

	$( '.sidebar-active' ).removeClass( 'sidebar-active' );
	$( '.dp-menu[data-mod=' + mod + ']' ).addClass( 'sidebar-active' );

	/*Set title for window
	================================================*/
	var title = $( '.dp-menu[data-mod=' + mod + ']' ).html();
	document.title = title + ' - Pion Cpanel';

	/*Handling 2nd menu items click event
	===========================================================*/
	$( document ).on('click', '.dp-2nd-menu-item, .js_edit-btn', function() {

		//Highlight
		$( '.active' ).removeClass( 'active' );
		$( this ).addClass( 'active' );

		//Ajax load tpl
		var tpl = $( this ).data( 'tpl' );
		var incParts = $( this ).data( 'inc' ) ? $( this ).data( 'inc' ).split('?') : [];
		var inc = incParts[0];
		var params = incParts[1] ? incParts[1] : '';
		var magic = $( this ).data( 'magic' );

		$.ajax( {
			url: 'modules/templates/' + tpl + '.tpl.php',
			type: 'GET',
			data: {},
			success: function( html ) {
				if( inc ) {
					//Get inc
					$.ajax( {
						url: 'modules/includes/' + inc + '.inc.php',
						type: 'GET',
						data: params,
						success: function( html2 ) {

							// setTimeout(function(){
							// 	CKEDITOR.replace( 'dp-wysiwyg' );
							// },0);
							 
							//Replace magic keywords
							var magics = magic ? magic.split(',') : [];
							var len = magics.length;
							if(len > 1) {
								//Dành cho nút edit
								console.log(html2);
								var html2 = JSON.parse(html2);
								for(var i = 0; i < len; i++) {
									html = html.replace( magics[i], html2[i] );
								}
							}
							else {
								//Dành cho menu cấp 2
								html = html.replace(magic, html2);
							}

							//Append HTML
							$( '.dp-2nd-main' ).html( html );

							//WYSIWYG Initializing
							tinymce.init({
								selector:'textarea#dp-wysiwyg',
								plugins : 'advlist autolink link image lists charmap print preview media table codesample fullscreen code contextmenu',
							});
						}
					} )
				}
				else {
					//Append HTML
					$( '.dp-2nd-main' ).html( html );

					//WYSIWYG Initializing
					tinymce.init({
						selector:'textarea#dp-wysiwyg',
						plugins : 'advlist autolink link image lists charmap print preview media table codesample fullscreen code contextmenu',
					});
				}
			}
		} )
	} )

	/*Click 1st item as default
	==============================================*/
	$( '.dp-2nd-menu-item' )[0].click();

	/*Add category
	==============================================*/
	$( document ).on( 'click', '#cate-btn', function( e ) {
		e.preventDefault();
		$.ajax( {
			url: 'modules/includes/category-add.inc.php',
			type: 'POST',
			data: $( this ).parent().serialize(),
			success: function( html ) {
				alert( html );
			}
		} )
	} )

	/*Edit category
	=============================================*/
	$( document ).on( 'click', '.dp-cate-edit-btn', function() {
		//Show input
		var row = $( this ).parent().parent();
		row.find( 'input' ).removeAttr( 'readonly' );

		//Show save button
		$( this ).hide();
		$( this ).next().show();

	} )

	$( document ).on( 'click', '.js_cate-save-btn', function() {
		var row = $( this ).parent().parent();
		var cateName = row.find( 'input:eq(0)' ).val();
		var cateUri = row.find( 'input:eq(1)' ).val();
		var cateId = $( this ).data( 'id' );
		var $this = $( this );
		$.ajax( {
			url: 'modules/includes/category-save.inc.php',
			type: 'POST',
			data: {
				'cate_name' : cateName,
				'cate_uri' : cateUri,
				'cate_id' : cateId
			},
			success: function( html ) {
				alert( html );
				row.find( 'input' ).prop( 'readonly', 'readonly' );
				$this.hide();
				$this.prev().show();
			}
		} )
	} )

	$( document ).on( 'click', '.js_cate-delete-btn', function() {
		var cateId = $( this ).data( 'id' );

		$.ajax( {
			url: 'modules/includes/category-delete.inc.php',
			type: 'POST',
			data: {
				'cate_id' : cateId
			},
			success: function( html ) {
				alert( html );
				$( '.active' ).click();
			}
		} )
	} )

	/*Post new post
	================================================*/
	$( document ).on( 'click', '#post-btn', function( e ) {
		// e.preventDefault();
		tinyMCE.triggerSave();
		$.ajax( {
			url: 'modules/includes/new-post-add.inc.php',
			type: 'POST',
			data: $( this ).parent().serialize(),
			success: function( html ) {
				alert( html );
			}
		} )
	} )


	/*Add user
	==============================================*/
	$( document ).on( 'click', '#user-btn', function( e ) {
		e.preventDefault();
		$.ajax( {
			url: 'modules/includes/user-add.inc.php',
			type: 'POST',
			data: $( this ).parent().serialize(),
			success: function( html ) {
				alert( html );
			}
		} )
	} )

	/*Edit user
	==============================================*/
	$( document ).on( 'click', '#user-edit-btn', function( e ) {
		e.preventDefault();
		$.ajax( {
			url: 'modules/includes/user-edit-ajax.inc.php',
			type: 'POST',
			data: $( this ).parent().serialize(),
			success: function( html ) {
				alert( html );
			}
		} )
	} )

	/*Edit post
	===============================================*/
	$( document ).on( 'click', '.dp-post-edit-btn', function() {
		var id = $( this ).data( 'id' );
		$.ajax( {
			url: 'modules/includes/new-post-edit.inc.php',
			type: 'POST',
			data: {
				post_id : id
			},
			success: function( html ) {
				$( '.dp-2nd-main' ).html( html );

				//WYSIWYG Initializing
				tinymce.init({
					selector:'textarea#dp-wysiwyg',
					plugins : 'advlist autolink link image lists charmap print preview media table codesample fullscreen code contextmenu',
				});
			}
		} )
	} )

	/*Delete post
	==============================================*/
	$( document ).on( 'click', '.dp-post-delete-btn', function() {
		var id = $( this ).data( 'id' );
		$.ajax( {
			url: 'modules/includes/new-post-delete.inc.php',
			type: 'POST',
			data: {
				post_id : id
			},
			success: function( html ) {
				$( '.active' ).click();
				console.log( html );
			}
		} )
	} )

	/*Unpublish
	=============================================*/
	$( document ).on( 'click', '.dp-post-unpublish-btn', function() {
		var id = $( this ).data( 'id' );
		$.ajax( {
			url: 'modules/includes/new-post-unpublish.inc.php',
			type: 'POST',
			data: {
				post_id : id
			},
			success: function( html ) {
				$( '.active' ).click();
				console.log( html );
			}
		} )
	} )

	/*Publish
	=============================================*/
	$( document ).on( 'click', '.dp-post-publish-btn', function() {
		var id = $( this ).data( 'id' );
		$.ajax( {
			url: 'modules/includes/new-post-publish.inc.php',
			type: 'POST',
			data: {
				post_id : id
			},
			success: function( html ) {
				$( '.active' ).click();
				console.log( html );
			}
		} )
	} )

	/*Block user
	==============================================*/
	$( document ).on( 'click', '.dp-user-block-btn', function() {
		var id = $( this ).data( 'id' );
		$.ajax( {
			url: 'modules/includes/user-block.inc.php',
			type: 'POST',
			data: {
				user_id : id
			},
			success: function( html ) {
				$( '.active' ).click();
				console.log( html );
			}
		} )
	} )

	/*Unblock user
	==============================================*/
	$( document ).on( 'click', '.dp-user-unblock-btn', function() {
		var id = $( this ).data( 'id' );
		$.ajax( {
			url: 'modules/includes/user-unblock.inc.php',
			type: 'POST',
			data: {
				user_id : id
			},
			success: function( html ) {
				$( '.active' ).click();
				console.log( html );
			}
		} )
	} )

	/*Delete user
	==============================================*/
	$( document ).on( 'click', '.dp-user-delete-btn', function() {
		var id = $( this ).data( 'id' );
		$.ajax( {
			url: 'modules/includes/user-delete.inc.php',
			type: 'POST',
			data: {
				user_id : id
			},
			success: function( html ) {
				$( '.active' ).click();
				console.log( html );
			}
		} )
	} )


	/*Add product category
	==============================================*/
	$( document ).on( 'click', '#product-cates-btn', function( e ) {
		e.preventDefault();
		$.ajax( {
			url: 'modules/includes/product-cates-add.inc.php', //URL inc
			type: 'POST',
			data: $( this ).parent().serialize(),
			success: function( html ) {
				alert( html );
			}
		} )
	} )

	/*Edit product category
	==============================================*/
	$( document ).on( 'click', '.js_product-cate-save-btn', function( e ) {
		e.preventDefault();
		var id = $(this).data('id');
		var cate = $(this).parent().parent().find('input').val();
		$.ajax( {
			url: 'modules/includes/product-cates-save.inc.php', //URL inc
			type: 'POST',
			data: {
				'id': id,
				'cate': cate
			},
			success: function( html ) {
				alert( html );
			}
		} )
	} )

	/*Delete product category
	==============================================*/
	$( document ).on( 'click', '.js_product-cate-delete-btn', function( e ) {
		e.preventDefault();
		var id = $( this ).data('id');
		$.ajax( {
			url: 'modules/includes/product-cates-delete.inc.php', //URL inc
			type: 'POST',
			data: {
				'id': id
			},
			success: function( html ) {
				alert( html );
			}
		} )
	} )

	/*Add new product
	==============================================*/
	$( document ).on( 'click', '#js_add-new-product-btn', function( e ) {
		e.preventDefault();

		//Upload
		var prefix = 'product_';
		upload($(this).parent(), 'images', prefix);

		//Save into database
		$.ajax( {
			url: 'modules/includes/product-add-ajax.inc.php', //URL inc
			type: 'POST',
			data: $(this).parent().serialize(),
			success: function( html ) {
				alert( html );
			}
		} )
	} )


	/*Uploading
	==============================================*/
	function upload(form, destination, prefix) {
		var input = form.find('.js_upload-input')[0];
		var output = form.find('.js_upload-output');
		var filesToUpload = new FormData();
		var len = input.files.length;
		if(len < 1) {
			return;
		}
		for(var i = 0; i < len; i++) {
			filesToUpload.append('filesToUpload[]', input.files[i]);
		}
		filesToUpload.append('destination', destination);
		filesToUpload.append('prefix', prefix);
		$.ajax({
			url: 'modules/includes/upload.inc.php',
			type: 'POST',
			data: filesToUpload,
			async: false,
			contentType: false,
			processData: false,
			cache: false,
			success: function(html){
				if(!html) {
					alert('Upload thất bại, vui lòng kiểm tra loại tệp, chỉ cho phép hình ảnh và video');
				}
				else {
					output.val(html);
				}
			}
		});
	}

	/*Edit product
	==============================================*/
	$( document ).on( 'click', '#js_edit-new-product-btn', function( e ) {
		e.preventDefault();
		var form = $(this).parent();

		//Upload
		var prefix = 'product_';
		upload(form, 'images', prefix);

		$.ajax( {
			url: 'modules/includes/product-edit-ajax.inc.php', //URL inc
			type: 'POST',
			data: form.serialize(),
			success: function( html ) {
				alert( html );
			}
		} )
	} )

	/*Generate key for product
	==============================================*/
	$( document ).on( 'click', '#js_generate-key-btn', function() {
		// e.preventDefault();
		// var form = $(this).parent();
		product_id = $(this).siblings('input[name=product_id]').val();

		$.ajax( {
			url: '/modules/includes/product-generate-key-ajax.inc.php', //URL inc
			type: 'POST',
			data: {product_id},
			dataType: 'TEXT',

			success: function( html ) {
				alert( html );
			}
		});
	})

	/*Delete product
	==============================================*/
	$( document ).on( 'click', '.js_product-delete-btn', function( e ) {
		e.preventDefault();
		var id = $( this ).data('id');
		$.ajax( {
			url: 'modules/includes/product-delete.inc.php', //URL inc
			type: 'POST',
			data: {
				'id': id
			},
			success: function( html ) {
				alert( html );
			}
		} )
	} )

	/*Delete product key
	==============================================*/
	$( document ).on( 'click', '.js_key-delete-btn', function( e ) {
		e.preventDefault();
		var id = $( this ).data('id');
		$.ajax( {
			url: 'modules/includes/product-key-delete.inc.php', //URL inc
			type: 'POST',
			data: {
				'id': id
			},
			success: function( html ) {
				alert( html );
			}
		} )
	} )

	/*Add new videos
	==============================================*/
	$( document ).on( 'click', '#js_add-new-video-btn', function( e ) {
		e.preventDefault();

		//Upload
		var prefix = 'video_';
		upload($(this).parent(), 'videos', prefix);

		//Save into database
		$.ajax( {
			url: 'modules/includes/video-add-ajax.inc.php', //URL inc
			type: 'POST',
			data: $(this).parent().serialize(),
			success: function( html ) {
				alert( html );
			}
		} )
	} )

	/*Delete video
	==============================================*/
	$( document ).on( 'click', '#js_delete-video-btn', function( e ) {
		e.preventDefault();
		var id = $( this ).data('id');
		$.ajax( {
			url: 'modules/includes/video-delete.inc.php', //URL inc
			type: 'POST',
			data: {
				'id': id
			},
			success: function( html ) {
				alert( html );
			}
		} )
	} )

	/*Edit video
	==============================================*/
	$( document ).on( 'click', '#js_edit-video-btn', function( e ) {
		e.preventDefault();
		var form = $(this).parent();

		//Upload
		var prefix = 'video_';
		upload(form, 'videos', prefix);

		$.ajax( {
			url: 'modules/includes/video-edit-ajax.inc.php', //URL inc
			type: 'POST',
			data: form.serialize(),
			success: function( html ) {
				alert( html );
			}
		} )
	} )


} )
