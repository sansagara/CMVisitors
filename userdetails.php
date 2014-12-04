<?php
$exists = 0;
$cedula = 0;
if(isset($_REQUEST['cedula'])){
	$cedula = $_REQUEST['cedula'];
}else{
	echo 'cedula is empty';
	exit(0);
}

$con = mysql_connect("visitantes1.db.11161375.hostedresource.com","visitantes1","Sagara#87");
if (!$con)
{
  die('No Pude conectarme: ' . mysql_error());
}

mysql_select_db("visitantes1", $con);
$sql = "SELECT firstname, companyname, mobile, emailid FROM users WHERE cedula=$cedula";

// Execute query
try{
	$result = mysql_query($sql,$con);
	if(!$result){
		echo 'error';
		exit(0);
	}

	$count = mysql_affected_rows();
	if($count){
		$exists = 1;
	}

	while ($fila = mysql_fetch_assoc($result)) {
	    $fname = $fila['firstname'];
	    $from = $fila['companyname'];
	    $mobileno = $fila['mobile'];
	    $email = $fila['emailid'];
	    print "<exists>$exists</exists><fname>$fname</fname><from>$from</from><mobileno>$mobileno</mobileno><email>$email</email>";
	}

}catch(Exception $e){
}
mysql_close($con);

?>