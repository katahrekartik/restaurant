function fetchAllFooditems(restaurantID) {

    let html = "";
    $.ajax({
        url: 'app/controllers/Fooditems.php?required_data=fooditems&&restaurant_id=' + restaurantID + '',
        type: "GET",
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if (response.status == 200) {
                response.data.map(function(value) {
                    html = html + '<tr><td>' + value.id + '</td><td>' + value.item_name + '</td><td>' + value.description + '</td>' +
                        '<td>' + value.category_name + '</td><td>' + value.name + '</td><td>' + value.price + '</td></tr>';
                })
                $('#dashboardAllFooditem').html(html);
            }

        },
        error: function(xhr, textStatus, errorThrown) {
                console.log(errorThrown);

            } // error callback function block
    }); // ajax call ends
}

function fetchFoodCategories() {

    let html = "";
    $.ajax({

        url: 'app/controllers/Fooditems.php?required_data=categories_data',
        type: "GET",
        dataType: 'json',
        success: function(response) {
            console.log(response);
            response.data.map(function(value) {
                html = html + '<option value=' + value.id + '>' + value.category_name + '</option>';
            })
            $('#foodCategory').html(html);
        },
        error: function(xhr, textStatus, errorThrown) {
                console.log(errorThrown);

            } // error callback function block
    }); // ajax call ends

}



function fetchFoodTypes() {

    let html = "";
    $.ajax({

        url: 'app/controllers/Fooditems.php?required_data=food_types',
        type: "GET",
        dataType: 'json',
        success: function(response) {
            console.log(response);
            response.data.map(function(value) {
                html = html + '<option value=' + value.id + '>' + value.name + '</option>';
            })
            $('#foodType').html(html);
        },
        error: function(xhr, textStatus, errorThrown) {
                console.log(errorThrown);

            } // error callback function block
    }); // ajax call ends

}

function fetchOrders(restaurantID) {

    let html = "";
    $.ajax({
        url: 'app/controllers/Orders.php?required_data=orders_list&&restaurant_id=' + restaurantID + '',
        type: "GET",
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if (response.status == 200) {
                response.data.map(function(value) {
                    html = html + '<tr><td>' + value.id + '</td><td>' + value.item_name + '</td><td>' + value.name + '</td>' +
                        '<td>' + value.total_price + '</td><td>' + value.address + '</td><td>' + value.contact_no + '</td></tr>';;
                })
                $('#ordersList').html(html);
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
}

$(document).ready(function() {
    var restaurantID = $('#restaurantID').val();
    console.log(restaurantID);
    fetchAllFooditems(restaurantID);
    fetchFoodCategories();
    fetchFoodTypes();
    fetchOrders(restaurantID);

    $('#addItem').on('click', function(e) {
        //Stop page from reloading
        e.preventDefault();
        let itemImage = $('#additemModal').find('#itemImage').val();
        let itemName = $('#additemModal').find('#itemName').val();
        let itemPrice = $('#additemModal').find('#itemPrice').val();
        let foodCategory = $('#additemModal').find('#foodCategory').val();
        let foodType = $('#additemModal').find('#foodType').val();
        let itemDescription = $('#additemModal').find('#itemDescription').val();
        let submit_name = $('#additemModal').find('#addItem').attr('name');
        if (itemImage == '') {
            itemImage = 'images/demo.jpg';
        }


        if (foodCategory != '' && foodType != '' && itemDescription != '' && itemName != '' && itemPrice != '') {
            $.ajax({
                url: "app/controllers/Fooditems.php",
                type: "POST",
                data: {
                    restaurantID: restaurantID,
                    itemImage: itemImage,
                    itemName: itemName,
                    itemPrice: itemPrice,
                    foodCategory: foodCategory,
                    foodType: foodType,
                    itemDescription: itemDescription,
                    submit_name: submit_name
                },
                cache: false,
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    console.log(dataResult);
                    if (dataResult.status == 201) {
                        $('#additemModal').find('#itemImage').val('');
                        // $('#additemModal').find('#food_type').val('');
                        $('#additemModal').find('#itemName').val('');
                        $('#additemModal').find('#itemPrice').val('');
                        $('#additemModal').find('#itemDescription').val('');
                        // $('#additemModal').find('#foodCategory').val('');
                        $('#additemModal').find(".alert-success").css('display', 'block');
                        $('#additemModal').find(".alert-danger").css('display', 'none');
                    } else {
                        $('#additemModal').find(".alert-danger").css('display', 'block');
                        $('#additemModal').find(".alert-danger").html(dataResult.status_message);
                        $('#additemModal').find(".alert-success").css('display', 'none');
                    }

                }
            });
        } else {
            $('#additemModal').find(".alert-danger").css('display', 'block');
            $('#additemModal').find(".alert-danger").html("Please fill all fields (Image is optional)");
            $('#additemModal').find(".alert-success").css('display', 'none');
        }



    });
});