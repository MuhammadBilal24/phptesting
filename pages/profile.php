<?php include('../layout/header.php');
      include ('../config/database.php');
    include('../middleware.php');
    ?>

<?php
        $target= $_SESSION['user_data']['id'];
        $sql="SELECT * FROM users where id='$target'";
        $result = $connection->query($sql);
        $data = mysqli_fetch_assoc($result);
        ?>
<div class="container mt-3">
    <div class="card container">
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="">
                    <!-- <h6 class="card-header">Profile Picture</h6> -->
                    <div class="card-body text-center">
                        <?php
                        if($data['image'] > 0)
                            echo '<img src="../'.$data['image'].'" alt="" style="width:200px">';
                        else
                            echo '<img src="../assets/user.png" alt="" style="width:200px">';
                        ?>
                        <form action="../controller/Profile.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" id="id" name="id"
                                value="<?php echo $data['id'];?>">
                            <input type="file" class="mt-4" name="image">
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <h6 class="card-header">Profile Details</h6>
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <?php
                            if(isset($_SESSION['message']))
                            {
                                echo '<div id="session-message" class="badge bg-success">'. $_SESSION['message'].'</div>';
                                unset($_SESSION['message']);
                            }
                        ?>
                    </div>
                    <label for="" class="form-label">Username</label>
                    <input type="text" name="name" id="" class="form-control" value="<?php echo $data['name'];?>">
                    <label for="" class="form-label">Email Address</label>
                    <input type="text" name="email" id="" class="form-control" value="<?php echo $data['email'];?>">
                    <label for="" class="form-label">Role</label>
                    <input type="text" readonly name="role" id="" class="form-control"
                        value="<?php echo $data['role'];?>">
                    <label for="" class="form-label">Status</label>
                    <?php 
                            if ($data['status'] == 1) {
                                echo '<input type="text" readonly name="" id="" class="form-control text-success" value="Active">';
                            } else {
                                echo '<input type="text" readonly name="" id="" class="form-control text-danger" value="Deactive">';
                            }
                            ?>
                    <div class="d-flex justify-content-end mt-4">
                        <button class="btn btn-success " type="submit" name="update">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../layout/footer.php');?>
<script>
$(document).ready(function() {
    setTimeout(function() {
        $('#session-message').fadeOut('slow');
    }, 1000);
});
</script>