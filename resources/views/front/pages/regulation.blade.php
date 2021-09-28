@extends('front.app')
@section('content')
@include('front.layouts.header')
    <main>

      <div class="container">
        <div class="row crumbs">
          <ul class="col-auto">
            <li><a href="{{url($lang->lang)}}">{{trans('front.general.home')}}</a></li>
            <li><a href="{{url($lang->lang.'/regulation')}}">{{trans('front.general.regulation')}}</a></li>
          </ul>
        </div>
        <div class="row">
          <div class="col-12">
            {!!$page->translationByLanguage($lang->id)->first()->body!!}
          </div>
        </div>
      </div>
    </main>
@include('front.layouts.footer')
@stop
