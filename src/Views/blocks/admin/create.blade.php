@section('main')

    {{ BootForm::open()->action(route('admin.blocks.index'))->role('form') }}
        @include('blocks.admin._form')
    {{ BootForm::close() }}

@stop
