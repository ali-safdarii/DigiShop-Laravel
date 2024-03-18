@extends('layouts.admin.master')


@section('title','Delivery')
@section('content')



    <div>
        <livewire:admin.market.delivery-table wire:poll.5s />
    </div>

@endsection
