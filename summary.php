<?php function thank_you(){ ?>
	<h2>Thank you!</h2>
<?php } ?>

<?php function intro(){ ?>
	<h2>Welcome</h2>
	<p>Please complete the following survey.</p>
	<p>Please answer all questions in full.</p>
	
	<form method="GET" action="./index.php">
		<input type="submit" value="Start Survey"/>
	</form>
<?php } ?>

<?php
    function summary(){ ?>
	
	<?php $_SESSION['part'] = 4; ?>

       <?php $fullName = "";
        $age = "";
        $student = "";
        $howPurchased = "";
        $purchases = array();


        if (isset($_SESSION['fullName'])){
            $fullName = $_SESSION['fullName'];
        } else if (isset($_POST['fullName'])){
            $fullName = $_POST['fullName'];
        }

        if (isset($_SESSION['age'])){
            $age = $_SESSION['age'];
        } else if (isset($_POST['age'])){
            $age = $_POST['age'];
        }

        if (isset($_SESSION['student'])){
            $student = $_SESSION['student'];
        } else if (isset($_POST['student'])){
            $student = $_POST['student'];
        }


        if (isset($_SESSION['howPurchased'])){
            $howPurchased = $_SESSION['howPurchased'];
        } else if (isset($_POST['howPurchased'])){
            $howPurchased = $_POST['howPurchased'];
        }

        if (isset($_SESSION['purchases'])){
            $purchases = $_SESSION['purchases'];
        } else if (isset($_POST['purchases'])){
            $purchases = $_POST['purchases'];
        }
     ?>

	<h1>Summary of Survey</h1>
	<br><br>		
	<table >
		<tr>
			<td>Full Name</td><td><?php echo($fullName) ?></td>
		</tr>
		<tr>
			<td>Age</td><td><?php echo($age) ?></td>
		</tr>
		<tr>
			<td>Student Type</td><td><?php echo($student) ?></td>
		</tr>
		<tr>
			<td>How did Purchase completed </td><td><?php echo($howPurchased) ?></td>
		</tr>
	</table>
	<br><br>
	<table>
		<tr>
        	<td>Device Name</td><td>Satisfaction Level</td><td>Recommend Response</td>
    	</tr>
    	<tr>
			<?php
				foreach($purchases as $device){
					echo("<tr><td>".$device['name']."</td><td>".$device['satisfaction']."</td><td>".$device['recommend']."</td></tr>");
				}    
			?>
    	</tr>
	</table>
	<br><br>

	<form method="POST" action="./index.php">
		<input type="submit" value="Complete" style="margin-right: 10px;"/>
	</form>
	<form method="GET" action="./index.php">
		<input name="previous4" type="submit" value="Go Back" />
	</form>
<?php } ?>  