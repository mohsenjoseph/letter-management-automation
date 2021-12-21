<div class="container" style="text-align: -webkit-center; padding-top: 10%;" >
<div class="form-group center"
            style="text-align:center;width:260px;background-color:#fff;opacity: 0.94;border-radius: 10px;
            border-color: #a2a2a2;border:1px">

        <img style="width:100px" src="<?= URL ?>public/img/logo.png">
        <h3 style="font-family:'B Yekan';" >اتوماسیون اداری کوثـر</h3>
        <br>
        <h4 style="font-family:'B Yekan';">ورود به حساب کاربری</h4>
        <form action='<?= URL ?>login/checkuser' method='post'>
            <div class="form-group">
                <input name='username' placeholder="نام کاربری" type='text' class='input-sm'>
            </div>
            <div class="form-group">
                <input name='password' placeholder="رمز عبور" type='password' class='input-sm'>
            </div>
            <div class='form-group'>
                <input type='submit' value='ورود' class='btn btn-lg btn-info  '>
            </div>
            <br>
        </form>
       </div>

</div>