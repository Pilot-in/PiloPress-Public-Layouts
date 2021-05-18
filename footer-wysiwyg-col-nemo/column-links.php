<?php
/**
 * Variables
 *
 * @var $args
 */
$column_vars = acf_maybe_get( $args, 'column_vars' );
$links       = get_sub_field( 'links' );
?>
<div class="column-links <?php echo acf_maybe_get( $column_vars, 'column_links' ); ?>">
    <div class="wrapper-links-title <?php echo acf_maybe_get( $column_vars, 'wrapper_links_title' ); ?>">
        <?php echo get_sub_field( 'title' ); ?>
    </div>
    <?php if ( $links ) : ?>
        <div class="wrapper-links <?php echo acf_maybe_get( $column_vars, 'wrapper_links' ); ?>">
            <?php foreach ( $links as $link_item ) : ?>
                <div class="wrapper-link <?php echo acf_maybe_get( $column_vars, 'wrapper_link' ); ?>">
                    <?php $link_item = acf_maybe_get( $link_item, 'link' ); ?>
                    <a
                        class="link <?php echo acf_maybe_get( $column_vars, 'link' ); ?>"
                        href="<?php echo acf_maybe_get( $link_item, 'url' ); ?>">
                        <?php echo acf_maybe_get( $link_item, 'title' ); ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
