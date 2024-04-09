<?php

getHeader("Social Media Site");

function addOTP()
{
    // Generate random number
    $code = rand(0,99999999);
    $email = $_SESSION['email'];
    
    // Add code to database
    if ($stmt = $GLOBALS['database'] -> prepare("UPDATE `users` SET `otp` = ? WHERE `username` = ?"))
    {
        $stmt -> bind_param("ss", $code, $_SESSION['username']);
        $stmt -> execute();
        $stmt -> close();
        
        // Send the emai with the generated code after adding to the database
        include('../email.php');
        sendEmail($code, $email);
    }
}

// Check connection
if ($GLOBALS['database'] -> connect_errno)
{
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}

$username = inputCheck($_POST['username']);
$password = inputCheck($_POST['password']);

if ($stmt = $GLOBALS['database'] -> prepare("SELECT `id`, `email`, `password`, `firstname`, `lastname`, `date`, `profile` FROM `users` WHERE BINARY `username` = ? LIMIT 1"))
{
    $stmt -> bind_param("s", $username);
    $stmt -> execute();
    $stmt -> bind_result($id, $email, $hash, $firstname, $lastname, $date, $profile);
    $stmt -> store_result();

    while ($stmt -> fetch())
    {
        if (password_verify($password, $hash))
        {
            $_SESSION['id'] =  $id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $hash;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['date'] = $date;
            $_SESSION['profile'] = $profile;

            ?>

            <div class="container-fluid">
                <div class="row">

                <div class="col"></div>

                <div class="col-6">
                    <form action="verify.php" method="POST">
                        <div class="form-group">
                            <label for="otp">Verification code</label>
                            <input type="text" class="form-control" placeholder="One time code" name="otp" id="otp" min="0" max="99999999" required>
                        </div>

                        <div class="form-group text-center">
                            <button class="btn btn-outline-success" type="submit" name="verify">Verify</button>
                        </div> 
                    </form>
                </div>

                <div class="col"></div>

                </div>    
            </div>
            <?php
            
            addOTP();
            
            getFooter();
            
            die();
        }
    }
    ?>
    <div class="form-group text-center">
        <?php
        echo "Invalid username or password<br>";
        ?>
        <a href="../index.php">
            <?php
                echo "Click here to return to login screen";
            ?>
        </a>
    </div>
    <?php
    
    getFooter();

    die();
}

?>