<!DOCTYPE html>
<html>
<head>
    <title>Signup From</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../asset/css/font-awesome.min.css">
    <link rel="stylesheet" href="../asset/css/toastr.min.css">
    <link rel="stylesheet" href="../asset/css/style_sign.css">
</head>
<body>
    <div class="bg-image"></div>
    <div class="bg-text">
        <div class="container">
            <div class="row mt-2">
                <div class="col-md-12 form-section my-5">
                    <h2 class="text-center">SIGNUP FORM</h2>
                </div>
            </div>
            <form id="user_signup">
                <div class="row">
                    <div class=" col-md-3">
                        <label for="u_name"><strong>USER NAME</strong></label>
                    </div>
                    <div class="col-md-9">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend mr-1">
                                <span class="input-group-text">
                                    <span><i class="fas fa-users-cog"></i></span>
                                </span>
                            </div>
                            <input style="border:2px solid blue" type="text" name="username" class="form-control"
                                id="u_name" placeholder="Enter User name">
                        </div>
                    </div>
                    <div class=" col-md-3">
                        <label for="u_pass"><strong>PASSWORD</strong></label>
                    </div>
                    <div class="col-md-9">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend mr-1">
                                <span class="input-group-text">
                                    <span><i class="fas fa-key"></i></span>
                                </span>
                            </div>
                            <input style="border:2px solid blue" type="password" name="password"
                                class="form-control" id="u_pass" placeholder="Enter password">
                        </div>
                    </div>
                    <div class=" col-md-3">
                        <label for="c_pass"><strong>CONFIRM PASSWORD</strong></label>
                    </div>
                    <div class="col-md-9">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend mr-1">
                                <span class="input-group-text">
                                    <span><i class="fas fa-lock"></i></span>
                                </span>
                            </div>
                            <input style="border:2px solid blue" type="password" name="cpassword"
                                class="form-control" id="c_pass" placeholder="Make sure to type the same password">
                        </div>
                        <!-- <input type="checkbox" name="check_me" id="exampleCheck"> -->
                        <a href=".\user_login.php"><h6 class="text-white text-muted" for="exampleCheck">Already have an account</h6></a>
                    </div>
                    <div class="col-md-12 text-right">
                        <button style="border:1.5px solid magenta" type="reset" class="btn btn-sm btn-primary" id="reset">Reset
                            All</button>
                            <button style="border:1.5px solid orange" type="submit" name="submit" class="btn btn-sm btn-success">
                                Signup</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    <script src="../asset/js/jquery.min.js"></script>
    <script src="../asset/js/bootstrap.min.js"></script>
    <script src="../asset/js/popper.min.js"></script>
    <script src="../asset/js/toastr.min.js"></script>
    <script src="../asset/js/sweetalert.min.js"></script>
    <script src="../asset/js/jquery.validate.min.js"></script>
    <script src="../asset/js/c26cd2166c.js"></script>
    <script src="../asset/js/main.js"></script>
</body>
</html>