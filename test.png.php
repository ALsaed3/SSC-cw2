<p id="cookie"></p>

<script>
document.getElementById("cookie").innerHTML = document.cookie;
</script>

<?php
if ($stmt = $GLOBALS['database'] ->
    prepare("SELECT `id`, `email`, `password`, `firstname`, `lastname`, `date`, `profile` FROM `users`"))
{
    $stmt -> execute();
    $stmt -> bind_result($id, $email, $hash, $firstname, $lastname, $date, $profile);
    $stmt -> store_result();

    while ($stmt -> fetch())
    {
      echo "ID: " . $id . " Email: " . $email . " Password: " . $hash . " Firstname: " . $firstname . " Lastname: " . $lastname . " Join date: " . $date . " Profile picture: " . $profile . "<br>";
    }
}
?>
