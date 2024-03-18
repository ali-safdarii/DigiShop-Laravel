@extends('layouts.admin.master')

@section('title','Banner')

@section('content')
    <div>
        <livewire:admin.content.banner-table wire:poll.5s />
    </div>
@endsection

