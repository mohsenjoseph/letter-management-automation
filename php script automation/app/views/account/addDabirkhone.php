<?php
$levels = $data['levels'];
$dabirkhone = $data['dabirkhone'];
if($data['dabirId']!='')  $dabirId = $data['dabirId'];
?>
<section id="main-content">
    <section class="wrapper" style="  padding:10px;">



        <h4  >
ایجاد دبیرخانه

        </h4>
        <hr>
        <form action="<?= URL;?>account/saveDabirkhone" method="post">

            <div class="row" style="padding-right:30px;">
                <div class="col-lg-2 col-md-2 left">نام دبیرخانه:
                </div>
                <div class="col-lg-3 col-md-3 right">
                    <input name="name" type="text" value="<?= @$dabirkhone['name'];?>" class="w3-input col-lg-12 col-md-12 right" style="">

                </div>
            </div>
            <div class="row" style="padding-right:30px;">
            <div class="col-lg-2 col-md-2 left">انتخاب کارشناس دبیرخانه:
                </div>
                <div class="col-lg-3 col-md-3 right">
                    <select   name="levelId" required class="w3-input col-lg-12 col-md-12 right" style="margin-top:5px;">
                        <option value=""  >انتخاب کنید</option>
                        <?php
                        $levelId='';
                        if(isset($dabirkhone['levelId'])) $levelId=$dabirkhone['levelId'];
                        foreach($levels as $level) {
                            ?>
                            <option value="<?= $level['id'] ;?>"
                                <?php
                                if($level['id']==$levelId)
                                    echo " selected ";
                                ?>
                            ><?= $level['semat'] ;?></option>
                            <?php
                        }
                        ?>
                        </select>
                </div>
            </div>
            <div class="row" style="padding-right:30px;">
                <div class="col-lg-2 col-md-2 left">حرف شماره وارده:
                </div>
                <div class="col-lg-3 col-md-3 right">
                    <input   name="middle_letter_in"  type="text" value="<?= @$dabirkhone['middel_letter_in'];?>" class="w3-input col-lg-12 col-md-12 right" style="margin-top:5px;">
                </div>
            </div>
            <div class="row" style="padding-right:30px;">
                <div class="col-lg-2 col-md-2 left">حرف شماره داخلی:
                </div>
                <div class="col-lg-3 col-md-3 right">
                    <input   name="middel_letter_internal" type="text" value="<?= @$dabirkhone['middel_letter_internal'];?>" class="w3-input col-lg-12 col-md-12 right" style="margin-top:5px;">
                </div>
            </div>
            <div class="row" style="padding-right:30px;">
                <div class="col-lg-2 col-md-2 left">حرف شماره صادره:
                </div>
                <div class="col-lg-3 col-md-3 right">
                    <input   name="middle_letter_out" type="text" value="<?= @$dabirkhone['middel_letter_out'];?>" class="w3-input col-lg-12 col-md-12 right" style="margin-top:5px;">
                </div>
            </div>
            <div class="row" style="padding-right:30px;">
                <div class="col-lg-2 col-md-2 left">شماره نامه آغازین:
                </div>
                <div class="col-lg-3 col-md-3 right">
                    <input   name="startNumberLetter"  type="text" value="<?= @$dabirkhone['startNumberLetter'];?>" class="w3-input col-lg-12 col-md-12 right" style="margin-top:5px;">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 center" style="margin-top: 15px">
                <?php
                if($data['dabirId']!='') {
                    $dabirId = $data['dabirId'];
                    ?>
                    <input type="hidden"  value="<?= @$dabirId;?>" name="dabirId" id="dabirId">
                    <input type="submit" class="btn btn-info "   name="edit" value="ویرایش">
                    <?php
                }
                else {
                    ?>
                    <input type="submit" class="btn btn-info "  name="insert" value="ذخیره">
                    <?php
                }
                ?>
                <input type="button" class="btn btn-info" style=" margin-left:10px;margin-right:3px;cursor: pointer" onclick="goBack()" value="برگشت">
                <script>
                    function goBack() {
                        var url = '<?= URL;?>account/dabirkhone';
                        location.replace(url);
                    }
                </script>
            </div>
        </form>

    </section>
</section>