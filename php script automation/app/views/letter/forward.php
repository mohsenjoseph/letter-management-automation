<?php
$user=$data['user'];
$reciveAvailable=$data['reciveAvailable'];
$levelActive=$data['levelActive'];
$forwardType = $data['forwardType'];
$letterId=$data['letterId'];
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
        <div class="row col-lg-12 col-md-12">
            <div style="text-align:right;height:25px;width:100%; padding:0 5px; 0 0;color:#000" > <i class="icon-mail-reply"></i>
                ارجاع نامه
            </div>
            <hr>
        </div>
        <form action="<?= URL; ?>letter/saveFroward/<?= $letterId;?>" name="formLetter" id="formLetter" method="post" enctype="multipart/form-data" >

            <input   name="forwardId" type="hidden"  value="<?= $levelActive; ?>"  >
            <input   name="referr" type="hidden"  value="<?php
            $refrer = $_SERVER['HTTP_REFERER'];
            $itemReferr=explode('/',$refrer);
            $link='';
            for($i=0;$i<6;$i++)
            {
                $link.=$itemReferr[$i]."/";
            }
            echo  $link.$levelActive."/".$itemBox; //$_SERVER['HTTP_REFERER']; ?>"  >

            <div class="row " style="padding: 5px">
                <div class="col-lg-2 col-md-2 right">
                    ارجاع به:
                </div>
                <div class="col-lg-4 col-md-4">
                    <select autocomplete="on" id="recive" required oninput="addRecive(this)" class="w3-input   col-lg-12 right" >
                        <option value="" >انتخاب کنید</option>
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
            <div class="row " class=" col-md-12 col-sm-12">
            <div class="col-lg-2 col-md-2 right">
                    نوع ارجاع:
                </div>
                <div class="col-lg-4 col-md-4 right">
                    <select autocomplete="off"  name="forwardType" id="forwardType" required class="w3-input  col-lg-12 right">
                        <option value="" >انتخاب کنید</option>
                        <?php
                        foreach ($forwardType as $type) {
                            ?>
                            <option    value="<?= $type['id']; ?>">
                                <?= $type['name'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row " class=" col-md-12 col-sm-12 " style="padding: 5px">
                <div class="col-lg-2 col-md-2 right">
                    توضیحات:
                </div>
                <div class="col-lg-4 col-md-4 right">
                    <input   name="description" type="text"    class="w3-input  col-lg-12 right" >
                </div>
            </div>
            <div class="row center " style="padding: 10px">
                <input type="button" name="send" id="send" onclick="letterSend()" value=" ارجاع" class="btn btn-info" >
                <input type="button" class="btn btn-info" style=" margin-left:10px;margin-right:3px;cursor: pointer" onclick="goBack()" value="برگشت">
                <script>
                    function goBack() {
                        var url = '<?php
                            $linkDabir=URL.'letter/dabirkhone/'.$levelActive.'/index';
                            $linkUser=URL.'letter/index/'.$levelActive.'/'.$itemBox;
                            $requestUrl= $_SERVER['HTTP_REFERER'];
                            $chk=strpos($requestUrl,'dabir');
                            if($chk) echo $linkDabir ;
                            else echo $linkUser;
                            ?>';
                        location.replace(url);
                    }
                </script>
            </div>
        </form>

        <script>
            function letterSend()
            {
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
            function removeItemRecive(tag) {
                var removeTag = $(tag);
                var spanItem = removeTag.parents('.span_item_recive');
                spanItem.remove();

            }
        </script>
    </section>

</section>

<!--main content end-->


