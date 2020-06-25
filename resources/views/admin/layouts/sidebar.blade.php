<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ url('transaction') }}"><i class="fa fa-money"></i> Transaksi</a></li>
        @hasrole('Customer')
            <li><a href="{{ route('customer.survey') }}"><i class="fa fa-edit"></i> Survey</a></li>
            <li><a href="{{ route('customer.chat.index') }}"><i class="fa fa-envelope"></i> Chat</a></li>
        @endhasrole
        @hasrole('Vendor')
        <li><a><i class="fa fa-users"></i> Customer Related <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{ url('vendor/quotation') }}">Penawaran</a></li>
                <li><a href="{{ route('vendor.chat.index') }}">Chat</a></li>
            </ul>
        </li>
            <li><a href="{{ url('vendor/promotion') }}"><i class="fa fa-newspaper-o"></i> Promosi</a></li>
            <li><a href="{{ route('vendor.setup') }}">Konfigurasi Usaha</a></li>

        @endhasrole
        @hasrole('Admin')
            <li><a><i class="fa fa-check-square-o"></i> Validasi <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                <li><a href="{{ url('admin/payment/validation') }}">Pembayaran</a></li>
                <li><a href="{{ url('admin/vendor/validation') }}">Vendor</a></li>
                <li><a href="{{ route('admin.promotion') }}">Posting Promosi</a></li>
                </ul>
            </li>   
            <li><a href="{{ url('admin/banner') }}"><i class="fa fa-image"></i> Banner Image</a></li>
            <li><a href="{{ url('admin/user') }}"><i class="fa fa-users"></i> Users</a></li>
            <li><a><i class="fa fa-file-o"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                <li><a href="{{ route('admin.laporan.user') }}">Customer</a></li>
                <li><a href="{{ route('admin.laporan.vendor') }}">Vendor</a></li>
                <li><a href="{{ route('admin.laporan.item-acara') }}">Item Acara</a></li>
                </ul>
            </li>  
        @endhasrole

                     
        </ul>
    </div>
</div>