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

function isCorrectPassword($data)
{
    return preg_match("/(?=.*[A-Z])(?=.*\d)/", $data);
}

function isSpecialChar($data)
{
    //tj.  !, @, #, $, %, ^, &, *, (, ), -, _, +, =, {, }, [, ], :, ;, ", ', <, >, ,, ., ?, /, \, |
    return preg_match("/[\W_]/", $data);
}