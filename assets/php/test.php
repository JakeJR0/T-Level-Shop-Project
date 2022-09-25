<!DOCTYPE html>
<html>
<head>
    <title>Test</title>
    
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Navbar-Right-Links-Dark-icons.css">
</head>
</html>

<?php
$imgs[] = array(
    array(
        "name" => "T Level Hoodie", 
        "src" => "t_level_hoody.jpg",
        "image_data" => base64_decode(file_get_contents("t_level_hoody.jpg"))
    ),
    array(
        "name" => "T Level Polo",
        "src" => "t_level_polo.jpg",
        "image_data" => base64_decode(file_get_contents("t_level_polo.jpg"))
    ),
    array(
        "name" => "DPDD Textbook",
        "src" => "DPDD_textbook.jpg",
        "image_data" => base64_decode(file_get_contents("DPDD_textbook.jpg"))
    ),
    array(
        "name" => "DBS Textbook",
        "src" => "DBS_textbook.jpg",
        "image_data" => base64_encode(file_get_contents("DBS_textbook.jpg"))
    ),
);

echo '<table style="margin: auto; margin-top:5%; width: 20%;" class="table"><thead><tr><th>Name</th><th>Image</th><th>Link</th></tr>';
echo '</thead><tbody>';
foreach($imgs as $img) {
    
    foreach($img as $i) {
        echo '<tr><td><img width=20 src="' . $i['src'] . '" alt="' . $i['name'] . '"></td><td>' . $i['name'] . '</td>';
    }
}
echo '</tbody></table>';

?>