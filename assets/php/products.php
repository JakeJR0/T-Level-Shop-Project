<?php
session_start();

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = array();
}

function add_product($product_id, $quantity) {
    global $cart;
    if (isset($cart[$product_id])) {
        $cart[$product_id] += $quantity;
    } else {
        $cart[$product_id] = $quantity;
    }

    $_SESSION['cart'] = $cart;
}

function remove_product($product_id) {
    global $cart;
    if (isset($cart[$product_id])) {
        unset($cart[$product_id]);
    }

    $_SESSION['cart'] = $cart;
}

function empty_cart() {
    global $cart;
    $cart = array();
    $_SESSION['cart'] = $cart;
}

function set_quantity($product_id, $quantity) {
    global $cart;
    if (isset($cart[$product_id])) {
        $cart[$product_id] = $quantity;
    }

    $_SESSION['cart'] = $cart;
}

function get_cart() {
    global $cart;
    $cart_data = array();
    $cart_total = 0;
    
    foreach ($cart as $product_id => $quantity) {
        $product = get_product($product_id);
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

        $cart_total += $product_price * $product_quantity;

        array_push($cart_data, $product_data);
    }

    # Removes 20% VAT from total
    
    $cart_subtotal = number_format($cart_total * 0.8, 2);
    $cart_total = number_format($cart_total, 2);

    $cart_info = array(
        "cart_total" => $cart_total,
        "cart_subtotal" => $cart_subtotal,
        "cart_data" => $cart_data
    );
    

    return $cart_info;
}

?>