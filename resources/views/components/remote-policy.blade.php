<select class="form-select" name="remotePolicy"
    @if (!empty($tabindex)) tabindex="{{ $tabindex }}" @endif {{ !empty($required) ? 'required' : '' }}>
    <option>Select Remote Policy</option>
    @foreach (App\Enums\RemotePolicy::cases() as $case)
        <option value="{{ $case->value }}">{{ $case->value }}</option>
    @endforeach
</select>
