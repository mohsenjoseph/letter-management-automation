<?php
if(isset($data['user']) && !isset($data['print']) ) {
    $user = $data['user'];
    if(isset($data['levelActive']))
        $levelActive = $data['levelActive'];
    else
        $levelActive = $user['levelInfo']['0']['id'];
    ?>
    <header class="header white-bg">
        <div class="sidebar-toggle-box">
            <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
        </div>
        <a href="#" class="logo"><?= SITE_TITLE ?></a>
        <?php  ?>

        <div class="nav notify-row" id="top_menu">
            <ul class="nav top-menu">
                <li id="noNumberLetterShow" class="dropdown" style="display: none">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon-stackexchange"></i>
                        <span class="badge bg-important"  id="noNumberLetterTop" ></span>
                    </a>
                    </a>
                    <ul class="dropdown-menu extended inbox">
                        <div class="notify-arrow notify-arrow-green"></div>
                        <li>
                            <p class="green">
                                <span  id="noNumberLetterInternal" ></span>
نامه جدید داخلی
                            </p>
                        </li>
                        <li>
                            <p class="red">
                                <span  id="noNumberLetterSend" ></span>
                                نامه جدید ارسالی
                            </p>
                        </li>
                        <li class="external left">
                            <a href="<?= URL; ?>letter/dabirkhone/<?= $levelActive;?>/index">مشاهده دبیرخانه</a>
                        </li>
                        <script>
                            chknoNumberLetter();
                            function chknoNumberLetter() {
                                var data = {'levelId':<?=$levelActive;?>};
                                var url = "<?=URL;?>letter/noNumberLetter";
                                $.post(url,data,function (msg) {
                                    var number=msg.split('||');
                                    var numberInternal=number[0];
                                    var numberSend=number[1];
                                    var totalnumber=parseInt(numberSend)+parseInt(numberInternal);
                                    if(totalnumber>0) {
                                        $("#NumberLetterTop").remove();
                                        $("#NumberLetterInternal").remove();
                                        $("#NumberLetterSend").remove();
                                        var msgTop="<span id='NumberLetterTop' >" + totalnumber + "</span>";
                                        var msgInternal="<span id='NumberLetterInternal' >(" + numberInternal + ")</span>";
                                        var msgSend="<span id='NumberLetterSend' >(" + numberSend + ")</span>";
                                        $('#noNumberLetterShow').css('display', 'inline');
                                        $('#noNumberLetterTop').append(msgTop);
                                        $('#noNumberLetterInternal').append(msgInternal);
                                        $('#noNumberLetterSend').append(msgSend);
                                    }
                                    else
                                        $('#noNumberLetterBottom').css('display', 'none');
                                });
                            }
                            timedFunctionDabir();
                            function timedFunctionDabir() {
                                setTimeout(function(){
                                    chknoNumberLetter();
                                }, 3000);
                                setTimeout(function(){ timedFunctionDabir() }, 3100);
                            }
                        </script>
                    </ul>
                </li>
                <li class="dropdown" id="ReciveUnReadShow" style="display:none;" >
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon-laptop"></i>
                        <span class="badge bg-warning" id="ReciveUnReadTop"></span>
                    </a>
                    <ul class="dropdown-menu extended tasks-bar">
                        <div class="notify-arrow notify-arrow-yellow"></div>
                        <li>
                            <p class="yellow">
                                <span  id="ReciveUnReadBottom" ></span>
                                نامه خوانده نشده دارید
                            </p>
                        </li>
                        <li class="external left">
                            <a href="<?= URL; ?>letter/index/<?= $levelActive;?>">مشاهده کارتابل</a>
                        </li>
                        <script>
                            chkRecivLetterUnRead();
                            function chkRecivLetterUnRead() {
                                var data = {'levelId':<?=$levelActive;?>};
                                var url = "<?=URL;?>letter/counterLetterRecive";
                                $.post(url,data,function (msg) {
                                    if(msg>0) {
                                        $("#numReciveUnReadTop").remove();
                                        $("#numReciveUnReadBottom").remove();
                                        var msgTop="<span id='numReciveUnReadTop' >" + msg +"</span>";
                                        var msgBottom="<span id='numReciveUnReadBottom' >" + msg +"</span>";
                                        $("#ReciveUnReadTop").append(msgTop);
                                        $("#ReciveUnReadBottom").append(msgBottom);
                                        $('#ReciveUnReadShow').css('display', 'inline');
                                    }
                                    else
                                        $('#ReciveUnReadShow').css('display', 'none');
                                });
                            }
                            timedFunction();
                            function timedFunction() {
                                setTimeout(function(){chkRecivLetterUnRead();},3000);
                                setTimeout(function(){ timedFunction() }, 3100);
                            }
                        </script>                        
                    </ul>
                </li>
                <li class="dropdown" id="numberWorkTodayShow" style="display:none ">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon-tasks"></i>
                        <span class="badge bg-success" id="numberWorkTodayTop"></span>
                    </a>
                    <ul class="dropdown-menu extended tasks-bar">
                        <div class="notify-arrow notify-arrow-green"></div>
                        <li>
                            <p class="green">شما
                                <span id="numberWorkTodayBottom"></span>
                                 کار باید انجام دهید</p>
                        </li>
                        <li class="external left">
                            <a href="<?= URL; ?>notepad/work">مشاهده لیست کارها</a>
                        </li>
                        <script>
                            chkWorkToday();
                            function chkWorkToday() {
                                var data = {};
                                var url = "<?=URL;?>notepad/numWorkToday";
                                $.post(url,data,function (msg) {
                                    if(msg>0) {
                                        $("#numWorkTodayTop").remove();
                                        $("#numWorkTodayBottom").remove();
                                        var msgTop="<span id='numWorkTodayTop' >" + msg +"</span>";
                                        var msgBottom="<span id='numWorkTodayBottom' >" + msg +"</span>";
                                        $("#numberWorkTodayTop").append(msgTop);
                                        $("#numberWorkTodayBottom").append(msgBottom);
                                        $('#numberWorkTodayShow').css('display', 'inline');
                                    }
                                    else
                                        $('#numberWorkTodayShow').css('display', 'none');

                                });
                            }
                            timeWork();
                            function timeWork() {
                                setTimeout(function(){chkWorkToday();},3000);
                                setTimeout(function(){ timeWork() }, 3100);
                            }
                        </script>
                    </ul>
                </li>
            </ul>
        </div> <?php ?>
        <div class="top-nav ">
            <!--search & user info start-->
            <ul class="nav pull-right top-menu">
                <!--<li>
                    <input type="text" class="form-control search" placeholder="Search">
                </li>!-->
                <!-- user login dropdown start-->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <img alt="" style="width:30px;height:30px;border-radius: 3px" src="<?= URL; ?>public/uploads/<?= $user['id']; ?>/profile_<?= $user['userpic']; ?>.jpg">
                        <span class="username"><?= $user['name']; ?></span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <div class="log-arrow-up"></div>
                        <li><a href="<?= URL; ?>profile/profile.php"><i class=" icon-suitcase"></i>مشاهده پروفایل</a></li>
                        <?php if($user['power']>2){?>
                            <li><a href="<?= URL; ?>profile/setting.php"><i class="icon-cog"></i> تنظیمات</a></li>
                        <?php }?>
                        <li><a href="<?= URL; ?>profile/changepass.php"><i class="icon-wrench"></i> تغییر رمز</a></li>
                        <li><a href="<?= URL; ?>logout/index"><i class="icon-signout"></i> خروج</a></li>
                    </ul>
                </li>
                <!-- user login dropdown end -->
            </ul>
            <!--search & user info end-->
        </div>
    </header>
    <?php
}
?>