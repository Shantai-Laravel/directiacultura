<header>
  <div class="container">
    <div class="row justify-content-between align-items-center">
      <div class="col-auto">
        <a href="{{url($lang->lang)}}" class="logoHeader"></a>
      </div>
      <div class="col-auto">
        <div class="denProj">
          {{trans('front.header.name')}}
        </div>
      </div>
      <div class="col-auto">
        <a href="{{url($lang->lang)}}" class="logoPrim"></a>
      </div>
    </div>
    <div class="row">
      <div class="col-12 burger">
        {{trans('front.header.menu')}}
      </div>
    </div>
    <div class="row justify-content-between">
      <div class="col-lg-10 col-md-9">
        <div class="row justify-content-between navHeader">
          <div class="menuItem">
            {{trans('front.header.shortName')}}
            <div class="subItemBloc">
              <a href="{{url($lang->lang.'/about')}}" class="subItem">{{trans('front.general.about')}}</a>
              <a href="{{url($lang->lang.'/regulation')}}" class="subItem">
                {{trans('front.general.regulation')}}
              </a>
              <a href="{{url($lang->lang.'/organigram')}}" class="subItem">{{trans('front.general.organigram')}}</a>
            </div>
          </div>
          <div class="menuItem">
            {{trans('front.general.institutions')}}
            <div class="subItemBloc">
              @if (count($headerInstitutions) > 0)
                @foreach ($headerInstitutions as $institution)
                  <a href="{{url($lang->lang.'/institutions/'.$institution->alias)}}" class="subItem">{{$institution->translationByLanguage($lang->id)->first()->title}}</a>
                @endforeach
              @endif
            </div>
          </div>
          <a class="menuItem" href="{{url($lang->lang.'/projects')}}">
            {{trans('front.general.projects')}}
          </a>
          <div class="menuItem">
            <a href="{{ url($lang->lang.'/events') }}">{{trans('front.general.events')}}</a>
            <div class="subItemBloc">
              @if (count($headerEvents) > 0)
                @foreach ($headerEvents as $event)
                  <a href="{{url($lang->lang.'/events/'.$event->alias)}}" class="subItem">{{$event->translationByLanguage($lang->id)->first()->title}}</a>
                @endforeach
              @endif
            </div>
          </div>
          <a class="menuItem" href="{{url($lang->lang.'/gallery')}}">
            {{trans('front.general.gallery')}}
          </a>
          <a class="menuItem" href="{{url($lang->lang.'/contacts')}}">
            {{trans('front.general.contacts')}}
          </a>
        </div>
      </div>
      <div class="col searchLangMobile">
        <div class="searchLang">
          <input id="searchButt" type="text" name="value" class="search-field"/>
          <div class="searchResult">
            @include('front.inc.searchResults')
          </div>

          <div id="langBlock">
            <?php $pathWithoutLang = pathWithoutLang(Request::path(), $langs);?>

            @if (Request::segment(1))
              <div>{{strtoupper(Request::segment(1))}}</div>
            @else
              <div>{{strtoupper($langs[0]->lang)}}</div>
            @endif
            <div id="langOpen">
              @if (!empty($langs))
                  @foreach ($langs as $key => $oneLang)
                      <a href="{{ url($oneLang->lang.'/'.$pathWithoutLang) }}">{{ strtoupper($oneLang->lang) }}</a>
                  @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
