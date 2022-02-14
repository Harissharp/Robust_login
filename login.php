<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>



<?php
include 'functions.php'; // file with containing many functions 

//Main Code

session_start();//starting session

$uPassword=$_POST['psw'];
$uEmail=$_POST['uEmail'];

#character check
$filter_uEmail = filter_var($uEmail, FILTER_SANITIZE_EMAIL);

validate_email($uEmail); # validates if the email is correct or not 
							#output the result by: $_SESSION["loginErrorMsg"]

$filter_uPassword =  filter_var($uPassword, FILTER_SANITIZE_STRING); 

# checks if the entries have been filtered or not due to illegal characters 

if ($filter_uPassword != $uPassword){
	$msg="password contains illegal characters";# error message returned to user
	$_SESSION["loginErrorMsg"]=$msg;
	header("Location: index.php");
	//echo $_SESSION["loginErrorMsg"];// checks its updates the error message
	
}
if ($filter_uEmail != $uEmail){
	$msg="Email contains illegal characters";# error message returned to user
	$_SESSION["loginErrorMsg"]=$msg;
	header("Location: index.php");
	//echo $_SESSION["loginErrorMsg"];// checks its updates the error message
	
}



$conn=setupconnection_sqli(); # sets up the SQLI connection to the database
testconnection_sqli($conn); #tests the connection to make sure its working 

//selecting what information we want
$sql = "SELECT ID FROM robust_login"; # selects what database to check the logins against 
$sql = $sql . " where email='" . $uEmail . "' AND password='" . $uPassword . "';";
$result = mysqli_query($conn, $sql);

setLoggedStatus($result);#if there is any results present  in databse matching password and username 
#, redir to home page saving 'loggedIn' to session var 'logged?'


mysqli_close($conn);





?>


