<?php
class TLAE_Admin_Settings {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_menu'));
    }

    public function add_menu() {
        add_submenu_page(
            'tutor',
            __('Academic Settings', 'tutor-lms-academic-extension'),
            __('Academic Settings', 'tutor-lms-academic-extension'),
            'manage_options',
            'tlae-settings',
            array($this, 'render_page')
        );
    }

    public function render_page() {
        ?>
        <div class="wrap">
            <h2><?php _e('Academic Settings', 'tutor-lms-academic-extension'); ?></h2>
            <div class="tlae-tabs">
                <ul>
                    <li><a href="#tab-universities"><?php _e('Universities', 'tutor-lms-academic-extension'); ?></a></li>
                    <li><a href="#tab-schools"><?php _e('Schools', 'tutor-lms-academic-extension'); ?></a></li>
                    <li><a href="#tab-general"><?php _e('General Courses', 'tutor-lms-academic-extension'); ?></a></li>
                </ul>
                <div id="tab-universities">
                    <!-- روابط لإدارة التصنيفات: edit-tags.php?taxonomy=academic_university -->
                    <a href="<?php echo admin_url('edit-tags.php?taxonomy=academic_university&post_type=tutor_course'); ?>"><?php _e('Manage Universities', 'tutor-lms-academic-extension'); ?></a>
                </div>
                <div id="tab-schools">
                    <a href="<?php echo admin_url('edit-tags.php?taxonomy=academic_school&post_type=tutor_course'); ?>"><?php _e('Manage Schools', 'tutor-lms-academic-extension'); ?></a>
                </div>
                <div id="tab-general">
                    <a href="<?php echo admin_url('edit-tags.php?taxonomy=academic_general&post_type=tutor_course'); ?>"><?php _e('Manage General Courses', 'tutor-lms-academic-extension'); ?></a>
                </div>
            </div>
        </div>
        <?php
    }
}
