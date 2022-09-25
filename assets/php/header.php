<?php
if (defined("PAGE_NAME") == false) {
    define("PAGE_NAME", "");
}

$site_route = $_SERVER["REQUEST_URI"];
$site_route = explode("/", $site_route);
$active_page = $site_route[2];

$pages = array(
    array(
        "name" => "Home",
        "route" => "index.php"
    ),
    array(
        "name" => "Products",
        "route" => "products.php"
    ),
    array(
        "name" => "Checkout",
        "route" => "checkout.php"
    ),
);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>T-Level Shop - <?php echo PAGE_NAME ?></title>
    <meta name="description" content="This is a place where users can purchase products that could help them whilst on their journey on their T-Level course">
    <meta property="og:type" content="website">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/dark-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <script src="assets/js/products.js"></script>
    <nav class="navbar navbar-dark navbar-expand-md sticky-top bg-dark py-3">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
            <span class="bs-icon-sm bs-icon-rounded bg-white d-flex justify-content-center align-items-center me-2 bs-icon" style="padding-left: 60px; padding-right: 60px;">

            <img src="assets/images/logos/TLevel-Logo-Black.svg" width=100 style="margin: auto;"></img>

            </span>
            <span>T-Level Shop</span>
        </a>
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-5"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>

            <div class="collapse navbar-collapse" id="navcol-5">
                <ul class="navbar-nav ms-auto">
                    <?php
                    foreach ($pages as $page) {
                        $active = "";
                        if ($page["route"] == $active_page) {
                            $active = "active";
                        }
                        echo '<li class="nav-item"><a class="nav-link ' . $active . '" href="' . $page["route"] . '">' . $page["name"] . '</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    
</body>
</html>