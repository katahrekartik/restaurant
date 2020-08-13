function registerCustomer(username, email, password, confirm_password, food_type, user_type, submit_name) {
    $.ajax({
        url: "app/controllers/Customers.php",
        type: "POST",
        data: {
            username: username,
            email: email,
            password: password,
            confirm_password: confirm_password,
            user_type: user_type,
            food_type: food_type,
            submit_name: submit_name
        },
        cache: false,
        success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            console.log(dataResult);
            if (dataResult.status == 200) {
                $('#registerModal').find('#username').val('');
                $('#registerModal').find('#food_type').val('');
                $('#registerModal').find('#email').val('');
                $('#registerModal').find('#password').val('');
                $('#registerModal').find('#user_type').val('');
                $('#registerModal').find('#food_type').val('veg');
                $('#registerModal').find('#confirm_password').val('');
                $('#registerModal').find(".alert-success").css('display', 'block');
                $('#registerModal').find(".alert-danger").css('display', 'none');
                // $(".password_error").css('display', 'none');

            }
            //if duplicate value exist
            else if (dataResult.status == 1062) {
                $('#registerModal').find(".alert-danger").css('display', 'block');
                $('#registerModal').find(".alert-danger").find('ul').html("<li>" + dataResult.status_message + "</li>");
                $('#registerModal').find(".alert-success").css('display', 'none');
            } else {
                let html = '';
                $('#registerModal').find(".alert-danger").css('display', 'block');
                $.each(dataResult.status_message, function(index, value) {
                    html = html + "<li>" + value + "</li>";
                })
                $('#registerModal').find(".alert-danger").find('ul').html(html);

                $('#registerModal').find(".alert-success").css('display', 'none');
            }

        }
    });


}


function registerRestaurant(username, email, password, confirm_password, restaurantName, restaurantAddress, user_type, submit_name) {
    $.ajax({
        url: "app/controllers/Restaurants.php",
        type: "POST",
        data: {
            username: username,
            email: email,
            password: password,
            confirm_password: confirm_password,
            user_type: user_type,
            restaurantName: restaurantName,
            restaurantAddress: restaurantAddress,
            submit_name: submit_name
        },
        cache: false,
        success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            console.log(dataResult);
            if (dataResult.status == 200) {
                $('#registerModal').find('#username').val('');
                $('#registerModal').find('#password').val('');
                $('#registerModal').find('#restaurantName').val('');
                $('#registerModal').find('#restaurantAddress').val('');
                $('#registerModal').find('#confirm_password').val('');
                $('#registerModal').find(".alert-success").css('display', 'block');
                $('#registerModal').find(".alert-danger").css('display', 'none');
                // $(".password_error").css('display', 'none');

            }
            //if duplicate value exist
            else if (dataResult.status == 1062) {
                $('#registerModal').find(".alert-danger").css('display', 'block');
                $('#registerModal').find(".alert-danger").find('ul').html("<li>" + dataResult.status_message + "</li>");
                $('#registerModal').find(".alert-success").css('display', 'none');
            } else {
                let html = '';
                $('#registerModal').find(".alert-danger").css('display', 'block');
                $.each(dataResult.status_message, function(index, value) {
                    html = html + "<li>" + value + "</li>";
                })
                $('#registerModal').find(".alert-danger").find('ul').html(html);

                $('#registerModal').find(".alert-success").css('display', 'none');
            }

        }
    });

}

function customerLogin(username, password, submit_name) {
    $.ajax({
        url: "app/controllers/Customers.php",
        type: "POST",
        data: {
            username: username,
            password: password,
            submit_name: submit_name
        },
        cache: false,
        success: function(dataResult) {
            console.log(JSON.parse(dataResult));
            var dataResult = JSON.parse(dataResult);
            if (dataResult.status == 200) {
                if (dataResult.data.user_type == "customer") {
                    window.location.href = 'index.php';
                } else {
                    window.location.href = 'dashboard.php';
                }
                // $(".password_error").css('display', 'none');
            } else {
                $('#loginModal').find(".alert-danger").css('display', 'block');
                $('#loginModal').find(".alert-danger").find('ul').html('<li style="list-style:none">' + dataResult.status_message + '</li>');
            }
        }
    });

}

function restaurantLogin(username, password, submit_name) {
    $.ajax({
        url: "app/controllers/Restaurants.php",
        type: "POST",
        data: {
            username: username,
            password: password,
            submit_name: submit_name
        },
        cache: false,
        success: function(dataResult) {
            console.log(JSON.parse(dataResult));
            var dataResult = JSON.parse(dataResult);
            if (dataResult.status == 200) {
                if (dataResult.data.user_type == "customer") {
                    window.location.href = 'index.php';
                } else {
                    window.location.href = 'dashboard.php';
                }
                // $(".password_error").css('display', 'none');
            } else {
                $('#loginModal').find(".alert-danger").css('display', 'block');
                $('#loginModal').find(".alert-danger").find('ul').html('<li style="list-style:none">' + dataResult.status_message + '</li>');
            }
        }
    });

}


$(document).ready(function() {
    $('#signupForm input[type="radio"]').on('change', function() {
        // console.log($("#signupForm input[type='radio']:checked").attr('id'));
        var userType = $("#signupForm input[type='radio']:checked").attr('id');
        if (userType == 'restaurant') {
            $('#food_type').css('display', 'none');
            $('#restaurantName').css('display', 'block');
            $('#restaurantAddress').css('display', 'block');
            $('#food_type').val("");
            $("#signupForm input[type='text'],input[type='password']").val('');
            $('#registerModal').find("#email").css('display', 'none');
            $('#registerModal').find(".alert-success").css('display', 'none');
            $('#registerModal').find(".alert-danger").css('display', 'none');
        } else {
            $('#food_type').css('display', 'block');
            $('#restaurantName').css('display', 'none');
            $('#restaurantAddress').css('display', 'none');
            $('#food_type').val("1");
            $("#signupForm input[type='text'],input[type='password']").val('');
            $('#registerModal').find("#email").css('display', 'block');
            $('#registerModal').find(".alert-danger").css('display', 'none');
            $('#registerModal').find(".alert-danger").css('display', 'none');
        }
    });


    $('#signup').on('click', function(e) {
        //Stop page from reloading
        e.preventDefault();
        let user_type = $('#registerModal').find("#signupForm input[type='radio']:checked").val();
        let username = $('#registerModal').find('#username').val();
        let email = $('#registerModal').find('#email').val();
        let password = $('#registerModal').find('#password').val();
        let confirm_password = $('#registerModal').find('#confirm_password').val();
        let submit_name = $('#registerModal').find('#signup').attr('name');
        switch (user_type) {
            case 'customer':
                let food_type = $('#registerModal').find('#food_type').val();
                if (username != '' && email != '' && password != '' && confirm_password != '') {
                    registerCustomer(username, email, password, confirm_password, food_type, user_type, submit_name);
                } else {
                    console.log('Some fields are blank')
                }
                break;

            case 'restaurant':
                let restaurantName = $('#registerModal').find('#restaurantName').val();
                let restaurantAddress = $('#registerModal').find('#restaurantAddress').val();

                if (username != '' && restaurantName && restaurantAddress != '' && password != '' && confirm_password != '') {
                    registerRestaurant(username, email, password, confirm_password, restaurantName, restaurantAddress, user_type, submit_name);
                } else {
                    console.log('Some fields are blank')
                }
                break;
        }

    });

    $('#login').on('click', function(e) {
        //Stop page from reloading
        e.preventDefault();
        let user_type = $('#loginModal').find("#loginForm input[type='radio']:checked").val();
        let username = $('#loginModal').find('#loginUsername').val();
        let password = $('#loginModal').find('#loginPassword').val();
        let submit_name = $('#loginModal').find('#login').attr('name');
        console.log(user_type);
        switch (user_type) {
            case 'customer':
                if (username != '' && password != '') {
                    customerLogin(username, password, submit_name);
                } else {
                    console.log('Some Fields are empty');

                }
                break;

            case 'restaurant':
                if (username != '' && password != '') {
                    restaurantLogin(username, password, submit_name);
                } else {
                    console.log('Some Fields are empty');
                }
                break;
        }
    });

})