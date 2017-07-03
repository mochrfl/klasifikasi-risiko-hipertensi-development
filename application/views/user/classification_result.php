<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Klasifikasi Risiko Hipertensi</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url('assets/'); ?>plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- JQuery DataTable Css -->
    <link href="<?php echo base_url('assets/'); ?>plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url('assets/'); ?>plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url('assets/'); ?>plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="<?php echo base_url('assets/'); ?>plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url('assets/'); ?>css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo base_url('assets/'); ?>css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">Klasifikasi Risiko Hipertensi</a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mochamad Rafli Andriansyah</div>
                    <div class="email">mochraflia@gmail.com</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="index.html">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="pages/typography.html">
                            <i class="material-icons">text_fields</i>
                            <span>Menu 2</span>
                        </a>
                    </li>
                    <li>
                        <a href="pages/helper-classes.html">
                            <i class="material-icons">layers</i>
                            <span>Menu 3</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Menu 4</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Cards</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="pages/widgets/cards/basic.html">Basic</a>
                                    </li>
                                    <li>
                                        <a href="pages/widgets/cards/colored.html">Colored</a>
                                    </li>
                                    <li>
                                        <a href="pages/widgets/cards/no-header.html">No Header</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Infobox</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="pages/widgets/infobox/infobox-1.html">Infobox-1</a>
                                    </li>
                                    <li>
                                        <a href="pages/widgets/infobox/infobox-2.html">Infobox-2</a>
                                    </li>
                                    <li>
                                        <a href="pages/widgets/infobox/infobox-3.html">Infobox-3</a>
                                    </li>
                                    <li>
                                        <a href="pages/widgets/infobox/infobox-4.html">Infobox-4</a>
                                    </li>
                                    <li>
                                        <a href="pages/widgets/infobox/infobox-5.html">Infobox-5</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">swap_calls</i>
                            <span>Menu 5</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/ui/alerts.html">Alerts</a>
                            </li>
                            <li>
                                <a href="pages/ui/animations.html">Animations</a>
                            </li>
                            <li>
                                <a href="pages/ui/badges.html">Badges</a>
                            </li>

                            <li>
                                <a href="pages/ui/breadcrumbs.html">Breadcrumbs</a>
                            </li>
                                <a href="pages/ui/buttons.html">Buttons</a>
                            </li>
                            <li>
                                <a href="pages/ui/collapse.html">Collapse</a>
                            </li>
                            <li>
                                <a href="pages/ui/colors.html">Colors</a>
                            </li>
                            <li>
                                <a href="pages/ui/dialogs.html">Dialogs</a>
                            </li>
                            <li>
                            <li>
                                <a href="pages/ui/icons.html">Icons</a>
                            </li>
                            <li>
                                <a href="pages/ui/labels.html">Labels</a>
                            </li>
                            <li>
                                <a href="pages/ui/list-group.html">List Group</a>
                            </li>
                            <li>
                                <a href="pages/ui/media-object.html">Media Object</a>
                            </li>
                            <li>
                                <a href="pages/ui/modals.html">Modals</a>
                            </li>
                            <li>
                                <a href="pages/ui/notifications.html">Notifications</a>
                            </li>
                            <li>
                                <a href="pages/ui/pagination.html">Pagination</a>
                            </li>
                            <li>
                                <a href="pages/ui/preloaders.html">Preloaders</a>
                            </li>
                            <li>
                                <a href="pages/ui/progressbars.html">Progress Bars</a>
                            </li>
                            <li>
                                <a href="pages/ui/range-sliders.html">Range Sliders</a>
                            </li>
                            <li>
                                <a href="pages/ui/sortable-nestable.html">Sortable & Nestable</a>
                            </li>
                            <li>
                                <a href="pages/ui/tabs.html">Tabs</a>
                            </li>
                            <li>
                                <a href="pages/ui/thumbnails.html">Thumbnails</a>
                            </li>
                            <li>
                                <a href="pages/ui/tooltips-popovers.html">Tooltips & Popovers</a>
                            </li>
                            <li>
                                <a href="pages/ui/waves.html">Waves</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2017 <a href="javascript:void(0);">Klasifikasi Risiko Hipertensi</a>.
                </div>
                <div class="version">
                    <b>Version: </b> Beta
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Kromosom Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                KROMOSOM AWAL
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>a1</th>
                                      <th>a2</th>
                                      <th>b1</th>
                                      <th>b2</th>
                                      <th>c1</th>
                                      <th>c2</th>
                                      <th>e1</th>
                                      <th>e2</th>
                                      <th>e3</th>
                                      <th>e4</th>
                                  </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                      <th>No</th>
                                      <th>a1</th>
                                      <th>a2</th>
                                      <th>b1</th>
                                      <th>b2</th>
                                      <th>c1</th>
                                      <th>c2</th>
                                      <th>e1</th>
                                      <th>e2</th>
                                      <th>e3</th>
                                      <th>e4</th>
                                    </tr>
                                </tfoot>
                                <tbody>

                                  <?php

                                    for($a=0;$a<count($kromosom);$a++) {
                                     echo '<tr>';
                                       echo '<td>'.$a.'</td>';
                                     for ($aa=0; $aa < count(current($kromosom)); $aa++) {
                                       echo '<td>'.$kromosom[$a][$aa].'</td>';
                                     }
                                     echo '</tr>';
                                    }

                                  ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Kromosom Table -->


            <!-- Offspring crossover Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                OFFSPRING CROSSOVER
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>a1</th>
                                      <th>a2</th>
                                      <th>b1</th>
                                      <th>b2</th>
                                      <th>c1</th>
                                      <th>c2</th>
                                      <th>e1</th>
                                      <th>e2</th>
                                      <th>e3</th>
                                      <th>e4</th>
                                  </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                      <th>No</th>
                                      <th>a1</th>
                                      <th>a2</th>
                                      <th>b1</th>
                                      <th>b2</th>
                                      <th>c1</th>
                                      <th>c2</th>
                                      <th>e1</th>
                                      <th>e2</th>
                                      <th>e3</th>
                                      <th>e4</th>
                                    </tr>
                                </tfoot>
                                <tbody>

                                  <?php

                                    for($a=0;$a<count($offspring_c);$a++) {
                                     echo '<tr>';
                                      echo '<td>'.$a.'</td>';
                                     for ($aa=0; $aa < count(current($offspring_c)); $aa++) {
                                       echo '<td>'.$offspring_c[$a][$aa].'</td>';
                                     }
                                     echo '</tr>';
                                    }

                                  ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Offspring crossover Table -->

            <!-- Offspring Mutation Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                OFFSPRING MUTATION
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>a1</th>
                                      <th>a2</th>
                                      <th>b1</th>
                                      <th>b2</th>
                                      <th>c1</th>
                                      <th>c2</th>
                                      <th>e1</th>
                                      <th>e2</th>
                                      <th>e3</th>
                                      <th>e4</th>
                                  </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                      <th>No</th>
                                      <th>a1</th>
                                      <th>a2</th>
                                      <th>b1</th>
                                      <th>b2</th>
                                      <th>c1</th>
                                      <th>c2</th>
                                      <th>e1</th>
                                      <th>e2</th>
                                      <th>e3</th>
                                      <th>e4</th>
                                    </tr>
                                </tfoot>
                                <tbody>

                                  <?php

                                    for($a=0;$a<count($offspring_m);$a++) {
                                     echo '<tr>';
                                      echo '<td>'.$a.'</td>';
                                     for ($aa=0; $aa < count(current($offspring_m)); $aa++) {
                                       echo '<td>'.$offspring_m[$a][$aa].'</td>';
                                     }
                                     echo '</tr>';
                                    }

                                  ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Offspring mutation Table -->

            <!-- Offspring Mutation Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                KROMOSOM BARU
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>a1</th>
                                      <th>a2</th>
                                      <th>b1</th>
                                      <th>b2</th>
                                      <th>c1</th>
                                      <th>c2</th>
                                      <th>e1</th>
                                      <th>e2</th>
                                      <th>e3</th>
                                      <th>e4</th>
                                  </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                      <th>No</th>
                                      <th>a1</th>
                                      <th>a2</th>
                                      <th>b1</th>
                                      <th>b2</th>
                                      <th>c1</th>
                                      <th>c2</th>
                                      <th>e1</th>
                                      <th>e2</th>
                                      <th>e3</th>
                                      <th>e4</th>
                                    </tr>
                                </tfoot>
                                <tbody>

                                  <?php

                                    for($a=0;$a<count($kromosom_baru);$a++) {
                                     echo '<tr>';
                                      echo '<td>'.$a.'</td>';
                                     for ($aa=0; $aa < count(current($kromosom_baru)); $aa++) {
                                       echo '<td>'.$kromosom_baru[$a][$aa].'</td>';
                                     }
                                     echo '</tr>';
                                    }

                                  ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Offspring mutation Table -->

            <!-- Membership function umur dan sex-->
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                                MEMBERSHIP FUNCTION UMUR
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Umur</th>
                                      <th>MD Muda</th>
                                      <th>MD Tua</th>
                                      <th>Risiko</th>
                                  </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                      <th>No</th>
                                      <th>Umur</th>
                                      <th>MD Muda</th>
                                      <th>MD Tua</th>
                                      <th>Risiko</th>
                                    </tr>
                                </tfoot>
                                <tbody>

                                  <?php

                                    for($a=0;$a<count(current($membership_degree['umur']));$a++) {
                                     echo '<tr>';
                                      echo '<td>'.($a+1).'</td>';
                                      echo '<td>'.$data_training[$a][0].'</td>';
                                      echo '<td>'.$membership_degree['umur']['muda'][$a].'</td>';
                                      echo '<td>'.$membership_degree['umur']['tua'][$a].'</td>';
                                      echo '<td>'.$data_training[$a][12].'</td>';
                                     echo '</tr>';

                                    }


                                  ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                                MEMBERSHIP FUNCTION SEX
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Sex</th>
                                      <th>MD Laki</th>
                                      <th>MD Wanita</th>
                                      <th>Risiko</th>
                                  </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                      <th>No</th>
                                      <th>Sex</th>
                                      <th>MD Laki</th>
                                      <th>MD Wanita</th>
                                      <th>Risiko</th>
                                    </tr>
                                </tfoot>
                                <tbody>

                                  <?php

                                    for($a=0;$a<count(current($membership_degree['sex']));$a++) {
                                     echo '<tr>';
                                      echo '<td>'.($a+1).'</td>';
                                      echo '<td>'.$data_training[$a][1].'</td>';
                                      echo '<td>'.$membership_degree['sex']['lk'][$a].'</td>';
                                      echo '<td>'.$membership_degree['sex']['pr'][$a].'</td>';
                                      echo '<td>'.$data_training[$a][12].'</td>';
                                     echo '</tr>';
                                    }

                                  ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                                MEMBERSHIP FUNCTION TEKANAN DARAH SISTOL
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>TD Sistol</th>
                                      <th>MD Normal</th>
                                      <th>MD Pra Hipertensi</th>
                                      <th>MD Hipertensi</th>
                                  </tr>
                                </thead>
                                <tfoot>
                                  <tr>
                                      <th>No</th>
                                      <th>TD Sistol</th>
                                      <th>MD Normal</th>
                                      <th>MD Pra Hipertensi</th>
                                      <th>MD Hipertensi</th>
                                  </tr>
                                </tfoot>
                                <tbody>

                                  <?php

                                    for($a=0;$a<count(current($membership_degree['td_sistol']));$a++) {
                                     echo '<tr>';
                                      echo '<td>'.($a+1).'</td>';
                                      echo '<td>'.$data_training[$a][2].'</td>';
                                      echo '<td>'.$membership_degree['td_sistol']['normal'][$a].'</td>';
                                      echo '<td>'.$membership_degree['td_sistol']['prahipertensi'][$a].'</td>';
                                      echo '<td>'.$membership_degree['td_sistol']['hipertensi'][$a].'</td>';
                                     echo '</tr>';
                                    }

                                  ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                                MEMBERSHIP FUNCTION TEKANAN DARAH DIASTOL
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>TD Diastol</th>
                                      <th>MD Normal</th>
                                      <th>MD Pra Hipertensi</th>
                                      <th>MD Hipertensi</th>
                                      <th>Risiko</th>
                                  </tr>
                                </thead>
                                <tfoot>
                                  <tr>
                                      <th>No</th>
                                      <th>TD Diastol</th>
                                      <th>MD Normal</th>
                                      <th>MD Pra Hipertensi</th>
                                      <th>MD Hipertensi</th>
                                      <th>Risiko</th>
                                  </tr>
                                </tfoot>
                                <tbody>

                                  <?php

                                    for($a=0;$a<count(current($membership_degree['td_diastol']));$a++) {
                                     echo '<tr>';
                                      echo '<td>'.($a+1).'</td>';
                                      echo '<td>'.$data_training[$a][3].'</td>';
                                      echo '<td>'.$membership_degree['td_diastol']['normal'][$a].'</td>';
                                      echo '<td>'.$membership_degree['td_diastol']['prahipertensi'][$a].'</td>';
                                      echo '<td>'.$membership_degree['td_diastol']['hipertensi'][$a].'</td>';
                                      echo '<td>'.$data_training[$a][12].'</td>';
                                     echo '</tr>';
                                    }

                                  ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                                MEMBERSHIP FUNCTION LINGKAR PERUT
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>L. Perut</th>
                                      <th>MD Kecil</th>
                                      <th>MD Besar</th>
                                      <th>Risiko</th>
                                  </tr>
                                </thead>
                                <tfoot>
                                  <tr>
                                    <th>No</th>
                                    <th>L. Perut</th>
                                    <th>MD Kecil</th>
                                    <th>MD Besar</th>
                                  </tr>
                                </tfoot>
                                <tbody>

                                  <?php

                                    for($a=0;$a<count(current($membership_degree['lingkar_perut']));$a++) {
                                     echo '<tr>';
                                      echo '<td>'.($a+1).'</td>';
                                      echo '<td>'.$data_training[$a][4].'</td>';
                                      echo '<td>'.$membership_degree['lingkar_perut']['kecil'][$a].'</td>';
                                      echo '<td>'.$membership_degree['lingkar_perut']['besar'][$a].'</td>';
                                     echo '</tr>';
                                    }

                                  ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                                MEMBERSHIP FUNCTION BERAT MASSA INDEKS
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>BMI</th>
                                      <th>MD Normal</th>
                                      <th>MD Overweight</th>
                                  </tr>
                                </thead>
                                <tfoot>
                                  <tr>
                                    <th>No</th>
                                    <th>BMI</th>
                                    <th>MD Normal</th>
                                    <th>MD Overweight</th>
                                  </tr>
                                </tfoot>
                                <tbody>

                                  <?php

                                    for($a=0;$a<count(current($membership_degree['bmi']));$a++) {
                                     echo '<tr>';
                                      echo '<td>'.($a+1).'</td>';
                                      echo '<td>'.$data_training[$a][5].'</td>';
                                      echo '<td>'.$membership_degree['bmi']['normal'][$a].'</td>';
                                      echo '<td>'.$membership_degree['bmi']['ow'][$a].'</td>';
                                     echo '</tr>';
                                    }

                                  ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                                MEMBERSHIP FUNCTION MEROKOK
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Merokok</th>
                                      <th>MD Ya</th>
                                      <th>MD Tidak</th>
                                  </tr>
                                </thead>
                                <tfoot>
                                  <tr>
                                    <th>No</th>
                                    <th>Merokok</th>
                                    <th>MD Ya</th>
                                    <th>MD Tidak</th>
                                  </tr>
                                </tfoot>
                                <tbody>

                                  <?php

                                    for($a=0;$a<count(current($membership_degree['merokok']));$a++) {
                                     echo '<tr>';
                                      echo '<td>'.($a+1).'</td>';
                                      echo '<td>'.$data_training[$a][6].'</td>';
                                      echo '<td>'.$membership_degree['merokok']['ya'][$a].'</td>';
                                      echo '<td>'.$membership_degree['merokok']['tdk'][$a].'</td>';
                                     echo '</tr>';
                                    }

                                  ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                                MEMBERSHIP FUNCTION MAKANAN BERLEMAK
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Makanan Berlemak</th>
                                      <th>MD Jarang</th>
                                      <th>MD Sering</th>
                                  </tr>
                                </thead>
                                <tfoot>
                                  <tr>
                                    <th>No</th>
                                    <th>Makanan Berlemak</th>
                                    <th>MD Jarang</th>
                                    <th>MD Sering</th>
                                  </tr>
                                </tfoot>
                                <tbody>

                                  <?php

                                    for($a=0;$a<count(current($membership_degree['makanan_berlemak']));$a++) {
                                     echo '<tr>';
                                      echo '<td>'.($a+1).'</td>';
                                      echo '<td>'.$data_training[$a][7].'</td>';
                                      echo '<td>'.$membership_degree['makanan_berlemak']['jarang'][$a].'</td>';
                                      echo '<td>'.$membership_degree['makanan_berlemak']['sering'][$a].'</td>';
                                     echo '</tr>';
                                    }

                                  ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                                MEMBERSHIP FUNCTION KONSUMSI GULA
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Konsumsi Gula</th>
                                      <th>MD <=4sdm</th>
                                      <th>MD >4sdm</th>
                                  </tr>
                                </thead>
                                <tfoot>
                                  <tr>
                                    <th>No</th>
                                    <th>Konsumsi Gula</th>
                                    <th>MD <=4sdm</th>
                                    <th>MD >4sdm</th>
                                  </tr>
                                </tfoot>
                                <tbody>

                                  <?php

                                    for($a=0;$a<count(current($membership_degree['k_gula']));$a++) {
                                     echo '<tr>';
                                      echo '<td>'.($a+1).'</td>';
                                      echo '<td>'.$data_training[$a][8].'</td>';
                                      echo '<td>'.$membership_degree['k_gula']['>4sdm'][$a].'</td>';
                                      echo '<td>'.$membership_degree['k_gula']['<=4sdm'][$a].'</td>';
                                     echo '</tr>';
                                    }

                                  ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                                MEMBERSHIP FUNCTION KONSUMSI GARAM
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Konsumsi Garam</th>
                                      <th>MD <=1sdt</th>
                                      <th>MD >1sdt</th>
                                  </tr>
                                </thead>
                                <tfoot>
                                  <tr>
                                    <th>No</th>
                                    <th>Konsumsi Garam</th>
                                    <th>MD <=1sdt</th>
                                    <th>MD >1sdt</th>
                                  </tr>
                                </tfoot>
                                <tbody>

                                  <?php

                                    for($a=0;$a<count(current($membership_degree['k_garam']));$a++) {
                                     echo '<tr>';
                                      echo '<td>'.($a+1).'</td>';
                                      echo '<td>'.$data_training[$a][9].'</td>';
                                      echo '<td>'.$membership_degree['k_garam']['>1sdt'][$a].'</td>';
                                      echo '<td>'.$membership_degree['k_garam']['<=1sdt'][$a].'</td>';
                                     echo '</tr>';
                                    }

                                  ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                                MEMBERSHIP FUNCTION OLAHRAGA
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Olahraga</th>
                                      <th>MD Ya</th>
                                      <th>MD Tidak</th>
                                  </tr>
                                </thead>
                                <tfoot>
                                  <tr>
                                    <th>No</th>
                                    <th>Olahraga</th>
                                    <th>MD Ya</th>
                                    <th>MD Tidak</th>
                                  </tr>
                                </tfoot>
                                <tbody>

                                  <?php

                                    for($a=0;$a<count(current($membership_degree['olahraga']));$a++) {
                                     echo '<tr>';
                                      echo '<td>'.($a+1).'</td>';
                                      echo '<td>'.$data_training[$a][10].'</td>';
                                      echo '<td>'.$membership_degree['olahraga']['ya'][$a].'</td>';
                                      echo '<td>'.$membership_degree['olahraga']['tdk'][$a].'</td>';
                                     echo '</tr>';
                                    }

                                  ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



            </div>
            <!-- #END# Membership Degree Umur dan Sex-->

        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="<?php echo base_url('assets/'); ?>plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo base_url('assets/'); ?>plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url('assets/'); ?>plugins/node-waves/waves.js"></script>



    <!-- Flot Charts Plugin Js -->
    <script src="<?php echo base_url('assets/'); ?>plugins/flot-charts/jquery.flot.js"></script>
    <script src="<?php echo base_url('assets/'); ?>plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="<?php echo base_url('assets/'); ?>plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url('assets/'); ?>plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="<?php echo base_url('assets/'); ?>plugins/flot-charts/jquery.flot.time.js"></script>


    <!-- Demo Js -->
    <script src="<?php echo base_url('assets/'); ?>js/demo.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="<?php echo base_url('assets/'); ?>plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?php echo base_url('assets/'); ?>plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url('assets/'); ?>plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="<?php echo base_url('assets/'); ?>plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url('assets/'); ?>js/admin.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/pages/tables/jquery-datatable.js"></script>
</body>

</html>
