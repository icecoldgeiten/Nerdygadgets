<?php
function CheckUser($email, $password){
    include "connect.php";
    $email2 = trim($email);
    $password2 = trim($password);
    $query =" select EmailAddress, password from customer_nl
              where EmailAddress = ?";
    $stmt = mysqli_prepare($Connection, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    foreach($result as $key => $value) {
        $hash = $value["password"];
        
        if ($email2 === $value["EmailAddress"] && password_verify($password2, $hash)) {
            header("location: account.php");
            return true;
        } else {
            return false;
        }
    }
}

function CheckPwd($password, $password2){
    $pwd =trim($password);
    $pwd2 = trim($password2);
    if (strlen($pwd) >= 8 || $pwd2 >= 8){
        if ($pwd === $pwd2){
            $return = True;
        } else {
            $return ="De wachtwoorden zijn niet gelijk";
        }
    } else {
        $return = "Het wachtwoord dat u heeft ingevuld heeft minder dan 8 karakters.";
    }if ($return){
        return $return;
    } else {
        print $return;
    }
}

function CheckFormatPwd($pass){
    $errors = array();
    if (!preg_match("/\d/", $pass)) {
        $errors[] = "Er moet een cijfer in het wachtwoord";
    }
    if (!preg_match("/[A-Z]/", $pass)) {
        $errors[] = "Er moet een hoofdletter in het wachtwoord";
    }
    if (!preg_match("/[a-z]/", $pass)) {
        $errors[] = "Er moet een kleine letter in het wachtwoord";
    }
    if (!preg_match("/\W/", $pass)) {
        $errors[] = "Er moet een speciaal karakter in het wachtwoord";
    }
    if (preg_match("/\s/", $pass)) {
        $errors[] = "Er mogen geen spaties in het wacthwoord";
    }

    if ($errors) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        die();
    } else {
        return true;
    }
}

function InsertUser($credentials){
    include "connect.php";
    $pwd = $credentials["Password"];
    $email = trim($credentials["EmailAddress"]);
    $algo = PASSWORD_ARGON2I;
    $password = password_hash($pwd, $algo);
    If (!empty($credentials)){
        $querry = "insert into customer_nl (EmailAddress, Password, Name, Address, Address2, PostalCode, City, PhoneNumber)
               values(?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($Connection, $querry);
        mysqli_stmt_bind_param($stmt, 'sssssssi', $email, $password, $credentials['Name'], $credentials['Address'], $credentials['Address2'], $credentials['PostalCode'], $credentials['City'], $credentials['PhoneNumber']);
        mysqli_stmt_execute($stmt);
    }
    if (mysqli_affected_rows($Connection) >=1 ){
        return true;
    } else {
        return false;
    }
}

function GetInformation($email){
    include "connect.php";
    $information = [];
    $query =" select Name, Address, Address2, PostalCode, City, PhoneNumber, EmailAddress, CustomerID from customer_nl
              where EmailAddress = ?";
    $stmt = mysqli_prepare($Connection, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    foreach ($result as $key => $value) {
        array_push($information, $value);
    }
    return $information;
}

function CheckUsername($email){
    include "connect.php";
    $query =" select EmailAddress from customer_nl
              where Emailaddress= ?";
    $stmt = mysqli_prepare($Connection, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    foreach ($result as $key => $value){
        if ($value["EmailAddress"] === $email){
            return true;
        } else{
            return false;
        }
    }
}

function UpdateUser($credentials, $ID)
{
    include "connect.php";
    if (!empty($credentials)) {
        $querry = "update customer_nl set EmailAddress = ?, Name=?, Address=?, Address2=?, PostalCode=?, City=?, PhoneNumber=?
               where customerID=?";
        $stmt = mysqli_prepare($Connection, $querry);
        mysqli_stmt_bind_param($stmt, 'ssssssis', $credentials['EmailAddress'], $credentials['Name'], $credentials['Address'], $credentials['Address2'], $credentials['PostalCode'], $credentials['City'], $credentials['PhoneNumber'], $ID);
        mysqli_stmt_execute($stmt);
    }
    IF (MYSQLI_AFFECTED_ROWS($Connection)>=1){
        print "uw gegevens zijn geüpdated";
        $_SESSION["inlog"] = false;
        header("location: login.php");
    }
}

function UpdateUserPWD($credentials, $ID)
{
    include "connect.php";
    $pwd = trim($credentials["Password"]);
    $algo = PASSWORD_ARGON2I;
    $password = password_hash($pwd, $algo);
    if (!empty($credentials)) {
        $querry = "update customer_nl set Password=?
               where customerID=?";
        $stmt = mysqli_prepare($Connection, $querry);
        mysqli_stmt_bind_param($stmt, 'si', $password, $ID);
        mysqli_stmt_execute($stmt);
    }
    IF (MYSQLI_AFFECTED_ROWS($Connection)>=1){
        print "uw gegevens zijn geüpdated";
        $_SESSION["inlog"] = false;
        header("location: login.php");
    }
}

function GetCustomerID($email){
    include "connect.php";
    $query =" select CustomerID from customer_nl
              where EmailAddress = ?";
    $stmt = mysqli_prepare($Connection, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    foreach ($result as $key => $value){
        $CustomerID = $value['CustomerID'];
    }
    return $CustomerID;
}

?>
