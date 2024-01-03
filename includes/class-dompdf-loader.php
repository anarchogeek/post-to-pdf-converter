<?php
    class dompdf_loader {
        public function hooks() {
            add_action('init', array($this, 'load_dompdf'));
        }

        public function load_dompdf() {
            require_once __DIR__ . './vendor/dompdf/autoload.inc.php';
        }
    }