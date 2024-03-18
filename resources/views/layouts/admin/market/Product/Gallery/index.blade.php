@extends('layouts.admin.master')


@section('title','Gallery')
@section('content')



    <div>
        @livewire('admin.market.product-gallery-table', ['product' => $product])
    </div>

@endsection
