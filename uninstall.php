<?php
// منع الوصول المباشر
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// حذف التصنيفات والميتا
delete_option('tlae_settings');
$taxonomies = array('academic_university', 'academic_school', 'academic_general');
foreach ($taxonomies as $tax) {
    $terms = get_terms(array('taxonomy' => $tax, 'hide_empty' => false));
    foreach ($terms as $term) {
        wp_delete_term($term->term_id, $tax);
    }
}