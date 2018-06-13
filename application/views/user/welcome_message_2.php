<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome To | Bootstrap Based Admin Template - Material Design</title>
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
                <a class="navbar-brand" href="index.html">KLASIFIKASI RISIKO HIPERTENSI</a>
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
                        <a href="user/list_data.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="user/list_data.php">
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
                                    <span>Menu 5</span>
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
                            <span>Menu 6</span>
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
                            <li>
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
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Menu 7</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/forms/basic-form-elements.html">Basic Form Elements</a>
                            </li>
                            <li>
                                <a href="pages/forms/advanced-form-elements.html">Advanced Form Elements</a>
                            </li>
                            <li>
                                <a href="pages/forms/form-examples.html">Form Examples</a>
                            </li>
                            <li>
                                <a href="pages/forms/form-validation.html">Form Validation</a>
                            </li>
                            <li>
                                <a href="pages/forms/form-wizard.html">Form Wizard</a>
                            </li>
                            <li>
                                <a href="pages/forms/editors.html">Editors</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Menu 8</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/tables/normal-tables.html">Normal Tables</a>
                            </li>
                            <li>
                                <a href="pages/tables/jquery-datatable.html">Jquery Datatables</a>
                            </li>
                            <li>
                                <a href="pages/tables/editable-table.html">Editable Tables</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">perm_media</i>
                            <span>Menu 9</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/medias/image-gallery.html">Image Gallery</a>
                            </li>
                            <li>
                                <a href="pages/medias/carousel.html">Carousel</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">pie_chart</i>
                            <span>Menu 10</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/charts/morris.html">Morris</a>
                            </li>
                            <li>
                                <a href="pages/charts/flot.html">Flot</a>
                            </li>
                            <li>
                                <a href="pages/charts/chartjs.html">ChartJS</a>
                            </li>
                            <li>
                                <a href="pages/charts/sparkline.html">Sparkline</a>
                            </li>
                            <li>
                                <a href="pages/charts/jquery-knob.html">Jquery Knob</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">content_copy</i>
                            <span>Menu 11</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/examples/sign-in.html">Sign In</a>
                            </li>
                            <li>
                                <a href="pages/examples/sign-up.html">Sign Up</a>
                            </li>
                            <li>
                                <a href="pages/examples/forgot-password.html">Forgot Password</a>
                            </li>
                            <li>
                                <a href="pages/examples/blank.html">Blank Page</a>
                            </li>
                            <li>
                                <a href="pages/examples/404.html">404 - Not Found</a>
                            </li>
                            <li>
                                <a href="pages/examples/500.html">500 - Server Error</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">map</i>
                            <span>Menu 12</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/maps/google.html">Google Map</a>
                            </li>
                            <li>
                                <a href="pages/maps/yandex.html">YandexMap</a>
                            </li>
                            <li>
                                <a href="pages/maps/jvectormap.html">jVectorMap</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">trending_down</i>
                            <span>Menu13</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Menu Item</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Menu Item - 2</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Level - 2</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <span>Menu Item</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="menu-toggle">
                                            <span>Level - 3</span>
                                        </a>
                                        <ul class="ml-menu">
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <span>Level - 4</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="pages/changelogs.html">
                            <i class="material-icons">update</i>
                            <span>Changelogs</span>
                        </a>
                    </li>
                    <li class="header">LABELS</li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-red">donut_large</i>
                            <span>Important</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-amber">donut_large</i>
                            <span>Warning</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-light-blue">donut_large</i>
                            <span>Information</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2016 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.4
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

            <div class="container">
            	<div class="bs-docs-section">
            		<div class="row">
            			<div class="col-lg-12">
            				<div class="page-header">
            					<h1 id="tree">Tree</h1>
            				</div>

            				<div class="bs-component">
            					<?= $tree ?>
            				</div>
            				<div class="bs-component">
            					<code><?= $array_tree ?></code>
            				</div>

            				<input value="SAVE TO DB" class="btn btn-primary">
            			</div>
            		</div>
            	</div>
            	<div class="bs-docs-section">
            		<div class="row">
            			<div class="col-lg-12">
            				<div class="page-header">
            					<h1 id="tree">Hasil Pengujian</h1>
            				</div>

            				<div class="bs-component">
            					<table class="table table-hover">
            						<thead>
            						<tr>
            							<th scope="col">No</th>
                          <th scope="col">Kelas Aktual</th>
                          <th scope="col">Kelas hasil klasifikasi</th>
            						</tr>
            						</thead>
            						<tbody>
                        <?php
                          for ($i=0; $i < count($pengujian[0]); $i++) {
                            echo "<tr>";
                            echo '<th scope="col">'.($i+1).'</th>';
                            echo '<th scope="col">'.$pengujian[0][$i].'</th>';
                            echo '<th scope="col">'.$pengujian[1][$i].'</th>';
                            echo "</tr>";
                          }
                        ?>
            						<!-- <?php foreach ($pengujian as $key => $datum) { ?>
            							<tr>
            								<th scope="col"><?= $key + 1 ?></th>
            								<?php foreach ($datum as $item) { ?>
            									<th scope="col"><?= $item ?></th>
            								<?php } ?>
            							</tr>
            						<?php } ?> -->
            						</tbody>
            					</table>
            				</div>
            			</div>
            		</div>
            	</div>

              <div class="bs-docs-section">
            		<div class="row">
            			<div class="col-lg-12">
            				<div class="page-header">
            					<h1 id="tree">Akurasi: <?php echo $pengujian[2]. ' %' ?></h1>
            				</div>
            			</div>
            		</div>
            	</div>
            </div>
            <hr>

            <?php foreach ($data_fuzzys as $fuzzy) { ?>
            	<div class="container" id="<?= $fuzzy->prependName() ?>">

            		<h1><?= $fuzzy->name ?></h1>

            		<div class="bs-docs-section">
            			<div class="row">
            				<div class="col-lg-12">
            					<div class="page-header">
            						<h3 id="tables">Data</h3>
            					</div>

            					<div class="bs-component">
            						<table class="table table-hover">
            							<thead>
            							<tr>
            								<?php foreach (end($fuzzy->data) as $key => $item) { ?>
            									<th scope="col"><?= $key ?></th>
            								<?php } ?>
            							</tr>
            							</thead>
            							<tbody>
            							<?php foreach ($fuzzy->data as $datum) { ?>
            								<tr>
            									<?php foreach ($datum as $key => $item) { ?>
            										<th scope="col"><?= $item ?></th>
            									<?php } ?>
            								</tr>
            							<?php } ?>
            							</tbody>
            						</table>
            					</div>
            				</div>
            			</div>
            		</div>

            		<div class="bs-docs-section">
            			<div class="row">
            				<div class="col-lg-12">
            					<div class="page-header">
            						<h3 id="tables">Rules</h3>
            					</div>

            					<div class="bs-component">
            						<table class="table table-hover">
            							<tbody>
            							<?php foreach ($fuzzy->rules as $item) { ?>
            								<tr>
            									<th scope="col" rowspan="2"><?= $item["name"] ?></th>
            									<?php foreach ($item["types"] as $val) { ?>
            										<th scope="col"><?= $val ?></th>
            									<?php } ?>
            								</tr>
            								<tr>
            									<?php foreach ($item["threshold"] as $val) { ?>
            										<th scope="col"><?= $val ?></th>
            									<?php } ?>
            								</tr>
            							<?php } ?>
            							</tbody>
            						</table>
            					</div>
            				</div>
            			</div>
            		</div>

            		<?php if (!$fuzzy->result) { ?>
            			<div class="bs-docs-section">
            				<div class="row">
            					<div class="col-lg-12">
            						<div class="page-header">
            							<h3 id="tables">Fuzzy</h3>
            						</div>

            						<div class="">
            							<?php foreach ($fuzzy->rules as $a => $rule) { ?>
            								<div class="bs-component" style="padding: 20px">
            									<table class="table table-hover">
            										<thead>
            										<tr>
            											<th colspan="<?= count($rule["types"]) ?>"><?= $rule["name"] ?></th>
            										</tr>
            										<tr>
            											<?php foreach ($rule["types"] as $item) { ?>
            												<th scope="col"><?= $item ?></th>
            											<?php } ?>
            										</tr>
            										</thead>
            										<tbody>
            										<?php foreach ($fuzzy->fuzzification[$rule["name"]] as $datum) { ?>
            											<tr>
            												<?php foreach ($datum as $key => $item) { ?>
            													<th scope="col"><?= $item ?></th>
            												<?php } ?>
            											</tr>
            										<?php } ?>
            										</tbody>
            									</table>
            								</div>
            							<?php } ?>
            						</div>
            					</div>
            				</div>
            			</div>

            			<div class="bs-docs-section">
            				<div class="row">
            					<div class="col-lg-12">
            						<div class="page-header">
            							<h3 id="tables">Sum Fuzzy</h3>
            						</div>

            						<div class="">
            							<?php foreach ($fuzzy->sum as $a => $perrule) { ?>
            								<div class="bs-component" style="padding: 20px">
            									<table class="table table-hover">
            										<thead>
            										<tr>
            											<th colspan="5"><?= $fuzzy->rules[$a]["name"] ?></th>
            										</tr>
            										<tr>
            											<th></th>
            											<th>all</th>
            											<th>rendah</th>
            											<th>sedang</th>
            											<th>tinggi</th>
            										</tr>
            										</thead>
            										<tbody>
            										<?php foreach ($perrule as $key => $datum) { ?>
            											<tr>
            												<th scope="col"><?= $fuzzy->rules[$a]["types"][$key] ?></th>
            												<?php foreach ($datum as $item) { ?>
            													<th scope="col"><?= $item ?></th>
            												<?php } ?>
            											</tr>
            										<?php } ?>
            										</tbody>
            									</table>
            								</div>
            							<?php } ?>
            						</div>
            					</div>
            				</div>
            			</div>

            			<div class="bs-docs-section">
            				<div class="row">
            					<div class="col-lg-12">
            						<div class="page-header">
            							<h3 id="tables">Entrophy</h3>
            						</div>

            						<div class="bs-component">
            							<table class="table table-hover">
            								<tbody>
            								<?php foreach ($fuzzy->entrophy as $a => $item) { ?>
            									<tr>
            										<th><?= $fuzzy->rules[$a]["name"] ?></th>
            										<?php foreach ($item as $key => $val) { ?>
            											<th scope="col"><?= $fuzzy->rules[$a]["types"][$key] ?></th>
            											<th scope="col"><?= $val ?></th>
            										<?php } ?>
            									</tr>
            								<?php } ?>
            								<tr>
            									<th>Total</th>
            									<th colspan="6"><?= $fuzzy->globalEntrophy ?></th>
            								</tr>
            								</tbody>
            							</table>
            						</div>
            					</div>
            				</div>
            			</div>

            			<div class="bs-docs-section">
            				<div class="row">
            					<div class="col-lg-12">
            						<div class="page-header">
            							<h3 id="tables">IG</h3>
            						</div>

            						<div class="bs-component">
            							<table class="table table-hover">
            								<tbody>
            								<?php foreach ($fuzzy->iG as $a => $item) { ?>
            									<tr>
            										<th><?= $fuzzy->rules[$a]["name"] ?></th>
            										<th scope="col"><?= $item ?></th>
            									</tr>
            								<?php } ?>
            								<tr>
            									<th>Highest</th>
            									<th><?= $fuzzy->chosenRule ?></th>
            								</tr>
            								</tbody>
            							</table>
            						</div>
            					</div>
            				</div>
            			</div>

            			<div class="bs-docs-section">
            				<div class="row">
            					<div class="col-lg-12">
            						<div class="page-header">
            							<h3 id="tables">Node Percentage</h3>
            						</div>

            						<div class="bs-component">
            							<table class="table table-hover">
            								<tbody>
            								<?php foreach ($fuzzy->rules[$fuzzy->highestIGFrom]["types"] as $a => $rule) { ?>
            									<tr>
            										<th colspan="3"><?= $rule ?></th>
            									</tr>
            									<?php foreach ($fuzzy->risk as $b => $r) { ?>
            										<tr>
            											<th><?= $r ?></th>
            											<th><?= $fuzzy->pernode[$b][$a] ?></th>
            											<th><?= $fuzzy->pernodePercentage[$b][$a] ?></th>
            										</tr>
            									<?php } ?>
            								<?php } ?>
            								</tbody>
            							</table>
            						</div>
            					</div>
            				</div>
            			</div>
            		<?php } ?>
            		<div class="bs-docs-section">
            			<div class="row">
            				<div class="col-lg-12">
            					<div class="page-header">
            						<h3 id="tables">Result</h3>
            					</div>

            					<div class="bs-component">
            						<table class="table table-hover">
            							<tbody>
            							<tr>
            								<th>Result</th>
            								<th><?= $fuzzy->getResult() ?></th>
            								<th><a href="#tree">Back to Tree</a></th>
            							</tr>
            							<?php if (!$fuzzy->result) { ?>

            								<?php foreach ($fuzzy->children as $a => $item) { ?>
            									<tr>
            										<th><a href="#<?= $item->name ?>">Child <?= $a + 1 ?></a></th>
            										<th><?= $item->name ?></th>
            										<th><?= $item->getResult() ?></th>
            									</tr>
            								<?php } ?>
            							<?php } ?>
            							</tbody>
            						</table>
            					</div>
            				</div>
            			</div>
            		</div>
            	</div>
            	</div>
            <?php } ?>
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
