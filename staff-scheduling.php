<?php
include 'backend/staff_schedules.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Scheduling</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>



    <style>
        .modal-body {
            max-height: 70vh;
            overflow-y: auto;
        }

        .btn-primary {
            position: relative;
            z-index: 1000;
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-3">
                <?php include 'includes/sidebar.php'; ?>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 p-4">
                <h2>Staff Scheduling </h2><br>

                <div class="col-md-6 mb-3">
                    <select class="form-control" id="user_id" name="user_id" required>
                        <option value="">Select Customer</option>
                        <?php
                        include 'connect.php';

                        // Fetch users
                        $sql = "SELECT user_id, full_name FROM users";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['user_id'] . "'>" . $row['full_name'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="row">
                    <table id="staffTable" class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Staff Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Assigned Services</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($data['schedules'])) {
                                foreach ($data['schedules'] as $row):
                            ?>
                                    <tr>
                                        <td><?php echo $row['scheduleID']; ?></td>
                                        <td><?php echo $row['fullname']; ?></td>
                                        <td><?php echo $row['date']; ?></td>
                                        <td><?php echo $row['start_time'] . ' - ' . $row['end_time']; ?></td>
                                        <td><?php echo $row['status']; ?></td>
                                        <td><?php echo $row['assigned_services']; ?></td>
                                    </tr>
                            <?php
                                endforeach;
                            } else {
                                echo '<tr><td colspan="7" class="text-center">There is no schedule staff</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>



        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


        <!-- Bootstrap JS (make sure this is included before your closing </body> tag) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


        <script>
            //Data Table
            $(document).ready(function() {
                // Initialize the table with DataTables
                var table = $('#staffTable').DataTable({
                    "lengthChange": false,
                    "info": false,
                    "language": {
                        "emptyTable": "There is no schedule staff available." // Custom message for empty table
                    }
                });
            });
        </script>
</body>