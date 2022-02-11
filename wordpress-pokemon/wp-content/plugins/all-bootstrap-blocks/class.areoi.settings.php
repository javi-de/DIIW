<?php
use ScssPhp\ScssPhp\Compiler;

class AREOI_Settings
{
	private static $initiated = false;
	public static $page;
	
	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}

	private static function init_hooks() 
	{
		self::$initiated = true;

		if ( is_admin() ) {
			add_action( 'admin_init', array( 'AREOI_Settings', 'register_settings' ) );
			add_action( 'admin_menu', array( 'AREOI_Settings', 'add_menu_items' ) );
			// add_filter( 'allowed_block_types_all', array( 'AREOI_Settings', 'allowed_block_types' ), 10, 2 );

			if ( 
				sanitize_text_field( !empty( $_GET['page'] ) ) && 
				strpos( sanitize_text_field( $_GET['page'] ), 'areoi-') !== false && 
				sanitize_text_field( !empty( $_GET['settings-updated'] ) ) && 
				sanitize_text_field( $_GET['settings-updated'] ) == true 
			) {
				self::compile_scss();
			}
		}
	}

	/*
	// REMOVED: Was causing blocks from other plugins to dissapear.
	public static function allowed_block_types() 
	{
		$new_block_types = [];
		$block_types = WP_Block_Type_Registry::get_instance()->get_all_registered();
		
		if ( !empty( $block_types ) ) {
			foreach ( $block_types as $block_key => $block ) {
				if ( in_array( $block_key, array( 'core/buttons', 'core/button' ) ) ) {
					if ( !get_option( 'areoi-dashboard-global-hide-buttons-block', 0 ) ) {
						$new_block_types[] = $block_key;
					}
				} elseif ( in_array( $block_key, array( 'core/columns', 'core/column' ) ) ) {
					if ( !get_option( 'areoi-dashboard-global-hide-columns-block', 0 ) ) {
						$new_block_types[] = $block_key;
					}
				} else {
					$new_block_types[] = $block_key;
				}
			}
		}
		
		return $new_block_types;

	}*/

	public static function register_settings()
	{
		$page 		= self::get_settings();

		register_setting( 'areoi', 'areoi-bootstrap-version' );

		foreach ( $page['children'] as $child_key => $child ) {
			if ( empty( $child['sections'] ) ) {
				continue;	
			}
			foreach ( $child['sections'] as $section_key => $section ) {
				
				if ( empty( $section['options'] ) ) {
					continue;	
				}
				foreach ( $section['options'] as $option_key => $option ) {
					if ( in_array( $option['input'], array( 'header', 'divider' ) ) ) {
						continue;
					}
					$args = array(
			            'type' 				=> 'string', 
			            'sanitize_callback' => 'sanitize_text_field',
			        );
			    	register_setting( $child['slug'], $option['name'], $args );
				}
			}
		}
	}

	public static function add_menu_items()
	{
		$page 		= self::get_settings();

		add_menu_page( 
			__( $page['name'], 'textdomain' ), 
			$page['name'], 
			'manage_options', 
			$page['slug'], 
			array( 'AREOI_Settings', 'add_pages' ), 
			$page['icon'], 
			60
		);

		foreach ( $page['children'] as $child_key => $child ) {
			add_submenu_page( 
				$page['slug'], 
				$child['name'], 
				$child['name'], 
				'manage_options', 
				$child['slug'], 
				array( 'AREOI_Settings', 'add_pages' )
			);
		}
	}

	public static function add_pages()
	{
		$page 		= self::get_settings();
		$active_page= $page['children']['areoi-dashboard'];
		if ( sanitize_text_field( !empty( $_GET['page'] ) ) && !empty( $page['children'][sanitize_text_field( $_GET['page'] )] ) ) {
			$active_page = $page['children'][sanitize_text_field( $_GET['page'] )];
		}
        ?>

        <div class="areoi-container">
			<div class="areoi-container__content">

				<?php include( AREOI__PLUGIN_DIR . 'views/partials/sidebar.php' ); ?>

				<div style="max-width: 1550px; height: 100%;">
					<div class="areoi-container__body">
						
						<div class="areoi-header">
							<h2><?php echo esc_attr( $active_page['name'] ) ?></h2>
						</div><!-- .areoi-header -->

						<form method="post" action="options.php" class="areoi-form"> 
							<div class="areoi-body">

								<?php settings_fields( esc_attr( $active_page['slug'] ) ); ?>
								<?php include( AREOI__PLUGIN_DIR . 'views/partials/settings-section.php' ); ?>	

							</div><!-- .areoi-body -->

						</form>

						<?php include( AREOI__PLUGIN_DIR . 'views/partials/areoi.php' ); ?>	

						<div style="clear: both; display: block;"></div>

					</div><!-- .areoi-container__body -->

					<div class="areoi-form-button">
						<div class="areoi-form-button__body">
							<?php submit_button(); ?>
							<span class="spinner" style="float: none;"></span>

							<p class="areoi-form-button__alert">
								The CSS failed to compile. This is usually because of an invalid variable. Check your variable values and try again. 
							</p>
						</div><!-- .areoi-body -->
					</div><!-- .areoi-form-button -->
				</div>

			</div><!-- .areoi-container__content -->

		</div><!-- .areoi-container -->

        <?php
	}

	public static function get_settings()
	{	
		// self::generate_settings();

		self::custom_colors();

		$rows = array(
			'name'		=> 'Bootstrap',
			'slug' 		=> AREOI__PREPEND . '-dashboard',
			'icon'		=> 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyNS40LjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9IjAgMCAxMDAgMTAwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAxMDAgMTAwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8c3R5bGUgdHlwZT0idGV4dC9jc3MiPg0KCS5zdDB7ZmlsbDojQTdBQUFEO30NCjwvc3R5bGU+DQo8Zz4NCgk8cGF0aCBjbGFzcz0ic3QwIiBkPSJNNDUuOCwwLjlMMi42LDk5LjFsMCwwYzEzLjksMCwyNi41LTguNCwzMi4xLTIwLjlMNjguOCwwLjlINDUuOHoiLz4NCgk8cGF0aCBjbGFzcz0ic3QwIiBkPSJNNzMuNyw3Ni44YzkuMSwwLDE3LjQsMy41LDIzLjcsOS44TDczLjcsMzIuOUw1MCw4Ni42QzU2LjMsODEsNjQuNiw3Ni44LDczLjcsNzYuOHoiLz4NCjwvZz4NCjwvc3ZnPg0K',
			'priority'	=> 60,
			'children'	=> array(
				AREOI__PREPEND . '-dashboard' => array(
					'name'		=> 'Dashboard',
					'slug' 		=> AREOI__PREPEND . '-dashboard',
					'icon'		=> '',
					'priority'	=> 60,
					'sections'	=> self::load_settings( 'dashboard' )
				),
			)
		);
		if ( get_option( 'areoi-dashboard-global-bootstrap-css', 1 ) ) {
			$rows['children'][AREOI__PREPEND . '-customize'] = array(
				'name'		=> 'Customize',
				'slug' 		=> AREOI__PREPEND . '-customize',
				'icon'		=> '',
				'priority'	=> 60,
				'sections'	=> self::load_settings( 'customize' )
			);
			$rows['children'][AREOI__PREPEND . '-layout'] = array(
				'name'		=> 'Layout',
				'slug' 		=> AREOI__PREPEND . '-layout',
				'icon'		=> '',
				'priority'	=> 60,
				'sections'	=> self::load_settings( 'layout' )
			);
			$rows['children'][AREOI__PREPEND . '-content'] = array(
				'name'		=> 'Content',
				'slug' 		=> AREOI__PREPEND . '-content',
				'icon'		=> '',
				'priority'	=> 60,
				'sections'	=> self::load_settings( 'content' )
			);
			$rows['children'][AREOI__PREPEND . '-forms'] = array(
				'name'		=> 'Forms',
				'slug' 		=> AREOI__PREPEND . '-forms',
				'icon'		=> '',
				'priority'	=> 60,
				'sections'	=> self::load_settings( 'forms' )
			);
			$rows['children'][AREOI__PREPEND . '-components'] = array(
				'name'		=> 'Components',
				'slug' 		=> AREOI__PREPEND . '-components',
				'icon'		=> '',
				'priority'	=> 60,
				'sections'	=> self::load_settings( 'components' )
			);
		}

		return $rows;
	}

	public static function custom_colors()
    {
    	// Setup array of colors to be added
    	$colors_arr = [
			'primary' 		=> get_option( AREOI__PREPEND . '-customize-theme-colors-primary', '#0d6efd' ),
			'secondary' 	=> get_option( AREOI__PREPEND . '-customize-theme-colors-secondary', '#6c757d' ),
			'success' 		=> get_option( AREOI__PREPEND . '-customize-theme-colors-success', '#198754' ),
			'info' 			=> get_option( AREOI__PREPEND . '-customize-theme-colors-info', '#0dcaf0' ),
			'warning' 		=> get_option( AREOI__PREPEND . '-customize-theme-colors-warning', '#ffc107' ),
			'danger' 		=> get_option( AREOI__PREPEND . '-customize-theme-colors-danger', '#dc3545' ),
			'light' 		=> get_option( AREOI__PREPEND . '-customize-theme-colors-light', '#f8f9fa' ),
			'dark' 			=> get_option( AREOI__PREPEND . '-customize-theme-colors-dark', '#212529' ),
			'white' 		=> '#fff',
		];

		// Loop through all colors and create array to pass to wp function
		$include_colors = [];
		foreach ( $colors_arr as $slug => $colour ) {
			if ( $colour ) {
				$include_colors[] = [
					'name' => esc_attr__( $slug, AREOI__PREPEND . '-theme' ),
					'slug' => $slug,
					'color' => $colour,
				];
			}
		}

		// Add new colors to wp
		add_theme_support( 'editor-color-palette', $include_colors );
    }

	public static function load_settings( $section )
	{
		$dir 	= AREOI__PLUGIN_DIR . 'settings/' . $section . '/';

		if ( !file_exists( $dir ) ) {
			return;
		}

		$files 	= scandir( $dir );
		array_shift( $files );
		array_shift( $files );

		$settings = array();

		if ( !empty( $files ) ) {
			foreach ( $files as $file_key => $file ) {
				$path 			= $dir . $file;
				$file_settings 	= require( $path );
				$file_data 		= get_file_data( $path, array( 'Name', 'Slug', 'Description', 'Position', 'Theme' ) );

				// Check theme is AREOI
				if ( $file_data[4] === 'true' ) {
					if ( !AREOI__IS_THEME ) {
					    continue;
					}
				}
				
				$new_section 	= array(
					'name' 			=> !empty( $file_data[0] ) ? $file_data[0] : '',
					'slug' 			=> !empty( $file_data[1] ) ? $file_data[1] : '',
					'description' 	=> !empty( $file_data[2] ) ? $file_data[2] : '',
					'position'		=> !empty( $file_data[3] ) ? $file_data[3] : '',
					'options'		=> $file_settings
				);
				$settings[] = $new_section;
			}
		}

		usort( $settings, function( $item1, $item2 ) {
		    return strcmp( $item1['name'], $item2['name'] );
		});

		return $settings;
	}

	public static function compile_scss()
	{	
		$css_path 			= AREOI__PLUGIN_DIR . 'assets/css/';
		if ( !file_exists( $css_path ) ) {
			mkdir( $css_path );
		}

		// Update _variables-override.scss file
		$page 		= self::get_settings();
		$var_path 			= AREOI__PLUGIN_DIR . 'src/scss/bootstrap-' . AREOI__BOOTSTRAP_VERSION . '/_variables-override.scss';
		$var_content 		= '';
		
		foreach ( $page['children'] as $child_key => $child ) {
			if ( empty( $child['sections'] ) ) {
				continue;	
			}
			foreach ( $child['sections'] as $section_key => $section ) {
				
				if ( empty( $section['options'] ) ) {
					continue;	
				}
				foreach ( $section['options'] as $option_key => $option ) {

					if ( empty( $option['variable'] ) ) {
						continue;
					}
get_option( $option['name'] ) ? $var_content .= $option['variable'] . ': ' . get_option( $option['name'] ) . ';
' : null;
				}
			}
		}
		/*$var_content .= '
			$grays: (
			  "100": $gray-100,
			  "200": $gray-200,
			  "300": $gray-300,
			  "400": $gray-400,
			  "500": $gray-500,
			  "600": $gray-600,
			  "700": $gray-700,
			  "800": $gray-800,
			  "900": $gray-900
			);
			$colors: (
			  "blue":       $blue,
			  "indigo":     $indigo,
			  "purple":     $purple,
			  "pink":       $pink,
			  "red":        $red,
			  "orange":     $orange,
			  "yellow":     $yellow,
			  "green":      $green,
			  "teal":       $teal,
			  "cyan":       $cyan,
			  "white":      $white,
			  "gray":       $gray-600,
			  "gray-dark":  $gray-800
			);
			$theme-colors: (
			  "primary":    $primary,
			  "secondary":  $secondary,
			  "success":    $success,
			  "info":       $info,
			  "warning":    $warning,
			  "danger":     $danger,
			  "light":      $light,
			  "dark":       $dark
			);
			$font-sizes: (
			  1: $h1-font-size,
			  2: $h2-font-size,
			  3: $h3-font-size,
			  4: $h4-font-size,
			  5: $h5-font-size,
			  6: $h6-font-size
			);
			$display-font-sizes: (
			  1: 5rem,
			  2: 4.5rem,
			  3: 4rem,
			  4: 3.5rem,
			  5: 3rem,
			  6: 2.5rem
			);
			$table-variants: (
			  "primary":    shift-color($primary, $table-bg-scale),
			  "secondary":  shift-color($secondary, $table-bg-scale),
			  "success":    shift-color($success, $table-bg-scale),
			  "info":       shift-color($info, $table-bg-scale),
			  "warning":    shift-color($warning, $table-bg-scale),
			  "danger":     shift-color($danger, $table-bg-scale),
			  "light":      $light,
			  "dark":       $dark,
			);
		';*/
		file_put_contents( $var_path, $var_content );

		try {
			// Recompile css file
			$existing_path 		= AREOI__PLUGIN_DIR . 'src/scss/bootstrap-' . AREOI__BOOTSTRAP_VERSION . '/bootstrap.scss';
			$existing_content 	= file_get_contents( $existing_path );
			$compiler 			= new Compiler();
			$compiler->setImportPaths( AREOI__PLUGIN_DIR . 'src/scss/bootstrap-' . AREOI__BOOTSTRAP_VERSION );
			$compiler->setOutputStyle( \ScssPhp\ScssPhp\OutputStyle::COMPRESSED );
			$output_content 	= $compiler->compileString($existing_content)->getCss();
			$output_path 		= AREOI__PLUGIN_DIR . 'assets/css/bootstrap.min.css';
			file_put_contents( $output_path, $output_content );

			// Editor css
			$existing_path 		= AREOI__PLUGIN_DIR . 'src/scss/bootstrap-' . AREOI__BOOTSTRAP_VERSION . '/editor-bootstrap.scss';
			$existing_content 	= file_get_contents( $existing_path );
			$output_content 	= $compiler->compileString($existing_content)->getCss();
			$output_path 		= AREOI__PLUGIN_DIR . 'assets/css/editor-bootstrap.min.css';
			file_put_contents( $output_path, $output_content );

			// Save new version number in options table
			$version = get_option( 'areoi-bootstrap-version' ) ? ( get_option( 'areoi-bootstrap-version' ) + 1 ) : 1;
			update_option( 'areoi-bootstrap-version', $version );
		} catch ( \Exception $e ) {
			header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
			echo esc_attr( $e->getMessage() ); die;
		}
	}
}
