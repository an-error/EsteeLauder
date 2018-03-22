<?php

$id="34170119790217214X";
$gender = intval( substr( $id, 16, 1 ) );
echo $gender;
if ( $gender % 2 == 0 ) {
    echo "女";
} else {
    echo "男";
}
