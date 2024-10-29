@extends('users.layout', ['tab' => 'roles'])

@section('main_content')
  <x-card>
    <h1>@lang('users.role')</h1>
    <hr class="my-4">
    @foreach($roles as $role)
      <div class="row">
        <div class="col-sm-4">
          {{ ucfirst($role->name) }}
        </div>
        <div class="col-sm-8">
          @if($user->hasRole($role->name))
            <x-icon name="check-circle" prefix="ms-2 fa-regular" class="text-success"/>
          @else
            @if($user->hasPendingRoleRequest($role->name))
              <x-icon name="clock" prefix="ms-2 fa-regular" class="text-warning"/>
            @else
              <form action="{{ route('users.roles.request', $role) }}" method="POST">
                @csrf

                  <input
                      type="hidden"
                      id="role"
                      name="role"
                      value="{{ $role->name }}"
                  >
                <button type="submit" class="btn btn-link">
                  @lang('users.request_to_become') {{ ucfirst($role->name) }}
                </button>
              </form>
            @endif
          @endif
        </div>
      </div>
    @endforeach
  </x-card>
@endsection
