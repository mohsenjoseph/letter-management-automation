<?php
$users = $data['users'];
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
                    <p  >  مدیریت کاربران</p>

                    <a class="btn btn-info" style="float: left; " onclick="submitFormMulti();">اجرای عملیات</a>
                    <select class="selectTag" name="action">
                        <option value="1">         تغییر به مدیر</option>
                        <option value="2">          تغییر به دبیرخانه </option>
                        <option value="3">       تغییر به کاربر عادی </option>
                        <option value="4">    حذف   </option>
                    </select>
                    <a href="adduser" class="btn btn-info" style="float: right;margin-left:15px; "  >   کاربر جدید  </a>
                    <script>
                        function submitFormMulti() {
                            var actionSelected = $('.selectTag option:selected').val();
                            var action = '';
                            if (actionSelected == 1) { action = 'changelevel1';   }
                            if (actionSelected == 2) {  action = 'changelevel2';  }
                            if (actionSelected == 3) {    action = 'changelevel3';  }
                            if (actionSelected == 4) {   action = 'delete';   }
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
                    <td class="view-message">تصویر پروفایل</td>
                    <td class="view-message">تصویر امضاء</td>
                    <td class="view-message">کد پرسنلی</td>
                    <td class="view-message">                    نام و نام خانوادگی</td>
                    <td class="view-message ">موبایل</td>
                    <td class="view-message ">تلفن</td>
                    <td class="view-message ">ایمیل</td>
                    <td class="view-message ">آدرس</td>
                    <td class="view-message ">نام کاربری</td>
                    <td class="view-message ">                    سطح دسترسی
                    </td>
                    <td class="view-message ">انتخاب </td>
                </tr>
                <?php
                $i = 1;
                foreach ($users as $row) {
                    ?>
                    <tr>
                        <td> <?= $i ?> </td>
                        <td >
                            <?php
                            if($row['userpic']!='' && $row['userpic']!=0) {
                                ?>
                                <a id="userpicprofile<?= $row['id']; ?>" onclick="showProfile('<?= URL; ?>public/uploads/<?= $row['id']; ?>/profile_<?= $row['userpic']; ?>.jpg',<?= $row['id']; ?>)"  >
                                    <img  style="width: 25px;height:25px;border-radius: 3px" src="<?= URL; ?>public/uploads/<?= $row['id']; ?>/profile_<?= $row['userpic']; ?>.jpg">
                                </a>
                                <a id="userpicprofileicon<?= $row['id']; ?>" onclick="delPic(<?= $row['id']; ?>)"   title="حذف تصویر پروفایل">
                                    <i class="icon-remove" STYLE="color:red"></i>
                                </a>
                                <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if($row['signaturepic']!='' && $row['signaturepic']!=0) {
                                ?>
                                <a  id="userpicsignature<?= $row['id']; ?>" onclick="showSignature('<?= URL; ?>public/uploads/<?= $row['id']; ?>/signature_<?= $row['signaturepic']; ?>.jpg',<?= $row['id']; ?>)" title="مشاهده امضاء">
                                    <img style="width: 25px;height:25px;border-radius: 3px" src="<?= URL; ?>public/uploads/<?= $row['id']; ?>/signature_<?= $row['signaturepic']; ?>.jpg">
                                </a>
                                <a  id="userpicsignatureicon<?= $row['id']; ?>" onclick="delSignature(<?= $row['id']; ?>)" title="حذف امضاء">
                                    <i class="icon-remove" STYLE="color:red"></i>
                                </a>
                                <?php
                            }
                            ?>
                        </td>
                        <td> <?= $row['code']; ?> </td>
                        <td> <?= $row['name']; ?>
                        <input type="hidden" id="nameUser<?= $row['id']; ?>" value=" <?= $row['name']; ?>">
                        </td>
                        <td> <?= $row['phone']; ?></td>
                        <td> <?= $row['tell']; ?></td>
                        <td> <?= $row['email']; ?></td>
                        <td> <?= $row['address']; ?></td>
                        <td> <?= $row['username']; ?></td>
                        <td> <?= $row['powerTitle'] ?> </td>
                        <td>
                            <input type="checkbox" name="id[]" value="<?= $row['id']; ?>">
                            <a class="mini tooltips" href="adduser/<?=$row['id'];?>"  data-placement="top" data-original-title="ویرایش"><i class="icon-edit"></i></a>
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
        width: 300px;
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
            <div class="modal-header">
                <span class="close " style="float: left" >&times;</span>
                <h4 id="titleSignature"></h4>
            </div>
            <div class="modal-body" style="padding: 15px">
               <img id="picsignature" src="" style="width: 232px;height:175px">
            </div>
        </form>
    </div>
</div>
<div id="myModalpro" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="closepro " style="float: left" >&times;</span>
            <h4 id="titleProfile"></h4>
        </div>
        <div class="modal-body" style="padding: 15px">
            <img id="picProfile" src="" style="width: 232px;height:175px">
        </div>
        </form>
    </div>
</div>
<script>

    var modal = document.getElementById('myModal');
    var span = document.getElementsByClassName("close")[0];
    function showSignature(linkPic,userId) {
        $("#picsignature").attr('src',linkPic);
        var nameUser = $("#nameUser"+userId).val();
        var tag= $('#titleSignature');
        tag.append('<span id="title_Signature_name">'+nameUser+'</span>');
        modal.style.display = "block";
    }
    span.onclick = function() {
        $('#title_Signature_name').remove();
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    var modalpro = document.getElementById('myModalpro');
    var spanpro = document.getElementsByClassName("closepro")[0];
    function showProfile(linkPic,userId) {
        $("#picProfile").attr('src',linkPic);
        var nameUser = $("#nameUser"+userId).val();
        var tag= $('#titleProfile');
        tag.append('<span id="title_Profile_name">'+nameUser+'</span>');
        modalpro.style.display = "block";
    }
    spanpro.onclick = function() {
        $('#title_Profile_name').remove();
        modalpro.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modalpro.style.display = "none";
        }
    }
    function delPic(userId)
    {
        var data = {'userId':userId};
        var url = "<?= URL;?>account/del_pic_profile";
        $.post(url,data,function(msg){
            if(msg==1)
            {
                alert('حذف تصویر پروفایل با موفقیت انجام شد');
                $("#userpicprofile"+userId).remove();
                $("#userpicprofileicon"+userId).remove();
            }
            else
            {
                alert('حذف تصویر پروفایل با خطا مواجه شد');
            }
        });
    }
    function delSignature(userId)
    {
        var data = {'userId':userId};
        var url = "<?= URL;?>account/del_signature";
        $.post(url,data,function(msg){
            if(msg==1)
            {
                alert('حذف تصویر امضاء با موفقیت انجام شد');
                $("#userpicsignature"+userId).remove();
                $("#userpicsignatureicon"+userId).remove();
            }
            else
            {
                alert('حذف تصویر امضاء با خطا مواجه شد');
            }
        });
    }

</script>