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
$section_bg_vars             = acf_maybe_get( $css_vars, 'section-background' );
$intro_vars                  = acf_maybe_get( $css_vars, 'section-intro' );
$end_section_vars            = acf_maybe_get( $css_vars, 'section-end' );
$copyright_bar_bg_vars       = acf_maybe_get( $css_vars, 'copyright-bar-background' );
$copyright_bar_vars          = acf_maybe_get( $css_vars, 'copyright-bar' );
$copyright_bar_link_vars     = acf_maybe_get( $css_vars, 'copyright-bar-link' );
$copyright_bar_pilot_in_vars = acf_maybe_get( $css_vars, 'copyright-bar-pilot-in' );
$wrapper_columns_vars        = acf_maybe_get( $css_vars, 'wrapper-columns' );
$wrapper_column_vars         = acf_maybe_get( $css_vars, 'wrapper-column' );

// Simple content column CSS Vars
$simple_content_vars = array(
    'column_simple_content' => acf_maybe_get( $css_vars, 'column-simple-content' ),
);

// Links column CSS Vars
$links_vars = array(
    'column_links'        => acf_maybe_get( $css_vars, 'column-links' ),
    'wrapper_links_title' => acf_maybe_get( $css_vars, 'wrapper-links-title' ),
    'wrapper_links'       => acf_maybe_get( $css_vars, 'wrapper-links' ),
    'wrapper_link'        => acf_maybe_get( $css_vars, 'wrapper-link' ),
    'link'                => acf_maybe_get( $css_vars, 'link' ),
);

// Social links column CSS Vars
$social_links_vars = array(
    'column_social_links'        => acf_maybe_get( $css_vars, 'column-social-links' ),
    'wrapper_social_links_title' => acf_maybe_get( $css_vars, 'wrapper-social-links-title' ),
    'wrapper_social_links'       => acf_maybe_get( $css_vars, 'wrapper-social-links' ),
    'wrapper_social_link'        => acf_maybe_get( $css_vars, 'wrapper-social-link' ),
    'social_link_icon'           => acf_maybe_get( $css_vars, 'social-link-icon' ),
    'social_link_label'          => acf_maybe_get( $css_vars, 'social-link-label' ),
);

// Fields
$section_intro = get_sub_field( 'section_intro' );
$section_end   = get_sub_field( 'section_end' );
$links         = get_sub_field( 'links' );
?>

<section class="<?php echo "$layout_name $section_bg_vars"; ?>">
    <div class="container">

        <?php if ( $section_intro ) : ?>
            <div class="section-intro <?php echo $intro_vars; ?>">
                <?php echo $section_intro; ?>
            </div>
        <?php endif; ?>

        <?php if ( have_rows( 'columns' ) ) : ?>
            <div class="wrapper-columns <?php echo $wrapper_columns_vars; ?>">
                <?php while ( have_rows( 'columns' ) ) : ?>
                    <?php
                    the_row();
                    $row_index = get_row_index();
                    if ( have_rows( 'column' ) ) : ?>
                        <div class="wrapper-column column-<?php echo $row_index . ' ' . $wrapper_column_vars; ?>">
                            <?php
                            while ( have_rows( 'column' ) ) :
                                the_row();
                                echo get_template_part(
                                    'pilopress/layouts/' . $layout_name . '/column',
                                    get_row_layout(),
                                    array(
                                        'column_vars' => ${get_row_layout() . '_vars'},
                                    )
                                );
                            endwhile;
                            ?>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

        <?php if ( $section_end ) : ?>
            <div class="section-end <?php echo $end_section_vars; ?>">
                <?php echo $section_end; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<section class="<?php echo $copyright_bar_bg_vars; ?>">
    <div class="copyright-bar <?php echo $copyright_bar_vars; ?>">
        <div>
            <?php echo get_bloginfo( 'name' ) . ' ' . gmdate( 'Y' ); ?>
            <?php if ( $links ) : ?>
                <?php foreach ( $links as $link_item ) : ?>
                    <?php $link_item = acf_maybe_get( $link_item, 'link' ); ?>
                    <span class="copyright-bar-link <?php echo $copyright_bar_link_vars; ?>">
                        -
                        <a href="<?php echo acf_maybe_get( $link_item, 'url' ); ?>">
                            <?php echo acf_maybe_get( $link_item, 'title' ); ?>
                        </a>
                    </span>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="copyright-bar-pilot-in <?php echo $copyright_bar_pilot_in_vars; ?>">
            <a href="<?php echo site_url(); ?>" target="_blank"><?php echo get_bloginfo( 'name' ); ?></a>
        </div>
    </div>
</section>