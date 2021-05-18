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

// Configuration
$advanced_mode   = get_sub_field( 'advanced_mode' );
$container_width = get_sub_field( 'container_width' );
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
    // Remove "_advanced" from screen size
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

// CSS Vars
$intro_vars              = acf_maybe_get( $css_vars, 'section-intro' );
$end_section_vars        = acf_maybe_get( $css_vars, 'section-end' );
$wrapper_icons_vars      = acf_maybe_get( $css_vars, 'wrapper-icons' );
$wrapper_icon_vars       = acf_maybe_get( $css_vars, 'wrapper-icon' );
$wrapper_icon_icon_vars  = acf_maybe_get( $css_vars, 'wrapper-icon-icon' );
$wrapper_icon_image_vars = acf_maybe_get( $css_vars, 'wrapper-icon-image' );
$icon_image_vars         = acf_maybe_get( $css_vars, 'icon-image' );
$wrapper_icon_desc_vars  = acf_maybe_get( $css_vars, 'wrapper-icon-desc' );

// Fields
$section_intro   = get_sub_field( 'section_intro' );
$section_end     = get_sub_field( 'section_end' );
$nb_item_per_row = get_sub_field( 'nb_item_per_row' );

// Cards grid
$wrapper_logos_class  = 'grid';
$wrapper_logos_class .= pip_get_responsive_class( $nb_item_per_row, $advanced_mode, 'grid-cols-' );

?>
<section class="<?php echo $layout_name; ?>">
    <div class="container">
        <div class="<?php echo $content_width; ?>">

            <?php if ( $section_intro ) : ?>
                <div class="section-intro <?php echo $intro_vars; ?>">
                    <?php echo $section_intro; ?>
                </div>
            <?php endif; ?>

            <?php if ( have_rows( 'icons' ) ) : ?>
                <div class="wrapper-icons <?php echo $wrapper_icons_vars . ' ' . $wrapper_logos_class; ?>">

                    <?php while ( have_rows( 'icons' ) ) : ?>
                        <?php
                        the_row(); ?>
                        <div class="wrapper-icon <?php echo $wrapper_icon_vars; ?>">
                            <?php
                            $image = get_sub_field( 'image' ); ?>
                            <div class="wrapper-icon-image <?php echo $wrapper_icon_image_vars; ?>">
                                <img
                                    class="icon-image <?php echo $icon_image_vars; ?>"
                                    src="<?php echo acf_maybe_get( $image, 'url' ); ?>"
                                    alt="<?php echo acf_maybe_get( $image, 'alt' ); ?>">
                            </div>
                            <div class="wrapper-icon-desc <?php echo $wrapper_icon_desc_vars; ?>">
                                <?php echo get_sub_field( 'description' ); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>

                </div>
            <?php endif; ?>

            <?php if ( $section_end ) : ?>
                <div class="section-end <?php echo $end_section_vars; ?>">
                    <?php echo $section_end; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>