@extends('layouts.app')

@section('content')
    <div id="florist-dashboard"></div>

    @viteReactRefresh
    @vite('resources/js/florist/App.jsx')
@endsection
