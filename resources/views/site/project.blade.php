@extends('layouts.main') 
@section('css')

@endsection
@section('content')
<section class="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="breadcrumb-title-div">
                    <div class="bread-left-side">
                        <h2>Our Projects</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--//breadcrumb-->
<!--Services-->
<section class="main">
    <section class="digital-services-body">
        <div class="container">
            <div class="row">
                @forelse($projects as $project)
                <div class="col-sm-6 col-lg-4">
                    <div class="service-box">
                        <div class="service-image">
                            <img src="{{ URL::asset('public/uploads/project/'.$project->image) }}" alt="">
                        </div>
                        <div class="service-media">
                            <h4><b>Project Name:</b> {{$project->name}}</h4>
                            <h4><b>Project Category:</b> {{$project->category->name}}</h4>
                            <h5><b>Website Link:</b> <a href="{{$project->link}}" target="_blank">{{$project->link}}</a></h5>
                            <p>{{$project->short_description}}</p>
                            <div class="read-abc">
                                <a href="{{Route('project-details',['id'=>base64_encode($project->id)])}}">
                                    <button class="read-buttons">View More</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
        </div>	
    </section>
</section>
@stop
@section('js')

@endsection
