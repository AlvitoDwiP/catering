@props(['name', 'label' => null, 'type' => 'text', 'value' => null, 'placeholder' => null])

<div class="space-y-2">
    @if ($label)
        <label for="{{ $name }}" class="text-sm font-medium text-nk-text">{{ $label }}</label>
    @endif
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'w-full rounded-xl border border-nk-border bg-white/80 px-4 py-3 text-sm text-nk-text placeholder:text-nk-muted focus:border-nk-primary focus:outline-none']) }}
    >
    @error($name)
        <p class="text-sm text-nk-error">{{ $message }}</p>
    @enderror
</div>
