$( document ).ready( function() {
	/*Next step
	======================================================*/
	$( document ).on( 'click', '.dp-nextstep', function( e ) {
		e.preventDefault();
		if( !$( this ).hasClass( 'disabled' ) ) {
			var step = $( this ).data( 'step' );
			var href = $( this ).prop( 'href' );
			$.ajax( {
				url: 'install/includes/step.inc.php',
				type: 'POST',
				data: {
					'step' : step
				},
				success: function() {
					location.href = href;
				}
			} )
		}
	} )
	
	/*Install 0
	=======================================================*/
	$( '.dp-agree input' ).prop( 'checked', false );
	$( '.dp-agree input' ).on( 'change', function() {
		if( $( this ).is( ':checked' ) ) {
			$( '.dp-nextstep' ).removeClass( 'disabled' );
			$( '.dp-nextstep' ).prop( 'onclick', '' );
		}
		else {
			$( '.dp-nextstep' ).addClass( 'disabled' );
		}
	} )
	
	/*Install 1
	=====================================================*/
	$( '.dp-create-db' ).click( function( e ) {
		e.preventDefault();
		$.ajax( {
			url: 'install/includes/install1.inc.php',
			type: 'POST',
			data: $( this ).parent().serialize(),
			async: false,
			beforeSend: function() {
				$( '.dp-progress-icon' ).fadeIn( 'slow' );
			},
			success: function( html ) {
				$( '.dp-create-db' ).prop( 'disabled', true );
				$( '.dp-progress-icon' ).fadeOut( 'slow' );
				$( '.dp-create-db-status' ).html( html );
			}
		} )
	} )
	
	/*Install 2
	===========================================*/
	$( '.dp-create-user' ).click( function( e ) {
		e.preventDefault();
		//Validate pass
		var pass1 = $( '#dp-password1' ).val();
		var pass2 = $( '#dp-password2' ).val();
		if( pass1 === pass2 ) {
			$.ajax( {
				url: 'install/includes/install2.inc.php',
				type: 'POST',
				data: $( this ).parent().serialize(),
				async: false,
				beforeSend: function() {
					$( '.dp-progress-icon' ).fadeIn( 'slow' );
				},
				success: function( html ) {
					$( '.dp-create-user' ).prop( 'disabled', true );
					$( '.dp-progress-icon' ).fadeOut( 'slow' );
					$( '.dp-create-user-status' ).html( html );
				}
			} )
		}
		else {
			$( '.dp-create-user-status' ).html( '<p class="error">Mật khẩu không khớp.</p>' );
		}
	} )
	
	/*Install 3
	===============================================*/
	$( '.dp-installed' ).click( function() {
		$( this ).hide();
		$.ajax( {
			url: 'install/includes/install3.inc.php',
			type: 'GET',
			data: {},
			success: function( html ) {
				$( '.status' ).html( html );
			}
		} )
	} )
} )