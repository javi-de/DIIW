<?php 
	
// Container
add_shortcode('container','btsu_container_shortcode');
function btsu_container_shortcode( $atts, $content = null ) {       
	$html = '<div class="container">' . do_shortcode($content) . '</div>';
    return $html;
}	

// Container Fluid
add_shortcode('containerfluid','btsu_containerfluid_shortcode');
function btsu_containerfluid_shortcode( $atts, $content = null ) {       
	$html = '<div class="container-fluid">' . do_shortcode($content) . '</div>';
    return $html;
}

// row
add_shortcode('row','btsu_row_shortcode');
function btsu_row_shortcode( $atts, $content = null ) {       
	$html = '<div class="row">' . do_shortcode($content) . '</div>';
    return $html;
}

// columns
add_shortcode('col','bs_col_shortcode');
function bs_col_shortcode( $atts, $content = null ) {     
    // Params extraction
    extract(
        shortcode_atts(
            array(
                'num'  => '',
                'sm'   => '',
                'md'   => '',
                'lg'   => '',
                'xl'   => '',
            ), 
            $atts
        )
    ); 
	ob_start();?>
	<div class="<?php 
		if(!empty($num)){ echo 'col-'.$num.' ';}
		if(!empty($sm)){ echo 'col-sm-'.$sm.' ';}
		if(!empty($md)){ echo 'col-md-'.$md.' ';}
		if(!empty($lg)){ echo 'col-lg-'.$lg.' ';}
		if(!empty($xl)){ echo 'col-xl-'.$xl.' ';}
		else{ echo 'col';}
	?>"><?php echo do_shortcode($content); ?></div>
	
	<?php return ob_get_clean();
}// columns


// Bootstrap Button Group
add_shortcode('btngroup','bs_button_group_shortcode');
function bs_button_group_shortcode( $atts, $content = null ) {
    // Params extraction
    extract(
        shortcode_atts(
            array(
                'class'   => ''
            ), 
            $atts
        )
    ); 
    ob_start();?>
    <div class="btn-group <?php esc_attr_e($class); ?>"><?php echo do_shortcode($content); ?></div>
    <?php return ob_get_clean();
}

// Bootstrap Button
add_shortcode('button','bs_button_shortcode');
function bs_button_shortcode( $atts, $content = null ) {     
    // Params extraction
    extract(
        shortcode_atts(
            array(
                'tag'  => 'button',
                'href'  => '',
                'type'   => 'button',
                'style'   => ''
            ), 
            $atts
        )
    ); 
    ob_start();?>

    <?php if( $tag == "button" ) { ?>
        <button type="<?php esc_attr_e($type); ?>" class="btn btn-<?php esc_attr_e( $style ); ?>"><?php echo do_shortcode($content); ?></button>
    <?php } else if( $tag == "a" ) { ?>
        <a href="<?php esc_attr_e($href); ?>" type="<?php esc_attr_e($type); ?>" class="btn btn-<?php esc_attr_e( $style ); ?>"><?php echo do_shortcode($content); ?></a>
    <?php } else if( $tag == "input" ) { ?>
        <input type="<?php esc_attr_e($type); ?>" class="btn btn-<?php esc_attr_e( $style ); ?>" value="<?php esc_attr_e($content); ?>">
    <?php } ?>
  
    <?php return ob_get_clean();
}

// Bootstrap Card
add_shortcode('card','bs_card_shortcode');
function bs_card_shortcode( $atts, $content = null ) {
    // Params extraction
    extract(
        shortcode_atts(
            array(
                'class'   => ''
            ), 
            $atts
        )
    );    
    ob_start();?>
    <div class="card <?php esc_attr_e($class); ?>">
        <?php echo do_shortcode($content); ?>        
    </div>
    <?php return ob_get_clean();
}

// Card Header
add_shortcode('cardtitle','bs_cardtitle_shortcode');
function bs_cardtitle_shortcode( $atts, $content = null ) {
    ob_start();?>
    <div class="card-header">
      <?php echo do_shortcode($content); ?>
    </div>
    <?php return ob_get_clean();
}

// Card Body
add_shortcode('cardbody','bs_cardbody_shortcode');
function bs_cardbody_shortcode( $atts, $content = null ) {  
    ob_start();?>
    <div class="card-body">
        <?php echo do_shortcode($content); ?>
    </div>    
    <?php return ob_get_clean();
}

// Bootstrap accordion
// [accordion id="unique-id" class="unique-id" title="unique-id" open="no"] Accordion Content will goes here [/accordion]
add_shortcode('accordion','bs_accordion_shortcode');
function bs_accordion_shortcode( $atts, $content = null ) {     
    // Params extraction
    extract(
        shortcode_atts(
            array(
                'id'   => 'toggleid',
                'class'   => '',
                'title'  => 'button',
                'open'  => 'no'
            ), 
            $atts
        )
    );
    ob_start();?>

    <div class="card <?php esc_attr_e($class); ?> <?php esc_attr_e(sanitize_title($id)); ?>">        
        <div class="card-header">
          <a class="card-link" data-toggle="collapse" href="#<?php esc_attr_e(sanitize_title($id)); ?>">
            <?php esc_html_e($title); ?>
          </a>
        </div>
        <div id="<?php esc_attr_e(sanitize_title($id)); ?>" class="collapse <?php if( $open != "no" ){ _e('show'); } ?>">
          <div class="card-body">
            <?php echo do_shortcode($content); ?>
          </div>
        </div>
    </div>

    <?php return ob_get_clean();
}