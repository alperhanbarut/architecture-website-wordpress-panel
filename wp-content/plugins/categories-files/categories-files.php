<?php
/**
 * @package CategoriesPDFs
 */

/**
 * Plugin Name: Categories PDFs
 * Plugin URI: http://zahlan.net/blog/categories-pdfs/
 * Description: Categories PDFs Plugin allows you to add a PDF to a category or any custom term.
 * Author: Muhammad El Zahlan
 * Version: 1.0.0
 * Author URI: http://zahlan.net/
 * Domain Path: /languages
 * Text Domain: categories-pdfs
 * License: GPLv2 or later
 */

if (!defined('ABSPATH'))
    die;

if (!defined('Z_PLUGIN_URL'))
    define('Z_PLUGIN_URL', untrailingslashit(plugins_url('', __FILE__)));

class ZCategoriesPDFs
{
    public $plugin_name;
    private $zci_placeholder;

    function __construct() {
        $this->plugin_name = plugin_basename(__FILE__);

        // The placeholder PDF file URL (if needed for display)
        $this->zci_placeholder = plugins_url('/assets/files/placeholder.pdf', __FILE__);
        add_action('admin_init', [$this, 'zAdminInit']);

        // Save our taxonomy PDF while edit or create term
        add_action('edit_term', [$this, 'zSaveTaxonomyPDF']);
        add_action('create_term', [$this, 'zSaveTaxonomyPDF']);

        // Plugin menu in admin panel
        add_action('admin_menu', [$this, 'zSettingsMenu']);

        // Settings page link in plugins list
        add_filter("plugin_action_links_{$this->plugin_name}", [$this, 'zSettingsLink']);
    }

    function zAdminInit() {
        $z_taxonomies = get_taxonomies();
        if (is_array($z_taxonomies)) {
            $zci_options = get_option('zci_options');
            
            if (!is_array($zci_options))
                $zci_options = array();
            
            if (empty($zci_options['excluded_taxonomies']))
                $zci_options['excluded_taxonomies'] = array();
            
            foreach ($z_taxonomies as $z_taxonomy) {
                if (in_array($z_taxonomy, $zci_options['excluded_taxonomies']))
                    continue;
                add_action($z_taxonomy.'_add_form_fields', [$this, 'zAddTaxonomyField']);
                add_action($z_taxonomy.'_edit_form_fields', [$this, 'zEditTaxonomyField']);
                add_filter('manage_edit-'.$z_taxonomy.'_columns', [$this, 'zTaxonomyColumns']);
                add_filter('manage_'.$z_taxonomy.'_custom_column', [$this, 'zTaxonomyColumn'], 10, 3 );

                // If tax is deleted
                add_action("delete_{$z_taxonomy}", function($tt_id) {
                    delete_option('z_taxonomy_pdf'.$tt_id);
                    delete_option('z_taxonomy_pdf_id'.$tt_id);
                });
            }
        }

        // Register styles and scripts
        if ( strpos( $_SERVER['SCRIPT_NAME'], 'edit-tags.php' ) > 0 || strpos( $_SERVER['SCRIPT_NAME'], 'term.php' ) > 0 ) {
            add_action('admin_enqueue_scripts', [$this, 'zAdminEnqueue']);
            add_action('quick_edit_custom_box', [$this, 'zQuickEditCustomBox'], 10, 3);
        }

        // Register settings
        register_setting('zci_options', 'zci_options');
        add_settings_section('zci_settings', __('Categories PDFs settings', 'categories-pdfs'), [$this, 'zSectionText'], 'zci-options');
        add_settings_field('z_excluded_taxonomies', __('Excluded Taxonomies', 'categories-pdfs'), [$this, 'zExcludedTaxonomies'], 'zci-options', 'zci_settings');
    }

    function zAdminEnqueue() {
        wp_enqueue_style('categories-pdfs-styles', plugins_url('/assets/css/zci-styles.css', __FILE__));
        wp_enqueue_script('categories-pdfs-scripts', plugins_url('/assets/js/zci-scripts.js', __FILE__));

        $zci_js_config = [
            'wordpress_ver' => get_bloginfo("version"),
            'placeholder' => $this->zci_placeholder
        ];
        wp_localize_script('categories-pdfs-scripts', 'zci_config', $zci_js_config);
    }

    // Add PDF field in add form
    function zAddTaxonomyField() {
        if (get_bloginfo('version') >= 3.5)
            wp_enqueue_media();
        else {
            wp_enqueue_style('thickbox');
            wp_enqueue_script('thickbox');
        }
        
        echo '<div class="form-field">
            <input type="hidden" name="zci_taxonomy_pdf_id" id="zci_taxonomy_pdf_id" value="" />
            <label for="zci_taxonomy_pdf">' . __('PDF', 'categories-pdfs') . '</label>
            <input type="text" name="zci_taxonomy_pdf" id="zci_taxonomy_pdf" value="" />
            <br/>
            <button class="z_upload_pdf_button button">' . __('Upload/Add PDF', 'categories-pdfs') . '</button>
        </div>';
    }

    // Add PDF field in edit form
    function zEditTaxonomyField($taxonomy) {
        if (get_bloginfo('version') >= 3.5)
            wp_enqueue_media();
        else {
            wp_enqueue_style('thickbox');
            wp_enqueue_script('thickbox');
        }
        
        if ($this->zTaxonomyPDFUrl( $taxonomy->term_id, NULL, TRUE ) == $this->zci_placeholder) {
            $pdf_url = "";
            $pdf_id  = "";
        } else {
            $pdf_url = $this->zTaxonomyPDFUrl( $taxonomy->term_id, NULL, TRUE );
            $pdf_id  = $this->zTaxonomyPDFID( $taxonomy->term_id );
        }
        echo '<tr class="form-field">
            <th scope="row" valign="top"><label for="zci_taxonomy_pdf">' . __('PDF', 'categories-pdfs') . '</label></th>
            <td><input type="hidden" name="zci_taxonomy_pdf_id" id="zci_taxonomy_pdf_id" value="'.esc_attr($pdf_id).'" /><a href="' . esc_url($this->zTaxonomyPDFUrl($taxonomy->term_id)) . '" target="_blank">View PDF</a><br/>
            <input type="text" name="zci_taxonomy_pdf" id="zci_taxonomy_pdf" value="'.esc_url($pdf_url).'" /><br />
            <button class="z_upload_pdf_button button">' . __('Upload/Add PDF', 'categories-pdfs') . '</button>
            <button class="z_remove_pdf_button button">' . __('Remove PDF', 'categories-pdfs') . '</button>
            </td>
        </tr>';
    }

    // Taxonomy column for PDFs
    function zTaxonomyColumns($columns) {
        $new_columns = array();
        $new_columns['cb'] = $columns['cb'];
        $new_columns['pdf'] = __('PDF', 'categories-pdfs');

        unset($columns['cb']);

        return array_merge($new_columns, $columns);
    }

    // PDF column value for admin
    function zTaxonomyColumn($columns, $column, $id) {
        if ($column == 'pdf') 
            $columns = '<span><a href="' . $this->zTaxonomyPDFUrl($id) . '" target="_blank">' . __('View PDF', 'categories-pdfs') . '</a></span>';
        
        return $columns;
    }

    function zQuickEditCustomBox($column_name, $screen, $name) {
        if ($column_name == 'pdf') 
            echo '<fieldset>
            <div class="pdf inline-edit-col">
                <label>
                    <span class="title">' . __('PDF', 'categories-pdfs') . '</span>
                    <span class="input-text-wrap"><input type="text" name="zci_taxonomy_pdf" value="" class="tax_list" /></span>
                    <span class="input-text-wrap">
                        <button class="z_upload_pdf_button button">' . __('Upload/Add PDF', 'categories-pdfs') . '</button>
                        <button class="z_remove_pdf_button button">' . __('Remove PDF', 'categories-pdfs') . '</button>
                    </span>
                    <span class="input-text-wrap">
                        <input type="hidden" name="zci_taxonomy_pdf_id" value="" />
                    </span>
                </label>
            </div>
        </fieldset>';
    }

    // Save PDF
    function zSaveTaxonomyPDF($term_id) {
        if(isset($_POST['zci_taxonomy_pdf'])) {
            update_option('z_taxonomy_pdf'.$term_id, $_POST['zci_taxonomy_pdf'], false);
        }
        if(isset($_POST['zci_taxonomy_pdf_id'])) {
            update_option('z_taxonomy_pdf_id'.$term_id, $_POST['zci_taxonomy_pdf_id'], false);
        }
    }

    // Get the PDF URL for the given term_id (placeholder PDF by default)
    function zTaxonomyPDFUrl($term_id = NULL, $size = 'full', $return_placeholder = FALSE) {
        if (!$term_id) {
            if (is_category())
                $term_id = get_query_var('cat');
            elseif (is_tag())
                $term_id = get_query_var('tag_id');
            elseif (is_tax()) {
                $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                $term_id = $current_term->term_id;
            }
        }
        
        $taxonomy_pdf_url = get_option('z_taxonomy_pdf'.$term_id);
        return ($return_placeholder && empty($taxonomy_pdf_url)) ? $this->zci_placeholder : $taxonomy_pdf_url;
    }

    // Get the PDF ID for a term
    function zTaxonomyPDFID($term_id = NULL) {
        if (!$term_id) {
            if (is_category())
                $term_id = get_query_var('cat');
            elseif (is_tag())
                $term_id = get_query_var('tag_id');
            elseif (is_tax()) {
                $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                $term_id = $current_term->term_id;
            }
        }
        
        $taxonomy_pdf_id = get_option('z_taxonomy_pdf_id'.$term_id);
        return $taxonomy_pdf_id;
    }

    function zSettingsMenu() {
        add_menu_page(__('Categories PDFs settings', 'categories-pdfs'), __('Categories PDFs', 'categories-pdfs'), 'manage_options', 'zci_settings_pdf', [$this, 'zSettingsPage'], 'dashicons-media-document', 80);
    }

    // Plugin option page
    function zSettingsPage() {
        if (!current_user_can('manage_options'))
            wp_die(__('You do not have sufficient permissions to access this page.', 'categories-pdfs'));
        require_once plugin_dir_path(__FILE__).'templates/admin.php';
    }

    function zSettingsLink($links) {
        $settings_link = '<a href="admin.php?page=zci_settings_pdf">Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }

    // Settings section description
    function zSectionText() {
        echo '<p>' . __('Please select the taxonomies you want to exclude it from Categories PDFs plugin', 'categories-pdfs') . '</p>';
    }

    // Excluded taxonomies checkbox
    function zExcludedTaxonomies() {
        $options = get_option('zci_options');
        $disabled_taxonomies = ['nav_menu', 'link_category', 'post_format'];
        foreach (get_taxonomies() as $tax) : if (in_array($tax, $disabled_taxonomies)) continue; ?>
            <input type="checkbox" name="zci_options[excluded_taxonomies][<?php echo $tax ?>]" value="<?php echo $tax ?>" <?php checked(isset($options['excluded_taxonomies'][$tax])); ?> /> <?php echo $tax ;?><br />
        <?php endforeach;
    }
    
    function activate() {
        flush_rewrite_rules();
    }

    function deactivate() {
        flush_rewrite_rules();
    }
}

if (class_exists('ZCategoriesPDFs')) {
    $z_categories_pdfs = new ZCategoriesPDFs();

    // After activating the plugin
    register_activation_hook(__FILE__, [$z_categories_pdfs, 'activate']);

    // After deactivating the plugin
    register_deactivation_hook(__FILE__, [$z_categories_pdfs, 'deactivate']);
    
    function z_taxonomy_pdf_url($term_id = NULL, $size = 'full', $return_placeholder = FALSE) {
        $zci = new ZCategoriesPDFs();
        return $zci->zTaxonomyPDFUrl($term_id, $size, $return_placeholder);
    }

    function z_taxonomy_pdf_id($term_id = NULL) {
        $zci = new ZCategoriesPDFs();
        return $zci->zTaxonomyPDFID($term_id);
    }
}
