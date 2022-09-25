<?php
# Connects to the database
$con = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
# Checks if the connection is valid
if (mysqli_connect_errno()) {
    # Returns an error
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

# Gets a count of unique products in database
function get_product_count() {
    global $con;
    $sql = "
    SELECT
        COUNT(DISTINCT name)
    FROM
        products
    ";
    # Runs the query
    $result = mysqli_query($con, $sql);
    # Gets the result
    $row = mysqli_fetch_array($result);
    # Returns the result
    return $row[0];
}

# Gets all products from the database
function get_products() {
    global $con;
    $sql = "SELECT * FROM products";
    # Runs the query
    $result = mysqli_query($con, $sql);
    # Creates an array to store the products
    $products = array();
    # Loops through the results
    while ($row = mysqli_fetch_assoc($result)) {
        # Adds the product to the array
        $products[] = array(
            "ID" => $row['ID'],
            "name" => $row['name'],
            "description" => $row['description'],
            "price" => $row['price'],
            "image" => $row['image']
        );
    }

    # Returns the products
    return $products;
}

# Checks if a product exists in the database
function valid_product($product_id) {
    global $con;
    $sql = "SELECT * FROM products WHERE ID = $product_id";
    # Runs the query
    $result = mysqli_query($con, $sql);
    # Checks if the product exists
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        # Returns true
        return true;
    } else {
        # Returns false
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