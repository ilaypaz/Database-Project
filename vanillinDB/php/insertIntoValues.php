<!doctype html>
<!-- (C) Saeed Mirjalili -->
<html>

<head>
	<title>Insert Data Into a Database</title>
	<link rel="stylesheet" href="../css/style.css" />
</head>

<body>

	<?php
	require 'config.php';

    $servername = "localhost";
    $dbname = "VanillinDB";
    $username = "root";
    $password = "";
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Sets the error mode of PHP engine to Exception to display all the errors
		echo "<p style='color:green'>Connection Was Successful</p>";
	} catch (PDOException $err) {
		echo "<p style='color:red'>Connection Failed: " . $err->getMessage() . "</p>\r\n";
	}

	try {
$sql = "INSERT INTO Student (SSN, Name, Start_Registration_Date, Date_of_Birth, Major, Minor, Message_Content, Advisor_EID) VALUES (:ssn, :name, :reg_date, :dob, :major, :minor, :message, :advisor)";

$stmnt = $conn->prepare($sql);
$stmnt->bindParam(':ssn', $_POST['ssn']);
$stmnt->bindParam(':name', $_POST['name']);
$stmnt->bindParam(':reg_date', $_POST['start_registration_date']);
$stmnt->bindParam(':dob', $_POST['dob']);
$stmnt->bindParam(':major', $_POST['major']);
$stmnt->bindParam(':minor', $_POST['minor']);
$stmnt->bindParam(':message', $_POST['message_content']);
$stmnt->bindParam(':advisor', $_POST['advisor_eid']);

$stmnt->execute();

		echo "<p style='color:green'>Data Inserted Into Table Successfully</p>";
	} catch (PDOException $err) {
		echo "<p style='color:red'>Data Insertion Failed: " . $err->getMessage() . "</p>\r\n";
	}
	// Close the connection
	unset($conn);

	echo "<a href='../insertData.html'>Insert More Values</a> <br />";

	echo "<a href='../index.html'>Back to the Homepage</a>";

	?>

</body>

</html>