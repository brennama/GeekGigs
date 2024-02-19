<select class="form-select" name="experienceLevel" id="experienceLevelSelect"
    @if (!empty($tabindex)) tabindex="{{ $tabindex }}" @endif {{ !empty($required) ? 'required' : '' }}>
    <option value="">Experience Level</option>
    @foreach (App\Enums\ExperienceLevel::cases() as $case)
        <option value="{{ $case->value }}"{{ $selected?->value === $case->value ? ' selected' : '' }}>
            {{ $case->value }}
        </option>
    @endforeach
</select>
