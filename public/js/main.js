$('form#register').submit(function (e) {
    e.preventDefault();
    var info = $(this).serialize();

    $.ajax({
        url: '/register',
        type: 'POST',
        data: info,
        success: function (res) {
            if (res) {
                $('form#register > input').val('');
                $('div#success').hide().slideDown(300);
                $('div#error').hide().slideUp(300).find('div.alert-danger').html(errorsHtml);
                console.log(res);
            }
        },
        error: function (res) {
            var errors = res.responseJSON['errors'];
            var errorsHtml = '';

            $.each(errors, function (index, value) {
                errorsHtml += value + '<br>';
            });
            console.log(res);
            $('div#error').show().slideDown(300).find('div.alert-danger').html(errorsHtml);
        }
    });
});

$('form#auth').submit(function (e) {
    e.preventDefault();
    var info = $(this).serialize();

    $.ajax({
        url: '/auth',
        type: 'POST',
        data: info,
        success: function (res) {
            if (res) {
                window.location.href = "/";
            }
        },
        error: function (res) {
            var errors = res.responseJSON['errors'];
            var errorsHtml = '';

            $.each(errors, function (index, value) {
                errorsHtml += value + '<br>';
            });
            console.log(res);

            $('div#errorAuth').hide().slideDown(300).find('div.alert-danger').html(errorsHtml);
        }
    });
});

$('button#addOrder').click(function (e) {
    e.preventDefault();
    var item = $(this).attr('data-item');
    var token = $(this).attr('data-csrf');
    $.ajax({
        url: '/addOrder',
        type: 'POST',
        data: { item: item, _token: token },
        success: function (res) {
            console.log(res);
            $('span#addOrder').text(res);
        },
        error: function (res) {
            console.log(res);
        }
    })
})

function count(el, type, token) {
    var item = $(el).attr('data-id');

    $.ajax({
        url: '/countItem',
        type: 'POST',
        data: { item: item, type: type, _token: token },
        success: function (res) {
            console.log(res);
            $('span#count' + item).text(res.count);
            $('span#sum' + item).text(res.price + ' ₽');
            $('span#suma').text(res.sum + ' ₽');
            $('.countCard').text(res.countCard1);
            console.log(res.countCard);
        },
        error: function (res) {
            console.log(res);
        }
    });
}
