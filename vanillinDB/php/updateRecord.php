<!doctype html>
<!-- (C) Saeed Mirjalili -->
<html>

<head>
    <title>Update a record of a table</title>
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
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<p style='color:green'>Connection Was Successful</p>";
    } catch (PDOException $err) {
        echo "<p style='color:red'> Connection Failed: " . $err->getMessage() . "</p>\r\n";
    }

    try {
        $checkSql = "SELECT SSN FROM Student WHERE SSN = :ssn";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bindParam(':ssn', $_POST['ssn']);
        $checkStmt->execute();

        if ($checkStmt->rowCount() === 0) {
            echo "<p style='color:red'>Record not found. Cannot Update.</p>\r\n";
        } else {
        $updateSql = "UPDATE Student SET Major = :major, Minor = :minor, Message_Content = :message WHERE SSN = :ssn";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bindParam(':ssn', $_POST['ssn']);
        $updateStmt->bindParam(':major', $_POST['major']);
        $updateStmt->bindParam(':minor', $_POST['minor']);
        $updateStmt->bindParam(':message', $_POST['message_content']);
        $updateStmt->execute();
        echo "<p style='color:green'>Student record updated successfully.</p>";
    }
    } catch (PDOException $err) {
        echo "<p style='color:red'>Record Update Failed: " . $err->getMessage() . "</p>\r\n";
    }
    // Close the connection
    unset($conn);

    echo "<a href='../index.html'>Back to the Homepage</a>";

    ?>
</body>

</html>