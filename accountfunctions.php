<?php
function CheckUser($username, $password){
    include "connect.php";
    $username2 = trim($username);
    $password2 = trim($password);
    $query =" select username, password from customer_nl
              where username = ?";
    $stmt = mysqli_prepare($Connection, $query);
    mysqli_stmt_bind_param($stmt, 's', $username2);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    foreach($result as $key => $value) {
        $hash = $value["password"];
        if ($username2 === $value["username"] && password_verify($password2, $hash)) {
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

function InsertUser($credentials){
    include "connect.php";
    $pwd = $credentials["Password"];
    $username = trim($credentials["Username"]);
    $algo = PASSWORD_ARGON2I;
    $password = password_hash($pwd, $algo);
    If (!empty($credentials)){
        $querry = "insert into customer_nl (EmailAddress, Username, Password, Name, Address, Address2, PostalCode, City, PhoneNumber)
               values(?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($Connection, $querry);
        mysqli_stmt_bind_param($stmt, 'ssssssssi', $credentials['EmailAddress'], $username, $password, $credentials['Name'], $credentials['Address'], $credentials['Address2'], $credentials['PostalCode'], $credentials['City'], $credentials['PhoneNumber']);
        mysqli_stmt_execute($stmt);
    }
    if (mysqli_affected_rows($Connection) >=1 ){
        return true;
    } else {
        return false;
    }
}

function GetInformation(){
    $customerID = mysqli_insert_id($Connection);
    $information = [];
    $query =" select Username, Password, Name, Address, Address2. PostalCode, City, PhoneNumber, EmailAddress from customer_nl
              where customerId = >";
    $stmt = mysqli_prepare($Connection, $query);
    mysqli_stmt_bind_param($stmt, 'i', $customerID);
    mysqli_stmt_execute($stmr);
    $result = mysqli_stmt_get_result($stmt);

    foreach ($result as $key => $value) {
        array_push($information, $value);
    }
    return$information;
}

function CheckUsername($username){
    include "connect.php";
    $query =" select username from customer_nl
              where username = ?";
    $stmt = mysqli_prepare($Connection, $query);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    foreach ($result as $key => $value){
        if ($value["username"] === $username){
            return true;
        } else{
            return false;
        }
    }
}


?>