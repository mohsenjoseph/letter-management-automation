<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نصب اتوماسیون اداری کوثر</title>
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="نصب اتوماسیون اداری کوثر">
    <link rel="shortcut icon" href="../public/img/favicon.ico">
    <link href="../public/css/bootstrap.min.css" rel="stylesheet">
    <link href="../public/css/bootstrap-reset.css" rel="stylesheet">

    <link href="../public/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="../public/css/owl.carousel.css" type="text/css">
    <link href="../public/css/w3.css" rel="stylesheet">
    <link href="../public/css/style.css" rel="stylesheet">
    <link href="../public/css/style-responsive.css" rel="stylesheet" />
    <script src="../public/js/jquery.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="../public/js/html5shiv.js"></script>
    <script src="../public/js/respond.min.js"></script>
    <![endif]-->
	<style>
	.form-control{
		color:#000;
	}
	</style>
</head>
<body    style="background-image: url('../public/img/banner.png');background-position: top; background-size: inherit;">
<div class="container" style="text-align: -webkit-center; padding-top: 2%;" >
    <div class="form-group center"
         style="text-align:center;width:360px;background-color:#fff;opacity: 0.94;border-radius: 10px;
            border-color: #a2a2a2;border:1px">

        <img style="width:100px" src="../public/img/logo.png">
        <h3 style="font-family:'B Yekan';" >اتوماسیون اداری کوثـر</h3>
        <br>
        <h4 style="font-family:'B Yekan';">ثبت اطلاعات نصب</h4>


<?php
if(!isset($_POST['Install'])) {
    ?>
    <center>
    <form action="" method="post">
        <table >
            <tr>
                <th>آدرس سرور:</th>
                <td><input name="Install[host]" type="text" class="form-control"  dir="ltr" required value="localhost" placeholder="localhost"/></td>
            </tr>
            <tr>
                <th>نام کاربر:</th>
                <td><input name="Install[username]" type="text" class="form-control"   dir="ltr" required placeholder="username database"/></td>
            </tr>
            <tr>
                <th>رمز عبور:</th>
                <td><input name="Install[password]" type="text"class="form-control"   dir="ltr"  placeholder="Password"/></td>
            </tr>
            <tr>
                <th>نام دیتابیس:</th>
                <td><input name="Install[db]" type="text" class="form-control"   dir="ltr" required placeholder="Database"/></td>
            </tr>
            <tr>
                <th>آدرس سامانه:</th>
                <td><input name="Install[site]" type="url" class="form-control"  dir="ltr" required placeholder="https://u3fi.ir/auto"/></td>
            </tr>
            <tr>
                <th>نام شاخه:</th>
                <td  ><input name="Install[folder]" type="text" class="form-control"  dir="ltr"  placeholder="auto"/></td>
            </tr>
            <tr>
                <th>&nbsp;</th>
                <td><input type="submit" class="btn btn-success" value="شروع نصب"/></td>
            </tr>
        </table>
        <br><br>
    </form>
    </center>
    <?php
}
if(isset($_POST['Install'])) {
    $db_error=false;
// try to connect to the DB, if not display error
    if(!@mysqli_connect($_POST['Install']['host'],$_POST['Install']['username'],$_POST['Install']['password'],$_POST['Install']['db']))
    {
        $db_error=true;
        $error_msg="Sorry, these details are not correct.
  Here is the exact error: ".mysqli_error();
    }
?>
    <div dir="rtl">
<?php
    $mysqli = mysqli_connect($_POST['Install']['host'], $_POST['Install']['username'], $_POST['Install']['password'], $_POST['Install']['db']);
    if(!$mysqli) {
        echo '<p style="color:red;">Connection error</p>' . PHP_EOL;
    }
    else {
        $dbBackup = file_get_contents('DataBase.sql');
        $mysqli->set_charset("utf8");
        $mysqli->multi_query($dbBackup);
        echo '<p style="color:#3bb8af;">مرحله نصب جداول با موفقیت انجام گردید. </p>' . PHP_EOL;
    }
    $siteOpen = $_POST['Install']['site']."bb";
    $siteOpen = str_replace("/bb","/",$siteOpen);
    $siteOpen = str_replace("bb","/",$siteOpen);
    $config_code = "<?php 
define('DB_HOST','".$_POST['Install']['host']."');
define('DB_NAME','".$_POST['Install']['db']."');
define('DB_USER','".$_POST['Install']['username']."');
define('DB_PASS','".$_POST['Install']['password']."');

define('SITE_TITLE','اتوماسیون اداری کوثـر');
define('URL','".$siteOpen."');
?>";

    $fp = fopen('../app/core/Config.php', 'wb');
    fwrite($fp,$config_code);
    fclose($fp);
    chmod('../app/core/Config.php', 0644);

    $htaccess="Options -MultiViews

RewriteEngine On  
  
RewriteBase /".$_POST['Install']['folder']."
  
RewriteCond %{REQUEST_FILENAME} !-d    
RewriteCond %{REQUEST_FILENAME} !-f   

RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]";
    $fp = fopen('../.htaccess', 'wb');
    fwrite($fp,$htaccess);
    fclose($fp);
    chmod('../.htaccess', 0644);

    echo '<p style="color:#9a3a00;">تنظیمات فایل کانفیگ با موفقیت انجام شد </p>';
echo '<p style="color:green;">نصب با موفقیت انجام شد.  </p>';
echo '<p style="color:red;"> اکنون شاخه intall را حذف نمایید. </p>';
echo '<a href="'.$siteOpen.'" target="_blank" class="btn btn-info">ورود به اتوماسیون</a>';
echo '<p style ="color:blue">اطلاعات کاربر ادمین اتوماسیون اداری به شرح ذیل می باشد:<br>
نام کاربری: admin
<br>
رمز عبور: admin
</p><br>';
}
?>
    </div>
    </div>

</div>
</body>
</html>
