<?php
/*
Plugin Name: Post to PDF Converter
Description: Convert posts to PDF.
Version: 1.0
Author: Your Name
*/

define('P2P_PLUGIN_DIR', plugin_dir_path(__FILE__));

class Post_To_PDF {



  private static $instance;

  public static function init() {
    if (!self::$instance) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  private function __construct() {

    // Load dependencies
    require_once __DIR__ . '/includes/class-dompdf-loader.php'; 
    require_once __DIR__ . '/includes/class-pdf-generator.php';
    require_once __DIR__ . '/includes/helper-functions.php';
    require_once __DIR__ . '/includes/class-p2p-settings.php';
    require_once __DIR__ . '/templates/pdf-template.php';

    // Init plugin
    $this->setup_hooks();

  }

  private function setup_hooks() {
    // Init classes
    $pdf_generator = new PDF_Generator();
    $pdf_generator = new PDF_Generator(P2P_PLUGIN_DIR);
    $settings = new P2P_Settings();
  }

}

Post_To_PDF::init();
