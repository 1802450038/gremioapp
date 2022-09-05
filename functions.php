<?php

use gremio\Model\User;

function getUserId()
{
    return $_SESSION[User::SESSION]["user_id"];
    return 1;
}

function getIsAdmin()
{
    return User::getUserIsAdmin();
    return 1;
}

function verifyPayments()
{

    $date = date("Y/m/d");

    echo $date;
}

function getDateForDatabase(string $date)
{
    $timestamp = strtotime($date);
    $date_formated = date('Y-m-d', $timestamp);
    return $date_formated;
}

function getDateForTemplate($date)
{

    if($date != null){   
        $timestamp = strtotime($date);
        $date_formated = date('d-m-Y', $timestamp);
        return $date_formated;
    } else {
        return "Pagamento não efetuado";
    }
}
