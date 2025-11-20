<?php
class TLAE_Course_Meta {
    public function __construct() {
        add_action('add_meta_boxes', array($this, 'add_meta_box'));
        add_action('save_post_tutor_course', array($this, 'save_meta'));
    }

    public function add_meta_box() {
        add_meta_box(
            'tlae_academic_meta',
            __('Academic Classification', 'tutor-lms-academic-extension'),
            array($this, 'render_meta_box'),
            'tutor_course',
            'side',
            'high'
        );
    }

    public function render_meta_box($post) {
        wp_nonce_field('tlae_meta_nonce', 'tlae_nonce');
        $type = get_post_meta($post->ID, 'tlae_type', true);
        ?>
        <p>
            <label><?php _e('Type', 'tutor-lms-academic-extension'); ?></label>
            <select name="tlae_type">
                <option value="university" <?php selected($type, 'university'); ?>><?php _e('University', 'tutor-lms-academic-extension'); ?></option>
                <option value="school" <?php selected($type, 'school'); ?>><?php _e('School', 'tutor-lms-academic-extension'); ?></option>
                <option value="general" <?php selected($type, 'general'); ?>><?php _e('General', 'tutor-lms-academic-extension'); ?></option>
            </select>
        </p>
        <!-- أضف حقول أخرى مشابهة للجامعة/المدرسة عبر JS إذا لزم -->
        <?php
    }

    public function save_meta($post_id) {
        if (!isset($_POST['tlae_nonce']) || !wp_verify_nonce($_POST['tlae_nonce'], 'tlae_meta_nonce')) {
            return;
        }
        if (isset($_POST['tlae_type'])) {
            update_post_meta($post_id, 'tlae_type', sanitize_text_field($_POST['tlae_type']));
            // احفظ الحقول الأخرى مشابهًا
        }
    }
}
