<?php
include('session.php');
$exp_category_dc = mysqli_query($conn, "SELECT expensecategory FROM expense WHERE ID = '$username' AND expensecategory != 'Earn' GROUP BY expensecategory");
$value_dc = "SELECT SUM(expensevalue) FROM expense WHERE ID = '$username' AND expensecategory != 'Earn' GROUP BY expensecategory";
$exp_value_dc = $conn->query($value_dc);

$exp_date_line = mysqli_query($conn, "SELECT expensedate FROM expense WHERE ID = '$username' AND expensecategory != 'Earn' GROUP BY expensedate");
$value_line = "SELECT SUM(expensevalue) FROM expense WHERE ID = '$username' AND expensecategory != 'Earn' GROUP BY expensedate";
$exp_value_line = $conn->query($value_line);


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
  <style>
    .card a {
      color: #000;
      font-weight: 500;
    }

    .card a:hover {
      color: #4f048d;
      text-decoration: dotted;
    }
  </style>

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
        <h5>
          <?php echo $useremail ?>
        </h5>
      </div>
      <div class="sidebar-heading">Management</div>
      <div class="list-group list-group-flush">
        <a href="index.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="home"></span> Dashboard</a>
        <a href="add_expense.php" class="list-group-item list-group-item-action "><span data-feather="plus-square"></span> Add Expenses</a>
        <a href="manage_expense.php" class="list-group-item list-group-item-action "><span data-feather="dollar-sign"></span> Manage Expenses</a>
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
        <h3 class="mt-4">Dashboard</h3>
        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col text-center">
                    <a href="add_expense.php"><img src="index/icon/add.png" width="57px" />
                      <p>Add Expenses</p>
                    </a>
                  </div>
                  <div class="col text-center">
                    <a href="manage_expense.php"><img src="index/icon/manage.png" width="57px" />
                      <p>Manage Expenses</p>
                    </a>
                  </div>
                  <div class="col text-center">
                    <a href="profile.php"><img src="index/icon/profile.png" width="57px" />
                      <p>User Profile</p>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <h3 class="mt-4">Full-Expense Report</h3>
        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Yearly Expenses</h5>
              </div>
              <div class="card-body">
                <canvas id="expense_line" height="150"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Expense Category</h5>
              </div>
              <div class="card-body">
                <canvas id="expense_category_pie" height="150"></canvas>
              </div>
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Income and Expense infomation</h5>
              </div>
              <?php
              //Tong income
              $sqlearn = "SELECT SUM(expensevalue) FROM expense WHERE ID='$username' and expensecategory='Earn'";
              $resultearn = $conn->query($sqlearn);

              //Tong expense
              $sqlspent = "SELECT SUM(expensevalue) FROM expense WHERE ID='$username' and expensecategory != 'Earn'";
              $resultspent = $conn->query($sqlspent);

              //Tong tien medicine
              $sqlmedicine = "SELECT SUM(expensevalue) FROM expense WHERE ID='$username' and expensecategory = 'Medicine'";
              $resultmedicine = $conn->query($sqlmedicine);

              //Tong tien food
              $sqlfood = "SELECT SUM(expensevalue) FROM expense WHERE ID='$username' and expensecategory = 'Food'";
              $resultfood = $conn->query($sqlfood);

              //Tong tien entertainment
              $sqlenter = "SELECT SUM(expensevalue) FROM expense WHERE ID='$username' and expensecategory = 'Entertainment'";
              $resultenter = $conn->query($sqlenter);

              //Tong tien Clothings
              $sqlcloth = "SELECT SUM(expensevalue) FROM expense WHERE ID='$username' and expensecategory = 'Clothings'";
              $resultcloth = $conn->query($sqlcloth);

              //Tong tien Education
              $sqledu = "SELECT SUM(expensevalue) FROM expense WHERE ID='$username' and expensecategory = 'Education'";
              $resultedu = $conn->query($sqledu);

              //Tong tien khac
              $sqlothers = "SELECT SUM(expensevalue) FROM expense WHERE ID='$username' and expensecategory = 'Others'";
              $resultothers = $conn->query($sqlothers);

              // print_r($resultspent);
              //print_r($resultearn);
              while ($rowspent = mysqli_fetch_array($resultspent) and $rowearn = mysqli_fetch_array($resultearn) and $rowmedicine = mysqli_fetch_array($resultmedicine)
              and $rowfood = mysqli_fetch_array($resultfood) and $rowenter = mysqli_fetch_array($resultenter) and $rowcloth = mysqli_fetch_array($resultcloth) 
              and $rowedu = mysqli_fetch_array($resultedu) and $rowothers = mysqli_fetch_array($resultothers))  { ?>
                <div class="card-body">
                  <table class="table table-hover table-bordered">
                    <thead>
                      <tr class="text-center">
                        <th>Category</th>
                        <th>Value</th>
                      </tr>
                    </thead>
                    <tr>
                      <td>Income</td>
                      <td><?php echo $rowearn['SUM(expensevalue)'] . " VND"; ?></td>
                    </tr>
                    <tr>
                      <td>Exspense</td>
                      <td><?php echo $rowspent['SUM(expensevalue)'] . " VND"; ?></td>
                    </tr>
                    <tr>
                      <td>Medicine</td>
                      <td><?php echo $rowmedicine['SUM(expensevalue)'] . " VND"; ?></td>
                    </tr>
                    <tr>
                      <td>Food</td>
                      <td><?php echo $rowfood['SUM(expensevalue)'] . " VND"; ?></td>
                    </tr>
                    <tr>
                      <td>Entertainment</td>
                      <td><?php echo $rowenter['SUM(expensevalue)'] . " VND"; ?></td>
                    </tr>
                    <tr>
                      <td>Clothings</td>
                      <td><?php echo $rowcloth['SUM(expensevalue)'] . " VND"; ?></td>
                    </tr>
                    <tr>
                      <td>Education</td>
                      <td><?php echo $rowedu['SUM(expensevalue)'] . " VND"; ?></td>
                    </tr>
                    <tr>
                      <td>Others</td>
                      <td><?php echo $rowothers['SUM(expensevalue)'] . " VND"; ?></td>
                    </tr>
                  <?php
                } ?>
                  </table>
                </div>
            </div>
          </div>
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
    feather.replace()
  </script>
  <script>
    var ctx = document.getElementById('expense_category_pie').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [<?php while ($a = mysqli_fetch_array($exp_category_dc)) {
                    echo '"' . $a['expensecategory'] . '",';
                  } ?>],
        datasets: [{
          label: 'Expense by Category',
          data: [<?php while ($b = mysqli_fetch_array($exp_value_dc)) {
                    echo '"' . $b['SUM(expensevalue)'] . '",';
                  } ?>],
          backgroundColor: [
            '#6f42c1',
            '#dc3545',
            '#28a745',
            '#007bff',
            '#ffc107',
            '#20c997',
            '#17a2b8',
            '#fd7e14',
            '#e83e8c',
            '#6610f2'
          ],
          borderWidth: 1
        }]
      }
    });

    var line = document.getElementById('expense_line').getContext('2d');
    var myChart = new Chart(line, {
      type: 'line',
      data: {
        labels: [<?php while ($c = mysqli_fetch_array($exp_date_line)) {
                    echo '"' . $c['expensedate'] . '",';
                  } ?>],
        datasets: [{
          label: 'Expense by Month (Whole Year)',
          data: [<?php while ($d = mysqli_fetch_array($exp_value_line)) {
                    echo '"' . $d['SUM(expensevalue)'] . '",';
                  } ?>],
          borderColor: [
            '#adb5bd'
          ],
          backgroundColor: [
            '#6f42c1',
            '#dc3545',
            '#28a745',
            '#007bff',
            '#ffc107',
            '#20c997',
            '#17a2b8',
            '#fd7e14',
            '#e83e8c',
            '#6610f2'
          ],
          fill: false,
          borderWidth: 2
        }]
      }
    });
  </script>
</body>

</html>