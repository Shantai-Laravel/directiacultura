@extends('front.app')
@section('content')
@include('front.layouts.header')
    <main>
      <div class="container">
        <div class="row crumbs">
          <ul class="col-auto">
            <li><a href="{{url($lang->lang)}}">{{trans('front.general.home')}}</a></li>
            <li><a href="{{url($lang->lang.'/projects')}}">{{trans('front.general.projects')}}</a></li>
          </ul>
        </div>
        <div class="col-12">
          <section class="reglaments row">
            {!!$page->translationByLanguage($lang->id)->first()->body!!}
          </section>
        </div>
      </div>
    </main>
@include('front.layouts.footer')
@stop
