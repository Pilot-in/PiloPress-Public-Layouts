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
$wrapper_main_transparent_vars  = acf_maybe_get( $css_vars, 'wrapper-main-transparent' );
$wrapper_main_color_vars        = acf_maybe_get( $css_vars, 'wrapper-main-color' );
$inner_wrapper_main_vars        = acf_maybe_get( $css_vars, 'inner-wrapper-main' );
$wrapper_logo_vars              = acf_maybe_get( $css_vars, 'wrapper-logo' );
$wrapper_menu_items_vars        = acf_maybe_get( $css_vars, 'wrapper-menu-items' );
$logo_vars                      = acf_maybe_get( $css_vars, 'logo' );
$menu_class_transparent_vars    = acf_maybe_get( $css_vars, 'menu-classes-transparent' );
$menu_class_color_vars          = acf_maybe_get( $css_vars, 'menu-classes-color' );
$data_scroll_vars               = acf_maybe_get( $css_vars, 'scroll-after-nb-pixels' );
$wrapper_burger_button_vars     = acf_maybe_get( $css_vars, 'wrapper-burger-button' );
$burger_button_transparent_vars = acf_maybe_get( $css_vars, 'burger-button-transparent' );
$burger_button_color_vars       = acf_maybe_get( $css_vars, 'burger-button-color' );
$burger_button_close_vars       = acf_maybe_get( $css_vars, 'burger-button-close' );
$burger_button_open_vars        = acf_maybe_get( $css_vars, 'burger-button-open' );

// Fields
$add_bg_color     = get_sub_field( 'add_bg_color' );
$logo_transparent = get_sub_field( 'logo_transparent' );
$logo_background  = get_sub_field( 'logo_background' );
$bg_color         = get_sub_field( 'bg_color' );
$section_bg_color = get_sub_field( 'section_bg_color' );
?>
    <header data-has-bg="<?php echo (bool) $section_bg_color; ?>" class="<?php echo $layout_name; ?> relative">
        <div class="container <?php echo $section_bg_color ? 'wrapper-main-color ' . $wrapper_main_color_vars : 'wrapper-main-transparent ' . $wrapper_main_transparent_vars; ?>">
            <div class="inner-wrapper-main <?php echo $inner_wrapper_main_vars; ?>">

                <div class="wrapper-logo <?php echo $wrapper_logo_vars; ?>">
                    <?php if ( $section_bg_color ) : ?>

                        <?php if ( $logo_background ) : ?>
                            <a href="<?php echo home_url(); ?>">
                                <img
                                        class="logo <?php echo $logo_vars; ?>"
                                        src="<?php echo acf_maybe_get( $logo_background, 'url' ); ?>"
                                        alt="<?php echo acf_maybe_get( $logo_background, 'alt' ); ?>">
                            </a>
                        <?php else : ?>
                            <?php the_custom_logo(); ?>
                        <?php endif; ?>

                    <?php else : ?>

                        <?php if ( $logo_transparent ) : ?>
                            <a href="<?php echo home_url(); ?>">
                                <img
                                        class="logo <?php echo $logo_vars; ?>"
                                        src="<?php echo acf_maybe_get( $logo_transparent, 'url' ); ?>"
                                        alt="<?php echo acf_maybe_get( $logo_transparent, 'alt' ); ?>">
                            </a>
                        <?php else : ?>
                            <?php the_custom_logo(); ?>
                        <?php endif; ?>

                    <?php endif; ?>
                </div>

                <div id="burger" class="wrapper-burger-button <?php echo $wrapper_burger_button_vars; ?>">
                    <button id="nav-toggle"
                            class="<?php echo $section_bg_color ? 'burger-button-color ' . $burger_button_color_vars : 'burger-button-transparent ' . $burger_button_transparent_vars; ?>">
                        <svg class="close burger-button-close <?php echo $burger_button_close_vars; ?>" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title><?php _e( 'Menu', 'pilot-in' ); ?></title>
                            <path
                                    fill-rule="evenodd"
                                    d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                        </svg>
                        <svg class="open burger-button-open <?php echo $burger_button_open_vars; ?>" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title><?php _e( 'Menu', 'pilot-in' ); ?></title>
                            <path
                                    fill-rule="evenodd"
                                    d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                        </svg>
                    </button>
                </div>

                <nav
                        data-scroll="<?php echo $data_scroll_vars; ?>"
                        class="wrapper-menu-items <?php echo $wrapper_menu_items_vars; ?>">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu_contained_nemo',
                            'container'      => 'ul',
                            'menu_id'        => 'desktop',
                            'menu_class'     => $section_bg_color ? $menu_class_color_vars : $menu_class_transparent_vars,
                        )
                    );
                    ?>
                </nav>

            </div>
        </div>
    </header>
<?php
