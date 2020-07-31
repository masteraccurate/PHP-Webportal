<?php
################################################
# Author:       MasterAccurate                 #
# E-Mail:       masteraccurate@yahoo.com       #
# Website:      http://webportal.de.cool       #
################################################
# Project-Name: PHP-Webportal                  #
# Filename:     namegenerator.module.php       #
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

class namegenerator {
	function title() {
		return "Namegenerator";
	}
	function generate_length() {
		$length = 1;
		$valid_chars = "22233333444556";
		$password = '';
		while( $length > 0 ) {
			$password .= $valid_chars[ rand( 0, strlen( $valid_chars ) -1 ) ];
			$length--;
		}
		return $password;
	}
	function generate_name_1() {
		$length = 1;
		$a = file("namegenerator/1.txt"); // per zeilenumbruch getrennt keine leerzeile in datei sonst muss überprüft werden
		$password = '';
		while($length > 0) {
			$password .= $a[rand(0,sizeof($a)-1)];
			$length--;
		}
		return $password;
	}
	function generate_name_2() {
		$length = 1;
		$a = file("namegenerator/2.txt"); // per zeilenumbruch getrennt keine leerzeile in datei sonst muss überprüft werden
		$password = '';
		while($length > 0) {
			$password .= $a[rand(0,sizeof($a)-1)];
			$length--;
		}
		return $password;
	}
	function generate_name_3() {
		$length = 1;
		$a = file("namegenerator/3.txt"); // per zeilenumbruch getrennt keine leerzeile in datei sonst muss überprüft werden
		$password = '';
		while($length > 0) {
			$password .= $a[rand(0,sizeof($a)-1)];
			$length--;
		}
		return $password;
	}
	function generate_name_4() {
		$length = 1;
		$a = file("namegenerator/4.txt"); // per zeilenumbruch getrennt keine leerzeile in datei sonst muss überprüft werden
		$password = '';
		while($length > 0) {
			$password .= $a[rand(0,sizeof($a)-1)];
			$length--;
		}
		return $password;
	}
	function generate_name_5() {
		$length = 1;
		$a = file("namegenerator/5.txt"); // per zeilenumbruch getrennt keine leerzeile in datei sonst muss überprüft werden
		$password = '';
		while($length > 0) {
			$password .= $a[rand(0,sizeof($a)-1)];
			$length--;
		}
		return $password;
	}
	function generate_name_6() {
		$length = 1;
		$a = file("namegenerator/2.txt"); // per zeilenumbruch getrennt keine leerzeile in datei sonst muss überprüft werden
		$password = '';
		while($length > 0) {
			$password .= $a[rand(0,sizeof($a)-1)];
			$length--;
		}
		return $password;
	}
	function main() {
		$name_1 = $this->generate_name_1();
		$name_2 = $this->generate_name_2();
		$name_3 = $this->generate_name_3();
		$name_4 = $this->generate_name_4();
		$name_5 = $this->generate_name_5();
		$name_6 = $this->generate_name_6();
		if($this->generate_length() == 6) {
			$name = $name_1.$name_2.$name_3.$name_4.$name_5.$name_6;
		}
		elseif($this->generate_length() == 5) {
			$name = $name_1.$name_2.$name_3.$name_4.$name_5;
		}
		elseif($this->generate_length() == 4) {
			$name = $name_1.$name_2.$name_3.$name_4;
		}
		elseif($this->generate_length() == 3) {
			$name = $name_1.$name_2.$name_3;
		} else {
			$name = $name_1.$name_2;
		}
		$name = preg_replace('#\r|\n#', '', $name);
		return "<font size=\"2\"><u>Nickname oder Fantasiename:</u> <b>".$name."</b></font><br><br>\n\n<a href=\"index.php?id=namegenerator\"><b>Generiere neuen Namen</b></a><br><br>Generiere einen neuen Namen so oft wie du willst, bis du einen Namen gefunden hast der dir gefällt.<br><br>Wenn du das PHP-Script Namegenerator runterladen willst dann geh zu: <a href=\"https://sourceforge.net/projects/php-namegenerator/\" target=\"_BLANK\">Sourceforge</a>\n";
	}
}
?>