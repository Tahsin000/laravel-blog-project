@extends('Backend.Layout.app')

@section('admin-style')
    <style>
        .img-sz {
            width: 50px !important;
            height: 50px !important;
            padding: 0 !important;
        }

        .loader-style {
            height: calc(100vh - 300px);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader-style img {
            width: 100px;
        }

        /* spinner */
        .spinner {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-left-color: #ffffff;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Custom styles for pagination buttons */
.paginate_button {
    display: inline-block !important;
    padding: 8px 14px !important;
    margin: 0 4px !important;
    font-size: 16px !important;
    font-weight: bold !important;
    line-height: 1.5 !important;
    text-align: center !important;
    white-space: nowrap !important;
    vertical-align: middle !important;
    cursor: pointer !important;
    border-radius: 6px !important; /* Default border radius */
}

    </style>
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            Blog
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog table</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body ">
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary addBlogModal">Add</button>
                    <div class="table-responsive  mt-3 ">
                        <table id="order-listing" class="table d-none table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>title</th>
                                    <th>Description</th>
                                    <th>Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="blog_table">

                                {{-- <tr>
                                    <td class="table-img"> <img 
                                            src="https://www.redwolf.in/image/cache/catalog/stickers/tom-face-sticker-india-600x800.jpg?m=1687858270" class="img-sz" alt=""> </td>
                                    <td>ICT</td>
                                    <td>ICT des</td>
                                    <td>ICT des</td>
                                    <td>ICT des</td>
                                    <td>
                                        <div class="">
                                            <a href="" class="btn btn-outline-warning"><i class="fa fa-edit"></i></a>
                                            <a href="" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr> --}}


                            </tbody>

                        </table>

                        <div id="loader" class="w-100 loader-style "><img class=""
                                src='{{ asset('images/loader.gif') }}' alt=""></div>

                        <div id="wrongSection" class="w-100 loader-style d-none">
                            <div class="display-4 text-danger">Something went wrong ... </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- modal --}}



    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <h5>Do you really want to delete this ?</h5>
                    <h6 class="d-none" id="blogDeleteDisplayId"></h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">No</button>
                    <button data-id="" id="blogDeleteBtnConfirm" type="button"
                        class="btn btn-sm btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update blog</h5>
                </div>

                <div id="editModalBody" class="modal-body p-5 d-none">
                    <h6 class="d-none" id="blogEditDisplayId"></h6>
                    <input type="text" id="blogEditName" class="form-control mb-4" id=""
                        placeholder="Blog Name">
                    <input type="text" id="blogEditDes" class="form-control mb-4" id=""
                        placeholder="Blog Description">
                    <input type="text" id="blogEditImage" class="form-control mb-4" id=""
                        placeholder="Blog image">

                </div>
                <div class="d-flex justify-content-center">
                    <img id="blogEditLoader" class="w-25 m-5" src="{{ asset('images/loader.gif') }}" alt="">

                </div>
                <h5 id="blogEditError" class="text-danger text-center d-none">something went wrong</h5>

                {{-- <div class="modal-body">
                    <h6 id="courseEditDisplayId"></h6>
                    <h6>Do you really want to delete this ?</h6>
                </div> --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancel</button>
                    <button data-id="" id="blogEditBtnConfirm" type="button"
                        class="btn btn-sm btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new blog</h5>
                </div>

                <div id="addNewModalBody" class="modal-body p-5">
                    
                    <input type="file" id="blogAddNewImage" class="form-control mb-4" placeholder="Blog image">

                    <input type="text" id="blogAddNewName" class="form-control mb-4"
                        placeholder="Blog name">

                        <textarea id="blogAddNewDes" class="form-control mb-4"
                        placeholder="Blog description" name="" id="" cols="30" rows="10"></textarea>
                    {{-- <input type="text" id="blogAddNewDes" class="form-control mb-4"
                        placeholder="blog description"> --}}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancel</button>
                    <button data-id="" id="blogAddNewBtnConfirm" type="button"
                        class="btn btn-sm btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="blogPreviewModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Preview blog</h5>
                </div>

                <div id="blogPreviewModalBody" class="modal-body p-5 d-none">
                    <h6 class="d-none" id="blogPreviewDisplayId"></h6>

                    <p type="text" id="blogPreviewName" class="form-control mb-4"></p>

                    <p type="text" id="blogPreviewDes" class="form-control mb-4"></p>

                    <p type="text" id="blogPreviewImage" class="form-control mb-4"></p>

                </div>

                <div class="d-flex justify-content-center">
                    <img id="blogPreviewLoader" class="w-25 m-5" src="{{ asset('images/loader.gif') }}"
                        alt="">

                </div>
                <h5 id="blogPreviewError" class="text-danger text-center d-none">something went wrong</h5>
            </div>
        </div>
    </div>
@endsection
@section('admin-script')
    <script src="{{ asset('js/blog.js') }}"></script>
    <!-- DataTables JS -->
@endsection
