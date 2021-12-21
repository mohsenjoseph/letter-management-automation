<?php
$report=$data['report'];
$itemBox=$data['itemBox'];
$levelActive=$data['levelActive'];
$activemenu=$data['activemenu'];
?>
<section id="main-content">
    <section class="wrapper" style="  padding-right:10px;">
<aside class="lg-side">
    <div class="inbox-body">

        <table class="table   table-hover">
            <tbody>
            <tr class="row_header" style="background-color: #0f74a8;color: #0d0d0d;">
                <td class="view-message dont-show">ردیف</td>
                <td class="view-message dont-show">کاربر</td>
                <td class="view-message">نامه</td>
                <td class="view-message">نوع عملیات</td>
                <td class="view-message inbox-small-cells">زمان</td>
                <td class="view-message text-right">توضیحات</td>
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
            foreach($report as $row)
            {
                $showUser=URL."account/adduser/".$row['user_id'];
                ?>
                <tr >
                    <td><?=$this->en2fa($i);?></td>
                    <td class="view-message">
                        <a href="<?=$showUser;?>" target="_blank">
                            <?= $this->en2fa($row['user_name']);?>
                        </a>
                    </td>
                    <td class="view-message"><?= $this->en2fa($row['letter_subject']);?></td>
                    <td class="view-message"><?= $this->en2fa($row['action_type']);?></td>
                    <td class="view-message">
                        <?= $this->en2fa(model::MiladiTojalili(date("Y/m/d H:i:s",$row['date_action'])))." | ".$this->en2fa(date("H:i:s",$row['date_action']));?>
                    </td>
                    <td class="view-message"><?= $this->en2fa($row['comment']);?></td>
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
                $url_page = URL . "profile/report/".$levelActive."/$itemBox?";
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
    </section>
</section>
