@extends('front.app')
@section('content')
@include('front.layouts.header')
    <main>
      {!!$page->translationByLanguage($lang->id)->first()->body!!}
    </main>
@include('front.layouts.footer')
@stop
