<?php function form_3($products, $sat, $rec){ ?>
	<?php $_SESSION['part'] = 3; ?>
	<form method="POST" action="./index.php" autocomplete="off">
		<?php for ($x = 0; $x < count($products); $x++) { ?>
			<h4>For your new <?php echo($products[$x]['name']); ?></h4>
			<label for="satisfaction">How happy are you with your purchase on a scale from 1 (not satisfied) to 5 (very satisfied)?</label><br>
			<input type="radio" name="satisfaction<?php echo($x); ?>" value=1 <?php if(is_array($sat) && $sat[$x] == 1){echo("checked");}?>>1</input><br>
			<input type="radio" name="satisfaction<?php echo($x); ?>" value=2 <?php if(is_array($sat) && $sat[$x] == 2){echo("checked");}?>>2</input><br>
			<input type="radio" name="satisfaction<?php echo($x); ?>" value=3 <?php if(is_array($sat) && $sat[$x] == 3){echo("checked");}?>>3</input><br>
			<input type="radio" name="satisfaction<?php echo($x); ?>" value=4 <?php if(is_array($sat) && $sat[$x] == 4){echo("checked");}?>>4</input><br>
			<input type="radio" name="satisfaction<?php echo($x); ?>" value=5 <?php if(is_array($sat) && $sat[$x] == 5){echo("checked");}?>>5</input><br>
			<label for="recommend">Would you recommend the purchase of this device to a friend?</label><br>
			<select id="recommend" name="recommend<?php echo($x); ?>">
				<option></option>
				<option value="Yes" <?php if(is_array($rec) && $rec[$x] == 'Yes'){echo("selected");}?>>Yes</option>
				<option value="Maybe" <?php if(is_array($rec) && $rec[$x] == 'Maybe'){echo("selected");}?>>Maybe</option>
				<option value="No" <?php if(is_array($rec) && $rec[$x] == 'No'){echo("selected");}?>>No</option>
			</select>
		<?php } ?>
		<br><br><input type="submit" value="Next"/>
	</form>
	<form method="GET" action="./index.php">
		<input name="previous3" type="submit" value="Go Back" />
	</form>
	
<?php } ?>