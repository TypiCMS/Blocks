@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
@endsection

@include('core::admin._buttons-form')

{!! BootForm::hidden('id') !!}

{!! BootForm::text(__('Name'), 'name') !!}

{!! TranslatableBootForm::hidden('status')->value(0) !!}
{!! TranslatableBootForm::checkbox(__('Online'), 'status') !!}
{!! TranslatableBootForm::textarea(__('Body'), 'body')->addClass('ckeditor') !!}

</div>
