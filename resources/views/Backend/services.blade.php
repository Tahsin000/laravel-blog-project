@extends('Backend.Layout.app')

@section('admin-style')
    <style>
        .img-sz {
            width: 50px !important;
            height: 50px !important;
            padding: 0 !important;
        }
    </style>
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            Services
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Services table</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body ">
            <h4 class="card-title">Data table</h4>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody id="service_table">
                                {{-- @foreach ($VisitorData as $visitors)
                <tr>
                    <td>{{$visitors->id}}</td>
                    <td>{{$visitors->ip_address}}</td>
                    <td>{{$visitors->visit_time}}</td>
                </tr>
                @endforeach --}}
                                {{-- <tr>
                                    <td class="table-img"> <img 
                                            src="https://www.redwolf.in/image/cache/catalog/stickers/tom-face-sticker-india-600x800.jpg?m=1687858270" class="img-sz" alt=""> </td>
                                    <td>ICT</td>
                                    <td>ICT des</td>
                                    <td><a href="" class="btn btn-outline-warning"><i class="fa fa-edit"></i></a></td>
                                    <td><a href="" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a></td>
                                </tr> --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('admin-script')
    <script src="{{ asset('js/admin-script.js') }}"></script>
    <script>
        getServicesData()
    </script>
@endsection
