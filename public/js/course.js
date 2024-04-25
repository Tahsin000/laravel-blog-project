/**
 * This function makes a GET request to the server to retrieve the
 * courses data
 */

getCoursesData();
function getCoursesData() {
    axios
        .get("/admin/get-course-data")
        .then(function (response) {
            if (response.status) {
                var data = response.data;
                $("#order-listing").removeClass("d-none");
                $("#loader").addClass("d-none");
                $('#order-listing').DataTable().destroy();
                $("#course_table").empty();

                $.each(data, function (i, course) {
                    $("<tr>")
                        .html(
                            `
                            <td>${course.course_name}</td>
                            <td>${course.course_fee}</td>
                            <td>${course.course_totalclass}</td>
                            <td>${course.course_totalenroll}</td>
                            <td>
                            
                            <a href="" data-id="${course.id}" data-toggle='modal' class="course-preview-btn btn btn-outline-success"><i class="fa fa-eye"></i></a>

                            </td>
                            <td>
                                <div class="">
                                    <a href="" data-id="${course.id}" data-toggle='modal' class="course-edit-btn btn btn-outline-warning"><i class="fa fa-edit"></i></a>
                                    <a href="" data-id="${course.id}" data-toggle='modal' class="course-delete-btn btn btn-outline-danger"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
  
                            `
                        )
                        .appendTo("#course_table");
                });

                $(".course-delete-btn").click(function () {
                    var id = $(this).data("id");
                    $("#deleteModal").modal("show");
                    $("#courseDeleteDisplayId").html(id);
                    $("#courseDeleteBtnConfirm").attr("data-id", id);
                });

                $(".course-preview-btn").click(function () {
                    var id = $(this).data("id");
                    $("#coursePreviewModal").modal("show");
                    $("#coursePreviewDisplayId").html(id);
                    getCoursesPreview(id);
                });

                $(".course-edit-btn").click(function () {
                    var id = $(this).data("id");
                    $("#editModal").modal("show");
                    getCoursesDetails(id);
                    $("#courseEditDisplayId").html(id);
                    $("#courseEditBtnConfirm").attr("data-id", id);
                });

            //    dataTable
                $('#order-listing').DataTable();
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
 * This function sends a POST request to the server to delete a course
 * The function takes a single parameter which is the ID of the course to be deleted
 */
function getCoursesDelete(deleteID) {
    // <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    $("#courseDeleteBtnConfirm").html("<div class='spinner'></div>");
    axios
        .post("/admin/course-delete", { id: deleteID })
        .then(function (response) {
            $("#courseDeleteBtnConfirm").html("Yes");
            if (response.status == 200) {
                if (response.data == 1) {
                    getCoursesData();
                    $("#deleteModal").modal("hide");
                    toastr.success("Delete Success");
                } else {
                    getCoursesData();
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

$("#courseDeleteBtnConfirm").click(function () {
    // var id = $(this).data('id');
    const id = $("#courseDeleteDisplayId").text();
    // $("#deleteModal").modal("hide");
    id ? getCoursesDelete(id) : "";
});

function getCoursesPreview(updateID) {
    axios
        .post("/admin/course-details", { id: updateID })
        .then(function (response) {
            if (response.status == 200) {
                if (response.data) {
                    var data = response.data;
                    $("#coursePreviewModalBody").removeClass("d-none");
                    $("#coursePreviewLoader").addClass("d-none");
                    $("#coursePreviewName").text(data[0]?.course_name);
                    $("#coursePreviewDes").text(data[0]?.course_des);
                    $("#coursePreviewFee").text(data[0]?.course_fee);
                    $("#coursePreviewTotalEnroll").text(
                        data[0]?.course_totalenroll
                    );
                    $("#coursePreviewTotalClass").text(
                        data[0]?.course_totalclass
                    );
                    $("#coursePreviewLink").text(data[0]?.course_link);
                    $("#coursePreviewImg").text(data[0]?.course_img);
                } else {
                    $("#coursePreviewModal").modal("hide");
                    toastr.error("Update error");
                }
            } else {
                $("#coursePreviewModal").modal("hide");
                toastr.error("Some thing went wrong");
            }
        })
        .catch(function (error) {
            $("#coursePreviewModal").modal("hide");
            toastr.error("Internal server error");
            console.log(error);
        });
}

function getCoursesDetails(updateID) {
    axios
        .post("/admin/course-details", { id: updateID })
        .then(function (response) {
            if (response.status == 200) {
                if (response.data) {
                    var data = response.data;
                    $("#editModalBody").removeClass("d-none");
                    $("#courseEditLoader").addClass("d-none");
                    $("#courseEditName").val(data[0].course_name);
                    $("#courseEditDes").val(data[0].course_des);
                    $("#courseEditFee").val(data[0]?.course_fee);
                    $("#courseEditTotalEnroll").val(data[0].course_totalenroll);
                    $("#courseEditTotalClass").val(data[0].course_totalclass);
                    $("#courseEditLink").val(data[0]?.course_link);
                    $("#courseEditImg").val(data[0]?.course_img);
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

function coursesUpdate(updateID, data) {
    if (data.name == 0) {
        toastr.error("course name is required");
    } else if (data.des == 0) {
        toastr.error("course description is required");
        // toastr.error("Please enter course description");
    } else if (data.img == 0) {
        toastr.error("course image is required");
        // toastr.error("Please enter course image");
    } else {
        $("#courseEditBtnConfirm").html("<div class='spinner'></div>");
        axios
            .post("/admin/course-update", {
                id: updateID,
                course_name: data?.name,
                course_des: data?.des,
                course_fee: data?.fee,
                course_totalenroll: data?.totalEnroll,
                course_totalclass: data?.totalClass,
                course_link: data?.link,
                course_img: data?.img,
            })
            .then(function (response) {
                $("#courseEditBtnConfirm").html("Save");
                if (response.status == 200) {
                    if (response.data) {
                        $("#editModal").modal("hide");
                        getCoursesData();
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

$("#courseEditBtnConfirm").click(function () {
    // var id = $(this).data('id');
    const id = $("#courseEditDisplayId").text();
    id
        ? coursesUpdate(id, {
              name: $("#courseEditName").val(),
              des: $("#courseEditDes").val(),
              fee: $("#courseEditFee").val(),
              totalEnroll: $("#courseEditTotalEnroll").val(),
              totalClass: $("#courseEditTotalClass").val(),
              link: $("#courseEditLink").val(),
              img: $("#courseEditImg").val(),
          })
        : "";
});

$("#courseAddNewBtnConfirm").click(function () {
    const data = {
        name: $("#courseAddNewName").val(),
        des: $("#courseAddNewDes").val(),
        fee: $("#courseAddNewFee").val(),
        totalEnroll: $("#courseAddNewTotalEnroll").val(),
        totalClass: $("#courseAddNewTotalClass").val(),
        link: $("#courseAddNewLink").val(),
        img: $("#courseAddNewImg").val(),
    };
    insertCoursesData(data);
});

$(".addCourseModal").click(function () {
    $("#addNewModal").modal("show");
});

function insertCoursesData(data) {
    const { name, des, img, fee, totalEnroll, totalClass, link } = data;
    if (name == 0) {
        toastr.error("course name is required");
    } else if (des == 0) {
        toastr.error("course description is required");
    } else if (img == 0) {
        toastr.error("course image is required");
    } else if (fee == 0) {
        toastr.error("course fee is required");
    } else if (totalEnroll == 0) {
        toastr.error("course total enroll is required");
    } else if (totalClass == 0) {
        toastr.error("course total class is required");
    } else if (link == 0) {
        toastr.error("course link is required");
    } else {
        $("#courseAddNewBtnConfirm").html("<div class='spinner'></div>");
        axios
            .post("/admin/course-add-new", {
                course_name: data?.name,
                course_des: data?.des,
                course_fee: data?.fee,
                course_totalenroll: data?.totalEnroll,
                course_totalclass: data?.totalClass,
                course_link: data?.link,
                course_img: data?.img,
            })
            .then(function (response) {
                $("#courseAddNewBtnConfirm").html("Save");
                if (response.status == 200) {
                    if (response.data) {
                        $("#addNewModal").modal("hide");
                        getCoursesData();
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
