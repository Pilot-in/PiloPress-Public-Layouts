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
$intro_vars            = acf_maybe_get( $css_vars, 'section-intro' );
$end_section_vars      = acf_maybe_get( $css_vars, 'section-end' );
$wrapper_logos_vars    = acf_maybe_get( $css_vars, 'wrapper-logos' );
$wrapper_logo_img_vars = acf_maybe_get( $css_vars, 'wrapper-logo-img' );
$logo_img_vars         = acf_maybe_get( $css_vars, 'logo-img' );

// Fields
$section_intro = get_sub_field( 'section_intro' );
$logos         = get_sub_field( 'logos' );
$section_end   = get_sub_field( 'section_end' );

// Configuration
$advanced_mode   = get_sub_field( 'advanced_mode' );
$container_width = get_sub_field( 'container_width' );
$nb_item_per_row = get_sub_field( 'nb_item_per_row' );

// Content width
$content_width = pip_get_responsive_class( $container_width, $advanced_mode );

// Logo gridF
$wrapper_logos_class  = 'grid';
$wrapper_logos_class .= pip_get_responsive_class( $nb_item_per_row, $advanced_mode, 'grid-cols-' );
?>
<section class="<?php echo $layout_name; ?>">
    <div class="container">
        <div class="mx-auto <?php echo $content_width; ?>">

            <?php
            // Intro
            if ( $section_intro ) : ?>
            <div class="section-intro <?php echo $intro_vars; ?>">
                <?php echo $section_intro; ?>
            </div>
            <?php endif; ?>

            <?php
            // Logos
            if ( $logos ) : ?>
            <div class="wrapper-logos <?php echo $wrapper_logos_vars . ' ' . $wrapper_logos_class; ?>">
                <?php foreach ( $logos as $logo ) : ?>
                    <div class="wrapper-logo-img <?php echo $wrapper_logo_img_vars; ?>">
                        <img
                            class="logo-img <?php echo $logo_img_vars; ?>"
                            src="<?php echo acf_maybe_get( $logo, 'url' ); ?>"
                            alt="<?php echo acf_maybe_get( $logo, 'alt' ); ?>">
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php
            // Outro
            if ( $section_end ) : ?>
            <div class="section-end <?php echo $end_section_vars; ?>">
                <?php echo $section_end; ?>
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>
<?php
