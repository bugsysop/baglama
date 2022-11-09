<?php
/*
 * Build with the WordPress Option Page generator
 * at http://jeremyhixon.com/wp-tools/option-page/
 */
class BaglamaTools
{
    private $__baglama_tools_options;

    public function __construct()
    {
        add_action('admin_menu', array($this, 'baglama_tools_add_plugin_page'));
        add_action('admin_init', array($this, 'baglama_tools_page_init'));
    }

    public function baglama_tools_add_plugin_page()
    {
        add_options_page(
            'Bağlama Settings',                                 // page_title
            'Bağlama Tools',                                    // menu_title
            'manage_options',                                   // capability
            'baglama-tools',                                    // menu_slug
            array($this, 'baglama_tools_create_admin_page')     // function
        );
    }
    public function baglama_tools_create_admin_page()
    {
        $this->__baglama_tools_options = get_option('baglama_tools_option_name'); ?>

		<div class="wrap">
		    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
		    <p><?php esc_html_e( 'Follow the white rabbit. This is a skeleton for the Bağlama options page', 'baglama' ); ?></p>
		    <form method="post" action="options.php">
				<?php
            settings_fields('baglama_tools_option_group');
            do_settings_sections('baglama-tools-admin');
            echo "<p>";
            //submit_button();
      		  submit_button( __( 'Save' ), 'primary', 'submit', false );
            echo "</p>";
        ?>
			  </form>
		</div>
    <?php }
    public function baglama_tools_page_init()
    {      
        register_setting(
            'baglama_tools_option_group',                     // option_group
            'baglama_tools_option_name',                      // option_name
            array($this, 'baglama_tools_sanitize')            // sanitize_callback
        );
        add_settings_section(
            'baglama_tools_settings_section',                 // Section id
            '',                                               // Section Title (optional)
            array($this, 'baglama_tools_section_info'),       // callback
            'baglama-tools-admin'                             // page
        );
        // Checkbox 1
        add_settings_field(
            'baglama_tools_comments_function_cbx1',           // Field id
            __( 'Comments', 'baglama' ),                      // Checkbox title
            array($this, 'baglama_tools_comments_function_cbx1_callback'), // callback
            'baglama-tools-admin',                            // page
            'baglama_tools_settings_section'                  // section
        );  
        // Checkbox 2
        add_settings_field(
            'baglama_tools_feeds_function_cbx2',              // Field id
            __( 'Feeds', 'baglama' ),                         // Checkbox title
            array($this, 'baglama_tools_feeds_function_cbx2_callback'), // callback
            'baglama-tools-admin',                            // page
            'baglama_tools_settings_section'                  // section
        );  
        // Checkbox 3
        add_settings_field(
            'baglama_tools_authors_function_cbx3',            // Field id
            __( 'Authors', 'baglama' ),                       // Checkbox title
            array($this, 'baglama_tools_authors_function_cbx3_callback'), // callback
            'baglama-tools-admin',                            // page
            'baglama_tools_settings_section'                  // section
        );    
    }
    public function baglama_tools_sanitize($input) {
        $sanitary_values = array();
        if (isset($input['baglama_tools_comments_function_cbx1'])) {
            $sanitary_values['baglama_tools_comments_function_cbx1'] = $input['baglama_tools_comments_function_cbx1'];
        }
        if (isset($input['baglama_tools_feeds_function_cbx2'])) {
            $sanitary_values['baglama_tools_feeds_function_cbx2'] = $input['baglama_tools_feeds_function_cbx2'];
        }
        if (isset($input['baglama_tools_authors_function_cbx3'])) {
            $sanitary_values['baglama_tools_authors_function_cbx3'] = $input['baglama_tools_authors_function_cbx3'];
        }
        return $sanitary_values;
    }
    public function baglama_tools_section_info(){}
    public function baglama_tools_comments_function_cbx1_callback(){
        printf(
            '<input type="checkbox" name="baglama_tools_option_name[baglama_tools_comments_function_cbx1]" id="baglama_tools_comments_function_cbx1" value="baglama_tools_comments_function_cbx1" %s> 
            <label for="checkbox_cbx1">' . __( 'Globally disable comments (admin and public site).', 'baglama' ) . '</labe>',
            (isset($this->__baglama_tools_options['baglama_tools_comments_function_cbx1']) && $this->__baglama_tools_options['baglama_tools_comments_function_cbx1'] === 'baglama_tools_comments_function_cbx1') ? 'checked' : ''
        );
    }
    public function baglama_tools_feeds_function_cbx2_callback(){
        printf(
            '<input type="checkbox" name="baglama_tools_option_name[baglama_tools_feeds_function_cbx2]" id="baglama_tools_feeds_function_cbx2" value="baglama_tools_feeds_function_cbx2" %s> 
            <label for="checkbox_cbx2">' . __( 'Disable completely RSS/Atom Feeds for all post type.', 'baglama' ) . '</labe>',
            (isset($this->__baglama_tools_options['baglama_tools_feeds_function_cbx2']) && $this->__baglama_tools_options['baglama_tools_feeds_function_cbx2'] === 'baglama_tools_feeds_function_cbx2') ? 'checked' : ''
        );
    }
    public function baglama_tools_authors_function_cbx3_callback(){
        printf(
            '<input type="checkbox" name="baglama_tools_option_name[baglama_tools_authors_function_cbx3]" id="baglama_tools_authors_function_cbx3" value="baglama_tools_authors_function_cbx3" %s> 
            <label for="checkbox_cbx3">' . __( 'Disable author’s archives page for public site.', 'baglama' ) . '</labe>',
            (isset($this->__baglama_tools_options['baglama_tools_authors_function_cbx3']) && $this->__baglama_tools_options['baglama_tools_authors_function_cbx3'] === 'baglama_tools_authors_function_cbx3') ? 'checked' : ''
        );
    }
}
if (is_admin()) {
    $baglama_tools = new BaglamaTools();
}
