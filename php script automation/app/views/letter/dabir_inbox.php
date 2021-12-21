<?php
$letters=$data['letters'];
$itemBox=$data['itemBox'];
$levelActive=$data['levelActive'];
$activemenu=$data['activemenu'];

?>
<section id="main-content">
    <section class="wrapper">
        <?php if(isset($data['message'])) {
            if($data['message']!='') {
                ?>

                <div class="alert alert-success alert-dismissable">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <?= $data['message']; ?>
                </div>
                <?php
            }
        }
        ?>
<aside class="lg-side">
    <div class="inbox-head" >
        <!-- <h3>نامه های دریافتی</h3> !-->
        <div class="mail-option"  >
            <div class="col-lg-3 col-md-3 right" style="padding: 3px;color:#000;font-size: 14pt ">
                <?php
                if($itemBox=='index')
                    echo 'دفتر اندیکاتور';
                elseif($itemBox=='input')
                    echo 'نامه های وارده';
                elseif($itemBox=='send')
                    echo 'نامه های صادره';
                ?>
            </div>
            <div class="col-lg-6 col-md-6">
                <form class="position" action="<?=URL."letter/searchDabir/".$levelActive."/".$itemBox."/".$activemenu;?>" method="post">
               جستجو در:<div class="input-append" >
                        <select name="type-search" class="sr-input" style="border-radius: 0px">
                            <option value="numLetter">شماره نامه</option>
                            <option value="numLetterIn">شماره نامه وارده</option>
                            <option value="subject">عنوان نامه</option>
                            <option value="levelId_create">فرستنده نامه</option>
                            <option value="levelId_signature">امضاء کننده نامه</option>
                            <option value="text">متن نامه</option>
                        </select>
                        <input type="text" name="search"  onchange="search()" placeholder="جستجوی نامه ..." class="sr-input">
                        <button type="submit" class="btn btn-primary" style="padding: 5px"><i class="icon-search" style="font-size: 25px"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-md-3  left" style="padding: 5px">
                <a class="btn btn-compose" style="background-color: #ff6c60;color:#fff;width:150px;height: 40px;line-height: 15px;border:0px"
                   href="<?= URL; ?>letter/createinput/<?= $levelActive;?>">نامه وارده جدید</a>
            </div>

         <!--   <div class="btn-group">
                <form class="position" action="#">
                    <div class="input-append">
                        <input type="text" placeholder="جستجوی نامه ..." class="sr-input">
                        <button type="button" class="btn sr-btn"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="btn-group">
                <a class="btn mini tooltips" href="<?= URL; ?>secretariat/index/<?= $levelActive;?>/<?= $itemBox;?>" data-toggle="dropdown" data-placement="top" data-original-title="بروزرسانی">
                    <i class=" icon-refresh"></i>
                </a>
            </div>!-->
           <!-- <ul class="unstyled inbox-pagination">
                <li>
                    <a href="#" class="np-btn" >
                        <i class="icon-angle-right  pagination-right"></i>
                    </a>
                </li>
                <li><span>1 تا 50 از 234</span></li>
                <li>
                    <a href="#" class="np-btn">
                        <i class="icon-angle-left pagination-left"></i>
                    </a>
                </li>
            </ul> !-->
        </div>
    </div>
    <div class="inbox-body">

        <table class="table   table-hover">
            <tbody>
            <tr class="row_header">
                <td class="view-message dont-show">ردیف</td>
                <td class="view-message dont-show">فرستنده</td>
                <td class="view-message">عنوان</td>
               <!-- <td class="view-message">توضیحات</td>!-->
                <td class="view-message inbox-small-cells">پیوست</td>
                <td class="view-message text-right">تاریخ ایجاد </td>
                <td class="view-message text-right">شماره نامه </td>
                <td class="view-message text-right">شماره نامه وارده </td>
                <td class="view-message text-right"> </td>
            </tr>
            <?php
            $i = 1;
            if(isset($data['paged_result'])) {
                $paged_result = '';
                $paged_result = $data['paged_result'];
                $page = $paged_result['page'];
                $paged_item = $paged_result['paged_item'];
                $i=($page-1)*$paged_item+1;
            }
            foreach($letters as $row)
            {
                $tblLetterId='/0';
                if(isset($row['tblLetterId'])) $tblLetterId="/".$row['tblLetterId'];
                $showLetter=URL."letter/show/".$levelActive."/dabir/".$row['id']."/".$activemenu.$tblLetterId;
                $forwardLetter=URL."letter/forward_dabir/".$row['id']."/".$itemBox."/".$levelActive."/".$activemenu;
                $replyLetter=URL."letter/reply/".$levelActive."/".$itemBox."/".$row['id']."/".$activemenu;
                $addNumberLetter=URL."letter/addNumber/".$levelActive."/".$itemBox."/".$row['id']."/".$activemenu;
                $printLetter=URL."letter/printLetter/".$levelActive."/".$itemBox."/".$row['id']."/".$activemenu;
                $eprintLetter=URL."letter/eprintLetter/".$levelActive."/".$itemBox."/".$row['id']."/".$activemenu;
                $eprintLetterPreview=URL."letter/eprintLetterPreview/".$levelActive."/dabir/".$row['id']."/".$activemenu;
                $editLetter=URL."letter/edit/".$levelActive."/dabir/".$row['id']."/".$activemenu;
                $editLetterInput=URL."letter/editinput/".$levelActive."/dabir/".$row['id']."/".$activemenu;
                $cycleLetter=URL."letter/cycle/".$levelActive."/".$itemBox."/".$row['id']."/".$activemenu;
                ?>
                <tr class="<?php if(isset($row['read_status'])){if($row['read_status']==0 && $itemBox!='send' && $row['read_status']!='') echo "unread";}?>"> <!-- class="unread" !-->
                    <td><?=$this->en2fa($i);?></td>
                    <td class="view-message dont-show">
                        <?php
                        if($itemBox=='index' || $itemBox=='send'|| $itemBox=='intrnal')
                        {
                            echo $row['level_sender'];
                        }
                        else
                        {
                            echo $row['description'];
                        }
                        ?>
                    </td>
                    <td class="view-message">
                        <a href="<?= $showLetter;?>">
                            <?= $this->en2fa($row['subject']);?>
                        </a>
                    </td>
                  <!--  <td class="view-message"><?= $row['description'];?></td> !-->
                    <td class="view-message inbox-small-cells">
                        <?php
                        if($row['file'])
                            echo "<i class='icon-paper-clip'></i>";
                        ?>
                    </td>
                    <td class="view-message text-right"><?php
                        if($row['date_save']=='')
                            echo $this->en2fa($row['date_create']);
                        else
                            echo $this->en2fa($row['date_save']);
                        ?></td>
                    <td class="view-message text-right"><?php echo $this->en2fa($row['numLetter']);?></td>
                    <td class="view-message text-right"><?php echo $this->en2fa($row['date_number_input']);?></td>
                    <td>
                        <?php /* if($itemBox!='send' ) { ?>
                            <a class="mini tooltips" href="<?= $replyLetter; ?>" data-placement="top"
                               data-original-title="پاسخ دادن به نامه">
                                <i class="icon-mail-forward"></i>
                            </a>
                            <?php
                        }*/

                        if($row['input']==1 ) { ?>
                            <a class=" mini tooltips" href="<?= $editLetterInput; ?>" data-placement="top"
                               data-original-title="ویرایش نامه">
                                <i class="icon-pencil"></i></a>
                            <?php
                        }
                        elseif($row['status']<2 ) { ?>
                            <a class=" mini tooltips" href="<?= $editLetter; ?>" data-placement="top"
                               data-original-title="ویرایش نامه">
                                <i class="icon-pencil"></i></a>
                            <?php
                        }
                        ?>
                        <a class="mini tooltips" style="color: #3f51b5;" href="<?= $showLetter; ?>" data-placement="top" data-original-title="مشاهده نامه">
                            <i class="icon-eye-open"></i>
                        </a>
                        <a class=" mini tooltips" style="color: #9b633a;" href="<?= $cycleLetter; ?>" data-placement="top" data-original-title="نمایش چرخه نامه">
                            <i class="icon-retweet"></i>
                        </a>
                        <a class="mini tooltips" style="color: #a49404;" href="<?= $forwardLetter; ?>" data-placement="top" data-original-title="ارجاع نامه">
                            <i class="icon-mail-reply"></i>
                        </a>
                     <?php /*?>   <a class="mini tooltips" style="color: #3a3a3a;" target="_blank" href="<?= $printLetter; ?>" data-placement="top" data-original-title="چاپ نامه">
                            <i class="icon-print"></i>
                        </a><?php*/?>
                        <a class="mini tooltips" style="color: #1d34cb;"  target="_blank" href="<?= $eprintLetter; ?>" data-placement="top" data-original-title="چاپ نامه">
                            <i class="icon-print"></i>
                        </a>
                        <a class="mini tooltips" style="color: #1d34cb;"  target="_blank" href="<?= $eprintLetterPreview; ?>" data-placement="top" data-original-title="ویرایش قبل از چاپ">
                            <i class="icon-file-alt"></i>
                        </a>
                        <?php if(($itemBox=='index' ||$itemBox=='send') && ($row['numLetter']=='' && $row['date_signature']!='' && $row['status']==1)){?>
                        <a class="mini tooltips" style="color:#e70e10;"  href="<?=$addNumberLetter;?>"  data-placement="top" data-original-title="ثبت شماره نامه و ارسال">
                            <i class="icon-check"></i>
                        </a>
                        <?php } ?>
                    </td>
                </tr>
                <?php
                $i++;
            }
            if($i==1) echo "<tr><td colspan='7'>نتیجه ای یافت نشد</td></tr>";
            ?>
            </tbody>
        </table>
        <center>
            <?php
            if(isset($data['paged_result'])) {
                $paged_result = '';
                $paged_result = $data['paged_result'];
                $count = $paged_result['count'];
                $paged_item = $paged_result['paged_item'];
                $page = $paged_result['page'];
                $orderType = $paged_result['orderType'];
                $orderBy = $paged_result['orderBy'];
                $url_page = URL . "letter/dabirkhone/".$levelActive."/$itemBox?";
                if ($count - $paged_item > 0) {
                    //تعداد صفحات
                    $paged_total = ceil($count / $paged_item);
                    //صفحه آخر
                    $paged_last = $paged_total;
                    //صفحات میانی
                    $paged_middle = $page + 4;
                    //شروع صفحه بندی
                    $paged_start = $paged_middle - 4;

                    //ایجاد لینک صفحه نخست
                    if ($page > 1) {
                        //اگر صفحه درخواستی بزرگتر از 1 بود
                        $paged_result = '<div class="paged-link"><a href="' . $url_page . 'page=1" title="صفحه نخست">نخست</a></div>' . "\n";
                    } //غیر فعال کردن لینک صفحه نخست اگر صفحه درخواستی برابر 1 بود
                    else {
                        $paged_result = '<div class="paged-link-off">نخست</div>' . "\n";
                    }

                    //ایجاد لینک صفحه قبلی
                    if ($page > 1) {
                        //محاسبه لینک صفحه قبلی
                        $paged_perv = $page - 1;
                        //ایجاد لینک صفحه قبلی
                        $paged_result .= '<div class="paged-link"><a href="' . $url_page . 'page=' . $paged_perv . '" title="صفحه قبلی">قبلی</a></div>' . "\n";
                    } //غیر فعال کردن لینک صفحه قبلی اگر صفحه انتخابی برابر 1 بود
                    else {
                        $paged_result .= '<div class="paged-link-off">قبلی</div>' . "\n";
                    }

                    //ایجاد لینک صفحات میانی، شروع از دو شماره قبل
                    for ($i = $paged_start - 2; $i <= $paged_middle; $i++) {
                        //ایجاد لینک در صورتی که صفر، منفی یا از آخرین صفحه بیشتر نباشد
                        if ($i > 0 && $i <= $paged_last) {
                            //در حالت انتخاب شده
                            if ($i == $page) {
                                $paged_result .= '<div class="paged-link-selected"><a href="' . $url_page . 'page=' . $i . '" title="صفحه ' . $i . '">' . $this->en2fa($i) . '</a></div>' . "\n";
                            } //در حالت عادی
                            else {
                                $paged_result .= '<div class="paged-link"><a href="' . $url_page . 'page=' . $i . '" title="صفحه ' . $i . '">' . $this->en2fa($i) . '</a></div>' . "\n";
                            }
                        }
                    }

                    //نمایش لینک صفحات بعدی
                    if ($page <= $paged_last - 1) {
                        //محاسبه لینک صفحه بعدی
                        $paged_next = $page + 1;
                        //ایجاد لینک صفحه بعدی
                        $paged_result .= '<div class="paged-link"><a href="' . $url_page . 'page=' . $paged_next . '" title="صفحه بعدی">بعدی</a></div>' . "\n";
                    } //غیر فعال کردن لینک صفحه بعدی اگر صفحه انتخابی برابر صفحه آخر بود
                    else {
                        $paged_result .= '<div class="paged-link-off">بعدی</div>' . "\n";
                    }

                    //لینک صفحه آخر
                    if ($page <= $paged_last - 1) {
                        $paged_result .= '<div class="paged-link"><a href="' . $url_page . 'page=' . $paged_last . '" title="صفحه آخر">آخر</a></div>' . "\n";
                    } //غیر فعال کردن لینک صفحه آخر اگر صفحه انتخابی برابر صفحه آخر بود
                    else {
                        $paged_result .= '<div class="paged-link-off">آخر</div>' . "\n";
                    }

                    //اطلاعات صفحات
                    $paged_result .= '<div class="paged-link-info">&raquo; صفحه: ' . $this->en2fa($page) . ' از ' . $this->en2fa($paged_total) . ' |<b> تعداد کل:'.$this->en2fa($count).'</b></div>' . "\n";
                    //خروجی
                    echo $paged_result;
                }
            }
            ?>
        </center>
    </div>
</aside>
    </section>
</section>