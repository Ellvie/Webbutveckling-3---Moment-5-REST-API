<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
    //Connect to database
    include("includes/config.php");

    $db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
    if($db->connect_errno > 0) {
        die('Fel vid anslutning [' . $db->connect_error . ']');
    }

    //Create table: name
    $sql = "DROP TABLE IF EXISTS courses;
                CREATE TABLE courses(
                    id int NOT NULL AUTO_INCREMENT,
                    name VARCHAR(255) NOT NULL,
                    code VARCHAR(16) NOT NULL,
                    progression VARCHAR(16) NOT NULL,
                    syllabus VARCHAR(255) NOT NULL,
                    PRIMARY KEY (id)
                );
            ";

    //Insert test data
    $sql .= "
            INSERT INTO courses(name, code, progression, syllabus) VALUES('Webbutveckling 3', 'DT173G', 'B', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=21873');
    ";

    //Print
    echo "<pre>$sql</pre>";

    //Send SQL to database
    if($db->multi_query($sql)) {
        echo "<p>Installation klar.</p>";
    }
    else {
        echo "<p>Fel vid installation.</p>";
    }
?>

</body>
</html>