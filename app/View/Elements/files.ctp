<?php
if (isset($filedata)) {
    $this->layout = false;
    echo $filedata;
} else {
    echo 'Data Not Found';
}