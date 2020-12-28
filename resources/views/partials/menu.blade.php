<div class="site-menubar">
  <div class="site-menubar-body">
    <div>
      <div>
        <ul class="site-menu" data-plugin="menu">
          <li class="site-menu-item">
            <a class="animsition-link" href="#">
                <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title">Dashboard</span>
            </a>
          </li>
          <?php
          $menuItems=App\Models\Right::getMenuItems();
          ?>
          @foreach($menuItems as $menu)
            <li class="site-menu-item has-sub">
              <a href="javascript:void(0)">
                <i class="site-menu-icon md-border-all" aria-hidden="true"></i>
                <span class="site-menu-title">{{ $menu->title }}</span>
              </a>
                @if(count($menu->childs))
                    @include('partials.menu_child',['childs' => $menu->childs])
                @endif
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>