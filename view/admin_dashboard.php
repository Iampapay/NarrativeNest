<?php
    require_once ('../db/connection.php');

    $qry = "SELECT * FROM blog_post";
    $result = mysqli_query($conn, $qry);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>User profile</title>
</head>
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 26px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: black;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    .slider.round {
        border-radius: 25px;
    }

    .slider.round:before {
        border-radius: 60%;
    }

    .all_btn{
        text-align: center;
    }
</style>

<body>
    <div class="container col-lg-12 mt-2">
        <h1 class="text-white bg-dark text-center my-2">Blog Details</h1>
        <div class="text-center"><button type="button" class="btn btn-primary add_blog mb-2">Add Blog</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Serial_no.</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Photo</th>
                        <th>Category</th>
                        <th>Location</th>
                        <th>Action controller</th>
                    </tr>
                </thead>

                <tbody id="user_table">
                <?php
                    $i=1;
                    while($var = mysqli_fetch_assoc($result)){
                    $checked = $var['blog_status'] == 'P' ? 'checked' : '';
                ?>
                    <tr>
                        <td> <?php echo $i;?> </td>
                        <td> <?php echo $var['blog_title'];?> </td>
                        <td> <?php echo $var['blog_desc']; ?> </td>
                        <td> <img src="../uploads/<?php echo $var['blog_photo'];?>" style="height:40px;"> </td>
                        <td> <?php echo $var['blog_category']; ?> </td>
                        <td> <?php echo $var['blog_status']; ?> </td>
                        <td class="all_btn">
                            <button type="button" class="btn btn-success edit_blog btn-sm mb-2" data-toggle="modal"
                                data-edit_auto_id="<?php echo $var['id']; ?>">EDIT</button><br>
                            <label class="switch">
                                <input type="checkbox" class="is_active" <?=$checked?>
                                    data-blog_auto_id="<?php echo $var['id'];?>">
                                <span class="slider round"></span>
                            </label><br>
                            <button type="button" class="btn btn-danger delete_blog btn-sm"
                                data-delete_auto_id="<?php echo $var['id']; ?>">DELETE</button>
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
                        <button type="submit" class="btn btn-primary">save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- add blog modal end -->

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

    <script>
    // for add blog
    $(".add_blog").on('click', function() {
        $("#add_modal").modal('show');
        $("#add_form").validate({
            rules: {
                title: {
                    required: true,
                },
                desc: {
                    required: true,
                },
                picture: {
                    required: true,
                },
                category: {
                    required: true,
                }
            },
            messages: {
                title: "Please enter blog title",
                desc: "Please enter blog description",
                picture: "Please select photo",
                category: "Please enter a category",
            },
            highlights: function(element, errorClass) {
                $(element).parent().addClass('error');
                $(element).addClass('error');
            },
            unhighlights: function(element, errorClass, validClass) {
                $(element).parent().removeClass('error');
                $(element).removeClass('error');
            },
            submitHandler: function(form) {
                var formData = new FormData($(form)[0]);

                $.ajax({
                    type: 'POST',
                    url: "../controller/Blog_AddCtrl.php",
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        console.log(res);
                        if (res.success == 'S') {
                            toastr.success(res.msg);
                            setTimeout(function() {
                                location.reload();
                                window.location.href =
                                    "./admin_dashboard.php";
                            }, 300);
                        } else {
                            toastr.error(res.msg);
                        }
                    },
                    error: function(error) {
                        console.log(error.responseText);
                    },
                });
            }
        });
    });

    // for edit blog
    $(".edit_blog").on('click', function() {
        var edit_id = $(this).data('edit_auto_id');
        $("#edit_modal").modal('show');
        $.ajax({
            type: 'POST',
            url: "../controller/Blog_EditCtrl.php",
            data: {
                edit_id: edit_id
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                $("#edit_modal").modal('show');
                $("#h_id").val(response.id);
                $("#bg_title").val(response.blog_title);
                $("#bg_desc").val(response.blog_desc);
                $('#old_image').val(response.blog_photo);
                var image = '../uploads/' + response.blog_photo;
                $('#update_pic').attr('src', image);
                $("#bg_category").val(response.blog_category);
            },
            error: function(error) {
                console.log(error.responseText);
            },
        });
    });

    //for update button
    $("#update_form").validate({
        rules: {
            blg_title: {
                required: true,
            },
            blg_desc: {
                required: true,
            },
            blg_category: {
                required: true,
            }
        },
        messages: {
            blg_title: "Please enter blog title",
            blg_desc: "Please enter blog description",
            blg_category: "Please enter a category",
        },
        highlights: function(element, errorClass) {
            $(element).parent().addClass('error');
            $(element).addClass('error');
        },
        unhighlights: function(element, errorClass, validClass) {
            $(element).parent().removeClass('error');
            $(element).removeClass('error');
        },
        submitHandler: function(form) {
            var formData = new FormData($(form)[0]);
            $.ajax({
                type: 'POST',
                url: "../controller/Blog_UpdateCtrl.php",
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(update) {
                    console.log(update);
                    if ((update.success) == 'S') {
                        toastr.success(update.msg);
                        setTimeout(function() {
                            location.reload();
                        }, 300);
                    } else {
                        toastr.error(update.msg);
                    }

                },
                error: function(error) {
                    console.log(error.responseText);
                },
            });
        }
    });

    // for post active/inactive
    $(".is_active").on('change', function(event) {
        var is_checked = event.target.checked;
        var b_id = $(this).data('blog_auto_id');
        var b_status = '';
        if (is_checked) {
            b_status = 'P';
        } else {
            b_status = 'D';
        }

        $.ajax({
            type: 'POST',
            url: "../controller/Status_UpdateCtrl.php",
            data: {
                blog_id: b_id,
                blog_status: b_status
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if ((response.success) == 'S') {
                    toastr.success(response.msg);
                    setTimeout(function() {
                        location.reload();
                    }, 300);
                } else {
                    toastr.error(response.msg);
                    setTimeout(function() {
                        location.reload();
                    }, 300);
                }

            },
            error: function(error) {
                console.log(error.responseText);
            },
        });
    });


    // for delete blog 
    $(".delete_blog").on('click', function() {
        var delete_id = $(this).data('delete_auto_id');
        swal({
                title: "Are you sure?",
                text: "You won't be able to recover this data",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Delete it!",
                closeOnConfirm: false,
            },
            function() {
                $.ajax({
                    type: 'POST',
                    url: "../controller/Blog_DeleteCtrl.php",
                    data: {
                        d_id: delete_id
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.success == 'S') {
                            toastr.success(response.msg);
                            setTimeout(function() {
                                window.location.href = "admin_dashboard.php";
                            }, 300);
                        } else {
                            toastr.error(response.msg);
                        }
                    },
                    error: function(error) {
                        console.log(error.responseText);
                    },
                });
            }
        );

    });

    function previewFile() {
        const file = document.querySelector('input[name=update_photo]').files[0];
        var reader = new FileReader();
        reader.onload = function(a) {
            console.log(a);
            $('#update_pic').attr('src', a.target.result);
        };
        reader.readAsDataURL(file);
    }

    function previewFiles() {
        const file = document.querySelector("input[name=picture]").files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            console.log(e);
            $('#preview_photo').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    }
    </script>
</body>

</html>