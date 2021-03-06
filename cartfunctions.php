<?php
function GetCart()
{
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    } else {
        $cart = array();
    }
    return $cart;
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
    include "connect.php";
    $Query = " SELECT  cast((RecommendedRetailPrice*(1+(TaxRate/100)))as decimal(10,5)) AS SellPrice, stockitemname, stockitemid, ValidTo 
                FROM StockItems
                where StockItemID =?";
    $statement = mysqli_prepare($Connection, $Query);
    mysqli_stmt_bind_param($statement, 'i', $id);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    return mysqli_fetch_assoc($result);
}

function AddOne($cart)
{
    $id = $_POST["addOne"];
    if (array_key_exists($id, $cart)) {
        $cart[$id] += 1;
        print(" <p  class='AddCartMessage' >  +1 item </a> </p>");

    }
    header("Location: cart.php");
    $_SESSION["cart"] = $cart;
}

function RemoveOne($cart)
{
    $id = $_POST["removeOne"];
    if (array_key_exists($id, $cart) && $cart[$id] > 1) {
        $cart[$id] -= 1;
        print(" <p  class='AddCartMessage' >  -1 item </a> </p>");
        $_SESSION["cart"] = $cart;
    } else {
        unset($cart[$id]);
        $_SESSION["cart"] = $cart;
    }

    header("Location: cart.php");
}

function DeleteRow($cart)
{
    $id = $_POST["deleteRow"];
    if (array_key_exists($id, $cart)) {
        unset($cart[$id]);
        $_SESSION["cart"] = $cart;
        print(" <p  class='AddCartMessage' >  Item verwijderd </a> </p>");
    }
    header("Location: cart.php");
}

function DeleteCart()
{
    unset($_SESSION['cart']);
    header("Location: cart.php");
}

function AddToCart()
{
    if (isset($_POST["submit"])) {
        $cart = GetCart();
        $stockItemID = $_POST["stockItemID"];
        if (CheckStock($stockItemID, $cart[$stockItemID] + 1)) {
            if (array_key_exists($stockItemID, $cart)) {
                $cart[$stockItemID] += 1;
            } else {
                $cart[$stockItemID] = 1;
            }
            $_SESSION["cart"] = $cart;
        }
        header("Location: cart.php");    }
}

function GetCartPrice($cart) {
    $products = GetProducts($cart);
    $totalcart = 0;

    foreach ($products as $key => $slot) {
        $item = $slot["stockitemid"];
        $prijs = sprintf("%.2f", $slot["SellPrice"]);
        $totaalprijs = $prijs * $cart[$item];
        $totalcart = $totalcart + $totaalprijs;
    }

    return $totalcart;
}

function CheckStock($id, $amount) {
    include "connect.php";
    $Query = " 
           SELECT QuantityOnHand  
            FROM StockItemHoldings  
            WHERE stockitemid = ?";

    $statement = mysqli_prepare($Connection, $Query);
    mysqli_stmt_bind_param($statement, 'i', $id);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $value = mysqli_fetch_assoc($result);

    if ($amount > $value['QuantityOnHand']) {
        return false;
    }

    return true;
}

function MaxStockItem(){
    include "connect.php";
    $MaxQuery = "SELECT MAX(StockItemID) FROM stockitems";
    $max = mysqli_prepare($Connection, $MaxQuery);
    mysqli_stmt_execute($max);
    $Res = mysqli_stmt_get_result($max);
    $Res = mysqli_fetch_all($Res, MYSQLI_ASSOC);
    $MaxStockID = $Res[0]["MAX(StockItemID)"];
    return $MaxStockID;
}

function SendCost($totalprice){
    $sendcost = 6.95;
    if ($totalprice > 0) {
        if ($totalprice < 50) {
            $totalprice += $sendcost;
        } else {
            $totalprice = $totalprice;
        }
    }
  return $totalprice;
}

function SendDifference($totalprice){
    $difference = 0;
    if ($totalprice > 0 && $totalprice <= 50){
        $difference = 50-$totalprice;
        return $difference;
    }
    return false;
}
?>