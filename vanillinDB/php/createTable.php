<!doctype html>
<!-- (C) Saeed Mirjalili -->
<html>

<head>
	<title>Create a Table</title>
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
		$conn = new PDO("mysql:host=$GLOBALS[servername];dbname=$GLOBALS[dbname]", $GLOBALS['username'], $GLOBALS['password']);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Sets the error mode of PHP engine to Exception to display all the errors
		echo "<p style='color:green'>Connection Was Successful</p>";
	} catch (PDOException $err) {
		echo "<p style='color:red'>Connection Failed: " . $err->getMessage() . "</p>\r\n";
	}
	$conn->exec("DROP TABLE IF EXISTS Student;");

	$sql = "CREATE TABLE IF NOT EXISTS Student (
    SSN CHAR(9) PRIMARY KEY,
    Name VARCHAR(25),
    Start_Registration_Date DATE,
    Date_of_Birth DATE,
    Major CHAR(4),
    Minor CHAR(4),
    Message_Content VARCHAR(100),
    Advisor_EID CHAR(9)
);";

	try {
		$conn->exec($sql);
		echo "<p style='color:green'>Table Created Successfully</p>";
	} catch (PDOException $err) {
		echo "<p style='color:red'>Table Creation Failed: " . $err->getMessage() . "</p>\r\n";
	}

	// Close the connection
	unset($conn);

	echo "<a href='../index.html'>Back to the Homepage</a>";

	?>

</body>

</html>