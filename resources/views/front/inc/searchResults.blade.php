@if (!empty($findPosts) && count($findPosts) > 0)
  <ul id="searchOpen">
    @foreach ($findPosts as $findPost)
      <li>
        <a href="{{url($lang->lang.'/'.$findPost->category->alias.'/'.$findPost->alias)}}" class="row resultOne">
        <div class="col-4">
          @if ($findPost->translationByLanguage($lang->id)->first()->image)
            <img src="{{asset('images/posts/'.$findPost->translationByLanguage($lang->id)->first()->image)}}" alt="" />
          @else
            <img src="{{asset('fronts/img/aside.png')}}" alt="">
          @endif
        </div>
        <div class="col-auto">
          <div>{{$findPost->translation($lang->id)->first()->title}}</div>
        </div>
      </a>
    </li>
    @endforeach
  </ul>
@endif
