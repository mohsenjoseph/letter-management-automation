<?php
$signature_status='';
$value_signature=0;

$users = $data['users'];
$levels = $data['levels'];
if($data['levelId']!='') {
    $level = $data['level'];
    if($level['signature_status']==1) { $signature_status="checked"; $value_signature=1; }
    $levelId = $data['levelId'];
}
?>
<section id="main-content">
    <section class="wrapper" style=" padding-right:10px;">



        <h4>
                افزدون پست جدید


        </h4>
        <hr>
        <form action="<?= URL;?>account/saveLevel" method="post">

            <div class="row" style="padding-right:30px;">
                <div class="col-lg-4 col-md-4 right" >پست: <input value="<?= @$level['semat'];?>" name="semat"style="margin-top: 5px;" class="w3-input " type="text" placeholder="نام پست سازمانی"  ></div>
                <div class="col-lg-4 col-md-4 right" >نام محترمانه پست: <input value="<?= @$level['semattop'];?>" name="semattop"style="margin-top: 5px;" class="w3-input " type="text" placeholder="نام پست سازمانی"  ></div>
                <div class="col-lg-4 col-md-4 right">انتخاب ریشه:
                    <select   name="parentId" class="w3-input " style="margin-top: 5px;">
                        <option>انتخاب کنید</option>
                        <?php foreach($levels as $row) {
                            ?>
                            <option value="<?= $row['id'] ;?>" <?php if(@$level['parentId']==$row['id']) echo 'selected';?> ><?= $row['semat'] ;?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-lg-2 col-md-2 right" style="line-height: 25px" >
                    <input value="<?= $value_signature;?>" <?= $signature_status;?>
                         name="signature_status" style="margin-top: 5px; position: absolute" class="w3-input " type="checkbox"  >
                    <label style="display: inherit;">حق امضاء:</label>
                </div>

            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 center" style="margin-top: 10px">
                <?php
                if($data['levelId']!='') {
                    $levelId = $data['levelId'];
                    ?>
                    <input type="hidden"  value="<?= @$levelId;?>" name="levelId" id="levelId">
                    <input type="submit" class="btn btn-info "   name="edit"
                             value="ویرایش">
                    <?php
                }
                else {
                    ?>
                    <input type="submit" class="btn btn-info "  name="insert"
                             value="ذخیره">
                    <?php
                }
                ?>
                <input type="button" class="btn btn-info" style="margin-left:10px;margin-right:3px;cursor: pointer" onclick="goBack()" value="برگشت">
                <script>
                    function goBack() {
                        var url = '<?= URL;?>account/showLevel';
                        location.replace(url);
                    }
                </script>
            </div>
        </form>
    </section>
</section>