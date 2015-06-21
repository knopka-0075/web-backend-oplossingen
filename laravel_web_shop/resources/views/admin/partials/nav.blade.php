


<ul class="nav nav-pills nav-stacked" id="menu">
    <!-- <li {{ (Request::is('admin/dashboard') ? ' class=active' : '') }}>
        <a href="{{URL::to('admin/dashboard')}}"
                >
            <i class="fa fa-dashboard fa-fw"></i><span class="hidden-sm text">Dashboard</span>
        </a>
    </li> -->

    <li {{ (Request::is('admin/articles') ? ' class=active' : '') }}>
        <a href="{{URL::to('admin/articles')}}">
            <i class="fa fa-pencil-square-o"></i><span class="hidden-sm text"> Products</span>
        </a>
    </li>
    
</ul>
