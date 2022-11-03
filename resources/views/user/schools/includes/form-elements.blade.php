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

    <div class="row">
        <div class="form-group col-md-6">
            <label for="google_map_link">{{ __('Google Map Link') }}</label>
            <input type="text" class="form-control" name="google_map_link"
                placeholder="{{ __('Google Map Link') }}" id="google_map_link"
                value="{{ isset($school) ? old('google_map_link', $school->google_map_link) : old('google_map_link', '') }}">
        </div>

        <div class="col-md-6 form-group">
            <label for="academic_year_start_date">{{ __('Academic Year Start Date') }}</label>
            <input type="date" id="academic_year_start_date"
                class="form-control {{ $errors->has('academic_year_start_date') ? 'is-invalid' : '' }}"
                name="academic_year_start_date" placeholder="{{ __('Principle Contact') }}"
                value="{{ isset($school) ? old('academic_year_start_date', $school->academic_year_start_date) : old('academic_year_start_date', '') }}">
            @if ($errors->has('academic_year_start_date'))
                <span class="text-danger">{{ $errors->first('academic_year_start_date') }}</span>
            @endif
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Monthly Fee Structure
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 form-group">
                    <label for="tution_fee">{{ __('Tution Fee *') }}</label>
                    <input type="number" id="tution_fee"
                        class="form-control {{ $errors->has('tution_fee') ? 'is-invalid' : '' }}" name="tution_fee"
                        placeholder="{{ __('Tution Fee') }}"
                        value="{{ isset($school) ? old('tution_fee', $school->tution_fee) : old('tution_fee', '') }}">
                    @if ($errors->has('tution_fee'))
                        <span class="text-danger">{{ $errors->first('tution_fee') }}</span>
                    @endif
                </div>
                <div class="col-md-3 form-group">
                    <label for="sports_fee">{{ __('Sport Fee *') }}</label>
                    <input type="number" id="sports_fee"
                        class="form-control {{ $errors->has('sports_fee') ? 'is-invalid' : '' }}" name="sports_fee"
                        placeholder="{{ __('Sport Fee') }}"
                        value="{{ isset($school) ? old('sports_fee', $school->sports_fee) : old('sports_fee', '') }}">
                    @if ($errors->has('sports_fee'))
                        <span class="text-danger">{{ $errors->first('sports_fee') }}</span>
                    @endif
                </div>
                <div class="col-md-3 form-group">
                    <label for="transportation_fee">{{ __('Bus Fee *') }}</label>
                    <input type="number" id="transportation_fee"
                        class="form-control {{ $errors->has('transportation_fee') ? 'is-invalid' : '' }}"
                        name="transportation_fee" placeholder="{{ __('Bus Fee') }}"
                        value="{{ isset($school) ? old('transportation_fee', $school->transportation_fee) : old('transportation_fee', '') }}">
                    @if ($errors->has('transportation_fee'))
                        <span class="text-danger">{{ $errors->first('transportation_fee') }}</span>
                    @endif
                </div>
                <div class="col-md-3 form-group">
                    <label for="food_fee">{{ __('Food Fee *') }}</label>
                    <input type="number" id="food_fee"
                        class="form-control {{ $errors->has('food_fee') ? 'is-invalid' : '' }}" name="food_fee"
                        placeholder="{{ __('Food Fee') }}"
                        value="{{ isset($school) ? old('food_fee', $school->food_fee) : old('food_fee', '') }}">
                    @if ($errors->has('food_fee'))
                        <span class="text-danger">{{ $errors->first('food_fee') }}</span>
                    @endif
                </div>

            </div>
        </div>
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
