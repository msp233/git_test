<?php
/**
 * Created by PhpStorm.
 * User: spm
 * Date: 2020/9/6
 * Time: 5:54 PM
 */
for ($i=0;$i<30;$i++) {
    echo $i . "<br/>";
}

$arr = [2, 3, 8, 'm', 's' , 'p', '6' , 6];
foreach ($arr as $k => $v){
    echo $k . ' => ' . $v . '<br/>';
}