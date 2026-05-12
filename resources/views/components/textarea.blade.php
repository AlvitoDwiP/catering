@props(['name', 'label' => null, 'value' => null, 'placeholder' => null])

<div class="space-y-2">
    @if ($label)
        <label for="{{ $name }}" class="text-sm font-medium text-nk-text">{{ $label }}</label>
    @endif
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        rows="4"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'w-full rounded-xl border border-nk-border bg-white/80 px-4 py-3 text-sm text-nk-text placeholder:text-nk-muted focus:border-nk-primary focus:outline-none']) }}
    >{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="text-sm text-nk-error">{{ $message }}</p>
    @enderror
</div>
