<?php
$user = $data['user'];
$letter = $data['letter'];
$reciveLetter = $data['reciveLetter'];
$itemBox = $data['itemBox'];
$levelActive = $data['levelActive'];
$user_signature=0;
?>
<section id="main-content">
    <section class="wrapper" style="width:80%;margin-right:10%;margin-top:80px;background-color:#fff;padding:10px;
    border:2px  #a2a2a2  solid;">
        <div class="row col-lg-12 col-md-12">
            <h4 style="text-align:center"><i class="icon-retweet"></i> نمایش چرخه نامه</h4>
        </div>

        <div class="row " style="padding-right: 30px;" >
            <ul style="padding-right: 30px;"><b>                عنوان نامه:
                    <?= $letter['subject'];?></b>
                <li  style="padding-right: 30px;"><i class="icon-edit"></i>&nbsp;                  ایجاد کننده:
                    <?= $letter['level_create']['name'];?> - <?= $letter['level_create']['semat'];?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="icon-calendar"></i>&nbsp;                  تاریخ و زمان ایجاد:
                    <?= $letter['date_create'];?>
                </li>
                <?php
                    if( $letter['input']!=1) {
                        ?>
                        <li style="padding-right: 30px;"><i class="icon-puzzle-piece"></i>&nbsp; امضاء کننده:
                            <?php
                            if ($letter['level_signature']['name'] != '') {
                                echo $letter['level_signature']['name'] . " - " . $letter['level_signature']['semat'];
                                if ($letter['date_signature'] == '' || $letter['date_signature'] == '0')
                                    echo "<span style='color:red'>(امضاء نشده)</span>";
                                else {
                                    echo "<span style='color:green'>(امضاء شده)</span>" . '<i class="icon-calendar"></i>&nbsp; تاریخ و زمان امضاء:';
                                    echo $letter['date_signature'];
                                }
                            } elseif ($letter['level_signature']['name'] == '')
                                echo "<span style='color:red'>امضاء کننده تعین نشده است</span>";


                            ?>
                        </li>
                        <?php
                    }
                ?>
            </ul>
            <?php
            /*
            ?>   <ul ><b>گیرندگان:</b>
                <?php foreach ($letter['userRecive'] as $userRecive) {
                    ?>
                <li class='mini tooltips' style="width: 200px" data-placement='left'
                    data-original-title='<?php
                    if($userRecive['read_status']==0) echo "مشاهده نشده" ;
                    if($userRecive['read_status']==1) echo "مشاهده شده - " .$userRecive['date_view'];
                    ?>'>
                    <?=$userRecive['name'] . " - " . $userRecive['semat'];?>
                </li>
               <?php
                }
                ?>
            </ul>
            <ul><b>رونوشت:</b>
                <?php foreach ($letter['userCc'] as $useruserCc) {
                ?>
                    <li class='mini tooltips' style="width: 200px" data-placement='left'
                        data-original-title='<?php
                        if($useruserCc['read_status']==0) echo "مشاهده نشده" ;
                        if($useruserCc['read_status']==1) echo "مشاهده شده - " .$useruserCc['date_view'];
                        ?>'>
                        <?=$useruserCc['name'] . " - " . $useruserCc['semat'];?>
                    </li>
                <?php
                }
                ?>
            </ul>
            <?php
            */
            ?>
            <hr>
            <ul style="padding-right: 30px;"><i class="icon-retweet"></i> <b>ارجاعات:</b>
                <?php
                $oldSend=0;$liveSend=0;$firstsender=0;
                foreach ($reciveLetter as $step)
                {
                    if($oldSend!=$step['date_send'] )
                    {
                        if($liveSend !=0 )
                        {
                        ?>
                        </ul><?php
                        }
                        $liveSend=1;$oldSend=$step['date_send'];
                    ?>
                    <ul>
                            <i class="icon-ok"></i> فرستنده:
                            <span class='mini tooltips'  data-placement='top'
                        data-original-title= "<?php echo "تاریخ ارسال:".$this->en2fa($step['date_send']);?>">
                           <?php
                                echo $step['sender']['name'] . " - " . $step['sender']['semat'];
                           $firstsender++;
                            ?>
                        </span>[
                        <span style="color:blue"><?=$step['forwardName'];?></span>
                        <?php if($step['description']!='') {
                            if ($firstsender == 1) { ?>
                                ، فرستنده اصلی:<span style="color:blue"><?= $step['description']; ?></span>

                                <?php
                            } else {
                                ?>
                                ، شرح ارجاع:<span style="color:blue"><?= $step['description']; ?></span>
                            <?php }
                        }?>
                        ]<?php
                        }
                        ?>
                        <li style="padding-right: 30px;">
                            <i class="icon-reply"></i>
                            <span class='mini tooltips'  data-placement='top'
                                  data-original-title='<?php
                                  if($step['read_status']==0) echo "مشاهده نشده" ;
                                  if($step['read_status']==1) echo "مشاهده شده : " .$step['date_view'];
                                  ?>'><?= $step['recive']['name'] . " - " . $step['recive']['semat'];?></span>
                            <?php if($step['answer']!=''){?>
                                [<span > پاسخ:<span style="color:green" class='mini tooltips'  data-placement='top' data-original-title= "
  <?php echo "تاریخ پاسخ:".$this->en2fa($step['date_answer']);?>"><?=$step['answer'];?></span></span>]
                            <?php } ?>
                        </li>
                    <?php
                }
                ?>
            </ul>
            <input type="button" class="btn btn-info" style="float:left;margin-left:10px;margin-right:3px;cursor: pointer" onclick="goBack()" value="برگشت">
            <script>
                function goBack() {
                    var url = '<?php
                        $requestUrl= $_SERVER['HTTP_REFERER'];
                        $chk=strpos($requestUrl,'show');
                        if($chk){
                            echo $requestUrl;
                        }
                        else
                        {
                            $linkDabir = URL . 'letter/dabirkhone/' . $levelActive . '/index';
                            $linkUser = URL . 'letter/index/' . $levelActive . '/' . $itemBox;
                            $chk = strpos($requestUrl, 'dabir');
                            if ($chk) echo $linkDabir;
                            else echo $linkUser;
                        }?>';
                    location.replace(url);
                }
            </script>
        </div>

    </section>
</section>
<!--main content end-->




