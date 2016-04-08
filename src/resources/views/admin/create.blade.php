@extends('core::admin.master')

@section('title', trans('blocks::global.New'))

@section('main')

    @include('core::admin._button-back', ['module' => 'blocks'])
    <h1>
        @lang('blocks::global.New')
    </h1>

    {!! BootForm::open()->action(route('admin::index-blocks'))->multipart()->role('form') !!}
        @include('blocks::admin._form')
    {!! BootForm::close() !!}

@endsection
