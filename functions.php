<?php

use prefeitura\Model\User;

function getUserId()
{
    return $_SESSION[User::SESSION]["user_id"];
}

function getIsAdmin()
{

    return User::getUserIsAdmin();
}
