<?php 
include('../layout/header.php');
include('../controller/Users.php');
include('../middleware.php');

$target = $_SESSION['user_data']['id'];
$sql = "SELECT * FROM users where id='$target'";
$result = $connection->query($sql);
$data = mysqli_fetch_assoc($result);

$settingspad = "SELECT * FROM settings ";
$result2 = $connection->query($settingspad);
$row = mysqli_fetch_assoc($result2);

if ($data['role'] == 'Employee') {
    if ($row['title'] == 'Users' && $row['status'] == 1) { 
        ?>
        <div class="container mt-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mt-1">Users            
                        <?php
                        if (isset($_SESSION['message'])) {
                            echo '<div id="session-message" class="badge alert-secondary">' . $_SESSION['message'] . '</div>';
                            unset($_SESSION['message']); // Clear the message after displaying it
                        }
                        ?>
                        <div class="d-flex justify-content-end" style="margin-top:-25px">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Add New User</button>&nbsp;
                            <!-- <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletedALLModal">Delete User Records</button> -->
                        </div>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover text-center" id="myTable">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Assuming $userdata is fetched correctly before this
                                if ($userdata->num_rows > 0) {
                                    while ($rowdata = $userdata->fetch_assoc()) {
                                        echo '
                                        <tr>
                                            <td>'.$rowdata['id'].'</td>
                                            <td>'.$rowdata['name'].'</td>
                                            <td>'.$rowdata['email'].'</td>
                                            <td><div class="badge alert-secondary">'.$rowdata['role'].'</div></td>';
                                            if ($rowdata['status'] == 1)
                                                echo '<td><div class="badge bg-success">Active</div></td>';
                                            else
                                                echo '<td><div class="badge bg-danger">Deactive</div></td>';
                                            echo '
                                            <td>
                                                <form action="../controller/Users.php" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this user?\');">
                                                    <button name="editbtn" data-id="'.$rowdata['id'].'" type="button" class="btn btn-secondary btn-sm editbtn" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                                    <input type="hidden" name="id" value="'.$rowdata['id'].'">
                                                    <button type="submit" name="deletebtn" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>';
                                    }
                                } 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
                            
        <!-- Add Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <!-- Your existing modal content -->
        </div>
        <!-- Add Modal End -->

        <!-- Delete All Modal -->
        <div class="modal fade" id="deletedALLModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <!-- Your existing modal content -->
        </div>
        <!-- Delete All Modal End -->

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <!-- Your existing modal content -->
        </div>
        <!-- Edit Modal End -->

        <?php include('../layout/footer.php'); ?>

        <script>
        $(document).ready(function() {
            $('#myTable').dataTable();
        });

        $(document).ready(function() {
            setTimeout(function() {
                $('#session-message').fadeOut('slow');
            }, 1000);
        });

        $(document).ready(function() {
            $('.editbtn').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '../controller/Users.php',
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        var user = JSON.parse(response);
                        $('#task-id').val(user.id);
                        $('#name').val(user.name);
                        $('#email').val(user.email);
                        $('#role').val(user.role);
                        $('#status').val(user.status);
                    }
                });
            });
        });
        </script>

        <?php 

            }
  elseif($row['title'] == 'Users' && $row['status'] == 0) {
        echo '<div class="container text-center text-danger alert alert-secondary"><h6>Page is Hide for employee accounts, by Admin</h6></div>';
        include('../layout/footer.php');
    } 
}
 else if ($data['role'] == 'Admin') {
 ?>
                        
            <div class="container mt-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mt-1">Users            
                            <?php
                                if (isset($_SESSION['message'])) {
                                    echo '<div id="session-message" class="badge alert-secondary">' . $_SESSION['message'] . '</div>';
                                    unset($_SESSION['message']); // Clear the message after displaying it
                                }
                            ?>
                            <div class="d-flex justify-content-end" style="margin-top:-25px">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">+ Add New User</button>&nbsp;
                                <!-- <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deletedALLModal">Delete User Records</button> -->
                            </div>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover text-center" id="myTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($userdata->num_rows > 0) {
                                        while($rowdata = $userdata->fetch_assoc()) {
                                            echo '
                                            <tr>
                                                <td>'.$rowdata['id'].'</td>
                                                <td>'.$rowdata['name'].'</td>
                                                <td>'.$rowdata['email'].'</td>
                                                <td><div class="badge alert-secondary">'.$rowdata['role'].'</div></td>';
                                                if($rowdata['status'] == 1)
                                                    echo '<td><div class="badge bg-success">Active</div></td>';
                                                else
                                                    echo '<td><div class="badge bg-danger">Deactive</div></td>';
                                                echo '
                                                <td>
                                                    <form action="../controller/Users.php" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this user?\');">
                                                    <button name="editbtn" data-id="'.$rowdata['id'].'" type="button" class="btn btn-secondary btn-sm editbtn" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                                        <input type="hidden" name="id" value="'.$rowdata['id'].'">
                                                        <button type="submit" name="deletebtn" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>';
                                        }
                                    } 
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="../controller/Users.php" method="POST">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" required>
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" required>
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" required>
                                <label for="role">Role</label>
                                <select name="role" class="form-control" required>
                                    <option value="">Choose User Role</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Employee">Employee</option>
                                </select>
                                <div class="modal-footer mt-4">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Modal End -->

            <!-- Delete All Modal -->
            <div class="modal fade" id="deletedALLModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Permanently Delete User Records</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="../controller/Users.php" method="POST">
                                <h6>Do you want to delete all records?</h6>
                                <div class="modal-footer mt-2">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="deleteall" class="btn btn-danger">Yes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Delete All Modal End -->

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit User Account</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="../controller/Users.php" method="POST">
                                <input type="hidden" name="id" id="task-id" class="form-control">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" required id="name">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" required id="email">
                                <label for="role">Role</label>
                                <select name="role" class="form-control" required id="role">
                                    <option value="">Choose User Role</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Employee">Employee</option>
                                </select>
                                <label for="status">Status</label>
                                <select name="status" class="form-control" required id="status">
                                    <option value="">Choose User Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                                <div class="modal-footer mt-4">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="update" class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit Modal End -->
            

            <?php include('../layout/footer.php'); ?>

            <script>
            $(document).ready(function() {
                $('#myTable').dataTable();
            });

            $(document).ready(function() {
                setTimeout(function() {
                    $('#session-message').fadeOut('slow');
                }, 1000);
            });

            $(document).ready(function() {
                $('.editbtn').on('click', function() {
                    var id = $(this).data('id');
                    $.ajax({
                        url: '../controller/Users.php',
                        type: 'POST',
                        data: { id: id },
                        success: function(response) {
                            var user = JSON.parse(response);
                            $('#task-id').val(user.id);
                            $('#name').val(user.name);
                            $('#email').val(user.email);
                            $('#password').val(user.password);
                            $('#role').val(user.role);
                            $('#status').val(user.status);
                        }
                    });
                });
            });
            </script>
                    <?php
 }
                    ?>