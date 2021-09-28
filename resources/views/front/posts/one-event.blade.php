@extends('front.app')
@section('content')
@include('front.layouts.header')
<main>
  <div class="container">
    <div class="row crumbs">
      <ul class="col-auto">
        <li><a href="{{url($lang->lang)}}">{{trans('front.general.home')}}</a></li>
        <li><a href="{{url($lang->lang.'/events')}}">{{trans('front.general.events')}}</a></li>
      </ul>
    </div>
    <div class="row about" style="margin: 0;">
      <h3>
        {{$post->translationByLanguage($lang->id)->first()->title}}
      </h3>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="timeNews">{{date('Y-m-d H:i', strtotime($post->date))}}</div>
      </div>
    </div>
    <section class="row justify-content-center">
      <div class="col-md-10 col-12">
        {!!$post->translationByLanguage($lang->id)->first()->body!!}
      </div>
    </section>
  </div>
</main>
@include('front.layouts.footer')
@stop
