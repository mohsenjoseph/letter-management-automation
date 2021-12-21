<?php
$user = $data['user'];
?>
<section id="main-content">
    <section class="wrapper" style="  padding:10px;">

        <?php if(isset($data['message'])) {
            ?>
            <div class="alert alert-success alert-dismissable">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <?= $data['message']; ?>
            </div>
            <?php
        }?>

        <h4  >
                تغییر رمز عبور


        </h4>
        <hr>
        <form action="<?= URL;?>profile/save_password" method="post">

            <div class="row" style="padding:5px;padding-right: 38px">
                <div class="col-lg-4 col-md-4 right">رمز عبور: <input  value="" required name="password" id="password" class="w3-input " style="margin-top: 5px;"type="password" placeholder="رمز عبور"  ></div>
            </div>
            <div class="row" style="padding:5px;padding-right: 38px">
            <div class="col-lg-4 col-md-4 right">تکرار رمز عبور: <input  value="" required name="repassword" id="repassword" class="w3-input " style="margin-top: 5px;"type="password" placeholder="تکرار رمز عبور"  ></div>
            </div>
            <div class="row" id="errorequal" style="padding:5px;padding-right: 100px;display:none; ">
                <span style="color:red">رمز عبور شما یکسان نمی باشد</span>
            </div>
            <div class="row" id="errorspace" style="padding:5px;padding-right: 100px;display:none; ">
                <span style="color:red">رمز عبور نمی تواند خالی باشد</span>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 right" style="padding-right: 200px">
                <input type="hidden"  value="<?= @$user['id'];?>" name="userId" id="userId">
                <input type="button" onclick="submitForm()" class="btn btn-info "   name="edit"
                         value="بروزرسانی">

            </div>
        </form>
        <script>
            function submitForm() {

                var form = $('form');
                var password = $('#password').val();
                var repassword = $('#repassword').val();
                if (password=='' || repassword=='')
                {
                    var divs = $('#errorspace');
                    divs.css('display','inherit');
                }
                else if (password == repassword) {
                    form.submit();
                }
                else if (password != repassword)
                {
                    var div = $('#errorequal');
                    div.css('display','inherit');
                }



            }


        </script>
    </section>
</section>