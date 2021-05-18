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
$content_vars = acf_maybe_get( $css_vars, 'content-intro' );

// Fields
$content = get_sub_field( 'content' );

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
?>
    <section class="<?php echo $layout_name; ?>">
        <div class="container">
            <div class="mx-auto <?php echo $content_width; ?>">

                <?php if ( $content ) : ?>
                    <div class="content <?php echo $content_vars; ?>">
                        <?php echo $content; ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
<?php
