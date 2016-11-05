<?php
use yii\widgets\ActiveForm;

?>
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
                        <li><a title="portfolio" href="<?php echo yii\helpers\Url::to(['default/index']); ?>">检测漏洞</a></li>
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
        <h1>漏洞上传</h1>
        <div class="container">
            <?php
            $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <div class="row">
                <div class="span12">
                    <h2>只能上传.py格式的压缩代码漏洞，大小不能超过32kB,且不能超过5个</h2>
                    <?= $form->field($model,'file')->fileInput()->label(false) ?>
                   <center> <button class="cform-submit" style="
                    font-family: 'Patua One', cursive;
                    color: #fff;
                    width: 185px;
                    height: 60px;
                    text-shadow: none;
                    font-size: 1.3125em; /* 21px */
                    padding:0.5em;
                    letter-spacing: 0.05em;
                    margin: 0 0 20px 0;
                    display: block;
                    border: 0;
                    text-transform: none;
                    background: #f0bf00 !important;
                    border-radius: 3px;
                    -moz-border-radius: 3px;
                    -webkit-border-radius: 3px;
                    box-shadow: none;
                    -moz-box-shadow: none;
	                -webkit-box-shadow: none;"
                    >上传</button>
                   </center>
<!--                    <input type="submit" value="上传" class="cform-submit">-->
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </header>
</div>

<!-- Loading the javaScript at the end of the page -->
<script type="text/javascript" src="/assets/js/bootstrap.js"></script>
<script type="text/javascript" src="/assets/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="/assets/js/site.js"></script>
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>
