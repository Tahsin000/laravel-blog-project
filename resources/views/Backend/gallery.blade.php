@extends('Backend.Layout.app')

@section('title', 'Gallery | HHJN')

@section('admin-style')
    <style>
        #imgPreview {
            width: 100%;
            object-fit: cover;
            height: 320px;
            border: none;
            margin-top: 48px;
        }

        .imgOnRow {
            width: 100%;
            object-fit: cover;
            height: 200px;
            border: none !important;
            /* margin-top: 48px; */
        }
    </style>
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 p-3">
                <button data-toggle="modal" data-target="#PhotoModal" class="btn my-3 btn-sm btn-danger">Add New</button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row photoRow">
            {{-- <div class="col-md-3 p-1">
                
            </div> --}}
        </div>
        <button id="LoadMoreBtn" class="btn btn-sm btn-dark">Load More</button>
    </div>

    {{-- add modal --}}
    <div class="modal fade" id="PhotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="file" class="form-control" id="imgInput">
                    <img id="imgPreview" src="{{ asset('images/no-image.jpg') }}" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                    <button id="savePhoto" type="button" class="btn btn-sm btn-success" data-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('admin-script')
    <script type="text/javascript">
        $('#imgInput').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(event) {
                var imgSource = event.target.result;
                $('#imgPreview').attr('src', imgSource);
            }
        })
        $('#savePhoto').on('click', function() {
            var PhotoFile = $('#imgInput').prop('files')[0];
            var formData = new FormData();
            formData.append('photo', PhotoFile);

            $("#savePhoto").html("<div class='spinner'></div>");
            axios.post('/admin/photo-upload', formData).then(function(response) {
                if (response.status == 200 && response.data == 1) {
                    toastr.success('Photo upload success');
                    $('#savePhoto').html("Save");
                    $('#PhotoModal').modal("hide");
                    $('.photoRow').empty();
                    LoadPhoto();
                    imgID = 0;
                } else {
                    toastr.error('Photo upload fail');
                    $('#PhotoModal').modal("hide");
                }
            }).catch(function(error) {
                toastr.error('Photo upload fail');
                $('#savePhoto').html("Save");
                $('#PhotoModal').modal("hide");
            })
        })
        LoadPhoto();

        function LoadPhoto() {
            axios.get('/admin/photo-json')
                .then(function(response) {
                    $.each(response.data, function(i, item) {
                        $("<div class='col-md-3 p-1'>").html(

                            "<img data-id=" + item['id'] + " class='imgOnRow' src=" + item['location'] +
                            " alt=''>" +
                            "<button data-id=" + item['id'] + " data-photo=" + item['location'] +
                            " class='btn deletePhoto btn-sm btn-light'>Delete</button>"
                        ).appendTo('.photoRow');
                    });
                    $('.deletePhoto').on('click', function(event) {
                        let id = $(this).data('id');
                        let photo = $(this).data('photo');
                        photoDelete(photo, id);
                        event.preventDefault();
                    })
                }).catch(function(error) {
                    console.log(error);
                })
        }

        var imgID = 0;

        function LoadByID(firstId, loadMoreBtn) {
            imgID += 8;
            let photoID = imgID + firstId;
            let url = "/admin/photo-json/" + photoID;
            loadMoreBtn.html("<div class='spinner'></div>");
            // alert(url);
            axios.get(url)
                .then(function(response) {

                    loadMoreBtn.html("Load More");
                    $.each(response.data, function(i, item) {
                        $("<div class='col-md-3 p-1'>").html(

                            "<img data-id=" + item['id'] + " class='imgOnRow' src=" + item['location'] +
                            " alt=''>" +
                            "<button data-id=" + item['id'] + " data-photo=" + item['location'] +
                            " class='btn btn-sm btn btn-light'>Delete</button>"
                        ).appendTo('.photoRow')
                    });
                }).catch(function(error) {
                    console.log(error);
                })

        }

        $('#LoadMoreBtn').on('click', function() {
            let loadMoreBtn = $(this);
            let firstId = $(this).closest('div').find('img').data('id');
            // alert($firstId);
            LoadByID(firstId, loadMoreBtn);
        })

        function photoDelete(oldPhotoURL, id) {
            let url = "/admin/photo-delete"
            let myFormData = new FormData();
            myFormData.append('oldPhotoURL', oldPhotoURL);
            myFormData.append('id', id);
            axios.post(url, myFormData).then(function(response) {
                if (response.status == 200 && response.data == 1) {
                    toastr.success('Photo delete success');
                    $('.photoRow').empty();
                    LoadPhoto();
                    imgID = 0;
                } else {
                    toastr.error('Delete fail try again');
                }
            }).catch(function(error) {
                toastr.error('Photo image is empty !');
            })
        }
    </script>
@endsection
