<?php function form_1($fullName, $age, $student){ ?>
	<?php $_SESSION['part'] = 1; ?>
	<form method="POST" action="./index.php" autocomplete="off">
		<label for="fullName">Full Name</label>
		<input type="text" size="100" maxlength="128" id="fullName" name="fullName" value="<?php echo $fullName; ?>">
		<br />
		<label for="age">Your Age</label>
		<input type="text" size="3" maxlength="3" id="age" name="age" value="<?php echo $age; ?>">
		<br />
		<label for="student">Are you a student?</label>
		<select id="student" name="student">
			<option></option>
			<option value="F" <?php if($student == 'F'){echo("selected");}?>>Yes, Full Time</option>
			<option value="P" <?php if($student == 'P'){echo("selected");}?>>Yes, Part Time</option>
			<option value="N" <?php if($student == 'N'){echo("selected");}?>>No</option>
		</select>
		<br />
		<input type="submit" value="Next"/>
	</form>
<?php } ?>