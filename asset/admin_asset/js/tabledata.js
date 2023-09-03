// for add blog using form 
$("#add_form_data").validate({
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
            url: "../../controller/Blog_AddCtrl.php",
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                // console.log(res);
                if (res.success == 'S') {
                    toastr.success(res.msg);
                    setTimeout(function() {
                        location.reload();
                        window.location.href =
                            "../../view/admin_view/form.php";
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

// for add blog using modal
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
                    // console.log(res);
                    if (res.success == 'S') {
                        toastr.success(res.msg);
                        setTimeout(function() {
                            location.reload();
                            window.location.href =
                                "../../view/admin_view/form.php";
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
        url: "../../controller/Blog_EditCtrl.php",
        data: {
            edit_id: edit_id
        },
        dataType: 'json',
        success: function(response) {
            // console.log(response);
            $("#edit_modal").modal('show');
            $("#h_id").val(response.id);
            $("#bg_title").val(response.blog_title);
            $("#bg_desc").val(response.blog_desc);
            $('#old_image').val(response.blog_photo);
            var image = '../../uploads/' + response.blog_photo;
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
            url: "../../controller/Blog_UpdateCtrl.php",
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(update) {
                // console.log(update);
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
        url: "../../controller/Status_UpdateCtrl.php",
        data: {
            blog_id: b_id,
            blog_status: b_status
        },
        dataType: 'json',
        success: function(response) {
            // console.log(response);
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
    alert("okkk");
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
                url: "../../controller/Blog_DeleteCtrl.php",
                data: {
                    d_id: delete_id
                },
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    if (response.success == 'S') {
                        toastr.success(response.msg);
                        setTimeout(function() {
                            window.location.href = "table.php";
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

// file preview for update photo 
function previewFile() {
    const file = document.querySelector('input[name=update_photo]').files[0];
    var reader = new FileReader();
    reader.onload = function(a) {
        console.log(a);
        $('#update_pic').attr('src', a.target.result);
    };
    reader.readAsDataURL(file);
}

// file preview for photo 
function previewFiles() {
    const file = document.querySelector("input[name=picture]").files[0];
    var reader = new FileReader();
    reader.onload = function(e) {
        console.log(e);
        $('#preview_photo').attr('src', e.target.result);
    };
    reader.readAsDataURL(file);
}

// for search content details from table 
$(document).ready(function(){
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#user_table tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    });

// for search user query from table 
$(document).ready(function(){
$("#queryInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#user_msg tr").filter(function() {
    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});
});