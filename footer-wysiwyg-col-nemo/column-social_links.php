<?php
/**
 * Variables
 *
 * @var $args
 */
$column_vars  = acf_maybe_get( $args, 'column_vars' );
$social_links = get_sub_field( 'social_links' );
?>
<div class="column-social-links <?php echo acf_maybe_get( $column_vars, 'column_social_links' ); ?>">
    <div class="wrapper-social-links-title <?php echo acf_maybe_get( $column_vars, 'wrapper_social_links_title' ); ?>">
        <?php echo get_sub_field( 'title' ); ?>
    </div>
    <?php if ( $social_links ) : ?>
        <div class="wrapper-social-links <?php echo acf_maybe_get( $column_vars, 'wrapper_social_links' ); ?>">
            <?php foreach ( $social_links as $social_link ) : ?>
                <div class="wrapper-social-link <?php echo acf_maybe_get( $column_vars, 'wrapper_social_link' ); ?>">
                    <?php $icon_class = acf_maybe_get( $social_link, 'icon' ); ?>
                    <?php $link_item = acf_maybe_get( $social_link, 'link' ); ?>

                    <a target="<?php echo acf_maybe_get( $link_item, 'target' ); ?>" href="<?php echo acf_maybe_get( $link_item, 'url' ); ?>">
                        <?php if ( $icon_class ) : ?>
                            <i class="social-link-icon <?php echo $icon_class . ' ' . acf_maybe_get( $column_vars, 'social_link_icon' ); ?>"></i>
                        <?php endif; ?>

                        <span class="social-link-label <?php echo acf_maybe_get( $column_vars, 'social_link_label' ); ?>">
                            <?php echo acf_maybe_get( $link_item, 'title' ); ?>
                        </span>
                    </a>

                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
