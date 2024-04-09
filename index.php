<?php

getHeaders("Social Media Site");

?>

<div class="container-fluid">
    <div class="row">

        <div class="col"></div>

        <div class="col-4">
            <form method=POST>

                <h4>Create an account</h4>
              
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        Your password must be 8-20 characters long, contain letters and numbers.
                    </small>
                </div>

                <div class="form-group">
                    <label for="repeat-password">Repeat Password:</label>
                    <input type="password" class="form-control" placeholder="Repeat password" name="repeat-password" required>
                    <small id="repeatPasswordHelpBlock" class="form-text text-muted">
                        Your passwords must match.
                    </small>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                        <input type="checkbox" class="custom-control-input" id="customControlInline" required>
                        <label class="custom-control-label" for="customControlInline">Agree to terms and conditions.</label>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-outline-primary" formaction="/users/register.php">Sign Up</button>
                </div>
            </form>
        </div>

        <div class="col-1"></div>

        <div class="col-4">
            <form method=POST>

                <h4>Login</h4>

                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" placeholder="Username" name="username" id="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
                </div>
                
                <button class="btn btn-outline-primary" formaction="../users/login.php">Login</button>
            </form>
        </div>

        <div class="col"></div>

    </div>

    <div class="row">
        <div class="col-6">
            <p></p>
        </div>
    </div>

</div>

<?php

getFooter();

?>
