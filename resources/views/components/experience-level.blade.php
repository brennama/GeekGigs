<select class="form-select" name="experienceLevel"
    @if (!empty($tabindex)) tabindex="{{ $tabindex }}" @endif {{ !empty($required) ? 'required' : '' }}>
    <option>Select Experience Level</option>
    @foreach (App\Enums\ExperienceLevel::cases() as $case)
        <option value="{{ $case->value }}">{{ $case->value }}</option>
    @endforeach
</select>
