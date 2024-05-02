<?php
function validateInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function isCorrectName($data)
{
    return preg_match("/^[a-zA-ZąĄćĆęĘłŁńŃóÓśŚżŻźŹ ]*$/", $data);
}
