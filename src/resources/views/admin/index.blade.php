@extends('core::admin.master')

@section('title', __('blocks::global.name'))

@section('content')

<div ng-app="typicms" ng-cloak ng-controller="ListController">

    @include('core::admin._button-create', ['module' => 'blocks'])

    <h1>@lang('blocks::global.name')</h1>

    <div class="btn-toolbar">
        @include('core::admin._lang-switcher')
    </div>

    <div class="table-responsive">

        <table st-persist="blocksTable" st-table="displayedModels" st-safe-src="models" st-order st-filter class="table table-condensed table-main">
            <thead>
                <tr>
                    <th class="delete"></th>
                    <th class="edit"></th>
                    <th st-sort="status" class="status st-sort">{{ __('Status') }}</th>
                    <th st-sort="name" st-sort-default="true" class="name st-sort">{{ __('Name') }}</th>
                    <th st-sort="body" class="body st-sort">{{ __('Content') }}</th>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>
                        <input st-search="name" class="form-control input-sm" placeholder="@lang('Search')…" type="text">
                    </td>
                    <td>
                        <input st-search="body" class="form-control input-sm" placeholder="@lang('Search')…" type="text">
                    </td>
                </tr>
            </thead>

            <tbody>
                <tr ng-repeat="model in displayedModels">
                    <td typi-btn-delete action="delete(model, model.name)"></td>
                    <td>
                        @include('core::admin._button-edit', ['module' => 'blocks'])
                    </td>
                    <td typi-btn-status action="toggleStatus(model)" model="model"></td>
                    <td>@{{ model.name }}</td>
                    <td>@{{ model.body_cleaned }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" typi-pagination></td>
                </tr>
            </tfoot>
        </table>

    </div>

</div>

@endsection
