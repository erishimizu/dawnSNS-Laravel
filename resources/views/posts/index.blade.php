@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>
{{ Form::open(['url' => 'create']) }}
<img src="/images/icons/{{ Auth::user()->images }}">
{{ Form::textarea('newPost',null,['class' => 'post-form','placeholder' => '何をつぶやこうか...?']) }}
{{ Form::input('hidden', 'user_id', '$user->id') }}
{{ Form::submit() }}
{{ Form::close() }}
@foreach ($lists as $lists)
<div><img src="/images/icons/{{ $lists->images }}"></div>
<div>{{ $lists->username }}</div>
<div>{{ $lists->posts }}</div>
<div>{{ $lists->created_at }}</div>
@endforeach


@endsection
