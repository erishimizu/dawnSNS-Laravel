@extends('layouts.login')

@section('content')
usersProfile
@foreach($profile as $profile)
<p>{{ $profile->username }}</p>
<p>{{ $profile->bio }}</p>
@endforeach

@foreach($posts as $posts)
<p>{{ $posts->username }}</p>
<p>{{ $posts->created_at }}</p>
<p>{{ $posts->posts }}</p>
@endforeach
@endsection
