<div class="card-body" @if (!hasRole('School Admin')) style="pointer-events: none;" @endif>
    <div class="form-group">
        <label for="name">{{ __('School Full Name *') }}</label>
        <input type="text" va class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"
            placeholder="{{ __('School Full Name') }}" id="name"
            value="{{ isset($school) ? old('name', $school->name) : old('name', '') }}">
        @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="nickname">{{ __('School Nick Name *') }}</label>
        <input type="text" id="nickname" class="form-control {{ $errors->has('nickname') ? 'is-invalid' : '' }}"
            name="nickname" placeholder="{{ __('School Nick Name') }}"
            value="{{ isset($school) ? old('nickname', $school->nickname) : old('nickname', '') }}">
        @if ($errors->has('nickname'))
            <span class="text-danger">{{ $errors->first('nickname') }}</span>
        @endif
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="email">{{ __('School Email *') }}</label>
            <input type="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                name="email" placeholder="{{ __('School Email') }}"
                value="{{ isset($school) ? old('email', $school->email) : old('email', '') }}">
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="col-md-6 form-group">
            <label for="contact">{{ __('School Contact *') }}</label>
            <input type="number" id="contact" minlength="10" maxlength="10"
                class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}" name="contact"
                placeholder="{{ __('School Contact') }}"
                value="{{ isset($school) ? old('contact', $school->contact) : old('contact', '') }}">
            @if ($errors->has('contact'))
                <span class="text-danger">{{ $errors->first('contact') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="city">{{ __('City *') }}</label>
            <input type="text" id="city" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}"
                name="city" placeholder="{{ __('City') }}"
                value="{{ isset($school) ? old('city', $school->city) : old('city', '') }}">
            @if ($errors->has('city'))
                <span class="text-danger">{{ $errors->first('city') }}</span>
            @endif
        </div>
        <div class="col-md-6 form-group">
            <label for="address">{{ __('Full Address *') }}</label>
            <input type="text" id="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                name="address" placeholder="{{ __('School Address') }}"
                value="{{ isset($school) ? old('address', $school->address) : old('address', '') }}">
            @if ($errors->has('address'))
                <span class="text-danger">{{ $errors->first('address') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="owner_name">{{ __('School Owner Name') }}</label>
            <input type="text" id="owner_name"
                class="form-control {{ $errors->has('owner_name') ? 'is-invalid' : '' }}" name="owner_name"
                placeholder="{{ __('School Email') }}"
                value="{{ isset($school) ? old('owner_name', $school->owner_name) : old('owner_name', '') }}">
            @if ($errors->has('owner_name'))
                <span class="text-danger">{{ $errors->first('owner_name') }}</span>
            @endif
        </div>
        <div class="col-md-6 form-group">
            <label for="owner_contact">{{ __('School Owner Contact') }}</label>
            <input type="number" id="owner_contact"
                class="form-control {{ $errors->has('owner_contact') ? 'is-invalid' : '' }}" name="owner_contact"
                placeholder="{{ __('School Owner Contact') }}"
                value="{{ isset($school) ? old('owner_contact', $school->owner_contact) : old('owner_contact', '') }}">
            @if ($errors->has('owner_contact'))
                <span class="text-danger">{{ $errors->first('owner_contact') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="principle_name">{{ __('Principle Name *') }}</label>
            <input type="text" id="principle_name"
                class="form-control {{ $errors->has('principle_name') ? 'is-invalid' : '' }}" name="principle_name"
                placeholder="{{ __('Principle Name') }}"
                value="{{ isset($school) ? old('principle_name', $school->principle_name) : old('principle_name', '') }}">
            @if ($errors->has('principle_name'))
                <span class="text-danger">{{ $errors->first('principle_name') }}</span>
            @endif
        </div>
        <div class="col-md-6 form-group">
            <label for="principle_contact">{{ __('Principle Contact') }}</label>
            <input type="number" id="principle_contact"
                class="form-control {{ $errors->has('principle_contact') ? 'is-invalid' : '' }}"
                name="principle_contact" placeholder="{{ __('Principle Contact') }}"
                value="{{ isset($school) ? old('principle_contact', $school->principle_contact) : old('principle_contact', '') }}">
            @if ($errors->has('principle_contact'))
                <span class="text-danger">{{ $errors->first('principle_contact') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label for="google_map_link">{{ __('Google Map Link') }}</label>
        <input type="text" class="form-control" name="google_map_link" placeholder="{{ __('Google Map Link') }}"
            id="google_map_link"
            value="{{ isset($school) ? old('google_map_link', $school->google_map_link) : old('google_map_link', '') }}">
    </div>

    {{-- <div class="form-group">
        <div class="icheck-success">
            <input type="checkbox" id="is_active" name="is_active"
                {{ isset($school) ? ($school->is_active ? 'checked' : '') : '' }}
                value="{{ isset($school) ? old('is_active', $school->is_active) : old('is_active', 0) }}" />
            <label for="is_active">Active</label>
        </div>
    </div> --}}
</div>

@if (hasRole('School Admin'))
    <div class="card-footer">
        <button type="submit" class="btn btn-success">Save</button>
    </div>
@endif
