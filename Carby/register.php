<?php 
//Connect to Database 
$servername = 'localhost';
$username = 'elizeweb_softwar';
$password = 'CS3398';
$connect = mysqli_connect($servername,$username,$password); 
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
}
}
 ?> 
