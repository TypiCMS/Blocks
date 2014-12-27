@section('main')

    {{ BootForm::open()->put()->action(route('admin.blocks.update', $model->id))->role('form') }}
    {{ BootForm::bind($model) }}
        @include('blocks.admin._form')
    {{ BootForm::close() }}

@stop
