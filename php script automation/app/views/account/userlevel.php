<?php
$users = $data['users'];
$levels = $data['levels'];
?>
<section id="main-content">
    <section class="wrapper" style="  padding-right:10px;">
        <h4  >
                انتصاب پست
        </h4>
        <hr>
        <form action="<?= URL;?>account/editUserLevel" method="post">

            <div class="row" style="padding-right:30px;">
                <div class="col-lg-2 col-md-2 left">انتخاب پست:
                </div>
                <div class="col-lg-3 col-md-3 right">
                    <select name="levelId" class="w3-input col-lg-12 col-md-12 right" style="margin-top: 5px;">
                        <option>انتخاب کنید</option>
                        <?php foreach($levels as $level) {
                            ?>
                            <option value="<?= $level['id'] ;?>"><?= $level['semat'] ;?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-lg-2 col-md-2 left">انتصاب کارمند:
                </div>
                <div class="col-lg-3 col-md-3 right">
                    <select   name="userId" class="w3-input col-lg-12 col-md-12 right" style="margin-top: 5px;">
                        <option>انتخاب کنید</option>
                        <?php foreach($users as $user) {
                            ?>
                            <option value="<?= $user['id'] ;?>"><?= $user['name'] ;?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 center">
                <input type="submit" class="btn btn-info" name="edit"  value="ویرایش">
                <input type="button" class="btn btn-info" style=" margin-left:10px;margin-right:3px;cursor: pointer" onclick="goBack()" value="برگشت">
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