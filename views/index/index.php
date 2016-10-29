<!doctype html>
<html class="no-js" lang="">
<head>
    <!-- =====================================
        Title of the site
    ========================================== -->
    <title>漏洞检测平台</title>

    <!-- =====================================
        Some of mata tag
    ========================================== -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- =====================================
        Favicon of the site
    ========================================== -->
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <!-- =====================================
        Some importent css for the site
        #Bootstrap
        #Font-awesome
        #Fonts
    ========================================== -->
    <link rel="stylesheet" type="text/css" href="/assets/main_css/bootstrap.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/assets/main_css/font-awesome.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/assets/main_css/fonts.css" media="all" />

    <!-- =====================================
        Some of extra effict css
    ========================================== -->
    <link rel="stylesheet" href="/assets/main_css/owl.carousel.css">
    <link rel="stylesheet" href="/assets/main_css/owl.theme.css">
    <link rel="stylesheet" type="text/css" href="/assets/main_css/full-slider.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/assets/main_css/jPushMenu.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/assets/main_css/hover.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/assets/main_css/jquery.fancybox.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/assets/main_css/animate.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/assets/main_css/preload.css" media="all" />

    <!--=========================
        Favicon of this site
    ============================== -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <!--=========================
        Some of main css
    ============================== -->
    <link rel="stylesheet" href="/assets/main_css/normalize.css">
    <link rel="stylesheet" href="/assets/main_css/main.css"><!--css for Main sayle-->
    <link rel="stylesheet" href="/assets/main_css/media.css"><!--css for Responsive-->
    <script src="/assets/main_js/vendor/modernizr-2.8.3.min.js"></script>

</head>
<body>


<div id="loader-wrapper">
    <div id="loader"></div>

    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>

</div>


<!--=========================
    Start area for Menu
============================== -->
<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right">
    <img src="/assets/main_img/logo.png" alt="" />
    <a href="#myCarousel">Home</a>
    <a href="#hireme_area">About me</a>
    <a href="#service_area">Services</a>
    <a href="#project_area">Portfolio</a>
    <a href="#contact_area">Hire me</a>
</nav>


<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!--=========================
    Start area for Header
============================== -->
<header id="myCarousel" class="carousel slide">

    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>


    <!-- Wrapper for Slides -->
    <div class="carousel-inner">

        <!-- Start Overlay heady -->
        <div class="header_overlay">
            <div class="container">

                <!-- Site logo -->


                <!-- Header About -->
                <div class="row header_text">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                       <h2><span>欢迎来到 </span></h2> <br/>
                            <h1>漏洞检测平台</h1>
                    </div>
                    <div class="col-md-6 "></div>
                </div><!-- End Header About -->

                <!-- Header promo -->


            </div>
        </div>

        <div class="item active">
            <!-- Set the first background image using inline CSS below. -->
            <div class="fill" style="background-image:url('/assets/main_img/slider/slide1.jpg');"></div>
            <div class="carousel-caption overlay">

            </div>
        </div>
        <div class="item">
            <!-- Set the second background image using inline CSS below. -->
            <div class="fill" style="background-image:url('/assets/main_img/slider/slide2.jpg');"></div>
            <div class="carousel-caption overlay">

            </div>
        </div>
        <div class="item">
            <!-- Set the third background image using inline CSS below. -->
            <div class="fill" style="background-image:url('/assets/main_img/slider/slide3.jpg');"></div>
            <div class="carousel-caption overlay">

            </div>
        </div>
    </div>

</header><!-- End of Header Area -->

<!--=========================
    Start area for Hire me
============================== -->
<section id="hireme_area">
    <div class="row hireme_row">

        <!-- Start About text -->
        <div class="col-md-6 col-sm-6 col-xs-12 hireme_text  wow slideInLeft">
            <div class="hireme_inner">
                <h2><span>简介</span></h2>
                <p>您可以通过这个网站实时在线快速的查询到某个网站是否有漏洞，如sql注入漏洞等等，您也可以提交漏洞到私人仓库，上限为5个，注意只能提交python文件且必须压缩，大小不能超过16kb，登陆或注册开始查漏之旅！</p>
                <a href="<?php echo yii\helpers\Url::to(['reg/login']);?>" class="my_work hvr-round-corners">登陆</a>
                <a href="<?php echo yii\helpers\Url::to(['reg/reg']);?>" class="hair_me hvr-round-corners">注册</a>
            </div>
        </div>

        <!-- Start About Slide -->
        <div class="col-md-6 col-sm-6 col-xs-12 hireme_slider  wow slideInRight">
            <div id="hireme_slide" class="owl-carousel owl-theme">

                <div class="item"><img src="/assets/main_img/slider/hire_slide1.jpg" alt="The Last of us"></div>
                <div class="item"><img src="/assets/main_img/slider/hire_slide2.jpg" alt="GTA V"></div>
                <div class="item"><img src="/assets/main_img/slider/hire_slide3.jpg" alt="Mirror Edge"></div>

            </div>

        </div>
    </div>
</section><!-- End of Hire me Area -->

<!--=========================
    Start area for Service
============================== -->
<section id="service_area" class="section_padding service_area">
    <div class="container service">

        <!-- Start Service Title -->
        <div class="row service_title wow  rollIn ">
            <div class="col-md-12">
                <h2>我们的<span>具体服务</span></h2>
                <p>迅速，安全，简便</p>
            </div>
        </div>

        <!-- Start Service item -->
        <div class="row service_item">
            <div class="col-md-6 col-sm-6 col-xs-12 single_servicr  wow fadeInUp" data-wow-delay=".2s">
                <div class="service_icon">
                    <i class="fa fa-qrcode"></i>
                </div>
                <div class="service_text">
                    <h3>漏洞查询</h3>
                    <p>仅需输入域名则课快速判别6_6</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 single_servicr   wow fadeInUp" data-wow-delay=".3s">
                <div class="service_icon">
                    <i class="fa fa-qrcode"></i>
                </div>
                <div class="service_text">
                    <h3>会员制度</h3>
                    <p>捐赠我们，我们会给你更多</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 single_servicr wow fadeInUp" data-wow-delay=".2s">
                <div class="service_icon">
                    <i class="fa fa-qrcode"></i>
                </div>
                <div class="service_text">
                    <h3>私人漏洞空间</h3>
                    <p>尽情上传您发现的漏洞，一切保密</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 single_servicr  wow fadeInUp" data-wow-delay=".3s">
                <div class="service_icon">
                    <i class="fa fa-qrcode"></i>
                </div>
                <div class="service_text">
                    <h3>手机端APP</h3>
                    <p>随时随地查询</p>
                </div>
            </div>
        </div>
    </div>
</section><!-- End of Service Area -->

<!--=========================
    Start area for Sponsor
============================== -->
<section id="some_sponsor" class="section_padding sponsor_area">
    <div class="sponsor_bg"></div>
    <div class="sponsor_overlay"></div>

    <!-- Start Sponsor slide -->
    <div class="container sponsor_inner">
        <div class="row">
            <div class="col-md-12">
                <h3>一些一辈子都可能不会资助我们的生产商</h3>
                <div id="sponsor_slide" class="owl-carousel owl-theme">
                    <div class="item"><img src="/assets/main_img/eivato.png" alt="" /></div>
                    <div class="item"><img src="/assets/main_img/jquery.png" alt="" /></div>
                    <div class="item"><img src="/assets/main_img/sass.png" alt="" /></div>
                    <div class="item"><img src="/assets/main_img/less.png" alt="" /></div>
                    <div class="item"><img src="/assets/main_img/jquery.png" alt="" /></div>
                    <div class="item"><img src="/assets/main_img/eivato.png" alt="" /></div>
                    <div class="item"><img src="/assets/main_img/eivato.png" alt="" /></div>
                    <div class="item"><img src="/assets/main_img/jquery.png" alt="" /></div>
                    <div class="item"><img src="/assets/main_img/sass.png" alt="" /></div>
                    <div class="item"><img src="/assets/main_img/less.png" alt="" /></div>
                    <div class="item"><img src="/assets/main_img/jquery.png" alt="" /></div>
                    <div class="item"><img src="/assets/main_img/eivato.png" alt="" /></div>
                </div>
            </div>
        </div>
    </div>

</section><!-- End of Sponsor Area -->


<!--=========================
    Start area for Footer
============================== -->
<footer  class="footer_area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>&copyICP: 蜀ICP备15022210号-2 Contact Gmail：lj550566181@gmail.com</p>
            </div>
        </div>
    </div>
</footer><!-- End of Footer Area -->

<!--=========================
    All script for this site
============================== -->
<script src="/assets/main_js/jquery.js"></script>
<script src="/assets/main_js/bootstrap.min.js"></script>
<script src="/assets/main_js/jPushMenu.js"></script>
<script src="/assets/main_js/owl.carousel.js"></script>
<script src="/assets/main_js/jquery.fancybox.js"></script>
<script src="/assets/main_js/jquery.fancybox.pack.js"></script>
<script src="/assets/main_js/wow.min.js"></script>
<script src="/assets/main_js/plugins.js"></script>
<script src="/assets/main_js/main.js"></script>

</body>
</html>
