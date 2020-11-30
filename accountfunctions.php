<?php
function CheckUser($username, $password){
    include "connect.php";
    $password = $password['Password'];
    $password = hash('sha265', $password);

    $query =" select username, password from customer_nl
              where username = ?";
    $stmt = mysqli_prepare($Connection, $query);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmr);
    $result = mysqli_stmt_get_result($stmt);
    if (!empty($result["username"]) && $result["password"] === $password){
        return true;
    } else {
        return  false;
    }
}

function CheckPwd($password, $password2){
    if (strlen($password) >= 8 || $password2 >= 8){
        if ($password === $password2){
            return true;
        } else {
            $fail ="De wachtwoorden zijn niet gelijk";
        }
    } else {
        $fail = "Het wachtwoord dat u heeft ingevuld heeft minder dan 8 karakters."
    }
    return $fail;
}

function InsertUser($credentials){
    include "connect.php";
    $password = $credentials['Password'];
    $password = hash('sha265', $password);

    If (!empty($credentials)){
        $querry = "insert into customer_nl (EmailAddress, Username, Password, Name, Address, Address2, PostalCode, City, PhoneNumber)
               values(?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($Connection, $querry);
        mysqli_stmt_bind_param($stmt, 'ssssssssi', $credentials['EmailAddress'], $credentials['Username'], $password, $credentials['Name'], $credentials['Address'], $credentials['Address2'], $credentials['PostalCode'], $credentials['City'], $credentials['PhoneNumber']);
        mysqli_stmt_execute($stmt);
    }
    if (mysqli_affected_rows($connection)>=1){
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



?>