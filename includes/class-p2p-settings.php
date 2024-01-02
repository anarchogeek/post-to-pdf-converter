<?php

class P2P_Settings {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
    }

    public function add_admin_menu() {
        add_options_page(
            'Post to PDF Converter Settings',
            'Post to PDF',
            'manage_options',
            'post-to-pdf',
            array($this, 'settings_page')
        );
    }

    public function register_settings() {
        register_setting('p2p_settings', 'p2p_options', array($this, 'validate_options'));

        add_settings_section(
            'p2p_settings_section',
            'PDF Settings',
            array($this, 'settings_section_callback'),
            'post-to-pdf'
        );

        add_settings_field(
            'p2p_header_text',
            'Header Text',
            array($this, 'header_text_callback'),
            'post-to-pdf',
            'p2p_settings_section'
        );

        // Add more fields as needed...
    }

    public function settings_section_callback() {
        echo '<p>Customize the PDF output settings.</p>';
    }

    public function header_text_callback() {
        $options = get_option('p2p_options');
        echo '<input type="text" id="p2p_header_text" name="p2p_options[header_text]" value="' . esc_attr($options['header_text'] ?? '') . '">';
    }

    public function validate_options($input) {
        $validated = array();
        $validated['header_text'] = sanitize_text_field($input['header_text'] ?? '');
        // Validate other options as needed...
        return $validated;
    }

    public function settings_page() {
        ?>
        <div class="wrap">
            <h1>Post to PDF Converter Settings</h1>
            <form action="options.php" method="post">
                <?php
                settings_fields('p2p_settings');
                do_settings_sections('post-to-pdf');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}

// Initialize the settings class
$p2p_settings = new P2P_Settings();
