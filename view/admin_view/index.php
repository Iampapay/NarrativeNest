<?php
    require_once ('../../db/connection.php');
    
    if(isset($_SESSION['admin_id'])){
        $a = 'admin';
    }else{
        header('location: ../index.php');
    }
    
    $u_qry1="SELECT COUNT(id) as total_usr FROM user_info";
    $u_data1= mysqli_query($conn, $u_qry1);
    $u_data2= mysqli_fetch_assoc($u_data1);

    $c_qry1="SELECT COUNT(id) as total_comment FROM blog_comment";
    $c_data1= mysqli_query($conn, $c_qry1);
    $c_data2= mysqli_fetch_assoc($c_data1);

    $p_qry1="SELECT COUNT(id) as total_post FROM blog_post";
    $p_data1= mysqli_query($conn, $p_qry1);
    $p_data2= mysqli_fetch_assoc($p_data1);

    $m_qry1="SELECT COUNT(id) as total_msg FROM user_massage";
    $m_data1= mysqli_query($conn, $m_qry1);
    $m_data2= mysqli_fetch_assoc($m_data1);

    $blog_qry="SELECT * FROM blog_post WHERE blog_status = 'P'";
    $blog_qry1= mysqli_query($conn, $blog_qry);                       
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <title>Dashboard</title>
    <link href="../../asset/admin_asset/css/font-face.css" rel="stylesheet" media="all">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" media="all">
    <link href="../../asset/admin_asset/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="../../asset/admin_asset/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../../asset/admin_asset/css/theme.css" rel="stylesheet" media="all">
    <link href="../../asset/admin_asset/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
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
                        <li class="active">
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
                                            <a class="js-acc-btn" href="#">Admin</a>
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
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">overview</h2>
                                    <button class="au-btn au-btn-icon au-btn--blue add_blog">
                                        <i class="zmdi zmdi-plus"></i>add Post</button>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix text-center">
                                            <div class="icon mr-4">
                                                <i class="fa-solid fa-users"></i>
                                            </div>
                                            <div class="text mb-4">
                                                <h2><?php echo $u_data2['total_usr']?></h2><br>
                                                <h5 class="text-white">User</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix text-center">
                                            <div class="icon mr-4">
                                                <i class="fa-sharp fa-solid fa-comments"></i>
                                            </div>
                                            <div class="text mb-4">
                                                <h2><?php echo $c_data2['total_comment']?></h2><br>
                                                <h5 class="text-white">Comment</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix text-center">
                                            <div class="icon mr-4">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </div>
                                            <div class="text mb-4">
                                                <h2><?php echo $p_data2['total_post']?></h2><br>
                                                <h5 class="text-white">Post</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix text-center">
                                            <div class="icon mr-4">
                                            <i class="fa-solid fa-quote-left"></i>
                                            </div>
                                            <div class="text mb-4">
                                                <h2><?php echo $m_data2['total_msg']?></h2><br>
                                                <h5 class="text-white">Message</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="au-card recent-report">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 mb-4">Recent Published Posts</h3>
                                        <div class="row">
                                        <?php
                                            while($blog_var = mysqli_fetch_assoc($blog_qry1)){
                                            $date_time = date("d M Y, h:i a", strtotime($blog_var['created_date_time']));
                                        ?>
                                        <div class="card col-lg-4 text-center" style="border: 0px;">
                                            <div class="thumbnail my-2">
                                                <img class="mb-2" style="height: 15vw" src="../../uploads/<?php echo $blog_var['blog_photo'];?>">
                                                <p><strong><?php echo $blog_var['blog_title'];?></strong></p>
                                                <p><?php echo $date_time;?></p>
                                            </div>
                                        </div>
                                        <?php 
                                            } 
                                        ?>
                                        </div>
                                    </div>
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

    <!-- add blog modal start -->
    <div class="modal fade" id="add_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="add_form" enctype="multipart/formdata">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel"><b>Add Blog</b></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container col-md-12">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- add blog modal end -->
    <script src="../../asset/admin_asset/vendor/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="../../asset/admin_asset/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <script src="../../asset/admin_asset/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="../../asset/admin_asset/vendor/animsition/animsition.min.js"></script>
    <script src="../../asset/admin_asset/js/tabledata.js"></script>
    <script src="../../asset/admin_asset/js/main.js"></script>
</body>
</html>
