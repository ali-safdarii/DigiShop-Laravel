@extends('layouts.admin.master')


@section('title','Color')
@section('content')



    <div>
       {{-- @livewire('admin.market.product-gallery-table', ['product' => $product])--}}
        <livewire:admin.market.color-table :product="$product"/>
    </div>

@endsection
