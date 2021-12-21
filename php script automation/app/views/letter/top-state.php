<!--state overview start-->
<div class="row state-overview">
    <div class="col-lg-3 col-sm-6">
        <section class="panel">
            <div class="symbol terques">
                <i class="icon-folder-open"></i>
            </div>
            <div class="value">
                <h1><?= ($sum['total']);?></h1>
                <p>تعداد کل نامه های من</p>
            </div>
        </section>
    </div>
    <div class="col-lg-3 col-sm-6">
        <section class="panel">
            <div class="symbol red">
                <i class="icon-envelope-alt"></i>
            </div>
            <div class="value">
                <h1><?= $sum['sumRecive'];?></h1>
                <p>تعداد نامه دریافتی</p>
            </div>
        </section>
    </div>
    <div class="col-lg-3 col-sm-6">
        <section class="panel">
            <div class="symbol yellow">
                <i class="icon-edit-sign"></i>
            </div>
            <div class="value">
                <h1><?= $sum['sumCreate'];?></h1>
                <p>تعداد نامه ارسالی</p>
            </div>
        </section>
    </div>
    <div class="col-lg-3 col-sm-6">
        <section class="panel">
            <div class="symbol blue">
                <i class="icon-archive"></i>
            </div>
            <div class="value">
                <h1><?= $sum['sumArchive'];?></h1>
                <p>تعداد نامه های بایگانی</p>
            </div>
        </section>
    </div>
</div>
<!--state overview end-->