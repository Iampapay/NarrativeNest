<?php
    // for db connection
    require_once ('../db/connection.php');

    $qry = "SELECT * FROM blog_post WHERE blog_status='P'";
    $result = mysqli_query($conn, $qry);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog Post</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="../asset/css/font-awesome.min.css">
    <link rel="stylesheet" href="../asset/css/toastr.min.css">
    <link rel="stylesheet" href="../asset/css/style.css">
    <link rel="stylesheet" href="../asset/css/fonts-Sofia.min.css">
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="../uploads/cam-logo.jpg" width="55"
                    height="55" alt="logo">
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#myPage">HOME</a></li>
                    <li><a href="#gallary">GALLARY</a></li>
                    <li><a href="#blogs">BLOGS</a></li>
                    <li><a href="#contact">CONTACT</a></li>
                    <li><a href="#about-us">ABOUT</a></li>
                    <li class="dropdown">
                        <?php
                            if(isset($_SESSION['user_id'])){
                                $already_loged = true;     //if user logged in
                                $user_n = "SELECT user_name FROM user_info WHERE id = '".$_SESSION['user_id']."'";
                                $result_n = mysqli_query($conn, $user_n);
                                $usr_nm= mysqli_fetch_assoc($result_n);
                            }else{
                                $already_loged = false;     //if user logged out
                                $usr_nm = ['More'];
                            }
                        ?>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo implode($usr_nm) ?>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="text-center">
                                    <a href=".\user_login.php" type="button" <?php echo $already_loged ? 'style="display:none;"' : 'style="display:inline;"' ?>
                                        class="btn btn-sm btn-dark">login</a>
                                    </div>
                                    <li>
                                        <div class="text-center">
                                            <a href=".\user_signup.php" type="button" <?php echo $already_loged ? 'style="display:none;"' : 'style="display:inline;"' ?>
                                                class="btn btn-sm btn-dark">sign up</a>
                                        </div>
                                    </li>
                                </li>
                                <li>
                                    <div class="text-center">
                                    <a href="..\controller\User_LogoutCtrl.php" type="button"
                                    <?php echo $already_loged ? 'style="display:inline;"' : 'style="display:none;"' ?> class="btn btn-sm btn-dark">logout</a>
                                </div>
                            </li>
                            <li>
                            </li>
                        </ul>
                    </li>
                    <!-- <li><a href="#"><span class="glyphicon glyphicon-search"></span></a></li> -->
                </ul>
            </div>
        </div>
    </nav>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
                <?php
                    if(isset($_SESSION['user_id'])){
                        $already_login = 'display:none;';     //if user logged in
                    }else{
                        $already_login = '';     //if user logged out
                    }
                ?>
            <div class="item active">
                <img src="../uploads/img2.jpg" alt="New York"
                    width="1200" height="700">
                <div class="carousel-caption carousel-caption animate__animated animate__bounce animate__fadeInLeft" style="font-family: Sofia; sans-serif;">
                    <h1>RAIN FOREST</h1>
                    <p>"Sometimes when you lose your way in the fog, you end up in a beautiful place! Don't be afraid of
                        getting lost!" </p>
                    <a class="mr-3" href=".\user_signup.php"><button style="<?php echo $already_login?>border:1px solid magenta; border-radius: 30px;margin-right: 35px;" type="submit" class="btn btn-lg user_sign">sign up</button></a>
                    <a href=".\user_login.php"><button style="<?php echo $already_login?>border:1px solid magenta; border-radius: 30px;" type="submit" class="btn btn-lg user_login">login</button></a>
                </div>
            </div>
            <div class="item">
                <img src="../uploads/img3.jpg"
                    alt="Chicago" width="1200" height="700">
                <div class="carousel-caption carousel-caption animate__animated animate__bounce animate__fadeInRight" style="font-family: Sofia; sans-serif;">
                    <h1>SWITZERLAND</h1>
                    <p>“When I admire the wonders of a sunset or the beauty of the moon, my soul expands in the worship
                        of the creator.” </p>
                    <a href=".\user_signup.php"><button style="<?php echo $already_login?>border:1px solid cyan; border-radius: 30px;margin-right: 35px;" type="submit" class="btn btn-lg user_sign">sign up</button></a>
                    <a href=".\user_login.php"><button style="<?php echo $already_login?>border:1px solid cyan; border-radius: 30px;" type="submit" class="btn btn-lg user_login">login</button></a>
                </div>
            </div>
            <div class="item">
                <img src="../uploads/img1.jpg"
                    alt="Los Angeles" width="1200" height="700">
                <div class="carousel-caption carousel-caption animate__animated animate__bounce" style="font-family: Sofia; sans-serif;">
                    <h1>NORWAY</h1>
                    <p>"The Milky Way is nothing else but a mass of innumerable stars planted together in clusters."</p>
                    <a href=".\user_signup.php"><button style="<?php echo $already_login?>border:1px solid yellow; border-radius: 30px;margin-right: 35px;" type="submit" class="btn btn-lg user_sign">sign up</button></a>
                    <a href=".\user_login.php"><button style="<?php echo $already_login?>border:1px solid yellow; border-radius: 30px;" type="submit" class="btn btn-lg user_login">login</button></a>
                </div>
            </div>
        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- Container (gallary Section) -->
    <div id="gallary" class="container text-center">
        <h3>BEHIND THE STORY</h3>
        <p><em>We love creativity!</em></p>
        <p>Nature photography is a versatile medium with a unique set of challenges and the potential to tell compelling
            stories. Whether you’re experimenting with shutter speed to catch an animal in motion or you’re trying out
            different depths of field in your close-up flower photograph, it takes patience and creativity to
            successfully capture the great outdoors..</p>
        <br>
        <div class="row">
            <div class="col-sm-4">
                <p class="text-center"><strong>Subhasis Jana</strong></p><br>
                <a href="#demo" data-toggle="collapse">
                    <img src="../uploads/subhasis.jpg" class="img-circle person" alt="Random Name" width="255"
                        height="255">
                </a>
                <div id="demo" class="collapse">
                    <p>Designer</p>
                    <p>Loves long walks on the beach</p>
                    <p>Member since 2009</p>
                </div>
            </div>
            <div class="col-sm-4">
                <p class="text-center"><strong>Subhadip Betal</strong></p><br>
                <a href="#demo2" data-toggle="collapse">
                    <img src="../uploads/subha.jpg" class="img-circle person" alt="Random Name" width="255"
                        height="255">
                </a>
                <div id="demo2" class="collapse">
                    <p>Photographer</p>
                    <p>Loves drawing, clicking pictures</p>
                    <p>Member since 2005</p>
                </div>
            </div>
            <div class="col-sm-4">
                <p class="text-center"><strong>Jayanta Maity</strong></p><br>
                <a href="#demo3" data-toggle="collapse">
                    <img src="../uploads/jay.jpg" class="img-circle person" alt="Random Name" width="255" height="255">
                </a>
                <div id="demo3" class="collapse">
                    <p>Writter</p>
                    <p>Loves eating,singing</p>
                    <p>Member since 2007</p>
                </div>
            </div>
        </div>
        <div class="text-center">
            <a href="admin-login" style="border:1px solid sky;" class="a_log" id="log" data-toggle="modal">
                <u>Click here to login as an admin</u>
            </a>
        </div>
    </div>
    <!-- Container (blog Section) -->
    <div id="blogs" class="bg-1">
        <div class="container">
            <h3 class="text-center">BLOG POSTS</h3>
            <p class="text-center">Here you can see all posts.<br>You can like & comment in our post by signup to our
                website</p><br>
            <?php
                    $i=1;
                    while($var = mysqli_fetch_assoc($result)){
                    $date_time = date("d M Y, h:i a", strtotime($var['created_date_time']));
                    // for like count start
                    $qry1="SELECT COUNT(rating_action) as total_like FROM rating_info WHERE fk_post_id = '".$var['id']."'";
                    $data1= mysqli_query($conn, $qry1);
                    $data2= mysqli_fetch_assoc($data1);
                    // for like count end
                    
                    // user already liked or not start
                    if(isset($_SESSION['user_id'])){
                        $qry2="SELECT * FROM rating_info WHERE fk_post_id = '".$var['id']."' AND fk_user_id = '".$_SESSION['user_id']."' AND rating_action='Like'";
                        $data3= mysqli_query($conn, $qry2);
                        if(mysqli_num_rows($data3) > 0){
                            $already_liked = true;
                        }else{
                            $already_liked = false;
                        }
                    }else{
                        $already_liked = true;
                    }
                    // user already liked or not end     
            ?>
            <section id="blogs">
                <div id="blg_card" class="b-cards card col-sm-4 text-center">
                    <div class="thumbnail">
                        <img style="height: 15vw" src="../uploads/<?php echo $var['blog_photo'];?>">
                        <div class="post-wrapper">
                            <div class="post_info">
                                <lebel style="color:black;font-weight:bold" for="like"><strong>Like</strong></lebel>
                                <i style="color: blue;" class="fa <?php echo $already_liked ? 'fa-thumbs-up' : 'fa-thumbs-o-up'; ?> like-btn"
                                    data-like_id="<?php echo $var['id']; ?>"></i>
                                <span style="color:black;font-weight:bold"
                                    class="like_count"><?php echo $data2['total_like']?></span>
                            </div>
                        </div>
                        <p><strong><?php echo $var['blog_title'];?></strong></p>
                        <p><?php echo $date_time;?></p>
                        <button class="btn user_view" data-toggle="modal" data-view_auto_id="<?php echo $var['id']; ?>"
                            data-target="#myModal">Read more</button>
                    </div>
                </div>
            </section>
            <?php 
                    $i++; 
                    } 
            ?>
        </div>
        <!--View Modal Strat -->
        <div class="modal fade" id="viewModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" style="font-size: 50px;" data-dismiss="modal">×</button>
                        <h2>CONTENTS</h2>
                    </div>
                    <div class="modal-body">
                        <div class="card text-center">
                            <div class="card-body">
                                <b><strong>
                                        <b><span style="color: black">
                                                <u>
                                                    <h1 class="card-title post_title"></h1>
                                                </u>
                                            </span></b>
                                    </strong></b>
                                <strong><span style="color: black">
                                        <h4 class="card-category post_category"></h4>
                                    </span></strong>
                                <b><span style="color: darkgreen">
                                        <h5 class="card-subtitle mb-2 text-muted post_date"></h5>
                                    </span></b>
                                <img src="" class="card-img-top post_image mb-2" style="width:80%;">
                                <b><span style="color: darkblue">
                                        <p class="card-text post_desc"></p>
                                    </span></b>
                                <div style="color: black" class="detailBox">
                                    <div class="all_comment">
                                        <!-- contents are fetched by jQuery -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <form id="comment_form">
                                    <textarea style="border:2px solid darkcyan" class="form-control" id="u_comments"
                                        name="comments" placeholder="Leave a comment" rows="3"></textarea>
                                    <br>
                                    <input type="hidden" class="form-control" name="post_id" id="p_id">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <button style="border:2px solid red; border-radius: 30px;" type="submit" class="btn user_comment"
                                                type="submit">comment</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container (Contact Section) -->
    <div id="contact" class="container">
        <h3 class="text-center">CONTACT</h3>
        <p class="text-center"><em>Please leave a massage for us!</em></p>
        <div class="row">
            <div class="col-md-4">
                <p>Enjoing? Drop a message.</p>
                <p><span class="glyphicon glyphicon-map-marker"></span> Location: Kolkata, West Bengal</p>
                <p><span class="glyphicon glyphicon-phone"></span> Phone: +91 7908435173</p>
                <p><span class="glyphicon glyphicon-envelope"></span> Email: subhadipbetal316@gmail.com</p>
            </div>
            <div class="col-md-8">
                <form id="msg_form">
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <input style="border:2px solid darkblue" class="form-control" id="name" name="u_name"
                                placeholder="Enter Your Name" type="text">
                        </div>
                        <div class="col-sm-6 form-group">
                            <input style="border:2px solid darkblue" class="form-control" id="email" name="u_email"
                                placeholder="Enter Your Email" type="email">
                        </div>
                    </div>
                    <textarea style="border:2px solid darkblue" class="form-control" id="msg" name="u_massage"
                        placeholder="Write a Massage" rows="5"></textarea><br>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <button class="btn pull-right user_msg" type="submit">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <h3 class="text-center">CREATORS</h3>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Subhadip</a></li>
            <li><a data-toggle="tab" href="#menu1">Jayanta</a></li>
            <li><a data-toggle="tab" href="#menu2">Subhasis</a></li>
        </ul>
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <h2>Subhadip Betal,photographer</h2>
                <p>Hi,i am Subhadip. I am passionate about photography. My goal is to explore the world feel each
                    momment through my camera and to become a professional photographer..</p>
            </div>
            <div id="menu1" class="tab-pane fade">
                <h2>Jayanta Maity, content writer</h2>
                <p>Always a pleasure people! Hope you enjoyed my stories.If you did, please let me know in the comment
                </p>
            </div>
            <div id="menu2" class="tab-pane fade">
                <h2>Subhasis Jana, designer</h2>
                <p>My self subhasis, I am the designer, if you need any kind of help regarding website design please
                    contact with the given number.</p>
            </div>
        </div>
    </div>
    <!-- Container (About Section) -->
    <section id="about-us">
        <div class="section-title">
            <h2 class="font-weight-bolder text-center">About</h2>
            <hr class="hr-style" style="border-color: black;">
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="basic-desc">
                    <i class="icon-style rounded-circle fas fa-users fa-1x"></i>
                    <h4 class="font-weight-bolder"><strong>Information</strong></h4>
                    <P>
                        We strongly believes that story-telling through a photograph.
                        Composing different wide frames and perspectives can be seen through all our photographs.
                    </P>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="basic-desc">
                    <i class="icon-style rounded-circle fas fa-trophy fa-1x"></i>
                    <h4 class="font-weight-bolder"><strong>Achivements</strong></h4>
                    <p>
                        Nature and wildlife photography award<br>
                        Landscape photography award<br>
                        Street & portrait photography award
                    </p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="basic-desc">
                    <i class="icon-style rounded-circle fas fa-briefcase fa-1x"></i>
                    <h4 class="font-weight-bolder"><strong>Skills</strong></h4>
                    <table>
                        <tr>
                            <td>Lightroom</td>
                            <td>
                                <span class="star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Photoshop</td>
                            <td>
                                <span class="star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Finalcut pro</td>
                            <td>
                                <span class="star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half"></i>
                                    <i class="far fa-star"></i>
                                </span>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- Container (Footer Section) -->
    <footer class="text-center">
        <div class="row">
            <div class="col-lg-4">
                <p class="text-white">&copy; copyright : subhadip Betal</p>
            </div>
            <div class="col-lg-4">
                <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
                    <span class="glyphicon glyphicon-chevron-up"></span>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="https://www.facebook.com/subhadip.betal.5/" target="_blank"><i class="fab fa-facebook"></i> </a>
                <a href="https://www.instagram.com/nature_infocuse/" target="_blank"><i class="fab fa-instagram"></i> </a>
                <a href="https://web.whatsapp.com/" target="_blank"><i class="fab fa-whatsapp"></i></i> </a>
                <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i> </a>
                <a href="www.linkedin.com/in/subhadip-betal" target="_blank"><i class="fab fa-linkedin-in"></i> </a>
                <a href="https://github.com/Iampapay" target="_blank"><i class="fab fa-github"></i> </a>
            </div>
        </div>
    </footer>
    <!-- admin login modal start -->
    <div class="modal fade" id="Admin_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="admin_login">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Admin login</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container col-lg-12">
                            <label for="a_id"><b>User name</b></label>
                            <i class="fas fa-users-cog"></i>
                            <input style="border:2px solid blue;" type="text" class="form-control"
                                placeholder="Enter User name" name="user_name" id="a_id"><br>

                            <label for="a_pass"><b>Password</b></label>
                            <i class="fas fa-key"></i>
                            <input style="border:2px solid blue;" type="password" class="form-control"
                                placeholder="Enter Password" name="admin_pass" id="a_pass">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- admin login modal end -->
    <script src="../asset/js/jquery.min.js"></script>
    <script src="../asset/js/jquery.validate.min.js"></script>
    <script src="../asset/js/bootstrap.min.js"></script>
    <script src="../asset/js/popper.min.js"></script>
    <script src="../asset/js/toastr.min.js"></script>
    <script src="../asset/js/sweetalert.min.js"></script>
    <script src="../asset/js/c26cd2166c.js"></script>
    <script src="../asset/js/main.js"></script>
</body>
</html>