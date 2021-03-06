<?php

  session_start(); /* Starts the session */

  if($_SESSION['Active'] == false){ /* Redirects user to Login.php if not logged in */
    header("location:./login.php");
	  exit;
  }
?>
<!doctype html>
<html class="no-js h-100" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Cape API Dashboard</title>
    <link rel="shortcut icon" href="../assets/NABIA.png" />
    <meta name="description" content="A high-quality &amp; free Cape api for hacked clients.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0" href="../assets/API-dashboard.1.1.0.min.css">
    <link rel="stylesheet" href="styles/extras.1.1.0.min.css">
  </head>
  <body class="h-100">
        <!-- Main Sidebar -->
        <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
          <div class="main-navbar">
            <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
              <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                <div class="d-table m-auto">
                  <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="../assets/NABIA.png" alt="API Dashboard">
                  <span class="d-none d-md-inline ml-1">Cape API Dashboard</span>
                </div>
              </a>
              <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                <i class="material-icons">&#xE5C4;</i>
              </a>
            </nav>
          </div>
          <div class="nav-wrapper">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="index.php">
                  <i class="material-icons">edit</i>
                  <span>API Dashboard</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="today-logs.php">
                  <i class="material-icons">error</i>
                  <span>Logs For Total API Requests Today</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logs.php">
                   <i class="material-icons">error</i>
                   <span>Logs For Today</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">
                   <i class="material-icons">account_circle</i>
                   <span>Logout</span>
                </a>
              </li>
            </ul>
          </div>
        </aside>
        <!-- End Main Sidebar -->
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
          <div class="main-navbar sticky-top bg-white">
          <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
              <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Dashboard</span>
                <h3 class="page-title">Stats</h3>
              </div>
            </div>
            <!-- End Page Header -->
            <!-- Small Stats Blocks -->
            <div class="row">
              <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">Users In DataBase</span>
                        <h6 class="stats-small__value count my-3"><?php
                        $filePath = "../uuid.json";
                        $lines = count(file($filePath));
                        echo $lines;
                        ?></h6>
                      </div>
                    </div>
                    <canvas height="120" class="overview-stats-1"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">Cape Images</span>
                        <h6 class="stats-small__value count my-3"><?php
                        $directory = "../capes/";
                        $filecount = 0;
                        $files = glob($directory . "*");
                        if ($files){
                            $filecount = count($files);
                        }
                        echo $filecount;
                        ?></h6>
                      </div>
                    </div>
                    <canvas height="120" class="overview-stats-2"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg col-md-4 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">Storage Used</span>
                        <h6 class="stats-small__value count my-3"><?php
                        $path = "../capes/";
                        echo getSymbolByQuantity(filesize_r($path));

                        function filesize_r($path){
                          if(!file_exists($path)) return 0;
                          if(is_file($path)) return filesize($path);
                          $ret = 0;
                          foreach(glob($path."/*") as $fn)
                            $ret += filesize_r($fn);
                          return $ret;
                        }

                        function getSymbolByQuantity($bytes)
                        {
                            $symbols = array('B', 'Kb', 'Mb', 'Gb', 'Tb', 'Pb', 'Eb', 'Zb', 'Yb');
                            $exp = floor(log($bytes)/log(1024));

                            return sprintf("%.2f " . $symbols[$exp], ($bytes/pow(1024, floor($exp))));
                        }
                        ?></h6>
                      </div>
                    </div>
                    <canvas height="120" class="overview-stats-3"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg col-md-4 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">Total API Requests</span>
                        <h6 class="stats-small__value count my-3"><?php
                        if (!file_exists('../logs/API-USAGE.log')) {
                            touch('../logs/API-USAGE.log');
                        }
                        $filePath = "../logs/API-USAGE.log";
                        $lines = count(file($filePath));
                        echo $lines;
                        ?></h6>
                      </div>
                    </div>
                    <canvas height="120" class="overview-stats-4"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg col-md-4 col-sm-12 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">Total API Requests Today</span>
                        <h6 class="stats-small__value count my-3"><?php
                           if (!file_exists('../logs/API-USAGE-'.date('j.n.Y').'.log')) {
                               touch('../logs/API-USAGE-'.date('j.n.Y').'.log');
                           }
                           $filePath = "../logs/API-USAGE-".date("j.n.Y").".log";
                           $lines = count(file($filePath));
                           echo $lines;
                        ?></h6>
                      </div>
                    </div>
                    <canvas height="120" class="overview-stats-5"></canvas>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
          <footer class="main-footer d-flex p-2 px-3 bg-white border-top">
            <span class="copyright ml-auto my-auto mr-2">Copyright ?? 2022
              <a href="https://cjstevenson.com/" rel="nofollow">ThnksCJ</a>
            </span>
          </footer>
        </main>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
    <script src="scripts/extras.1.1.0.min.js"></script>
    <script src="scripts/API-dashboards.1.1.0.min.js"></script>
    <script src="scripts/app/app.1.1.0.js"></script>
  </body>
</html>