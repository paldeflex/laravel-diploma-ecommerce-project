<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Logo extends Component
{
    public string $href;

    public string $iconColor;

    public string $textColor;

    public int $iconSize;

    public string $titleSize;

    public string $subtitleSize;

    public string $title;

    public string $subtitle;

    public string $icon;

    public function __construct(
        string $href = '/',
        string $icon = 'snowflake',
        string $iconColor = '#fff',
        int $iconSize = 32,
        string $textColor = 'text-white',
        string $titleSize = 'text-sm',
        string $subtitleSize = 'text-xs',
        string $title = 'Снежинские краски',
        string $subtitle = 'Защитные покрытия',
    ) {
        $this->href = $href;
        $this->icon = $icon;
        $this->iconColor = $iconColor;
        $this->iconSize = $iconSize;
        $this->textColor = $textColor;
        $this->titleSize = $titleSize;
        $this->subtitleSize = $subtitleSize;
        $this->title = $title;
        $this->subtitle = $subtitle;
    }

    public function render()
    {
        return view('components.logo');
    }
}
