@extends('admin.layouts.app')

@section('content')
    <div class="page-header d-flex justify-content-between">
      <h1>@lang('dashboard.categories')</h1>
      <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm align-self-center">
        <x-icon name="plus-square" prefix="fa-regular" />

        @lang('forms.actions.add')
      </a>
    </div>

    @include ('admin/categories/_list')
@endsection
