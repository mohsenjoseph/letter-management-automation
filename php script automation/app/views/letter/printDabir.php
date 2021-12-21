<?php
$user=$data['user'];
$option=$data['option'];
$letter=$data['letter'];
$letterId=$data['letterId'];
$levelActive=$data['levelActive'];
$text=$data['text'];
$print_size=$data['print_size'];
$sizePage='';
$header_page = $footer_page = '';
if($print_size==1)
{
    $topMargin=$option['a4_top_print_margin'].'mm';
    $bottomMargin=$option['a4_bottom_print_margin'].'mm';
    $leftMargin=$option['a4_left_print_margin'].'mm';
    $rightMargin=$option['a4_right_print_margin'].'mm';
    $numberLetterLeftSpace=$option['a4_print_space_numberletter'];
    $LineHeight=$option['a4_print_line_height'];
    $lineSpaceNumberStart=$option['a4_print_space_number_start'];
    $sizePage='A4';
    $fontSize=$option['a4_print_size_font'];
    $spaceCC=$option['a4_print_spaceCC'];
    $header_page = $option['Header_Page_A4'];
    $footer_page= $option['Footer_Page_A4'];
}
elseif($print_size==2)
{
    $topMargin=$option['a5_top_print_margin'].'mm';
    $bottomMargin=$option['a5_bottom_print_margin'].'mm';
    $leftMargin=$option['a5_left_print_margin'].'mm';
    $rightMargin=$option['a5_right_print_margin'].'mm';
    $numberLetterLeftSpace=$option['a5_print_space_numberletter'];
    $LineHeight=$option['a5_print_line_height'];
    $lineSpaceNumberStart=$option['a5_print_space_number_start'];
    $sizePage='A5';
    $fontSize=$option['a5_print_size_font'];
    $spaceCC=$option['a5_print_spaceCC'];
    $header_page = $option['Header_Page_A5'];
    $footer_page= $option['Footer_Page_A5'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>اتوماسیون اداری کوثـر</title>
    <style>
        @import url(http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic);
        @font-face {
            font-family: 'yekan';
            src: url('<?=URL;?>public/fonts/Yekan-modified.eot');
            src: url('<?=URL;?>public/fonts/Yekan-modified.eot#iefix') format('embedded-opentype'),
            url('<?=URL;?>public/fonts/Yekan-modified.woff') format('woff'),
            url('<?=URL;?>public/fonts/Yekan-modified.ttf') format('truetype'),
            url('<?=URL;?>public/fonts/Yekan-modified.svg#CartoGothicStdBook') format('svg');
            font-weight: normal;
            font-style: normal;
        }
        @page
        {
            size   : <?=$sizePage;?> !important;  /* auto is the initial value */
            margin-top:<?= $topMargin;?>  !important;
            margin-right:<?= $rightMargin;?>  !important;
            margin-left:<?= $leftMargin;?>  !important;
            margin-bottom:<?= $bottomMargin;?>  !important;
        }
        @media print {
            @page
            {
                size   : <?=$sizePage;?> !important;  /* auto is the initial value */
                margin-top:<?= $topMargin;?>  !important;
                margin-right:<?= $rightMargin;?>  !important;
                margin-left:<?= $leftMargin;?>  !important;
                margin-bottom:<?= $bottomMargin;?>  !important;
            }
            html{
                background-color : #FFFFFF !important;
                margin           : 0px !important;
            }
            body {
                background:white;
                margin-top:<?= $topMargin;?>  !important;
                margin-right:<?= $rightMargin;?>  !important;
                margin-left:<?= $leftMargin;?>  !important;
                margin-bottom:<?= $bottomMargin;?>  !important;
                font-family: 'B NAZANIN';

            }
            .content{
                font-size: <?=$fontSize;?>pt;
                font-weight: normal;
                line-height: <?=$LineHeight;?>px;
                direction: rtl;
                text-align: justify;
            }
            .reciveCc{
                font-size: <?=$fontSize;?>pt;
                line-height: <?=$LineHeight?>px;
                font-weight: normal;
                padding: 5px;
                padding-top:150px;
                direction: rtl
            }
            #signature{
                z-index:5;
            }
            #signature-name{
                z-index: 3;
                margin-top:-180px;
                text-align:center;
                left: 50px;
            }
        }
        body {
            background:white;
            margin-top:<?= $topMargin;?>;
            margin-right:<?= $rightMargin;?>;
            margin-left:<?= $leftMargin;?>;
            margin-bottom:<?= $bottomMargin;?>;
            font-family: 'B NAZANIN';
        }
        #content{
            font-size: <?=$fontSize;?>pt;
            font-weight: normal;
            line-height: <?=$LineHeight?>px;
            direction: rtl;
            text-align: justify;
        }
        #reciveCc{
            font-size: <?=$fontSize;?>pt;
            line-height: <?=$LineHeight?>px;
            font-weight: normal;
            padding: 5px;
            padding-top:150px;
            direction: rtl;
        }
        #signature{
            z-index:5;
        }
        #signature-name{
            z-index: 3;
            margin-top:-180px;
            text-align:center;
            left: 50px;
        }
    </style>
</head>
<body   >
    <div class="row " style="float:left;line-height: <?=$LineHeight?>px">
        <?php if($header_page != ''){
            ?>
            <div style="text-align:right;direction: rtl;width:<?= $numberLetterLeftSpace; ?>px;">
                شماره: <?php if (isset($letter['numLetter'])) echo $letter['numLetter']; ?>
                <br>
تاریخ:                <?php if (isset($letter['date_numLetter'])) echo $letter['date_numLetter']; ?>
                <br>
                پیوست:<?php if ($letter['file'] == 1) echo "دارد"; else echo 'ندارد';?>
            </div>

            <?php
        }
        else {
            ?>
            <div style="text-align:right;direction: rtl;width:<?= $numberLetterLeftSpace; ?>px;">
                <?php if (isset($letter['numLetter'])) echo $letter['numLetter']; ?>
                <br>
                <?php if (isset($letter['date_numLetter'])) echo $letter['date_numLetter']; ?>
                <br>
                <?php if ($letter['file'] == 1) echo "دارد";  else echo 'ندارد';?>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="row" style="line-height: <?= ($lineSpaceNumberStart);?>" >
            <div class="col-lg-12 col-md-12"   >
                <br>
            </div>
    </div>
    <div  class="content" id="content">
       <?= @$text;?>
    </div>
    <?php
    $w=$h='';
    if($letter['signature_name']!='') {
    if ($sizePage == 'A4')
    {
        $w = '232px';
        $h = '175px';
    }
    elseif ($sizePage == 'A5')
    {
        $w = '190px';
        $h = '150px';
    }
    ?>
        <div class="row "style="padding: 5px;">
            <div class="left" style="width: <?php echo $w;?>;float:left;left:50px;"  >
                <p class="signature" id="signature" >
                    <img style="width: <?php echo $w;?>;height:<?php echo $h;?>"
                         src="<?=URL;?>public/uploads/<?= @$letter['signature_userId'];?>/signature_<?= @$letter['signaturepic']; ?>.jpg">
                </p>
                <p class="signature-name" id="signature-name" >
                   <b> <?= @$letter['signature_name'];?>
                <br>
                       <?= @$letter['signature_semat'];?>
					   </b>
                </p>
            </div>
        </div>
        <?php
    }

    $levelId_Cc =array_filter(explode(',', $letter['levelId_Cc']));
    if(isset($letter['userCc']) && sizeof($levelId_Cc)>0) {
    ?>
    <div style="width:100$;margin-top: -<?= $spaceCC;?>px"></div>
    <div class="reciveCc" id="reciveCc">
        <ul style="padding: 0"><b>رونوشت:</b>
            <?php
                $j = 0;
                foreach ($letter['userCc'] as $useruserCc) {
                    if ($useruserCc['cc_level'] != $levelId_Cc[$j] && $useruserCc['cc_level'] == '') {
                        ?>
                        <li style="padding-right: 10px;list-style-type: none">-
                            <?= $levelId_Cc[$j] ; ?>
                        </li>
                        <?php
                    }
                    else
                    { ?>
                        <li style="padding-right: 10px;list-style-type: none">-
                            <?php echo $useruserCc['cc_name'] . " - " . $useruserCc['cc_semat'] . " "; ?>
                        </li>
                        <?php
                    }
                    $j++;
                }
            ?>
        </ul>
    </div>
    <?php
    }
    ?>
   <script>
        window.print();
   </script>
</body>
</html>