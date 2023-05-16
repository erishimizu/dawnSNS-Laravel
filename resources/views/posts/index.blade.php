@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>
{{ Form::open(['url' => 'create']) }}
<img src="/storage/{{ Auth::user()->images }}">
{{ Form::textarea('newPost',null,['class' => 'post-form','placeholder' => '何をつぶやこうか...?','maxlength'=>'150']) }}
{{ Form::input('hidden', 'user_id', '$user->id') }}
{{ Form::submit() }}
{{ Form::close() }}
@foreach ($lists as $lists)
  @if($lists->id === Auth::user()->id)
    <div><a href="/profile"><img src="/storage/{{ $lists->images }}"></a></div>
    <div>{{ $lists->username }}</div>
    <div>{{ $lists->posts }}</div>
    <div>{{ $lists->created_at }}</div>
    <div class="modalOpen"><img src="/images/edit.png"></div>
    <div class="updateForm-wrap">

        {{ Form::open(['url' => '/postUpdate']) }}
        {{ Form::textarea('updatePost',null,['class'=>'updateForm','placeholder'=>$lists->posts,'maxlength'=>'150']) }}
        {{ Form::hidden('post_id', $lists->post_id) }}
        {{ Form::button('<img src="/images/edit.png">',['type' => 'submit']) }}
        {{ Form::close() }}
    </div>
    <div><a href="/postDelete/{{ $lists->post_id }}"><img src="/images/trash.png"></a></div>
  @else
    <div><a href="/user{{ $lists->id }}"><img src="/storage/{{ $lists->images }}"></a></div>
    <div>{{ $lists->username }}</div>
    <div>{{ $lists->posts }}</div>
    <div>{{ $lists->created_at }}</div>
    @endif
@endforeach


@endsection
