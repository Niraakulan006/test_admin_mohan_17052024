</div>
</div>  
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/fonticons.js"></script>
<script type="text/javascript" src="js/jquery.slimscroll.js" defer="defer"></script>
<script type="text/javascript" src="js/script.min.js" defer="defer"></script>
<script type="text/javascript" src="js/pcoded.min.js" defer="defer"></script>
<script type="text/javascript" src="js/vertical-layout.min.js" defer="defer"></script>
<script src="include/select2/js/select2.min.js"></script>
<script src="include/select2/js/select.js"></script>
<script src="js/datatables/datatables.min.js"></script>
</body>
</html>
<?php include "modal_content.php"; ?>
<script>
    $(document).on('select2:open', function() {
        var select_box = $('.select2-container--open .select2-selection--single');
        if (select_box.length) {
            select_box.css('border', '1px solid #aaa');
            select_box.closest('.form-group').find('.infos').remove();
        }
    });
</script>