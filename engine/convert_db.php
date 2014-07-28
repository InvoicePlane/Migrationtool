<?php
/*
|
| FusionInvoice to InvoicePlane
| Database conversion tool
|
| (c) Copyright 2014 by InvoicePlane.com / Kovah.de
|
*/
session_start();

require_once('../config.php');

if ( isset($_SESSION['connection']) ) {

    $connection = mysqli_connect(
        $_SESSION['connection']['host'],
        $_SESSION['connection']['user'],
        $_SESSION['connection']['password'],
        $_SESSION['connection']['name']
    );

    $tables = array();
    $query = 'SHOW TABLES';
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_row($result)) {
        $tables[] = $row[0];
    }


    /*
    | =================
    | Rename all tables
    | =================
    */
    foreach($tables as $table) {

        $new_name = substr($table, 3);
        $new_name = 'ip_'.$new_name;

        $query = "RENAME TABLE ".$table." TO ".$new_name."";
        $result = mysqli_query($connection, $query);

        if ( $result === false ) {
        ?>
            <p class="alert alert-danger">
                <span class="label label-danger">Error!</span>
                An error occurred while renaming tables!
            </p>
            <?php

            exit; // Stop execution
        }

    }


    /*
    | ========================
    | Rename the custom fields
    | ========================
    */
    $custom_fields = array();

    $query = "SELECT * FROM ip_custom_fields";
    $result = mysqli_query($connection, $query);

    while($row = mysqli_fetch_row($result)) {
        $custom_fields[] = $row;
    }

    foreach ($custom_fields as $custom_field) {

        $custom_field_table = substr($custom_field[1], 3);
        $custom_field_table = 'ip_'.$custom_field_table;

        $query = "
            UPDATE ip_custom_fields
            SET custom_field_table = \"".$custom_field_table."\"
            WHERE custom_field_id=".$custom_field[0];
        $result = mysqli_query($connection,$query);

        if ( $result === false ) {
            ?>
            <p class="alert alert-danger">
                <span class="label label-danger">Error!</span>
                An error occurred while updating the custom field records!
            </p>
            <?php

            var_dump($result);
            exit; // Stop execution
        }

    }


    /*
    | =========================
    | Reset the version counter
    | =========================
    */
    $query = "TRUNCATE ip_versions";
    $result = mysqli_query($connection, $query);

    // Errorcheck
    if ( $result === false ) {
        ?>
        <p class="alert alert-danger">
            <span class="label label-danger">Error!</span>
            An error occurred while resetting the versions!
        </p>
        <?php

        exit; // Stop execution
    }


    /*
    | =========================================
    | Update to the latest InvoicePlane version
    | =========================================
    */
    $query = "
        INSERT INTO ip_versions
        VALUES (
            '',
            ".time().",
            '000_1.0.0.sql',
            0
        )";
    $result = mysqli_query($connection, $query);

    // Errorcheck
    if ( $result === false ) {
        ?>
        <p class="alert alert-danger">
            <span class="label label-danger">Error!</span>
            An error occurred while updating the versions!
        </p>
        <?php

        exit; // Stop execution
    }


    /*
    | =========================================
    | @TODO All further updates of the main InvoicePlane application have to be added here
    | =========================================
    */


    /*
    | =======================
    | Conversion finished! :)
    | =======================
    */
    echo '# Conversion successful! #';
    exit;

} else { ?>

    <p class="alert alert-danger">
        <span class="label label-danger">Error!</span> Please re-configure the database credentials <a href="/<?php echo SUBDIR ?>step/config">here</a>!
    </p>

<?php } ?>

