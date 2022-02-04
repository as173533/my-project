@extends('layouts.main') 
@section('css')

@endsection
@section('content')

<!--slider-->
<div class="Modern-Slider">
    <!-- Item -->
    @forelse($sliders as $slider)
    
    <div class="item">
        <div class="img-fill">
            <img src="{{ URL::asset('public/uploads/slider/'.$slider->photo) }}" alt="">
            <div class="info">
                <div>
                    <h3>{{$slider->title_text}}</h3>
                    <h5>{{$slider->details_text}}</h5>
                </div>
            </div>
        </div>
    </div>
    @empty
    @endforelse
    <!-- // Item -->
    
</div>



<!------Parent Category--------->
<div class="container parent hg_section">
    <h3 class="clients">Parent Category</h3>
    <section class="customer-logos slider">
        @forelse($categories as $category)
        <a href="{{ route('blog.category',$category->slug) }}">
            <div class="slide parent-image slick-slide slide--has-caption">
                <img src="{{ URL::asset('public/uploads/categories/'.$category->photo) }}">
                <div class="caption">{{$category->name}}</div>
            </div>
        </a>
        @empty
        @endforelse
    </section>
</div>
<!--end of clients-->
<!--Sub Cagegory-->
<section class="digital-services-body hg_section">
    <div class="container">
        <h2 class="our-services-head">Explore Almost Everything</h2>
        <div class="row">
            @forelse($subcategories as $subcategory)
            <div class="col-sm-6 col-lg-3">
                <a href="{{ route('blog.subcat',['slug1' => $subcategory->category->slug, 'slug2' => $subcategory->slug]) }}">
                    <div class="service-box">
                        <div class="service-image">
                            <img src="{{ URL::asset('public/uploads/subcategories/'.$subcategory->photo) }}" alt="">
                        </div>
                        <div class="service-media">
                            <h4>{{$subcategory->category->name}} - {{$subcategory->name}}</h4>

                            <div class="read-abc">
                                <!-- <a href="#">
                                  <button class="read-buttons">Read More</button>
                                </a> -->
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            @endforelse
        </div>
        <!-- <div class="row">
          <div class="col-sm-12">
            <div class="news-button-body">
              <a href="news.html">
                <button class="view-buttons">View More</button>
              </a>
            </div>
          </div>
        </div> -->
    </div>	
</section>

@stop
@section('js')

@endsection
