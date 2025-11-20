
<?php
class TLAE_Custom_Taxonomies {
    public function __construct() {
        add_action('init', array($this, 'register_taxonomies'));
    }

    public function register_taxonomies() {
        // تصنيف الجامعات (هرمي: جامعة → كلية → قسم)
        $labels = array(
            'name' => __('Academic Universities', 'tutor-lms-academic-extension'),
            'singular_name' => __('University', 'tutor-lms-academic-extension'),
        );
        register_taxonomy('academic_university', 'tutor_course', array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'public' => true,
            'rewrite' => array('slug' => 'university'),
        ));

        // تصنيف المدارس (هرمي: مدرسة → مرحلة → صف)
        $labels_school = array(
            'name' => __('Academic Schools', 'tutor-lms-academic-extension'),
            'singular_name' => __('School', 'tutor-lms-academic-extension'),
        );
        register_taxonomy('academic_school', 'tutor_course', array(
            'hierarchical' => true,
            'labels' => $labels_school,
            'show_ui' => true,
            'public' => true,
            'rewrite' => array('slug' => 'school'),
        ));

        // تصنيف الكورسات العامة (غير هرمي)
        $labels_general = array(
            'name' => __('General Courses', 'tutor-lms-academic-extension'),
            'singular_name' => __('General Course', 'tutor-lms-academic-extension'),
        );
        register_taxonomy('academic_general', 'tutor_course', array(
            'hierarchical' => false,
            'labels' => $labels_general,
            'show_ui' => true,
            'public' => true,
            'rewrite' => array('slug' => 'general'),
        ));
    }
}