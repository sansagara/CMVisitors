<?php
$vid = 0;
if(isset($_REQUEST['vid'])){
	$vid = $_REQUEST['vid'];
}else{
	echo 'visitor id is empty';
	exit(0);
}

$con = mysql_connect("visitantes1.db.11161375.hostedresource.com","visitantes1","Sagara#87");
if (!$con)
{
  die('No Pude conectarme: ' . mysql_error());
}

mysql_select_db("visitantes1", $con);
$timeInSec = time();
$currtime = date('Y-m-d H:i:s',$timeInSec);

$sql = "UPDATE visitorinfo set status=0,checkout='$currtime' where id=$vid";

// Execute query
try{
	$result = mysql_query($sql,$con);
	if(!$result){
		echo 'error';
		exit(0);
	}
	$count = mysql_affected_rows();
	if(!$count){
		echo 'Invalid';
	}else{
		echo $vid;
	}
}catch(Exception $e){
}
mysql_close($con);

?>