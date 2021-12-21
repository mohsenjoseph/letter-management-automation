<?php
$users = $data['users'];
?>
    <section id="main-content">
    <section class="wrapper" style=" padding-right:10px;">



        <h4  >
                افزدون کاربر جدید


        </h4>
        <hr>
        <form action="<?= URL;?>account/saveuser" method="post" enctype="multipart/form-data">
        <div class="row" style="padding-right:30px;">
            <div class="col-lg-4 col-md-4 right" >کد پرسنلی: <input value="<?= @$users['code'];?>" name="code" style="margin-top: 5px;" class="w3-input " type="text" placeholder="کد پرسنلی" " ></div>
            <div class="col-lg-4 col-md-4 right">نام و نام خانوادگی: <input  value="<?= @$users['name'];?>" required name="name" class="w3-input " style="margin-top: 5px;" type="text" required placeholder="نام و نام خانوادگی"  ></div>
            <div class="col-lg-4 col-md-4 right">موبایل: <input  value="<?= @$users['phone'];?>" name="phone" class="w3-input " style="margin-top: 5px;"type="text" placeholder="موبایل"  ></div>
            <div class="col-lg-4 col-md-4 right">تلفن: <input  value="<?= @$users['tell'];?>" name="tell" class="w3-input " style="margin-top: 5px;"type="text" placeholder="تلفن"  ></div>
            <div class="col-lg-4 col-md-4 right">ایمیل: <input  value="<?= @$users['email'];?>" name="email" class="w3-input " style="margin-top: 5px;"type="email" placeholder="ایمیل"  ></div>
            <div class="col-lg-4 col-md-4 right">آدرس: <input  value="<?= @$users['address'];?>" name="address" class="w3-input " style="margin-top: 5px;"type="text" placeholder="آدرس"  ></div>
            <div class="col-lg-4 col-md-4 right">نام کاربری: <input  value="<?= @$users['username'];?>" name="username" id="username" onchange="checkUserName()" required class="w3-input " style="margin-top: 5px;"type="text"  placeholder="نام کاربری"  >
            </div>
            <div class="col-lg-4 col-md-4 right">رمز عبور: <input name="password"  value='' class="w3-input "style="margin-top: 5px;" type="password" <?php if(!isset($users['username'])) echo "required";?> placeholder="رمز عبور"  ></div>
            <div class="col-lg-4 col-md-4 right">نوع کاربری:
                <select name="powerUser" class="w3-input "style="margin-top: 5px;" type="password" >
                    <?php
                    $select='1';
                    if(isset($users['power']))
                    {
                        $select=$users['power'];
                    }
                    ?>
                    <option value="1" <?php  if($select==1) echo " selected "; ?> >کاربری عادی</option>
                    <option value="2" <?php  if($select==2) echo " selected "; ?>>دبیرخانه</option>
                    <option value="3" <?php  if($select==3) echo " selected "; ?>>مدیر</option>
                </select>
            </div>
            <div class="col-lg-4 col-md-4 right">ip استاتیک: <input name="ipStatic"  value='<?= @$users['ipStatic'];?>' class="w3-input "style="margin-top: 5px;" type="text"  placeholder="ip استاتیک"  ></div>
            <div class="col-lg-4 col-md-4 right">کلید عمومی: <input name="apiKey"  value='<?= @$users['apiKey'];?>' class="w3-input "style="margin-top: 5px;" type="text" placeholder="کلید عمومی"  ></div>
            <div class="col-lg-4 col-md-4 right">کلید خصوصی: <input name="secretKey"  value='<?= @$users['secretKey'];?>' class="w3-input "style="margin-top: 5px;" type="text" placeholder="کلید خصوصی"  ></div>
            <div class="row right" style="padding-right: 30px">ارسال امضاء:
                <input name="signaturefile" class="w3-input "
                       style=" " type="file"   >
                <span style="color:orangered;font-size:8pt">
                    حداکثر سایز فایل عکس(طول: 225 پیکسل و عرض: 170پیکسل) با پسوند <b style="color:red">jpg</b> تنظیم نمایید.
                </span>
            </div>
            <div class="row right" style="padding-right: 30px">تصویر پروفایل:
                <input name="userpic" class="w3-input "
                       style=" " type="file"   >
                <span style="color:orangered;font-size:8pt">
                    حداکثر سایز فایل عکس(طول: 250 پیکسل و عرض: 250 پیکسل) با پسوند <b style="color:red">jpg</b> تنظیم نمایید.
                </span>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 center">
            <label id="usernameLabel" style="display: none;color:red">نام کاربری تکراری می باشد</label>

            <?php
            if($data['userId']!='') {
                $userId = $data['userId'];
                ?>
                <input type="hidden"  value="<?= @$users['id'];?>" name="userId" id="userId">
                <input type="submit" class="btn btn-info "   name="edit"
                         value="ویرایش">
                <?php
            }
            else {
                ?>
                <input type="button" class="btn btn-info " id="saveUser" name="insert"
                         value="ذخیره">
                <?php
            }
            ?>
            <input type="button" class="btn btn-info" style=" margin-left:10px;margin-right:3px;cursor: pointer" onclick="goBack()" value="برگشت">
            <script>
                function goBack() {
                    var url = '<?= URL;?>account/index';
                    location.replace(url);
                }
            </script>
        </div>
        </form>
<script>
    function checkUserName() {
        var username=$('#username').val();
        var url='<?= URL; ?>account/checkUsername';
        var data={'username':username};
        $.post(url,data,function (msg) {
            if(msg=='error') {
                $('#saveUser').attr('type','button');
                $('#usernameLabel').css('display','inherit');
            }
            if(msg=='ok') {
                $('#saveUser').attr('type','submit');
                $('#usernameLabel').css('display','none');

            }
            if(msg=='errorspace') alert('نام کاربری نمی تواند خالی باشد');
        });
    }
</script>




    </section>
    </section>