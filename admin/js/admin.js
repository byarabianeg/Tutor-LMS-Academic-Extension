jQuery(document).ready(function($) {
    $('.tlae-tabs ul li a').click(function(e) {
        e.preventDefault();
        $('.tlae-tabs ul li a').removeClass('active');
        $(this).addClass('active');
        $('.tlae-tabs div').removeClass('active');
        $($(this).attr('href')).addClass('active');
    });
    // افتراضيًا، أول تبويب مفعل
    $('.tlae-tabs ul li:first-child a').click();
});