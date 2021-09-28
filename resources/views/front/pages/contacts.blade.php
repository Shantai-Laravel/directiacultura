@extends('front.app')
@section('content')
@include('front.layouts.header')
<main>
  <div class="container">
    <div class="row about" style="margin: 0;">
      <div class="col-auto colH3"><h3>{{trans('front.contacts.info')}}</h3></div>
      <div class="col colSilver"></div>
    </div>
    <section class="row contact">
      <div class="col-12">
        <div class="row reglaments">
          {!!$page->translationByLanguage($lang->id)->first()->body!!}
        </div>
      </div>
      <div class="col-12 mapContact">
        <h4>{{trans('front.contacts.map')}}</h4>
        <div class="mapouter">
          <div class="gmap_canvas">
            <iframe
              width="100%"
              height="500px"
              id="gmap_canvas"
              src="https://maps.google.com/maps?q={{getContactInfo('address')->translationByLanguage($lang->id)->first()->value}}&output=embed"
              frameborder="0"
              scrolling="no"
              marginheight="0"
              marginwidth="0"
            ></iframe
            >Google Maps Generator by
            <a href="https://www.embedgooglemap.net"
              >embedgooglemap.net</a
            >
          </div>
          <style>
            .mapouter {
              position: relative;
              text-align: right;
              height: 400px;
              width: 100%x;
            }
            .gmap_canvas {
              overflow: hidden;
              background: none !important;
              height: 400px;
              width: 100%;
            }
          </style>
        </div>
        <p>
          {{trans('front.contacts.address')}}: {{getContactInfo('address')->translationByLanguage($lang->id)->first()->value}}
        </p>
      </div>
      <div class="formHome">
        <div class="row">
          <div class="col-md-6">
            <form id="sendContactForm" class="formBlock">
              <h5>{{trans('front.contacts.messageText')}}</h5>
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
    </section>
  </div>
</main>
@include('front.layouts.footer')
@stop
