<?php
include("class/uzytkownik.php");
$user = Uzytkownik::loadFromSession();
if (!$user) {
    header('Location: login.php');
}
