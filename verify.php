<?php

$username = $_SESSION['username'];

// Check if form was submitted
if(isset($_POST['verify']))
{ 
    // Get input
    $input = $_POST['otp'];
    
    // Retrieve OTP from database
    if ($stmt = $GLOBALS['database'] -> prepare("SELECT `otp` FROM `users` WHERE BINARY `username` = ? LIMIT 1"))
    {
        $stmt -> bind_param("s", $username);
        $stmt -> execute();
        $stmt -> bind_result($otp);
        $stmt -> store_result();
        
        while ($stmt -> fetch())
        {
            // Check if codes match
            if ($input == $otp)
            {
                $code = NULL;
                if ($new = $GLOBALS['database'] -> prepare("UPDATE `users` SET `otp` = ? WHERE `username` = ?"))
                {
                    $new -> bind_param("ss", $code, $username);
                    $new -> execute();

                    $new -> close();
                }
                header("Location: " . $GLOBALS['home'] . "/home.php");
            }
            else
            {
                ?>
                <div class="form-group text-center">
                <?php
                echo "Invalid code!<br>";
                    ?>
                    <a href="../index.php">
                        <?php
                            echo "Click here to return to login screen";
                        ?>
                    </a>
                </div>
                <?php
            }
        }
        $stmt -> close();
    }
}

?>