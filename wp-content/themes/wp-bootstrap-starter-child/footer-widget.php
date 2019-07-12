<?php
	$widget_column = get_option( 'options_widget_column' );
	if ( $widget_column ) {
		$classes = array(
			1 => 'col-12 col-md-12',
			2 => 'col-12 col-md-6',
			3 => 'col-12 col-md-4',
			4 => 'col-12 col-md-3'
		);
		?>
        <div id="footer-widget" class="row m-0 <?php if ( ! is_theme_preset_active() ) {
			echo 'bg-light';
		} ?>">
            <div class="container">
                <div class="row">
					<?php foreach ( range( 1, $widget_column ) as $value ) { ?>
                        <div class="<?php echo $classes[ $widget_column ]; ?>"><?php is_active_sidebar( "footer-{$value}" ) ? dynamic_sidebar( "footer-{$value}" ) : ''; ?></div>
					<?php } ?>
                </div>
            </div>
        </div>

	<?php }