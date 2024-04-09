<?php

$username = inputCheck($_POST['username']);
$email = inputCheck($_POST['email']);
$password = inputCheck($_POST['password']);
$repeat = inputCheck($_POST['repeat-password']);

if (strlen($email) <= 0 || strlen($email) > 50 || !strpos($email, "@"))
{
    if (strlen($email) < 1)
        echo "Email length too short";
    else
        echo "Email length too long";
    die();
}
else if (strlen($username) <= 0 || strlen($username) > 30)
{
    echo "Invalid username!";
    die();
}
else if (strlen($password) <= 0 || strlen($password) > 65)
{
    echo "Invalid password!";
    die();
}
else if ($password !== $repeat)
{
    echo "Your passwords dont't match!";
    exit();
}

if ($stmt = $GLOBALS['database'] -> prepare("SELECT `id` FROM `users` WHERE `username` = ? OR `email` = ?"))
{
    $stmt -> bind_param("ss", $username, $email);
    $stmt -> execute();
    $stmt -> bind_result($id);

    while ($stmt -> fetch())
    {
        echo "Could not create account!";
        die();
    }

    $stmt -> close();
}

$hash = password_hash($password, PASSWORD_DEFAULT);

if ($stmt = $GLOBALS['database'] -> prepare("INSERT INTO `users` (`username`, `email`, `password`) VALUES (?, ?, ?)"))
{
    $stmt -> bind_param("sss", $username, $email, $hash);
    $stmt -> execute();
    $last_id = $stmt -> insert_id;

    // Once the user is logged in, update the user's session variables
    $_SESSION['id'] = $last_id;
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;

    $stmt -> close();

    // Send to account page
    header("Location: " . $GLOBALS['home'] . "/users/account.php");
}

?>