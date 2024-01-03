<?php

class PDF_Generator {
    public function add_pdf_download_link($content) {

        // Only add link for single posts
        if(!is_single()) {
        return $content;
        }

        // Get the post ID
        global $post;
        $post_id = $post->ID;

        // Generate the PDF download link
        $link = '<p><a href="' . $this->get_pdf_download_url($post_id) . '">Download this post as a PDF</a></p>';

        // Add the link to the post content
        return $content . $link;

    }

    public function get_pdf_download_url($post_id) {

        // Generate the PDF 
        $pdf = $this->generate_pdf_from_post($post_id);

        // Output the PDF file for download
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="post_' . $post_id . '.pdf"');
        echo $pdf;

        // Stop script execution
        die();

    }

    public function generate_pdf_from_post($post_id) {
        // Get post data
        $post = get_post($post_id);
        $title = $post->post_title;
        $content = $post->post_content;
        $featured_img = get_the_post_thumbnail_url($post_id);

        // Load PDF template
        ob_start();
        include(P2P_PLUGIN_DIR . 'templates/pdf-template.php'); 
        $html = ob_get_clean();

        // Replace placeholders in template
        $html = str_replace('{POST_TITLE}', $title, $html);
        $html = str_replace('{POST_CONTENT}', $content, $html);
        $html = str_replace('{FEATURED_IMAGE}', $featured_img, $html);

        // Generate PDF from HTML
        $dompdf = new DOMPDF();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output PDF
        $pdf = $dompdf->output();

        return $pdf;

    }

    public function hooks() {

        // Hook into the_content filter
        add_filter('the_content', array($this, 'add_pdf_download_link'));
      
      }
}

