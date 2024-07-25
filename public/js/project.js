/**
 * This function makes a GET request to the server to retrieve the
 * project data
 */

getProjectData();
function getProjectData() {
    axios
        .get("/admin/get-project-data")
        .then(function (response) {
            if (response.status) {
                var data = response.data;
                $("#order-listing").removeClass("d-none");
                $("#loader").addClass("d-none");
                $('#order-listing').DataTable().destroy();
                $("#project_table").empty();

                $.each(data, function (i, project) {
                    $("<tr>")
                        .html(
                            `
                            <td>${project.image}</td>
                            <td>${project.title}</td>
                            <td>${project.description}</td>
                            <td>${project.url}</td>
                            <td>
                            
                            <a href="" data-id="${project.id}" data-toggle='modal' class="project-preview-btn btn btn-outline-success"><i class="fa fa-eye"></i></a>

                            </td>
                            <td>
                                <div class="">
                                    <a href="" data-id="${project.id}" data-toggle='modal' class="project-edit-btn btn btn-outline-warning"><i class="fa fa-edit"></i></a>
                                    <a href="" data-id="${project.id}" data-toggle='modal' class="project-delete-btn btn btn-outline-danger"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
  
                            `
                        )
                        .appendTo("#project_table");
                });

                $(".project-delete-btn").click(function () {
                    var id = $(this).data("id");
                    $("#deleteModal").modal("show");
                    $("#projectDeleteDisplayId").html(id);
                    $("#projectDeleteBtnConfirm").attr("data-id", id);
                });

                $(".project-preview-btn").click(function () {
                    var id = $(this).data("id");
                    $("#projectPreviewModal").modal("show");
                    $("#projectPreviewDisplayId").html(id);
                    getProjectPreview(id);
                });

                $(".project-edit-btn").click(function () {
                    var id = $(this).data("id");
                    $("#editModal").modal("show");
                    getProjectDetails(id);
                    $("#projectEditDisplayId").html(id);
                    $("#projectEditBtnConfirm").attr("data-id", id);
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
 * This function sends a POST request to the server to delete a project
 * The function takes a single parameter which is the ID of the project to be deleted
 */
function getProjectDelete(deleteID) {
    // <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    $("#projectDeleteBtnConfirm").html("<div class='spinner'></div>");
    axios
        .post("/admin/project-delete", { id: deleteID })
        .then(function (response) {
            $("#projectDeleteBtnConfirm").html("Yes");
            if (response.status == 200) {
                if (response.data == 1) {
                    getProjectData();
                    $("#deleteModal").modal("hide");
                    toastr.success("Delete Success");
                } else {
                    getProjectData();
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

$("#projectDeleteBtnConfirm").click(function () {
    // var id = $(this).data('id');
    const id = $("#projectDeleteDisplayId").text();
    // $("#deleteModal").modal("hide");
    id ? getProjectDelete(id) : "";
});

function getProjectPreview(updateID) {
    axios
        .post("/admin/project-details", { id: updateID })
        .then(function (response) {
            if (response.status == 200) {
                if (response.data) {
                    var data = response.data;
                    $("#projectPreviewModalBody").removeClass("d-none");
                    $("#projectPreviewLoader").addClass("d-none");
                    $("#projectPreviewImage").text(data[0]?.image);
                    $("#projectPreviewTitle").text(data[0]?.title);
                    $("#projectPreviewDes").text(data[0]?.description);
                    $("#projectPreviewUrl").text(data[0]?.url);
                } else {
                    $("#projectPreviewModal").modal("hide");
                    toastr.error("Update error");
                }
            } else {
                $("#projectPreviewModal").modal("hide");
                toastr.error("Some thing went wrong");
            }
        })
        .catch(function (error) {
            $("#projectPreviewModal").modal("hide");
            toastr.error("Internal server error");
            console.log(error);
        });
}

function getProjectDetails(updateID) {
    axios
        .post("/admin/project-details", { id: updateID })
        .then(function (response) {
            console.log(response);
            if (response.status == 200) {
                if (response.data) {
                    var data = response.data;
                    $("#editModalBody").removeClass("d-none");
                    $("#projectEditLoader").addClass("d-none");
                    $("#projectEditImage").val(data[0]?.image);
                    $("#projectEditTitle").val(data[0]?.title);
                    $("#projectEditDes").val(data[0]?.description);
                    $("#projectEditUrl").val(data[0]?.url);
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

function projectUpdate(updateID, data) {
    if (data.name == 0) {
        toastr.error("project name is required");
    } else if (data.des == 0) {
        toastr.error("project description is required");
    } else if (data.img == 0) {
        toastr.error("project image is required");
    } else {
        $("#projectEditBtnConfirm").html("<div class='spinner'></div>");
        axios
            .post("/admin/project-update", {
                id: updateID,
                image: data?.image,
                title: data?.title,
                description: data?.description,
                url: data?.url,
            })
            .then(function (response) {
                $("#projectEditBtnConfirm").html("Save");
                if (response.status == 200) {
                    if (response.data) {
                        $("#editModal").modal("hide");
                        getProjectData();
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

$("#projectEditBtnConfirm").click(function () {
    // var id = $(this).data('id');
    const id = $("#projectEditDisplayId").text();
    id
        ? projectUpdate(id, {
              image: $("#projectEditImage").val(),
              title: $("#projectEditTitle").val(),
              des: $("#projectEditDes").val(),
              url: $("#projectEditUrl").val(),
          })
        : "";
});

$("#projectAddNewBtnConfirm").click(function () {
    const data = {
        image: $("#projectAddNewImage").val(),
        title: $("#projectAddNewTitle").val(),
        description: $("#projectAddNewDes").val(),
        url: $("#projectAddNewUrl").val(),
    };
    insertProjectData(data);
});

$(".addProjectModal").click(function () {
    $("#addNewModal").modal("show");
});

function insertProjectData(data) {
    const { image, title, description, url } = data;
    if (image == 0) {
        toastr.error("project image is required");
    } 
    else if (title == 0) {
        toastr.error("project title is required");
    } else if (url == 0) {
        toastr.error("project description is required");
    } else {
        $("#projectAddNewBtnConfirm").html("<div class='spinner'></div>");
        axios
            .post("/admin/project-add-new", {
                image: data?.image,
                title: data?.title,
                description: data?.description,
                url: data?.url
            })
            .then(function (response) {
                $("#projectAddNewBtnConfirm").html("Save");
                if (response.status == 200) {
                    if (response.data) {
                        $("#addNewModal").modal("hide");
                        getProjectData();
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
