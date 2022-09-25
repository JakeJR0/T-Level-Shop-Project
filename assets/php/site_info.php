<?php
# Site Information
define('SITE_NAME', 'T-Level Shop');
define('SITE_DESCRIPTION', 'This is a shop where students can purchase merchandise and resources for their T-Level course.');

# Database Settings
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DATABASE", "t-level-shop");

include 'get_data.php';
include 'products.php';

# Creates table products if it doesn't exist

$sql = "
CREATE TABLE IF NOT EXISTS products(
    ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255) NOT NULL
);
";

# Runs the query
if (mysqli_query($con, $sql)) {
    # Checks if the table is empty
    $rows_in_table = mysqli_num_rows(mysqli_query($con, "SELECT * FROM products"));
    
    if ($rows_in_table == 0) {
        # Adds the default products to the database
        insert_product("T Level Hoodie", "The unisex hoody offers a stylish look, benefiting from a fleece lining for comfort with a hooded design for extra production and a drawstring pull for an adjustable fit.", 29.99, "t_level_hoody.jpg");
        insert_product('T Level Polo', 'Unisex Polo Shirt crafted with climalite technology that removes sweat away from the skin to keep you feeling dry with a lightweight and breathable design.', 19.99, 't_level_polo.jpg');
        insert_product('Digital Production Design and Development Textbook', 'Prepare for exams and the employer set project using practice questions and project practice exercises. Get ready for the workplace with industry tip and real-world examples.', 28.90, 'DPDD_textbook.JPG');
        insert_product('Digital Business Services Textbook', 'Apply knowledge and understanding across 100s of engaging activities and research tasks.', 28.90, 'DBS_textbook.JPG');
    }

} else {
    # Returns an error
    echo "Error creating table: " . mysqli_error($con);
}



?>