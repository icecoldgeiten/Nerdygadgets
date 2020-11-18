<?php
function GetCart(){
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
{    include "connect.php";
    $Query = " SELECT  cast((RecommendedRetailPrice*(1+(TaxRate/100)))as decimal(10,5)) AS SellPrice, stockitemname, stockitemid 
                FROM StockItems
                where StockItemID =?";
    $statement = mysqli_prepare($Connection, $Query);
    mysqli_stmt_bind_param($statement, 'i', $id);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    return mysqli_fetch_assoc($result);
}

function AddOne($cart){
    $id = $_POST["addOne"];
    if (array_key_exists($id, $cart)){
        $cart[$id] += 1;
        print(" <p  class='AddCartMessage' >  +1 item </a> </p>");
    }
    $_SESSION["cart"] = $cart;
}

function RemoveOne($cart){
    $id = $_POST["removeOne"];
    if (array_key_exists($id, $cart)){
        $cart[$id] -= 1;
        print(" <p  class='AddCartMessage' >  -1 item </a> </p>");
    }
    if ($cart[$id] >= 0) {
        $_SESSION["cart"] = $cart;
    } else {
        $cart[$id] = null;
        $_SESSION["cart"] = $cart;
    }
}

function DeleteRow($cart){
    $id = $_POST["deleteRow"];
    if (array_key_exists($id,$cart)){
        $cart[$id] = null;
        $_SESSION["cart"] = $cart;
        print(" <p  class='AddCartMessage' >  Item verwijderd </a> </p>");
    }
}

function DeleteCart()
{
    unset($_SESSION['cart']);
}

function AddToCart(){
    if (isset($_POST["submit"])) {
        $cart = GetCart();
        $stockItemID = $_POST["stockItemID"];
        if (array_key_exists($stockItemID, $cart)) {
            $cart[$stockItemID] += 1;
        } else {
            $cart[$stockItemID] = 1;
        }
        $_SESSION["cart"] = $cart;

        header("Location: payment.php");
    }
}
?>