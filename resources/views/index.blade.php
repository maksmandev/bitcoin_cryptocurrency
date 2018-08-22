@extends('layouts.app')

@section('title', 'Price for 1 Bitcoin')

@section('content')
    <div class="content">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-success">
            <div class="box-body">
                @include('table')
            </div>
        </div>
        <div class="text-center">
        </div>
    </div>
@endsection
