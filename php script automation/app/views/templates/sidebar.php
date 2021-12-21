<?php
if(isset($data['user']) && !isset($data['print'])) {
    $user=$data['user'];
    $itemBox='';
    $activemenu=$data['activemenu'];
    if(isset($data['levelActive']))
        $levelActive = $data['levelActive'];
    else
        $levelActive = $user['levelInfo']['0']['id'];
    if(isset($data['itemBox']))$itemBox=$data['itemBox'];

    $itemDabir=0;
    foreach ($user['levelInfo'] as $levels)
    {
        $str='دبیرخانه';
        $semat=$levels['semat'];
        if(strstr($semat,$str) && $user['power']==2 && $levelActive==$levels['id'])
        {
            $itemDabir=1;
        }
    }
    ?>
    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu">
              <?php /*  <li class="<?php if($activemenu==1) echo "active"; ?> ">
                    <a class="" href="<?= URL; ?>letter/index">
                        <i class="icon-dashboard"></i>
                        <span>داشبورد</span>
                    </a>
                </li> */ ?>
                <li class=" <?php if($activemenu==2) echo "active"; ?> ">
                    <a href="<?= URL; ?>letter/index/<?= $levelActive;?>" class="">
                        <i class="icon-laptop"></i>
                        <span>کارتابل
                                <span id="letterReciveUnRead" class="label label-success pull-left" style="display: none"> </span>
                        </span>
                    </a>
                </li>
                <?php if($itemDabir==1) { ?>
                <li class="sub-menu <?php if($activemenu==3) echo "active"; ?> ">
                    <a href="javascript:;" class="">
                        <i class="icon-stackexchange"></i>
                        <span>دبیرخانه
                        </span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li <?php if($itemBox=='index') echo 'style="color:red"'; ?> >
                            <a href="<?= URL; ?>letter/dabirkhone/<?= $levelActive;?>/index"><i class="icon-book"></i>دفتر اندیکاتور
                            </a>

                        </li>
                        <li  <?php if($itemBox=='intrnal') echo 'style="color:red"'; ?> >
                            <a href="<?= URL; ?>letter/dabirkhone/<?= $levelActive;?>/intrnal"><i class="icon-external-link-sign"></i>نامه های داخلی
                            </a>
                        </li>
                        <li  <?php if($itemBox=='send') echo 'style="color:red"'; ?> >
                            <a href="<?= URL; ?>letter/dabirkhone/<?= $levelActive;?>/send"><i class="icon-external-link"></i>نامه های صادره
                            </a>
                        </li>
                        <li  <?php if($itemBox=='send') echo 'style="color:red"'; ?> >
                            <a href="<?= URL; ?>letter/dabirkhone/<?= $levelActive;?>/input"><i class="icon-download-alt"></i>نامه های وارده
                            </a>
                        </li>
                    </ul>
                </li>

                <?php } ?>
                <?php if($user['power']==3) { ?>
                    <li class="sub-menu <?php if($activemenu==4) echo "active"; ?> ">
                        <a href="javascript:;" class="">
                            <i class="icon-cogs"></i>
                            <span>مدیریت</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li><a class="" href="<?= URL; ?>account/index"><i class="icon-group"></i> مدیریت کاربران</a></li>
                            <li><a class="" href="<?= URL; ?>account/showLevel"><i class="icon-sitemap"></i>سلسله مراتب</a></li>
                            <li><a class="" href="<?= URL; ?>account/userlevel"><i class="icon-legal"></i> انتصاب پست</a></li>
                            <li><a class="" href="<?= URL; ?>account/dabirkhone"><i class="icon-book"></i> مدیریت دبیرخانه</a></li>
                        </ul>
                    </li>
                    <?php
                }        ?>
                <li class="sub-menu <?php if($activemenu==5) echo "active"; ?> ">
                    <a href="javascript:;" class="">
                        <i class="icon-cog"></i>
                        <span>حساب کاربری</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="<?= URL; ?>profile/edit"> <i class="icon-user"></i> مشاهده پروفایل</a>    </li>
                        <li><a class="" href="<?= URL; ?>profile/changepass"> <i class="icon-collapse-alt"></i>تغییر رمز عبور</a></li>
                    </ul>
                </li>
                <li class="sub-menu <?php if($activemenu==6) echo "active"; ?> ">
                    <a href="javascript:;" class="">
                        <i class="icon-book"></i>
                        <span>ابزار</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="<?= URL; ?>notepad/tel"> <i class="icon-phone"></i> مخاطبین</a></li>
                        <li><a class="" href="<?= URL; ?>notepad/work"> <i class="icon-tasks"></i> مدیریت کارها</a></li>
                    </ul>
                </li>

                <?php if($user['power']==3) { ?>
                    <li class="sub-menu <?php if ($activemenu == 7) echo "active"; ?> ">
                        <a href="<?= URL; ?>profile/setting" class="">
                            <i class="icon-gears"></i>
                            <span>تنظیمات عمومی</span>
                        </a>
                    </li>
                    <?php
                }
                ?>

                <?php if($user['power']==3) { ?>
                    <li class="sub-menu <?php if ($activemenu == 8) echo "active"; ?> ">
                        <a href="<?= URL; ?>profile/report" class="">
                            <i class="icon-gears"></i>
                            <span>گزارشات سامانه</span>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <li>
                    <a class="" href="<?= URL; ?>logout/index">
                        <i class="icon-signout"></i>
                        <span>خروج</span>
                    </a>
                </li>
            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
    <?php
}
?>