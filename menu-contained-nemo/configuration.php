<?php

add_action( 'init', 'menu_contained_nemo_init' );
function menu_contained_nemo_init() {
    register_nav_menus(
        array(
            'menu_contained_nemo' => 'Menu Contained Nemo',
        )
    );
}

add_action( 'wp_enqueue_scripts', 'menu_contained_nemo_enqueue' );
function menu_contained_nemo_enqueue() {
    wp_enqueue_script( 'jquery' );
}
