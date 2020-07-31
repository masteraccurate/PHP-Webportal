<?php
################################################
# Author:       MasterAccurate                 #
# E-Mail:       masteraccurate@yahoo.com       #
# Website:      http://webportal.de.cool       #
################################################
# Project-Name: PHP-Webportal                  #
# Filename:     passgen.module.php             #
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

class passgen {
	function title() {
		return "Passwort Generator";
	}
	function main() {
		function createRandomPassword($length=8,$chars="") { 
			if($chars=="") {
				$chars = "abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ0123456789!#$%^&*()_-+=}]{[|?";
			}
			srand((double)microtime()*1000000); 
			$i = 0; 
			$pass = '' ; 
			while ($i < $length) { 
				$num = rand() % strlen($chars); 
				$tmp = substr($chars, $num, 1); 
				$pass = $pass . $tmp; 
				$i++; 
			} 
			return $pass; 
		}
		$content = createRandomPassword();
		return "Generated Password: ".$content."<br><br>\n<a href=\"index.php?id=passgen\">Generate new Password</a><br><br>Generate a new password as often as you want until you find a suitable one.";
	}
}
?>