<?php 
    include('../layout/header.php');
    include('../controller/Dashboard.php');
    include('../middleware.php');
?>
<!-- Cards -->
<section>
    <div class="container">
        <!-- <div class="row py-2">
            <div class="col-md-6 mt-2" style="text-align-center">
                <h3 style="color:#003366">Php Learning Project</h3>
                <h6 class="text-muted">Developed By Muhammad Bilal</h6>
            </div>
            <div class="col-md-6 d-flex justify-content-end py-4">
                <button class="btn btn-secondary">Profile</button>&nbsp
                <button class="btn btn-warning">Records</button>
            </div>
        </div> -->
        <div class="row py-4">
            <div class="col-xl-3 col-lg-3">
                <div class="card l-bg-blue-dark">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">User Accounts</h5>
                        </div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    <?php
                                        // Query to count users
                                        $sql = "SELECT COUNT(*) as user_count FROM users where role= 'employee'";
                                        $result = $connection->query($sql);
                                        if ($result) {
                                            $row = $result->fetch_assoc();
                                            $user_count = $row['user_count'];
                                            echo $user_count;
                                        }
                                    ?>
                                </h2>
                            </div>
                            <div class="col-4 text-right">
                                <span></span>
                            </div>
                        </div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $user_count?>%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3">
                <div class="card l-bg-cherry">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">Admin Accounts</h5>
                        </div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    <?php
                                        // Query to count users
                                        $sql = "SELECT COUNT(*) as user_count FROM users where role= 'Admin'";
                                        $result = $connection->query($sql);
                                        if ($result) {
                                            $row = $result->fetch_assoc();
                                            $user_count = $row['user_count'];
                                            echo $user_count;
                                        }
                                    ?>
                                </h2>
                            </div>
                            <div class="col-4 text-right">
                                <span></span>
                            </div>
                        </div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $user_count?>%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3">
                <div class="card l-bg-green-dark">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">Remaining Tasks</h5>
                        </div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    <?php
                                        // Query to count users
                                        $sql = "SELECT COUNT(*) as task_count FROM notepad where status <= 4 ";
                                        $result = $connection->query($sql);
                                        if ($result) {
                                            $row = $result->fetch_assoc();
                                            $task_count = $row['task_count'];
                                            echo $task_count;
                                        }
                                    ?>
                                </h2>
                            </div>
                            <div class="col-4 text-right">
                                <span></span>
                            </div>
                        </div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $task_count?>%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3">
                <div class="card l-bg-orange-dark">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">Complete Tasks</h5>
                        </div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    <?php
                                        // Query to count users
                                        $sql = "SELECT COUNT(*) as task_count FROM notepad where status = 5";
                                        $result = $connection->query($sql);
                                        if ($result) {
                                            $row = $result->fetch_assoc();
                                            $task_count = $row['task_count'];
                                            echo $task_count;
                                        }
                                    ?>
                                </h2>
                            </div>
                            <div class="col-4 text-right">
                                <span></span>
                            </div>
                        </div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $task_count?>%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Cards End-->


<!-- Second  -->
<section class="container">
    <div class="row">
        <div class="container col-md-8">
            <div class="card">
                <h5 class="mt-3">&nbsp &nbsp Remaining Tasks
                    <?php
                        if(isset($_SESSION['message']))
                        {
                            echo'<div class="badge bg-info" id="session-message">
                                '.$_SESSION['message'].'</div>';
                                unset($_SESSION['message']);
                        }
                    ?>
                    <div class="d-flex d-grid justify-content-end" style="margin-top:-25px; margin-right:15px">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">+Add
                            Tasks</button>
                    </div>
                </h5>
                <div class="card-body" style="margin-top:-18px">
                    <?php
                    if(isset($_GET['id']))
                    {
                        $id = $_GET['id'];
                        $sql= "SELECT * FROM notepad where id = $id";
                        $res = $connection->query($sql);
                        $notepadID= mysqli_fetch_assoc($res);
                        if($notepadID)
                        {
                            echo' <form ction="../controller/Dashboard.php"  method="POST">
                            <input type="hidden" name="id" id="id" value="'.$notepadID['id'] .'">
                            <input type="hidden" name="status" id="status" value="5">
                            <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-warning" name="checked">Completed ?</button>
                            </div>
                            </form>';
                        }
                    }                    
                    ?>
                    <table id="" class="table table-hover">
                        <thead class="bg-light">
                            <tr>
                                <td>Tasks</td>
                                <td>Status</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while($value=$taskdata->fetch_assoc())
                            {
                                echo'
                            <tr>
                                <td>'.$value['task'].'</td>
                                <td>';
                                    if($value['status'] == 1)
                                       echo' <div class="badge bg-warning">Pending</div>';
                                    elseif($value['status'] == 2)
                                       echo' <div class="badge bg-secondary">Working</div>';
                                    elseif($value['status'] == 3)
                                       echo' <div class="badge bg-primary">Starting</div>';
                                    elseif($value['status'] == 4)
                                       echo' <div class="badge bg-dark">Will Start</div>';
                                    elseif($value['status'] == 5)
                                       echo' <div class="badge bg-success">Complete</div>';
                                echo'</td>
                                <td class="text-center">
                                    <a href="../pages/dashboard.php?id='.$value['id'].'">
                                    <button class="btn btn-success btn-sm"><i class="fa fa-check"></i></button></a>
                                </td>
                            </tr>
                            ';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-dark text-white">
                <img src="../assets/head.jpg" class="card-img" alt="...">
                <div class="card-img-overlay">
                <?php
                $sql= "SELECT * FROM settings where title= 'dash_card'";
                $result= $connection->query($sql);
                $resultdata = mysqli_fetch_assoc($result); 
                ?>
                <?php 
                    // Proper comparison to check if title equals 'dash_card'
                    if(isset($resultdata['title']) && $resultdata['title'] == 'dash_card') {
                        echo '
                       <h5 class="card-title">Php Core</h5>
                        <p class="card-text text-light">'.$resultdata['value'].'</p>
                        <p class="card-text">Last updated 3 mins ago</p>
                    '; 
                    } else {
                        echo '<p>No data available for the given title.</p>';
                    }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Second Ends -->

<!--  Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Tasks</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../controller/Dashboard.php" method="POST">
                    <label for="">Task</label>
                    <input type="text" name="task" class="form-control" required>
                    <label for="">Status</label>
                    <select name="status" id="" class="form-control" required>
                        <option value="">Choose status</option>
                        <option value="2">Working</option>
                        <option value="1">Pending</option>
                        <option value="3">Starting</option>
                        <option value="4">Will Start</option>
                        <option value="5">Complete</option>
                    </select>
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="insert" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Modal Ends -->
<?php include ('../layout/footer.php');?>
<script>
$(document).ready(function() {
    setTimeout(function() {
        $('#session-message').fadeOut('slow');
    }, 1000);
});
</script>