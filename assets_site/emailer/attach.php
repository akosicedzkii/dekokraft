<?php

    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error';
    }
    else {
        move_uploaded_file($_FILES['file']['tmp_name'], 'attachment/' . $_FILES['file']['name']);
    }

?>