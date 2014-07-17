<?php
/*
|
| FusionInvoice to InvoicePlane
| Database conversion tool
|
| (c) Copyright 2014 by InvoicePlane.com / Kovah.de
|
*/
?>
<p>The tool is ready to convert the database now.</p>

<button id="btn_convert" class="btn btn-lg btn-success" >
    <i class="fa fa-angle-right"></i> Convert now
</button>

<div id="results"></div>

<p id="ajax-error" class="alert alert-danger hide">Sorry, an Ajax error occurred.</p>

<script>

    $('#btn_convert').click(function(){
        $('#btn_convert').html('<i class="fa fa-spin fa-spinner"></i>&nbsp; ...converting');

        window.setTimeout(function() {

            $.ajax({
                method: 'get',
                url: '/engine/convert_db.php',
                success: function(data) {

                    if ( data == '# Conversion successful! #' ) {

                        window.location.replace('/step/finished');

                    } else {

                        $('#btn_convert').addClass('hide');
                        $('#results').html(data);

                    }

                },
                error: function() {
                    $('#btn_convert').addClass('disabled');
                    $('#ajax-error').removeClass('hide');
                }
            });

        }, 1000);

    });

</script>