$(function () {
    $('input[type=radio]:checked')
        .parent("label")
        .addClass('active');
});
