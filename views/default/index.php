<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>漏洞检测|漏洞上传</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Styles -->
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
    <link rel='stylesheet' id='prettyphoto-css'  href="/assets/css/prettyPhoto.css" type='text/css' media='all'>
    <link href="/assets/css/fontello.css" type="text/css" rel="stylesheet">
    <!--[if lt IE 7]>
    <link href="/assets/css/fontello-ie7.css" type="text/css" rel="stylesheet">
    <![endif]-->
    <!-- Google Web fonts -->
    <link href='http://fonts.googleapis.com/css?family=Quattrocento:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <style>
        body {
            padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
        }
    </style>
    <link href="/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/img/favicon.ico">
    <!-- JQuery -->
    <script type="text/javascript" src="/assets/js/jquery.js"></script>
    <!-- Load ScrollTo -->
    <script type="text/javascript" src="/assets/js/jquery.scrollTo-1.4.2-min.js"></script>
    <!-- Load LocalScroll -->
    <script type="text/javascript" src="/assets/js/jquery.localscroll-1.2.7-min.js"></script>
    <!-- prettyPhoto Initialization -->
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function(){
            $("a[rel^='prettyPhoto']").prettyPhoto();
        });
    </script>
</head>
<body>
<!--******************** NAVBAR ********************-->
<div class="navbar-wrapper">
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
                <h1 class="brand"><a href="#top">hantasa</a></h1>
                <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
                <nav class="pull-right nav-collapse collapse">
                    <ul id="menu-main" class="nav">
                        <li><a title="portfolio" href="<?php echo yii\helpers\Url::to(['upload/index']);?>">上传漏洞</a></li>
                        <li><a title="repository" href="#">漏洞仓库</a></li>
                        <li><a title="services" href="#services">联系我们</a></li>
                    </ul>
                </nav>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.navbar-inner -->
    </div>
    <!-- /.navbar -->
</div>
<!-- /.navbar-wrapper -->
<div id="top"></div>
<!-- ******************** HeaderWrap ********************-->
<div id="headerwrap">
    <header class="clearfix">
        <h1>漏洞检测</h1>
        <div class="container">
            <div class="row">
                <div class="span12">
                    <h2>输入您要检测的域名，下方实时显示检测结果</h2>
                    <input type="text" name="your-email" placeholder="域名..." class="cform-text" size="40" title="your email">
                    <input type="submit" value="开始检测" class="cform-submit">
                </div>
            </div>
            <div class="row">
                <div class="span12">
                    <ul class="icon">

                        <li><a href="#" target="_blank"><i class="icon-facebook-circled"></i></a></li>
                        <li><a href="#" target="_blank"><i class="icon-twitter-circled"></i></a></li>
                        <li><a href="#" target="_blank"><i class="icon-gplus-circled"></i></a></li>
                        <li><a href="#" target="_blank"><i class="icon-skype-circled"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
</div>

<section id="portfolio" class="single-page scrollblock">
    <div class="container">
        <div class="align"><i class="icon-desktop-circled"></i></div>
        <h1 id="folio-headline">检测结果...</h1>
    </div>

    <div>

        <center><h2>啦啦啦</h2></center>
        <br>
    </div>
    <!-- /.container -->
</section>
<hr>

<!-- Loading the javaScript at the end of the page -->
<script type="text/javascript" src="/assets/js/bootstrap.js"></script>
<script type="text/javascript" src="/assets/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="/assets/js/site.js"></script>
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>
