<?php
class TLAE_Ajax {
    public function __construct() {
        add_action('wp_ajax_tlae_load_fields', array($this, 'load_fields'));
        add_action('wp_ajax_nopriv_tlae_load_fields', array($this, 'load_fields'));
    }

    public function load_fields() {
        check_ajax_referer('tlae_nonce', 'nonce');
        $type = sanitize_text_field($_POST['type']);
        if ($type == 'university') {
            // حمّل قوائم الجامعات/الكليات/الأقسام من taxonomy
            $universities = get_terms(array('taxonomy' => 'academic_university', 'hide_empty' => false, 'parent' => 0));
            echo '<select name="tlae_university"><option>' . __('اختر الجامعة', 'tutor-lms-academic-extension') . '</option>';
            foreach ($universities as $uni) {
                echo '<option value="' . $uni->term_id . '">' . $uni->name . '</option>';
            }
            echo '</select>';
            // أضف قوائم أخرى مشابهة مع onchange لـ AJAX
        } elseif ($type == 'school') {
            // مشابه للمدارس
        } // إلخ
        wp_die();
    }
}
