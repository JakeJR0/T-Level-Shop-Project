<?php
$con = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

function get_product_count() {
    global $con;
    $sql = "
    SELECT
        COUNT(DISTINCT name)
    FROM
        products
    ";

    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    return $row[0];
}

function get_products() {
    global $con;
    $sql = "SELECT * FROM products";
    $result = mysqli_query($con, $sql);
    $products = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = array(
            "ID" => $row['ID'],
            "name" => $row['name'],
            "description" => $row['description'],
            "price" => $row['price'],
            "image" => $row['image']
        );
    }

    return $products;
}

function valid_product($product_id) {
    global $con;
    $sql = "SELECT * FROM products WHERE ID = $product_id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        return true;
    } else {
        return false;
    }
}

function get_product($product_id) {
    global $con;
    $sql = "
        SELECT 
            *
        FROM
            products
        WHERE
            ID = $product_id
    ";

    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row;
}

function insert_product($product_name, $product_description, $product_price, $product_image) {
    global $con;
    $path = 'assets/images/products/';
    $file_path = $path . $product_image;
    $sql = "
    INSERT INTO
        products (name, description, price, image) 
    VALUES ('".$product_name."', '".$product_description."', '".$product_price."', '".$file_path."')";
    if (mysqli_query($con, $sql)) {
        # Created Record
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}

?>