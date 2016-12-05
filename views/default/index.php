<?php
use yii\helpers\Url;
use yii\helpers\Html;
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
//        $(document).ready(function(){

          /*  var wsServer = 'ws://127.0.0.1:1880';
            var ws = new WebSocket(wsServer);
            ws.onopen = function(){
                console.log("握手成功");
            };
            ws.onerror = function(){
                console.log("error");
            };
            function getMsg() {
                if($("input[sql]").value == 1 && $("input[xor]").value != 1 && $("input[other]").value == '') {
                    ws.send($("input[your-domain]").value + '-' + 'sql');
                } else if($("input[sql]").value != 0 && $("input[xor]").value == 1 && $("input[other]").value == '') {
                    ws.send($("input[your-domain]").value + '-' + 'xor');
                } else if($("input[sql]").value != 1 && $("input[xor]").value != 1 && $("input[other]").value != '')
                    ws.send($("input[your-domain]").value + '-' + $("input[other]").value);
            }*/
//        });

//        $('sub').addEventListener('click', getMsg, false);

        /*$(function(){
            $("a[rel^='prettyPhoto']").prettyPhoto();
            var $btn = $("#btn");
            $btn.bind("click",{btn:$btn},function(evdata){
                var bug_type = '';
                if($("input[name='sql']:checked") &&   $("input[name='other']").val() == '') {
                     bug_type = "sqlmap";
                } else if($("input[name='xor']:checked") &&   $("input[name='other']").val() == '') {
                     bug_type = "xor";
                } else if($("input[name='other']").val() != '') {
                     bug_type = $("input[name='other']").val();
                } else {
                    bug_type = '';
                }
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: $btn.attr('formaction'),
                        timeout: 80000,     //ajax请求超时时间80秒
                        data: {time: "80", domain: $("#your-domain").val(), bug_type: bug_type}, //40秒后无论结果服务器都返回数据
                        success: function (data) {
                            //从服务器得到数据，显示数据并继续查询

                            if (data.success == "1") {
                                $("#msg").append("<br>" + data.text);
                            }
                            //未从服务器得到数据，继续查询
                            if (data.success == "0") {
                                $("#msg").append("<br>" + data.msg);
//                            evdata.data.btn.click();
                            }

                        },
                        //Ajax请求超时，继续查询
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            if (textStatus == "timeout") {
                                $("#msg").append("<br>[超时]");
                                evdata.data.btn.click();
                            }
                        }

                    });
            });
        });*/
        $(function() {
            var $btn = $("#btn");
            $btn.bind("click",{btn:$btn},function(evdata) {
                var bug_type = '';
                if ($("input[name='sql']:checked") && $("input[name='other']").val() == '') {
                    bug_type = "sqlmap";
                } else if ($("input[name='xor']:checked") && $("input[name='other']").val() == '') {
                    bug_type = "xor";
                } else if ($("input[name='other']").val() != '') {
                    bug_type = $("input[name='other']").val();
                } else {
                    bug_type = '';
                }
                // 与GatewayWorker建立websocket连接，域名和端口改为你实际的域名端口
                ws = new WebSocket("ws://" + window.location.host.split(':')[0] + ':8282');
//                ws = new WebSocket("ws://127.0.0.1:8282");
// 服务端主动推送消息时会触发这里的onmessage
                ws.onmessage = function(e){
                    // json数据转换成js对象
                    var data = eval("("+e.data+")");
                    var type = data.type || '';
                    switch(type){
                        // Events.php中返回的init类型的消息，将client_id发给后台进行uid绑定
                        case 'init':
                            // 利用jquery发起ajax请求，将client_id发给后端进行uid绑定
                            $.post('<?php echo yii\helpers\Url::to(['default/server']);?>', {client_id: data.client_id,domain:$("#your-domain").val(),bug_type: bug_type}, function(data){}, 'json');
                            break;
                        // 当mvc框架调用GatewayClient发消息时直接alert出来
                        default :
                            $("#msg").append("<br>" + data.msg);
                    }
                };
                /*ws = new WebSocket("ws://127.0.0.1:2346");
                ws.onopen = function () {
                    alert("连接成功");
                    ws.send('tom');
                    alert("给服务端发送一个字符串：tom");
                };
                ws.onmessage = function (e) {
                    alert("收到服务端的消息：" + e.data);
                };*/
            })
        })
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
                <h1 class="brand"><a href="#top">漏洞检测平台</a></h1>
                <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
                <nav class="pull-right nav-collapse collapse">
                    <ul id="menu-main" class="nav">
                        <li><a title="portfolio" href="<?php echo Url::to(['upload/index']);?>">上传漏洞</a></li>
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
                    <h2>输入您要检测的域名，并选择脚本类型，下方实时显示检测结果</h2>
                    <input type="text" name="your-domain" id="your-domain" placeholder="域名..." class="cform-text" size="40" title="your email">
                    <br>
                    <input type="checkbox" value="sql" name="sql" id="sql"><span style="color: white">sql注入</span>
                    <input type="checkbox" value="xor" name="xor" id="xor"><span style="color:white">XOR</span>
                    <input type="text" placeholder="输入您已经上传的脚本的名字" id="other" name="other" class = 'col-md-4' style="height: 10px;width: 300px" value="">其它
                    <input type="button" value="开始检测" class="cform-submit" id = "btn" formaction="<?php echo yii\helpers\Url::to(['default/server']);?>">
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

        <h2 id="msg"></h2>
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
