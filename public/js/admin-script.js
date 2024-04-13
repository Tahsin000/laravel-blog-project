function getServicesData() {
    axios
        .get("/admin/get-services-data")
        .then(function (response) {
            if (response.status) {
                var data = response.data;
                $('#order-listing').removeClass('d-none');
                $('#loader').addClass('d-none');
                $('#service_table').empty();
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
                                "<td> <div> <a href='' class='btn btn-outline-warning'><i class='fa fa-edit'></i></a> <a href='' data-toggle='modal' data-id=" +
                                service.id +
                                " class='service-delete-btn btn btn-outline-danger'><i class='fa fa-trash'></i></a> </div> </td>"
                        )
                        .appendTo("#service_table");
                });

                $('.service-delete-btn').click(function () {
                    var id = $(this).data("id");
                    $('#deleteModal').modal('show');
                    $("#serviceDeleteDisplayId").html(id);
                    $('#serviceDeleteBtnConfirm').attr('data-id', id);
                });

                $('#serviceDeleteBtnConfirm').click(function () {
                    // var id = $(this).data('id');
                    const id = $('#serviceDeleteDisplayId').text();
                    $('#deleteModal').modal('hide');
                    console.log(id);
                    getServicesDelete(id);
                });

                // $(".service-delete-btn").click(function () {
                //     $("#deleteModal").modal("show");
                //     var id = $(this).data("id");
                //     $("#serviceDeleteDisplayId").html(id);
                //     alert(id);
                // });
            } else {
                $('#loader').addClass('d-none');
                $('#wrongSection').removeClass('d-none');
            }
        })
        .catch(function (error) {
            console.log(error);

            $('#loader').addClass('d-none');
            $('#wrongSection').removeClass('d-none');
        });
}

function getServicesDelete(deleteID) {
    axios
        .post('/admin/services-delete', { id: deleteID })
        .then(function (response) {
            if (response.data == 1) {
                console.log(response.data);
                toastr.success('Delete Success');
                $('#deleteModal').modal('hide');
                getServicesData();
            } else {
                toastr.error('Delete Failed');
                $('#deleteModal').modal('hide');
                getServicesData();
            }
        })
        .catch(function (error) {
            toastr.error('Internal server error');
            console.log(error);
        });
}
