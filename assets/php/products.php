<?php
# Starts the session
session_start();

# Checks if the session has cart already set
if (isset($_SESSION['cart'])) {
    # Sert the cart variable
    $cart = $_SESSION['cart'];
} else {
    # Sets the cart variable to an empty array
    $cart = array();
}

# Adds a product to the cart
function add_product($product_id, $quantity) {
    global $cart;
    # Checks if the product is already in the cart
    if (isset($cart[$product_id])) {
        # Adds the quantity to the existing product
        $cart[$product_id] += $quantity;
    } else {
        # Adds the product to the cart
        $cart[$product_id] = $quantity;
    }

    # Updates the cart
    $_SESSION['cart'] = $cart;
}

# Removes a product from the cart
function remove_product($product_id) {
    global $cart;
    # Checks if the product is in the cart
    if (isset($cart[$product_id])) {
        # Removes the product from the cart
        unset($cart[$product_id]);
    }

    # Updates the cart
    $_SESSION['cart'] = $cart;
}

# Removes all products from the cart
function empty_cart() {
    global $cart;
    # Sets the cart to an empty array
    $cart = array();
    # Updates the cart
    $_SESSION['cart'] = $cart;
}

# Sets the quantity of a product
function set_quantity($product_id, $quantity) {
    global $cart;
    # Checks if the product is in the cart
    if (isset($cart[$product_id])) {
        # Sets the quantity of the product
        $cart[$product_id] = $quantity;
    } else {
        if (valid_product($product_id)) {
            # Adds the product to the cart
            add_product($product_id, $quantity);
        }
    }

    # Updates the cart
    $_SESSION['cart'] = $cart;
}

# Gets the entire cart in an array
function get_cart() {
    global $cart;
    # Creates an empty array
    $cart_data = array();
    # Sets cart total to 0
    $cart_total = 0;
    
    # Loops through the cart
    foreach ($cart as $product_id => $quantity) {
        # Gets the product data
        $product = get_product($product_id);
        # Inserts the product data into the array
        $product_data = array(
            "ID" => $product_id,
            "name" => $product['name'],
            "description" => $product['description'],
            "price" => $product['price'],
            "image" => $product['image'],
            "quantity" => $quantity
        );

        # Converts Price and Quantity to Correct Type
        
        $product_price = (float)$product['price'];
        $product_quantity = (int)$quantity;

        # Calculates the total price of the product
        $cart_total += $product_price * $product_quantity;

        # Adds the product data to the array
        array_push($cart_data, $product_data);
    }

    # Removes 20% VAT from total
    
    $cart_subtotal = number_format($cart_total * 0.8, 2);
    $cart_total = number_format($cart_total, 2);

    # Creates the data array
    $cart_info = array(
        "cart_total" => $cart_total,
        "cart_subtotal" => $cart_subtotal,
        "cart_data" => $cart_data
    );
    
    # Returns the data array
    return $cart_info;
}

?>