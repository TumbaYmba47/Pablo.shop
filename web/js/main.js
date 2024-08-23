function clearCart (event) {
    if (confirm('точно очистить??')){
        event.preventDefault();
        $.ajax({
            url: '/../cart/clear',
            type: 'GET',
            success: function (res) {
                $('#cart .modal-content') .html(res);
                $('.menuQ').html('(0)')
            },
            error: function (){
                alert('error');
            }
        })
    }
}
$('.product-button__add') .on('click', function (event) {
    event.preventDefault();
    let id = $(this).data('id');
    $.ajax({
        url: '/../cart/add',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            $('#cart .modal-content').html(res);
            $('.menuQ').html('(' + $('.total-quantity').html() + ')');
        },
        error: function () {
            alert('error');
        }
    })
})
$('.cart') .on('click', function () {
    $.ajax({
        url: '/cart/open',
        type: 'GET',
        success: function (res) {
            $('#cart .modal-content').html(res);
        },
        error: function () {
            alert('error');
        }
    })
})
$('.modal-content') .on('click', '.delete', function () {
    let id = $(this).data('id');
    $.ajax({
        url: '/cart/remove',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            $('#cart .modal-content').html(res);
            $('.menuQ').html('(' + $('.total-quantity').html() + ')')
        },
        error: function () {
            alert('error');
        }
    })
})
