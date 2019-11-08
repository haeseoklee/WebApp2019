<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Grade Store</title>
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<?php
		# Ex 4 : 
		# Check the existence of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)

		if (!isset($_POST["Course"]) || !isset($_POST["cc"]) || 
		empty($_POST["Name"]) || empty($_POST["ID"]) || empty($_POST["credit_card"])) {
		?>
		<!-- Ex 4 : Display the below error message : --> 
		<h1>Sorry</h1>
		<p>You didn't fill out the form completely. <a href="http://localhost:8888/lab6/gradestore/gradestore.html">Try again?</a></p>
		
		<?php
		# Ex 5 : 
		# Check if the name is composed of alphabets, dash(-), ora single white space.
		} elseif (!preg_match("/^([a-zA-Z]+([\-]|[\s]?))+$/", $_POST["Name"])) { 
		?>

		<!-- Ex 5 : Display the below error message : --> 
		<h1>Sorry</h1>
		<p>You didn't provide a valid name. <a href="http://localhost:8888/lab6/gradestore/gradestore.html">Try again?</a></p>

		<?php
		# Ex 5 : 
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5. 
		} elseif (((int)!preg_match("/^\d{16}$/", $_POST["credit_card"]) +
		(int)!($_POST["cc"] == "visa" && preg_match("/^4/", $_POST["credit_card"])) +
		(int)!($_POST["cc"] == "mastercard" && preg_match("/^5/", $_POST["credit_card"]))) > 1) {
		?>
		<!-- Ex 5 : Display the below error message : --> 
		<h1>Sorry</h1>
		<p>You didn't provide a valid credit card number. <a href="http://localhost:8888/lab6/gradestore/gradestore.html">Try again?</a></p>
		<?php
		# if all the validation and check are passed 
		} else {
		?>

		<h1>Thanks, looser!</h1>
		<p>Your information has been recorded.</p>
		
		<!-- Ex 2: display submitted data -->
		<ul>
			<li>Name: <?= $_POST["Name"] ?></li>
			<li>ID: <?= $_POST["ID"] ?></li>
			<!-- use the 'processCheckbox' function to display selected courses -->
			<li>Course: <?= processCheckbox($_POST["Course"]) ?></li>
			<li>Grade: <?= $_POST["grade"] ?></li>
			<li>Credit Card: <?= $_POST["credit_card"] ?> (<?= $_POST["cc"]?>)</li>
		</ul>
		
		
		<p>Here are all the loosers who have submitted here:</p>
		<?php
			$filename = "loosers.txt";
			$contents = $_POST["Name"].";".$_POST["ID"].";".$_POST["credit_card"].";".$_POST["cc"]."\n";
			file_put_contents($filename, $contents, FILE_APPEND);
		?>
		
		<pre><?=file_get_contents($filename)?></pre>

		
		<?php
		}
		?>
		
		<?php
			/* Ex 2: 
			 * Assume that the argument to this function is array of names for the checkboxes ("cse326", "cse107", "cse603", "cin870")
			 * 
			 * The function checks whether the checkbox is selected or not and 
			 * collects all the selected checkboxes into a single string with comma separation.
			 * For example, "cse326, cse603, cin870"
			 */
			function processCheckbox($names){
				$temp = array();
				foreach($names as $k => $v) {
					array_push($temp, $v);
				}
				return implode(", ", $temp);
			}
		?>

	</body>
</html>
