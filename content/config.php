<?php
/*
|
| FusionInvoice to InvoicePlane
| Database conversion tool
|
*/
?>

<form action="/engine/save_config.php" method="post" role="form">

    <p>Please enter the credentials for the database so the tool can make any necessary changes.</p>

    <div class="form-group">
        <label for="database_name">Database Name</label>
        <input type="text" class="form-control" id="database_name" name="database_name">
    </div>

    <div class="form-group">
        <label for="database_host">Database Host</label>
        <input type="text" class="form-control" id="database_host" name="database_host">
    </div>

    <div class="form-group">
        <label for="database_user">Database User</label>
        <input type="text" class="form-control" id="database_user" name="database_user">
    </div>

    <div class="form-group">
        <label for="database_password">Password</label>
        <input type="password" class="form-control" id="database_password" name="database_password">
    </div>

    <button type="submit" class="btn btn-lg btn-success">Save</button>

</form>