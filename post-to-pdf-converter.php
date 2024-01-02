<?php
/**
 * Plugin Name: Post to PDF Converter
 * Description: Convert posts to PDF.
 * Version: 1.0
 * Author: Your Name
 */

// Define plugin paths and URLs for easy reference.
define('P2P_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('P2P_PLUGIN_URL', plugin_dir_url(__FILE__));

// Autoload the Dompdf if you're using Composer.
require_once P2P_PLUGIN_DIR . 'vendor/dompdf/autoload.inc.php';

// Include the necessary files.
require_once P2P_PLUGIN_DIR . 'includes/class-dompdf-loader.php';
require_once P2P_PLUGIN_DIR . 'includes/class-pdf-generator.php';
require_once P2P_PLUGIN_DIR . 'includes/helper-functions.php';
require_once P2P_PLUGIN_DIR . 'includes/class-p2p-settings.php';

// Initialize the plugin functionality.
function p2p_init() {
    $pdf_generator = new PDF_Generator();
    $pdf_generator->hooks();
}

add_action('plugins_loaded', 'p2p_init');

