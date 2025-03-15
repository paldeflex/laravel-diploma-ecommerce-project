<a wire:navigate href="{{ $href }}" aria-label="{{ $title }}">
    <span class="logo flex items-center space-x-3 ">
        <span class="logo__icon flex items-center justify-center">
            @includeIf("icons.{$icon}", ['iconSize' => $iconSize, 'iconColor' => $iconColor])
        </span>
        <span class="logo__text flex flex-col justify-center leading-tight {{ $textColor }}">
            <p class="font-semibold {{ $titleSize }} whitespace-nowrap">{{ $title }}</p>
            <small class="{{ $subtitleSize }} text-gray-300 whitespace-nowrap">{{ $subtitle }}</small>
        </span>
    </span>
</a>
