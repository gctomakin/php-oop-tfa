
<?php
include("autoload.php");
include_once("lib/GoogleAuthenticator.php");
$a = 'current';
$message = $email = $password = "";
$tolerance = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if(Security::sanitize($_POST["email"])== '' || Security::sanitize($_POST["email"]) == null || Security::sanitize($_POST["password"]) == '' || Security::sanitize($_POST["password"]) == null):

    $message = '<div data-alert class="alert-box warning radius">Fill All Fields<a href="#" class="close">&times;</a></div>';

  elseif(!preg_match("^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$^", Security::sanitize($_POST["email"]))):

    $message = '<div data-alert class="alert-box warning radius">Required Email Address<a href="#" class="close">&times;</a></div>';

  else:

    $otp = $_POST['otp'];
    $usersVO->setEmail(Security::sanitize($_POST["email"]));
    $usersVO->setPassword(Security::sanitize($_POST["password"]));
    $title = $usersDAO->login($usersVO);
    $checkResult = $authenticator->verifyCode($title, $otp, $tolerance);
    if ($checkResult)
    {
        $message = '<div data-alert class="alert-box success radius">Login Successfully.<a href="#" class="close">&times;</a></div>';

    } else {

        $message =  '<div data-alert class="alert-box alert radius">Login Failed.<a href="#" class="close">&times;</a></div>';
    }


  endif;

}
?>
<?php include('templates/header.php');?>
<?php include('templates/nav.php');?>
      <fieldset>
      <legend>Login</legend>
          <?php echo $message; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
          <div class="row">
            <div class="large-12 columns">
              <label>Email
                <input type="email" name="email" placeholder="foo@gmail.com" />
              </label>
            </div>
          </div>
          <div class="row">
            <div class="large-12 columns">
              <label>Password
                <input type="password" name="password" placeholder="ex. p@5sW0rD" />
              </label>
            </div>
          </div>
          <div class="row">
            <div class="large-12 columns">
              <!-- //<img src="<?php echo $qrCodeUrl;?>"/> -->
              <label>Enter OTP
                <input type="text" name="otp" value=""/>
              </label>
            </div>
          </div>
          <div class="row">
            <div class="large-12 columns">
              <input type="submit" class="button" value="Login">
            </div>
          </div>
        </form>
      </fieldset>
<?php include('templates/footer.php');?>
