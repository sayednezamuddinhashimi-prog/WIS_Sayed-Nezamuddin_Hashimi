<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Database</title>

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-5">

    <div class="card">

        <div class="card-header">
            <h3>Create Database</h3>
        </div>

        <div class="card-body">

            <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                // Get database name
                $databaseName = trim($_POST["database_name"]);

                // Connect to MySQL
                $conn = new mysqli("localhost", "root", "");

                // Check connection
                if ($conn->connect_error) {

                    echo '<div class="alert alert-danger">
                            Connection failed: ' . $conn->connect_error . '
                          </div>';

                } 
                else {

                    // Validate database name
                    if (!preg_match("/^[a-zA-Z0-9_]+$/", $databaseName)) {

                        echo '<div class="alert alert-danger">
                                Invalid database name.
                                Use only letters, numbers, and underscores.
                              </div>';

                    } 
                    else {

                        // Create database
                        $sql = "CREATE DATABASE `$databaseName`";

                        // Execute query
                        if ($conn->query($sql) === TRUE) {

                            echo '<div class="alert alert-success">
                                    Database <strong>' . htmlspecialchars($databaseName) . '</strong>
                                    created successfully!
                                  </div>';

                        } 
                        else {

                            echo '<div class="alert alert-danger">
                                    Error: ' . $conn->error . '
                                  </div>';
                        }
                    }

                    // Close connection
                    $conn->close();
                }
            }

            ?>

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Database Name
                    </label>

                    <input
                        type="text"
                        name="database_name"
                        class="form-control"
                        placeholder="Enter database name"
                        required
                    >

                </div>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Create Database
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>