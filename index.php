<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
  <title>Simple Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="./bootstrap.min.css">
  <link rel="stylesheet" href="./bootstrap-icons.css">
  
  <style>
    /* some hacks for responsive sidebar */
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      z-index: 100;
      padding: 48px 0 0; /* height of navbar */
    }

    .sidebar-sticky {
      /* OPRAVA: Chybělo znaménko mínus u calc() */
      height: calc(100vh - 48px);
      overflow-x: hidden;
      overflow-y: auto;
    }
  </style>
</head>

<body>

    <?php include_once 'includes/header.php'; ?>

    <div class="container-fluid">
        <div class="row">
          <?php
            if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || (isset($_GET['page']) && $_GET['page'] === 'logout')) {
                require_once 'includes/pages/login.php';
            } 
            else {
                include_once 'includes/navigation.php';
          ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3 pb-3">
              <?php
                  if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    switch ($page) {
                      case 'dashboard':
                        include_once 'includes/pages/dashboard.html';  
                        break;
                      case 'items':
                        include_once 'includes/pages/items.html';
                        break;
                      case 'others':
                        include_once 'includes/pages/others.html';
                        break;
                      case 'users':
                        include_once 'includes/pages/users.php';
                        break;
                      default:
                        include_once 'includes/pages/dashboard.html';
                    }
                  } else {
                    include_once 'includes/pages/dashboard.html';
                  }
                ?>
            </main>
          <?php } ?>
        </div>
    </div>

</body>
</html>