<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card">

                <div class="card-header">

                    <h3>Add Student</h3>

                </div>

                <div class="card-body">

                    <?php

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        // Get form data
                        $fullName = trim($_POST["full_name"]);
                        $email = trim($_POST["email"]);
                        $department = trim($_POST["department"]);

                        // Check empty fields
                        if (
                            empty($fullName) ||
                            empty($email) ||
                            empty($department)
                        ) {

                            echo '<div class="alert alert-danger">
                                    All fields are required.
                                  </div>';

                        } 
                        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                            echo '<div class="alert alert-danger">
                                    Please enter a valid email address.
                                  </div>';

                        } 
                        else {

                            // Connect to database
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

                            // Prepared statement
                            $stmt = $conn->prepare(
                                "INSERT INTO students
                                (full_name, email, department)
                                VALUES (?, ?, ?)"
                            );

                            // Bind values
                            $stmt->bind_param(
                                "sss",
                                $fullName,
                                $email,
                                $department
                            );

                            // Execute
                            if ($stmt->execute()) {

                                echo '<div class="alert alert-success">
                                        Student added successfully!
                                      </div>';

                            } 
                            else {

                                echo '<div class="alert alert-danger">
                                        Error: ' .
                                        $stmt->error .
                                        '</div>';
                            }

                            // Close statement
                            $stmt->close();

                            // Close connection
                            $conn->close();
                        }
                    }

                    ?>

                    <form method="POST">

                        <!-- Full Name -->

                        <div class="mb-3">

                            <label class="form-label">
                                Full Name
                            </label>

                            <input
                                type="text"
                                name="full_name"
                                class="form-control"
                                placeholder="Enter full name"
                                required
                            >

                        </div>


                        <!-- Email -->

                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="Enter email"
                                required
                            >

                        </div>


                        <!-- Department -->

                        <div class="mb-3">

                            <label class="form-label">
                                Department
                            </label>

                            <input
                                type="text"
                                name="department"
                                class="form-control"
                                placeholder="Enter department"
                                required
                            >

                        </div>


                        <!-- Buttons -->

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Save Student
                        </button>

                        <button
                            type="reset"
                            class="btn btn-secondary"
                        >
                            Clear
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>