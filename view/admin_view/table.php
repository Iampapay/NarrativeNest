<?php
    require_once ('../../db/connection.php');

    if(isset($_SESSION['admin_id'])){
        $a = 'admin';
    }else{
        header('location: ../index.php');
    }

    $qry = "SELECT * FROM blog_post";
    $result = mysqli_query($conn, $qry);

    $qry2 = "SELECT user_info.user_name, user_massage.* FROM user_info INNER JOIN user_massage ON user_info.id = user_massage.fk_user_id";
    $result2 = mysqli_query($conn, $qry2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tables</title>
    <link href="../../asset/admin_asset/css/font-face.css" rel="stylesheet" media="all">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" media="all">
    <link href="../../asset/admin_asset/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="../../asset/admin_asset/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../../asset/admin_asset/css/theme.css" rel="stylesheet" media="all">
    <link href="../../asset/admin_asset/css/toggle.css" rel="stylesheet" media="all">
    <link href="../../asset/css/toastr.min.css" rel="stylesheet" media="all">
    <link href="../../asset/css/sweetalert.min.css" rel="stylesheet" media="all">
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
                        <li>
                            <a href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li class="active">
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
                            <div class="col-lg-12 col-md-12">
                                <h3 class="title my-2">Content Details</h3>
                                <div class="row">
                                <div class="col-lg-6">
                                    <input class="form-control" id="myInput" type="text" placeholder="Search..">
                                </div>
                                </div>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>Serial</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Photo</th>
                                                <th>Category</th>
                                                <th>Status</th>
                                                <th>Action controller</th>
                                            </tr>
                                        </thead>
                                        <tbody id="user_table">
                                        <?php
                                            $i=1;
                                            while($var = mysqli_fetch_assoc($result)){
                                            $checked = $var['blog_status'] == 'P' ? 'checked' : '';
                                        ?>
                                            <tr class="tr-shadow">
                                                <td> <?php echo $i;?> </td>
                                                <td>
                                                    <span class="block-email"> <?php echo $var['blog_title'];?> </span>
                                                </td>
                                                <td class="desc"> <?php echo $var['blog_desc']; ?> </td>
                                                <td> <img src="../../uploads/<?php echo $var['blog_photo'];?>" style="width: 200px; height: 40px;"> </td>
                                                <td>
                                                    <span class="status--process"> <?php echo $var['blog_category']; ?> </span>
                                                </td>
                                                <td><b> <?php echo $var['blog_status']; ?> </b></td>
                                                <td all_btn>
                                                    <div class="table-data-feature">
                                                        <button type="button" class="btn btn-lg edit_blog" data-toggle="modal" class="item" data-toggle="tooltip" data-placement="top" title="Edit"
                                                            data-edit_auto_id="<?php echo $var['id']; ?>">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                        <label class="switch mt-3">
                                                            <input type="checkbox" class="is_active" <?=$checked?>
                                                                data-blog_auto_id="<?php echo $var['id'];?>">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <button type="button" class="btn btn-lg delete_blog" class="item" data-toggle="tooltip" data-placement="top" title="Delete"
                                                            data-delete_auto_id="<?php echo $var['id']; ?>">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php 
                                                $i++; 
                                                } 
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-30">
                            <div class="col-md-12">
                            <h3 class="title mb-4">User Query</h3>
                            <div class="row">
                            <div class="col-lg-6">
                                <input class="form-control" id="queryInput" type="text" placeholder="Search.."><br>
                            </div>
                            </div>
                                <div class="table-responsive m-b-40">
                                    <table class="table table-bordered table-striped table-hover table-data3">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Serial</th>
                                                <th>User Name</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Message</th>
                                            </tr>
                                        </thead>
                                        <tbody id="user_msg">
                                        <?php
                                            $j=1;
                                            while($var2 = mysqli_fetch_assoc($result2)){
                                        ?>
                                            <tr class="text-center">
                                                <td><?php echo $j;?> </td>
                                                <td><?php echo $var2['user_name'];?> </td>
                                                <td><?php echo $var2['u_name'];?> </td>
                                                <td class="process"><?php echo $var2['user_email'];?> </td>
                                                <td><?php echo $var2['user_massage'];?> </td>
                                            </tr>
                                            <?php 
                                                $j++; 
                                                } 
                                            ?>
                                        </tbody>
                                    </table>
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
        <!-- blog edit modal start -->
        <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="update_form" enctype="multipart/formdata">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel"><b>Update blog details</b></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="container col-md-12">
                                <input type="hidden" name="edit_id" id="h_id">

                                <div class="form-group">
                                    <label for="bg_title">Title:</label>
                                    <input type="text" class="form-control" id="bg_title" name="blg_title"
                                        placeholder="Enter a beautiful title">
                                </div>

                                <div class="form-group">
                                    <label for="bg_desc">Description:</label>
                                    <textarea type="text" class="form-control" id="bg_desc" name="blg_desc"
                                        placeholder="Enter blog description" rows="4" cols="40"></textarea>
                                </div>
                                <input type="hidden" class="form-control" name="old_pic" id="old_image">
                                <div class="form-group text-left">
                                    <label for="bg_pic">Photo:</label>
                                    <input type="file" class="form-control" id="bg_pic" placeholder="Enter Photo"
                                        name="update_photo" onchange="previewFile();">
                                    <img src="" id="update_pic" style="width:20%;"><br>
                                </div>
                                <div class="form-group">
                                    <label for="bg_category">Category:</label>
                                    <input type="text" class="form-control" id="bg_category" name="blg_category"
                                        placeholder="Enter blog category">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- blog edit modal end -->
    </div>
    <script src="../../asset/admin_asset/vendor/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="../../asset/admin_asset/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <script src="../../asset/admin_asset/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="../../asset/admin_asset/vendor/animsition/animsition.min.js"></script>
    <script src="../../asset/admin_asset/js/tabledata.js"></script>
    <script src="../../asset/admin_asset/js/main.js"></script>
    <script src="../../asset/js/toastr.min.js"></script>
    <script src="../../asset/js/sweetalert.min.js"></script>
    <script src="../../asset/js/c26cd2166c.js"></script>
</body>
</html>
