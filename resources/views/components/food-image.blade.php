@props([
    'src' => null,
    'imageKey' => null,
    'placeholder' => null,
    'placeholderKey' => null,
    'alt' => '',
    'ratio' => '4 / 3',
    'priority' => false,
    'rounded' => 'rounded-[24px]',
    'class' => '',
    'imageClass' => '',
    'overlay' => true,
])

@php
    use Illuminate\Support\Arr;
    use Illuminate\Support\Facades\Vite;
    use Illuminate\Support\Str;

    $resolveSource = static function (?string $source): ?string {
        if (! $source) {
            return null;
        }

        if (Str::startsWith($source, ['http://', 'https://', '/', 'data:'])) {
            return $source;
        }

        return Vite::asset($source);
    };

    $imageSource = $src;

    if (! $imageSource && $imageKey) {
        $imageSource = Arr::get(config('image-map.images'), $imageKey);
    }

    $placeholderSource = $placeholder;

    if (! $placeholderSource && $placeholderKey) {
        $placeholderSource = Arr::get(config('image-map.placeholders'), $placeholderKey);
    }

    $resolvedSource = $resolveSource($imageSource);
    $resolvedPlaceholder = $resolveSource($placeholderSource);
@endphp

<div
    data-food-image-shell
    class="nk-food-image-shell {{ $rounded }} {{ $class }}"
    style="aspect-ratio: {{ $ratio }};"
>
    @if ($resolvedPlaceholder)
        <div class="nk-food-image-placeholder" style="background-image: url('{{ $resolvedPlaceholder }}')"></div>
    @endif

    <div class="nk-food-image-skeleton"></div>

    @if ($resolvedSource)
        <img
            src="{{ $resolvedSource }}"
            alt="{{ $alt }}"
            class="nk-food-image {{ $imageClass }}"
            loading="{{ $priority ? 'eager' : 'lazy' }}"
            decoding="async"
            @if ($priority) fetchpriority="high" @endif
            onload="this.closest('[data-food-image-shell]')?.classList.add('is-loaded')"
        >
    @endif

    @if ($overlay)
        <div class="nk-food-image-overlay"></div>
    @endif

    {{ $slot }}
</div>
