@extends('Backend.Layout.login')

@section('content')
    <div class="container">
        <div class="row justify-content-center d-flex mt-5 mb-5">
            <div class="col-md-10 card">
                <div class="row">
                    <div style="height: 450px" class="col-md-6 p-3">
                        <form action="" class="m-5 loginForm">
                            <div class="form-group">
                                <label for="">User Name</label>
                                <input type="text" name="username" class="form-control" id="email"
                                    placeholder="Enter Username">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter Password">
                            </div>
                            <div class="form-group">
                                <button type="submit" type="submit" class="btn btn-danger btn-block">Login</button>
                            </div>
                        </form>
                    </div>

                    <div style="height: 450px" class="col-md-6 p-3">
                        <img class="w-75 m5" src="images/bannerImg.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('.loginForm').on('submit', function(event) {
            event.preventDefault();
            let formData = $(this).serializeArray();
            let username = formData[0]['value'];
            let password = formData[1]['value'];
            let url = '/on-login'

            axios.post(url, {
                username: username,
                password: password,
            }).then(function(response) {
                if (response.status == 200 && response.data == 1) {
                    window.location.href = '/admin/dashboard'
                } else {
                    toastr.error('Login fail ! try again');
                }
            }).catch(function() {

            });
        })
    </script>
@endsection
