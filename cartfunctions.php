<?php
function viewcart($cart){
    foreach($cart as $aantal => $item){;
        $prijs = $prijs *$aantal;
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
?>