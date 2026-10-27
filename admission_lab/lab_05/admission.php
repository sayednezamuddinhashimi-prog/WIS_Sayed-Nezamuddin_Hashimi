<?php

require_once "db.php";


// ==========================================
// SAVE APPLICATION
// ==========================================

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get values from the form
    $full_name = trim($_POST["full_name"] ?? "");
    $father_name = trim($_POST["father_name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $program = trim($_POST["program"] ?? "");


    // Check required fields
    if (
        empty($full_name) ||
        empty($father_name) ||
        empty($email) ||
        empty($phone) ||
        empty($program)
    ) {
        die("All fields are required.");
    }


    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Please enter a valid email address.");
    }


    // Prepared statement
    $stmt = $conn->prepare(
        "INSERT INTO applications 
        (full_name, father_name, email, phone, program)
        VALUES (?, ?, ?, ?, ?)"
    );


    $stmt->bind_param(
        "sssss",
        $full_name,
        $father_name,
        $email,
        $phone,
        $program
    );


    // Execute
    if ($stmt->execute()) {

        // Redirect after successful registration
        header("Location: admission.php");
        exit;

    } else {

        die("Error saving application: " . $stmt->error);
    }

    $stmt->close();
}


// ==========================================
// GET ALL APPLICATIONS
// ==========================================

$result = $conn->query(
    "SELECT * FROM applications ORDER BY id DESC"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Admission Application</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body>

<div class="container mt-5">

    <!-- ==========================================
         ADMISSION FORM
         ========================================== -->

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h2 class="text-center mb-0">
                Student Admission Application
            </h2>

        </div>


        <div class="card-body">

            <form method="post">


                <!-- Full Name -->

                <div class="mb-3">

                    <label for="full_name" class="form-label">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="full_name"
                        id="full_name"
                        class="form-control"
                        required
                    >

                </div>


                <!-- Father's Name -->

                <div class="mb-3">

                    <label for="father_name" class="form-label">
                        Father's Name
                    </label>

                    <input
                        type="text"
                        name="father_name"
                        id="father_name"
                        class="form-control"
                        required
                    >

                </div>


                <!-- Email -->

                <div class="mb-3">

                    <label for="email" class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control"
                        required
                    >

                </div>


                <!-- Phone -->

                <div class="mb-3">

                    <label for="phone" class="form-label">
                        Phone
                    </label>

                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        class="form-control"
                        required
                    >

                </div>


                <!-- Program -->

                <div class="mb-3">

                    <label for="program" class="form-label">
                        Program
                    </label>

                    <select
                        name="program"
                        id="program"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Select Program
                        </option>

                        <option value="Information Systems">
                            Information Systems
                        </option>

                        <option value="Software Engineering">
                            Software Engineering
                        </option>

                        <option value="Computer Science">
                            Computer Science
                        </option>

                    </select>

                </div>


                <!-- Submit Button -->

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Submit Application
                </button>

            </form>

        </div>

    </div>


    <!-- ==========================================
         APPLICATION TABLE
         ========================================== -->

    <div class="mt-5">

        <h2 class="mb-3">
            Submitted Applications
        </h2>


        <div class="table-responsive">

            <table class="table table-bordered table-striped table-hover">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Father's Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Program</th>

                    </tr>

                </thead>


                <tbody>

                    <?php if ($result && $result->num_rows > 0): ?>

                        <?php while ($row = $result->fetch_assoc()): ?>

                            <tr>

                                <td>
                                    <?= htmlspecialchars($row["id"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($row["full_name"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($row["father_name"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($row["email"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($row["phone"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($row["program"]) ?>
                                </td>

                            </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="6" class="text-center">
                                No applications submitted yet.
                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>

</html>
