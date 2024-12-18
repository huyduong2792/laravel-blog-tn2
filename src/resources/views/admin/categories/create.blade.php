@extends('admin.layouts.app')

@section('content')
    <h1>@lang('categories.create')</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        @include('admin/categories/_form')

        <a href="{{ route('admin.categories.index') }}" class="btn btn-light">
            <x-icon name="chevron-left" />

            @lang('forms.actions.back')
        </a>

        <button type="submit" class="btn btn-primary">
            <x-icon name="save" />

            @lang('forms.actions.save')
        </button>
    </form>
@endsection
