<?php
$letters=$data['letters'];
$itemBox=$data['itemBox'];
$levelActive=$data['levelActive'];
$activemenu=$data['activemenu'];
?>
<style>
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        border: 1px solid #888;
        width: 475px;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s
    }

    /* Add Animation */
    @-webkit-keyframes animatetop {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
    }

    @keyframes animatetop {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
    }

    /* The Close Button */
    .close {
        color: white;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-header {
        padding: 2px 16px;
        background-color: #5cb85c;
        color: white;
    }

    .modal-body {padding: 2px 16px;}

    .modal-footer {
        padding: 2px 16px;
        background-color: #5cb85c;
        color: white;
    }
</style>
<div id="myModal" class="modal">
    <div class="modal-content">
      <form action="<?= URL; ?>letter/answer" method="post">
        <div class="modal-header">
            <span class="close " style="float: left" >&times;</span>
            <h4>پاسخ نامه</h4>
        </div>
        <div class="modal-body" style="padding: 15px">
 <textarea  name="answer" id="answer" style="width: 440px;height:100px"></textarea>
            <input type="hidden" value="" name="letterId" id="letterId">
            <input type="hidden" value="" name="levelId" id="levelId">
        </div>
        <div class="modal-footer">
            <input type="submit"   class="btn btn-info" name="save" value="ذخیره">
        </div>
      </form>
    </div>
</div>

<script>
    var modal = document.getElementById('myModal');
    var span = document.getElementsByClassName("close")[0];
    function answerClick(letterId,levelId) {
        $("#letterId").val(letterId);
        $("#levelId").val(levelId);
        modal.style.display = "block";
    }
    span.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<aside class="lg-side">
    <div class="inbox-head" >
        <!-- <h3>نامه های دریافتی</h3> !-->
        <div class="mail-option">
            <div class="btn-group">
                <form class="position" action="<?=URL."letter/search/".$activeLevel."/".$itemBox."/".$activemenu;?>" method="post">
            جستجو در:<div class="input-append" >
                     <select name="type-search" class="sr-input" style="border-radius: 0px">
                         <option value="numLetter">شماره نامه</option>
                         <option value="subject">عنوان نامه</option>
                         <option value="levelId_create">فرستنده نامه</option>
                         <option value="levelId_signature">امضاء کننده نامه</option>
                         <option value="text">متن نامه</option>
                     </select>
                        <input type="text" name="search"  onchange="search()" placeholder="جستجوی نامه ..." class="sr-input">
                        <button type="submit" class="btn btn-primary" style="padding: 5px;"><i class="icon-search" style="font-size: 25px"></i></button>
                    </div>
                </form>
            </div>
            <!--<div class="btn-group">
                <a class="btn mini tooltips" onclick="refresh()" href="<?= URL; ?>letter/index/<?= $activeLevel;?>/<?= $itemBox;?>" data-toggle="dropdown" data-placement="top" data-original-title="بروزرسانی">
                    <i class=" icon-refresh"></i>
                </a>
            </div>
            <ul class="unstyled inbox-pagination">
                <li>
                    <a href="#" class="np-btn" >
                        <i class="icon-angle-right  pagination-right"></i>
                    </a>
                </li>
                <li><span>1 تا 10 از 12</span></li>
                <li>
                    <a href="#" class="np-btn">
                        <i class="icon-angle-left pagination-left"></i>
                    </a>
                </li>
            </ul>!-->
        </div>
    </div>
    <div class="inbox-body">

        <table class="table   table-hover">
            <tbody>
            <tr class="row_header">
                <td class="view-message dont-show">ردیف</td>
                <td class="view-message dont-show">فرستنده</td>
                <td class="view-message">عنوان</td>
                <td class="view-message"><?php
                    if($itemBox=="draft" || $itemBox=="send")
                        echo "توضیحات";
                    else if($itemBox=="index" || $itemBox=="archive")
                        echo "نوع ارجاع";
                    ?>
                </td>
                <td class="view-message inbox-small-cells">پیوست</td>
                <td class="view-message text-right">تاریخ </td>
                <td class="view-message text-right">شماره نامه </td>
                <td class="view-message text-center" style="width: 110px"> </td>
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
                $showLetter=URL."letter/show/".$activeLevel."/".$itemBox."/".$row['id']."/".$activemenu.$tblLetterId;
                $editLetter=URL."letter/edit/".$activeLevel."/".$itemBox."/".$row['id']."/".$activemenu;
                $forwardLetter=URL."letter/forward/".$activeLevel."/".$itemBox."/".$row['id']."/".$activemenu;
                $movetoarchive=URL."letter/movetoarchive/".$activeLevel."/".$itemBox."/".$row['id']."/".$activemenu;
                $deleteLetter=URL."letter/deleteLetter/".$activeLevel."/".$itemBox."/".$row['id']."/".$activemenu;
                $cycleLetter=URL."letter/cycle/".$activeLevel."/".$itemBox."/".$row['id']."/".$activemenu;
                ?>
                <tr class="<?php if($row['read_status']==0 && isset($row['read_status'])) echo "unread";?>"> <!-- class="unread" !-->
                    <td><?=$this->en2fa($i);?></td>
                    <td class="view-message dont-show"><?= $this->en2fa($row['level_sender']);?></td>
                    <td class="view-message">
                        <a href="<?= $showLetter;?>">
                            <?= $this->en2fa($row['subject']);?>
                        </a>
                    </td>
                    <td class="view-message"><?php
                        if($itemBox=="draft" || $itemBox=="send")
                            echo $row['description'];
                        else if($itemBox=="index" || $itemBox=="archive")
                            echo $row['forwardName'];
                        ?>
                    </td>
                    <td class="view-message inbox-small-cells">
                        <?php
                        if($row['file'])
                            echo "<i class='icon-paper-clip'></i>";
                            //echo "<a href='".URL."public/uploads/letters/".$row['id'].".".$row['filelink']."'>".$row['filename']."</a>";
                        ?>
                    </td>
                    <td class="view-message text-right"><?php
                        if($row['date_save']=='')
                            echo $this->en2fa($row['date_create']);
                        else
                            echo $this->en2fa($row['date_save']);
                        ?>
                    </td>
                    <td class="view-message text-right"><?= $row['numLetter'];?></td>
                    <td >
                        <?php if($row['status']<2) { ?>

                            <a class=" mini tooltips" style="color: #13125e;" href="<?= $editLetter; ?>" data-placement="top"
                               data-original-title="ویرایش نامه">
                                <i class="icon-pencil"></i></a>
                            <?php
                        }
                        ?>
                        <a class=" mini tooltips" style="color: #3f51b5;" href="<?= $showLetter; ?>" data-placement="top" data-original-title="مشاهده نامه">
                            <i class="icon-eye-open"></i>
                        </a>
                        <a class=" mini tooltips"  style="color: #9b633a;" href="<?= $cycleLetter; ?>" data-placement="top" data-original-title="نمایش چرخه نامه">
                            <i class="icon-retweet"></i>
                        </a>
                        <?php if($itemBox=='index' || $itemBox=='archive' ) {?>
                        <a class="mini tooltips" style="color: #4d9200;" onclick="answerClick(<?=$row['id'];?>,<?=$activeLevel;?>)"   data-placement="top" data-original-title="پاسخ نامه">
                            <i class="icon-share-alt"></i>
                        </a>
                        <?php } ?>
                        <a class="mini tooltips" style="color: #a49404;"  href="<?= $forwardLetter; ?>" data-placement="top" data-original-title="ارجاع نامه">
                            <i class="icon-mail-reply"></i>
                        </a>
                        <?php if($itemBox=='index' ) {?>
                        <a   class="mini tooltips"  style="color: #096e0e;" href="<?= $movetoarchive ?>" data-placement="top" data-original-title="بایگانی">
                            <i class="icon-archive"></i>
                        </a>
                        <?php } ?>
                        <?php if($itemBox=='draft') {?>
                        <a class=" mini tooltips" style="color: #ff0000;"  href="<?=$deleteLetter;?>" data-placement="top" data-original-title="حذف">
                            <i class="icon-trash"></i>
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
                $url_page = URL . "letter/index/".$levelActive."/$itemBox?";
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
<script>
    function search() {
        var form = $('form');
        form.submit();
    }
</script>

