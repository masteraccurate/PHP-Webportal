<?php
################################################
# Author:       MasterAccurate                 #
# E-Mail:       masteraccurate@yahoo.com       #
# Website:      http://webportal.de.cool       #
################################################
# Project-Name: PHP-Webportal                  #
# Filename:     config.inc.php                 #
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
$config = array(
	"title"		=> "PHP-Webportal",
	"logo_text"	=> "PHP-Webportal Banner",
	"url"		=> "http://localhost/",
	"email"		=> "mail@domain.tld",
	"port"		=> "80",
	"inc_dir"	=> "includes",
	"mod_dir"	=> "modules",
	"tpl_dir"	=> "templates",
	"img_dir"	=> "images",
	"log_dir"	=> "logfile",
	"dbhost"	=> "DB-Host",
	"dbport"	=> "3306",
	"dbuser"	=> "DB-User",
	"dbpass"	=> "DB-Pass",
	"dbname"	=> "DB-Name",
	"salt"		=> "\$6\$rounds=5000\$SHA512SaltForCry\$"
);
?>