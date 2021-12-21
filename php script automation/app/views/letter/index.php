<?php
$user=$data['user'];
$letters=$data['letters'];
$sum=$data['counterLetter'];
if(isset($data['message'])) $message=$data['message'];
if(isset($data['levelActive'])) {
    $activeLevel=$data['levelActive'];
}
else {
    $activeLevel = $user['levelInfo'][0]['id'];
}
$itemBox=$data['itemBox'];
?>
<section id="main-content">
    <section class="wrapper">
        <?php //require_once ('top-state.php'); ?>
        <!--mail inbox start-->
        <?php if(isset($data['message'])) {
            if($data['message']!='') {
                ?>

                <div class="alert alert-success alert-dismissable">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <?= @$message; ?>
                </div>
                <?php
            }
        }
        ?>
        <div class="mail-box">
            <aside class="sm-side">
                <div class="user-head">
                    <a href="javascript:;" class="inbox-avatar">
                        <img style="width:55px;height:55px" src="<?= URL; ?>public/uploads/<?= $user['id'];?>/profile_<?= $user['userpic']; ?>.jpg" alt="">
                    </a>
                    <div class="user-name">
                        <h5><a href="#"><?= $user['name']; ?></a></h5>
                        <br>
                        <span>
                            <form action="" method="post">
                                <select   name="post_level" id="post_level" onchange="changeLevel()" class="dropdown" style="width:140px;ax-width: 140px">
                        <?php
                        $userDabirKhaneh=0;
                        foreach ($user['levelInfo'] as $levelInfo) {
                            if($levelInfo['semat']=='دبیرخانه') $userDabirKhaneh=$levelInfo['id'];
                            if($activeLevel==$levelInfo['id']) $selected="selected='selected'";
                            else
                                $selected='';
                            ?>
                            <option value='<?= $levelInfo['id'] ?>' <?= $selected; ?> > <?= $levelInfo['semat'];?> </option>
                            <?php
                        }
                        ?>
                                </select>
                            </form>
                        </span>
                    </div>

                </div>
                <div class="inbox-body">
                    <a class="btn btn-compose"  href="<?= URL; ?>letter/create/<?= $activeLevel;?>">نامه جدید</a>

                </div>
                <ul class="inbox-nav inbox-divider">
                    <li <?php if($itemBox=='index') echo 'class="active"'; ?> >
                        <a href="<?= URL; ?>letter/index/<?= $activeLevel;?>/index"><i class="icon-envelope-alt"></i>نامه های دریافتی
                            <?php if($sum['ReciveUnRead']>0){ ?>
                                <span class="label label-danger pull-left"><?= $this->en2fa($sum['ReciveUnRead']); ?></span>
                            <?php } ?>
                        </a>
                    </li>
                    <li  <?php if($itemBox=='send') echo 'class="active"'; ?> >
                        <a href="<?= URL; ?>letter/index/<?= $activeLevel;?>/send"><i class="icon-edit-sign"></i>نامه های ارسالی
                        </a>
                    </li>
                    <li  <?php if($itemBox=='draft')echo 'class="active"'; ?> >
                        <a href="<?= URL; ?>letter/index/<?= $activeLevel;?>/draft"><i class=" icon-edit"></i>پیش نویس
                            <?php if($sum['Draft']>0){ ?>
                            <span class="label label-success pull-left"><?= $this->en2fa($sum['Draft']); ?></span>
                            <?php } ?>
                        </a>
                    </li>
                    <li  <?php if($itemBox=='archive')echo 'class="active"'; ?> >
                        <a href="<?= URL; ?>letter/index/<?= $activeLevel;?>/archive"><i class=" icon-archive"></i>بایگانی
                            <?php if($sum['archiveUnread']>0){ ?>
                                <span class="label label-success pull-left"><?= $this->en2fa($sum['archiveUnread']); ?></span>
                            <?php } ?>
                         </a>
                    </li>
                </ul>


            </aside>
            <script>
                function changeLevel() {
                    levelId=$('#post_level').val();
                    url='<?=URL;?>/letter/index/'+levelId+'/index';
                    var form = $('form');
                    form.attr('action', url);
                    form.submit();
                }
            </script>
<?php require_once 'inbox.php'; ?>

        </div>
        <!--mail inbox end-->
    </section>

</section>
<!--main content end-->


