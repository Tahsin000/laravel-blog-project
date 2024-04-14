/**
 * This function makes a GET request to the server to retrieve the
 * services data
 */
function getServicesData() {
    axios
        .get("/admin/get-services-data")
        .then(function (response) {
            if (response.status) {
                var data = response.data;
                $("#order-listing").removeClass("d-none");
                $("#loader").addClass("d-none");
                $("#service_table").empty();
                $.each(data, function (i, service) {
                    $("<tr>")
                        .html(
                            "<td class='table-img'> <img src='" +
                                "{{ asset('" +
                                service.services_img +
                                "') }}" +
                                "' class='img-sz' >  </td>" +
                                "<td>" +
                                service.services_name +
                                "</td>" +
                                "<td>" +
                                service.services_des +
                                "</td>" +
                                // data-toggle='modal' data-target='#deleteModal'
                                "<td> <div> <a href='' data-toggle='modal' data-id=" +
                                service.id +
                                " class='service-edit-btn btn btn-outline-warning'><i class='fa fa-edit'></i></a> <a href='' data-toggle='modal' data-id=" +
                                service.id +
                                " class='service-delete-btn btn btn-outline-danger'><i class='fa fa-trash'></i></a> </div> </td>"
                        )
                        .appendTo("#service_table");
                });

                $(".service-delete-btn").click(function () {
                    var id = $(this).data("id");
                    $("#deleteModal").modal("show");
                    $("#serviceDeleteDisplayId").html(id);
                    $("#serviceDeleteBtnConfirm").attr("data-id", id);
                });

                $(".service-edit-btn").click(function () {
                    var id = $(this).data("id");
                    $("#editModal").modal("show");
                    $("#serviceEditDisplayId").html(id);
                    getServicesDetails(id);
                    $("#serviceEditBtnConfirm").attr("data-id", id);
                });

                // $(".service-delete-btn").click(function () {
                //     $("#deleteModal").modal("show");
                //     var id = $(this).data("id");
                //     $("#serviceDeleteDisplayId").html(id);
                //     alert(id);
                // });
            } else {
                $("#loader").addClass("d-none");
                $("#wrongSection").removeClass("d-none");
            }
        })
        .catch(function (error) {
            console.log(error);

            $("#loader").addClass("d-none");
            $("#wrongSection").removeClass("d-none");
        });
}

/**
 * This function sends a POST request to the server to delete a service
 * The function takes a single parameter which is the ID of the service to be deleted
 */
function getServicesDelete(deleteID) {
    axios
        .post("/admin/services-delete", { id: deleteID })
        .then(function (response) {
            if (response.data == 1) {
                getServicesData();
                $("#deleteModal").modal("hide");
                toastr.success("Delete Success");
            } else {
                getServicesData();
                toastr.error("Delete Failed");
                $("#deleteModal").modal("hide");
            }
        })
        .catch(function (error) {
            toastr.error("Internal server error");
            console.log(error);
        });
}

$("#serviceDeleteBtnConfirm").click(function () {
    // var id = $(this).data('id');
    const id = $("#serviceDeleteDisplayId").text();
    $("#deleteModal").modal("hide");
    id ? getServicesDelete(id) : "";
});

function getServicesDetails(updateID) {
    axios
        .post("/admin/services-details", { id: updateID })
        .then(function (response) {
            if (response.data) {
                var data = response.data;
                $("#editModalBody").removeClass("d-none");
                $("#serviceEditLoader").addClass("d-none");
                $("#serviceEditName").val(data[0]?.services_name);
                $("#serviceEditDes").val(data[0]?.services_des);
                $("#serviceEditImg").val(data[0]?.services_img);
            } else {
                $("#serviceEditLoader").removeClass("d-none");
                $("#serviceEditError").addClass("d-none");
            }
        })
        .catch(function (error) {
            toastr.error("Internal server error");
            console.log(error);
        });
}

function servicesUpdate(updateID, data) {
    axios
        .post("/admin/services-update", {
            id: updateID,
            services_name: data?.name,
            services_des: data?.des,
            services_img: data?.img,
        })
        .then(function (response) {
            if (response.data) {
                $("#editModal").modal("hide");
                getServicesData();
                toastr.success("Update successfully");
            } else {
                toastr.error("Update error");
            }
        })
        .catch(function (error) {
            toastr.error("Internal server error");
            console.log(error);
        });
}

$("#serviceEditBtnConfirm").click(function () {
    // var id = $(this).data('id');
    const id = $("#serviceEditDisplayId").text();
    id
        ? servicesUpdate(id, {
              name: $("#serviceEditName").val(),
              des: $("#serviceEditDes").val(),
              img: $("#serviceEditImg").val(),
          })
        : "";
});
