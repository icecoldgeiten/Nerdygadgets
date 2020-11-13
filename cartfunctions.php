<?php

function viewcart($cart){
    foreach($cart as $aantal => $item){;

        $prijs = $aantal;
        print("<tr>");
        print("<td>" .$item."</td>");
        print("<td>" .$aantal."</td>");
        print("<td>" .$prijs."</td>");
        print ("</tr>");
    }


}

function totaalprijs($cart){
    foreach ($cart as $aantal => $item){
        $prijs = $prijs *$aantal;


    }

}
function AddProductToCart($ID){
    if (isset($_POST["submit"])) {
        $stockItemID = $_POST["stockItemID"];
        if (isset($_SESSION['cart'])) {  // controleren of winkelmandje al bestaat
            $cart = $_SESSION['cart']; // zo ja: ophalen
        } else {
            $cart = array(); //zo nee: aanmaken
        }
        if (array_key_exists($stockItemID, $cart)) {  //controleren of $stockItemID(=key!) al in array staat
            $cart[$stockItemID] += 1; // zo ja -> aantal met 1 verhogen
        } else {
            $cart[$stockItemID] = 1; // zo nee -> nieuwe key toevoegen
        }
        $_SESSION["cart"] = $cart; //winkelmandje opslaan in sessie variabele
        print(" <p class='KauloZooi'>  Product toegevoegd aan <a href='cart.php'> winkelmandje! </a> </p>");
    }
}

function DeleteCart($ID){
    if (isset($_POST["remove"])) {
        $stockItemID = $_POST["stockItemID"];
        if (isset($_SESSION['cart'])) {  // controleren of winkelmandje al bestaat
            $cart = $_SESSION['cart']; // zo ja: ophalen
        } else {
            $cart = array(); //zo nee: aanmaken
        }
        print(" <p class='KauloZooi'>  Winkelmand geleegd! </a> </p>");
    }
}
function RaiseProduct($ID){
    if (isset($_POST["meer"])) {
        $stockItemID = $_POST["stockItemID"];
        if (isset($_SESSION['cart'])) {  // controleren of winkelmandje al bestaat
            $cart = $_SESSION['cart']; // zo ja: ophalen
        } else {
            $cart = array(); //zo nee: aanmaken
        }
        if (array_key_exists($stockItemID, $cart)) {  //controleren of $stockItemID(=key!) al in array staat
            $cart[$stockItemID] += 1; // zo ja -> aantal met 1 verhogen
        } else {
            $cart[$stockItemID] = 1; // zo nee -> nieuwe key toevoegen
        }
        $_SESSION["cart"] = $cart; //winkelmandje opslaan in sessie variabele

    }
}
function LowerProduct($ID){
    if (isset($_POST["minder"])) {
        $stockItemID = $_POST["stockItemID"];
        if (isset($_SESSION['cart'])) {  // controleren of winkelmandje al bestaat
            $cart = $_SESSION['cart']; // zo ja: ophalen
        } else {
            $cart = array(); //zo nee: aanmaken
        }
        if (array_key_exists($stockItemID, $cart)) {  //controleren of $stockItemID(=key!) al in array staat
            $cart[$stockItemID] -= 1; // zo ja -> aantal met 1 verlagen
            $_SESSION["cart"] = $cart; //winkelmandje opslaan in sessie variabele

        }
    }
}

?>