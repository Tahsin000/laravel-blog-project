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
    </style>
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            Course
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Courses table</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body ">
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary addCourseModal">Add</button>
                    <div class="table-responsive">
                        <table id="order-listing" class="table d-none">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Fee</th>
                                    <th>Class</th>
                                    <th>Enroll</th>
                                    <th>Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="course_table">

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
                    <h6>Do you really want to delete this ?</h6>
                    <h6 id="courseDeleteDisplayId"></h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">No</button>
                    <button data-id="" id="courseDeleteBtnConfirm" type="button"
                        class="btn btn-sm btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div id="editModalBody" class="modal-body p-5 d-none">
                    <h6 id="courseEditDisplayId"></h6>
                    <input type="text" id="courseEditName" class="form-control mb-4" id=""
                        placeholder="Course name">

                    <input type="text" id="courseEditDes" class="form-control mb-4" id=""
                        placeholder="Course description">

                    <input type="text" id="courseEditFee" class="form-control mb-4" id=""
                        placeholder="Course fee">

                    <input type="text" id="courseEditTotalEnroll" class="form-control mb-4" id=""
                        placeholder="Course total enroll">

                    <input type="text" id="courseEditTotalClass" class="form-control mb-4" id=""
                        placeholder="Course total class">

                    <input type="text" id="courseEditLink" class="form-control mb-4" id=""
                        placeholder="Course link">

                    <input type="text" id="courseEditImg" class="form-control mb-4" id=""
                        placeholder="Course image link">

                </div>
                <div class="d-flex justify-content-center">
                    <img id="courseEditLoader" class="w-25 m-5" src="{{ asset('images/loader.gif') }}" alt="">

                </div>
                <h5 id="courseEditError" class="text-danger text-center d-none">something went wrong</h5>

                {{-- <div class="modal-body">
                    <h6 id="courseEditDisplayId"></h6>
                    <h6>Do you really want to delete this ?</h6>
                </div> --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancel</button>
                    <button data-id="" id="courseEditBtnConfirm" type="button"
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
                    <h5 class="modal-title" id="exampleModalLabel">Add new course</h5>
                </div>

                <div id="addNewModalBody" class="modal-body p-5">
                    <input type="text" id="courseAddNewName" class="form-control mb-4" placeholder="Course name">

                    <input type="text" id="courseAddNewDes" class="form-control mb-4"
                        placeholder="Course description">

                    <input type="text" id="courseAddNewFee" class="form-control mb-4" placeholder="Course fee">

                    <input type="text" id="courseAddNewTotalEnroll" class="form-control mb-4"
                        placeholder="Course total enroll">

                    <input type="text" id="courseAddNewTotalClass" class="form-control mb-4"
                        placeholder="Course total class">

                    <input type="text" id="courseAddNewLink" class="form-control mb-4" placeholder="Course link">

                    <input type="text" id="courseAddNewImg" class="form-control mb-4"
                        placeholder="Course image link">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancel</button>
                    <button data-id="" id="courseAddNewBtnConfirm" type="button"
                        class="btn btn-sm btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="coursePreviewModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Add new course</h5>
                </div>

                <div id="coursePreviewModalBody" class="modal-body p-5 d-none">
                    <h6 id="coursePreviewDisplayId"></h6>

                    <p type="text" id="coursePreviewName" class="form-control mb-4"></p>

                    <p type="text" id="coursePreviewDes" class="form-control mb-4"></p>

                    <p type="text" id="coursePreviewFee" class="form-control mb-4"></p>

                    <p type="text" id="coursePreviewTotalEnroll" class="form-control mb-4"></p>

                    <p type="text" id="coursePreviewTotalClass" class="form-control mb-4"></p>

                    <p type="text" id="coursePreviewLink" class="form-control mb-4"></p>

                    <p type="text" id="coursePreviewImg" class="form-control mb-4"></p>

                </div>

                <div class="d-flex justify-content-center">
                    <img id="coursePreviewLoader" class="w-25 m-5" src="{{ asset('images/loader.gif') }}"
                        alt="">

                </div>
                <h5 id="coursePreviewError" class="text-danger text-center d-none">something went wrong</h5>
            </div>
        </div>
    </div>
@endsection
@section('admin-script')
    <script src="{{ asset('js/course.js') }}"></script>
    <script>
        getCoursesData()
    </script>
@endsection
