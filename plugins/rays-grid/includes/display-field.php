<?php
// if called directly, abort.
if (!defined('WPINC')) { die; }

class raysgrid_Field {
    
    public function rsgd_taxonomy($id) {
        
        $dbObj = new raysgrid_Tables();
        if (isset($id) && $id != '') {
            $getDb = $dbObj->rsgd_selectWithId($id);
            $ct = $getDb[0]->rsgd_cats;
            $tgg = $getDb[0]->rsgd_tags;
        } else {
            $ct = $tgg = '';
        }

        // Custom Categories List
        $rsgd_cats = get_terms('rg-categories', array(
            'hide_empty' => false,
        ));
        if ($rsgd_cats && !is_wp_error($rsgd_cats)) {
            $output.= "<div id='cats_select'>";
                $output.= "<select multiple class='form-control'>";
                foreach ($rsgd_cats as $cat) {
                    if ($cat->count == 1) {
                        $catno = ' (' . $cat->count . ' Item)';
                    } else {
                        $catno = ' (' . $cat->count . ' Items)';
                    }
                    $output.= "<option value='" . $cat->slug . "'>" . $cat->name . $catno . "</option>";
                }
                $output.= '</select>';
            $output.= '<input name="rsgd_data[rsgd_cats]" type="hidden" id="cats_vl"  value="' . $ct . '"   class="" /></div>';
        } else {
            $output.= " <div id='cats_select'>";
                $output.= '<span class="in-message msg-danger">'.__('Please insert categories in the Portfolio Posts to be shown here.', RSGD_SLUG).'</span>';
            $output.= '</div>';
        }

        // Custom Tags List
        $rsgd_tags = get_terms('rg-tags', array(
            'hide_empty' => false,
        ));
        if ($rsgd_tags && !is_wp_error($rsgd_tags)) {

            $output.= "<div id='tags_select'>";
                $output .= "<select multiple class='form-control'>";
                foreach ($rsgd_tags as $tg) {
                    if ($tg->count == 1) {
                        $tgno = ' (' . $tg->count . ' Item)';
                    } else {
                        $tgno = ' (' . $tg->count . ' Items)';
                    }
                    $output .= "<option value='" . $tg->slug . "'>" . $tg->name . $tgno . "</option>";
                }
                $output.= "</select>";
            $output.= "<input name='rsgd_data[rsgd_tags]' type='hidden' id='tags_vl' value='" . sanitize_text_field($tgg) . "'  class='' /></div>";
        } else {
            $output.= "<div id='tags_select'>";
                $output.= '<span class="in-message msg-danger">'.__('Please insert tags in the Portfolio Posts to be shown here.', RSGD_SLUG).'</span>';
            $output.= '</div>';
        }

        return $output;
    }

    public function rsgd_display_field($id, $section_slug, $config_data) {

        extract($config_data);
        
        $rsgd_tbls = new raysgrid_Tables();

        $val = $std;
        if (isset($id) && $id != '') {
            $rsgd_getDb = $rsgd_tbls->rsgd_selectWithId($id);
            $val = ($name == 'oldalias') ? $rsgd_getDb[0]->alias : $rsgd_getDb[0]->$name;
        }
        
        $rsgd_req = ($not_null == 'NOT NULL') ? " required='required'" : "";
        
        $output = '';
        
        switch ($type) {
            case 'text':
                $output .= "<input type='text'{$rsgd_req} name='rsgd_data[" . $name . "]' class='dep-inp form-control " . $class . "' id='" . $name . "' placeholder='" . esc_attr($placeholder) . "' value='" . esc_attr($val) . "' />";
                break;
                
            case 'disabledtext':
                $output .= "<input type='text' readonly name='rsgd_data[" . $name . "]' class='dep-inp form-control " . $class . "' id='" . $name . "' placeholder='" . esc_attr($placeholder) . "' value='" . esc_attr($val) . "' />";
                break;

            case 'hidden':
                $output .= "<input type='hidden' name='rsgd_hidden[" . $name . "]' class='dep-inp form-control " . $class . "' id='" . $name . "'  value='" . esc_attr($val) . "'  />";
                break;

            case 'radio':

                foreach ($choices as $key => $value) {
                    $output .= ' <div class="' . $class . '"><input id="' . $name . '" data-name="' . esc_attr($value) . '" type="radio" name="rsgd_data[' . $name . ']" value="' . esc_attr($key) . '"';
                    if ($key == $val) {
                        $output .= 'checked="checked"';
                    }
                    $output .= '><label class="radio-lbl">'.esc_attr($value).'</label></div>';
                }
                break;

            case 'dropdown':
                if ($name == 'rsgd_select_taxonomy') {
                    $output .= '<select name="rsgd_data[' . $name . ']" id="' . $name . '" class="dep-inp form-control ' . $class . '"  id="nav_select">';
                } else {
                    $output .= '<select name="rsgd_data[' . $name . ']" id="' . $name . '" class="dep-inp form-control ' . $class . '">';
                }
                foreach ($choices as $key => $value) {
                    $output .= '<option value="' . $key . '" ';

                    if ($val == $key) {
                        $output .= ' selected="selected"';
                    }
                    $output .= ' >' . esc_attr($value) . '</option>';
                }
                $output .= '</select>';
                break;
                
            case 'multidropdown':

                $output .= '<select multiple="multiple" data-nam="' . $name . '" class="dep-inp form-control">';
                    foreach ($choices as $key => $value) {
                        $output .= '<option value="' . $key . '">' . $value . '</option>';
                    }
                $output .= '</select>';
                $output .= "<input type='hidden' name='rsgd_data[" . $name . "]' class='dep-inp form-control " . $class . "' id='" . $name . "'  value='" . esc_attr($val) . "'  />";
                break;
            
            case 'taxsdropdown':

                $output .= '<select multiple="multiple" data-nam="' . $name . '" class="dep-inp form-control">';

                    foreach ( rsgd_post_types() as $post_typ => $typ ) {

                        $taxonomies = get_object_taxonomies( $post_typ );
                                                
                        foreach ($taxonomies as $tax){
                                                        
                            $terms = get_terms( $tax, array( 'hide_empty' => false ));
                            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                $output .= '<option class="'.$tax.' dis_opt" data-type="'.$post_typ.'" disabled> -- '.$tax.' -- </option>';
                                foreach ( $terms as $term ) {
                                    $output .= '<option class="'.$tax.'" data-type="'.$post_typ.'" value="'.$tax.'||'.$term->slug.'||'.$term->name.'||'.$term->count.'">'.$term->name.' ('.$term->count.' Items)'. ' [ Slug: '.$term->slug.']</option>';
                                }
                            }
                        }
                    }
                
                $output .= '</select>';
                $output .= "<input type='hidden' name='rsgd_data[" . $name . "]' class='dep-inp form-control " . $class . "' id='" . $name . "'  value='" . esc_attr($val) . "'  />";
                break;

            case 'number':

                $output .= '<div class="slidernum" data-min="' . $min . '" data-max="' . $max . '"></div>';
                $output .= '<input type="number" name="rsgd_data[' . $name . ']" id="' . $name . '" class="num-txt dep-fld form-control ' . $class . '" id="' . $name . '" placeholder="' . $placeholder . '" value="' . sanitize_text_field($val) . '" />';
                break;
                
            case 'color':
                    echo '<input class="rsgd_color'. $class .'" type="text"  data-alpha="true" id="' . $name . '" name="rsgd_data[' . $name . ']" placeholder="' . $placeholder . '" value="' . esc_attr( $val ) . '" />';
                break; 
                
            case 'twonumber':
                $firstVal = explode('|', $val );
                $lastVal = substr( $val , strpos( $val , "|") + 1);
                    $output .= '<input class="form-control rsgd_num-txt no-slider rsgd_firstVL" type="number" placeholder="' . $firstVal[0] . '" value="' . sanitize_text_field($firstVal[0]) . '" /> : ';
                    $output .= '<input class="form-control rsgd_num-txt no-slider rsgd_lastVL" type="number" placeholder="' . $lastVal . '" value="' . sanitize_text_field($lastVal) . '" />';
                    $output .= '<input class="rsgd_hid_two_num ' . $class . '" type="hidden" id="' . $name . '" name="rsgd_data[' . $name . ']" placeholder="' . $placeholder . '" value="' . sanitize_text_field($val) . '" />';
                break;

            case 'checkbox':

                $output .= '<input type="hidden" id="'.$name.'" class="dep-inp checktxt ' . $class . '" value= "' . esc_attr($val) . '" name="rsgd_data[' . $name . ']"  />';
                $output .= '<span class="rsgd_chk"><span class="rsgd_switch"></span></span>';
                break;

            case 'textarea':
            
                $output .= '<textarea type="text" id="' . $name . '" placeholder="' . $placeholder . '"  class="form-control ' . $class . '" name="rsgd_data[' . $name . ']" style="width: 100%">' . sanitize_textarea_field($val) . '</textarea>';
                break;

            default:
                break;
        }
        
        echo $output;
        
    }

}
new raysgrid_Field();