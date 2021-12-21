<?php
if(!isset($data['print'])) {
?>
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="<?= URL ?>public/js/jquery.js"></script>
<script src="<?= URL ?>public/js/jquery-1.8.3.min.js"></script>
<script src="<?= URL ?>public/js/bootstrap.min.js"></script>
<script src="<?= URL ?>public/js/jquery.scrollTo.min.js"></script>
<script src="<?= URL ?>public/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?= URL ?>public/js/jquery.sparkline.js" type="text/javascript"></script>
<script src="<?= URL ?>public/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="<?= URL ?>public/js/owl.carousel.js" ></script>
<script src="<?= URL ?>public/js/jquery.customSelect.min.js" ></script>

<!--common script for all pages-->
<script src="<?= URL ?>public/js/common-scripts.js"></script>

<!--script for this page-->
<script src="<?= URL ?>public/js/sparkline-chart.js"></script>
<script src="<?= URL ?>public/js/easy-pie-chart.js"></script>

<script>

    //owl carousel

    $(document).ready(function() {
        $("#owl-demo").owlCarousel({
            navigation : true,
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem : true

        });
    });

    //custom select box

    $(function(){
        $('select.styled').customSelect();
    });

</script>

</body>
    <?php
}
?>
</html>
