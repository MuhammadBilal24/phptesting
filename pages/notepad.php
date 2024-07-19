<?php 
include('../layout/header.php');
include('../controller/Notepad.php');
include('../middleware.php');

$target = $_SESSION['user_data']['id'];
$sql = "SELECT * FROM users where id='$target'";
$result = $connection->query($sql);
$data = mysqli_fetch_assoc($result);

$settingspad = "SELECT * FROM settings ";
$result2 = $connection->query($settingspad);

$notepadFound = false;
while ($row = mysqli_fetch_assoc($result2)) {
    if ($row['title'] == 'Notepad' && $row['status'] == 1) {
        $notepadFound = true;
        break;
    }
}

if ($data['role'] == 'Employee') {
    if ($notepadFound) { ?>
        <div class="container mt-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mt-1">Notepad
                        <?php
                        if (isset($_SESSION['message'])) {
                            echo '<div id="session-message" class="badge alert-secondary">' . $_SESSION['message'] . '</div>';
                            unset($_SESSION['message']); // Clear the message after displaying it
                        }
                        ?>
                        <div class="d-flex justify-content-end" style="margin-top:-25px">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addModal">+ Add Tasks</button>&nbsp;
                        </div>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover text-center" id="myTable">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Tasks</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($notepad->num_rows > 0) {
                                    while ($rowdata = $notepad->fetch_assoc()) {
                                        echo '
                                        <tr>
                                            <td>' . $rowdata['id'] . '</td>
                                            <td>' . $rowdata['task'] . '</td>';
                                        if ($rowdata['status'] == 1)
                                            echo '<td><div class="badge bg-warning">Pending</div></td>';
                                        elseif ($rowdata['status'] == 2)
                                            echo '<td><div class="badge bg-secondary">Working</div></td>';
                                        elseif ($rowdata['status'] == 3)
                                            echo '<td><div class="badge bg-primary">Starting</div></td>';
                                        elseif ($rowdata['status'] == 4)
                                            echo '<td><div class="badge bg-dark">Will Start</div></td>';
                                        elseif ($rowdata['status'] == 5)
                                            echo '<td><div class="badge bg-success">Complete</div></td>
                                                    <td><a href="../controller/Notepad.php?taskid=' . $rowdata['id'] . '"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>';
                                        if ($rowdata['status'] != 5)
                                            echo '
                                            <td class="text-center">
                                                <button type="button" class="editbtn btn btn-secondary btn-sm" data-id="' . $rowdata['id'] . '" data-bs-toggle="modal" data-bs-target="#edittaskModal">Edit</button>
                                                <a href="../controller/Notepad.php?taskid=' . $rowdata['id'] . '"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
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
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <!-- Modal content -->
        </div>
        <!-- Add Modal End -->

        <!-- Delete All Modal -->
        <div class="modal fade" id="deletedALLModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <!-- Modal content -->
        </div>
        <!-- Delete All Modal End -->

        <!-- Edit Task Modal -->
        <div class="modal fade" id="edittaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <!-- Modal content -->
        </div>
        <!-- Edit Task Modal End -->

    <?php } else {
        echo '<div class="container text-center text-danger alert alert-secondary"><h6>Page is hidden for employee accounts by Admin</h6></div>';
    }
} else if ($data['role'] == 'Admin') { ?>
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h5 class="mt-1">Notepad
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo '<div id="session-message" class="badge alert-secondary">' . $_SESSION['message'] . '</div>';
                        unset($_SESSION['message']); // Clear the message after displaying it
                    }
                    ?>
                    <div class="d-flex justify-content-end" style="margin-top:-25px">
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#addModal">+ Add Tasks</button>&nbsp;
                    </div>
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-center" id="myTable">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Tasks</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($notepad->num_rows > 0) {
                                while ($rowdata = $notepad->fetch_assoc()) {
                                    echo '
                                    <tr>
                                        <td>' . $rowdata['id'] . '</td>
                                        <td>' . $rowdata['task'] . '</td>';
                                    if ($rowdata['status'] == 1)
                                        echo '<td><div class="badge bg-warning">Pending</div></td>';
                                    elseif ($rowdata['status'] == 2)
                                        echo '<td><div class="badge bg-secondary">Working</div></td>';
                                    elseif ($rowdata['status'] == 3)
                                        echo '<td><div class="badge bg-primary">Starting</div></td>';
                                    elseif ($rowdata['status'] == 4)
                                        echo '<td><div class="badge bg-dark">Will Start</div></td>';
                                    elseif ($rowdata['status'] == 5)
                                        echo '<td><div class="badge bg-success">Complete</div></td>
                                                <td><a href="../controller/Notepad.php?taskid=' . $rowdata['id'] . '"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>';
                                    if ($rowdata['status'] != 5)
                                        echo '
                                        <td class="text-center">
                                            <button type="button" class="editbtn btn btn-secondary btn-sm" data-id="' . $rowdata['id'] . '" data-bs-toggle="modal" data-bs-target="#edittaskModal">Edit</button>
                                            <a href="../controller/Notepad.php?taskid=' . $rowdata['id'] . '"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
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
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!-- Modal content -->
    </div>
    <!-- Add Modal End -->

    <!-- Delete All Modal -->
    <div class="modal fade" id="deletedALLModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!-- Modal content -->
    </div>
    <!-- Delete All Modal End -->

    <!-- Edit Task Modal -->
    <div class="modal fade" id="edittaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!-- Modal content -->
    </div>
    <!-- Edit Task Modal End -->
<?php } ?>

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

$('.editbtn').on('click', function() {
    var id = $(this).data('id');
    $.ajax({
        url: '../controller/Notepad.php',
        type: 'POST',
        data: {
            id: id
        },
        success: function(response) {
            var task = JSON.parse(response);
            $('#taskid').val(task.id);
            $('#task').val(task.task);
            $('#status').val(task.status);
        }
    });
});
</script>
