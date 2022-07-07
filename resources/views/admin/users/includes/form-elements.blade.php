<div class="card-body">
    <div class="form-group">
        <label for="name">{{ __('User Name *') }}</label>
        <input type="text" va class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"
            placeholder="{{ __('User Name') }}" id="name"
            value="{{ isset($user) ? old('name', $user->name) : old('name', '') }}">
        @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="email">{{ __('User Email *') }}</label>
        <input type="email" va class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email"
            placeholder="{{ __('User Email') }}" id="email"
            value="{{ isset($user) ? old('email', $user->email) : old('email', '') }}">
        @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="password">{{ __('User Password *') }}</label>
        <input type="password" va class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
            name="password" placeholder="{{ __('User password') }}" id="password"
            value="{{ isset($user) ? old('password', '') : old('password', '') }}">
        @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif
    </div>
    <div class="form-group">
        <div class="icheck-success">
            <input type="checkbox" id="is_admin" name="is_admin"
                {{ isset($user) ? ($user->is_admin ? 'checked' : '') : '' }}
                value="{{ isset($user) ? old('is_admin', $user->is_admin) : old('is_admin', 0) }}" />
            <label for="is_admin">Admin Side</label>
        </div>
    </div>
    <div class="form-group">
        <label for="roles">{{ __('Roles *') }}</label>
        <select name="roles[]" id="roles" class="form-control {{ $errors->has('roles') ? 'is-invalid' : '' }}"
            multiple>

            @foreach ($roles as $role)
                <option value="{{ $role->id }}"
                    {{ isset($user) ? ($user->hasRole($role->name) ? 'selected' : '') : '' }}>
                    {{ $role->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('roles'))
            <span class="text-danger">{{ $errors->first('roles') }}</span>
        @endif
    </div>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-success">Save</button>
</div>
