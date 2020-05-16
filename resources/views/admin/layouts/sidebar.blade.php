<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a></li>
        @hasrole('Customer')
            <li><a href="{{ route('customer.survey') }}"><i class="fa fa-edit"></i> Survey</a></li>
        @endhasrole
        @hasrole('Vendor')
            <li><a href="{{ route('vendor.setup') }}"><i class="fa fa-gear"></i> Konfigurasi Usaha</a></li>
            <li><a href="{{ url('vendor/quotation') }}"><i class="fa fa-file"></i> Penawaran</a></li>
        @endhasrole
        @hasrole('Admin')
            <li><a href="{{ url('admin/user') }}"><i class="fa fa-users"></i> Users</a></li>
        @endhasrole
        <li><a><i class="fa fa-laptop"></i> Example <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
            <li><a href="index.html">Dashboard</a></li>
            <li><a href="index2.html">Dashboard2</a></li>
            <li><a href="index3.html">Dashboard3</a></li>
            </ul>
        </li>                
        </ul>
    </div>
</div>