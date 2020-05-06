<?php
include "includes/header.php";

if (isset($_POST ['login'])) {
    $email = $_POST['input_Email'];
    $pass = $_POST['input_Password'];
    $hashedpass = password_hash($pass, PASSWORD_DEFAULT);
    $hash = "bratpack";

    if ($email == 'admin@email.com' && password_verify( $hash, $hashedpass) ) {
        $_SESSION['userinfo'] = array();
        $_SESSION['userinfo']['type']= 'admin';
        $_SESSION['userinfo']['password'] = $hashedpass;
        header('Location: admin.php');
    } else if ($email == 'parent@email.com' && password_verify( $hash, $hashedpass)){
        $_SESSION['userinfo'] = array();
        $_SESSION['userinfo']['type']= 'parent';
        $_SESSION['userinfo']['password'] = $hashedpass;
        header('Location: public_interface.php');
    } else {
        echo 'Invalid Login Credentials';
    }
}
?>
    <div id="login__form" class="text-center">
        <form class="form-signin" method="post">
            <img class="mb-4" src="images/icons/login.png" alt="Log In Icon" width="100px" height="auto">
            <h1 class="h3 mb-3 font-weight-normal">Please Sign In</h1>
            <div class="login__form_input">
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" id="inputEmail" name="input_Email" class="form-control" placeholder="Email address" required autofocus>
            </div>
            <div class="login__form_input">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" name="input_Password" class="form-control" placeholder="Password" required>
            </div>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-secondary btn-block" type="submit" name="login">Sign in</button>
            <span>New to The Brat Pack Daycare System? <a href="/">Sign up here.</a></span>
        </form>
    </div>
<?php
include "includes/footer.php";
?>


