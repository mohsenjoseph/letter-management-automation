<?php
$user = $data['user'];
?>
<section id="main-content">
    <section class="wrapper" style=" padding:10px;">

        <?php if(isset($data['message'])) {
            ?>
            <div class="alert alert-success alert-dismissable">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <?= $data['message']; ?>
            </div>
            <?php
        }?>

        <h4 >                مشاهده و ویرایش پروفایل
        </h4>
        <hr>
        <form action="<?= URL;?>profile/save_profile" name="profile"   method="post">

            <div class="row col-lg-12 col-md-12 col-sm-12" style="padding-right:30px;">
                <div class="col-lg-4 col-md-4 right" >کد پرسنلی: <input  value="<?= @$user['code'];?>" disabled class="w3-input " style="margin-top: 5px;"type="text" placeholder="کد پرسنلی"  ></div>
                <div class="col-lg-4 col-md-4 right">نام و نام خانوادگی: <input  value="<?= @$user['name'];?>" disabled  class="w3-input " style="margin-top: 5px;" type="text" required placeholder="نام و نام خانوادگی"  ></div>
                <div class="col-lg-4 col-md-4 right">موبایل: <input  value="<?= @$user['phone'];?>" name="phone" class="w3-input " style="margin-top: 5px;"type="text" placeholder="موبایل"  ></div>
                <div class="col-lg-4 col-md-4 right">تلفن: <input  value="<?= @$user['tell'];?>" name="tell" class="w3-input " style="margin-top: 5px;"type="text" placeholder="تلفن"  ></div>
                <div class="col-lg-4 col-md-4 right">ایمیل: <input value="<?= @$user['email'];?>" name="email" class="w3-input " style="margin-top: 5px;"type="email" placeholder="ایمیل"  ></div>
                <div class="col-lg-4 col-md-4 right">آدرس: <input value="<?= @$user['address'];?>" name="address" class="w3-input " style="margin-top: 5px;"type="text" placeholder="آدرس"  ></div>
                <div class="col-lg-4 col-md-4 right">نام کاربری: <input  value="<?= @$user['username'];?>" disabled class="w3-input " style="margin-top: 5px;"type="text" placeholder="نام کاربری"  ></div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 center" style="margin-top: 10px;padding-right: 30px">
                <input type="hidden"  value="<?= @$user['id'];?>" name="userId" id="userId">
                <input type="submit" class="btn btn-info"   name="edit" value="بروزرسانی">

            </div>
        </form>

        <hr style="border-color: #a2a2a2">
        <form action="<?= URL;?>profile/save_pic_profile" target="_blank" id="save_pic_profile"  name="save_pic_profile" enctype="multipart/form-data" method="post">
        <div class="row right" style="padding-right:45px; margin-top: 5px; display: block">تصویر پروفایل:
                <?php if($user['userpic']!='')
                    echo '<img id="userpicshow" src="'.URL.'public/uploads/'.@$user['id'].'/profile_'.$user['userpic'].'.jpg" style=" width:50px;height:65px">
                    <i class="icon-remove" id="delpics" style="position: absolute;color:red" title="حذف تصویر پروفایل" onclick="delPic()"></i>

';
                ?>
                <input name="userpic" id="userpic" style=" display: inline " onchange="uploadpic()" type="file"   >
<br>
                <input type="hidden"  value="<?= @$user['id'];?>" name="userId" id="userId">
                <span style="color:orangered;font-size:8pt">
                    حداکثر سایز فایل عکس(طول: 250 پیکسل و عرض: 250 پیکسل) با پسوند <b style="color:red">jpg</b> تنظیم نمایید.
                </span>
            </div>

        </form>

    </section>
</section>
<script>
    function uploadpic() {
        $('#save_pic_profile').submit();
        var userId= $('#userId').val();
        var data = {'userId':userId};
        var url = "<?= URL;?>profile/chk_pic_profile";
        $.post(url,data,function(msg){
            if(msg!='')
            {
                var userId= $('#userId').val();
                $('#userpicshow').attr('src',"<?= URL; ?>public/uploads/"+userId+"/profile_"+msg+".jpg");
                $('#userpicshow').css('display','inline');

            }
        });
    }
    function delPic()
    {
        var userId = $("#userId").val();
        var data = {'userId':userId};
        var url = "<?= URL;?>profile/del_pic_profile";
        $.post(url,data,function(msg){
           if(msg==1)
           {
               alert('حذف تصویر پروفایل با موفقیت انجام شد');
               $("#delpics").remove();
               $('#userpicshow').css('display','none');

           }
           else
           {
               alert('حذف تصویر پروفایل با خطا مواجه شد');
           }
        });
    }
</script>