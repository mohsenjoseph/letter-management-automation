<?php
$user=$data['user'];
$levelAvailable=$data['levelAvailable'];
$reciveAvailable=$data['reciveAvailable'];
$levelActive=$data['levelActive'];
$dabirId=$data['dabirId'];

?>
<style>
    .span_item_recive {
        background: #daddef none repeat scroll 0 0;
        color: #4d4e54;
        font-size: 6pt;
        height: 20px;
        padding: 2px 5px;
        position: relative;
        text-align: center;
        margin-right: 2px;
        float: right;
        border-radius: 5px;
    }
    .span_item_cc {
        background: #e6d9c7 none repeat scroll 0 0;
        color: #4d4e54;
        font-size: 6pt;
        float: left;
        height: 20px;
        padding: 2px 5px;
        position: relative;
        text-align: center;
        margin-right: 2px;
        border-radius: 5px;
    }
    .span_item_signature{
        background: #41cac0 none repeat scroll 0 0;
        color: #000;
        padding: 2px 12px;
        float: left;
        position: relative;
        left: 15px;
        text-align: right;
        margin-right: 2px;
        border-radius: 5px;
    }
    .span_item_signature i{
        left: 0;
        position: absolute;
        top: 0px;
        width: 10px;
        cursor: pointer;
    }
    .span_item_file {
        background: #caced6 none repeat scroll 0 0;
        color: #4d4e54;
        font-size: 8pt;
        float: right;
        height: 25px;
        width: 155px;
        padding: 2px 2px;
        position: relative;
        margin-right: 2px;
        border-radius: 5px;
    }

    .span_item_recive i ,.span_item_cc i {
        left: 0;
        position: absolute;
        top: 1px;
        width: 10px;
        cursor: pointer;
    }
    .span_item_file i{
        position: absolute;
        left:0;
        top:1px;
        width: 15px;
        cursor: pointer;
    }
</style>
 <?php
 /*foreach ($levelAvailable as $level) {
     if ($level['semat'] == 'دبیرخانه') {
         $userLevelId = $level['id'];
     }
 }*/
?>
<section id="main-content">
    <section class="wrapper" style="width:95%;">
        <script src="<?= URL; ?>public/ckeditor/ckeditor.js"></script>
        <div class="row col-lg-12 col-md-12">
            <div style="text-align:center;height:25px;width:100%; padding:0 5px; 0 0;color:#000" ><i class="icon-edit"></i>
               ثبت نامه وارده جدید</div>
        </div>
        <form action="<?= URL; ?>letter/sendinput/<?= $levelActive;?>" name="formLetter" id="formLetter" method="post" enctype="multipart/form-data" >

            <?php

            echo '<input   name="level_create" type="hidden"  value="'.$levelActive.'"  >';
            echo '<input   name="levelActive" type="hidden"  value="'.$levelActive.'"  >';
            echo '<input   name="dabirkhone" type="hidden"  value="'.$dabirId.'"  >';
            echo ' <input   name="signature" type="hidden"  value="0"  >';
            echo ' <input   name="date_signature" type="hidden"  value="'.$levelActive.'"  >';
            echo ' <input   name="sendinput" type="hidden"  value="'.$levelActive.'"  >';

            ?>

        <div class="row " style="padding: 5px">
            <div class="col-lg-2 col-md-2 right">
                گیرندگان:
            </div>
            <div class="col-lg-4 col-md-4">
                <select autocomplete="off" id="recive" required oninput="addRecive(this)" class="w3-input   col-lg-12 right" >
                    <option value="" >انتخاب کنید</option>
                    <?php
                    foreach ($reciveAvailable as $level) {

                        ?>
                        <option  value="<?= $level['id']; ?>||<?= $level['user']['name'];?> - <?php echo $level['semat']; ?>"  >
                            <?= $level['user']['name'];?> - <?= $level['semat'] ?>
                        </option>

                    <?php } ?>
                </select>
            </div>
            <div class="col-lg-2 col-md-2 right">
                رونوشت:
            </div>
            <div class="col-lg-4 col-md-4 right">
                <select autocomplete="off"  id="cc" oninput="addCc(this)" class="w3-input  col-lg-12 right">
                    <option value="">انتخاب کنید</option>
                    <?php
                    foreach ($reciveAvailable as $level) {

                        ?>
                        <option value="<?= $level['id']; ?>||<?= $level['user']['name'];?> - <?php echo $level['semat']; ?>"  >
                            <?= $level['user']['name'];?> - <?= $level['semat'] ?>
                        </option>

                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row "style="padding: 5px">

            <div class="col-lg-3 col-md-3 ">
                <input  name="subject" type="text"  placeholder="عنوان نامه" required class="w3-input   col-lg-12   right">
            </div>
            <div class="col-lg-3 col-md-3 right">
                <input  name="description" type="text"  placeholder="فرستنده نامه" class="w3-input  col-lg-12  right"  >
            </div>
            <div class="col-lg-2 col-md-2 right">
                <input  name="date_save" type="text" value="" placeholder="تاریخ ثبت: ۱۳۹۵/۳/۱۵" class="w3-input  col-lg-12  left"  >
            </div>
            <div class="col-lg-2 col-md-2 right">
                <input  name="number_save"  type="text" value="" placeholder="شماره ثبت" class="w3-input  col-lg-12  left"  >
            </div>
            <div class="col-lg-2 col-md-2 right">
                <input  name="date_number_input"  type="text"   placeholder="تاریخ و شماره نامه وارده" class="w3-input  col-lg-12  left"  >
            </div>
        </div>
        <div class="row "style="padding-right: 5px">
            <div class="col-lg-12 col-md-12 col-sm-12 right">
                <textarea name="text_letter" id="text_letter" class="text-area" style="width: 100%;height: 20%;"> </textarea>
            </div>
        </div>
        <div  style="padding: 10px">
            <div class="row " class=" col-md-12 col-sm-12">
                <span  style="float:right;cursor: pointer" onclick="addFile(this)" >
                     <i class="icon-plus"></i>   افزودن پیوست
                </span>
            </div>
        </div>
        <div class="row center " style="padding: 10px">
            <input type="button" name="send" id="send" onclick="letterSend()" value=" ثبت شماره و ارسال" class="btn btn-info" ></input>
        </div>
        </form>
        <script>

            CKEDITOR.replace('text_letter', {});

        </script>
        <script>
            function letterSend(){
                var recive = $("#recive").val();
                if(recive=='انتخاب کنید' )
                    { alert("گیرنده نامه تعیین نشده است"); }
                else
                {
                    var tag= $("#send");
                    tag.attr('type','submit')
                    tag.click();
                }
            }


            function addRecive(tag) {

                var optionTag = $(tag);
                var values = optionTag.val();
                if(values!='') {
                    var valuesArray = values.split('||');
                    var levelId = valuesArray[0];
                    var semat = valuesArray[1];
                    var spanTag = '<span  class="span_item_recive"><input type="hidden" value="' + levelId + '" name="reciveId[]" >' + semat + '<i class="icon-remove-sign red" style="color:red" onclick="removeItemRecive(this);"></i></span>';
                    var divRow = optionTag.parents('.row');
                    divRow.append(spanTag);
                }
            }

            function addCc(tag) {

                var optionTag = $(tag);
                var values = optionTag.val();
                if(values!='') {
                    var valuesArray = values.split('||');
                    var levelId = valuesArray[0];
                    var semat = valuesArray[1];
                    var spanTag = '<span  class="span_item_cc"><input type="hidden" value="' + levelId + '" name="reciveCc[]" >' + semat + '<i class="icon-remove-sign " style="color:red" onclick="removeItemCc(this);"></i></span>';
                    var divRow = optionTag.parents('.row');
                    divRow.append(spanTag);
                }
            }
            function addFile(tag) {

                var optionTag = $(tag);
                var spanTag = '<span  class="span_item_file"><input type="file"  name="file[]" ><i class="icon-remove-sign red" style="color:red" onclick="removeItemFile(this);"> </i></span>';
                var divRow = optionTag.parents('.row');
                divRow.append(spanTag);

            }
            function removeItemRecive(tag) {
                var removeTag = $(tag);
                var spanItem = removeTag.parents('.span_item_recive');
                spanItem.remove();

            }
            function removeItemCc(tag) {
                var removeTag = $(tag);
                var spanItem = removeTag.parents('.span_item_cc');
                spanItem.remove();

            }
            function removeItemFile(tag) {
                var removeTag = $(tag);
                var spanItem = removeTag.parents('.span_item_file');
                spanItem.remove();

            }

            </script>
    </section>

</section>

<!--main content end-->


