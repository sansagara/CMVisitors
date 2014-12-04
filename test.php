<?php

/* JPEGCam Test Script */
/* Receives JPEG webcam submission and saves to local file. */
/* Make sure your directory has permission to write files as your web server user! */

$userName = '';
if(isset($_REQUEST['un'])){
	$userName = addslashes($_REQUEST['un']);
}

$cedulaIdentidad = '';
if(isset($_REQUEST['ci'])){
	$cedulaIdentidad = addslashes($_REQUEST['ci']);
}

$toMeet = '';
if(isset($_REQUEST['mt'])){
	$toMeet = addslashes($_REQUEST['mt']);
}
$companyName = '';
if(isset($_REQUEST['cpname'])){
	$companyName = addslashes($_REQUEST['cpname']);
}

$comingFrom = '';
if(isset($_REQUEST['ra'])){
	$comingFrom = addslashes($_REQUEST['ra']);
}
$mobile = '';
if(isset($_REQUEST['mn'])){
	$mobile = $_REQUEST['mn'];
}
$email = '';
if(isset($_REQUEST['em'])){
	$email = $_REQUEST['em'];
}
$timeInSec = time();
$currtime = date('Y-m-d H:i:s',$timeInSec);
$currGMTime = date('Y-m-d H:i:s',($timeInSec));
$status = 1;

$con = mysql_connect("visitantes1.db.11161375.hostedresource.com","visitantes1","Sagara#87");
	if (!$con)
	{
	  die('No pude conectarme a la BD: ' . mysql_error());
	}

mysql_select_db("visitantes1", $con);
//UserDetails Insert if not exists
$resultado = mysql_query("SELECT cedula from users WHERE cedula = cedulaIdentidad", $con);
$filas = mysql_num_rows($resultado);
if ($filas = 0) {
	mysql_query("INSERT INTO users (cedula, firstname, companyname, mobile, emailid) VALUES ('$cedulaIdentidad', '$userName', '$companyName', '$mobile', '$email')", $con);
}

//Visit Insert
$sql = "INSERT INTO visitorinfo (firstname, cedula, tomeet, companyname, comingfrom, mobile, emailid, checkin, status) VALUES ('$userName', '$cedulaIdentidad', '$toMeet', '$companyName', '$comingFrom', '$mobile', '$email', '$currtime', '$status')";

// Execute query
mysql_query($sql, $con);
$id = mysql_insert_id();
mysql_close($con);

$result = file_put_contents( 'pictures/'.$id.'.jpg', file_get_contents('php://input') );

if (!$result) {
	print "ERROR: Falla al escribir informacion a $filename, Revisar permisos\n";
	exit();
}

$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/pictures/' . $id . '.jpg';
if($comingFrom != 'Familia')
	$comingFrom .= " (Req Acomp)";  
print "<root><urlsrc>$url</urlsrc><id>$id</id><cedula>$cedulaIdentidad</cedula><fname>$userName</fname><tomeet>$toMeet</tomeet><comingfrom>$comingFrom</comingfrom><mobile>$mobile</mobile><email>$email</email><checkin>$currGMTime</checkin><status>$status</status>";

?>
