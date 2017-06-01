@extends('core::admin.master')

@section('title', __('New content block'))

@section('content')

    @include('core::admin._button-back', ['module' => 'blocks'])
    <h1>
        @lang('New content block')
    </h1>

    {!! BootForm::open()->action(route('admin::index-blocks'))->multipart()->role('form') !!}
        @include('blocks::admin._form')
    {!! BootForm::close() !!}

@endsection
