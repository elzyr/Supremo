<?php
if (!function_exists('validateInput')) {
    function validateInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

if (!function_exists('isCorrectName')) {
    function isCorrectName($data)
    {
        return preg_match("/^[a-zA-ZąĄćĆęĘłŁńŃóÓśŚżŻźŹ ]*$/", $data);
    }
}

if (!function_exists('isCorrectPassword')) {
    function isCorrectPassword($data)
    {
        return preg_match("/(?=.*[A-Z])(?=.*\d)/", $data);
    }
}

if (!function_exists('isSpecialChar')) {
    function isSpecialChar($data)
    {
        // tj.  !, @, #, $, %, ^, &, *, (, ), -, _, +, =, {, }, [, ], :, ;, ", ', <, >, ,, ., ?, /, \, |
        return preg_match("/[\W_]/", $data);
    }
}
?>
