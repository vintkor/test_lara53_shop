@foreach($menus as $menu)
    <li>
        <a href="/{{ $menu->slug }}">
            <i class="fa {{ $menu->icon }}" aria-hidden="true"></i> {{ $menu->title }}
        </a>
    </li>
    @endforeach