<?php
$user = $data['user'];
$setting = $data['setting'];
?>
<section id="main-content">
    <section class="wrapper" style="  padding-right:10px;">

        <?php if(isset($data['message'])) {
            ?>
            <div class="alert alert-success alert-dismissable">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <?= $data['message']; ?>
            </div>
            <?php
        }?>

        <h4  >
                بروزرسانی تنظیمات
        </h4>
        <br>
        <form action="<?= URL;?>profile/savesetting" method="post">
           <div  style="padding: 20px;border:1px solid #a2a2a2;border-radius: 10px">
               <span style="width:100px;text-align:center;margin-top: -30px;background-color:#a2a2a2;color:#fff;padding: 3px;  position: absolute" >تنظیمات برگه A4</span>
               <div class="row right" >
            <?php
            foreach ($setting as $value)
            {
                if(strstr($value['setting'],"a4_")){
                    ?>
                    <div class="col-lg-2 col-md-2 right"><?= $value['name']; ?>
                    </div>
                    <div class="col-lg-1 col-md-1 right">
                        <input value="<?= $value['value']; ?>" required name="<?= $value['setting']; ?>"
                               class="w3-input "
                               style="margin-top: 5px;" type="text">
                    </div>
                    <?php
                }
            }
            ?>
            </div>
           </div>
            <br>
            <div  style="padding: 20px;border:1px solid #a2a2a2;border-radius: 10px">
                <span style="width:100px;text-align:center;margin-top: -30px;background-color:#a2a2a2;
                color:#fff;padding: 3px;  position: absolute" >تنظیمات برگه A5</span>
                <div class="row right" >
                    <?php
                    foreach ($setting as $value)
                    {
                        if(strstr($value['setting'],"a5_")){
                            ?>
                            <div class="col-lg-2 col-md-2 right"><?= $value['name']; ?>
                            </div>
                            <div class="col-lg-1 col-md-1 right">
                                <input value="<?= $value['value']; ?>" required name="<?= $value['setting']; ?>"
                                       class="w3-input "
                                       style="margin-top: 5px;" type="text">
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <br>
            <div  style="padding: 20px;border:1px solid #a2a2a2;border-radius: 10px">
                <span style="width:100px;text-align:center;margin-top: -30px;background-color:#a2a2a2;
                color:#fff;padding: 3px; position: absolute" >سایر تنظیمات</span>
                <div class="row right" >
                    <?php
                    foreach ($setting as $value)
                    {
                        if(!strstr($value['setting'],"a5_") && !strstr($value['setting'],"a4_")){
                            ?>
                            <div class="col-lg-2 col-md-2 right"><?= $value['name']; ?>
                            </div>
                            <div class="col-lg-1 col-md-1 right">
                                <input value="<?= $value['value']; ?>" required name="<?= $value['setting']; ?>"
                                       class="w3-input "
                                       style="margin-top: 5px;" type="text">
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <br>
            <div class="col-lg-12 col-md-12 col-sm-12 right" style="padding-right: 30px">
                <input type="hidden"  value="<?= @$user['id'];?>" name="userId" id="userId">
                <input type="submit"  class="btn btn-info"   name="edit"
                       value="بروزرسانی">

            </div>
        </form>

    </section>
</section>