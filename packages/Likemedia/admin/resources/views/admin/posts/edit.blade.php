@extends('admin::admin.app')
@include('admin::admin.nav-bar')
@include('admin::admin.left-menu')
@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/back') }}">Control Panel</a></li>
            <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Articole</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editarea articolului</li>
        </ol>
    </nav>
    <div class="title-block">
        <h3 class="title"> Editarea articolului </h3>
        @include('admin::admin.list-elements', [
        'actions' => [
        trans('variables.add_element') => route('posts.create'),
        ]
        ])
    </div>

    @include('admin::admin.alerts')

    <div class="list-content">

        <form class="form-reg" method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }} {{ method_field('PATCH') }}

            <div class="part full-part" style="padding: 25px 8px;">

                <label>Category</label>
                <select class="form-control" name="category_id">
                    <option disabled>- - -</option>
                    @foreach($categories as $category)
                        <option {{ $category->id == $post->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->translation()->first()->name }}</option>
                    @endforeach
                </select>


            </div>


            @if (!empty($langs))

                <div class="tab-area" style="margin-top: 25px;">
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        @if (!empty($langs))
                            @foreach ($langs as $key => $lang)
                                <li class="nav-item">
                                    <a href="#{{ $lang->lang }}" class="nav-link  {{ $key == 0 ? ' open active' : '' }}"
                                       data-target="#{{ $lang->lang }}">{{ $lang->lang }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>


                @foreach ($langs as $key => $lang)

                    <div class="tab-content {{ $key == 0 ? ' active-content' : '' }}" id={{ $lang->lang }}>
                        <div class="part left-part">

                            <ul style="padding: 25px 0;">
                                <li>
                                    <label>{{trans('variables.title_table')}} [{{ $lang->lang }}]</label>
                                    <input type="text" name="title_{{ $lang->lang }}" class="name" data-lang="{{ $lang->lang }}"
                                           @foreach($post->translations as $translation)
                                           @if ($translation->lang_id == $lang->id)
                                           value="{{ $translation->title }}"
                                            @endif
                                            @endforeach
                                    >
                                </li>

                                <li>
                                    <label for="">{{trans('variables.body')}} [{{ $lang->lang }}]</label>
                                    <textarea name="body_{{ $lang->lang }}" id="body-{{ $lang->lang }}"
                                              data-type="ckeditor">
                                         @foreach($post->translations as $translation)
                                            @if ($translation->lang_id == $lang->id)
                                                {!! $translation->body !!}
                                            @endif
                                        @endforeach
                                    </textarea>
                                    <script>
                                        CKEDITOR.replace('body-{{ $lang->lang }}', {
                                            language: '{{$lang->lang}}',
                                            filebrowserBrowseUrl: "{{route('infos.upload',['_token' => csrf_token() ])}}",
                                            filebrowserImageBrowseUrl: "{{route('infos.upload',['_token' => csrf_token() ])}}",
                                            filebrowserUploadUrl: "{{route('infos.upload',['_token' => csrf_token() ])}}",
                                            filebrowserImageUploadUrl: "{{route('infos.upload',['_token' => csrf_token() ])}}"
                                        });
                                    </script>
                                </li>
                            </ul>
                        </div>


                        <div class="part right-part">
                            <ul>

                                <li>
                                    <label>{{trans('variables.h1_title_page')}} [{{ $lang->lang }}]</label>
                                    <input type="text" name="meta_title_{{ $lang->lang }}"
                                           @foreach($post->translations as $translation)
                                           @if ($translation->lang_id == $lang->id)
                                           value="{{ $translation->meta_h1 }}"
                                            @endif
                                            @endforeach
                                    >
                                </li>


                                <li>
                                    <label>{{trans('variables.meta_title_page')}} [{{ $lang->lang }}]</label>
                                    <input type="text" name="meta_title_{{ $lang->lang }}"
                                           @foreach($post->translations as $translation)
                                           @if ($translation->lang_id == $lang->id)
                                           value="{{ $translation->meta_title }}"
                                            @endif
                                            @endforeach
                                    >
                                </li>

                                <li>
                                    <label>{{trans('variables.meta_keywords_page')}} [{{ $lang->lang }}]</label>
                                    <input type="text" name="meta_keywords_{{ $lang->lang }}"
                                           @foreach($post->translations as $translation)
                                           @if ($translation->lang_id == $lang->id)
                                           value="{{ $translation->meta_keywords }}"
                                            @endif
                                            @endforeach
                                    >
                                </li>

                                <li>
                                    <label>{{trans('variables.meta_description_page')}} [{{ $lang->lang }}]</label>
                                    <input type="text" name="meta_description_{{ $lang->lang }}"
                                           @foreach($post->translations as $translation)
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

            <div class="part">
              <ul>
                <li>
                    <span>On Home</span>
                    <input type="checkbox" name="on_home" {{$post->on_home == 1 ? 'checked' : ''}}>
                </li>
                <li>
                    <label>Alias</label>
                    <input type="text" name="alias" class="form-control" id="slug-{{ $lang->lang }}" value="{{$post->alias}}">
                </li>
                <li>
                    <label>Image</label>
                    <input type="file" name="image" id="upload-file">
                    <img id="upload-img" src="/images/posts/{{ $post->image }}"  alt="" width="200px">
                </li>
                <li>
                    <label>Date</label>
                    <input type="date" name="date" value="{{date("Y-m-d", strtotime($post->date))}}">
                    <input type="time" name="time" value="{{date("H:i", strtotime($post->date))}}">
                </li>
                <li>
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

        <script>

            $('button.tag').click(function(e) {
                e.preventDefault();

                $input = $(this).siblings().last().clone().val('');
                $(this).parent().append($input);
            });

            $('.delete-btn').on('click', function(){
                var conf = confirm("Do you want delete this element?");

                if(conf != true)
                    e.preventDefault();
                else{
                    $id = $(this).attr('data-id');
                    $postId = '{{ $post->id }}';
                    $.ajax({
                        type: "POST",
                        url: '/back/posts/file/delete',
                        data: {
                            id: $id,
                            postId: $postId,
                        },
                        success: function(data) {
                            if (data === 'true') {
                                location.reload();
                            }
                        }
                    });
                }
            });

        </script>
    </footer>
@stop
