<?php
include('config/database.php');
// include('middleware.php');

// url redirect on dashboard page when session is on
if (isset($_SESSION['is_user_loggedin']) && $_SESSION['is_user_loggedin'] === true) {
    // Redirect to dashboard if the user is logged in
    header('Location: pages/dashboard.php');
    exit();
}

// Checking
if(isset($_POST['loginbtn']))
{
    extract ($_POST);
    $pass= md5($password);
    $sql = "SELECT * FROM users where email = '$email' AND password = '$pass' ";
    $result = $connection->query($sql);
    if($result->num_rows)
    {
        $_SESSION['is_user_loggedin'] = true;
        $_SESSION['user_data'] = mysqli_fetch_assoc($result);
        $_SESSION['message'] = "Welcome";
        header('Location: pages/dashboard.php');
    }
    else
    {
        $_SESSION['message'] = "Invalid Data"; 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP TESTING</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
        integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">

</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4 mt-3">
                <div class="card mt-4">
                    <h6 class="card-header">Login
                    <div class=" d-flex justify-content-end">
                        <?php if(isset($_SESSION['message'])){
                            echo '<div style="margin-top:-20px" id="session-message" class="badge bg-danger">'.$_SESSION['message'].'</div>';
                            unset($_SESSION['message']);
                        }
                         ?>
                        </div>
                    </h6>
                    <div class="mt-3 d-flex justify-content-center">
                            <img src="assets/logo.png" alt="">
                        </div>  
                    <div class="card-body">
                        <form action="login.php" method="POST">
                            <label for="" class="form-label">Email Address</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email address">
                            <label for="" class="mt-3 form-label">Password</label>
                            <div class="input-group">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                <button class="btn btn-secondary" type="button" id="togglePassword">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                            <button type="submit" name="loginbtn" class="btn btn-warning form-control mb-2 mt-4">Sign In</button>
                            <div class="text-center mt-2"><p>want to create Account? <a href="auth/register.php" class="text-dark">Register Now</a></p></div>
                        </form>
                    </div>
                    <div class="d-flex justify-content-center mb-4 text-muted">Developed by&nbsp
                        <img src="assets/bdlogo.png" alt="" style="width:150px">
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function() {
    setTimeout(function() {
        $('#session-message').fadeOut('slow');
    }, 2000);
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const icon = togglePassword.querySelector('i');

        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle the icon
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    });
</script>

</body>

</html>