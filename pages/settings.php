<?php 
include('../layout/header.php');
include('../controller/Dashboard.php');
include('../middleware.php');

// Fetch settings
$sql = "SELECT * FROM settings";
$result = $connection->query($sql);
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Fetch user data
$target = $_SESSION['user_data']['id'];
$sql = "SELECT * FROM users WHERE id='$target'";
$result = $connection->query($sql);
$checkingdata = mysqli_fetch_assoc($result);

// Check settings for page display logic
$settingspad = "SELECT * FROM settings";
$result2 = $connection->query($settingspad);
$settingsDisplay = false;
$hideMessage = false;

while ($settingsrow = mysqli_fetch_assoc($result2)) {
    if ($checkingdata['role'] == 'Employee') {
        if ($settingsrow['title'] == 'Settings') {
            if ($settingsrow['status'] == 1) {
                $settingsDisplay = true;
            } else {
                $hideMessage = true;
            }
            break;
        }
    } else if ($checkingdata['role'] == 'Admin') {
        $settingsDisplay = true;
        break;
    }
}
?>

<div class="container mt-2">
    <?php if ($settingsDisplay): ?>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <h6 class="card-header">Pages Section
                        <div class="d-flex justify-content-end">
                            <?php if (isset($_SESSION['pagemessage'])): ?>
                                <div id="session-message" class="badge bg-success"><?= $_SESSION['pagemessage'] ?></div>
                                <?php unset($_SESSION['pagemessage']); ?>
                            <?php endif; ?>
                        </div>
                    </h6>
                    <div class="card-body">
                        <p class="text-danger">This Changes only occurred in Employee Accounts.</p>
                        <?php foreach ($data as $row): ?>
                            <?php if ($row['section'] == 'page'): ?>
                                <form action="../controller/Settings.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="" class="form-label text-dark"><?= $row['title'] ?></label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 d-flex justify-content-end">
                                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                <input type="hidden" name="pagesupdate" value="1">Hide &nbsp
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="status<?= $row['id'] ?>" name="status" value="1" <?= $row['status'] == 1 ? 'checked' : '' ?> onchange="this.form.submit()">
                                                    <label class="form-check-label" for="status<?= $row['id'] ?>">Show</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h6 class="card-header">Content
                        <div class="d-flex justify-content-end">
                            <?php if (isset($_SESSION['contentmessage'])): ?>
                                <div id="session-message" class="badge bg-success"><?= $_SESSION['contentmessage'] ?></div>
                                <?php unset($_SESSION['contentmessage']); ?>
                            <?php endif; ?>
                        </div>
                    </h6>
                    <div class="card-body">
                            <?php foreach ($data as $row): ?>
                                <?php if ($row['section'] == ''): ?>
                                    <form action="../controller/Settings.php" method="POST">
                                        <div class="mb-3">
                                            <label for="" class="form-label"><?= $row['title'] ?></label>
                                            <input type="hidden" class="form-control" name="id" value="<?= $row['id'] ?>">
                                            <input type="text" class="form-control" name="value" value="<?= $row['value'] ?>">
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-success btn-sm" name="updatecontent" type="submit">Save Changes</button>
                                        </div>
                                    </form>
                                <?php endif; ?>
                            <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h6 class="card-header">Restore Tables
                        <div class="d-flex justify-content-end">
                            <?php if (isset($_SESSION['message'])): ?>
                                <div id="session-message" class="badge bg-danger"><?= $_SESSION['message'] ?></div>
                                <?php unset($_SESSION['message']); ?>
                            <?php endif; ?>
                        </div>
                    </h6>
                    <div class="card-body">
                        <p class="text-danger">Table Restore Permanently.</p>
                        <form action="../controller/Settings.php" method="POST">
                            <div class="row">
                                <div class="col-md-6"><label for="" class="form-label">Users</label></div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <button name="deleteall" type="submit" class="btn btn-danger btn-sm mt-2">Delete</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <form action="../controller/Settings.php" method="POST">
                            <div class="row">
                                <div class="col-md-6"><label for="" class="form-label">Notepad</label></div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <button name="deleteallnotepad" type="submit" class="btn btn-danger btn-sm mt-2">Delete</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    <?php elseif ($hideMessage): ?>
        <div class="container text-center text-danger alert alert-secondary"><h6>Page is Hidden for employee accounts, by Admin</h6></div>
    <?php endif; ?>
</div>

<?php include('../layout/footer.php'); ?>

<script>
$(document).ready(function() {
    setTimeout(function() {
        $('#session-message').fadeOut('slow');
    }, 1000);
});
</script>
