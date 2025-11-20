jQuery(document).ready(function($) {
    $('.tlae-btn').click(function() {
        var type = $(this).data('type');
        $('.tlae-btn').removeClass('active');
        $(this).addClass('active');
        $.ajax({
            url: tlae_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'tlae_load_fields',
                type: type,
                nonce: tlae_ajax.nonce
            },
            success: function(response) {
                $('.tlae-academic-fields').html(response).show();
            }
        });
    });

    // onchange للحقول الهرمية (مثل جامعة → كلية)
    $(document).on('change', '[name="tlae_university"]', function() {
        // AJAX لتحميل الكليات بناءً على الجامعة (أضف مشابه)
    });
});