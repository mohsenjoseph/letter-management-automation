<?php
if(isset( $data['phone'])) $phone = $data['phone'];
?>
    <section id="main-content">
    <section class="wrapper" style=" margin-top:60px;padding-top:10px;">

        <h4 >
                افزودن مخاطب جدید
        </h4>
        <hr>
        <form action="<?= URL;?>notepad/savetell" method="post" >
        <div class="row" style="padding-right:30px;">
            <div class="col-lg-4 col-md-4 right"> <input  value="<?= @$phone['name'];?>" required name="name" class="w3-input " style="margin-top: 5px;" type="text" required placeholder="نام مخاطب "  ></div>
            <div class="col-lg-4 col-md-4 right"><input  value="<?= @$phone['description'];?>" name="description"  class="w3-input " style="margin-top: 5px;" stype="text"  placeholder="توضیحات"  >            </div>
        </div>
            <br>
            <div  style="padding: 20px;height:100%;border:1px solid #a2a2a2;border-radius: 10px">
                <span style="width:150px;text-align:center;margin-top: -30px;background-color:#a2a2a2;color:#fff;padding: 3px;  position: absolute" >اطلاعات محل سکونت</span>
                <input  value="<?= @$phone['mobile'];?>" name="mobile" class=" w3-input right" style="width:150px;margin-right: 15px; display: inline"type="text" placeholder="موبایل"  >
                <input  value="<?= @$phone['tell'];?>" name="tell" class=" w3-input right " style="width:150px;margin-right: 15px;display: inline"type="text" placeholder="تلفن"  >
                <input  value="<?= @$phone['email'];?>" name="email" class="w3-input right " style="width:180px;margin-right: 15px;display: inline"type="email" placeholder="ایمیل"  >
                <input  value="<?= @$phone['adres'];?>" name="adres" class="w3-input   right" style="width:300px;margin-right: 15px;display: inline"type="text" placeholder="آدرس"  >
            </div>
            <br>
            <div  style="padding: 20px;height:100%;border:1px solid #a2a2a2;border-radius: 10px">
                <span style="width:150px;text-align:center;margin-top: -30px;background-color:#a2a2a2;color:#fff;padding: 3px;
                position: absolute" >اطلاعات محل کار</span>
                <input  value="<?= @$phone['work_company'];?>" name="work_company" class=" w3-input right" style="width:150px;margin-right: 15px; display: inline"type="text" placeholder="نام شرکت"  >
                <input  value="<?= @$phone['work_tell'];?>" name="work_tell" class=" w3-input right " style="width:150px;margin-right: 15px;display: inline"type="text" placeholder="تلفن"  >
                <input  value="<?= @$phone['work_fax'];?>" name="work_fax" class=" w3-input right" style="width:150px;margin-right: 15px; display: inline"type="text" placeholder="فکس"  >
                <input  value="<?= @$phone['work_email'];?>" name="work_email" class="w3-input right " style="width:180px;margin-right: 15px;display: inline"type="email" placeholder="ایمیل"  >
                <input  value="<?= @$phone['work_website'];?>" name="work_website" class="w3-input right " style="width:180px;margin-right: 15px;display: inline"type="text" placeholder="وب سایت"  >
                <input  value="<?= @$phone['work_adres'];?>" name="work_adres" class="w3-input   right" style="width:300px;margin-right: 15px;display: inline"type="text" placeholder="آدرس"  >
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 center" style="margin-top: 10px">
            <?php
            if(isset($phone['id'])) {
                ?>
                <input type="hidden"  value="<?= $phone['id'];?>" name="phoneId">
                <input type="submit" class="btn btn-info "   name="edit"
                        value="ویرایش">
                <?php
            }
            else {
                ?>
                <input type="submit" class="btn btn-info " id="saveUser" name="insert"
                         value="ذخیره">
                <?php
            }
            ?>
            <input type="button" class="btn btn-info" style="margin-left:10px;margin-right:3px;cursor: pointer" onclick="goBack()" value="برگشت">
            <script>
                function goBack() {
                    var url = '<?= URL;?>notepad/tel';
                    location.replace(url);
                }
            </script>
        </div>
        </form>

    </section>
    </section>