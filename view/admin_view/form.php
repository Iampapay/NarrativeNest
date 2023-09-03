<?php
    require_once ('../../db/connection.php');

    if(isset($_SESSION['admin_id'])){
        $a = 'admin';
    }else{
        header('location: ../index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Forms</title>
    <link href="../../asset/admin_asset/css/font-face.css" rel="stylesheet" media="all">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" media="all">
    <link href="../../asset/admin_asset/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="../../asset/admin_asset/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../../asset/admin_asset/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../../asset/admin_asset/css/theme.css" rel="stylesheet" media="all">
    <link href="../../asset/css/toastr.min.css" rel="stylesheet" media="all">
    <link href="../../asset/css/sweetalert.min.css" rel="stylesheet" media="all">
</head>
<body class="animsition">
    <div class="page-wrapper">
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a href="index.php">
                            <h3>Admin Dashboard</h3>
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <a href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="table.php">
                                <i class="fas fa-table"></i>Tables</a>
                        </li>
                        <li>
                            <a href="form.php">
                                <i class="far fa-check-square"></i>Forms</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="index.php">
                    <h3>Admin Dashboard</h3>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="table.php">
                                <i class="fas fa-table"></i>Tables</a>
                        </li>
                        <li class="active">
                            <a href="form.php">
                                <i class="far fa-check-square"></i>Forms</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="page-container">
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <!-- <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button> -->
                            </form>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="../../asset/admin_asset/images/icon/avatar-1.png" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="">Admin</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="account-dropdown__footer">
                                                <a href="..\..\controller\Admin_LogoutCtrl.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 px-5">
                                <div class="card">
                                    <form id="add_form_data" enctype="multipart/formdata">
                                        <div class="card-header text-center bg-dark">
                                            <h3><b class="text-white">Start  Posting</b></h3>
                                        </div>
                                        <div class="card-body card-block">
                                            <div class="form-group">
                                                <label for="b_title">Title:</label>
                                                <input type="text" class="form-control" id="b_title" name="title"
                                                    placeholder="Enter a beautiful title">
                                            </div>

                                            <div class="form-group">
                                                <label for="b_desc">Description:</label>
                                                <textarea type="text" class="form-control" id="b_desc" name="desc"
                                                    placeholder="Enter blog description" rows="4" cols="40"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="pic">Picture:</label>
                                                <input type="file" class="form-control" id="pic" placeholder="Select a photo"
                                                    name="picture" onchange="previewFiles();">
                                                <img src="" id="preview_photo" style="width:20%;">
                                            </div>

                                            <div class="form-group">
                                                <label for="b_category">Category:</label>
                                                <input type="text" class="form-control" id="b_category" name="category"
                                                    placeholder="Enter blog category">
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="reset" class="btn btn-danger btn-sm">
                                                <i class="fa fa-ban"></i> Reset
                                            </button>
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fa fa-dot-circle-o"></i> Post
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright text-center">
                                    <p>Copyright © 2022 Subhadip Betal  <a href="#">Subhadip</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../asset/admin_asset/vendor/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="../../asset/admin_asset/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <script src="../../asset/admin_asset/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="../../asset/admin_asset/vendor/animsition/animsition.min.js"></script>
    <script src="../../asset/admin_asset/js/tabledata.js"></script>
    <script src="../../asset/admin_asset/js/main.js"></script>
</body>
</html>

