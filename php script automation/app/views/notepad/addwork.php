<?php
if(isset( $data['work'])) $work = $data['work'];
?>
    <section id="main-content">
    <section class="wrapper" style="  padding-top:10px;">

        <h4 >
                افزودن کار جدید
        </h4>
        <hr>
        <form action="<?= URL;?>notepad/savework" method="post" >
        <div class="row" style="padding-right:30px;">
            <div class="col-lg-12 col-md-12 right">عنوان:
                <input  value="<?= @$work['subject'];?>" required name="subject" class="w3-input " style="margin-top: 5px;"
                        type="text" required placeholder="عنوان "  ></div>
            <div class="col-lg-12 col-md-12 right">شرح:
                <textarea   name="description" class="w3-input  right" cols="60" rows="5" style="margin-top: 5px;">
                    <?= @$work['description'];?>
                </textarea></div>
            <div class="col-lg-6 col-md-6 right">وضعیت:
                <select   name="status" class="w3-input " style="margin-top: 5px;" >
                    <option value=""  >انتخاب کنید</option>
                    <option value="1" <?php  if(isset($work['status'])) if( $work['status']==1) echo "selected";?>>عادی</option>
                    <option value="2" <?php  if(isset($work['status'])) if( $work['status']==2) echo "selected";?>>زمان محدود</option>
                    <option value="3" <?php  if(isset($work['status'])) if( $work['status']==3) echo "selected";?>>فوری</option>
                    <option value="5" <?php  if(isset($work['status'])) if( $work['status']==4) echo "selected";?>>انجام شده</option>
                </select>
            </div>
            <div class="col-lg-6 col-md-6 right">تاریخ انجام:
                <input  value="<?= @$work['date_end'];?>" name="date_end" class="w3-input " style="margin-top: 5px;"type="text"
                        placeholder="1395/12/05"  ></div>

            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 center" style="margin-top: 10px">
            <?php
            if(isset($work['id'])) {
                ?>
                <input type="hidden"  value="<?= $work['id'];?>" name="workId">
                <input type="submit" class="btn btn-info  "   name="edit" value="ویرایش">
                <?php
            }
            else {
                ?>
                <input type="submit" class="btn btn-info  " id="saveUser" name="insert"
                      value="ذخیره">
                <?php
            }
            ?>
            <input type="button" class="btn btn-info" style=" margin-left:10px;margin-right:3px;cursor: pointer" onclick="goBack()" value="برگشت">
            <script>
                function goBack() {
                    var url = '<?= URL;?>notepad/work';
                    location.replace(url);
                }
            </script>
        </div>
        </form>

    </section>
    </section>