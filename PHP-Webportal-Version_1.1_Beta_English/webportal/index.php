<?php
$msec = microtime(true);
####################################################
# Author:       MasterAccurate                     #
# E-Mail:       masteraccurate@yahoo.com           #
# Website:      http://webportal.de.cool           #
####################################################
# Project-Name: PHP-Webportal                      #
# Filename:     index.php                          #
# Date:         2020-05-19                         #
####################################################
#                  Copyright                       #
# Copyright refers to the exclusive right to       #
# a piece of work such as literature, music,       #
# artwork and computer software including the      #
# underlying algorithms, source code and the       #
# program's appearance. Rights covered include     #
# copying, distributing and creating               #
# derivative works. Most software is               #
# distributed with a license or copyright          #
# notice that explains how it can be used.         #
####################################################

// kernel base configuration for development
$kernel_file = "kernel.php";
$develop = "false";
$sleep_var = "false";
$sleep_sec = "1";

// Cache control
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

// set default timezone
date_default_timezone_set('Europe/Berlin');
#date_default_timezone_set('CET');
#date_default_timezone_set('GMT+0');

// Charset
header('Content-Type: text/html; charset=utf-8');
#header('Content-Type: text/html; charset=ISO-8859-1');

// Do not edit below if don't know what to do!
session_start();
if($develop == "true") {
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
} else {
	ini_set('display_errors', 0);
	error_reporting(0);
}

if(!file_exists($kernel_file)) {
	print "ERROR: kernel.php missing!";
} else {
	include $kernel_file;
	$main = new main();
	print $main->output();
}
if($sleep_var == "true") {
	sleep($sleep_sec);
}
$mstime = microtime(true) - $msec;
$ms = $mstime;

if($develop == "true") {
	print "<br>\n<font color=\"#ffffff\">PHP-Script Load Time: ".$ms."s</font><br>\n";
}
?>