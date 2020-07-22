<?php
################################################
# Author:       MasterAccurate                 #
# E-Mail:       masteraccurate@yahoo.com       #
# Website:      http://webportal.de.cool       #
################################################
# Project-Name: PHP-Webportal                  #
# Filename:     home.module.php                #
# Date:         2020-05-18                     #
################################################
#                  Copyright                   #
# Copyright refers to the exclusive right to   #
# a piece of work such as literature, music,   #
# artwork and computer software including the  #
# underlying algorithms, source code and the   #
# program's appearance. Rights covered include #
# copying, distributing and creating           #
# derivative works. Most software is           #
# distributed with a license or copyright      #
# notice that explains how it can be used.     #
################################################
class home {
	function title() {
		return "Home";
	}
	function main() {
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "1") {
			$content = "Welcome to User Area!";
		} else {
			$content = "Welcome to Webportal!";
		}
		return $content;
	}
}
?>