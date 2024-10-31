@extends('admin.layouts.app')

@section('content')

    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @method('PUT')
        @csrf

        @include('admin/categories/_form')

        <div class="pull-left">
            <a href="{{ route('admin.posts.index') }}" class="btn btn-light">
                <x-icon name="chevron-left" />

                @lang('forms.actions.back')
            </a>

            <button type="submit" class="btn btn-primary">
                <x-icon name="save" />

                @lang('forms.actions.update')
            </button>
        </div>
    </form>
@endsection
