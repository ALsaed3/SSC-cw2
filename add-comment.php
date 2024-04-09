<?php

$commentcontent = inputCheck($_POST['comment']);
$postid = inputCheck($_POST['postid']);

if ($stmt = $GLOBALS['database'] -> prepare("INSERT INTO `comments` (`content`, `user_id`, `post_id`) VALUES (?, ?, ?)"))
{
    $stmt -> bind_param("sii", $commentcontent, $_SESSION['id'], $postid);
    $stmt -> execute();
    $last_id = $stmt -> insert_id;
    
    $stmt -> close();

    // Refresh home page
    header("Location: " . $GLOBALS['home'] . "/home.php");
}

?>