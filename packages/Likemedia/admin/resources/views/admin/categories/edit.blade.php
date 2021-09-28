@extends('admin::admin.app')
@include('admin::admin.nav-bar')
@include('admin::admin.left-menu')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/back') }}">Control Panel</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categoriile de articole</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editarea categoriei de articole</li>
    </ol>
</nav>
<div class="title-block">
    <h3 class="title"> Editarea categoriei de articole </h3>
    @include('admin::admin.list-elements', [
    'actions' => [
    trans('variables.add_element') => route('categories.create'),
    ]
    ])
</div>

<div class="list-content">
    <div class="tab-area">
        @include('admin::admin.alerts')
        <ul class="nav nav-tabs nav-tabs-bordered">
            @if (!empty($langs))
            @foreach ($langs as $key => $lang)
            <li class="nav-item">
                <a href="#{{ $lang->lang }}" class="nav-link  {{ $key == 0 ? ' open active' : '' }}" data-target="#{{ $lang->lang }}">{{ $lang->lang }}</a>
            </li>
            @endforeach
            @endif
        </ul>
    </div>
    <form class="form-reg" method="post" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">
        {{ csrf_field() }} {{ method_field('PATCH') }}
        @if (!empty($langs))
        @foreach ($langs as $key => $lang)
        <div class="tab-content {{ $key == 0 ? ' active-content' : '' }}" id={{ $lang->
            lang }}>
            <div class="part left-part">
                <ul>
                    <li>
                        <label>{{trans('variables.title_table')}} [{{$lang->lang}}]</label>
                        <input type="text" name="name_{{ $lang->lang }}" class="name"
                        data-lang="{{ $lang->lang }}"
                        @foreach($category->translations as $translation)
                        @if ($translation->lang_id == $lang->id)
                        value="{{ $translation->name }}"
                        @endif
                        @endforeach
                        >
                    </li>
                    <li class="ckeditor">
                        <label>{{trans('variables.body')}} [{{$lang->lang}}]</label>
                        <textarea name="description_{{ $lang->lang }}">
                                        @foreach($category->translations as $translation)
                                            @if ($translation->lang_id == $lang->id)
                                                {{ $translation->description }}
                                            @endif
                                        @endforeach
                                    </textarea>
                        <script>
                            CKEDITOR.replace('description_{{ $lang->lang }}', {
                                language: '{{$lang}}',
                            });
                        </script>
                    </li>
                    <li>
                        <label>{{trans('variables.img')}}</label>
                        <input style="padding: 0; border: none" type="file" name="image"/>
                        @if ( $category->image != null)
                        <img class="image thumbnail" src="{{ asset('images/categories/'.$category->image) }}" alt="">
                        @endif
                    </li>
                    <li>
                        <label>Image Alt text [{{$lang->lang}}]</label>
                        <input type="text" name="alt_text_{{ $lang->lang }}"
                        @foreach($category->translations as $translation)
                        @if ($translation->lang_id == $lang->id)
                        value="{{ $translation->alt_attribute }}"
                        @endif
                        @endforeach
                        >
                    </li>
                    <li>
                        <label>Image Title [{{$lang->lang}}]</label>
                        <input type="text" name="title_{{ $lang->lang }}"
                        @foreach($category->translations as $translation)
                        @if ($translation->lang_id == $lang->id)
                        value="{{ $translation->image_title }}"
                        @endif
                        @endforeach>
                    </li>
                </ul>
            </div>
            <div class="part right-part">
                <ul>
                    <h6>Seo тексты</h6>
                    <li>
                        <label>{{trans('variables.meta_title_page')}} [{{$lang->lang}}]</label>
                        <input type="text" name="meta_title_{{ $lang->lang }}"
                        @foreach($category->translations as $translation)
                        @if ($translation->lang_id == $lang->id)
                        value="{{ $translation->meta_title }}"
                        @endif
                        @endforeach
                        >
                    </li>
                    <li>
                        <label>{{trans('variables.meta_keywords_page')}} [{{$lang->lang}}]</label>
                        <input type="text" name="meta_keywords_{{ $lang->lang }}"
                        @foreach($category->translations as $translation)
                        @if ($translation->lang_id == $lang->id)
                        value="{{ $translation->meta_keywords }}"
                        @endif
                        @endforeach
                        >
                    </li>
                    <li>
                        <label>{{trans('variables.meta_description_page')}} [{{$lang->lang}}]</label>
                        <input type="text" name="meta_description_{{ $lang->lang }}"
                        @foreach($category->translations as $translation)
                        @if ($translation->lang_id == $lang->id)
                        value="{{ $translation->meta_description }}"
                        @endif
                        @endforeach
                        >
                    </li>
                </ul>
            </div>
        </div>
        @endforeach
        @endif
        <div class="part left-part">
            <ul>
                <li>
                    <div class="form-group">
                        <label>Alias</label>
                        <input class="text" type="text" name="alias" class="form-control" value="{{ $category->alias }}">
                    </div>
                </li>
                <li>
                    <br><br>
                    <input type="submit" value="{{trans('variables.save_it')}}">
                </li>
            </ul>
        </div>
    </form>
</div>
@stop
@section('footer')
<footer>
    @include('admin::admin.footer')
</footer>
@stop
