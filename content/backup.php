<?php
/*
|
| FusionInvoice to InvoicePlane
| Database conversion tool
|
*/
?>

<p>We recommend saving a backup of the database. If you don't want to press continue.</p>

<a href="/engine/save_backup.php" id="btn_backup" class="btn btn-lg btn-warning">
    <i class="fa fa-history"></i>&nbsp; Save Backup
</a>

<br/><br/>

<a href="/step/conversion" id="btn_continue" class="btn btn-lg btn-default">
    <i class="fa fa-angle-right"></i>&nbsp; Continue
</a>

<script>
    $('#btn_backup').click(function(){
        $('#btn_backup').html('<i class="fa fa-spin fa-spinner"></i>&nbsp; ...creating Backup');
        window.setTimeout(function() {
            $('#btn_backup').html('<i class="fa fa-check"></i>&nbsp; Backup finished!').removeClass('btn-warning').addClass('btn-success disabled');
            $('#btn_continue').removeClass('btn-default').addClass('btn-success');
        }, 1000);

    });
</script>