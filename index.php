<?php
include 'assets/php/site_info.php';
include 'assets/php/header.php';

$product_count = get_product_count();
?>

<!DOCTYPE html>
<html lang="en">
    <body>
        <div class="text-center" style="margin-top: 20px;">
            <h1 class="display-4"><?php echo SITE_NAME; ?></h1>
            <lead><?php echo SITE_DESCRIPTION; ?></lead>
        </div>

        <div class="container" style="margin-top: 160px; margin-bottom:300px;">
            <div class="col-md-12">
                <div class="row">
                    <div class="card">
                        <div class="card-title text-center">
                            <h2>Information</h2>
                        </div>
                        <div class="card-text text-center">
                            Welcome to the <?php echo SITE_NAME; ?>, this is a website that is used to sell T-Level products. Currently we have <?php echo $product_count; ?> products available for sale which help students with their T-Level course.
                            Each product has been hand selected to help enhance the learning experience of students and help them achieve their goals.

                             
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'assets/php/footer.php'; ?>
    </body>
</html>