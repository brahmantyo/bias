<?php 
    //$user = Auth::user();
?>
<header class="main-header">
    <!-- Logo -->
    <?php
        $home = '/admin';

    ?>
    <a href="{{ $home }}" class="logo hidden-xs">
        <h3>{{\Config::get('companytitle')}}</h3>
        <h6>{{\Config::get('appname')}}</h6>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="{{$home}}" class="hidden-sm hidden-md hidden-lg col-xs-12 label label-warning">{{\Config::get('companytitle')}} - {{\Config::get('appname')}}</a>
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li><a href="/"><i class="fa fa-home"></i> Halaman Depan</a></li>
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-success"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Ada <b></b> pemberitahuan</li>
                        <li>
                            <ul class="menu">
                            
                            </ul>
                        </li>
<!--                       <li class="footer"><a href="#">See All Messages</a></li> -->
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li><a href="/auth/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
            </ul>
        </div>
    </nav>
</header>


<!--                  <li class="dropdown user user-menu">
                    <a href="#" id="user-profile" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="" class="user-image" alt="User Image"/>
                    <span class="hidden-xs"></span>
                    </a>
                    <ul class="dropdown-menu">
                         User image 
                        <li class="user-header">
                            <img src="" class="img-circle" alt="User Image" />
                            <p>
                            
                            <small>Member since </small>
                            </p>
                        </li>
                         Menu Body 
                         <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li>
                         Menu Footer
                         <li class="user-footer">
                            <div class="pull-left">
                                <a href="" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="/auth/logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li> -->