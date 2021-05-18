<?php

if ( !function_exists( 'pip_get_responsive_class' ) ) {

    /**
     * Get responsive class
     *
     * @param      $container_width
     * @param bool $advanced_mode
     * @param null $class_prefix
     *
     * @return string
     */
    function pip_get_responsive_class( $container_width, $advanced_mode = false, $class_prefix = null ) {
        $content_width = '';

        // If no container width, return
        if ( !$container_width ) {
            return $content_width;
        }

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
                    $content_width .= ' ' . $class_prefix . $nb_items;
                    break;
                default:
                    $content_width .= ' ' . $screen . ':' . $class_prefix . $nb_items;
                    break;
            }
        }

        return $content_width;
    }
}
