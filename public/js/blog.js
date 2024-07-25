/**
 * This function makes a GET request to the server to retrieve the
 * blog data
 */

getBlogData();
function getBlogData() {
    axios
        .get("/admin/get-blog-data")
        .then(function (response) {
            if (response.status) {
                var data = response.data;
                $("#order-listing").removeClass("d-none");
                $("#loader").addClass("d-none");
                $('#order-listing').DataTable().destroy();
                $("#blog_table").empty();

                $.each(data, function (i, blog) {
                    $("<tr>")
                        .html(
                            `
                            <td>${blog.image}</td>
                            <td>${blog.title}</td>
                            <td>${blog.description}</td>
                            <td>
                            
                            <a href="" data-id="${blog.id}" data-toggle='modal' class="blog-preview-btn btn btn-outline-success"><i class="fa fa-eye"></i></a>

                            </td>
                            <td>
                                <div class="">
                                    <a href="" data-id="${blog.id}" data-toggle='modal' class="blog-edit-btn btn btn-outline-warning"><i class="fa fa-edit"></i></a>
                                    <a href="" data-id="${blog.id}" data-toggle='modal' class="blog-delete-btn btn btn-outline-danger"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
  
                            `
                        )
                        .appendTo("#blog_table");
                });

                $(".blog-delete-btn").click(function () {
                    var id = $(this).data("id");
                    $("#deleteModal").modal("show");
                    $("#blogDeleteDisplayId").html(id);
                    $("#blogDeleteBtnConfirm").attr("data-id", id);
                });

                $(".blog-preview-btn").click(function () {
                    var id = $(this).data("id");
                    $("#blogPreviewModal").modal("show");
                    $("#blogPreviewDisplayId").html(id);
                    getBlogPreview(id);
                });

                $(".blog-edit-btn").click(function () {
                    var id = $(this).data("id");
                    $("#editModal").modal("show");
                    getBlogDetails(id);
                    $("#blogEditDisplayId").html(id);
                    $("#blogEditBtnConfirm").attr("data-id", id);
                });

            //    dataTable
                $('#order-listing').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');


            } else {
                $("#loader").addClass("d-none");
                $("#wrongSection").removeClass("d-none");
            }
        })
        .catch(function (error) {
            console.log(error);
            $("#editModal").modal("hide");
            $("#loader").addClass("d-none");
            $("#wrongSection").removeClass("d-none");
        });
}

/**
 * This function sends a POST request to the server to delete a blog
 * The function takes a single parameter which is the ID of the blog to be deleted
 */
function getBlogDelete(deleteID) {
    // <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    $("#blogDeleteBtnConfirm").html("<div class='spinner'></div>");
    axios
        .post("/admin/blog-delete", { id: deleteID })
        .then(function (response) {
            $("#blogDeleteBtnConfirm").html("Yes");
            if (response.status == 200) {
                if (response.data == 1) {
                    getBlogData();
                    $("#deleteModal").modal("hide");
                    toastr.success("Delete Success");
                } else {
                    getBlogData();
                    toastr.error("Delete Failed");
                    $("#deleteModal").modal("hide");
                }
            } else {
                $("#deleteModal").modal("hide");
                toastr.error("Some thing went wrong");
            }
        })
        .catch(function (error) {
            $("#editModal").modal("hide");
            toastr.error("Internal server error");
            console.log(error);
        });
}

$("#blogDeleteBtnConfirm").click(function () {
    // var id = $(this).data('id');
    const id = $("#blogDeleteDisplayId").text();
    // $("#deleteModal").modal("hide");
    id ? getBlogDelete(id) : "";
});

function getBlogPreview(updateID) {
    axios
        .post("/admin/blog-details", { id: updateID })
        .then(function (response) {
            if (response.status == 200) {
                if (response.data) {
                    var data = response.data;
                    $("#blogPreviewModalBody").removeClass("d-none");
                    $("#blogPreviewLoader").addClass("d-none");
                    $("#blogPreviewName").text(data[0]?.title);
                    $("#blogPreviewDes").text(data[0]?.description);
                    $("#blogPreviewImage").text(data[0]?.image);
                } else {
                    $("#blogPreviewModal").modal("hide");
                    toastr.error("Update error");
                }
            } else {
                $("#blogPreviewModal").modal("hide");
                toastr.error("Some thing went wrong");
            }
        })
        .catch(function (error) {
            $("#blogPreviewModal").modal("hide");
            toastr.error("Internal server error");
            console.log(error);
        });
}

function getBlogDetails(updateID) {
    axios
        .post("/admin/blog-details", { id: updateID })
        .then(function (response) {
            console.log(response);
            if (response.status == 200) {
                if (response.data) {
                    var data = response.data;
                    $("#editModalBody").removeClass("d-none");
                    $("#blogEditLoader").addClass("d-none");
                    $("#blogEditName").val(data[0]?.title);
                    $("#blogEditDes").val(data[0]?.description);
                    $("#blogEditImage").val(data[0]?.image);
                    $("#editModal").modal("hide");
                } else {
                    $("#editModal").modal("hide");
                    toastr.error("Data get error");
                }
            } else {
                $("#editModal").modal("hide");
                toastr.error("Some thing went wrong");
            }
        })
        .catch(function (error) {
            $("#editModal").modal("hide");
            toastr.error("Internal server error");
            console.log(error);
        });
}

function blogUpdate(updateID, data) {
    if (data.title == 0) {
        toastr.error("blog title is required");
    } else if (data.description == 0) {
        toastr.error("blog description is required");
    } else if (data.image == 0) {
        toastr.error("blog image is required");
    } else {
        $("#blogEditBtnConfirm").html("<div class='spinner'></div>");
        axios
            .post("/admin/blog-update", {
                id: updateID,
                title: data?.title,
                description: data?.description,
                image: data?.image,
            })
            .then(function (response) {
                $("#blogEditBtnConfirm").html("Save");
                if (response.status == 200) {
                    if (response.data) {
                        $("#editModal").modal("hide");
                        getBlogData();
                        toastr.success("Update successfully");
                    } else {
                        $("#editModal").modal("hide");
                        toastr.error("Update error");
                    }
                } else {
                    $("#editModal").modal("hide");
                    toastr.error("Some thing went wrong");
                }
            })
            .catch(function (error) {
                $("#editModal").modal("hide");
                toastr.error("Internal server error");
                console.log(error);
            });
    }
}

$("#blogEditBtnConfirm").click(function () {
    // var id = $(this).data('id');
    const id = $("#blogEditDisplayId").text();
    id
        ? blogUpdate(id, {
              title: $("#blogEditName").val(),
              description: $("#blogEditDes").val(),
              image: $("#blogEditImage").val()
          })
        : "";
});

$("#blogAddNewBtnConfirm").click(function () {
    const data = {
        title: $("#blogAddNewName").val(),
        description: $("#blogAddNewDes").val(),
        image: $("#blogAddNewImage").val(),
    };
    insertBlogData(data);
});

$(".addBlogModal").click(function () {
    $("#addNewModal").modal("show");
});

function insertBlogData(data) {
    const { image, title, description } = data;
    if (image == 0) {
        toastr.error("blog image is required");
    } 
    else if (title == 0) {
        toastr.error("blog title is required");
    } else if (description == 0) {
        toastr.error("blog description is required");
    } else {
        $("#blogAddNewBtnConfirm").html("<div class='spinner'></div>");
        axios
            .post("/admin/blog-add-new", {
                image: data?.image,
                title: data?.title,
                description: data?.description,
            })
            .then(function (response) {
                $("#blogAddNewBtnConfirm").html("Save");
                if (response.status == 200) {
                    if (response.data) {
                        $("#addNewModal").modal("hide");
                        getBlogData();
                        toastr.success("Added successfully");
                    } else {
                        $("#addNewModal").modal("hide");
                        toastr.error("Added error");
                    }
                } else {
                    $("#addNewModal").modal("hide");
                    toastr.error("Some thing went wrong");
                }
            })
            .catch(function (error) {
                $("#addNewModal").modal("hide");
                toastr.error("Internal server error");
                console.log(error);
            });
    }
}
