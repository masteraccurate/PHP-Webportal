<?php
################################################
# Author:       MasterAccurate                 #
# E-Mail:       masteraccurate@yahoo.com       #
# Website:      http://webportal.de.cool       #
################################################
# Project-Name: PHP-Webportal                  #
# Filename:     client.module.php              #
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

class client {
	function title() {
		return "Client Information";
	}
	function main() {
		if(getenv('HTTP_X_FORWARDED_FOR')) {
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		}
		elseif(getenv('HTTP_CLIENT_IP')) {
			$ip = getenv('HTTP_CLIENT_IP');
		}
		elseif(getenv('REMOTE_ADDR')) {
			$ip = getenv('REMOTE_ADDR');
		}
		$content = "Deine IP-Adresse:<br>\n".$ip."<br><br>\nDein Hostname:<br>\n".gethostbyaddr($ip)."<br><br>\nDein Browser und Betriebsystem:<br>\n".getenv("HTTP_USER_AGENT")."<br>\n";
		return $content;
	}
}
?>