<?php
class Custom_Main_Menu_Walker extends Walker_Nav_Menu
{

    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $submenu_class = 'sub-menu';
        $output .= "\n$indent<ul class=\"$submenu_class\">\n";
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id_attr = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id_attr = $id_attr ? ' id="' . esc_attr($id_attr) . '"' : '';

        $output .= $indent . '<li' . $id_attr . $class_names . '>';

        $atts = array();
        $atts['title']  = ! empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = ! empty($item->target)     ? $item->target     : '';
        $atts['rel']    = ! empty($item->xfn)        ? $item->xfn        : '';
        $atts['href']   = ! empty($item->url)        ? $item->url        : '';

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (! empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);

        if (is_object($args)) {
            $before       = isset($args->before) ? $args->before : '';
            $link_before  = isset($args->link_before) ? $args->link_before : '';
            $link_after   = isset($args->link_after) ? $args->link_after : '';
            $after        = isset($args->after) ? $args->after : '';
        } elseif (is_array($args)) {
            $before       = isset($args['before']) ? $args['before'] : '';
            $link_before  = isset($args['link_before']) ? $args['link_before'] : '';
            $link_after   = isset($args['link_after']) ? $args['link_after'] : '';
            $after        = isset($args['after']) ? $args['after'] : '';
        } else {
            $before = $link_before = $link_after = $after = '';
        }

        $item_output  = $before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $link_before . $title . $link_after;
        $item_output .= '</a>';
        $item_output .= $after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>\n";
    }
}
