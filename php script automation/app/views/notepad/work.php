<?php
$works = $data['works'];
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
        ?>        <aside class="lg-side">
            <div class="inbox-head" >
                <div class="mail-option">
                    <div  >
        <p >
مدیریت کارها        </p>

    <a class="btn btn-info" style="float: left; " onclick="submitFormMulti();">
        اجرای عملیات
    </a>

    <select class="selectTag" name="action">
        <option value="4">حذف</option>
    </select>
<a href="<?=URL;?>notepad/addwork" class="btn btn-info" style="float: right;margin-left:15px; ">کار جدید</a>
    <script>
        function submitFormMulti() {
            var actionSelected = $('.selectTag option:selected').val();
            var action = '';
            if (actionSelected == 4) { action = 'deletework'; }
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

            <table class="table   table-hover">
                <tbody>
                <tr class="row_header">
                    <td class="view-message ">ردیف</td>
                    <td class="view-message">عنوان</td>
                    <td class="view-message">شرح</td>
                    <td class="view-message">تاریخ انجام</td>
                    <td class="view-message ">وضعیت</td>
                    <td class="view-message ">انتخاب </td>
                </tr>
                <?php
                $i = 1;
                foreach ($works as $row) {
                    ?>
                    <tr>
                        <td> <?= $i ?> </td>
                        <td> <?= $row['subject']; ?>  </td>
                        <td> <?= $row['description']; ?></td>
                        <td> <?= $row['date_end']; ?></td>
                        <td> <?php
                            switch($row['status'])
                            {
                                case '1': echo "عادی"; break;
                                case '2': echo "زمان محدود"; break;
                                case '3': echo "فوری"; break;
                                case '4': echo "انجام شده"; break;
                            }
                            ?></td>

                        <td>
                            <input type="checkbox" name="id[]" value="<?= $row['id']; ?>">
                            <a class="mini tooltips" href="addwork/<?=$row['id'];?>"  data-placement="top" data-original-title="ویرایش"><i class="icon-edit"></i></a>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
             ?>
                </tbody>
            </table>
        </div>
    </form>
        </aside>

    </section>
</section>