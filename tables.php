<?php
	include 'conn.php';
	session_start();
	$user_id = $_SESSION['id'];
	if(!isset($_SESSION['id'])) {
	   echo '<script>alert("You do not have access to this page. Please log in first.");</script>';
	   header("Location: login.php");
		exit();
	   }
   
   $stmt = $conn->prepare("SELECT * FROM register WHERE user_id = ?");
   $stmt->execute([$user_id]);
   $user = $stmt->fetch(PDO::FETCH_ASSOC);
   if($user){
   } else {
	   echo 'failed to find';
   }
	?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tables - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/edit.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
              <div class="ms-auto">
                <!-- Welcome Message -->
                <span class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?></span>
            </div>
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." name= "search1" id= "search1"aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <?php if (isset($_SESSION['email'])): ?>
                            <span>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?></span>
                            <li><button style="width: 100%; padding: 8px 16px; border: none; background-color: #007bff; color: white;" onclick="window.location.href='logout.php';">Log-out</button></li>
                        <?php else: ?>
                            <li><button style="width: 100%; padding: 8px 16px; border: none; background-color: #007bff; color: white;" onclick="window.location.href='login.php';">Log-in</button></li>
                            <li><button style="width: 100%; padding: 8px 16px; border: none; background-color: #007bff; color: white;" onclick="window.location.href='register.php';">Register</button></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Layouts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.php">Static Navigation</a>
                                    <a class="nav-link" href="layout-sidenav-light.php">Light Sidenav</a>
                                    <?php if (isset($_SESSION['id'])): ?>
                        <a onclick="window.location.href='admin.php';">Admin</a>
                        <?php else: ?>
                        <?php endif; ?>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.php">Login</a>
                                            <a class="nav-link" href="register.php">Register</a>
                                            <a class="nav-link" href="password.php">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.php">401 Page</a>
                                            <a class="nav-link" href="404.php">404 Page</a>
                                            <a class="nav-link" href="500.php">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Tables</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                        </ol>
                        <div class="card mb-4">
                        <?php
                    if (isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) > 0) {
                        echo '<ul style="padding:0; color:red;">';
                        foreach ($_SESSION['ERRMSG_ARR'] as $msg) {
                            echo '<li>', htmlspecialchars($msg), '</li>';
                        }
                        echo '</ul>';
                        unset($_SESSION['ERRMSG_ARR']);
                    }
                    ?>

                    <div class="container">
                        <form action="reg.php" method="POST" style="width: 80%; margin: 50px auto; height: 80px;">
                            <div style="float:left;width:25%;">First Name<br><input type="text" name="fname" /></div>
                            <div style="float:left;width:25%;">Last Name<br><input type="text" name="lname" /></div>
                            <div style="float:left;width:25%;">Age<br><input type="text" name="age" /></div>
                            <div style="float:left;width:25%;"><input type="submit" value="Save" id="secret" /></div>
                        </form>
                    </div>
                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Member</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="edit.php" method="POST">
                                                <input type="hidden" name="id" id="memberId">
                                                <div class="form-group">
                                                    <label for="memberFirstName">First Name</label>
                                                    <input type="text" class="form-control" id="memberFirstName" name="fname">
                                                </div>
                                                <div class="form-group">
                                                    <label for="memberLastName">Last Name</label>
                                                    <input type="text" class="form-control" id="memberLastName" name="lname">
                                                </div>
                                                <div class="form-group">
                                                    <label for="memberAge">Age</label>
                                                    <input type="number" class="form-control" id="memberAge" name="age">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                    <tr>
                        <th>First Name</th>
                        <th>Lastname</th>
                        <th>Age</th>
                        <th>Action</th>
                    </tr>
                </thead>
               
                <tbody>
                    <?php
                    // Assume connection to database 'finaloutput'
                    $connection = mysqli_connect("localhost", "root", "", "finaloutput");
                    if (!$connection) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $query = mysqli_query($connection, "SELECT * FROM members");
                    if ($query) {
                        while ($rows = mysqli_fetch_assoc($query)) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($rows['fname']) . '</td>';
                            echo '<td>' . htmlspecialchars($rows['lname']) . '</td>';
                            echo '<td>' . htmlspecialchars($rows['age']) . '</td>';
                            echo '<td>
                                  <button type="button" class="btn btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" data-id="' . $rows['id'] . '" data-fname="' . $rows['fname'] . '" data-lname="' . $rows['lname'] . '" data-age="' . $rows['age'] . '">Edit</button>
                                  <form action="delete.php" method="POST" style="display:inline-block" onsubmit="return confirm(\'Are you sure?\')">
                                      <input type="hidden" name="id" value="' . $rows['id'] . '"/>
                                      <button type="submit" class="btn btn-danger">Delete</button>
                                  </form>
                                  </td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "Error: " . mysqli_error($connection);
                    }
                    mysqli_close($connection);
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Load necessary scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/umd/simple-datatables.min.js"></script>
    <script src="js/scripts.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            const datatablesSimple = document.getElementById('datatablesSimple');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        });
        $(document).ready(function() {
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                var fname = $(this).data('fname');
                var lname = $(this).data('lname');
                var age = $(this).data('age');

                $('#memberId').val(id);
                $('#memberFirstName').val(fname);
                $('#memberLastName').val(lname);
                $('#memberAge').val(age);

                $('#editModal').modal('show');
            });
        });
    </script>
</body>

</html>