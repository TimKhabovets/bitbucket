

// Login

$('.login-btn').click((e) => {
    e.preventDefault();

    let login = $('input[name = "login"]').val(),
        password = $('input[name = "password"]').val();

    $.ajax({
        url: 'vendor/signin.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login,
            password: password
        },
        success (data) {

            if(data.status) {
                document.location.href = 'page.php';
            } else {
                $('.error-msg').removeClass('none').addClass('block').text(data.message);
            }

        }
    });
});


// Register

$('.register-btn').click((e) => {
    e.preventDefault();

    $(`input`).removeClass('error');

    let login = $('input[name = "login"]').val(),
        password = $('input[name = "password"]').val(),
        conf_password = $('input[name = "conf_password"]').val(),
        email = $('input[name = "email"]').val(),
        name = $('input[name = "name"]').val(); 

    $.ajax({
        url: 'vendor/signup.php',
        type: 'POST',
        dataType: 'json',
        processData: false,
        data: {
            login: login,
            password: password,
            conf_password: conf_password,
            email: email,
            name: name
        },
        success (data) {

            if (data.status) {
                document.location.href = 'login_form.php';
            } else {

                if (data.type === 1) {
                    data.fields.forEach(function (field) {
                        $(`input[name="${field}"]`).addClass('error');
                    });

                    $('.error-msg').removeClass('none').addClass('block').text(data.message);
                }
                else if (data.type === 2) {
                    data.fields.forEach(function (field) {
                        $(`input[name="${field}"]`).addClass('error');
                    });

                    $('.error-msg.login').removeClass('none').addClass('block').text(data.message);
                }
                else if (data.type === 3) {
                    data.fields.forEach(function (field) {
                        $(`input[name="${field}"]`).addClass('error');
                    });

                    $('.error-msg.email').removeClass('none').addClass('block').text(data.message);
                }
                else if (data.type === 4) {
                    data.fields.forEach(function (field) {
                        $(`input[name="${field}"]`).addClass('error');
                    });

                    $('.error-msg.pass').removeClass('none').addClass('block').text(data.message);
                }

                
            }

        }
    });

});
