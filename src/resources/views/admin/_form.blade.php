@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
@endsection

@include('core::admin._buttons-form')

{!! BootForm::hidden('id') !!}

{!! BootForm::text(__('validation.attributes.name'), 'name') !!}

{!! TranslatableBootForm::hidden('status')->value(0) !!}
{!! TranslatableBootForm::checkbox(__('validation.attributes.online'), 'status') !!}
{!! TranslatableBootForm::textarea(__('validation.attributes.body'), 'body')->addClass('ckeditor') !!}

</div>
