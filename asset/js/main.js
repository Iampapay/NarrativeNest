$(document).ready(function() {
    // Initialize Tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Add smooth scrolling to all links in navbar + footer link
    $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {

            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 900, function() {

                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        } // End if
    });
})

// for user singup
$("#user_signup").validate({
    rules: {
        username: {
            required: true,
        },
        password: {
            required: true,
        },
        cpassword: {
            required: true,
            equalTo: '#u_pass',
        },
        check_me: {
            required: true,
        }
    },
    messages: {
        username: "Please enter your user name",
        password: "Please, enter your Password",
        cpassword: "Please, reenter your Password",
        check_me: "Please, check me first",
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
        var formData = $('#user_signup').serialize();

        $.ajax({
            type: 'POST',
            url: "../controller/User_SignupCtrl.php",
            data: formData,
            dataType: 'json',
            success: function(res) {
                console.log(res);
                if ((res.success) == 'S') {
                    toastr.success(res.msg);
                    setTimeout(function() {
                        window.location.href = "./user_login.php";
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

// for user login
$("#user_login").validate({
    rules: {
        user_name: {
            required: true,
        },
        user_pass: {
            required: true,
        }
    },
    messages: {
        user_name: "Enter your user id",
        user_pass: "Please! Enter your Password",
    },
    highlights: function(element, errorClass) {
        $(element).parent().addClass('error');
        $(element).addClass('error');
    },
    unhighlights: function(element, errorClass, validClass) {
        $(element).parent().removeClass('error');
        $(element).removeClass('error');
    },
    submitHandler: function() {
        var formData = $('#user_login').serialize();

        $.ajax({
            type: 'POST',
            url: "../controller/User_LoginCtrl.php",
            data: formData,
            dataType: 'json',
            success: function(res) {
                console.log(res);
                if (res.success == 'S') {
                    toastr.success(res.msg);
                    setTimeout(function() {
                        window.location.href = "./index.php";
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

// for admin login
$(".a_log").on('click', function() {
    $("#Admin_modal").modal('show');
    $("#admin_login").validate({
        rules: {
            user_name: {
                required: true,
            },
            admin_pass: {
                required: true,
            }
        },
        messages: {
            user_name: "Please enter your user name",
            admin_pass: "Please, enter your Password",
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
            var formData = $('#admin_login').serialize();

            $.ajax({
                type: 'POST',
                url: "../controller/Admin_LoginCtrl.php",
                data: formData,
                dataType: 'json',
                success: function(res) {
                    // console.log(res);
                    if ((res.success) == 'S') {
                        toastr.success(res.msg);
                        setTimeout(function() {
                            window.location.href = "../../blog/view/admin_view/index.php";
                        }, 1000);
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

// for read more button
$(".user_view").on('click', function() {
    $("#viewModal").modal('show');
    var b_id = $(this).data('view_auto_id');
    $.ajax({
        type: 'POST',
        url: "../controller/BlogDetailsModalCtrl.php",
        data: {
            blog_id: b_id
        },
        dataType: 'json',
        success: function(res) {
            console.log(res);
            if (res.success == "S") {
                $(".post_title").html(res.userdata.blog_title);
                $(".post_date").html(res.userdata.created_date_time);
                $(".post_category").html(res.userdata.blog_category);
                $('#p_id').val(b_id);
                var image = '../uploads/' + res.userdata.blog_photo;
                $('.post_image').attr("src", image);
                $(".post_desc").html(res.userdata.blog_description);
                var comment_array = res.comment;
                var comment_html = '';
                jQuery.each(comment_array, function(i, array) {
                    // console.log(array);
                    comment_html += '<ul class="text-right"><div><p class="m-b-0">' + array.blog_comment +
                        '</p><p>' + array.commented_by +','+ array.date_time +
                        '</p></div></ul>'
                });
                $('.all_comment').html(comment_html);
            } else {
                toastr.error("No data found");
            }
        },
        error: function(error) {
            console.log(error.responseText);
        }
    });
});

//for comment button
$(".user_comment").on('click', function() {
    $("#comment_form").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
            },
            comments: {
                required: true,
            }
        },
        messages: {
            name: "Please enter your name",
            email: "Please enter your email address",
            comments: "Please leave a comment",
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
            var formData = $('#comment_form').serialize();
            console.log(formData);
            $.ajax({
                type: 'POST',
                url: "../controller/User_CommentCtrl.php",
                data: formData,
                dataType: 'json',
                success: function(comment) {
                    // console.log(comment);
                    if ((comment.success) == 'S') {
                        toastr.success(comment.msg);
                        setTimeout(function() {
                            window.location.href = "./index.php";
                            location.reload();
                        }, 100);
                    } else {
                        toastr.error(comment.msg);
                    }

                },
                error: function(error) {
                    console.log(error.responseText);
                },
            });
        }
    });
});

// for user massage
$(".user_msg").on('click', function() {
    $("#msg_form").validate({
        rules: {
            u_name: {
                required: true,
            },
            u_email: {
                required: true,
            },
            u_massage: {
                required: true,
            }
        },
        messages: {
            u_name: "Please enter your name",
            u_email: "Please enter your email address",
            u_massage: "Please write a massage",
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
            var formData = $('#msg_form').serialize();
            // console.log(formData);
            $.ajax({
                type: 'POST',
                url: "../controller/User_MassageCtrl.php",
                data: formData,
                dataType: 'json',
                success: function(comment) {
                    // console.log(comment);
                    if ((comment.success) == 'S') {
                        toastr.success(comment.msg);
                        setTimeout(function() {
                            window.location.href = "./index.php";
                            location.reload();
                        }, 100);
                    } else {
                        toastr.error(comment.msg);
                    }

                },
                error: function(error) {
                    console.log(error.responseText);
                },
            });
        }
    });
});

// for user like
$('.like-btn').on('click', function() {
    var blog_id = $(this).data('like_id');
    $clicked_btn = $(this);
    //console.log(blog_id);
    $.ajax({
        type: 'POST',
        url: "../controller/Like_DislikeCtrl.php",
        data: {
            bg_id: blog_id
        },
        dataType: 'json',
        success: function(response) {
            // console.log(response);
            if ((response.success) == 'S') {
                toastr.success(response.msg);
                setTimeout(function() {
                    window.location.href = "./index.php";
                    location.reload();
                }, 500);

                $clicked_btn.removeClass('fa-thumbs-o-up');
                $clicked_btn.addClass('fa-thumbs-up');
            } else {
                toastr.error(response.msg);
            }
        },
        error: function(error) {
            console.log(error.responseText);
        },
    });
});

// for highlight like button

// $('.like-btn').on('click', function() {
//     // $('.like-btn').off("click");
//     var blog_id = $(this).data('like_id');
//     $clicked_btn = $(this);
//     // $clicked_btn.hasClass('fa-thumbs-o-up');
//     // $clicked_btn.removeClass('fa-thumbs-o-up');
//     // $clicked_btn.addClass('fa-thumbs-up');
// });