@extends('core::admin.master')

@section('title', __('Content blocks'))

@section('content')

<div ng-cloak ng-controller="ListController">

    @include('core::admin._button-create', ['module' => 'blocks'])

    <h1>@lang('Content blocks')</h1>

    <div class="btn-toolbar">
        @include('core::admin._button-select')
        @include('core::admin._button-actions')
        @include('core::admin._lang-switcher-for-list')
    </div>

    <div class="table-responsive">

        <table st-persist="blocksTable" st-table="displayedModels" st-safe-src="models" st-order st-filter class="table table-main">
            <thead>
                <tr>
                    <th class="delete"></th>
                    <th class="edit"></th>
                    <th st-sort="status_translated" class="status st-sort">{{ __('Status') }}</th>
                    <th st-sort="name" st-sort-default="true" class="name st-sort">{{ __('Name') }}</th>
                    <th st-sort="body_cleaned_translated" class="body_cleaned_translated st-sort">{{ __('Content') }}</th>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>
                        <input st-search="name" class="form-control form-control-sm" placeholder="@lang('Filter')…" type="text">
                    </td>
                    <td>
                        <input st-search="body_cleaned_translated" class="form-control form-control-sm" placeholder="@lang('Filter')…" type="text">
                    </td>
                </tr>
            </thead>

            <tbody>
                <tr ng-repeat="model in displayedModels">
                    <td>
                        <input type="checkbox" checklist-model="checked.models" checklist-value="model">
                    </td>
                    <td>
                        @include('core::admin._button-edit', ['module' => 'blocks'])
                    </td>
                    <td typi-btn-status action="toggleStatus(model)" model="model"></td>
                    <td>@{{ model.name }}</td>
                    <td>@{{ model.body_cleaned_translated }}</td>
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
