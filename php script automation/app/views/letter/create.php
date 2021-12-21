<?php
$user=$data['user'];
$levelAvailable=$data['levelAvailable'];
$reciveAvailable=$data['reciveAvailable'];
$dabirAvailable=$data['dabirAvailable'];
$levelActive=$data['levelActive'];
$itemBox = $data['itemBox'];
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
<section id="main-content">
    <section class="wrapper" style="width:95%;">
        <script src="<?= URL; ?>public/ckeditor/ckeditor.js"></script>
        <div class="row col-lg-12 col-md-12">
            <div style="text-align:center;height:25px;width:100%; padding:0 5px; 0 0;color:#000" ><i class="icon-edit"></i>
                ارسال نامه جدید</div>
        </div>
        <form action="<?= URL; ?>letter/send" name="formLetter" id="formLetter" method="post" enctype="multipart/form-data" >
            <input   name="levelActive" type="hidden"  value="<?= $levelActive; ?>"  >
            <input   name="referr" type="hidden"  value="<?= $_SERVER['HTTP_REFERER']; ?>"  >
        <div class="row "style="padding: 5px">
            <div class="col-lg-1 col-md-1 right">
                ارسال کننده:
            </div>
            <div class="col-lg-3 col-md-3 right">
                <select  autocomplete="off" name="level_create" id="level_create" required  class="w3-input col-lg-12 right">
                    <option>انتخاب کنید</option>
                    <?php
                    $signature_status_user='';
                    foreach ($user['levelInfo'] as $levelInfo) {
                        if($levelInfo['signature_status']==1) $signature_status_user.=$levelInfo['id']."||";
                        $selected='';
                        if($levelActive==$levelInfo['id']) { $selected="selected"; }
                            else {  $selected='';  }
                        ?>
                        <option <?= $selected;?> value="<?= $levelInfo['id'] ?>"><?= $user['name']; ?> - <?= $levelInfo['semat'];?>

                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-1 col-md-1 right">
                امضاء کننده:
            </div>
            <div class="col-lg-3 col-md-3 right" >
                <select autocomplete="off" name="signature" id="signature" class="w3-input  col-lg-12 right">
                    <option>انتخاب کنید</option>
                    <?php
                    foreach ($levelAvailable as $level) {
                        ?>
                        <option  value="<?= $level['id'] ?>">
                            <?= $level['user']['name'];?> - <?= $level['semat'];?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
                <span  class="span_item_signature" id="span_item_signature" style="display: none"> امضاء شد
                    <input type="hidden" value=""  name="date_signature" id="date_signature" >
                    <i class="icon-remove-sign red" style="color:red" onclick="removeItemSignature(this);"></i></span>
            </div>
            <div class="col-lg-1 col-md-1 right">
                انتخاب دبیرخانه:
            </div>
            <div class="col-lg-3 col-md-3 right" >
                <select autocomplete="off" name="dabirkhone" required id="dabirkhone" class="w3-input  col-lg-12 right">
                    <option >  </option>
                    <?php
                    foreach ($dabirAvailable as $dabir) {
                        ?>
                        <option  value="<?= $dabir['id'] ?>">
                            <?= $dabir['name'];?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row "style="padding: 5px">
            <div class="col-lg-1 col-md-1 right">
                گیرندگان:
            </div>
            <div class="col-lg-5 col-md-5">
                    <ul class="nav top-menu ">
                        <li  id="showListRecive" class="dropdown " >
                            <input type="text" id="strRecive" data-toggle="" onkeyup="dropdownListRecive(this,this.value)"
                                   class="right col-lg-4 w3-input  " style="display: inline">
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
            <div class="col-lg-1 col-md-1 right">
                رونوشت:
            </div>
            <div class="col-lg-5 col-md-5 right">
                <ul class="nav top-menu ">
                    <li  id="showListCc" class="dropdown" >
                        <input type="text" id="strCc" data-toggle="" onkeyup="dropdownListCc(this,this.value)"
                               class="right col-lg-4 w3-input " style="display: inline">
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
        </div>
        <div class="row "style="padding: 5px">
            <div class="col-lg-5 col-md-5 ">
                <input  name="subject" placeholder="عنوان نامه" required class="w3-input   col-lg-12   right">
            </div>
            <div class="col-lg-5 col-md-5 right">
                <input  name="description"  placeholder="توضیحات" class="w3-input  col-lg-12  right"  >
            </div>
            <div class="col-lg-2 col-md-2 right">
                سایز برگه چاپ:
                <label>A4<input type="radio" value="1" name="print_size" id="print_size" class="w3-input"></label>
                <label>A5<input type="radio" value="2" checked name="print_size" id="print_size" class="w3-input"></label>
            </div>
        </div>
        <div class="row "style="padding: 5px">
            <div class="col-lg-12 col-md-12 col-sm-12 right">
                <textarea name="text_letter" id="text_letter" class="text-area" style="width: 100%;height: 50%;"> </textarea>
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
            <?php /*?><a  name="preview" class="btn" style="background-color: #626262;color:#fff" onclick="previewLetter()" title="پیش نماش چاپ" ><i class="icon-print"></i></a><?php*/?>
            <a  name="preview" class="btn btn-info"    onclick="previewExplorer()" title="پیش نمایش" ><i class="icon-print"></i></a>
            <?php if($signature_status_user!='') {
                ?>
                <a name="signature" class="btn btn-info" onclick="addSignature('<?= $signature_status_user; ?>')"><i
                            class="icon-compass"></i> امضاء</a>
                <?php
            }
            ?>
            <input type="button"  name="draft" id="draft" class="btn btn-info" value="پیش نویس" onclick="lettersave()">
            <input type="button" name="forward" id="forward"  onclick="letterForward()"  value=" ثبت و ارجاع" class="btn btn-info " ></input>
            <?php if($signature_status_user!='') {
                ?>
                <input type="button" name="send" id="send" style="display: none" onclick="letterSend()" value=" ثبت و ارسال به دبیرخانه"
                       class="btn btn-info"></input>
                <?php
            }
            ?>
            <input type="button" class="btn btn-info" style="margin-left:10px;margin-right:3px;cursor: pointer" onclick="goBack()" value="برگشت">
            <script>
                function goBack() {
                    var url = '<?= URL;?>letter/<?=$levelActive;?>/<?=$itemBox;?>';
                    location.replace(url);
                }
            </script>
        </div>
        </form>

        <script>
            CKEDITOR.replace('text_letter', {});

            function addRecive(tag) {
                var optionTag = $(tag);
                var values = optionTag.attr('metavalue');
                if(values!='') {
                    $("#strRecive").val("");
                    var valuesArray = values.split('||');
                    var levelId = valuesArray[0];
                    var semat = valuesArray[1];
                    var spanTag = '<span  class="span_item_recive"><input type="hidden" value="' + levelId + '" name="reciveId[]" id="reciveId"  >' + semat + '<i  class="icon-remove-sign " style="color:red" onclick="removeItemRecive(this);"></i></span>';
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
            function addLevelSignatur() {
                var values = $('#signature').val();
                if(values!='انتخاب کنید' ){
                    $("#date_signature").val(values);
                }
            }
            function lettersave(){
                var recive = ( $("#reciveId").val());
                if(!recive ){ alert("گیرنده نامه تعیین نشده است"); return }
                var tag= $("#draft");
                tag.attr('type','submit')
                tag.click();
            }
            function letterSend(){
                var values = $("#date_signature").val();
                var recive = ( $("#reciveId").val());
                var create = $("#level_create").val();
                if(!recive ){ alert("گیرنده نامه تعیین نشده است"); return }
                if(create=='انتخاب کنید' ){ alert("ارسال کننده نامه تعیین نشده است"); return }

                if(values!='' && values>0){
                    var tag= $("#send");
                    tag.attr('type','submit')
                    tag.click();
                }
                else
                {
                     alert("نامه امضاء نشده است");
                }
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
                    var levelIdSignature=userLevelId.split('||');
                    var i=0;
                    var chk=0;
                    var lenArray=levelIdSignature.length;
                    for(i=0 ; i<lenArray ; i++)
                    {
                        //alert(levelIdSignature[i]);
                        if (levelIdSignature[i] == value) {
                            $("#date_signature").val(value);
                            var optionTag = $("#span_item_signature");
                            optionTag.css('display', 'inherit');
                            var buttonTag = $("#send");
                            buttonTag.css('display', 'initial');
                            chk=1;
                            break;
                        }

                    }
                    if(chk==0) alert('شما به عنوان امضاء کننده انتخاب نشده اید');
                }
                else
                    alert("امضاء کننده نامه تعیین نشده است");

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
                var buttonTag = $("#send");
                buttonTag.css('display', 'none');

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


