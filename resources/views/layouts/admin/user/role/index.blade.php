@extends('layouts.admin.master')

@section('title','Role')


@section('content')

    <div>
        <livewire:admin.user.role.role-table wire:poll.5s />
    </div>
@endsection
