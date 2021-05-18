<?php
// Section
$layout_path = basename( __FILE__ );
$layout_name = pathinfo( $layout_path, PATHINFO_FILENAME );
$field_group = PIP_Layouts_Single::get_layout_field_group_by_slug( $layout_name );
$layout_vars = acf_maybe_get( $field_group, 'pip_layout_var' );
$css_vars    = array();
if ( $layout_vars ) {
    foreach ( $layout_vars as $layout_var ) {
        $css_vars[ acf_maybe_get( $layout_var, 'pip_layout_var_key' ) ] = acf_maybe_get( $layout_var, 'pip_layout_var_value' );
    }
}

// CSS Vars
$wrapper_content_vars       = acf_maybe_get( $css_vars, 'wrapper-content' );
$inner_wrapper_content_vars = acf_maybe_get( $css_vars, 'inner-wrapper-content' );
$content_vars               = acf_maybe_get( $css_vars, 'content' );
$overlay_vars               = acf_maybe_get( $css_vars, 'overlay' );
$image_vars                 = acf_maybe_get( $css_vars, 'image' );

// Fields
$content = get_sub_field( 'content' );

// Configuration
$advanced_mode   = get_sub_field( 'advanced_mode' );
$container_width = get_sub_field( 'container_width' );
$hero_height     = get_sub_field( 'hero_height' );
$bg_img          = get_sub_field( 'bg_img' );
$show_overlay    = get_sub_field( 'show_overlay' );
$overlay_color   = get_sub_field( 'overlay_color' );
$overlay_opacity = get_sub_field( 'overlay_opacity' );

// Content width
$content_width = '';

// Container width
foreach ( $container_width as $screen => $nb_items ) {

    if ( $advanced_mode ) {
        if ( !strstr( $screen, '_advanced' ) ) {
            continue;
        }
    } else {
        if ( strstr( $screen, '_advanced' ) ) {
            continue;
        }
    }

    // Remove "_advanced" from screen sizeF
    $screen = str_replace( '_advanced', '', $screen );

    // Build responsive class
    switch ( $screen ) {

        case 'default':
            $content_width .= ' ' . $nb_items;
            break;

        default:
            $content_width .= ' ' . $screen . ':' . $nb_items;
            break;
    }
}
?>
<section class="<?php echo $layout_name; ?>">

    <?php
    // Background image
    if ( $bg_img ) : ?>
    <img
        class="image <?php echo $image_vars; ?>"
        src="<?php echo acf_maybe_get( $bg_img, 'url' ); ?>"
        alt="<?php echo acf_maybe_get( $bg_img, 'alt' ); ?>">
    <?php endif; ?>

    <?php
    // Background overlay
    if ( $show_overlay ) : ?>
    <div class="overlay <?php echo $overlay_vars . ' ' . $overlay_color . ' ' . $overlay_opacity; ?>"></div>
    <?php endif; ?>

    <?php
    // Content
    if ( $content ) : ?>
    <div class="relative wrapper-content <?php echo $wrapper_content_vars; ?>" style="min-height: <?php echo $hero_height; ?>;">
        <div class="inner-wrapper-content <?php echo $inner_wrapper_content_vars; ?>">
            <div class="content <?php echo $content_vars . ' ' . $content_width; ?>">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

</section>
<?php
