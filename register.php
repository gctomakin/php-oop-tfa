
<?php
include("autoload.php");
include_once("lib/GoogleAuthenticator.php");
$b = 'current';
$message = $firstname = $lastname = $email = $password = "";
$secret = $authenticator->createSecret();
$website = 'http://localhost:8888/pdo-oop';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if(Security::sanitize($_POST["firstname"]) == '' || Security::sanitize($_POST["firstname"]) == null ||
     Security::sanitize($_POST["lastname"]) == '' || Security::sanitize($_POST["lastname"]) == null ||
     Security::sanitize($_POST["email"])== '' || Security::sanitize($_POST["email"]) == null ||
     Security::sanitize($_POST["password"]) == '' || Security::sanitize($_POST["password"]) == null):

    $message = '<div data-alert class="alert-box warning radius">Fill All Fields<a href="#" class="close">&times;</a></div>';

  elseif(!preg_match("^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$^", Security::sanitize($_POST["email"]))):

    $message = '<div data-alert class="alert-box warning radius">Required Email Address<a href="#" class="close">&times;</a></div>';

  else:

    $usersVO->setFirstname(Security::sanitize($_POST["firstname"]));
    $usersVO->setLastname(Security::sanitize($_POST["lastname"]));
    $usersVO->setEmail(Security::sanitize($_POST["email"]));
    $usersVO->setPassword(Security::sanitize($_POST["password"]));
    $usersVO->setSecret($secret);
    $qrCodeUrl = $authenticator->getQRCodeGoogleUrl($usersVO->getEmail(),$secret,$website);

    $message = $usersDAO->insert($usersVO);

    echo "<img src=".$qrCodeUrl." alt='qr code'/>";

  endif;

}

?>
<?php include('templates/header.php');?>
<?php include('templates/nav.php');?>
      <fieldset>
      <legend>Registration</legend>
          <?php echo $message; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
          <div class="row">
            <div class="large-12 columns">
              <label>Firstname
                <input type="text" name="firstname" placeholder="John" />
              </label>
            </div>
          </div>
          <div class="row">
            <div class="large-12 columns">
              <label>Lastname
                <input type="text" name="lastname" placeholder="Doe" />
              </label>
            </div>
          </div>
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
              <input type="submit" class="button" value="Submit">
            </div>
          </div>
        </form>
      </fieldset>
<?php include('templates/footer.php');?>