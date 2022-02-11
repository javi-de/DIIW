if( typeof jQuery!=='undefined' ) {
	jQuery(function($){

		$( document ).ready( function() {

			/**
			 * Admin Fields
			 * 
			 * Manage the maipulation of field options 
			 * within the admin area
			 * 
			 */
			$( document ).on( 'click', '.areoi-toggle-field', function(e) {
				e.preventDefault();
				var row 		= $( this ).parents( '.areoi-variable-row' );
				row.toggleClass( 'areoi-is-variable' );
			} );

			$( document ).on( 'change', '.areoi-select-variable', function(e) {
				e.preventDefault();
				var input = $( this ).prev(),
					value = $( this ).val();
				input.val( value );
				input.trigger( 'change' );
				$( this ).val( '' )
			} );

			$( document ).on( 'change', '.areoi-form-table input', function(e) {
				e.preventDefault();
				var row 			= $( this ).parents( '.areoi-row-input' ),
					color 			= $( this ).val(),
					cp 				= row.find( '.areoi-colour-picker' ),
					cp_container 	= row.find( '.wp-picker-container' );
					
				if ( cp.length ) {
					if ( !CheckValidColor( color ) ) {
						cp.iris( 'color', '' );
						cp.val( '' );
						cp_container.find( '.wp-color-result' ).css( 'background-color', '' );
						cp_container.find( '.color-alpha' ).css( 'background-color', '' );
        			} else {
        				cp.iris( 'color', color );
        			}
				}
			} );

			$( document ).on( 'change', '.areoi-form-table .areoi-font-picker', function(e) {
				e.preventDefault();
				var row 			= $( this ).parents( '.areoi-row-input' ),
					font 			= $( this ).val(),
					input 			= row.find( '.areoi-input-text' );
					
				input.val( font );
			} );

			function CheckValidColor(color) {
			    var e = document.getElementById('divValidColor');
			    if (!e) {
			        e = document.createElement('div');
			        e.id = 'divValidColor';
			    }
			    e.style.borderColor = '';
			    e.style.borderColor = color;
			    var tmpcolor = e.style.borderColor;
			    if (tmpcolor.length == 0) {
			        return false;
			    }
			    return true;
			}

			$('.areoi-colour-picker').wpColorPicker({
				change: function( event, ui ) {
					var element = event.target;
					var row 	= $( element ).parents( '.areoi-row-input' )
        			var color 	= ui.color.to_s();
        			var input 	= row.find( '.areoi-input-text' );
        			input.val( color );
				}
			});

			$( document ).on( 'click', '.areoi-reset', function(e) {
				e.preventDefault();
				var id 				= $( this ).data( 'id' ),
					input 			= $( '#' + id ),
					row 			= $( this ).parents( '.areoi-row-input' ),
					default_value 	= input.data( 'default' ),
					cp 				= row.find( '.areoi-colour-picker' ),
					cp_container 	= row.find( '.wp-picker-container' ),
					fp 				= row.find( '.areoi-font-picker' );

				if ( cp.length ) {
					if ( !CheckValidColor( default_value ) ) {
						cp.iris( 'color', '' );
						cp.val( '' );
						cp_container.find( '.wp-color-result' ).css( 'background-color', '' );
						cp_container.find( '.color-alpha' ).css( 'background-color', '' );
        			} else {
        				cp.iris( 'color', default_value );
        			}
				}
				if ( fp.length ) {
					fp.val( default_value );
				}
				if ( input.attr( 'type' ) == 'checkbox' ) {
					if ( default_value == 1 ) {
						input.prop( 'checked', 'checked' );
					} else {
						input.prop( 'checked', false );
					}
				} else {
					if ( typeof default_value !== 'undefined' ) {
						input.val( default_value );
					}
				}
			} );

			$( '.areoi-font-picker' ).select2();
			$( '.areoi-font-picker' ).on('select2:open', function (e) {
				setTimeout( function() {
					var items = $( '.select2-results__option' );
					items.each( function() {
						$( this ).css( {
							'font-family': $( this ).text(), 
							'font-size': '22px' 
						});
					});
				}, 500);
			});

			$( '.areoi-select-variable' ).select2({
				ajax: {
				    url: '/wp-json/areoi/variables',
				    dataType: 'json'
				  }
			});

			$( '.areoi-select-variable' ).on( 'select2:select', function (e) {
				$( this ).val( null ).trigger( 'change.select2' );
			});

			$( document ).on( 'click', '.areoi-form-button', function(e) {
				e.preventDefault();
				$( '.areoi-form' ).trigger( 'submit' );
			});
			$( document ).on( 'submit', '.areoi-form', function(e) {
				e.preventDefault();

				var container 	= $( '.areoi-form-button' ),
					spinner 	= container.find( '.spinner' ),
					submit 		= container.find( '.submit' );

				submit.hide();
				spinner.addClass( 'is-active' );

				var data 		= $( this ).serializeArray(),
					url 		= $( this ).attr( 'action' ),
					type 		= $( this ).attr( 'method' );

				$.ajax({
					type: type,
					url: url,
					data: data
				}).done(function (data) {
					location.reload();
				}).fail(function (data) {
					$( '.areoi-form-button__alert' ).addClass( 'active' ).text( data.responseText );
					submit.show();
					spinner.removeClass( 'is-active' );

					setTimeout( function() {
						$( '.areoi-form-button__alert' ).removeClass( 'active' );
					}, 5000);
				});
			} );
			

			// Media upload functionality
			$('body').on( 'click', '.areoi-upl', function(e) {
				e.preventDefault();

				var button = $(this),
					container = button.parents( '.areoi-variable-row' ),
					custom_uploader = wp.media({
						title: 'Insert image',
						library : {
							type : 'image'
						},
						button: {
							text: 'Use this image'
						},
						multiple: false
					}).on('select', function() {
						var attachment = custom_uploader.state().get('selection').first().toJSON();
						button.html('<img src="' + attachment.url + '" class="areoi-image-w-border">');
						container.find( 'input' ).val( attachment.url );
						container.addClass( 'with-image' );
					}).open();
			});

			// on remove button click
			$('body').on('click', '.areoi-rmv', function(e) {
				e.preventDefault();

				var button = $(this),
					container = button.parents( '.areoi-upl-container' );

				container.find( 'input' ).val( '' );
				container.removeClass( 'with-image' );
			});

			/**
			 * Admin Layout
			 * 
			 * Manage the maipulation of layout elements
			 * within the admin area
			 * 
			 */
			// Toggle accordion headers
			$( document ).on( 'click', '.areoi-card-header', function(e) {
				e.preventDefault();
				var card = $( this ).parents( '.areoi-card' );
				card.toggleClass( 'active' );
			} );
		});
	});
}