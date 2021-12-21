<?php
$user=$data['user'];
$levelAvailable=$data['levelAvailable'];
$reciveAvailable=$data['reciveAvailable'];
$dabirAvailable=$data['dabirAvailable'];
$levelActive=$data['levelActive'];
$letter=$data['letter'];
$itemBox = $data['itemBox'];
$signature_status_user=0;
$levelCreateEdit=0;
foreach ($user['levelInfo'] as $levelInfo) {
    if ($levelInfo['signature_status'] == 1 && $levelInfo['id']==$levelActive) $signature_status_user = $levelInfo['id'];
    $selected = '';
    if ($letter['levelId_create'] == $levelInfo['id']) {
        $levelCreateEdit = $levelInfo['id'];
    }
}
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
               ویرایش نامه وارده </div>
        </div>
        <form action="<?= URL; ?>letter/saveeditinput/<?= $levelActive;?>" name="formLetter" id="formLetter" method="post" enctype="multipart/form-data" >

            <input type="hidden" value="<?= $letter['id']; ?>"  name="letterId" id="letterId"   >
            <input type="hidden" value="<?= $levelActive; ?>"  name="levelActive"   >
            <input   name="referr" type="hidden"  value="<?= $_SERVER['HTTP_REFERER']; ?>"  >


            <div class="row "style="padding: 5px">
                <div class="col-lg-2 col-md-2 right">
                    گیرندگان:
                </div>
                <div class="col-lg-4 col-md-4">
                    <ul class="nav top-menu ">
                        <li  id="showListRecive" class="dropdown" >
                            <input  disabled type="text" id="strRecive" data-toggle="" onkeyup="dropdownListRecive(this,this.value)"
                                    class="col-lg-3 right w3-input " style="display: inline">
                            <a  style="width: 30px;display: inline;position: absolute" id="NewRecvie" onclick="NewRecvie(this)" class="col-lg-1 btn btn-info" title="افزودن گیرنده جدید">
                                <i class="icon-plus"   ></i>
                            </a>
                            <ul class="dropdown-menu extended ">
                                <div id="showarrow" style="display: none" class="notify-arrow notify-arrow-green"></div>
                                <?php
                                $i=0;
                                foreach ($reciveAvailable as $level) {
                                    ?>
                                    <li >
                                        <p class="green" id="itemRecive<?=$i;?>"
                                           style="display:none;color:#000;padding: 3px;padding-right:6px; border-bottom:1px solid #a7a7a7;" onclick="addRecive(this)"
                                           metavalue="<?= $level['id']; ?>||<?= $level['user']['name'];?> - <?php echo $level['semat']; ?>">
                                            <?= $level['user']['name'];?> - <?= $level['semat'] ?>
                                        </p>
                                    </li>
                                    <?php
                                    $i++;
                                } ?>
                            </ul>
                        </li>
                    </ul>
                    <script type="text/javascript">
                        function dropdownListRecive(tag,key) {
                            $(tag).attr('data-toggle', 'dropdown');
                            var str = key;
                            var value = '';
                            var i = 0;
                            var find = 0;
                            while ($("#itemRecive" + i).attr('metavalue')) {
                                value = $("#itemRecive" + i).attr('metavalue');
                                $("#itemRecive" + i).css('display', 'none');

                                if (value.search(str) >= 1) {
                                    $("#itemRecive" + i).css('display', 'inherit');
                                    find = 1;
                                }
                                i++;
                                value = '';
                            }
                            if (find == 1) {
                                $("#showarrow").css('display', 'inherit');
                                $("#showListRecive").attr('class', 'dropdown open');
                            }
                            else
                            {
                                $("#showarrow").css('display', 'none');
                                $("#showListRecive").attr('class', 'dropdown');
                            }
                        }
                        function NewRecvie(tag) {
                            var optionTag = $(tag);
                            var values = $("#strRecive").val();
                            if(values!='') {
                                var levelId = values;
                                var semat = values;
                                var spanTag = '<span  class="span_item_recive"><input type="hidden" value="' + levelId + '" name="reciveId[]" id="reciveId" >' + semat + '<i  class="icon-remove-sign " style="color:red" onclick="removeItemRecive(this);"></i></span>';
                                var divRow = optionTag.parents('.row');
                                divRow.append(spanTag);
                            }
                        }
                    </script>
                </div>
                <div class="col-lg-2 col-md-2 right">
                    رونوشت:
                </div>
                <div class="col-lg-4 col-md-4 right">
                    <ul class="nav top-menu ">
                        <li  id="showListCc" class="dropdown" >
                            <input type="text" disabled id="strCc" data-toggle="" onkeyup="dropdownListCc(this,this.value)"
                                   class="col-lg-3 right w3-input " style="display: inline">
                            <a  style="width: 30px;display: inline;position: absolute" id="NewCc" onclick="NewCc(this)" class="col-lg-1 btn btn-info" title="افزودن رونوشت جدید">
                                <i class="icon-plus"   ></i>
                            </a>
                            <ul class="dropdown-menu extended ">
                                <div id="showarrowCc" style="display: none" class="notify-arrow notify-arrow-green"></div>
                                <?php
                                $i=0;
                                foreach ($reciveAvailable as $level) {
                                    ?>
                                    <li >
                                        <p class="green" id="itemCc<?=$i;?>"
                                           style="display:none;color:#000;padding: 3px;padding-right:6px; border-bottom:1px solid #a7a7a7;" onclick="addCc(this)"
                                           metavalue="<?= $level['id']; ?>||<?= $level['user']['name'];?> - <?php echo $level['semat']; ?>">
                                            <?= $level['user']['name'];?> - <?= $level['semat'] ?>
                                        </p>
                                    </li>
                                    <?php
                                    $i++;
                                } ?>
                            </ul>
                        </li>
                    </ul>
                    <script type="text/javascript">
                        function dropdownListCc(tag,key) {
                            $(tag).attr('data-toggle', 'dropdown');
                            var str = key;
                            var value = '';
                            var i = 0;
                            var find = 0;
                            while ($("#itemCc" + i).attr('metavalue')) {
                                value = $("#itemCc" + i).attr('metavalue');
                                $("#itemCc" + i).css('display', 'none');

                                if (value.search(str) >= 1) {
                                    $("#itemCc" + i).css('display', 'inherit');
                                    find = 1;
                                }
                                i++;
                                value = '';
                            }
                            if (find == 1) {
                                $("#showarrowCc").css('display', 'inherit');
                                $("#showListCc").attr('class', 'dropdown open');
                            }
                            else
                            {
                                $("#showarrowCc").css('display', 'none');
                                $("#showListCc").attr('class', 'dropdown');
                            }
                        }
                        function NewCc(tag) {
                            var optionTag = $(tag);
                            var values = $("#strCc").val();
                            if(values!='') {
                                var levelId = values;
                                var semat = values;
                                var spanTag = '<span  class="span_item_cc"><input type="hidden" value="' + levelId + '" name="reciveCc[]" >' + semat + '<i class="icon-remove-sign " style="color:red" onclick="removeItemCc(this);"></i></span>';
                                var divRow = optionTag.parents('.row');
                                divRow.append(spanTag);
                            }
                        }
                    </script>
                </div>
                <?php
                $i=0;
                $levelId_Recive=explode(',', $letter['levelId_Recive']);
                foreach ($letter['userRecive'] as $levelRecive) {
                    if($levelRecive['recive_level']!=$levelId_Recive[$i] && $levelRecive['recive_level']=='') {
                        ?>
                        <span class="span_item_recive">
                    <input type="hidden" value="<?= $levelId_Recive[$i]; ?>" name="reciveId[]" id="reciveId">
                            <?= $levelId_Recive[$i]; ?>
                            <i class="icon-remove-sign red" style="color:red" onclick="removeItemRecive(this);"></i>
                </span>
                        <?php
                    }
                    else
                    {
                        ?>
                        <span class="span_item_recive">
                    <input type="hidden" value="<?= $levelRecive['recive_level']; ?>" name="reciveId[]" id="reciveId">
                            <?= $levelRecive['recive_name'] . " - " . $levelRecive['recive_semat']; ?>
                            <i class="icon-remove-sign red" style="color:red" onclick="removeItemRecive(this);"></i>
                </span>
                        <?php
                    }
                    $i++;
                }
                ?>
                <?php
                $j=0;
                $levelId_Cc=explode(',', $letter['levelId_Cc']);
                foreach ($letter['userCc'] as $levelCc) {
                    if($levelCc['cc_level']!=$levelId_Cc[$j] && $levelCc['cc_level']=='') {
                        ?>
                        <span class="span_item_cc">
                    <input type="hidden" value="<?= $levelId_Cc[$j]; ?>" name="reciveCc[]">
                            <?= $levelId_Cc[$j]; ?>
                            <i class="icon-remove-sign red" style="color:red" onclick="removeItemCc(this);"></i>
                 </span>
                        <?php
                    }
                    else
                    {
                        ?>
                        <span class="span_item_cc">
                    <input type="hidden" value="<?= $levelCc['cc_level']; ?>" name="reciveCc[]">
                            <?= $levelCc['cc_name'] . " - " . $levelCc['cc_semat']; ?>
                            <i class="icon-remove-sign red" style="color:red" onclick="removeItemCc(this);"></i>
                 </span>
                        <?php
                    }
                    $j++;
                }
                ?>
            </div>
        <div class="row "style="padding: 5px">

            <div class="col-lg-3 col-md-3 ">
                <input  name="subject" disabled  value="<?= @$letter['subject'];?>" type="text"  placeholder="عنوان نامه" required class="w3-input   col-lg-12   right">
            </div>
            <div class="col-lg-3 col-md-3 right">
                <input  name="description" disabled value="<?= @$letter['description'];?>" type="text"  placeholder="فرستنده نامه" class="w3-input  col-lg-12  right"  >
            </div>
            <div class="col-lg-2 col-md-2 right">
                <input  name="date_save" disabled type="text" value="<?= @$letter['date_create'];?>"  placeholder="تاریخ ثبت: ۱۳۹۵/۳/۱۵" class="w3-input  col-lg-12  left"  >
            </div>
            <div class="col-lg-2 col-md-2 right">
                <input  name="number_save" disabled  type="text"value="<?= @$letter['numLetter'];?>"  placeholder="شماره ثبت" class="w3-input  col-lg-12  left"  >
            </div>
            <div class="col-lg-2 col-md-2 right">
                <input  name="date_number_input" disabled value="<?= $this->en2fa(@$letter['date_number_input']);?>"   placeholder="تاریخ و شماره نامه وارده" class="w3-input  col-lg-12  left"  >
            </div>
        </div>
        <div class="row "style="padding-right: 25px">
            متن نامه:
            <div class="col-lg-12 col-md-12 col-sm-12 right" style="border-radius: 10px;background-color: rgba(218,146,241,0.09);width:800px;height:100%;padding:10px;">
                <?= $letter['text']; ?>
            </div>
        </div>
        <div  style="padding: 10px">
            <div class="row " class=" col-md-12 col-sm-12">
                <span  style="float:right;cursor: pointer" onclick="addFile(this)" >
                     <i class="icon-plus"></i>   افزودن پیوست
                </span>
                <br>
                <?php
                $count=1;
                foreach ($letter['files'] as $file) {
                    ?>
                    <span class="span_item_file_old">
                        <a href="<?=URL;?>public/uploads/letters/<?=$letter['date_files']."/".$file['name_create'];?>" target="_blank"><?= $file['name'];?></a>
                        <input type="checkbox" checked value="<?=$file['id'];?>" name="fileold[]">
                    </span><br>
                    <?php
                    $count++;
                }
                ?>
            </div>
        </div>
        <div class="row center " style="padding: 10px">
            <input type="button" name="send" id="send" onclick="letterSend()" value=" ذخیره" class="btn btn-info" ></input>
        </div>
        </form>
        <script>

            CKEDITOR.replace('text_letter', {});

        </script>
        <script>
            function addLevelSignatur() {
                var values = $('#signature').val();
                if(values!='انتخاب کنید' ){
                    $("#signature").val(values);
                }
            }
            function lettersave(){
                var recive = ( $("#reciveId").val());
                if(!recive ){ alert("گیرنده نامه تعیین نشده است"); return }
                var tag= $("#save");
                tag.attr('type','submit')
                tag.click();
            }
            function letterSend(){
                var tag= $("#send");
                tag.attr('type','submit')
                tag.click();
            }
            function letterForward(){
                var values = $("#select-signature").val();
                var recive = ( $("#reciveId").val());
                var create = $("#level_create").val();
                if(!recive ){ alert("گیرنده نامه تعیین نشده است"); return }
                if(create=='انتخاب کنید' ){ alert("ارسال کننده نامه تعیین نشده است"); return }
                if(values=='انتخاب کنید' ){
                    alert("امضاء کننده نامه تعیین نشده است"); return
                }
                else{
                    var tag= $("#forward");
                    tag.attr('type','submit')
                    tag.click();
                }
            }
            function addSignature(userLevelId) {
                var value= $("#signature").val();
                if(value!='انتخاب کنید')
                {
                    if(userLevelId==value) {
                        $("#date_signature").val(value);
                        var levelId=userLevelId;
                        var letterId=$("#letterId").val();
                        signatureSubmit(levelId,letterId)
                        var optionTag = $("#span_item_signature");
                        optionTag.css('display', 'inherit');
                    }
                    else
                    {
                        alert('شما به عنوان امضاء کننده انتخاب نشده اید');
                    }
                }
                else
                    alert("امضاء کننده نامه تعیین نشده است");
            }
            function signatureSubmit(levelId,letterId) {
                var url='<?= URL; ?>letter/signature';
                var data={'letterId':letterId,'levelId':levelId};
                $.post(url,data,function(msg){
                    if(msg==1) {
                        alert('نامه امضاء شد');
                        $('#signatureStatus').remove();
                        $('#signatures').remove();
                    }
                    else if(msg==2)
                        alert('نامه قبلا امضاء شده');
                    $('#signatureStatus').remove();
                    $('#signatures').remove();
                });
            }
            function addRecive(tag) {
                var optionTag = $(tag);
                var values = optionTag.attr('metavalue');
                if(values!='') {
                    $("#strRecive").val("");
                    var valuesArray = values.split('||');
                    var levelId = valuesArray[0];
                    var semat = valuesArray[1];
                    var spanTag = '<span  class="span_item_recive"><input type="hidden" value="' + levelId + '" name="reciveId[]" >' + semat + '<i  class="icon-remove-sign " style="color:red" onclick="removeItemRecive(this);"></i></span>';
                    var divRow = optionTag.parents('.row');
                    divRow.append(spanTag);
                }
            }
            function addCc(tag) {

                var optionTag = $(tag);
                var values = optionTag.attr('metavalue');
                if(values!='') {
                    $("#strCc").val("");
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
            function removeItemSignature() {
                var optionTag = $("#span_item_signature")
                optionTag.css('display','none');
                $("#date_signature").val('');
                alert('امضاء حذف شد');

            }
            function previewLetter() {
                var tagForm = $('#formLetter').attr('target','_blank');
                var actionForm = tagForm.attr('action');
                tagForm.attr('action','<?= URL;?>letter/printPreview');
                tagForm.submit();
                tagForm.attr('action',actionForm);
                tagForm.attr('target','_self');
            }
            function previewExplorer() {
                var tagForm = $('#formLetter').attr('target','_blank');
                var actionForm = tagForm.attr('action');
                tagForm.attr('action','<?= URL;?>letter/eprintPreview');
                tagForm.submit();
                tagForm.attr('action',actionForm);
                tagForm.attr('target','_self');
            }
            </script>
    </section>

</section>

<!--main content end-->

