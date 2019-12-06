<?php function form_2($how, $purchases){ ?>
	<?php $_SESSION['part'] = 2; ?>
	<form method="POST" action="./index.php">
		<label for="howPurchased">How did you complete your purchase?</label><br>
		<input type="radio" name="howPurchased" value="Online" <?php if($how == 'Online'){echo("checked");}?>>Online</input><br>
		<input type="radio" name="howPurchased" value="By Phone" <?php if($how == 'By Phone'){echo("checked");}?>>By Phone</input><br>
		<input type="radio" name="howPurchased" value="Mobile App" <?php if($how == 'Mobile App'){echo("checked");}?>>Mobile App</input><br>
		<input type="radio" name="howPurchased" value="In Store" <?php if($how == 'In Store'){echo("checked");}?>>In Store</input><br>
		<br>
		<label for="purchases[]">Which of the following did you purchase?</label><br>
		<input type="checkbox" name="purchases[]" value="Mobile Phone" <?php if(is_array($purchases) && in_array("Mobile Phone", $purchases)){echo("checked");}?>>Mobile Phone</input><br>
		<input type="checkbox" name="purchases[]" value="Smart TV" <?php if(is_array($purchases) && in_array("Smart TV", $purchases)){echo("checked");}?>>Smart TV</input><br>
		<input type="checkbox" name="purchases[]" value="Laptop" <?php if(is_array($purchases) && in_array("Laptop", $purchases)){echo("checked");}?>>Laptop</input><br>
		<input type="checkbox" name="purchases[]" value="Desktop Computer" <?php if(is_array($purchases) && in_array("Desktop Computer", $purchases)){echo("checked");}?>>Desktop Computer</input><br>
		<input type="checkbox" name="purchases[]" value="Tablet" <?php if(is_array($purchases) && in_array("Tablet", $purchases)){echo("checked");}?>>Tablet</input><br>
		<input type="checkbox" name="purchases[]" value="Home Theatre" <?php if(is_array($purchases) && in_array("Home Theatre", $purchases)){echo("checked");}?>>Home Theatre</input><br>
		<br>
		<input type="submit" value="Next"/>
	</form>
	<form method="GET" action="./index.php">
		<input name="previous2" type="submit" value="Go Back" />
	</form>
<?php } ?>