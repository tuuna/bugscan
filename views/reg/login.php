<?php
use Yii;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<!DOCTYPE html>
<html>
<head>
    <title>登陆页面</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <meta name="keywords" content="Flat Dark Web Login Form Responsive Templates, Iphone Widget Template, Smartphone login forms,Login form, Widget Template, Responsive Templates, a Ipad 404 Templates, Flat Responsive Templates" />
    <link href="/assets/reg_css/style.css" rel='stylesheet' type='text/css' />
    <!--//webfonts-->
    <script src="/assets/main_js/jquery.js"></script>
</head>
<body style="background-color: #222222">
<script>$(document).ready(function(c) {
        $('.close').on('click', function(c){
            $('.login-form').fadeOut('slow', function(c){
                $('.login-form').remove();
            });
        });
    });
</script>
<!--SIGN UP-->
<h1 style="backface-visibility: 20%;">用户登陆</h1>
<div class="login-form">
    <div class="close"> </div>
    <div class="head-info">
        <label class="lbl-1"> </label>
        <label class="lbl-2"> </label>
        <label class="lbl-3"> </label>
    </div>
    <div class="clear"> </div>
    <div class="avtar">
        <img src="/assets/reg_images/avtar.png" />
    </div>
    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '{error}{input}',
        ],
    ]); ?>
    <?php echo $form->field($model,'username')->textInput(['class' => 'text','placeholder' => '用户名'])->label(false);?>
        <div class="key">
     <?php echo $form->field($model,'password')->passwordInput(['placeholder' => '密码'])->label(false);?>
        </div>

    <div class="signin">
<!--        <input type="submit">-->
        <?php echo Html::submitButton('登陆',["class" => "signin",
            'style' => 'font-size: 30px;
                        color: #fff;
                        outline: none;
                        border: none;
                        background: #3ea751;
                        width: 100%;
                        padding: 18px 0;'
        ]);?>
    </div>
    <?php ActiveForm::end();?>
</div>