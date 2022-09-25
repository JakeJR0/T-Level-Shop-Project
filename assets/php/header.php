<?php
if (defined("PAGE_NAME") == false) {
    define("PAGE_NAME", "");
}

$site_route = $_SERVER["REQUEST_URI"];
$site_route = explode("/", $site_route);
$site_host = $_SERVER["HTTP_HOST"];

$site_url = "https://" . $site_host . "/" . $site_route[1] . "/".$site_route[2];

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
    <!-- Page Title -->
    <title><?php echo SITE_NAME . ' - ' . PAGE_NAME; ?></title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/dark-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <!-- Meta Tags used for twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content=<?php echo $site_url; ?>>
    <meta property="twitter:title" content="<?php echo SITE_NAME. '- '. PAGE_NAME;?>">
    <meta property="twitter:description" content="<?php echo SITE_DESCRIPTION;?>">
    <meta property="twitter:image" content="assets/images/logos/TLevel-Logo-Black.svg">
    <!-- Meta Tags used for Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo $site_url; ?>">
    <meta property="og:title" content="<?php echo SITE_NAME. ' - '. PAGE_NAME;?>">
    <meta property="og:description" content="<?php echo SITE_DESCRIPTION;?>">
    <meta property="og:image" content="assets/images/logos/TLevel-Logo-Black.svg">
    <!-- Meta Tag used for discord embed colour -->
    <meta property="theme-color" content="#765ab0">
</head>

<body>
    <!-- Script for cart -->

    <script src="assets/js/products.js"></script>
    
    <!-- Navigation Bar -->
    <nav class="navbar navbar-dark navbar-expand-md sticky-top bg-dark py-3">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
            <span class="bs-icon-sm bs-icon-rounded bg-white d-flex justify-content-center align-items-center me-2 bs-icon" style="padding-left: 60px; padding-right: 60px;">
            <!-- T-Level Logo -->
            <img src="assets/images/logos/TLevel-Logo-Black.svg" width=100 style="margin: auto;"></img>

            </span>
            <span><?php echo SITE_NAME; ?></span>
        </a>
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-5"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>

            <div class="collapse navbar-collapse" id="navcol-5">
                <ul class="navbar-nav ms-auto">
                    <?php
                    # Loops through the pages array
                    foreach ($pages as $page) {
                        $active = "";
                        # Checks if the page is the active page (the page the user is currently on)
                        if ($page["route"] == $active_page) {
                            $active = "active";
                        }
                        # Outputs the page into the navigation bar
                        echo '<li class="nav-item"><a class="nav-link ' . $active . '" href="' . $page["route"] . '">' . $page["name"] . '</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    
</body>
</html>