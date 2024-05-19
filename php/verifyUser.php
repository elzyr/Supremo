<?php
include("class/uzytkownik.php");
$user = Uzytkownik::loadFromSession();
if (!$user || !$user instanceof Uzytkownik) {
    header('Location: login.php');
}
