<ul class="site-menu-sub">
  @foreach($childs as $child)
    @if(count($child->childs)>0)
    <li class="site-menu-item has-sub">
        <a href="javascript:void(0)">
          <span class="site-menu-title">{{ $child->title }}</span>
          <span class="site-menu-arrow"></span>
        </a>
        @include('partials.menu_child',['childs' => $child->childs])
    </li>
    @else
    <li class="site-menu-item {{ request()->is($child->link)||request()->is($child->link.'/*') ? 'active' : '' }}">
      <a href="{{url($child->link)}}" class="animsition-link">
        <span class="site-menu-title">{{ $child->title }}</span>
      </a>
    </li>
    @endif
  @endforeach
</ul>