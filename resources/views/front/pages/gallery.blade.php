@extends('front.app')
@section('content')
@include('front.layouts.header')
    <main>
      <div class="container">
        <div class="row crumbs">
          <ul class="col-auto">
            <li><a href="{{url($lang->lang)}}">{{trans('front.general.home')}}</a></li>
            <li><a href="{{url($lang->lang.'/gallery')}}">{{trans('front.general.gallery')}}</a></li>
          </ul>
        </div>
        <div class="row">
          @if (count($page->gallery->Images) > 0)
            @foreach ($page->gallery->Images as $image)
              <div class="col-md-3">
                <img src="{{asset('images/galleries/og/'.$image->src)}}" alt="" class="mainImg" />
              </div>
            @endforeach
          @endif
        </div>
        <div id="containerImg">
          <div id="closeGallery">X</div>
          <div class="slideGallery"></div>
        </div>
      </div>
    </main>
@include('front.layouts.footer')
@stop
