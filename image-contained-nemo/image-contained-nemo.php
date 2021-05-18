<?php

// CSS Vars
$layout_name = basename( dirname( __FILE__ ) );

$field_group = PIP_Layouts_Single::get_layout_field_group_by_slug( $layout_name );
$layout_vars = acf_maybe_get( $field_group, 'pip_layout_var' );
$css_vars    = array();
if ( $layout_vars ) {
    foreach ( $layout_vars as $layout_var ) {
        $css_vars[ acf_maybe_get( $layout_var, 'pip_layout_var_key' ) ] = acf_maybe_get( $layout_var, 'pip_layout_var_value' );
    }
}

$wrapper_image_vars = acf_maybe_get( $css_vars, 'wrapper-image' );
$image_vars         = acf_maybe_get( $css_vars, 'image' );

// Fields
$image = get_sub_field( 'image' );

// Configuration
$advanced_mode   = get_sub_field( 'advanced_mode' );
$container_width = get_sub_field( 'container_width' );
$img_height      = get_sub_field( 'img_height' );

// Content width
$content_width = '';

// If has container width
if ( $container_width ) {
    // Browse container widths
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
}
?>
    <section class="<?php echo $layout_name; ?>">
        <div class="container">
            <div class="mx-auto wrapper-image <?php echo $content_width . ' ' . $wrapper_image_vars; ?>">

                <img
                    src="<?php echo acf_maybe_get( $image, 'url' ); ?>"
                    alt="<?php echo acf_maybe_get( $image, 'alt' ); ?>"
                    class="image <?php echo $image_vars; ?>"
                    style="height: <?php echo $img_height; ?>px;"
                >

            </div>
        </div>
    </section>
<?php
