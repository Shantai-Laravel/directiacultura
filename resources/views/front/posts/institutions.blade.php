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
    <div class="row">
      <div class="col-md-9 col-12">
        <section class="news">
          <div class="row" style="margin: 0;">
            <div class="col-auto colH3"><h3>{{trans('front.general.institutions')}}</h3></div>
            <div class="col colSilver"></div>
          </div>
          <div class="news-container">
            @if (count($posts) > 0)
              @foreach ($posts as $post)
                <article class="row">
                  <div class="col-9">
                    <a href="{{url($lang->lang.'/institutions/'.$post->alias)}}" class="title">
                      {{$post->translationByLanguage($lang->id)->first()->title}}
                    </a>
                    <p>
                      {!!str_limit($post->translationByLanguage($lang->id)->first()->body, $limit = 150, $end = '...')!!}
                    </p>
                    <div class="timeNews">{{$post->created_at}}</div>
                  </div>
                  <div class="col-3">
                    @if ($post->image != '')
                      <img src="{{asset('images/posts/'.$post->image)}}" alt="" />
                    @else
                      <img src="{{asset('fronts/img/aside.png')}}" alt="">
                    @endif
                  </div>
                </article>
              @endforeach
            @endif
          </div>
        </section>
      </div>
    </div>
  </div>
</main>
@include('front.layouts.footer')
@stop
