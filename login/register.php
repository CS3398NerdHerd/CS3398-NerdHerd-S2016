<?php 
//Connect to Database 
$connect = mysqli_connect("localhost", "my_user", "my_password");
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
mysqli_select_db($connect,"userdb"); 

if (isset($_POST['submit'])) { 
if (!$_POST['username'] | !$_POST['pass'] | !$_POST['pass2'] ) {
	die('One or more of the required fields is blank');
}
// check if the username is already taken
if (!get_magic_quotes_gpc()) {
	$_POST['username'] = addslashes($_POST['username']);
}
$usercheck = $_POST['username'];
$check = mysqli_query($connect, "SELECT username FROM users WHERE username = '$usercheck'") 
or die(mysql_error());
$check2 = mysqli_num_rows($check);

if ($check2 != 0) {
 	die('Sorry, the username '.$_POST['username'].' is already in taken.');
}

//check that passwords match
if ($_POST['pass'] != $_POST['pass2']) {
	die('Password mismatch. ');
}

$_POST['pass'] = md5($_POST['pass']);
if (!get_magic_quotes_gpc()) {
	$_POST['pass'] = addslashes($_POST['pass']);
	$_POST['username'] = addslashes($_POST['username']);
}

$insert = "INSERT INTO users (username, password) VALUES ('".$_POST['username']."', '".$_POST['pass']."')";
$add_member = mysqli_query($connect,$insert);
?>

 <h1>Registered</h1>

 <p>Registration successful! Now <a href="login.php">login</a>.</p>

 <?php 
 }
 else 
 {	
 ?>
 
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

 <table border="0">

 <tr><td>Username:</td><td>

 <input type="text" name="username" maxlength="60">

 </td></tr>

 <tr><td>Password:</td><td>

 <input type="password" name="pass" maxlength="10">

 </td></tr>

 <tr><td>Confirm Password:</td><td>

 <input type="password" name="pass2" maxlength="10">

 </td></tr>

 <tr><th colspan=2><input type="submit" name="submit" 
value="Register"></th></tr> </table>

 </form>

 <?php
 }
 ?>

