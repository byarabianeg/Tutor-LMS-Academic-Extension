<?php
class TLAE_Course_Visibility {
    public function __construct() {
        add_action('pre_get_posts', array($this, 'filter_courses'));
    }

    public function filter_courses($query) {
        if (!is_admin() && $query->is_main_query() && $query->get('post_type') == 'tutor_course') {
            $user_id = get_current_user_id();
            if ($user_id) {
                $user_type = get_user_meta($user_id, 'tlae_type', true);
                if ($user_type) {
                    $meta_query = array(
                        'relation' => 'OR',
                        array('key' => 'tlae_type', 'value' => $user_type, 'compare' => '='),
                        array('key' => 'tlae_type', 'value' => 'general', 'compare' => '=') // يرى العامة
                    );
                    $query->set('meta_query', $meta_query);
                }
            }
        }
    }
}
