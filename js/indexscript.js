function fetchCategoriesData() {

    let html = "";
    $.ajax({

        url: 'app/controllers/Fooditems.php?required_data=categories_data',
        type: "GET",
        dataType: 'json',
        success: function(response) {
            console.log(response);
            response.data.map(function(value) {
                html = html + "<div class='col-md-4 category-card'><a href='menu.php?category=" + value.id + "'><div><div class='category-title'><h2>" + value.category_name + "</h2><p>Total</p></div><img src=" + value.category_image + " class='rounded' alt=''></div></a></div>";
            })
            $('#categoryCard').html(html);
        },
        error: function(xhr, textStatus, errorThrown) {
                console.log(errorThrown);

            } // error callback function block
    }); // ajax call ends


}

function fetchTopVegItems() {

    let html = "";
    $.ajax({

        url: 'app/controllers/Fooditems.php?required_data=top_veg_items',
        type: "GET",
        dataType: 'json',
        success: function(response) {
            console.log(response);
            response.data.map(function(value) {
                html = html + "<div class='col-md-3'><div class='card'><input type='hidden' id='fooditemID' value='" + value.id + "'>" +
                    "<img class='card-img-top' src='" + value.food_image + "' alt='Card image cap'/><div class='card-body'>" +
                    "<div class='item-title'><div style='width:90%'><h2>" + value.item_name + "</h2></div><div class='item-price'><p>" + value.price + "</p></div>" +
                    "</div><div class='item-description'><p>" + value.description + "</p></div></div>" +
                    "<div class='order-details'><div class='order-button'>" +
                    "<a href='menu.php?food_type=1'><button class='btn button' data-toggle='modal'>View veg items</button></div></div></div></div></a>";
            })
            $('#topvegItems').html(html);

        },
        error: function(xhr, textStatus, errorThrown) {
                console.log(errorThrown);

            } // error callback function block
    }); // ajax call ends


}

function fetchTopNonvegItems() {

    let html = "";
    $.ajax({

        url: 'app/controllers/Fooditems.php?required_data=top_nonveg_items',
        type: "GET",
        dataType: 'json',
        success: function(response) {
            console.log(response);
            response.data.map(function(value) {
                html = html + "<div class='col-md-3'><div class='card'><input type='hidden' id='fooditemID' value='" + value.id + "'>" +
                    "<img class='card-img-top' src='" + value.food_image + "' alt='Card image cap'/><div class='card-body'>" +
                    "<div class='item-title'><div style='width:90%'><h2>" + value.item_name + "</h2></div><div class='item-price'><p>" + value.price + "</p></div>" +
                    "</div><div class='item-description'><p>" + value.description + "</p></div></div>" +
                    "<div class='order-details'><div class='order-button'>" +
                    "<a href='menu.php?food_type=2'><button class='btn button' data-toggle='modal' id='orderButton' data-target='#orderModal'>View non-veg items</button></div></div></div></div></a>";
            })
            $('#topnonVegItems').html(html);

        },
        error: function(xhr, textStatus, errorThrown) {
                console.log(errorThrown);

            } // error callback function block
    }); // ajax call ends


}


$(document).ready(function() {


    fetchCategoriesData();
    fetchTopVegItems();
    fetchTopNonvegItems();

})