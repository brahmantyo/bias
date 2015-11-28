<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <style type="text/css">
            .sidebar-menu li:hover {
                cursor: pointer;
            }
        </style>
        <!--
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

           
            <li class="treeview">
                <a><i class="fa fa-plus-square-o"></i>Administor Tools</a>
                <ul class="treeview-menu">
                    <li><a href="/user" id="user-manager"><i class="fa fa-user-secret"></i><span>User Manager</span></a></li>
                    <li><a href="#" id="user-manager"><i class="fa fa-user-secret"></i><span>Site Status</span></a></li>
                    <li><a href="#" id="user-manager"><i class="fa fa-user-secret"></i><span>Configuration</span></a></li>
                </ul>
            </li>
            
            <li class="treeview">
                <a><i class="fa fa-plus-square-o"></i><span>Master</span></a>
                <ul class="treeview-menu">
                    <li><a href="/cabang"><i class="fa fa-share-alt"></i>Cabang</a></li>
                    <li><a href="/pegawai"><i class="fa fa-user"></i>Pegawai</a></li>                
                    <li><a href="/konsumen"><i class="fa fa-users"></i>Konsumen</a></li>
                    <li><a href="/armada"><i class="fa fa-truck"></i>Armada</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a>
                    <i class="fa fa-plus-square-o"><span></i>Transaksi</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/resi" id="menu-resi"><i class="fa fa-print"></i>Pengiriman</a></li>
                    <li><a href="/admin/keberangkatan" id="menu-keberangkatan"><i class="fa fa-print"></i>SJ. Trucking</a></li>
                    <li><a href="/quotation" id="menu-orders"><i class="fa fa-calculator"></i>Pre-Order Web</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a><i class="fa fa-plus-square-o"></i><span>Keuangan</span></a>
                <ul class="treeview-menu">
                    <li><a href="/admin/penagihan" id="menu-penagihan"><i class="fa fa-credit-card"></i>Penagihan/Piutang</a></li>
                    <li><a href="/admin/operasional" id="menu-operasional"><i class="fa fa-money"></i>Biaya Operasional</a></li>
<!--                    <li><a href="/admin/piutang" id="menu-operasional"><i class="fa fa-money"></i>Piutang</a></li>-->
<!--                     <li><a href="/mutasi" id="menu-mutasi"><i class="fa fa-calculator"></i>Mutasi</a></li> -->
<!--                     <li><a href="/pendapatan" id="menu-pendapatan"><i class="fa fa-money"></i>Pendapatan</a></li> -->

<!--                     <li><a href="/sjt" id="menu-stj"><i class="fa fa-file-text-o"></i>Surat Jalan Truck</a></li> -->

<!--                </ul>
            </li>
            
            <li class="treeview">
                <a href="/article" id="article">
                    <i class="fa fa-pencil-square-o"></i><span>Article</span>
                </a>
            </li>
            <li class="treeview"><a href="/profil" id=""><i class="fa "></i><span>Profil</span></a></li>
            <li class="treeview">
                <a>
                    <i class="fa fa-pencil-square-o"></i>
                    <span>Transaksi</span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview"><a href="/order" id=""><i class="fa "></i><span>Pre-Order/Permintaan Kirim</span></a></li>
                    <li class="treeview"><a href="/resi" id=""><i class="fa "></i><span>Daftar Pengiriman</span></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a>
                    <i class="fa fa-pencil-square-o"></i>
                    <span>Test</span>
                </a>
            </li>
        </ul>
-->
        <ul class="sidebar-menu">
            @include(config('laravel-menu.views.bootstrap-items'), ['class'=>'sidebar-menu','items' =>\Config::get('menu')->roots()])
        </ul>

    </section>
    <!-- /.sidebar -->
</aside>