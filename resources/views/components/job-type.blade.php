<select class="form-select" name="jobType"
    @if (!empty($tabindex)) tabindex="{{ $tabindex }}" @endif {{ !empty($required) ? 'required' : '' }}>
    <option>Select Job Type</option>
    @foreach (App\Enums\JobType::cases() as $case)
        <option value="{{ $case->value }}"{{ $selected?->value === $case->value ? ' selected' : '' }}>
            {{ $case->value }}
        </option>
    @endforeach
</select>
