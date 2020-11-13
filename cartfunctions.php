<?php
include __DIR__."/connect.php";

Function GetCart($stockItemID){
    if (isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];
    } else {
        $cart = array();
    }
    return $cart;
}
function safecart($stockitemid, $cart)
{
    if (array_key_exists($stockitemid, $cart)) {
        $cart[$stockitemid] += 1;
    } else {
        $cart[$stockitemid] = 1;

    }
    $_SESSION["cart"] = $cart;

}

function addtocart($stockitemid){
    safecart($stockitemid, getcart($stockitemid));
}

function GetProducts($cart)
{
    $products = [];

    foreach ($cart as $itemID => $aantal) {
        $product = GetProduct($itemID);
        array_push($products, $product);
    }

    return $products;
}

function GetAmmount($cart){
    foreach ($cart as $aantal){
        return $aantal;
//        var_dump($aantal);
    }
}
function GetProduct($id)
{
    $Connection = mysqli_connect("localhost", "root", "", "nerdygadgets");
    $Query = " SELECT  cast((RecommendedRetailPrice*(1+(TaxRate/100)))as decimal(10,5)) AS SellPrice, stockitemname, stockitemid 
                FROM StockItems
                where StockItemID =?";
    $statement = mysqli_prepare($Connection, $Query);
    mysqli_stmt_bind_param($statement, 'i', $id);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    return mysqli_fetch_assoc($result);

}

?>