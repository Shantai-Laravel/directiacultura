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
    <div class="row">
      <div class="col-md-9 col-12">
        <section class="news">
          <div class="row" style="margin: 0;">
            <div class="col-auto colH3"><h3>{{trans('front.general.events')}}</h3></div>
            <div class="col colSilver"></div>
          </div>
          <div class="events-container">
            @if (count($posts) > 0)
              @foreach ($posts as $post)
                <article class="row">
                  <div class="col-9">
                    <a href="{{url($lang->lang.'/events/'.$post->alias)}}" class="title">
                      {{$post->translationByLanguage($lang->id)->first()->title}}
                    </a>
                    <div class="timeNews">{{date('Y-m-d', strtotime($post->date))}}</div>
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
          <div class="row">
            <div class="col-9">
              <div class="butt" data-id="{{$posts[0]->category_id}}" id="addMorePosts">{{trans('front.posts.moreBtn')}}</div>
            </div>
          </div>
        </section>
      </div>
      <div class="col-md-3 parentNews">
        <div class="asideNews">
          <div class="row" style="margin: 0;">
            <div class="col-auto colH3"><h3>{{trans('front.general.events')}}</h3></div>
            <div class="col colSilver"></div>
          </div>
          <ul>
            @if (count($recentPosts) > 0)
              @foreach ($recentPosts as $key => $recentPost)
                <li>
                  <a href="{{url($lang->lang.'/events/'.$recentPost->alias)}}">
                    <span>0{{$key + 1}}</span>{{$recentPost->translationByLanguage($lang->id)->first()->title}}</a
                  >
                </li>
              @endforeach
            @endif
          </ul>
        </div>
      </div>
    </div>
  </div>
</main>
@include('front.layouts.footer')
@stop
