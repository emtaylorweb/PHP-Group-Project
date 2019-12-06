<!-- Project 1 Survey -->
<!-- Group 2 -->

<!-- Rachel Voisin -->
<!-- Pursharth Vohra -->
<!-- Emily Taylor -->
<!-- Jairus Vialu -->
<!-- Aleksandar Vekic -->

<?php
	session_start();
	require_once("./includes/db_operations.php");
    require_once("./includes/form1.php");
    require_once("./includes/form2.php");
    require_once("./includes/form3.php");
    require_once("./includes/summary.php");
    require_once("./includes/validation.php");
?>
<html>
<head>
	<title>Project 1</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	// When they submit the first form
	if (isSet($_SESSION['part']) && ($_SESSION['part'] == 1)){
		// check for errors 
		$error_msg = validate_fields(1);
		if (count($error_msg) > 0){
			// re-display everything
			display_error($error_msg);
			form_1($_POST['fullName'], $_POST['age'], $_POST['student']);
		} else {
			// save data to Session and load next form
			$_SESSION['fullName'] = $_POST['fullName'];
			$_SESSION['age'] = $_POST['age'];
			$_SESSION['student'] = $_POST['student'];
			form_2('', '');
		}
		
	// when they submit the second form
	} else if (isSet($_SESSION['part']) && ($_SESSION['part'] == 2)){
		// check for errors 
		$error_msg = validate_fields(2);
		if (count($error_msg) > 0){
			// re-display everything
			display_error($error_msg);
			$howPurchased = "";
			$purchases = "";
			// to avoid undefined index error
			if (isSet($_POST['howPurchased'])){
				$howPurchased = $_POST['howPurchased'];
			}
			if (isSet($_POST['purchases'])){
				$purchases = $_POST['purchases'];
			}
			form_2($howPurchased, $purchases);
		} else {
			// save data to session and load next form
			$_SESSION['howPurchased'] = $_POST['howPurchased'];
			$array = array();
			foreach($_POST['purchases'] as $purchase){
				$array[] = array(
					"name" => $purchase,
					"satisfaction" => "",
					"recommend" => "",
				);
			}
			$_SESSION['purchases'] = $array;
			form_3($array, '', '');
		}
		// when they submit the third form
	} else if (isSet($_SESSION['part']) && ($_SESSION['part'] == 3)){
		// check for errors 
		$error_msg = validate_fields(3);
		if (count($error_msg) > 0){
			// re-display everything
			$sat = "";
			$rec = array();
			// create an array of rec and sat values for the check boxes to check against 
			for($x = 0; $x < count($_SESSION['purchases']); $x++){
				// to avoid undefined index notice 
				if (isSet($_POST['satisfaction'.$x])){
					$sat[] = $_POST['satisfaction'.$x];
				} else {
					$sat[] = "";
				}
				$rec[] = $_POST['recommend'.$x];
			}
			display_error($error_msg);
			form_3($_SESSION['purchases'], $sat, $rec); 
		} else {
			// save it to the session and load next page 
			for($x = 0; $x < count($_SESSION['purchases']); $x++){
				$sat = $_POST['satisfaction'.$x];
				$rec = $_POST['recommend'.$x];
				$_SESSION['purchases'][$x]['satisfaction'] = $sat;
				$_SESSION['purchases'][$x]['recommend'] = $rec;
			}
			summary(); 
		}
	// when they hit the complete button
	} else if (isSet($_SESSION['part']) && ($_SESSION['part'] == 4)){ 
		save_data();
		thank_you();
	} else {
		// any time 'part' somehow gets set to something strange 
		form_1('', '', '');
	}
// a GET request
} else { 
	if(!isSet($_SESSION['part'])){
		// load intro page 
		$_SESSION['part'] = 1;
		intro();
	} else if (isSet($_SESSION['part']) && ($_SESSION['part'] == 1)){
		// check to see if session data is already stored, and re-load part 1
		if(isSet($_SESSION['fullName'])){
			form_1($_SESSION['fullName'], $_SESSION['age'], $_SESSION['student']);
		} else {
			form_1('', '', '');
		}
	} else if (isSet($_SESSION['part']) && ($_SESSION['part'] == 2)){
		// check to see if session data is already stored, and re-load part 2
		if(isSet($_GET['previous2'])){
			form_1($_SESSION['fullName'], $_SESSION['age'], $_SESSION['student']);
		} else if(isSet($_SESSION['howPurchased'])){
			$purchases = [];
			foreach ($_SESSION['purchases'] as $item){
				$purchases[] = $item['name'];
			}
			form_2($_SESSION['howPurchased'], $purchases);
		} else {
			form_2('', '', '');
		}
	} else if (isSet($_SESSION['part']) && ($_SESSION['part'] == 3)){
		// check to see if session data is already stored, and re-load part 3
		if(isSet($_GET['previous3'])){
			$purchases = [];
			foreach ($_SESSION['purchases'] as $item){
				$purchases[] = $item['name'];
			}
			form_2($_SESSION['howPurchased'], $purchases);
		} else if(isSet($_SESSION['purchases'][0]['satisfaction'])){
			$sat = array();
			$rec = array();
			for($x = 0; $x < count($_SESSION['purchases']); $x++){
				$sat[] = $_SESSION['purchases'][$x]['satisfaction'];
				$rec[] = $_SESSION['purchases'][$x]['recommend'];
			}
			form_3($_SESSION['purchases'], $sat, $rec);
		} else {
			form_3($_SESSION['purchases'], '', '');
		}
	} else if (isSet($_SESSION['part']) && ($_SESSION['part'] == 4)){
		// load summary 
		if(isSet($_GET['previous4'])){
			$sat = array();
			$rec = array();
			for($x = 0; $x < count($_SESSION['purchases']); $x++){
				$sat[] = $_SESSION['purchases'][$x]['satisfaction'];
				$rec[] = $_SESSION['purchases'][$x]['recommend'];
			}
			form_3($_SESSION['purchases'], $sat, $rec);
		} else {
			summary();
		}
	}
} ?>

</body>
</html>
