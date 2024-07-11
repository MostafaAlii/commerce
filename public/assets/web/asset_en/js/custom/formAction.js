function formAction(elem) {
    event.preventDefault();
    var action = $(elem).attr('action');
    var method = $(elem).attr('method');
    if (method == 'GET') {
        var dataform = $(elem).serialize();
    }
    else {
        var dataform = new FormData($(elem)[0]);
    }
    $.ajax
        ({
            url: action,
            type: method,
            data: dataform,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.message != '') {
                    toasterSuccess(data.message);
                }
                setTimeout(
                    function () {
                        window.location.href = data.data
                    }, 1000);
            }
            , error: function (data) {
                toasterError(Object.values(data.responseJSON.errors)[0]);
            }
        })
}


function quickView(elem) {
    event.preventDefault();
    let url = $(elem).attr('data-id');
    $.ajax
        ({
            url: url,
            type: 'GET',
            dataType: 'HTML',
            success: function (data) {
                $('#ModalQuickview').modal('show');
                $('#quickViewContent').html(data);
            }
            , error: function (data) {
                toasterError(Object.values(data.responseJSON.errors)[0]);
            }
        })
}

function toggleFavorite(elem) {
    event.preventDefault();
    let id = $(elem).attr('data-id');
    let message = $(elem).attr('data-message');

    if (user_auth == null) {
        toasterError(message);
    }
    else {
        $.ajax
            ({
                url: url_toggle_fav,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'product_id=' + id,
                dataType: 'json',
                success: function (data) {
                    if (data.message != '') {
                        toasterSuccess(data.message);
                    }
                    let check_fav = $(elem).hasClass("favorited");
                    if (check_fav) {
                        let image = base_url + '/assets/web/assets/imgs/template/icons/wishlist.svg';
                        $(elem).css('background', "url(" + image + ") no-repeat center");
                    }
                    else {
                        let image = base_url + '/assets/web/assets/imgs/template/icons/wishlist-hover.svg';
                        $(elem).css('background', "url(" + image + ") no-repeat center");
                    }
                    $(elem).toggleClass('favorited');
                    viewFavorite()
                }
                , error: function (data) {
                    toasterError(Object.values(data.responseJSON.errors)[0]);
                }
            })
    }
}
function toggleFavoriteProduct(elem) {
    event.preventDefault();
    let id = $(elem).attr('data-id');
    let message = $(elem).attr('data-message');

    if (user_auth == null) {
        toasterError(message);
    }
    else {
        $.ajax
            ({
                url: url_toggle_fav,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'product_id=' + id,
                dataType: 'json',
                success: function (data) {
                    if (data.message != '') {
                        toasterSuccess(data.message);
                    }
                    viewFavorite();
                }
                , error: function (data) {
                    toasterError(Object.values(data.responseJSON.errors)[0]);
                }
            })
    }
}

function addCompare(elem) {
    event.preventDefault();
    let id = $(elem).attr('data-id');
    let message = "{{ __('web.login_first') }}";
    if (user_auth == null) {
        toasterError(message);
    }
    else {
        $.ajax
            ({
                url: url_add_compare,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'product_id=' + id,
                dataType: 'json',
                success: function (data) {
                    if (data.message != '') {
                        toasterSuccess(data.message);
                    }
                }
                , error: function (data) {
                    toasterError(Object.values(data.responseJSON.errors)[0]);
                }
            })
    }
}

function addCart(elem) {
    event.preventDefault();
    let id = $(elem).attr('data-id');
    let message = $(elem).attr('data-message');


    console.log($('.count'));
    let count = 1;
    if ($('.count').length > 0) {
        count = parseFloat($('.count').val());
    }

    if (user_auth == null) {
        toasterError(message);
    }
    else {
        $.ajax
            ({
                url: url_add_cart,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'product_id=' + id + '&count=' + count,
                dataType: 'json',
                success: function (data) {
                    if (data.message != '') {
                        toasterSuccess(data.message);
                    }
                    viewCart()
                }
                , error: function (data) {
                    toasterError(Object.values(data.responseJSON.errors)[0]);
                }
            })
    }
}
function buynow(elem) {
    event.preventDefault();
    let id = $(elem).attr('data-id');
    let count = 1;
    if ($('.count').length > 0) {
        count = parseFloat($('.count').val());
    }

    if (user_auth == null) {
        toasterError("{{ __('web.login_first') }}");

    }
    else {
        $.ajax
            ({
                url: url_add_cart,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'product_id=' + id + '&count=' + count,
                dataType: 'json',
                success: function (data) {
                    if (data.message != '') {
                        toasterSuccess(data.message);
                    }
                    viewCart();
                    window.location.href = url_cart;
                }
                , error: function (data) {
                    toasterError(Object.values(data.responseJSON.errors)[0]);
                }
            })
    }
}


function viewCart() {
    $.ajax
        ({
            url: url_view_cart,
            type: 'GET',
            data: '',
            dataType: 'json',
            success: function (data) {
                $('#count_carts').html(data.data.count_products);
                $('#total_cart').html(data.data.total_cart);
                $('#carts').html(data.data.products);
            }
            , error: function (data) {
                toasterError(Object.values(data.responseJSON.errors)[0]);
            }
        })
}


function viewFavorite()
{
    $.ajax
    ({
        url : url_view_favorite,
        type: 'GET',
        data: '',
        dataType:'json',
        success:function(data)
        {
            $('#count_favorites').html(data.data);
        }
        ,error:function(data)
        {
            toasterError(Object.values(data.responseJSON.errors)[0]);
        }
    })
}

