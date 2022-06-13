<!DOCTYPE html>
<html lang="en">
<!--================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 4.0
	Author: PIXINVENT
	Author URL: https://themeforest.net/user/pixinvent/portfolio
  ================================================================================ -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
    <title>DjCorp - <?= $title; ?></title>
    <!-- Favicons-->
    <link rel="icon" href="<?= base_url('assets'); ?>/images/logo/logo-djcorp.png" sizes="32x32">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="<?= base_url('assets/materialize-admin'); ?>/images/favicon/apple-touch-icon-152x152.png">
    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
    <!-- For Windows Phone -->

    <!-- CORE CSS-->
    <link href="<?= base_url('assets/materialize-admin'); ?>/css//materialize.css" type="text/css" rel="stylesheet">
    <link href="<?= base_url('assets/materialize-admin'); ?>/css//style.css" type="text/css" rel="stylesheet">
    <!-- Custome CSS-->
    <link href="<?= base_url('assets/materialize-admin'); ?>/css/custom/custom.css" type="text/css" rel="stylesheet">
    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="<?= base_url('assets/materialize-admin'); ?>/vendors/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet">
    <link href="<?= base_url('assets/materialize-admin'); ?>/vendors/flag-icon/css/flag-icon.min.css" type="text/css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



    <script>
        // Data Tables
        $(document).ready(function() {
            $('#example').DataTable();
        });

        // Select2
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

</head>

<body>
    <!-- Start Page Loading -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START HEADER -->
    <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="navbar-color gradient-45deg-light-blue-cyan">
                <div class="nav-wrapper">
                    <ul class="left">
                        <li>
                            <h1 class="logo-wrapper">
                                <a href="<?= base_url('assets/materialize-admin'); ?>/index.html" class="brand-logo darken-1 ml-2">
                                    <img src="<?= base_url('assets'); ?>/images/logo/logo-djcorp-white.png" alt="materialize logo" style="width: 22px; height:22px">
                                    <span class="logo-text hide-on-med-and-down">DjCorp</span>
                                </a>
                            </h1>
                        </li>
                    </ul>
                    <div class="header-search-wrapper hide-on-med-and-down">
                        <i class="material-icons">search</i>
                        <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize" />
                    </div>
                    <ul class="right hide-on-med-and-down mr-3">
                        <li>
                            <a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen">
                                <i class="material-icons">settings_overscan</i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect waves-block waves-light profile-button" data-activates="profile-dropdown">
                                <span class="avatar-status avatar-online">
                                    <img src="<?= base_url('assets/materialize-admin'); ?>/images/avatar/avatar-7.png" alt="avatar">
                                    <i></i>
                                </span>
                            </a>
                        </li>
                    </ul>

                    <!-- profile-dropdown -->
                    <ul id="profile-dropdown" class="dropdown-content">
                        <li>
                            <a href="<?= base_url('assets/materialize-admin'); ?>/#" class="grey-text text-darken-1">
                                <i class="material-icons">face</i> Profile</a>
                        </li>
                        <li>
                            <a href="<?= base_url('assets/materialize-admin'); ?>/#" class="grey-text text-darken-1">
                                <i class="material-icons">settings</i> Settings</a>
                        </li>
                        <li>
                            <a href="<?= base_url('assets/materialize-admin'); ?>/#" class="grey-text text-darken-1">
                                <i class="material-icons">keyboard_tab</i> Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- end header nav-->
    </header>
    <!-- END HEADER -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START MAIN -->
    <div id="main">
        <!-- START WRAPPER -->
        <div class="wrapper">
            <!-- START LEFT SIDEBAR NAV-->
            <aside id="left-sidebar-nav">
                <ul id="slide-out" class="side-nav fixed leftside-navigation">
                    <li class="user-details cyan darken-2">
                        <div class="row">
                            <div class="col col s4 m4 l4">
                                <img src="<?= base_url('assets/materialize-admin'); ?>/images/avatar/avatar-7.png" alt="" class="circle responsive-img valign profile-image cyan">
                            </div>
                            <div class="col col s8 m8 l8">
                                <ul id="profile-dropdown-nav" class="dropdown-content">
                                    <li>
                                        <a href="<?= base_url('assets/materialize-admin'); ?>/#" class="grey-text text-darken-1">
                                            <i class="material-icons">face</i> Profile</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('assets/materialize-admin'); ?>/#" class="grey-text text-darken-1">
                                            <i class="material-icons">settings</i> Settings</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('assets/materialize-admin'); ?>/#" class="grey-text text-darken-1">
                                            <i class="material-icons">keyboard_tab</i> Logout</a>
                                    </li>
                                </ul>
                                <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="<?= base_url('assets/materialize-admin'); ?>/#" data-activates="profile-dropdown-nav">John Doe<i class="mdi-navigation-arrow-drop-down right"></i></a>
                                <p class="user-roal">Administrator</p>
                            </div>
                        </div>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible" data-collapsible="accordion">

                            <li class="bold">
                                <a href="<?= base_url('assets/materialize-admin'); ?>/cards-basic.html" class="waves-effect waves-cyan">
                                    <i class="material-icons">cast</i>
                                    <span class="nav-text">Transaksi</span>
                                </a>
                            </li>
                            <li class="bold">
                                <a href="<?= base_url('pks'); ?>" class="waves-effect waves-cyan">
                                    <i class="material-icons">insert_link</i>
                                    <span class="nav-text">Perjanjian Kerjasama</span>
                                </a>
                            </li>
                            <div class="divider"></div>
                            <li class="bold">
                                <a href="<?= base_url('barang'); ?>" class="waves-effect waves-cyan">
                                    <i class="material-icons">devices</i>
                                    <span class="nav-text">Data Barang</span>
                                </a>
                            </li>
                            <li class="bold">
                                <a href="<?= base_url('layanan'); ?>" class="waves-effect waves-cyan">
                                    <i class="material-icons">tap_and_play</i>
                                    <span class="nav-text">Data Layanan</span>
                                </a>
                            </li>
                            <li class="bold">
                                <a href="<?= base_url('pelanggan'); ?>" class="waves-effect waves-cyan">
                                    <i class="material-icons">recent_actors</i>
                                    <span class="nav-text">Data Pelanggan</span>
                                </a>
                            </li>
                            <li class="bold">
                                <a href="<?= base_url('assets/materialize-admin'); ?>/table-basic.html" class="waves-effect waves-cyan">
                                    <i class="material-icons">people</i>
                                    <span class="nav-text">Data User</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <a href="<?= base_url('assets/materialize-admin'); ?>/#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only">
                    <i class="material-icons">menu</i>
                </a>
            </aside>
            <!-- END LEFT SIDEBAR NAV-->

            <!-- START CONTENT -->
            <?= $this->renderSection('content') ?>
            <!-- END CONTENT -->

            <!-- START RIGHT SIDEBAR NAV-->
            <aside id="right-sidebar-nav">
                <ul id="chat-out" class="side-nav rightside-navigation">
                    <li class="li-hover">
                        <div class="row">
                            <div class="col s12 border-bottom-1 mt-5">
                                <ul class="tabs">
                                    <li class="tab col s4">
                                        <a href="<?= base_url('assets/materialize-admin'); ?>/#activity" class="active">
                                            <span class="material-icons">graphic_eq</span>
                                        </a>
                                    </li>
                                    <li class="tab col s4">
                                        <a href="<?= base_url('assets/materialize-admin'); ?>/#chatapp">
                                            <span class="material-icons">face</span>
                                        </a>
                                    </li>
                                    <li class="tab col s4">
                                        <a href="<?= base_url('assets/materialize-admin'); ?>/#settings">
                                            <span class="material-icons">settings</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div id="settings" class="col s12">
                                <h6 class="mt-5 mb-3 ml-3">GENERAL SETTINGS</h6>
                                <ul class="collection border-none">
                                    <li class="collection-item border-none">
                                        <div class="m-0">
                                            <span class="font-weight-600">Notifications</span>
                                            <div class="switch right">
                                                <label>
                                                    <input checked type="checkbox">
                                                    <span class="lever"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <p>Use checkboxes when looking for yes or no answers.</p>
                                    </li>
                                    <li class="collection-item border-none">
                                        <div class="m-0">
                                            <span class="font-weight-600">Show recent activity</span>
                                            <div class="switch right">
                                                <label>
                                                    <input checked type="checkbox">
                                                    <span class="lever"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                                    </li>
                                    <li class="collection-item border-none">
                                        <div class="m-0">
                                            <span class="font-weight-600">Notifications</span>
                                            <div class="switch right">
                                                <label>
                                                    <input type="checkbox">
                                                    <span class="lever"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <p>Use checkboxes when looking for yes or no answers.</p>
                                    </li>
                                    <li class="collection-item border-none">
                                        <div class="m-0">
                                            <span class="font-weight-600">Show recent activity</span>
                                            <div class="switch right">
                                                <label>
                                                    <input type="checkbox">
                                                    <span class="lever"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                                    </li>
                                    <li class="collection-item border-none">
                                        <div class="m-0">
                                            <span class="font-weight-600">Show your emails</span>
                                            <div class="switch right">
                                                <label>
                                                    <input type="checkbox">
                                                    <span class="lever"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <p>Use checkboxes when looking for yes or no answers.</p>
                                    </li>
                                    <li class="collection-item border-none">
                                        <div class="m-0">
                                            <span class="font-weight-600">Show Task statistics</span>
                                            <div class="switch right">
                                                <label>
                                                    <input type="checkbox">
                                                    <span class="lever"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                                    </li>
                                </ul>
                            </div>
                            <div id="chatapp" class="col s12">
                                <div class="collection border-none">
                                    <a href="<?= base_url('assets/materialize-admin'); ?>/#!" class="collection-item avatar border-none">
                                        <img src="<?= base_url('assets/materialize-admin'); ?>/images/avatar/avatar-1.png" alt="" class="circle cyan">
                                        <span class="line-height-0">Elizabeth Elliott </span>
                                        <span class="medium-small right blue-grey-text text-lighten-3">5.00 AM</span>
                                        <p class="medium-small blue-grey-text text-lighten-3">Thank you </p>
                                    </a>
                                    <a href="<?= base_url('assets/materialize-admin'); ?>/#!" class="collection-item avatar border-none">
                                        <img src="<?= base_url('assets/materialize-admin'); ?>/images/avatar/avatar-2.png" alt="" class="circle deep-orange accent-2">
                                        <span class="line-height-0">Mary Adams </span>
                                        <span class="medium-small right blue-grey-text text-lighten-3">4.14 AM</span>
                                        <p class="medium-small blue-grey-text text-lighten-3">Hello Boo </p>
                                    </a>
                                    <a href="<?= base_url('assets/materialize-admin'); ?>/#!" class="collection-item avatar border-none">
                                        <img src="<?= base_url('assets/materialize-admin'); ?>/images/avatar/avatar-3.png" alt="" class="circle teal accent-4">
                                        <span class="line-height-0">Caleb Richards </span>
                                        <span class="medium-small right blue-grey-text text-lighten-3">9.00 PM</span>
                                        <p class="medium-small blue-grey-text text-lighten-3">Keny ! </p>
                                    </a>
                                    <a href="<?= base_url('assets/materialize-admin'); ?>/#!" class="collection-item avatar border-none">
                                        <img src="<?= base_url('assets/materialize-admin'); ?>/images/avatar/avatar-4.png" alt="" class="circle cyan">
                                        <span class="line-height-0">June Lane </span>
                                        <span class="medium-small right blue-grey-text text-lighten-3">4.14 AM</span>
                                        <p class="medium-small blue-grey-text text-lighten-3">Ohh God </p>
                                    </a>
                                    <a href="<?= base_url('assets/materialize-admin'); ?>/#!" class="collection-item avatar border-none">
                                        <img src="<?= base_url('assets/materialize-admin'); ?>/images/avatar/avatar-5.png" alt="" class="circle red accent-2">
                                        <span class="line-height-0">Edward Fletcher </span>
                                        <span class="medium-small right blue-grey-text text-lighten-3">5.15 PM</span>
                                        <p class="medium-small blue-grey-text text-lighten-3">Love you </p>
                                    </a>
                                    <a href="<?= base_url('assets/materialize-admin'); ?>/#!" class="collection-item avatar border-none">
                                        <img src="<?= base_url('assets/materialize-admin'); ?>/images/avatar/avatar-6.png" alt="" class="circle deep-orange accent-2">
                                        <span class="line-height-0">Crystal Bates </span>
                                        <span class="medium-small right blue-grey-text text-lighten-3">8.00 AM</span>
                                        <p class="medium-small blue-grey-text text-lighten-3">Can we </p>
                                    </a>
                                    <a href="<?= base_url('assets/materialize-admin'); ?>/#!" class="collection-item avatar border-none">
                                        <img src="<?= base_url('assets/materialize-admin'); ?>/images/avatar/avatar-7.png" alt="" class="circle cyan">
                                        <span class="line-height-0">Nathan Watts </span>
                                        <span class="medium-small right blue-grey-text text-lighten-3">9.53 PM</span>
                                        <p class="medium-small blue-grey-text text-lighten-3">Great! </p>
                                    </a>
                                    <a href="<?= base_url('assets/materialize-admin'); ?>/#!" class="collection-item avatar border-none">
                                        <img src="<?= base_url('assets/materialize-admin'); ?>/images/avatar/avatar-8.png" alt="" class="circle red accent-2">
                                        <span class="line-height-0">Willard Wood </span>
                                        <span class="medium-small right blue-grey-text text-lighten-3">4.20 AM</span>
                                        <p class="medium-small blue-grey-text text-lighten-3">Do it </p>
                                    </a>
                                    <a href="<?= base_url('assets/materialize-admin'); ?>/#!" class="collection-item avatar border-none">
                                        <img src="<?= base_url('assets/materialize-admin'); ?>/images/avatar/avatar-9.png" alt="" class="circle teal accent-4">
                                        <span class="line-height-0">Ronnie Ellis </span>
                                        <span class="medium-small right blue-grey-text text-lighten-3">5.30 PM</span>
                                        <p class="medium-small blue-grey-text text-lighten-3">Got that </p>
                                    </a>
                                    <a href="<?= base_url('assets/materialize-admin'); ?>/#!" class="collection-item avatar border-none">
                                        <img src="<?= base_url('assets/materialize-admin'); ?>/images/avatar/avatar-1.png" alt="" class="circle cyan">
                                        <span class="line-height-0">Gwendolyn Wood </span>
                                        <span class="medium-small right blue-grey-text text-lighten-3">4.34 AM</span>
                                        <p class="medium-small blue-grey-text text-lighten-3">Like you </p>
                                    </a>
                                    <a href="<?= base_url('assets/materialize-admin'); ?>/#!" class="collection-item avatar border-none">
                                        <img src="<?= base_url('assets/materialize-admin'); ?>/images/avatar/avatar-2.png" alt="" class="circle red accent-2">
                                        <span class="line-height-0">Daniel Russell </span>
                                        <span class="medium-small right blue-grey-text text-lighten-3">12.00 AM</span>
                                        <p class="medium-small blue-grey-text text-lighten-3">Thank you </p>
                                    </a>
                                    <a href="<?= base_url('assets/materialize-admin'); ?>/#!" class="collection-item avatar border-none">
                                        <img src="<?= base_url('assets/materialize-admin'); ?>/images/avatar/avatar-3.png" alt="" class="circle teal accent-4">
                                        <span class="line-height-0">Sarah Graves </span>
                                        <span class="medium-small right blue-grey-text text-lighten-3">11.14 PM</span>
                                        <p class="medium-small blue-grey-text text-lighten-3">Okay you </p>
                                    </a>
                                    <a href="<?= base_url('assets/materialize-admin'); ?>/#!" class="collection-item avatar border-none">
                                        <img src="<?= base_url('assets/materialize-admin'); ?>/images/avatar/avatar-4.png" alt="" class="circle red accent-2">
                                        <span class="line-height-0">Andrew Hoffman </span>
                                        <span class="medium-small right blue-grey-text text-lighten-3">7.30 PM</span>
                                        <p class="medium-small blue-grey-text text-lighten-3">Can do </p>
                                    </a>
                                    <a href="<?= base_url('assets/materialize-admin'); ?>/#!" class="collection-item avatar border-none">
                                        <img src="<?= base_url('assets/materialize-admin'); ?>/images/avatar/avatar-5.png" alt="" class="circle cyan">
                                        <span class="line-height-0">Camila Lynch </span>
                                        <span class="medium-small right blue-grey-text text-lighten-3">2.00 PM</span>
                                        <p class="medium-small blue-grey-text text-lighten-3">Leave it </p>
                                    </a>
                                </div>
                            </div>
                            <div id="activity" class="col s12">
                                <h6 class="mt-5 mb-3 ml-3">RECENT ACTIVITY</h6>
                                <div class="activity">
                                    <div class="col s3 mt-2 center-align recent-activity-list-icon">
                                        <i class="material-icons white-text icon-bg-color deep-purple lighten-2">add_shopping_cart</i>
                                    </div>
                                    <div class="col s9 recent-activity-list-text">
                                        <a href="<?= base_url('assets/materialize-admin'); ?>/#" class="deep-purple-text medium-small">just now</a>
                                        <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">Jim Doe Purchased new equipments for zonal office.</p>
                                    </div>
                                    <div class="recent-activity-list chat-out-list row mb-0">
                                        <div class="col s3 mt-2 center-align recent-activity-list-icon">
                                            <i class="material-icons white-text icon-bg-color cyan lighten-2">airplanemode_active</i>
                                        </div>
                                        <div class="col s9 recent-activity-list-text">
                                            <a href="<?= base_url('assets/materialize-admin'); ?>/#" class="cyan-text medium-small">Yesterday</a>
                                            <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">Your Next flight for USA will be on 15th August 2015.</p>
                                        </div>
                                    </div>
                                    <div class="recent-activity-list chat-out-list row mb-0">
                                        <div class="col s3 mt-2 center-align recent-activity-list-icon medium-small">
                                            <i class="material-icons white-text icon-bg-color green lighten-2">settings_voice</i>
                                        </div>
                                        <div class="col s9 recent-activity-list-text">
                                            <a href="<?= base_url('assets/materialize-admin'); ?>/#" class="green-text medium-small">5 Days Ago</a>
                                            <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">Natalya Parker Send you a voice mail for next conference.</p>
                                        </div>
                                    </div>
                                    <div class="recent-activity-list chat-out-list row mb-0">
                                        <div class="col s3 mt-2 center-align recent-activity-list-icon">
                                            <i class="material-icons white-text icon-bg-color amber lighten-2">store</i>
                                        </div>
                                        <div class="col s9 recent-activity-list-text">
                                            <a href="<?= base_url('assets/materialize-admin'); ?>/#" class="amber-text medium-small">1 Week Ago</a>
                                            <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">Jessy Jay open a new store at S.G Road.</p>
                                        </div>
                                    </div>
                                    <div class="recent-activity-list row">
                                        <div class="col s3 mt-2 center-align recent-activity-list-icon">
                                            <i class="material-icons white-text icon-bg-color deep-orange lighten-2">settings_voice</i>
                                        </div>
                                        <div class="col s9 recent-activity-list-text">
                                            <a href="<?= base_url('assets/materialize-admin'); ?>/#" class="deep-orange-text medium-small">2 Week Ago</a>
                                            <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">voice mail for conference.</p>
                                        </div>
                                    </div>
                                    <div class="recent-activity-list chat-out-list row mb-0">
                                        <div class="col s3 mt-2 center-align recent-activity-list-icon medium-small">
                                            <i class="material-icons white-text icon-bg-color brown lighten-2">settings_voice</i>
                                        </div>
                                        <div class="col s9 recent-activity-list-text">
                                            <a href="<?= base_url('assets/materialize-admin'); ?>/#" class="brown-text medium-small">1 Month Ago</a>
                                            <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">Natalya Parker Send you a voice mail for next conference.</p>
                                        </div>
                                    </div>
                                    <div class="recent-activity-list chat-out-list row mb-0">
                                        <div class="col s3 mt-2 center-align recent-activity-list-icon">
                                            <i class="material-icons white-text icon-bg-color deep-purple lighten-2">store</i>
                                        </div>
                                        <div class="col s9 recent-activity-list-text">
                                            <a href="<?= base_url('assets/materialize-admin'); ?>/#" class="deep-purple-text medium-small">3 Month Ago</a>
                                            <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">Jessy Jay open a new store at S.G Road.</p>
                                        </div>
                                    </div>
                                    <div class="recent-activity-list row">
                                        <div class="col s3 mt-2 center-align recent-activity-list-icon">
                                            <i class="material-icons white-text icon-bg-color grey lighten-2">settings_voice</i>
                                        </div>
                                        <div class="col s9 recent-activity-list-text">
                                            <a href="<?= base_url('assets/materialize-admin'); ?>/#" class="grey-text medium-small">1 Year Ago</a>
                                            <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">voice mail for conference.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </aside>
            <!-- END RIGHT SIDEBAR NAV-->
        </div>
        <!-- END WRAPPER -->
    </div>
    <!-- END MAIN -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START FOOTER -->
    <footer class="page-footer gradient-45deg-light-blue-cyan">
        <div class="footer-copyright">
            <div class="container">
                <span>Copyright ©
                    <script type="text/javascript">
                        document.write(new Date().getFullYear());
                    </script> <a class="grey-text text-lighten-2" href="https://djcorp.co.id/" target="_blank">DjCorp</a> All rights reserved.
                </span>
                <span class="right hide-on-small-only"> Design and Developed by <a class="grey-text text-lighten-2" href="https://djcorp.co.id/">DjCorp</a></span>
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->
    <!-- ================================================
    Scripts
    ================================================ -->
    <!-- jQuery Library -->

    <!--materialize js-->
    <script type="text/javascript" src="<?= base_url('assets/materialize-admin'); ?>/js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="<?= base_url('assets/materialize-admin'); ?>/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="<?= base_url('assets/materialize-admin'); ?>/js/plugins.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="<?= base_url('assets/materialize-admin'); ?>/js/custom-script.js"></script>
</body>

</html>