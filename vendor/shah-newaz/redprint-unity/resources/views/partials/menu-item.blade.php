@if (is_string($item))
    <li class="header">{{ $item }}</li>
@else
    <li class="{{ $item['class'] }}">
        <a href="{{ $item['href'] }}"
           @if (isset($item['target'])) target="{{ $item['target'] }}" @endif
           @if (isset($item['submenu'])) class="has-arrow" @endif
        >
            <span class="has-icon">
                <i class="{{ isset($item['icon']) ? $item['icon'] : 'icon-tabs-outline' }} {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
            </span>
            <span class="nav-title">{{ $item['text'] }}</span>
        </a>
        @if (isset($item['submenu']))
            <ul class="{{ $item['submenu_class'] }}">
                @each('redprintUnity::partials.menu-item', $item['submenu'], 'item')
            </ul>
        @endif
    </li>
@endif
