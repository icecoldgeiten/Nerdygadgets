<?php
include __DIR__."/connect.php";

Function GetCart(){
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
    safecart($stockitemid, getcart());
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

function AddMore($cart){
    $id = $_POST["more"];
    if (array_key_exists($id, $cart)){
        $cart[$id] += 1;
    }
    $_SESSION["cart"] = $cart;
}

function Remove($cart){
    $id = $_POST["less"];
    if (array_key_exists($id, $cart)){
        $cart[$id] -= 1;
    }
    if ($cart[$id] >= 0) {
        $_SESSION["cart"] = $cart;
    } else {
        $cart[$id] = null;
        $_SESSION["cart"] = $cart;
    }
}

function Delete($cart){
    $id = $_POST["delete"];
    if (array_key_exists($id,$cart)){
        $cart[$id] = null;
        $_SESSION["cart"] = $cart;
    }
}

function DeleteEntire($cart)
{
    foreach ($cart as $id => $aantal) {
        if (array_key_exists($id, $cart)) {
            $cart[$id] = null;
            $_SESSION["cart"] = $cart;
        }
    }
}
?>