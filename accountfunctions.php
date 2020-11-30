<?php
function CheckUser($username, $password){
    include "connect.php";
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
            return false;
        }
    } else {
        return false;
    }

}

function InsertUser($credentials){
    include "connect.php";
    If (!empty($credentials)){
        $querry = "insert into customer_nl (EmailAddress, Username, Password, Name, Address, Address2, PostalCode, City, PhoneNumber)
               values(?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($Connection, $querry);
        mysqli_stmt_bind_param($stmt, 'ssssssssi', $credentials['EmailAddress'], $credentials['Username'], $credentials['Password'], $credentials['Name'], $credentials['Address'], $credentials['Address2'], $credentials['PostalCode'], $credentials['City'], $credentials['PhoneNumber']);
        mysqli_stmt_execute($stmt);
    }
    if (mysqli_affected_rows($connection)>=1){
        return true;
    } else {
        return false;
    }
}




?>