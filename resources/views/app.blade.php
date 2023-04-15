<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="{{ asset("img/YadakShop.png") }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Markazi Text font include just for persian demo purpose -->
    <link href="https://fonts.googleapis.com/css?family=Cairo&amp;subset=arabic" rel="stylesheet">

    <!-- Styles -->
    <!-- CSS Files -->
    <link href="{{ asset("css/material-dashboard.min.css") }}" rel="stylesheet"/>
    <link href="{{ asset("css/material-dashboard-rtl.css") }}" rel="stylesheet"/>

    <!-- Scripts -->
    @routes
    <script src="{{ mix('js/app.js') }}" defer></script>
    <!-- End Google Tag Manager -->
    <!-- Style Just for persian demo purpose, don't include it in your project -->
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4 {
            font-family: "Cairo";
        }
    </style>
</head>
<body class="font-sans antialiased">
@inertia
<!--   Core JS Files   -->
<script src="{{ asset("js/core/jquery.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("js/core/popper.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("js/core/bootstrap-material-design.min.js?v=3") }}" type="text/javascript"></script>
<script src="{{ asset("js/plugins/perfect-scrollbar.jquery.min.js?v=3") }}"></script>
<!--  Notifications Plugin    -->
<script src="{{ asset("js/plugins/bootstrap-notify.js") }}"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset("js/material-dashboard.min.js") }}" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $().ready(function () {
            $sidebar = $('.sidebar');
            $sidebar_img_container = $sidebar.find('.sidebar-background');

            $full_page = $('.full-page');

            $sidebar_responsive = $('body > .navbar-collapse');
            sidebar_mini_active = true;

            window_width = $(window).width();

            fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

            if( window_width > 767 && fixed_plugin_open == 'Dashboard' ){
                if($('.fixed-plugin .dropdown').hasClass('show-dropdown')){
                    $('.fixed-plugin .dropdown').addClass('show');
                }
            
            }

            $('.fixed-plugin a').click(function (event) {
                // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                if ($(this).hasClass('switch-trigger')) {
                    if (event.stopPropagation) {
                        event.stopPropagation();
                    } else if (window.event) {
                        window.event.cancelBubble = true;
                    }
                }
            });

            $('.fixed-plugin .background-color span').click(function () {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data-color', new_color);
                }

                if ($full_page.length != 0) {
                    $full_page.attr('filter-color', new_color);
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.attr('data-color', new_color);
                }
            });

            $('.fixed-plugin .img-holder').click(function () {
                $full_page_background = $('.full-page-background');

                $(this).parent('li').siblings().removeClass('active');
                $(this).parent('li').addClass('active');


                var new_image = $(this).find("img").attr('src');

                if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    $sidebar_img_container.fadeOut('fast', function () {
                        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                        $sidebar_img_container.fadeIn('fast');
                    });
                }

                if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $full_page_background.fadeOut('fast', function () {
                        $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                        $full_page_background.fadeIn('fast');
                    });
                }

                if ($('.switch-sidebar-image input:checked').length == 0) {
                    var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                    $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                }
            });

            $('.switch-sidebar-image input').on("switchChange.bootstrapSwitch", function () {
                $full_page_background = $('.full-page-background');

                $input = $(this);

                if ($input.is(':checked')) {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar_img_container.fadeIn('fast');
                        $sidebar.attr('data-image', '#');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page_background.fadeIn('fast');
                        $full_page.attr('data-image', '#');
                    }

                    background_image = true;
                } else {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar.removeAttr('data-image');
                        $sidebar_img_container.fadeOut('fast');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page.removeAttr('data-image', '#');
                        $full_page_background.fadeOut('fast');
                    }

                    background_image = false;
                }
            });

            $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function () {
                var $btn = $(this);

                if (sidebar_mini_active == true) {
                    $('body').removeClass('sidebar-mini');
                    sidebar_mini_active = false;
                    materialDashboard.showSidebarMessage('Sidebar mini deactivated...');
                } else {
                    $('body').addClass('sidebar-mini');
                    sidebar_mini_active = true;
                    materialDashboard.showSidebarMessage('Sidebar mini activated...');
                }

                // we simulate the window Resize so the charts will get updated in realtime.
                var simulateWindowResize = setInterval(function () {
                    window.dispatchEvent(new Event('resize'));
                }, 180);

                // we stop the simulation of Window Resize after the animations are completed
                setTimeout(function () {
                    clearInterval(simulateWindowResize);
                }, 1000);
            });
        });
        if (window_width > 767) {
            if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                $('.fixed-plugin .dropdown').addClass('show');
                $('.fixed-plugin .dropdown-menu').addClass('show');
            }
        }
    });
</script>
</body>
</html>
