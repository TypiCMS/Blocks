@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/form.js') }}"></script>
@stop

@include('core::admin._buttons-form')

{!! BootForm::hidden('id') !!}

{!! BootForm::text(trans('validation.attributes.name'), 'name') !!}

@include('core::admin._tabs-lang-form', ['target' => 'content'])

<div class="tab-content">

@foreach ($locales as $lang)

    <div class="tab-pane fade @if($locale == $lang)in active @endif" id="content-{{ $lang }}">
        <input type="hidden" name="{{ $lang }}[status]" value="0">
        {!! BootForm::checkbox(trans('validation.attributes.online'), $lang.'[status]') !!}
        {!! BootForm::textarea(trans('validation.attributes.body'), $lang.'[body]')->addClass('ckeditor') !!}
    </div>

@endforeach

</div>
