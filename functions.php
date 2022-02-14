<?php
//Setting up a connection
/*useage {
	$conn=setupconnection_sqli();
}
*/
function setupconnection_sqli(){
	$servername = "localhost";
	$username = "119019";
	$password = "saltaire";
	$dbname = "119019";
	$conn =mysqli_connect($servername,$username,$password,$dbname);

	return $conn;// returns conn as its needed for testconnection_sqli()
}
// same as  sqli however instead of returning vlaue being conn, it will be smtmt
function setupconnection_PDO($sql){
	$host = "localhost";
	$username = "119019";
	$password = "saltaire";
	$dbname = "119019";
	$dsn = "mysql:host=$host;dbname=$dbname"; 

	try{ // tests the connections
		  $pdo = new PDO($dsn, $username, $password);
		  $stmt = $pdo->query($sql);
		  return $stmt;
		   
		  if($stmt === false){
		  	die("Error");
		  }
		   
		}catch (PDOException $e){
		  echo $e->getMessage();
		}

	                
}


//tests the connection to see if it did succseed in connecting to database.
//returns error message if not.
function testconnection_sqli($conn){
	if (!$conn){
		die("Connection failed:".mysqli_connect_error());
	}

}

function debug_to_console($putout) {
    $output = $putout;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

// exploits the data quired to see if theres a login match
function setLoggedStatus($result){ 
	if (mysqli_num_rows($result) == 1) {
		$status = "loggedIn";
		//echo"<h3> hi this is correct </h3>";
		$_SESSION["logged?"]=$status;
		header("Location: dashboard.php");
	} else {
		$status = "loggedOut";
		//echo"<h3> hi this is incorrect </h3>";
		$_SESSION["logged?"]=$status;
		header("Location: index.php");
	}

}

function validate_email($email){
	if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
	  $msg="email is a valid email address";
	  $_SESSION["loginErrorMsg"]=$msg;
	} else {
	  $msg="email is not a valid email address";
	  $_SESSION["loginErrorMsg"]=$msg;
	}
}
?>