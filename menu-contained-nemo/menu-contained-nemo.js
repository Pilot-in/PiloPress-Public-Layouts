jQuery( document ).ready(
    function ($) {

        var layout_name   = '.menu-contained-nemo';
        var $header       = $( layout_name );
        var $main_menu    = $( layout_name + ' .wrapper-menu-items' );
        var $burger_close = $( layout_name + ' #burger button svg.close' );
        var $burger_open  = $( layout_name + ' #burger button svg.open' );

        $( document ).on(
            'click',
            '#nav-toggle',
            function (ev) {

                ev.preventDefault();

                $burger_close.toggleClass( 'hidden' );
                $burger_open.toggleClass( 'hidden' );

                if ( $main_menu.length ) {
                    $main_menu.toggleClass( 'hidden' );
                }

            },
        );

        // Add shadow on scroll
        $( window ).scroll(
            function () {
                var y = $( this ).scrollTop();
                if ( y >= $main_menu.data( 'scroll' ) ) {
                    if ( $header.data( 'has-bg' ) ) {
                        $header.addClass( 'scroll-color' );
                    } else {
                        $header.addClass( 'scroll-transparent' );
                    }
                } else {
                    if ( $header.data( 'has-bg' ) ) {
                        $header.removeClass( 'scroll-color' );
                    } else {
                        $header.removeClass( 'scroll-transparent' );
                    }
                }
            },
        );
    },
);
