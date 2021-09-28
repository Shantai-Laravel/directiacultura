@extends('front.app')
@section('content')
@include('front.layouts.header')
<div class="registration">
 <div class="container">
   <div class="row crumbs">
     <div class="col-auto d-flex align-items-center">
       <a href="{{url($lang->lang)}}">Home</a>
       <span class="crIcon"></span>
       <a href="{{url($lang->lang.'/password/email')}}">Forgot password</a>
     </div>
   </div>
    <div class="row">
       <div class="col-12">
          <h3>recuperare parola</h3>
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
                      <a href="{{ url($lang->lang.'/login/google') }}"><img src="{{asset('fronts/img/icons/gmailReg.svg')}}" alt=""></a>
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

            <div class="row">
              <div class="col-12">
                <p class="forgpass">Ti-ai pierdut parola ? Te rugam sa introduci adresa ta de email sau telefonul in campul de mai jos si vei primi automat o parola noua cu care te poti autentifica in contul tau Blonde Land.</p>
              </div>
            </div>
            <form action="{{ url()->current() }}" method="post">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-md-7">
                  <input type="text" placeholder="code" name="code" style="padding: 5px;">
                  @if ($errors->has('code'))
                     <div class="invalid-feedback" style="display: block">
                       {!!$errors->first('code')!!}
                     </div>
                  @endif
                </div>

                <div class="col-12">
                  <input class="butt" type="submit" value="Recupereaza parola">
                </div>
              </div>
            </form>
         </div>
       </div>
    </div>
 </div>
</div>
@include('front.layouts.footer')
@stop
