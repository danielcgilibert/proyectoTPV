<?php

if (isset($_SESSION['errorLogin'])) {
    unset($_SESSION['errorLogin']);
}

if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
}


header("Location: ../login.php");
