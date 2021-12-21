<?php
$option=$data['option'];
$print_size=$data['print_size'];
$signatureId=$data['signatureId'];
$text=$data['text'];
$sizePage='';
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
<body >
<div  class="content" id="content">
    <?= $text;?>
</div>
<?php
if($signatureId!='') {
    $signatureInfo = $data['signatureInfo'];
    $signature_name = $signatureInfo['name'];
    $signature_semat = $signatureInfo['semat'];
    $userId = $signatureInfo['userId'];
    $w=$h='';
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
                     src="<?= URL; ?>public/uploads/signature_<?= $row['signaturepic']; ?>.jpg">
            </p>
            <p class="signature-name" id="signature-name">
               <b> <?= $signature_name; ?>
                <br>
                <?= $signature_semat; ?>
				</b>
            </p>
        </div>
    </div>
    <?php
}

 if(isset($data['reciveCc']) && sizeof(array_filter($data['reciveCc']))>=1) {
?>
     <div style="width:100$;margin-top: -<?= $spaceCC;?>px"></div>
<div class="reciveCc" id="reciveCc">
    <ul style="padding-right: 0px;"><b>رونوشت:</b>
<?php            $j = 0;
            foreach ($data['reciveCc'] as $useruserCc) {
                if (sizeof($useruserCc)==1) {
                    ?>
                    <li style="padding-right: 10px;list-style-type: none">-
                        <?= $useruserCc ; ?>
                    </li>
                    <?php
                }
                else
                {
                    ?>
                    <li style="padding-right: 10px;list-style-type: none">-
                        <?php echo $useruserCc['name'] . " - " . $useruserCc['semat'] . " "; ?>
                    </li>
                    <?php
                }
                $j++;
            }
?>

    </ul>
</div>
<?php        }
        ?>
<script>
   window.print();
</script>
</body>
</html>