<?php
$user=$data['user'];
$option=$data['option'];
$letter=$data['letter'];
$letterId=$data['letterId'];
$levelActive=$data['levelActive'];
$sizePage='';
$header_page = $footer_page = '';
// echo "<pre>";
// print_r($option);
if($letter['print_size']==1)
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
    $header_page = $option['a4_print_Header_Page'];
    $countWord= $option['a4_print_countWord'];
    $space_letterNumber_top = $option['a4_print_letternumber_top'];
}
elseif($letter['print_size']==2)
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
    $header_page = $option['a5_print_Header_Page'];
    $countWord= $option['a5_print_countWord'];
    $space_letterNumber_top = $option['a5_print_letternumber_top'];
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
        @page {
            size   : <?=$sizePage;?> !important;  /* auto is the initial value */
            margin-top:<?= $topMargin;?> ;  !important;
            margin-right:<?= $rightMargin;?>  !important;
            margin-left:<?= $leftMargin;?>  !important;
            margin-bottom:<?= $bottomMargin;?>  !important;
        }
        @media print {
            @page
            {
                size   : <?=$sizePage;?> !important;  /* auto is the initial value */
                margin-top:<?= $topMargin;?> ;  !important;
                margin-right:<?= $rightMargin;?>  !important;
                margin-left:<?= $leftMargin;?>  !important;
                margin-bottom:<?= $bottomMargin;?>  !important;
            }
            html{
                margin: 0px !important;
            }
            body {
                background-image: url('<?=URL?>public/img/<?=$header_page;?>');
                background-position: top center;
                background-size: 100%;
                background-repeat: repeat-y ;
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
                margin-top:<?=$space_letterNumber_top;?>px;
            }
            .reciveCc{
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
        }
        body {
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
<body style=""   >
<div  class="content" id="content">
    <?php
    function limit_text($text, $start , $end) {
        if (str_word_count($text) > $end) {
            $words = explode(" ",$text);
            $textSend = [];
            $j=0;
            for ($i=$start;$i<($start+$end);$i++) {
                $textSend[$j] = $words[$i];
                $j++;
            }
            $text = implode(" ",$textSend);
        }
        return $text;
    }
    if($letter['text'] !=''){
        $wordCount = sizeof(explode(" ",strip_tags($letter['text'])));
        $end = $countWord;
        for($start=0;$start<=$wordCount;){
            if($start>0)
                echo '<span style="page-break-after: always;"></span><br>';
            ?>
            <div class="row " style="float:left;line-height: <?=$LineHeight?>px">
                <?php
                if($header_page != ''){
                    /*<img src='<?=URL?>public/<?=$header_page;?>' style="position: absolute;width: auto"> */
                    ?>
                    <div style="text-align:right;direction: rtl;width:<?= $numberLetterLeftSpace; ?>px;">
                        شماره:              <?php if (isset($letter['numLetter'])) echo $letter['numLetter']; ?>
                        <br>
                        تاریخ:                <?php if (isset($letter['date_numLetter'])) echo $letter['date_numLetter']; ?>
                        <br>
                        پیوست: <?php if ($letter['file'] == 1) echo "دارد"; else echo 'ندارد';?>
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
            <?php
            if($start==0) {
                echo "<p>";$line=0;
                foreach ( $letter['userRecive'] as $userRCVD) {
                    if($line > 0) echo "<br>";
                    echo $userRCVD['recive_semattop']." ".$userRCVD['recive_name']."";
                    $line++;
                }
                echo "</p>";
            }
                $print = '';
            $print = limit_text($letter['text'],$start,$end);
            echo $print;
            $start=$start+$end;
        }
    }
    ;?>

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
    <div class="reciveCc" id="reciveCc" >
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