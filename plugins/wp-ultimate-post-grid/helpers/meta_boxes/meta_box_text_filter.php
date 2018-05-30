<?php
// Grid should never be null. Construct just allows easy access to WPUPG_Grid functions in IDE.
if( is_null( $grid ) ) $grid = new WPUPG_Grid(0);

$filter_style = $grid->filter_style();
$text_style = $filter_style['text'];
?>

<table id="wpupg_form_text_filter_style" class="wpupg_form">
    <tr class="wpupg_divider">
        <td><label for="wpupg_text_filter_style_placeholder_text"><?php _e( 'Placeholder text', 'wp-ultimate-post-grid' ); ?></label></td>
        <td>
            <input type="text" name="wpupg_text_filter_style_placeholder_text" id="wpupg_text_filter_style_placeholder_text" value="<?php echo $text_style['placeholder_text']; ?>" />
        </td>
        <td><?php _e( 'Text shown as placeholder for the search input.', 'wp-ultimate-post-grid' ); ?></td>
    </tr>
</table>