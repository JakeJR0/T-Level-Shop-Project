<?php

define("PAGE_NAME", "Products");
include 'assets/php/site_info.php';
include 'assets/php/header.php';


?>
<!DOCTYPE html>
<html lang="en">
<body>
    <?php 
    $cart_info = get_cart();
    $cart_total = $cart_info['cart_total'];
    $cart_subtotal = $cart_info['cart_subtotal'];
    $cart_data = $cart_info['cart_data'];
    ?>

    <h1 style="text-align: center;margin-top: 40px;margin-bottom: 40px;">Cart Information</h1>
    <script type="text/javascript">
        let total_price = "<?php echo $cart_total; ?>";
        
    </script>
    <?php
    
        if (isset($_POST["total"])) {
            $total = $_POST["total"];
            empty_cart();

    ?>
        
        <div id="" class="alert alert-success text-center" style="margin-bottom: 75%;">
            <strong>Success!</strong> Your order has been placed.<br><br>With a total of <span id="total_cost"></span>
            <script>
                function update_alert() {
                    // Converts the total price to a float
                    float_total_price = parseFloat(total_price);
                    document.getElementById("total_cost").innerHTML = "£" + float_total_price.toFixed(2);
                }

                update_alert();
            </script>
            <meta http-equiv="refresh" content="5;url=index.php" />
        </div>
        <?php
        } else {
    ?>

    <div class="card-deck" style="width: 90%;margin: auto; gap:3em;">
        <!-- PHP CODE HERE -->
        <?php
            

            foreach($cart_data as $product) {    
            ?>
            <div class="card" style="width: 100%;">
                <img class="card-img-top d-block" style="width: 12em; margin: auto;" alt="Product: <?php echo $product['name']; ?> Thumbnail" src="<?php echo $product["image"] ?>">
                <div class="card-body">
                    <h4 class="card-title text-center"><?php echo $product["name"] ?></h4>
                    <?php 
                        $formatted_price = "£".number_format($product['price'] * $product['quantity'], 2);
                    ?>
                    <div class="text-center" style="margin-bottom: 25px;">
                    <p class="card-text" style="margin-bottom: 40px;"><?php echo $product["description"] ?></p>
                    <label class="form-label">Quantity:&nbsp;</label>
                    <input required onfocusout="change_<?php echo $product['ID'] ?>_Quantity()" id="quantity_<?php echo $product['ID']; ?>" class="form-control-sm" type="number" value="<?php echo $product["quantity"] ?>" style="text-align: center; width: 20%; margin: auto; margin-bottom: 10px;" required="" min="1" max="999" step="1">
                    <p><?php echo "Price Each: £".number_format($product["price"], 2); ?></p>
                    <p class="price" id="product_<?php echo $product['ID'] ?>">Total Price: <?php echo $formatted_price ?></p>
                    </div>
                    
                    <button class="btn btn-danger" type="button" style="width: 100%;" onclick="product_<?php echo $product['ID']; ?>_button_handler()">Remove</button>
                    <script>
                        function product_<?php echo $product['ID']; ?>_button_handler() {
                            var product_id = <?php echo $product['ID']; ?>;
                            RemoveProduct(product_id);
                            window.location.reload();
                        }

                        function change_<?php echo $product['ID'] ?>_Quantity() {
                            var product_id = <?php echo $product['ID']; ?>;
                            var quantity = document.getElementById("quantity_" + product_id).value;
                            var price = <?php echo $product['price']; ?>;
                            console.log(quantity);
                            if (quantity == null || quantity == "") {
                                quantity = 1;
                                document.getElementById("quantity_" + product_id).value = 1;
                            }

                            var total = quantity * price;
                            var formatted_total = "£" + total.toFixed(2);

                            document.getElementById("product_" + product_id).innerHTML = "Total Price: " + formatted_total;
                            set_quantity(product_id, quantity);
                        }

                    </script>
                </div>
            </div>
            <?php
            }
        ?>

    </div>
    <script>
        function set_quantity(product_id, quantity) {
            var xml = new XMLHttpRequest();
           
            xml.open("GET", "assets/php/cart.php?type=set_quantity&product_id=" + product_id + "&product_quantity=" + quantity);
            xml.send();

            xml.onload = function() {
                if (xml.status == 200) {
                    console.log("Quantity set");
                    update_totals();
                } else {
                    console.log("Error setting quantity");
                    window.location.reload();
                }
            }
        }

        function update_totals() {
            var products = document.getElementsByClassName("price");
            var total = 0;

            for (var i = 0; i < products.length; i++) {
                var price = products[i].innerHTML;
                price = price.replace("Total Price: £", "");
                total += parseInt(price);
            }

            var vat = total * 0.2;
            var subtotal = total - vat;

            vat = vat.toFixed(2);
            subtotal = subtotal.toFixed(2);
            total = total.toFixed(2);

            document.getElementById("total").innerHTML = "£" + total;
            document.getElementById("vat").innerHTML = "£" + vat;
            document.getElementById("subtotal").innerHTML = "£" + subtotal;
            total_price = "£" + total;
        }
    </script>
    <div class="container" style="margin: auto;margin-top: 40px; margin-bottom: 50px;">
        <div class="table-responsive" style="width: 40%;margin: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Subtotal</td>
                        <td id="subtotal"><?php echo "£".$cart_subtotal ?></td>
                    </tr>
                    <tr>
                        <td>VAT</td>
                        <?php 
                        $cart_total = str_replace("£", "", $cart_total);
                        $cart_total = str_replace(",", "", $cart_total);

                        $vat = (float)$cart_total * 0.2;
                        $calculated_vat = number_format($vat, 2); 
                        ?>
                        <td id="vat"><?php echo "£". $calculated_vat ?></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td id="total"><?php echo "£".$cart_total ?></td>
                    </tr>
                </tbody>
            </table>
            <div style="display:flex; justify-content: center; margin-top: 20%; margin-bottom: 170px;">
                <form action="" method="POST" onsubmit="Validate_Checkout()" id="checkout-form">
                <?php
                    
                    if ($cart_total > 0) {
                ?>
                    <input type="hidden" id="checkout_total" name="total" value="<?php echo "£".$cart_total ?>">
                    <button class="btn btn-success" type="submit" style="width: 100%; margin: auto;">Checkout</button>
                <?php
                    } else {

                    
                ?>
                    <span class="btn btn-secondary" checked style="width: 100%; margin: auto;">Checkout</span>    
                <?php 
                    }
                ?>
                </form>
            </div>
            
        </div>
        
    </div>
    <?php
        }
    ?>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <?php include 'assets/php/footer.php'; ?>
    
</body>

</html>