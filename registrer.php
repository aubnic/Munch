<html>

<head>
<link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>
<?php
mysql_connect('localhost', 'root', '') or die(mysql_error());

mysql_select_db('munch')or die(mysql_error());
//include('funksjoner.php'); // inneholder var_exists
//////////////////////////////////////////////////////////////////
error_reporting(0);
if(isset($_POST['register'])){
	
	if($_POST['password'] == $_POST['password2']){
		switch($_POST['password']){
		case "":
			$feil = true;
			$feil_array[] = "Du har ikke fylt inn password";
			break;
		default:
		$password = $_POST['password'];
		}
	}
	
	if($_POST['email'] == $_POST['email2']){
		switch($_POST['email']){
		case "":
			$feil = true;
			$feil_array[] = "Du har ikke fylt inn email";
			break;
		default:
			$email = $_POST['email'];
		}
		$regxp = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])↪*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";
		if(!preg_match($regxp ,$_POST['email'])){
		$feil = true;
		$feil_array[] = "Du har skrevet en ugyldig epost-adresse.";
	}
		$email = $_POST['email'];
		}
	}
			
	/*if(var_exists($brukernavn) && var_exists($password) && var_exists($email)){
		if(get_magic_quotes_gpc()){
			$brukernavn = addslashes($brukernavn);
		}
		else{
			return $brukernavn;
		}
	*/
 
	
	$email_ = mysql_query("SELECT `email` FROM `kunder` WHERE `email` = '" . mysql_escape_string(strtolower($_POST['email'])) . "'");
		if(mysql_num_rows($email_) == 1){
			$feil = true;
			$feil_array[] = "Emailen finnes allerede i databasen.";
		}
	
	if(!empty($_POST['password'])){
		if($_POST['password'] != $_POST['password2']){
			$feil = true;
			$feil_array[] = "passwordene må være like!";
			}
	}
		elseif(strlen($_POST['password'] < 5)){
			$feil = true;
			$feil_array[] = "Du må ha et password som består av minst 5 tegn.";			
		}
	}

	if(!empty($brukernavn)){
		if(strlen($brukernavn) < 5){
			$feil = true;
			$feil_array[] = "Brukernavnet må være mer enn 5 tegn.";
		}
	}
	if($feil = true){
	echo "<div id='box'>";
		foreach($feil_array as $feil_){
			echo $feil_ . "";
			echo "<br / >";
			}
	echo "</div>";
}
 
if(!$feil){
$password = md5(sha1(($password)));
$email = strtolower(mysql_escape_string($email));
$ip = $_SERVER['REMOTE_ADDR'];
$sql = mysql_query("INSERT INTO ´kunder´ (password, email, ip)
					VALUES ('$password', '$email', '$ip')") or die("Ops");
if($sql){
	echo "Du er nå registrert!";
	}
}
?>


<div id="stylized" class="myform">
<form id="form" name="form" method="post" action="registrer.php">
<h1>Register for </h1>
<p>Fyll inn dine opplysninger under</p>

<label>Firstname
<span class="small">Add your name</span>
</label>
<input type="text" name="firstname" id="name" />

<label>Surname
<span class="small">Add your name</span>
</label>
<input type="text" name="surname" id="name" />

<label>Email
<span class="small">Enter a valid email-adress</span>
</label>
<input type="text" name="email" id="name" />

<label>Email
<span class="small">Repeat your email-adress</span>
</label>
<input type="text" name="email2" id="name" />

<label>Zip-code
<span class="small">Add your name</span>
</label>
<input type="text" name="zipcode" id="name" />

<label>City
<span class="small">Add a valid address</span>
</label>
<input type="text" name="email" id="email" />

<label>Country
<span class="small">Add a valid address</span>
</label>
<input type="text" name="country" id="email" />


<label>Password
<span class="small">Min. size 6 chars</span>
</label>
<input type="text" name="password" id="password" />

<label>Repeat password
<span class="small"></span>
</label>
<input type="text" name="password2" id="password" />

<button type="submit">Registrer!</button>
<div class="spacer"></div>

</form>
</div>

</body>
</html>

