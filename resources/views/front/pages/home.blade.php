@extends('front.app')
@section('content')
@include('front.layouts.header')
<?php
$phone = !is_null(getContactInfo('phone')->translation()) ? getContactInfo('phone')->translation()->value : '';
$email = !is_null(getContactInfo('emailfront')->translation()) ?  getContactInfo('emailfront')->translation()->value : '';
?>
<main>
  <div class="banner">
    @if (count($bannerGallery->Images) > 0)
      @foreach ($bannerGallery->Images as $bannerImage)
        <div class="bannerItem">
          @if ($bannerImage->src != '')
            <img src="{{asset('images/galleries/og/'.$bannerImage->src)}}" alt="" />
          @else
            <img src="{{asset('fronts/img/aside.png')}}" alt="">
          @endif
        </div>
      @endforeach
    @endif
 </div>
  <div class="container">
    <section class="news">
      <div class="row" style="margin: 0;">
        <div class="col-auto colH3"><h3>{{trans('front.general.events')}}</h3></div>
        <div class="col colSilver"></div>
      </div>
      @if (count($posts) > 0)
        @foreach ($posts as $post)
          <article class="row">
            <div class="col-9">
              <a href="{{url($lang->lang.'/events/'.$post->alias)}}" class="title">{{$post->translationByLanguage($lang->id)->first()->title}}</a>
              <div class="timeNews">{{date('d-m-Y', strtotime($post->created_at))}}</div>
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
    </section>
    <section class="services">
      <div class="row justify-content-between">
        <a href="{{url($lang->lang.'/events')}}" class="col-md-3 col-7 servBloc">
          <img src="{{asset('fronts/img/icons/reglIcon.svg')}}" alt="" />
          <div class="title">{{trans('front.general.events')}}</div>
        </a>
        <a href="{{url($lang->lang.'/gallery')}}" class="col-md-3 col-7 servBloc">
          <img src="{{asset('fronts/img/icons/instrIcon.svg')}}" alt="" />
          <div class="title">{{trans('front.general.gallery')}}</div>
        </a>
        <a href="{{url($lang->lang.'/projects')}}" class="col-md-3 col-7 servBloc">
          <img src="{{asset('fronts/img/icons/projectsIcon.svg')}}" alt="" />
          <div class="title">{{trans('front.general.projects')}}</div>
        </a>
      </div>
    </section>
    <section class="presentation">
      <div class="row">
        <div class="col-md-8">
          @if (count($generalInfo) > 1)
            <div class="title">
              {{$generalInfo[0]->translationByLanguage($lang->id)->first()->name}}
            </div>
            <p>{{$generalInfo[0]->translationByLanguage($lang->id)->first()->description}}</p>
          @endif
          <a href="{{url($lang->lang.'/about')}}" class="butt">{{trans('front.home.viewBtn')}}</a>
        </div>
        <div class="col-md-4 dspNoneMobile">
          <img src="{{asset('fronts/img/aside.png')}}" alt="" />
        </div>
      </div>
    </section>
  </div>
  <div class="formHome">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          @if (count($generalInfo) > 1)
            <div class="titleForm">
              {{$generalInfo[1]->translationByLanguage($lang->id)->first()->name}}
            </div>
            <p>{{$generalInfo[1]->translationByLanguage($lang->id)->first()->description}}</p>
          @endif
          <p>
            <a class="mail" href="mailto:{{$email}}">
              {{$email}}
            </a>
          </p>
          <p>
            <a class="tel" href="tel:{{$phone}}">
              {{$phone}}
            </a>
          </p>
        </div>
        <div class="col-md-6">
          <form id="sendContactForm" class="formBlock">
            <div class="alert alert-danger" style="display: none;">

            </div>
            <div class="alert alert-success" style="display: none;">

            </div>
            <input type="text" name="name" placeholder="{{trans('front.contacts.name')}}" required/>
            <input type="email" name="email" placeholder="{{trans('front.contacts.email')}}" required/>
            <input type="text" name="message" placeholder="{{trans('front.contacts.message')}}" required/>
            <input type="submit" class="butt" value="{{trans('front.contacts.btn')}}" />
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
@include('front.layouts.footer')
@stop
