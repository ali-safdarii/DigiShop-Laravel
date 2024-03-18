@extends('layouts.admin.master')



@section('title','Comment')

@section('content')

    <div>
        <livewire:admin.content.post-comment-table wire:poll.5s />
    </div>



@endsection


