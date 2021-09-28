@extends('front.app')
@section('content')
@include('front.layouts.header')
<div class="registration">
  <div class="container">
    <div class="row crumbs">
      <div class="col-auto d-flex align-items-center">
        <a href="{{url($lang->lang)}}">Home</a>
        <span class="crIcon"></span>
        <a href="{{url($lang->lang.'/registration')}}">Registration</a>
      </div>
    </div>
     <div class="row">
        <div class="col-12">
           <h3>Înregistrare</h3>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-8 col-12 aboutEstel">
           <h4>Despre Stilferro</h4>
           <ul>
             <li><a href="{{url($lang->lang.'/about')}}">Despre noi</a></li>
             <li><a href="{{url($lang->lang.'/conditions')}}">Termini si conditii</a></li>
             <li><a href="{{url($lang->lang.'/cookiePolicy')}}">Politica cookie-urilor</a></li>
             <li><a href="{{url($lang->lang.'/privacyPolicy')}}">Politica de confidentialitate</a></li>
           </ul>
        </div>
        <div class="col-lg-6 col-sm-8 col-12 regBoxBorder">
           <div class="regBox">
              <div class="row">
                 <div class="col-12">
                    <h4><span>Inregistreaza cont nou</span>
                      <span>
                        <a href="{{ url($lang->lang.'/login/facebook') }}"><img src="{{asset('fronts/img/icons/faceReg.svg')}}" alt=""></a>
                        <a href="{{ url($lang->lang.'/login/facebook') }}"><img src="{{asset('fronts/img/icons/gmailReg.svg')}}" alt=""></a>
                      </span>
                    </h4>
                 </div>
              </div>

              @if (Session::has('success'))
                  <div class="row">
                     <div class="col-12">
                        <div class="errorPassword">
                           <p><strong>Success</strong></p>
                           <p>{{ Session::get('success') }}</p>
                        </div>
                     </div>
                  </div>
              @endif

              <form action="{{ url($lang->lang.'/registration') }}" method="post">
                  {{ csrf_field() }}

                <input type="hidden" name="prev" value="{{url()->previous()}}">

                @if (count($userfields) > 0)
                  @foreach ($userfields as $key => $userfield)
                      @if ($userfield->type != 'checkbox')
                          <div class="form-group">
                            <label for="{{$userfield->field}}">{{trans('front.register.'.$userfield->field)}}<b>*</b></label>
                            <input type="text" class="form-control" name="{{$userfield->field}}" id="{{$userfield->field}}" value="{{ old($userfield->field) }}">
                            @if ($errors->has($userfield->field))
                               <div class="invalid-feedback" style="display: block">
                                 {!!$errors->first($userfield->field)!!}
                               </div>
                            @endif
                          </div>
                      @endif
                  @endforeach
                @endif
                <div class="form-group">
                  <label for="pwd">{{trans('front.register.pass')}}<b>*</b></label>
                  <input type="password" class="form-control" name="password" id="pwd" >
                  @if ($errors->has('password'))
                     <div class="invalid-feedback" style="display: block">
                       {!!$errors->first('password')!!}
                     </div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="confpwd">{{trans('front.register.repeatPass')}}<b>*</b></label>
                  <input type="password" class="form-control" name="passwordRepeat" id="confpwd" >
                  @if ($errors->has('passwordRepeat'))
                     <div class="invalid-feedback" style="display: block">
                       {!!$errors->first('passwordRepeat')!!}
                     </div>
                  @endif
                </div>

                @if (count($userfields) > 0)
                  @foreach ($userfields as $key => $userfield)
                      @if ($userfield->type == 'checkbox')
                        <div class="offr" style="margin-top: 30px;">
                           {{trans('front.register.'.$userfield->field.'_question')}}
                        </div>
                        <p>{{trans('front.register.'.$userfield->field.'_p')}}</p>
                        <div class="row">
                           <div class="col-12">
                              <label class="containerCheck1">{!!trans('front.register.'.$userfield->field.'_checkbox')!!}
                              <input type="checkbox" name="{{$userfield->field}}">
                              <span class="checkmarkCheck"></span>
                              @if ($errors->has($userfield->field))
                                 <div class="invalid-feedback" style="display: block">
                                   {!!$errors->first($userfield->field)!!}
                                 </div>
                              @endif
                              </label>
                           </div>
                        </div>
                      @endif
                  @endforeach
                @endif

                 {{-- <div class="row">
                    <div class="col-12 recaptha">
                       <span class="msg-error error"></span>
                       <div id="recaptcha" class="g-recaptcha " data-sitekey="6Ld4Jh8TAAAAAD2tURa21kTFwMkKoyJCqaXb0uoK"></div>
                    </div>
                 </div> --}}
                 <div class="row justify-content-start margeTop2">
                    <div class="col-md-5 col-sm-6 col-7">
                       <input class="butt" type="submit" value="Registration">
                    </div>
                 </div>
              </form>
           </div>
        </div>
     </div>
  </div>
</div>
