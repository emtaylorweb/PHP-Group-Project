<?php
function save_data(){
	$db_conn = new mysqli('localhost', 'lamp1_survey', '!survey!', 'lamp1_survey');
	if ($db_conn->connect_errno) {
		printf ("Could not connect to database server".$db_host."\n Error: ".$db_conn->connect_errno ."\n Report: ".$db_conn->connect_error."\n");  
	}

	$full_name = $db_conn->real_escape_string($_SESSION['fullName']);
	$age = $db_conn->real_escape_string($_SESSION['age']);
	$student = $db_conn->real_escape_string($_SESSION['student']);
		
	$qry = "INSERT INTO participants (part_fullname, part_age, part_student) values ('".$full_name."', '".$age."', '".$student."');";
	$db_conn->query($qry);

	$partID = mysqli_insert_id($db_conn);   
	$howPurchased = $_SESSION['howPurchased'];

	foreach ($_SESSION['purchases'] as $row) {	
		$itemVal = $row['name'];
		$sat = $row['satisfaction'];
		$rec = $row['recommend'];   
		
		$qry = "INSERT INTO responses (resp_part_id, resp_product, resp_how_purchased, resp_satisfied, resp_recommend) values ('".$partID."','".$itemVal."','".$howPurchased."','".$sat."','".$rec."');";
		
		$db_conn->query($qry);
	}
	$db_conn->close();
}
?>