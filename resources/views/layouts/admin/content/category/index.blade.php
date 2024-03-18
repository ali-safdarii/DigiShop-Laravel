@extends('layouts.admin.master')



@section('title','Category')

@section('content')

    <div>
        <livewire:post-category-table wire:poll.5s />
    </div>



@endsection


