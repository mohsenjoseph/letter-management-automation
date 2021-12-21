<?php
$phones = $data['phones'];
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
        ?>
        <aside class="lg-side">
            <div class="inbox-head" >
                <div class="mail-option">
                    <div  >
        <p >
دفتر تلفن
        </p>

    <a class="btn btn-info" style="float: left; " onclick="submitFormMulti();">
        اجرای عملیات
    </a>

    <select class="selectTag" name="action">
        <option value="4">حذف</option>
    </select>
<a href="<?=URL;?>notepad/addtell" class="btn btn-info" style="float: right;margin-left:15px; ">مخاطب جدید</a>
    <script>
        function submitFormMulti() {
            var actionSelected = $('.selectTag option:selected').val();
            var action = '';
            if (actionSelected == 4) { action = 'delete'; }
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

            <table class="table-hover" border="1px" style="width:100%;border: 3px;border-color: #4d9200;">
                <tbody>
                <tr class="row_header" style="background-color: #e2e2e2">
                    <td rowspan="2"  style="text-align: center" >ردیف</td>
                    <td rowspan="2"  style="text-align: center"  >نام</td>
                    <td   colspan="4"  style="text-align: center" >اطلاعات تماس محل سکونت</td>
                    <td   colspan="6"  style="text-align: center" >اطلاعات تماس محل کار</td>
                    <td rowspan="2"   style="text-align: center" >توضیحات</td>
                    <td rowspan="2"  style="text-align: center"  >انتخاب</td>
                </tr>
                <tr class="row_header" style="text-align:center;background-color: #e2e2e2">
                    <td class="view-message"  style="text-align: center" >آدرس</td>
                    <td class="view-message" style="text-align: center" >موبایل</td>
                    <td class="view-message " style="text-align: center" >تلفن</td>
                    <td class="view-message " style="text-align: center" >ایمیل</td>
                    <td class="view-message" style="text-align: center" >نام شرکت</td>
                    <td class="view-message" style="text-align: center" >آدرس</td>
                    <td class="view-message" style="text-align: center" >فکس</td>
                    <td class="view-message " style="text-align: center" >تلفن</td>
                    <td class="view-message " style="text-align: center" >ایمیل</td>
                    <td class="view-message " style="text-align: center" >وب سایت</td>
                </tr>
                <?php
                $i = 1;
                foreach ($phones as $row) {
                    ?>
                    <tr style="text-align:center;background-color: #<?php if($i%2) echo ""; else echo "eaeaea";?>">
                        <td> <?= $i ?> </td>
                        <td> <?= $row['name']; ?>  </td>
                        <td> <?= $row['adres']; ?></td>
                        <td> <?= $row['mobile']; ?></td>
                        <td> <?= $row['tell']; ?></td>
                        <td> <?= $row['email']; ?></td>
                        <td> <?= $row['work_company']; ?>  </td>
                        <td> <?= $row['work_adres']; ?></td>
                        <td> <?= $row['work_fax']; ?></td>
                        <td> <?= $row['work_tell']; ?></td>
                        <td> <?= $row['work_email']; ?></td>
                        <td> <?= $row['work_website']; ?></td>
                        <td> <?= $row['description']; ?></td>
                        <td>
                            <input type="checkbox" name="id[]" value="<?= $row['id']; ?>">
                            <a class="mini tooltips" href="addtell/<?=$row['id'];?>"  data-placement="top" data-original-title="ویرایش"><i class="icon-edit"></i></a>
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