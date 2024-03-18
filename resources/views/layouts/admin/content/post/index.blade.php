@extends('layouts.admin.master')
@section('title','posts')


@section('content')

    <div>
        <livewire:admin.content.post-table wire:poll.5s />
    </div>

@endsection
