@extends('layouts.login')

@section('content')
usersProfile
@foreach($profile as $profile)
<p>{{ $profile->username }}</p>
<p>{{ $profile->bio }}</p>
@endforeach
  <?php
  $auth = Auth::id();
  $id = $profile->id;
  echo $id;
  $count = DB::table('follows')
  ->where([['follower',$auth],['follow',$id]]) //[]を二重にしないと「Column not found」というエラーが出る
  ->count();

  if($count == 0){
  ?>
  <div><a href="/follow{{ $id }}">follow</a></div> <!-- userProfileFollowではweb.phpを経由しなくなる -->
  <?php
  }
  if($count == 1){
  ?>
  <div><a href="/unfollow{{ $id }}">unfollow</a></div>
  <?php
  }
  ?>

@foreach($posts as $posts)
<p>{{ $posts->username }}</p>
<p>{{ $posts->created_at }}</p>
<p>{{ $posts->posts }}</p>
@endforeach
@endsection
