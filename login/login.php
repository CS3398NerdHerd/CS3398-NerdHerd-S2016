<?php 
//Connect to Database 
$servername = "localhost";
$username = "username";
$password = "password";
$connect = mysqli_connect($servername,$username,$password); 
//Checks for login cookie
if(isset($_COOKIE['ID_your_site'])){ //redirect to member page if cookie exists
 	$username = $_COOKIE['ID_your_site']; 
 	$pass = $_COOKIE['Key_your_site'];
 	$check = mysqli_query($connect, "SELECT * FROM users WHERE username = '$username'")or die(mysql_error());
 	while($info = mysqli_fetch_array( $check )){
 		if ($pass != $info['password']){}
 		else{
 			header("Location: login.php");
		}
 	}
 }

 if (isset($_POST['submit'])) {
	 	if(!$_POST['username']){
 		die('You did not fill in a username.');
 	}
 	if(!$_POST['pass']){
 		die('You did not fill in a password.');
 	}
 
 	$check = mysqli_query($connect, "SELECT * FROM users WHERE username = '".$_POST['username']."'")or die(mysql_error());
 $check2 = mysqli_num_rows($check);
 if ($check2 == 0){
	die('That user does not exist.<br /><br />If you think this is incorrect <a href="login.php">try again</a>.');
}
while($info = mysqli_fetch_array( $check )){
	$_POST['pass'] = stripslashes($_POST['pass']);
 	$info['password'] = stripslashes($info['password']);
 	$_POST['pass'] = md5($_POST['pass']);
	//gives error if the password is wrong
 	if ($_POST['pass'] != $info['password']){
 		die('Incorrect password, please <a href="login.php">try again</a>.');
 	}
	
	else{ //add cookie 
		$_POST['username'] = stripslashes($_POST['username']); 
		$hour = time() + 3600; 
		setcookie(ID_your_site, $_POST['username'], $hour); 
		setcookie(Key_your_site, $_POST['pass'], $hour);	 
 
		//redirect to the member page
		header("Location: members.php"); 
	}
}
}
else{
// if not logged in, display login form 
?>

 <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post"> 

 <table border="0"> 

 <tr><td colspan=2><h1>Login</h1></td></tr> 

 <tr><td>Username:</td><td> 

 <input type="text" name="username" maxlength="40"> 

 </td></tr> 

 <tr><td>Password:</td><td> 

 <input type="password" name="pass" maxlength="50"> 

 </td></tr> 

 <tr><td colspan="2" align="right"> 

 <input type="submit" name="submit" value="Login"> 

 </td></tr> 

 </table> 

 </form> 

 <?php 
 }
 ?> 
