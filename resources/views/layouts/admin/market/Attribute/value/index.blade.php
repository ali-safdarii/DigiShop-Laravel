@extends('layouts.admin.master')

@section('title','values')

@section('content')

    <div>
        @livewire('admin.market.category-values-table', ['attribute' => $attribute])
    </div>
@endsection
