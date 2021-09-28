<?php
$phone = !is_null(getContactInfo('phone')->translation()) ? getContactInfo('phone')->translation()->value : '';
$email = !is_null(getContactInfo('emailfront')->translation()) ?  getContactInfo('emailfront')->translation()->value : '';
$viber = !is_null(getContactInfo('viber')->translation()) ? getContactInfo('viber')->translation()->value : '';
$facebook = !is_null(getContactInfo('facebook')->translation()) ?  getContactInfo('facebook')->translation()->value : '';
$youtube = !is_null(getContactInfo('youtube')->translation()) ?  getContactInfo('youtube')->translation()->value : '';
$footerText = !is_null(getContactInfo('footertext')->translation($lang->id)) ? getContactInfo('footertext')->translation($lang->id)->value : '';
?>
<footer class="foter">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-md-auto col-12 dac">
        <h6 class="foterTitle">{{trans('front.general.about')}}</h6>
        <ul class="foterUl">
          <li><a href="{{url($lang->lang.'/about')}}">{{trans('front.footer.about')}}</a></li>
          <li><a href="{{url($lang->lang.'/regulation')}}">{{trans('front.general.regulation')}}</a></li>
          <li><a href="{{url($lang->lang.'/organigram')}}">{{trans('front.general.organigram')}}</a></li>
          <li><a href="{{url($lang->lang.'/contacts')}}">{{trans('front.general.contacts')}}</a></li>
        </ul>
      </div>
      <div class="col-md-auto col-12 dac">
        <h6 class="foterTitle">{{trans('front.footer.institutions')}}</h6>
        <ul class="foterUl">
          @if (count($headerInstitutions) > 0)
            @foreach ($headerInstitutions as $institution)
              <li><a href="{{url($lang->lang.'/institutions/'.$institution->alias)}}" class="subItem">{{$institution->translationByLanguage($lang->id)->first()->title}}</a></li>
            @endforeach
          @endif
        </ul>
      </div>
      <div class="col-md-auto col-12 dac">
        <h6 class="foterTitle">{{trans('front.footer.url')}}</h6>
        <ul class="foterUl">
          <li><a href="{{url($lang->lang.'/events')}}">{{trans('front.general.events')}}</a></li>
          <li><a href="{{url($lang->lang.'/projects')}}">{{trans('front.general.projects')}}</a></li>
          <li><a href="{{url($lang->lang.'/gallery')}}">{{trans('front.general.gallery')}}</a></li>
        </ul>
      </div>
      <div class="col-md-auto col-12 dac">
        <h6 class="foterTitle">{{trans('front.general.contacts')}}</h6>
        <ul class="foterUl">
          <li>
            <a href="tel: {{$phone}}">{{trans('front.footer.phone')}}: {{$phone}}</a>
          </li>
          <li>
            <a href="mailto: info@trenwood.com">{{trans('front.footer.mail')}}: {{$email}}</a>
          </li>
          <li><a href="#">Facebook: {{$facebook}}</a></li>
          <li><a href="#">Viber: {{$viber}}</a></li>
        </ul>
      </div>
    </div>
    <div class="row justify-content-center ftRet">
      <div class="col-md-6 col-12">
        <ul>
          <li><a class="btnRet fRet" href="{{ $facebook }}"></a></li>
          <li><a class="btnRet yRet" href="{{ $youtube }}"></a></li>
        </ul>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-10">
        <p>
          {{$footerText}}
        </p>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-auto">
        <a href="{{url($lang->lang)}}" class="logoHeader"></a>
      </div>
    </div>
  </div>
  <p class="prefooter">©{{date('Y')}} {{trans('front.footer.by')}}</p>
</footer>
