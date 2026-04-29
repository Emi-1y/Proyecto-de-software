{{-- Author: Emily Cardona Castañeda  --}}

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
    <div>
        <label for="name" class="form-label">{{ __('service.name') }}</label>
        <input type="text" id="name" name="name" class="form-control"
               value="{{ old('name', $service?->getName()) }}">
    </div>
    <div>
        <label for="emoji" class="form-label">{{ __('service.emoji') }}</label>
        <input type="text" id="emoji" name="emoji" class="form-control"
               value="{{ old('emoji', $service?->getEmoji() ?? '🌿') }}" maxlength="10">
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
    <div>
        <label for="price" class="form-label">{{ __('service.price') }}</label>
        <input type="number" id="price" name="price" class="form-control" min="0"
               value="{{ old('price', $service?->getPrice()) }}">
    </div>
    <div>
        <label for="duration" class="form-label">{{ __('service.duration') }}</label>
        <input type="text" id="duration" name="duration" class="form-control"
               value="{{ old('duration', $service?->getDuration()) }}"
               placeholder="{{ __('service.duration_placeholder') }}">
    </div>
</div>

<div style="margin-bottom: 1rem;">
    <label for="employee" class="form-label">{{ __('service.employee') }}</label>
    <input type="text" id="employee" name="employee" class="form-control"
           value="{{ old('employee', $service?->getEmployee()) }}"
           placeholder="{{ __('service.employee_placeholder') }}">
</div>

<div style="margin-bottom: 1rem;">
    <label for="description" class="form-label">{{ __('service.description') }}</label>
    <textarea id="description" name="description" class="form-control" rows="3"
    >{{ old('description', $service?->getDescription()) }}</textarea>
</div>

<div style="margin-bottom: 1rem;">
    <label for="features_text" class="form-label">{{ __('service.features') }}</label>
    <textarea id="features_text" name="features_text" class="form-control" rows="5"
              placeholder="{{ __('service.features_placeholder') }}"
    >{{ old('features_text', $service ? implode("\n", $service->getFeatures()) : '') }}</textarea>
    <small class="text-muted" style="margin-top: 0.3rem; display: block;">{{ __('service.features_help') }}</small>
</div>

<div style="display: flex; gap: 2rem; margin-bottom: 1.5rem;">
    <div class="form-check">
        <input type="checkbox" id="active" name="active" value="1" class="form-check-input"
               {{ old('active', $service?->getActive() ?? true) ? 'checked' : '' }}>
        <label for="active" class="form-check-label">{{ __('service.active') }}</label>
    </div>
</div>

<div style="display: flex; gap: 0.75rem;">
    <button type="submit" class="btn btn-primary">{{ $submitText }}</button>
    <a href="{{ route('admin.service.index') }}" class="btn btn-outline-secondary">{{ __('service.back_button') }}</a>
</div>
