/**
 * This function makes a GET request to the server to retrieve the
 * review data
 */

getReviewData();
function getReviewData() {
    axios
        .get("/admin/get-review-data")
        .then(function (response) {
            if (response.status) {
                var data = response.data;
                $("#order-listing").removeClass("d-none");
                $("#loader").addClass("d-none");
                $('#order-listing').DataTable().destroy();
                $("#review_table").empty();

                $.each(data, function (i, review) {
                    $("<tr>")
                        .html(
                            `
                            <td>${review.image}</td>
                            <td>${review.name}</td>
                            <td>${review.description}</td>
                            <td>
                            
                            <a href="" data-id="${review.id}" data-toggle='modal' class="review-preview-btn btn btn-outline-success"><i class="fa fa-eye"></i></a>

                            </td>
                            <td>
                                <div class="">
                                    <a href="" data-id="${review.id}" data-toggle='modal' class="review-edit-btn btn btn-outline-warning"><i class="fa fa-edit"></i></a>
                                    <a href="" data-id="${review.id}" data-toggle='modal' class="review-delete-btn btn btn-outline-danger"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
  
                            `
                        )
                        .appendTo("#review_table");
                });

                $(".review-delete-btn").click(function () {
                    var id = $(this).data("id");
                    $("#deleteModal").modal("show");
                    $("#reviewDeleteDisplayId").html(id);
                    $("#reviewDeleteBtnConfirm").attr("data-id", id);
                });

                $(".review-preview-btn").click(function () {
                    var id = $(this).data("id");
                    $("#reviewPreviewModal").modal("show");
                    $("#reviewPreviewDisplayId").html(id);
                    getReviewPreview(id);
                });

                $(".review-edit-btn").click(function () {
                    var id = $(this).data("id");
                    $("#editModal").modal("show");
                    getReviewDetails(id);
                    $("#reviewEditDisplayId").html(id);
                    $("#reviewEditBtnConfirm").attr("data-id", id);
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
 * This function sends a POST request to the server to delete a review
 * The function takes a single parameter which is the ID of the review to be deleted
 */
function getReviewDelete(deleteID) {
    // <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    $("#reviewDeleteBtnConfirm").html("<div class='spinner'></div>");
    axios
        .post("/admin/review-delete", { id: deleteID })
        .then(function (response) {
            $("#reviewDeleteBtnConfirm").html("Yes");
            if (response.status == 200) {
                if (response.data == 1) {
                    getReviewData();
                    $("#deleteModal").modal("hide");
                    toastr.success("Delete Success");
                } else {
                    getReviewData();
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

$("#reviewDeleteBtnConfirm").click(function () {
    // var id = $(this).data('id');
    const id = $("#reviewDeleteDisplayId").text();
    // $("#deleteModal").modal("hide");
    id ? getReviewDelete(id) : "";
});

function getReviewPreview(updateID) {
    axios
        .post("/admin/review-details", { id: updateID })
        .then(function (response) {
            if (response.status == 200) {
                if (response.data) {
                    var data = response.data;
                    $("#reviewPreviewModalBody").removeClass("d-none");
                    $("#reviewPreviewLoader").addClass("d-none");
                    $("#reviewPreviewName").text(data[0]?.name);
                    $("#reviewPreviewDes").text(data[0]?.description);
                    $("#reviewPreviewImage").text(data[0]?.image);
                } else {
                    $("#reviewPreviewModal").modal("hide");
                    toastr.error("Update error");
                }
            } else {
                $("#reviewPreviewModal").modal("hide");
                toastr.error("Some thing went wrong");
            }
        })
        .catch(function (error) {
            $("#reviewPreviewModal").modal("hide");
            toastr.error("Internal server error");
            console.log(error);
        });
}

function getReviewDetails(updateID) {
    axios
        .post("/admin/review-details", { id: updateID })
        .then(function (response) {
            console.log(response);
            if (response.status == 200) {
                if (response.data) {
                    var data = response.data;
                    $("#editModalBody").removeClass("d-none");
                    $("#reviewEditLoader").addClass("d-none");
                    $("#reviewEditName").val(data[0]?.name);
                    $("#reviewEditDes").val(data[0]?.description);
                    $("#reviewEditImage").val(data[0]?.image);
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

function reviewUpdate(updateID, data) {
    if (data.name == 0) {
        toastr.error("review name is required");
    } else if (data.des == 0) {
        toastr.error("review description is required");
    } else if (data.img == 0) {
        toastr.error("review image is required");
    } else {
        $("#reviewEditBtnConfirm").html("<div class='spinner'></div>");
        axios
            .post("/admin/review-update", {
                id: updateID,
                name: data?.name,
                description: data?.description,
                image: data?.image,
            })
            .then(function (response) {
                $("#reviewEditBtnConfirm").html("Save");
                if (response.status == 200) {
                    if (response.data) {
                        $("#editModal").modal("hide");
                        getReviewData();
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

$("#reviewEditBtnConfirm").click(function () {
    // var id = $(this).data('id');
    const id = $("#reviewEditDisplayId").text();
    id
        ? reviewUpdate(id, {
              name: $("#reviewEditName").val(),
              description: $("#reviewEditDes").val(),
              image: $("#reviewEditImage").val()
          })
        : "";
});

$("#reviewAddNewBtnConfirm").click(function () {
    const data = {
        name: $("#reviewAddNewName").val(),
        description: $("#reviewAddNewDes").val(),
        image: $("#reviewAddNewImage").val(),
    };
    insertReviewData(data);
});

$(".addReviewModal").click(function () {
    $("#addNewModal").modal("show");
});

function insertReviewData(data) {
    const { image, name, description } = data;
    if (image == 0) {
        toastr.error("review image is required");
    } 
    else if (name == 0) {
        toastr.error("review name is required");
    } else if (description == 0) {
        toastr.error("review description is required");
    } else {
        $("#reviewAddNewBtnConfirm").html("<div class='spinner'></div>");
        axios
            .post("/admin/review-add-new", {
                image: data?.image,
                name: data?.name,
                description: data?.description,
            })
            .then(function (response) {
                $("#reviewAddNewBtnConfirm").html("Save");
                if (response.status == 200) {
                    if (response.data) {
                        $("#addNewModal").modal("hide");
                        getReviewData();
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
