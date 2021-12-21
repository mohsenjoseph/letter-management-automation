<?php
$user = $data['user'];
$letter = $data['letter'];
$itemBox = $data['itemBox'];
$levelActive = $data['levelActive'];
$user_signature=0;
$signature_status_user=0;
$levelCreateEdit=0;
foreach ($user['levelInfo'] as $levelInfo) {
    if ($levelInfo['signature_status'] == 1 && $levelInfo['id']==$levelActive) $signature_status_user = $levelInfo['id'];
    $selected = '';
    if ($letter['levelId_create'] == $levelInfo['id']) {
        $levelCreateEdit = $levelInfo['id'];
    }
}
$printLetter=URL."letter/eprintLetter/".$levelActive."/".$itemBox."/".$letter['id']."/".$activemenu;
$editLetter=URL."letter/edit/".$levelActive."/".$itemBox."/".$letter['id']."/".$activemenu;
$cycleLetter=URL."letter/cycle/".$levelActive."/".$itemBox."/".$letter['id']."/".$activemenu;
?>
<section id="main-content">
    <section class="wrapper" style="width:80%;margin-right:10%;margin-top:80px;background-color:#fff;padding:10px;
    border:2px  #a2a2a2  solid;">
        <div class="row col-lg-12 col-md-12">
            <h3 style="text-align:center">نمایش نامه</h3>
        </div>
        <div style="float: left;text-align: left">
            شماره: <?=$letter['numLetter'];?>
            <br>
            تاریخ:
            <?php
            if($letter['status']==2) {
                echo $letter['date_numLetter'];
            }
            ?>
        </div>
        <form action="<?= URL; ?>letter/forward" method="post" enctype="multipart/form-data">
            <input type="hidden" name="levelActive" value="<?= $levelActive;?>">
            <input type="hidden" name="letterId" value="<?= $letter['id'];?>">
            <div class="row "style="padding: 5px">
            <div class="col-lg-2 col-md-2 left">
                ارسال کننده:
            </div>
            <div class="col-lg-4 col-md-4 right">
                    <?php
                    if($letter['input']!=1)
                     echo $letter['create_name']." - ".$letter['create_semat'];
                     else
                    echo $letter['description'];
                     ?>
            </div>
                <?php
                if($letter['input']!=1) {
                    ?>
                    <div class="col-lg-1 col-md-1 left">
                        امضاء کننده:
                    </div>
                    <div class="col-lg-3 col-md-3 right">
                        <?php
                        $signature_status = 0;
                        if ($letter['levelId_signature'] == 0) {
                            echo "<span id='signatureStatus' style='color:red'>امضاء کننده تعین نشده است</span>";
                            $signature_status = 1;
                        } elseif ($letter['date_signature'] == '0' || $letter['date_signature'] == '') {
                            echo $letter['signature_name'] . " - " . $letter['signature_semat'];
                            echo "<span id='signatureStatus' style='color:red'><span id='titleSig'>(امضاء نشده)</span></span>";
                            $signature_status = 1;
                        } else {
                            echo $letter['signature_name'] . " - " . $letter['signature_semat'];
                            echo "<span id='signatureStatus' style='color:green'><span id='titleSig'>(امضاء شد)</span></span>";
                        }
                        ?>

                    </div>
                    <?php
                }
                ?>
        </div>
        <div class="row "style="padding: 5px">
            <div class="col-lg-2 col-md-2 left">
                گیرندگان:
            </div>
            <div class="col-lg-4 col-md-4">
                <?php
                $i=0;
                $levelId_Recive=explode(',', $letter['levelId_Recive']);
                foreach ($letter['userRecive'] as $userRecive) {
                    if($userRecive['recive_level']!=$levelId_Recive[$i] && $userRecive['recive_level']=='') {
                        echo $levelId_Recive[$i].", ";
                    }
                    else
                    {
                        echo $userRecive['recive_name'] . " - " . $userRecive['recive_semat'] . ", ";
                    }
                    $i++;
                }
                ?>
            </div>
            <div class="col-lg-2 col-md-2 left">
                رونوشت:
            </div>
            <div class="col-lg-4 col-md-4 right">
                <?php
                $j=0;
                $levelId_Cc=explode(',', $letter['levelId_Cc']);
                foreach ($letter['userCc'] as $useruserCc) {
                    if ($useruserCc['cc_level'] != $levelId_Cc[$j] && $useruserCc['cc_level'] == '') {
                        echo $levelId_Cc[$j] . ", ";

                    } else {
                        echo $useruserCc['cc_name'] . " - " . $useruserCc['cc_semat'] . ", ";
                    }
                    $j++;
                }
                ?>
            </div>
        </div>
        <div class="row "style="padding: 5px">
            <div class="col-lg-2 col-md-2 left">
                عنوان:
            </div>
            <div class="col-lg-4 col-md-4">
                <?= $letter['subject'];?>
            </div>
            <?php
            if($letter['input']!=1) {
                ?>
                <div class="col-lg-2 col-md-2 left">
                    توضیحات:
                </div>
                <div class="col-lg-4 col-md-4 right">
                    <?= $letter['description']; ?>
                </div>
                <?php
            }
            ?>
        </div>
            <div class="row " style="padding: 5px">
                <div class="col-lg-12 col-md-12 " style="padding: 0px 60px 50px 60px;" >
                    <div class="right" style="border:1px;border-color: red;line-height: 25px;"  >
                        <?= $letter['text'];?>
                    </div>
                </div>
            </div>
            <?php if($letter['date_signature']>0 && $letter['signature_userId']!='' ) {
                ?>
                <div class="row " style="padding: 5px">
                    <div class="left" style="width: 300px;float:left;left:120px;">
                        <p style="text-align:center;z-index: 5; mix-blend-mode: difference;">
                          <b>  <?= $letter['signature_name']; ?>
                            <br>
                            <?= $letter['signature_semat']; ?>
							</b>
                        </p>
                        <span style="position: absolute;z-index: 3;left: 155px;margin-top:-65px;mix-blend-mode: multiply;">
                    <img style="width: 225px;height: 175px"
                         src="<?= URL; ?>public/uploads/<?= @$letter['signature_userId']; ?>/signature_<?= @$letter['signaturepic']; ?>.jpg">
                </span>
                    </div>
                </div>
                <?php
            }
            if($letter['file']==1) {
                ?>
        <div class="row right" style="padding: 0px 60px 0px 60px;" >
            <div class='col-lg-1'>پیوست:</div>
            <br>
                <?php

                    $i = 1;
                    foreach ($letter['files'] as $file) {
                        echo "<a target='_blank' href='" . URL . "public/uploads/letters/" . $letter['date_files'] . "/" . $file['name_create'] . "'>";
                        echo "<div class=' ' style='padding-right: 30px;font-size:10px;direction: rtl;margin-right:2px'>" . $file['name'] . " </div></a> ";
                        $i++;
                    }
                ?>
        </div>
            <?php
            }
            ?>
        <div class="row left  " style="padding:100px 0px 0px 0px; ">
            <div class="col-lg-12 col-md-12   ">
            <?php
            if($letter['status']<1 && $signature_status_user>0 && $signature_status_user==$levelActive && $letter['levelId_signature']==$levelActive) {
                ?>
                    <input type="button" onclick="signatureSubmit(<?= $letter['id'];?>)" name="signatures"
                           id="signatures" class="btn btn-info" value="امضاء">
                <?php
            }
            ?>
                <?php
                $requestUrl= $_SERVER['HTTP_REFERER'];
                $chk=strpos($requestUrl,'dabir');
                if($chk)
                {
                    $forwardLetter=URL."letter/forward_dabir/".$letter['id']."/".$itemBox."/".$levelActive."/".$activemenu;
                    ?>
                    <a   href="<?= $forwardLetter; ?>">
                        <input type="button" name="forward" class="btn btn-info" value="ارجاع">
                    </a>
                    <a target="_blank" href="<?= $printLetter; ?>" class="btn btn-info">
                        <i class="icon-print"></i>  چاپ نامه

                    </a>
                    <?php
                }
                else
                {
                    ?>
                    <input type="submit" name="forward" class="btn btn-info" value="ارجاع">
                    <?php
                }
                ?>
                <a  href="<?= $cycleLetter; ?>"  class="btn btn-info" >
                    <i class="icon-retweet"></i>  مشاهده چرخه نامه
                </a>
                <?php
                if($letter['status']<2  ) {
                    ?>
                    <a  href="<?= $editLetter; ?>"  class="btn btn-info">
                        <i class="icon-edit"></i> ویرایش</a>
                    <?php
                }
                ?>
                <?php
                if( $signature_status==0 && $letter['status']==1 && $itemBox=='dabir')
                {
                    ?>
                    <a href="<?php echo URL."letter/addNumber/".$levelActive."/index/".$letter['id'];?>" class="btn btn-info" >
                        <i class="icon-check"></i>   ثبت شماره نامه و ارسال</a>
                    <?php
                }
                ?>
                <input type="button" class="btn btn-info" style=" margin-right:3px;cursor: pointer" onclick="goBack()" value="برگشت">
                <script>
                    function goBack() {
                        var url = '<?php
                            $linkDabir=URL.'letter/dabirkhone/'.$levelActive.'/index';
                            $linkUser=URL.'letter/index/'.$levelActive.'/'.$itemBox;
                            $requestUrl= $_SERVER['REQUEST_URI'];
                            $chk=strpos($requestUrl,'dabir');
                            if($chk) echo $linkDabir ;
                            else echo $linkUser;
                           ?>';
                        location.replace(url);
                    }
                </script>
            </div>
        </form>
    </section>

</section>
<!--main content end-->
<script>
    function signatureSubmit(letterId) {
        var url='<?= URL; ?>letter/signature';
        var data={'letterId':letterId};
        $.post(url,data,function(msg){
            if(msg==1) {
                alert('نامه امضاء شد');
                $('#signatureStatus').css('color','green');
                $('#titleSig').remove();
                var tag="<span id='titleSig'>(امضاء شد)</span>";
                $('#signatureStatus').append(tag);
                $('#signatures').remove();
            }
        else if(msg==2)
            alert('نامه قبلا امضاء شده');
            $('#signatureStatus').css('color','green');
            $('#titleSig').remove();
            var tag="<span id='titleSig'>(امضاء شد)</span>";
            $('#signatureStatus').append(tag);
            $('#signatures').remove();
        });
    }
</script>



