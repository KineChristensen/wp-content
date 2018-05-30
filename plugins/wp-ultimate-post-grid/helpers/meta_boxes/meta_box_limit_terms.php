<?php
// Grid should never be null. Construct just allows easy access to WPUPG_Grid functions in IDE.
if( is_null( $grid ) ) $grid = new WPUPG_Grid(0);
?>

<table id="wpupg_form_limit_terms" class="wpupg_form">
    <thead>
    <tr>
        <td>Values</td>
        <td>Type</td>
    </tr>
    </thead>
    <tbody>
    <?php
    $taxonomies = get_taxonomies( '', 'objects' );

    foreach( $taxonomies as $taxonomy => $options ) { ?>
    <tr id="wpupg_form_limit_terms_<?php echo esc_attr( $taxonomy ); ?>">
        <td>
            <select name="wpupg_form_limit_terms_<?php echo esc_attr( $taxonomy ); ?>_terms[]" class="wpupg-select2" multiple>
                <?php
                $terms = get_terms( $taxonomy, array( 'hide_empty' => false ) );
                foreach( $terms as $term ) {
                    $selected = '';

                    if( in_array( $taxonomy, $grid->taxonomies() ) ? ' selected="selected"' : '' ) {
                        $selected = in_array( $term->term_id, $grid->limit_terms_terms() ) ? ' selected="selected"': '';
                    }
                    echo '<option value="' . esc_attr( $term->term_id ) . '"' . $selected . '>' . $term->name . '</option>';
                }
                ?>
            </select>
        </td>
        <td>
            <select name="wpupg_form_limit_terms_<?php echo esc_attr( $taxonomy ); ?>_type" class="wpupg-select2">
                <?php
                $rule_type_options = array(
                    'restrict' => __( 'Only these items', 'wp-ultimate-post-grid' ),
                    'exclude' => __( 'Exclude these items', 'wp-ultimate-post-grid' ),
                );

                foreach( $rule_type_options as $rule_type => $rule_type_name ) {
                    $selected = $rule_type == $grid->limit_terms_type() ? ' selected="selected"' : '';
                    echo '<option value="' . esc_attr( $rule_type ) . '"' . $selected . '>' . $rule_type_name . '</option>';
                }
                ?>
            </select>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>
