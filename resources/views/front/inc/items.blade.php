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
