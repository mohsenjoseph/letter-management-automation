<?php
$levels = $data['levels'];
?>
<section id="main-content">
    <section class="wrapper" style=" margin-top:60px;padding:10px;">

        <style>
            .selectTag {
                float: left;
                margin-left: 10px;
                font-family: yekan;
                font-size: 10 . pt;
                padding: 1px;
            }
        </style>
        <aside class="lg-side">
            <div class="inbox-head" >
                <div class="mail-option">
                    <div  >
        <p class="title">
                مدیریت سلسله مراتب
        </p>
        <a class="btn btn-info" style="float: left; " onclick="submitFormMulti();">
            اجرای عملیات
        </a>

        <select class="selectTag" name="action">
            <option value="1"> حذف  </option>
        </select>
        <a href="addLevel" class="btn btn-info" style="float: right;margin-left:15px; "  >
            پست جدید        </a>
        <script>
            function submitFormMulti() {
                var actionSelected = $('.selectTag option:selected').val();
                var action = '';
                if (actionSelected == 1) {
                    action = 'deleteLevel';
                }
                var form = $('form');
                form.attr('action', action);
                form.submit();
            }
        </script>
                    </div>
                </div>
            </div>

        <form action="" method="post">
            <div class="inbox-body">
                <ul style="display: block" ><i class="icon-minus" ></i>&nbsp;ریشه اصلی
                    <?php
                    foreach ($levels as $row) {
                        ?>
                            <li id="parent<?=$row['id']?>" style="padding-right: 30px" >
                               <?php
                               if($row['parentstate']!=0) {
                                   ?>
                                   <i class="icon-plus" onclick="showParent(this,'<?= $row['id'] ?>')"
                                      title="نمایش زیر مجموعه"></i>&nbsp;

                                   <?php
                               }
                               else echo '<i class="icon-minus" ></i>&nbsp;';?>
                                سمت:<?= $row['semat']; ?> |
                            نام محترمانه:    <?= $row['semattop']; ?> |
                                حق امضاء: <?php if($row['signature_status']==1) echo "دارد"; else echo "ندارد";?> |
                             نام کاربر:   <?= $row['userinfo']; ?> |
                                <input type="checkbox" name="id[]" value="<?= $row['id']; ?>">
                                    <a href="addLevel/<?=$row['id'];?>"><i class="icon-edit"></i></a>
                            </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </form>
        </aside>
    </section>
</section>
<script>
    function showParent(thisTag,levelId)
    {
        $(thisTag).attr('onclick','deleteChild(this,'+levelId+')');
        $(thisTag).attr('class','icon-minus');
        var tag= "#parent"+levelId;
        var data={'levelId':levelId};
        var url="<?=URL?>account/subLevel";
        $.post(url,data,function(msg){
            $(tag).append(msg);
        });
    }
    function deleteChild(thisTag,levelId)
    {
        $(thisTag).attr('onclick','showParent(this,'+levelId+')');
        $(thisTag).attr('class','icon-plus');
        var tag = "#parent"+levelId;
        $(tag).children('ul').remove();
        //$(tag).append('<i class="icon-plus" onclick="showParent(this,'+levelId+')" title="نمایش زیر مجموعه"></i>&nbsp;');

    }
</script>