<?php
/**
 * Created by PhpStorm.
 * User: 27057
 * Date: 2017/12/7
 * Time: 21:58
 */
session_start();
$temp=$_GET['wendu'];
echo $temp;
$_SESSION['wendu']=$temp;
echo $_SESSION['wendu'];