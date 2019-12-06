<?php function validate_fields($part){
	// validation for form 1
	if($part == 1){
		$error_msg = array();
		// check that name is not empty or larger than database can hold
		if (!isset($_POST['fullName'])){
			$error_msg[] = "Name field is blank.";
		} else if (isset($_POST['fullName'])){
			$name = trim($_POST['fullName']);
			if (empty($name)){
				$error_msg[] = "Name field is blank.";
			} else {
				if (strlen($name) >  128){
					$error_msg[] = "First Name field cannot contain more than 128 characters.";
				}
			}
		}
		// check that age is set and numeric 
		if (!isset($_POST['age'])){
			$error_msg[] = "Age field is blank.";
		} else if (isset($_POST['age'])){
			if (!is_numeric($_POST['age'])) {
				$error_msg[] = "Age: Please enter numbers only";
			}
		}
		// check that dropdown option has been chosen 
		if (!isset($_POST['student'])){
			$error_msg[] = "Are you a student? Please choose one.";
		} else if (isset($_POST['student'])){
			$age = $_POST['student'];
			if(!($age == "F" || $age == "P" || $age == "N")){
				$error_msg[] = "Inappropriate answer given. Please select one from dropdown.";
			}
		}
		return $error_msg;
	}
	if($part == 2){
		$error_msg = array();
		// check that purchase method is chosen 
		if (!isset($_POST['howPurchased'])){
			$error_msg[] = "Please select method of purchase.";
		} else if (isset($_POST['howPurchased'])){
			$purchased = $_POST['howPurchased']; 
			if(!($purchased == "Online" || $purchased == "By Phone" || $purchased == "Mobile App" || $purchased == "In Store")){
				$error_msg[] = "Inappropriate value for method of purchase. Please select one. ".$purchased;
			}
			
		}
		// check that one or more products has been chosen
		if (!isset($_POST['purchases'])){
			$error_msg[] = "Please select at least one product.";
		} else if (isset($_POST['purchases'])){
			$purchases = $_POST['purchases'];
			if(count($purchases) < 1){
				$error_msg[] = "Please select at least one product.";
			}
		}
		return $error_msg;
	}
	if($part == 3){
		$error_msg = array();
		for($x = 0; $x < count($_SESSION['purchases']); $x++){
			// check that satisfaction is chosen 
			if (!isset($_POST['satisfaction'.$x])){
				$error_msg[] = $_SESSION['purchases'][$x]['name']." - Please select level of satisfaction";
			} else if (isset($_POST['satisfaction'.$x])){
				$sat = $_POST['satisfaction'.$x];
				if(!is_numeric($sat) || $sat < 1 || $sat > 5){
					$error_msg[] = $_SESSION['purchases'][$x]['name']." - Inappropriate value for satisfaction.";
				}
			}
			// check that recommendation has been chosen
			if (!isset($_POST['recommend'.$x])){
				$error_msg[] = $_SESSION['purchases'][$x]['name']." - Please choose recommendation option.";
			} else if (isset($_POST['recommend'.$x])){
				$rec = $_POST['recommend'.$x];
				if(!($rec == "Yes" || $rec == "Maybe" || $rec == "No")){
					$error_msg[] = $_SESSION['purchases'][$x]['name']." - Inappropriate answer given. Please select one from dropdown.";
				}
			}
		}
		return $error_msg;
	}
} ?>

<?php function display_error($error_msg){
	echo "<p>\n";
	foreach($error_msg as $v){
		echo $v."<br>\n";
	}
	echo "</p>\n";
} ?>