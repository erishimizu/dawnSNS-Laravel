@extends('layouts.login')

@section('content')
<h2>search</h2>
  <form class="search-form" action="searchList" method="get">
    @if(isset($search))
    <input class="search-form" type="text" name="search" placeholder="<?php echo $search ?>">
    @else
    <input class="search-text" type="text" name="search" placeholder="Search">
    @endif
    <button id="sbtn" type="submit"><i class="fas fa-search"></i></button>
  </form>

  @if(isset($users))
  @foreach($users as $user)
    @if($user->id === Auth::user()->id)
    <a href="/profile">{{ $user->username }}</a>
    @else
    <a href="/user{{ $user->id }}">{{ $user->username }}</a>
    @endif

  @endforeach
  @endif

@endsection
