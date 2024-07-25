/**
 * This function makes a GET request to the server to retrieve the
 * contact data
 */

getContactData();
function getContactData() {
    axios
        .get("/admin/get-contact-data")
        .then(function (response) {
            if (response.status) {
                var data = response.data;
                $("#order-listing").removeClass("d-none");
                $("#loader").addClass("d-none");
                $('#order-listing').DataTable().destroy();
                $("#contact_table").empty();

                $.each(data, function (i, contact) {
                    $("<tr>")
                        .html(
                            `
                            <td>${contact.contact_name}</td>
                            <td>${contact.contact_mobile}</td>
                            <td>${contact.contact_email}</td>
                            <td>${contact.contact_msg}</td>
                            <td>
                                <div class="">
                                    <a href="" data-id="${contact.id}" data-toggle='modal' class="contact-delete-btn btn btn-outline-danger"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
  
                            `
                        )
                        .appendTo("#contact_table");
                });

                $(".contact-delete-btn").click(function () {
                    var id = $(this).data("id");
                    $("#deleteModal").modal("show");
                    $("#contactDeleteDisplayId").html(id);
                    $("#contactDeleteBtnConfirm").attr("data-id", id);
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
 * This function sends a POST request to the server to delete a contact
 * The function takes a single parameter which is the ID of the contact to be deleted
 */
function getContactDelete(deleteID) {
    // <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    $("#contactDeleteBtnConfirm").html("<div class='spinner'></div>");
    axios
        .post("/admin/contact-delete", { id: deleteID })
        .then(function (response) {
            $("#contactDeleteBtnConfirm").html("Yes");
            if (response.status == 200) {
                if (response.data == 1) {
                    getContactData();
                    $("#deleteModal").modal("hide");
                    toastr.success("Delete Success");
                } else {
                    getContactData();
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

$("#contactDeleteBtnConfirm").click(function () {
    // var id = $(this).data('id');
    const id = $("#contactDeleteDisplayId").text();
    // $("#deleteModal").modal("hide");
    id ? getContactDelete(id) : "";
});


