@extends('front.app')
@section('content')
@include('front.layouts.header')
<main>
  <div class="container">
    <div class="row crumbs">
      <ul class="col-auto">
        <li><a href="{{url($lang->lang)}}">{{trans('front.general.home')}}</a></li>
        <li><a href="{{url($lang->lang.'/institutions')}}">{{trans('front.general.institutions')}}</a></li>
      </ul>
    </div>
    <div class="row about" style="margin: 0;">
      <h3>
        {{$post->translationByLanguage($lang->id)->first()->title}}
      </h3>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="timeNews">{{$post->created_at}}</div>
      </div>
    </div>
    <section class="reglaments row justify-content-center">
        {!!$post->translationByLanguage($lang->id)->first()->body!!}
    </section>
  </div>
</main>
@include('front.layouts.footer')
@stop
