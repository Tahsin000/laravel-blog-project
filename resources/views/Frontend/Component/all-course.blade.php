<div class="container mt-5">
    <div class="row">
        @foreach ($courseData as $courseData)
            <div class="col-md-4 p-1 text-center">
                <div class="card">
                    <div class="text-center">
                        <img class="w-100" src="images/react.jpg" alt="Card image cap">
                        <h5 class="service-card-title mt-4">{{$courseData->course_name}}</h5>
                        <h6 class="service-card-subTitle p-0 ">{{$courseData->course_des}}</h6>
                        <h6 class="service-card-subTitle p-0 ">রেজিঃ {{$courseData->course_fee}}/- মোট ক্লাসঃ {{$courseData->course_totalclass}} টি </h6>
                        <a href="{{$courseData->course_link}}" class="normal-btn-outline mt-2 mb-4 btn">শুরু করুন </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>