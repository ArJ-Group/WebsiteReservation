@extends('layouts.customer')

@section('hero')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Gallery</h2>
            </div>
            <div class="col-12">
                <a href="">Home</a>
                <a href="">Gallery</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="portfolio">
    <div class="container">
        <div class="section-header text-center">
            <p>Barber Image Gallery</p>
            <h2>Some Images From Our Barber Gallery</h2>
        </div>
        <div class="row">
            <div class="col-12">
                <ul id="portfolio-flters">
                    <li data-filter="*" class="filter-active">All</li>
                    <li data-filter=".hairCut">Hair Cut</li>
                    <li data-filter=".colorAndWash">Color & Wash</li>
                    <li data-filter=".breadStyle">Beard Style</li>
                </ul>
            </div>
        </div>
        <div class="row portfolio-container">
            @foreach($gallery as $hc)
            @if ($hc->categoryService->name == 'Hair Cut')
            <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item hairCut">
                <div class="portfolio-wrap">
                    <a href="{{asset('storage/'.$hc->image) }}" data-lightbox="portfolio">
                        <img src="{{asset('storage/'.$hc->image) }}" alt="Portfolio Image">
                    </a>
                </div>
            </div>
            @endif
            @endforeach
            @foreach($gallery as $caw)
            @if ($caw->categoryService->name == 'Color & Wash')
            <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item colorAndWash">
                <div class="portfolio-wrap">
                    <a href="{{asset('storage/'.$caw->image)}}" data-lightbox="portfolio">
                        <img src="{{asset('storage/'.$caw->image) }}" alt="Portfolio Image">
                    </a>
                </div>
            </div>
            @endif
            @endforeach
            @foreach($gallery as $bs)
            @if ($bs->categoryService->name == 'Beard Style')
            <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item breadStyle">
                <div class="portfolio-wrap">
                    <a href="{{asset('storage/'.$bs->image) }}" data-lightbox="portfolio">
                        <img src="{{asset('storage/'.$bs->image) }}" alt="Portfolio Image">
                    </a>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>

@endsection