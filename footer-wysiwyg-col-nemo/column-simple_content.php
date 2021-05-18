<?php
/**
 * Variables
 *
 * @var $args
 */
$column_vars = acf_maybe_get( $args, 'column_vars' );
?>
<div class="column-simple-content <?php echo acf_maybe_get( $column_vars, 'column_simple_content' ); ?>">
    <?php echo get_sub_field( 'content' ); ?>
</div>
