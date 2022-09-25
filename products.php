<?php 
include 'assets/php/site_info.php';

$products[] = get_products();

?>
<!DOCTYPE html>
<html lang="en">
<body>
    <script src="assets/js/products.js"></script>
    <?php 
    define("PAGE_NAME", "Products");
    include 'assets/php/header.php';
    ?>
    <head>
        <link rel="stylesheet" href="assets/css/product_style.css">
    </head>
    <div class="container-fluid" style="margin-bottom: 50px;">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center text-white" style="margin-top: 40px;margin-bottom: 40px;">Products</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-group">
                    <?php 
                    foreach ($products as $productArray) {
                        foreach($productArray as $product) {
                            $formatted_price = "£".number_format($product['price'], 2);
                            $product_name = "product_".$product['ID'];
                            echo '
                            
                            <div id='.$product_name.' class="card">
                                <img class="card-img-top w-50 d-block" style="margin:auto;" alt="Product: '.$product["name"].' Thumbnail" src="'.$product['image'].'">
                                <div class="card-body">
                                    <script>
                                        function Add_'.$product_name.'() {
                                            quanity = document.getElementById("'.$product["ID"].'_quantity").value;
                                            quanity = parseInt(quanity);
                                            if (quanity === 0) {
                                                return;
                                            }
                                            
                                            SubmitCartChange('.$product["ID"].', quanity, "'.$product['name'].'");
                                        }
                                    </script>
                                    <h4 class="card-title" style="text-align: center;">'.$product['name'].'</h4>
                                    <p class="card-text">'.$product['description'].'</p>
                                    <p class="card-text">'.$formatted_price.'</p>
                                    
                                    <inpit type="hidden" name="product_id" type="number" value="'.$product['ID'].'">
                                    <label class="form-label" style="text-align: center" for="quantity">Quantity</label>
                                    <input class="form-control-lg quantity" id="'.$product['ID'].'_quantity" name="quantity" type="number" step="1" min="1" max="999" value="1" style="width: 100%;text-align: center;margin-bottom: 21px;">
                                    
                                    <button class="btn btn-success" type="button" style="width: 100%;" onclick="Add_'.$product_name.'()">Add to cart</button>
                                    
                                </div>
                            </div>';
                        }

                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <?php include 'assets/php/footer.php'; ?>
</body>

</html>