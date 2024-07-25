<div class="container mt-5">
    <div class="row">
        @foreach ($blogData as $blogData)
            <div class="col-md-4 p-1 ">
                <div class="card">
                        <img class="w-100" src="{{$blogData->image}}" alt="Card image cap">
                        <div class="w-100 p-4">
                            <h5 class="blog-card-title mt-2">{{$blogData->title}}</h5>
                            <h6 class="blog-card-subtitle p-0 ">{{$blogData->description}}</h6>
                            <h6 class="blog-card-date "> <i class="far fa-clock"></i> ২৪/০৫/২০২০</h6>
                            <a href="#" class="normal-btn-outline mt-2 mb-4 btn">আরো পড়ুন </a>
                        </div>

                </div>
            </div>
        @endforeach
    </div>
</div>
