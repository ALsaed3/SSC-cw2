<?php

function updateInfo()
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    if ($stmt = $GLOBALS['database'] -> prepare("UPDATE `users` SET `firstname` = ?, `lastname` = ? WHERE `id` = ?"))
    {
        $stmt -> bind_param("sss", $firstname, $lastname, $_SESSION['id']);
        $stmt -> execute();
        $stmt -> close();

        // Update the session variables
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;

        reloadAccount();
    }
}

function updatePassword()
{
    // Retrieve the post variables from the form
    $oldpassword = $_POST['old-password'];
    $newpassword = $_POST['new-password'];
    $repeatpassword = $_POST['repeat-new-password'];
    
    // Compare old password against session password AND compare new password against repeat password
    if (password_verify($oldpassword, $_SESSION['password']) and ($newpassword = $repeatpassword))
    {
        $hash = password_hash($newpassword, PASSWORD_DEFAULT);
        // Passwords match and old password is correct
        if ($stmt = $GLOBALS['database'] -> prepare("UPDATE `users` SET `password` = ? WHERE `id` = ?"))
        {
            $stmt -> bind_param("ss", $hash, $_SESSION['id']);
            $stmt -> execute();
            $stmt -> close();

            // Update the session variables
            $_SESSION['password'] = $newpassword;

            reloadAccount();
        }
    }
}

function updateProfile()
{
    // Get the file name from the file path -> basename()
    $profile = basename($_FILES["profile"]["name"]);
    $currentProfile = $_SESSION['profile'];

    // Check if the profile picture is the same as the current one
    if (strcmp($profile, $currentProfile) == 0)
    {
        // Dont update cause the image is the same
    }
    else
    {
        if ($stmt = $GLOBALS['database'] -> prepare("UPDATE `users` SET `profile` = ? WHERE `id` = ?"))
        {
            $stmt -> bind_param("ss", $profile, $_SESSION['id']);
            $stmt -> execute();
            $stmt -> close();

            // Update the session variable
            $_SESSION['profile'] = $profile;
            
            reloadAccount();
        }
    }
}

function reloadAccount()
{
    header("Location: " . $GLOBALS['home'] . "/users/account.php");
}

// Check which section was submitted based on the name of the button clicked
if (isset($_POST['infobutton']))
{
    updateInfo();
}
elseif (isset($_POST['passwordbutton']))
{
    updatePassword();
}
elseif (isset($_POST['profilebutton']))
{
    updateProfile();
}

?>
