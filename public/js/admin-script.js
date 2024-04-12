function getServicesData () {
    axios.get('/admin/get-services-data')
    .then(function (response) {
        var data = response.data;

        $.each(data, function (i, service) {
            $('<tr>').html(
                "<td class='table-img'> <img src='{{" + service.services_img + "}}' class='img-sz' >  </td>" +
                "<td>" + service.services_img + "</td>" +
                "<td>" + service.services_name + "</td>" +
                "<td>" + service.services_des + "</td>" +
                "<td><a href='' class='btn btn-outline-warning'><i class='fa fa-edit'></i></a></td>" +
                "<td><a href='' class='btn btn-outline-danger'><i class='fa fa-trash'></i></a></td>"
            ).appendTo('#service_table');
        });
    })
    .catch(function (error) {
        console.log(error);
    })
}