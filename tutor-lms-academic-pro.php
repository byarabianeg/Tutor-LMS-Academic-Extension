<?php
/*
Plugin Name: Tutor LMS Academic Extension
Plugin URI: https://example.com
Description: Adds academic classifications to Tutor LMS with visibility control.
Version: 1.0.0
Author: Your Name
Author URI: https://example.com
Text Domain: tutor-lms-academic-extension
Domain Path: /languages
Requires at least: 5.0
Tested up to: 6.0
Requires PHP: 7.2
Requires Plugins: tutor
*/

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

// تحديد الثوابت
define('TLAE_VERSION', '1.0.0');
define('TLAE_PATH', plugin_dir_path(__FILE__));
define('TLAE_URL', plugin_dir_url(__FILE__));

// تحميل اللغات
function tlae_load_textdomain() {
    load_plugin_textdomain('tutor-lms-academic-extension', false, basename(dirname(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'tlae_load_textdomain');

// تحميل الكلاسات
require_once TLAE_PATH . 'includes/class-custom-taxonomies.php';
require_once TLAE_PATH . 'includes/class-user-registration.php';
require_once TLAE_PATH . 'includes/class-course-meta.php';
require_once TLAE_PATH . 'includes/class-course-visibility.php';
require_once TLAE_PATH . 'includes/class-admin-settings.php';
require_once TLAE_PATH . 'includes/class-ajax.php';

// تهيئة الكلاسات
new TLAE_Custom_Taxonomies();
new TLAE_User_Registration();
new TLAE_Course_Meta();
new TLAE_Course_Visibility();
new TLAE_Admin_Settings();
new TLAE_Ajax();

// تحميل CSS/JS
function tlae_enqueue_assets() {
    if (is_admin()) {
        wp_enqueue_style('tlae-admin-css', TLAE_URL . 'admin/css/admin.css');
        wp_enqueue_script('tlae-admin-js', TLAE_URL . 'admin/js/admin.js', array('jquery'), TLAE_VERSION, true);
    } else {
        wp_enqueue_style('tlae-frontend-css', TLAE_URL . 'public/css/frontend.css');
        wp_enqueue_script('tlae-frontend-js', TLAE_URL . 'public/js/frontend.js', array('jquery'), TLAE_VERSION, true);
        wp_localize_script('tlae-frontend-js', 'tlae_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('tlae_nonce')
        ));
    }
}
add_action('wp_enqueue_scripts', 'tlae_enqueue_assets');
add_action('admin_enqueue_scripts', 'tlae_enqueue_assets');