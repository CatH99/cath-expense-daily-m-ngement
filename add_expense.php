<?php
include('session.php');
$update = false;
$delete = false;

$expensevalue = "";
$expensedate = date("Y-m-d");
$expensecategory = "entertainment";

if (isset($_POST['add'])) {
    $expensevalue = mysqli_real_escape_string($conn, $_POST['expensevalue']);
    $expensedate = mysqli_real_escape_string($conn, $_POST['expensedate']);
    $expensecategory = mysqli_real_escape_string($conn, $_POST['expensecategory']);

    $expense = "INSERT INTO `expense`(`ID`,`expensevalue`,`expensedate`,`expensecategory`) VALUES('$username','$expensevalue','$expensedate','$expensecategory') ";
    print_r($expense);
    $result = mysqli_query($conn, $expense);

    if ($result) {
        header('location:manage_expense.php');
    } else {
        die("error:Could not found");
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['edit'];
    $expensevalue = $_POST['expensevalue'];
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];

    $sql = "UPDATE expense SET expensevalue='$expensevalue', expensedate='$expensedate', expensecategory='$expensecategory' WHERE ID='$username' AND expense_id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Records were updated successfully.";
    } else {
        echo "ERROR: Could not able to execute. ";
    }
    header('location: manage_expense.php');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($conn, "SELECT * FROM expense WHERE ID='$username' AND expense_id=$id");
    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $expensevalue = $n['expensevalue'];
        $expensedate = $n['expensedate'];
        $expensecategory = $n['expensecategory'];
    } else {
        echo ("WARNING: AUTHORIZATION ERROR: Trying to Access Unauthorized data");
    }
}

if (isset($_POST['delete'])) {
    $id = $_GET['delete'];
    $expensevalue = $_POST['expensevalue'];
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];

    $sql = "DELETE FROM expense WHERE ID='$username' AND expense_id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Records were updated successfully.";
    } else {
        echo "ERROR: Could not able to execute. ";
    }
    header('location: manage_expense.php');
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = true;
    $record = mysqli_query($conn, "SELECT * FROM expense WHERE ID='$username' AND expense_id=$id");

    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $expensevalue = $n['expensevalue'];
        $expensedate = $n['expensedate'];
        $expensecategory = $n['expensecategory'];
    } else {
        echo ("WARNING: AUTHORIZATION ERROR: Trying to Access Unauthorized data");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Expense Manager - Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="index/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="index/css/style.css" rel="stylesheet">

    <!-- Feather JS for Icons -->
    <script src="index/js/feather.min.js"></script>

</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper">
            <div class="user">
                <!-- <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="120"> -->
                <h5>
                    <?php echo $username ?>
                </h5>
                <p>
                    <?php echo $useremail ?>
                </p>
            </div>
            <div class="sidebar-heading">Management</div>
            <div class="list-group list-group-flush">
                <a href="index.php" class="list-group-item list-group-item-action"><span data-feather="home"></span>
                    Dashboard</a>
                <a href="add_expense.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="plus-square"></span> Add Expenses</a>
                <a href="manage_expense.php" class="list-group-item list-group-item-action"><span data-feather="dollar-sign"></span> Manage Expenses</a>
            </div>
            <div class="sidebar-heading">Settings </div>
            <div class="list-group list-group-flush">
                <a href="profile.php" class="list-group-item list-group-item-action "><span data-feather="user"></span>
                    Profile</a>
                <a href="logout.php" class="list-group-item list-group-item-action "><span data-feather="power"></span>
                    Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light  border-bottom">


                <button class="toggler" type="button" id="menu-toggle" aria-expanded="false">
                    <span data-feather="menu"></span>
                </button>
            </nav>

            <div class="container-fluid">
                <h3 class="mt-4 text-center">Add Your Daily Expenses</h3>
                <hr>
                <div class="row ">

                    <div class="col-md-3"></div>

                    <div class="col-md" style="margin:0 auto;">
                        <form method="POST">
                            <div class="form-group row">
                                <label for="expensevalue" class="col-sm-6 col-form-label"><b>Enter Amount(vnd)</b></label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control col-sm-12" value="<?php echo $expensevalue  ?>" id="expensevalue" name="expensevalue" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="expensedate" class="col-sm-6 col-form-label"><b>Date</b></label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control col-sm-12" value="<?php echo $expensedate  ?>" name="expensedate" id="expensedate" required>
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-6 pt-0"><b>Category</b></legend>
                                    <div class="col-md">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory0" value="Earn" <?php echo ($expensecategory == 'Earn') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory5">
                                                Earns
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory1" value="Medicine" <?php echo ($expensecategory == 'Medicine') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory4">
                                                Medicine
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory2" value="Food" <?php echo ($expensecategory == 'Food') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory3">
                                                Food
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory3" value="Entertainment" <?php echo ($expensecategory == 'Entertainment') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory1">
                                                Entertainment
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory4" value="Clothings" <?php echo ($expensecategory == 'Clothings') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory7">
                                                Clothings
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory5" value="Education" <?php echo ($expensecategory == 'Education') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory6">
                                                Education
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory6" value="Others" <?php echo ($expensecategory == 'Others') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory5">
                                                Others
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-md-12 text-right">
                                    <?php if ($update == true) : ?>
                                        <button class="btn btn-lg btn-block btn-warning" style="border-radius: 0%;" type="submit" name="update">Update</button>
                                    <?php elseif ($delete == true) : ?>
                                        <button class="btn btn-lg btn-block btn-danger" style="border-radius: 0%;" type="submit" name="delete">Delete</button>
                                    <?php else : ?>
                                        <button type="submit" name="add" class="btn btn-lg btn-block btn-success" style="border-radius: 0%;">Add Expense</button>
                                    <?php endif ?>
                                </div>
                            </div>



                        </form>
                    </div>

                    <div class="col-md-3"></div>

                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="index/js/jquery.slim.min.js"></script>
    <script src="index/js/bootstrap.min.js"></script>
    <script src="index/js/Chart.min.js"></script>
    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <script>
        feather.replace();
    </script>
    <script>

    </script>
</body>

</html>