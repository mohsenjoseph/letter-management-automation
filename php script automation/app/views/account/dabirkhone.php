<?php
$dabirkhones = $data['dabirkhones'];

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
                            مدیریت دبیرخانه ها
                        </p>
                        <a class="btn btn-info" style="float: left; " onclick="submitFormMulti();">
                            اجرای عملیات
                        </a>

                        <select class="selectTag" name="action">
                            <option value="1"> حذف  </option>
                        </select>
                        <a href="addDabirkhone" class="btn btn-info" style="float: right;margin-left:15px; "  >
                            دبیرخانه جدید        </a>
                        <script>
                            function submitFormMulti() {
                                var actionSelected = $('.selectTag option:selected').val();
                                var action = '';
                                if (actionSelected == 1) {
                                    action = 'deleteDabir';
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

                    <table class="table   table-hover">
                        <tbody>
                        <tr class="row_header">
                            <td class="view-message ">ردیف</td>
                            <td class="view-message">نام دبیرخانه</td>
                            <td class="view-message">حرف شماره نامه وارده</td>
                            <td class="view-message">حرف شماره نامه داخلی</td>
                            <td class="view-message">حرف شماره نامه صادره</td>
                            <td class="view-message">شماره نامه آغازین</td>
                            <td class="view-message">پست انتصاب داده شده</td>
                            <td class="view-message ">انتخاب </td>
                        </tr>
                        <?php
                        $i = 1;
                        foreach ($dabirkhones as $row) {
                            ?>
                            <tr>
                                <td> <?= $i ?> </td>
                                <td> <?= $row['name']; ?> </td>
                                <td> <?= $row['middel_letter_in']; ?> </td>
                                <td> <?= $row['middel_letter_internal']; ?> </td>
                                <td> <?= $row['middel_letter_out']; ?> </td>
                                <td> <?= $row['startNumberLetter']; ?> </td>
                                <td> <?= $row['info']; ?>  </td>
                                <td>
                                    <input type="checkbox" name="id[]" value="<?= $row['id']; ?>">
                                    <a href="addDabirkhone/<?=$row['id'];?>"><i class="icon-edit"></i></a>
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