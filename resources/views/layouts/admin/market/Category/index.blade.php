@extends('layouts.admin.master')

@section('title','Category')

@section('content')

    <div>
        <livewire:admin.market.product-category-table wire:poll.5s />
    </div>

@endsection



