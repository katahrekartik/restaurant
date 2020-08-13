function fetchCategoryfoodItems(categoryID) {

    let html = "";
    let headingText = '';
    $.ajax({
        url: 'app/controllers/Fooditems.php?required_data=category_food_list&&category_id=' + categoryID + ' ',
        type: "GET",
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if (response.status == 200) {
                response.data.map(function(value) {
                    headngText = value.category_name;
                    html = html + "<div class='col-md-4'><div class='card'><input type='hidden' id='fooditemID' value='" + value.id + "'>" +
                        "<input type='hidden' id='restaurantID' value='" + value.restaurant_id + "'><img class='card-img-top' src='" + value.food_image + "' alt='Card image cap'/><div class='card-body'>" +
                        "<div class='item-title'><div style='width:90%'><h2>" + value.item_name + "</h2></div><div class='item-price'><p>" + value.price + "</p></div>" +
                        "</div><div class='item-description'><p>" + value.description + "</p></div></div>" +
                        "<div class='order-details'><div class='address'><Address><span>" + value.restaurant_name + "</span></Address>" +
                        "</div><div class='order-button'>" +
                        "<button class='btn button orderButton'  id='orderButton' >Order Now</button></div></div></div></div>";
                })
                $('#menuListCategory').html(html);
                $('#headingTextData').html(headngText);
                $('#subHeadingData').html(headngText);
            }

        },
        error: function(xhr, textStatus, errorThrown) {
            console.log(errorThrown);

        }
    });

}


function fetchFoodTypefoodItems(food_type) {

    let html = "";
    let headingText = '';
    $.ajax({
        url: 'app/controllers/Fooditems.php?required_data=foodtype_food_list&&food_type_id=' + food_type + ' ',
        type: "GET",
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if (response.status == 200) {
                response.data.map(function(value) {
                    headngText = value.name;
                    html = html + "<div class='col-md-4'><div class='card'><input type='hidden' id='fooditemID' value='" + value.id + "'>" +
                        "<input type='hidden' id='restaurantID' value='" + value.restaurant_id + "'><img class='card-img-top' src='" + value.food_image + "' alt='Card image cap'/><div class='card-body'>" +
                        "<div class='item-title'><div style='width:90%'><h2>" + value.item_name + "</h2></div><div class='item-price'><p>" + value.price + "</p></div>" +
                        "</div><div class='item-description'><p>" + value.description + "</p></div></div>" +
                        "<div class='order-details'><div class='address'><Address><span>" + value.restaurant_name + "</span></Address>" +
                        "</div><div class='order-button'>" +
                        "<button class='btn button orderButton'  id='orderButton' >Order Now</button></div></div></div></div>";
                })
                $('#menuListCategory').html(html);
                $('#headingTextData').html(headngText);
                $('#subHeadingData').html(headngText);
            }

        },
        error: function(xhr, textStatus, errorThrown) {
            console.log(errorThrown);

        }
    });


}

function toggleOrderbutton(userType) {
    if (userType == 'customer') {
        $(document).find(".orderButton").removeAttr('disabled');
    } else if (userType == 'restaurant') {
        $(document).find(".orderButton").attr('disabled', 'disabled');
        $(document).find(".orderButton").css({ 'background-color': 'gray', 'border': 'none' });
    }
}

function toggleOrderbuttonLogin(isloggedin) {

    if (isloggedin == true) {
        $(document).find(".orderButton").attr('data-target', '#orderModal');
        $(document).find(".orderButton").attr('data-toggle', 'modal');
    } else {
        $(document).find(".orderButton").html('login to order');
        $(document).find(".orderButton").attr('data-target', '#loginModal');
        $(document).find(".orderButton").attr('data-toggle', 'modal');
        $(document).find(".orderButton").removeAttr('disabled');
    }
}

$(document).ready(function() {
    let searchParams = new URLSearchParams(window.location.search);
    if (searchParams.has('category')) {
        let categoryID = searchParams.get('category');

        fetchCategoryfoodItems(categoryID);
    } else if (searchParams.has('food_type')) {
        let food_type = searchParams.get('food_type');
        fetchFoodTypefoodItems(food_type);
    } else {
        console.log("Do nothing");
    }

    setTimeout(function() {
        //get usertype
        let userType = $('#sessionUserType').val();
        toggleOrderbutton(userType);
        // toggle order button if not logged in
        let isloggedin = $(document).find('#sessionLoggedin').val();
        toggleOrderbuttonLogin(isloggedin);
        $('#loader').css('display', 'none');
    }, 1000);


    $(document).on('click', '#orderButton', function() {
        if ($(document).find('#sessionLoggedin').val() == true) {
            $('#itemName').val($(this).parents('div.card').find('.card-body').find('.item-title').find('h2').html());
            // console.log($(this).parents('div.card').find('.card-body').find('.item-price').find('p').html());
            $('#price').val($(this).parents('div.card').find('.card-body').find('.item-price').find('p').html());
            $('#formFooditemID').val($(this).parents('div.card').find('#fooditemID').val());
            $('#formRestaurantID').val($(this).parents('div.card').find('#restaurantID').val());
        } else {
            // $(this).attr('data-target', '#loginModal');
            // $(this).attr('data-toggle', 'modal');
            // $(this).click();
            $(document).find('#loginButton').click();
        }

    })

    $('#orderItem').on('click', function(e) {
        //Stop page from reloading
        e.preventDefault();
        let fullName = $('#fullName').val();
        let restaurantID = $('#formRestaurantID').val();
        let contact = $('#contact').val();
        let price = $('#price').val();
        let address = $('#address').val();
        let customerID = $('#customerID').val();
        let fooditemID = $('#formFooditemID').val();
        let itemName = $('#itemName').val();
        let submit_name = $('#orderItem').attr('name');
        // console.log(fullName + contact + price + address + customerID + fooditemID + itemName + submit_name);
        console.log(fooditemID);
        if (address != '' && fullName != '' && contact != '' && price != '' && itemName != '') {

            $.ajax({
                url: "app/controllers/Orders.php",
                type: "POST",
                data: {
                    restaurantID: restaurantID,
                    fullName: fullName,
                    contact: contact,
                    price: price,
                    address: address,
                    customerID: customerID,
                    fooditemID: fooditemID,
                    itemName: itemName,
                    submit_name: submit_name
                },
                cache: false,
                success: function(dataResult) {

                    var dataResult = JSON.parse(dataResult);
                    console.log(dataResult);
                    if (dataResult.status == 201) {
                        $('#fullName').val('');
                        let restaurantID = $('#formRestaurantID').val();
                        let contact = $('#contact').val('');
                        let address = $('#address').val('');
                        $('#orderModal').find(".alert-success").css('display', 'block');
                        $('#orderModal').find(".alert-danger").css('display', 'none');
                    } else {
                        $('#orderModal').find(".alert-danger").css('display', 'block');
                        $('#orderModal').find(".alert-danger").html(dataResult.status_message);
                        $('#orderModal').find(".alert-success").css('display', 'none');
                    }

                }
            });
        } else {
            $('#orderModal').find(".alert-danger").css('display', 'block');
            $('#orderModal').find(".alert-danger").html("Please fill all fields");
            $('#orderModal').find(".alert-success").css('display', 'none');
        }



    });


})