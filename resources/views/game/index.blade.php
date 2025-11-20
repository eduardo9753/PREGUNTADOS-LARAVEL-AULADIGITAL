@extends('layouts.app')


@section('main')
    @livewire('game', ['user' => 1, 'category_id' => $category_id], key(1))
@endsection
