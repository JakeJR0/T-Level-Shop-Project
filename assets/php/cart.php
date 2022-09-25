<?php
# Gets the site information
include 'site_info.php';

# Gets a variable from the 
# $_GET variable
function get_parameter($name) {
    # Checks if the parameter exists
    if (isset($_GET[$name])) {
        # Returns the parameter
        $name = $_GET[$name];
    } else {
        # Returns an empty string
        $name = "";
    }

    # Returns the parameter
    return $name;
}

# Gets the product id
$product_id = get_parameter("product_id");
# Gets the get request type (add, remove, or set_quantity)
$type = get_parameter("type");
# Gets the quantity
$quantity = get_parameter("product_quantity");

# Adds and item to the cart
function addToCart($product_id, $quantity) {
    # Checks if the parameter are valid
    if ($product_id != "" && $quantity != "") {
        # Checks that the product exists
        if (valid_product($product_id)) {
            # Converts to int
            $quantity = (int)$quantity;
            # Checks if the quantity is valid
            if ($quantity > 0 && $quantity < 999) {
                # Adds the item to the cart
                add_product($product_id, $quantity);
            } else {
                http_response_code(404);
            }
        } else {
            http_response_code(404);
        }
    } else {
        http_response_code(404);
    }
}

# Checks if the type is add
if ($type == "add") {
    # Adds the item to the cart
    addToCart($product_id, $quantity);
    # Checks if the type is remove
} elseif($type == "remove") {
    # removes the item from the cart
    remove_product($product_id);
    # Checks if the type is set_quantity
} else if ($type == "set_quantity") {
    # Sets the quantity of the item
    set_quantity($product_id, $quantity);
} else {
    http_response_code(404);
}

?>
