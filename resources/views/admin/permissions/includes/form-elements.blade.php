<div class="card-body">
    <div class="form-group">
        <label for="name">{{ __('Permission Name *') }}</label>
        <input type="text" va class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"
            placeholder="{{ __('Permission Name') }}" id="name"
            value="{{ isset($permission) ? old('name', $permission->name) : old('name', '') }}">
        @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-success">Save</button>
</div>
