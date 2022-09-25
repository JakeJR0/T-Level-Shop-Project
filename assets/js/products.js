function SubmitCartChange(product_id, product_quanity, product_name) {
    var xml = new XMLHttpRequest();
    xml.type = "POST";
    xml.open("GET", "assets/php/cart.php?product_id=" + product_id + "&product_quantity=" + product_quanity + "&type=add");
    xml.send();
    
    xml.onload = function() {
        if (xml.status == 200) {
            console.log("Cart Updated");
            alert(`You have added ${quanity} of the ${product_name} to your cart`);
        } else {
            console.log("Cart Update Failed");
            alert(`There was an error adding ${quanity} of the ${product_name} to your cart`);
        }
    }
    
}

function RemoveProduct(product_id) {
    var xml = new XMLHttpRequest();
    xml.type = "POST";
    xml.open("GET", "assets/php/cart.php?product_id=" + product_id + "&type=remove");
    xml.send();
    
    xml.onload = function() {
        if (xml.status == 200) {
            console.log("Cart Updated");
            alert(`You have removed the product from your cart`);
        } else {
            console.log("Cart Update Failed");
            alert(`There was an error removing the product from your cart`);
        }
    }
    
}