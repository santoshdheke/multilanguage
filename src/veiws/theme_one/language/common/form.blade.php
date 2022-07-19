@if(isset($row->key))
    <div class="form-group">
        <label>Key :</label>
        <input type="text" value="{{ $row->key }}" class="form-control" disabled>
    </div>
    @php($key = $row->key)
@else
    @php($key = "")
    <div class="form-group">
        <label>Key :</label>
        @php($olddata = old('key') ?? $row->key ?? '')
        <input type="text" value="{{ $olddata }}" name="key" class="form-control" placeholder="Enter Key">
        @if(isset($errors) && $errors->has('key'))
            <div class="form-error-message">{{ $errors->first('key') }}</div>
        @endif
    </div>

@endif

<div class="form-group">
    <label>English :</label>
    @php($olddata = old('en') ?? config("language.en.".$key) ?? '')
    <input type="text" value="{{ $olddata }}" name="en" class="form-control" placeholder="Enter In English">
    @if(isset($errors) && $errors->has('en'))
        <div class="form-error-message">{{ $errors->first('en') }}</div>
    @endif
</div>

<div class="form-group">
    <label>Nepali :</label>
    @php($olddata = old('np') ?? config("language.np.".$key) ?? '')
    <input type="text" value="{{ $olddata }}" name="np" class="form-control" placeholder="Enter In Nepali">
    @if(isset($errors) && $errors->has('np'))
        <div class="form-error-message">{{ $errors->first('np') }}</div>
    @endif
</div>
