@props(['name', 'label' => null, 'type' => 'text', 'value' => null, 'placeholder' => null])

<div class="space-y-2">
    @if ($label)
        <label for="{{ $name }}" class="text-sm font-medium tracking-[-0.01em] text-nk-text">{{ $label }}</label>
    @endif
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'w-full rounded-2xl border border-nk-border bg-white/80 px-4 py-3 text-sm text-nk-text shadow-sm placeholder:text-nk-muted focus:border-nk-primary focus:outline-none focus:ring-4 focus:ring-nk-primary/10']) }}
    >
    @error($name)
        <p class="text-sm text-nk-error">{{ $message }}</p>
    @enderror
</div>
