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
                        <h2>{{$project_detail->name}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--//breadcrumb-->
<!--Services-->
<section class="main">
    <section class="project-details">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="project-big-image">
                        <img src="{{ URL::asset('public/uploads/project/'.$project_detail->image) }}" class="img-fluid" alt>
                    </div>
                    <div class="project-des-all">
                        <h2><b>Project Name:</b> {{$project_detail->name}}</h2>
                        <h2><b>Project Category:</b> {{$project_detail->category->name}}</h2>
                        <h3><b>Website Link:</b> <a href="{{$project_detail->link}}" target="_blank">{{$project_detail->link}}</a></h3>
                        <h5><b>Short Description:</b> {{$project_detail->short_description}}</h5>
                        <p>{!! $project_detail->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
@stop
@section('js')

@endsection
