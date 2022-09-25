<?php
include 'site_info.php';

function get_parameter($name) {
    if (isset($_GET[$name])) {
        $name = $_GET[$name];
    } else {
        $name = "";
    }
    return $name;
}

$product_id = get_parameter("product_id");
$type = get_parameter("type");
$quantity = get_parameter("product_quantity");

function addToCart($product_id, $quantity) {
    if ($product_id != "" && $quantity != "") {
        if (valid_product($product_id)) {
            # Converts to int
            $quantity = (int)$quantity;
            if ($quantity > 0 && $quantity < 999) {
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

if ($type == "add") {
    addToCart($product_id, $quantity);
} elseif($type == "remove") {
    remove_product($product_id);
} else if ($type == "set_quantity") {
    set_quantity($product_id, $quantity);
} else {
    http_response_code(404);
}

?>

<!DOCTYPE html>
<html lang="en">

</html>