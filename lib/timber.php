<?php


add_filter('timber_context', 'add_to_context');
function add_to_context($context){


    /**
     * Menus - if these are not defined in the wp backend, Timber freaks out and queries every single post
     *
     * @see /lib/setup.php for menu registration
     */
    $context['menu_primary'] = new TimberMenu('primary_navigation');
    $context['menu_products'] = new TimberMenu('products_navigation');
    // $context['menu_footer'] = [
    //     'footer1' => new TimberMenu('footer_1'),
    //     'footer2' => new TimberMenu('footer_2'),
    //     'footer3' => new TimberMenu('footer_3'),
    //     'footer4' => new TimberMenu('footer_4'),
    //     'footer5' => new TimberMenu('footer_5')
    // ];





    /**
     * Output current year for footer copywrite message
     *
     */

    $context['current_year'] = date('Y');
    // $context['categories'] = Timber::get_terms('category', 'show_count=0&title_li=&hide_empty=0&exclude=1');

    // $context['current_time'] = current_time('timestamp');





    /**
     * Output path to template image files
     *
     */

    $context['path_images'] = get_template_directory_uri() . '/dist/images/';


    /**
     * make options fields site-wide
     *
     */
    $context['options'] = get_fields('options');



    return $context;
}



class Product extends TimberPost {

    function get_product_children() {
        $post_id = $this->id;
        $args = array(
            'post_type' => 'products',
            'child_of' => $post_id
        );

        $pages = get_pages($args);

        return $pages;
    }

    function child_count() {
        $post_id = $this->id;

        $pages = $this->get_product_children();

        $count = 0;
        foreach ($pages as $page) {
            $count++;
        }

        if ($count > 0) {
            return $count;
        } else {
            return 0;
        }
    } 
}

