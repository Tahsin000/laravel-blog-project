@extends('Backend.Layout.app')

@section('content')

<div class="page-header">
    <h3 class="page-title">
      Data table
    </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Tables</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data table</li>
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
                    <th>No #</th>
                    <th>IP</th>
                    <th>Data & Time</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($VisitorData as $visitors)
                <tr>
                    <td>{{$visitors->id}}</td>
                    <td>{{$visitors->ip_address}}</td>
                    <td>{{$visitors->visit_time}}</td>
                </tr>
                @endforeach
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection

