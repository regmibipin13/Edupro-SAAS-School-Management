<div class="card-body">
    <div class="form-group">
        <label for="name">{{ __('Role Name *') }}</label>
        <input type="text" va class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"
            placeholder="{{ __('Role Name') }}" id="name"
            value="{{ isset($role) ? old('name', $role->name) : old('name', '') }}">
        @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="permissions">{{ __('Permissions *') }}</label>
        <select name="permissions[]" id="permissions"
            class="form-control {{ $errors->has('permissions') ? 'is-invalid' : '' }}" multiple>

            @foreach ($permissions as $permission)
                <option value="{{ $permission->id }}"
                    {{ isset($role) ? ($role->hasPermissionTo($permission->name) ? 'selected' : '') : '' }}>
                    {{ $permission->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('permissions'))
            <span class="text-danger">{{ $errors->first('permissions') }}</span>
        @endif
    </div>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-success">Save</button>
</div>
