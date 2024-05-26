<?php
include("class/User.php");
$user = User::loadFromSession();
if (!$user || !$user instanceof User) {
    header('Location: login.php');
}
