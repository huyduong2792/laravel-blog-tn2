
<form action="{{ route('admin.users.update', $user) }}" method="POST">
  @method('PATCH')
  @csrf

  <div class="row">
    <div class="form-group mb-3 col-md-6">
      <label class="form-label" for="name">
        @lang('users.attributes.name')
      </label>

      <input
          type="text"
          id="name"
          name="name"
          @class(['form-control', 'is-invalid' => $errors->has('name')])
          placeholder="@lang('users.placeholder.name')"
          required
          value="{{ old('name', $user) }}"
      >

      @error('name')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <div class="form-group mb-3 col-md-6">
      <label class="form-label" for="email">
        @lang('users.attributes.email')
      </label>
      <input
        type="email"
        id="email"
        name="email"
        @class(['form-control', 'bg-secondary', 'is-invalid' => $errors->has('email')])
        placeholder="@lang('users.placeholder.email')"
        required
        value="{{ old('email', $user) }}"
      >
      
      @error('email')
      <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>
  </div>
  
  <div class="row">
    {{-- <div class="form-group mb-3 col-md-6">
      <label class="form-label" for="password">
        @lang('users.attributes.password')
      </label>

      <input
          type="password"
          id="password"
          name="password"
          @class(['form-control', 'is-invalid' => $errors->has('password')])
          placeholder="@lang('users.placeholder.password')"
      >

      @error('password')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div> --}}

    {{-- <div class="form-group mb-3 col-md-6">
      <label class="form-label" for="password_confirmation">
        @lang('users.attributes.password_confirmation')
      </label>

      <input
          type="password"
          id="password_confirmation"
          name="password_confirmation"
          @class(['form-control', 'is-invalid' => $errors->has('password_confirmation')])
          placeholder="@lang('users.placeholder.password_confirmation')"
      >

      @error('password_confirmation')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div> --}}
  </div>

  <div class="form-group mb-3">
    <label class="form-label" for="roles">
        @lang('users.attributes.roles')
    </label>

    @foreach($roles as $role)
      <div class="checkbox">
        <label>
          <input type="checkbox" name="roles[{{ $role->id }}]" value="{{ $role->id }}" @checked($user->hasRole($role->name))>

          @if (Lang::has('roles.' . $role->name))
            {!! __('roles.' . $role->name) !!}
          @else
            {{ ucfirst($role->name) }}
          @endif
        </label>
      </div>
    @endforeach
  </div>


  <button type="submit" class="btn btn-primary">
      <x-icon name="save" />

      @lang('forms.actions.update')
  </button>
</form>
<hr class="my-4">
<h4>
  @lang('users.attributes.role_requests')
</h4>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>@lang('users.request_to_become')</th>
        <th>@lang('users.requested_at')</th>
        <th>@lang('users.action')</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($user->roleRequests()->orderBy('created_at', 'desc')->take(10)->get() as $roleRequest)
        <tr>
          <td>{{ ucfirst($roleRequest->role->name) }}</td>
          <td>@humanize_date($roleRequest->created_at, 'd/m/Y H:i:s')</td>
          @if ($roleRequest->status === 'pending')
            <td>
              <form action="{{ route('admin.role_request.update', $roleRequest) }}" method="POST">
                @csrf
                @method('PATCH')

                <button type="submit" name="action" value="approve" class="btn btn-success">@lang('users.actions.approve')</button>
                <button type="submit" name="action" value="reject" class="btn btn-danger">@lang('users.actions.reject')</button>
              </form>
            </td>
          @else
            <td>
              <span class="{{ $roleRequest->status === 'approved' ? 'text-success' : 'text-danger' }}">
                @lang("users.statuses.{$roleRequest->status}")
              </span>
            </td>
          @endif
        </tr>
      @endforeach
    </tbody>
  </table>
</div>