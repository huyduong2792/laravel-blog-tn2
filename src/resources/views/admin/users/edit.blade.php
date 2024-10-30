@extends('admin.layouts.app')

@section('content')
    <a href="{{ route('admin.users.index') }}" class="btn btn-light">
        <x-icon name="chevron-left" />
    
        @lang('forms.actions.back')
    </a>
    <p class="mt-2">

        @lang('users.show') :

        <a href="{{ route('users.show', $user) }}">
            {{ route('users.show', $user) }}
        </a>
    </p>

    @include('admin/users/_form')
@endsection
