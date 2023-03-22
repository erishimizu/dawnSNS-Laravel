@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>
@foreach ($lists as $lists)
<div><img src="/images/icons/{{ $lists->images }}"></div>
<div>{{ $lists->username }}</div>
<div>{{ $lists->posts }}</div>
<div>{{ $lists->created_at }}</div>
@endforeach


@endsection
