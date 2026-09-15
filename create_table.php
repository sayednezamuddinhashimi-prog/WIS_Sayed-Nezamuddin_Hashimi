<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Students Table</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-5">

    <div class="card">

        <div class="card-header">
            <h3>Create Students Table</h3>
        </div>

        <div class="card-body">

            <?php

            // Connect to wis_lab database
            $conn = new mysqli(
                "localhost",
                "root",
                "",
                "wis_lab"
            );

            // Check connection
            if ($conn->connect_error) {

                die(
                    "Connection failed: " .
                    $conn->connect_error
                );
            }

            // Create students table
            $sql = "CREATE TABLE students (

                id INT PRIMARY KEY AUTO_INCREMENT,

                full_name VARCHAR(100) NOT NULL,

                email VARCHAR(120) NOT NULL,

                department VARCHAR(80) NOT NULL,

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

            )";

            // Execute query
            if ($conn->query($sql) === TRUE) {

                echo '<div class="alert alert-success">
                        Students table created successfully!
                      </div>';

            } 
            else {

                echo '<div class="alert alert-danger">
                        Error creating table: ' .
                        $conn->error .
                        '</div>';
            }

            // Close connection
            $conn->close();

            ?>

        </div>

    </div>

</div>

</body>
</html>