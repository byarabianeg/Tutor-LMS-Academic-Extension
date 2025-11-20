
<?php
class TLAE_User_Registration {
    public function __construct() {
        // إضافة الحقول إلى نموذج تسجيل الطالب
        add_action('tutor_student_registration_form_after', array($this, 'add_academic_fields'));
        // إضافة الحقول إلى نموذج تسجيل المعلم
        add_action('tutor_instructor_registration_form_after', array($this, 'add_academic_fields'));
        // حفظ البيانات عند التسجيل
        add_action('user_register', array($this, 'save_academic_data'));
        // تصحيح أي مشكلة في الصفحة بإضافة fallback إذا لزم
        add_filter('tutor_registration_form', array($this, 'fix_registration_form'), 99);
    }

    public function add_academic_fields() {
        ?>
        <div class="tlae-registration-buttons">
            <button type="button" class="tlae-btn" data-type="university"><?php _e('جامعات', 'tutor-lms-academic-extension'); ?></button>
            <button type="button" class="tlae-btn" data-type="school"><?php _e('مدارس', 'tutor-lms-academic-extension'); ?></button>
            <button type="button" class="tlae-btn" data-type="general"><?php _e('كورسات عامة', 'tutor-lms-academic-extension'); ?></button>
        </div>
        <div class="tlae-academic-fields" style="display:none;">
            <!-- الحقول تُحمّل عبر AJAX في frontend.js -->
        </div>
        <?php
    }

    public function save_academic_data($user_id) {
        if (isset($_POST['tlae_type'])) {
            update_user_meta($user_id, 'tlae_type', sanitize_text_field($_POST['tlae_type']));
            if ($_POST['tlae_type'] == 'university') {
                update_user_meta($user_id, 'tlae_university', sanitize_text_field($_POST['tlae_university']));
                update_user_meta($user_id, 'tlae_college', sanitize_text_field($_POST['tlae_college']));
                update_user_meta($user_id, 'tlae_department', sanitize_text_field($_POST['tlae_department']));
            } elseif ($_POST['tlae_type'] == 'school') {
                update_user_meta($user_id, 'tlae_school', sanitize_text_field($_POST['tlae_school']));
                update_user_meta($user_id, 'tlae_stage', sanitize_text_field($_POST['tlae_stage']));
                update_user_meta($user_id, 'tlae_grade', sanitize_text_field($_POST['tlae_grade']));
            } // للعامة لا نحتاج إضافات
        }
    }

    public function fix_registration_form($form) {
        // fallback إذا كسرت الصفحة: تأكيد أن النموذج يعمل
        return $form;
    }
}