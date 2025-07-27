<!doctype html>
<!-- (C) Saeed Mirjalili -->
<html>

<head>
    <title>Display Records of a table</title>
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
    $sql = "SELECT SSN, Name, Start_Registration_Date, Date_of_Birth, Major, Minor, Message_Content, Advisor_EID FROM Student WHERE Name LIKE :namePrefix";

    $stmnt = $conn->prepare($sql);
    $namePrefix = $_POST['sname'] . '%'; // append % for LIKE query
    $stmnt->bindParam(':namePrefix', $namePrefix);
    $stmnt->execute();

        $row = $stmnt->fetch();  // fetches the first row of the table
        if ($row) {
            echo '<table>';
            echo '<tr> <th>SSN</th> <th>Name</th> <th>Start Registration Date</th> <th>Date of Birth</th> <th>Major</th> <th>Minor</th> <th>Message</th> <th>Advisor EID</th> </tr>'; 
            do {
                echo "<tr> <td>$row[SSN]</td> <td>$row[Name]</td> <td>$row[Start_Registration_Date]</td> <td>$row[Date_of_Birth]</td> <td>$row[Major]</td> <td>$row[Minor]</td> <td>$row[Message_Content]</td> <td>$row[Advisor_EID]</td> </tr>";
            } 
            while ($row = $stmnt->fetch());
            echo '</table>';
        } else {
            echo "<p> No Record Found!</p>";
        }
    } catch (PDOException $err) {
        echo "<p style='color:red'>Record Retrieval Failed: " . $err->getMessage() . "</p>\r\n";
    }
    // Close the connection
    unset($conn);

    echo "<a href='../index.html'>Back to the Homepage</a>";

    ?>
</body>

</html>