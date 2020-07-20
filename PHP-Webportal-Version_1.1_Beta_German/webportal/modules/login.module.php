<?php
################################################
# Author:       MasterAccurate                 #
# E-Mail:       masteraccurate@yahoo.com       #
# Website:      http://webportal.de.cool       #
################################################
# Project-Name: PHP-Webportal                  #
# Filename:     login.module.php               #
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
class login {
	function title() {
		if(($_GET['action'] == "login") || ($_GET['action'] == "logout")) {
			return "Login";
		} elseif(($_GET['action'] == "activate") || ($_GET['action'] == "activate_form") || ($_GET['action'] == "react") || ($_GET['action'] == "react_form")) {
			return "Aktivieren";
		} elseif(($_GET['action'] == "lostpass") || ($_GET['action'] == "lostpass_form")) {
			return "Passwort vergessen";
		} else {
			return "Registrieren";
		}
	}
	function main() {
		global $id;
		$template = new template();
		$moving_circles = $template->load("moving-circles.tpl");
		if(isset($_GET['action']) && $_GET['action'] != "" && $_GET['action'] != "NULL" && $_GET['action'] != "0" && $_GET['action'] != "false") {
			$action = htmlspecialchars($_GET['action']);
		} else {
			$action = "register_form";
		}
		if($action == "login") {
			$user = htmlspecialchars($_POST['user']);
			$pass = htmlspecialchars($_POST['pass']);
			if(($user != "") && ($pass != "")) {
				$main = new main();
				$login = $main->login($user,$pass);
			} else {
				$login = "Kein Benutzername oder Passwort eingegeben!\n";
			}
			$login = $login."<br>\n".$moving_circles;
			$content = $login;
		} elseif($action == "logout") {
			$main = new main();
			$main->logout();
			$content = "Du bist jetzt ausgeloggt!\n";
			$content = $content."<br>\n".$moving_circles;
		} elseif($action == "register") {
			$user = htmlspecialchars($_POST['user']);
			$email = htmlspecialchars($_POST['email']);
			$pass = htmlspecialchars($_POST['pass']);
			if(($user != "") && ($email != "") && ($pass != "")) {
				$main = new main();
				$content = $main->register($user,$email,$pass);
			} else {
				$content = "Kein Benutzername, Email oder Passwort eingegeben!";
			}
			$content = $content."<br>\n".$moving_circles;
		} elseif($action == "register_form") {
			if(isset($_GET['anr']) && ($_GET['anr'] == "")) {
				$actnr = htmlspecialchars($_GET['anr']);
			} else {
				$actnr = "";
			}
//			$template = new template();
			$content = $template->load("register_form.tpl");
		} elseif($action == "activate") {
			$user = htmlspecialchars($_POST['user']);
			$pass = htmlspecialchars($_POST['pass']);
			$active = htmlspecialchars($_POST['active']);
			if(($user != "") && ($pass != "") && ($active != "")) {
				$main = new main();
				$content = $main->activation($user,$pass,$active);
			} else {
				$content = "Kein Benutzername, Passwort oder Aktivierungsnummer eingegeben!";
			}
			$content = $content."<br>\n".$moving_circles;
		} elseif($action == "activate_form") {
			if(isset($_GET['anr']) && ($_GET['anr'] != "")) {
				$anr = htmlspecialchars($_GET['anr']);
			} else {
				$anr = "";
			}
//			$template = new template();
			$content = $template->load("activate_form.tpl");
			$content = str_replace(">>anr<<",$anr,$content);
		} elseif($action == "react_form") {
			$template = new template();
			$content = $template->load("react_form.tpl");
		} elseif($action == "react") {
			$user = htmlspecialchars($_POST['user']);
			$pass = htmlspecialchars($_POST['pass']);
			$email = htmlspecialchars($_POST['email']);
			if(($user != "") && ($pass != "") && ($email != "")) {
				$main = new main();
				$login = $main->react($user,$pass,$email);
			} else {
				$login = "Kein Benutzername oder Passwort eingegeben!\n";
			}
			$content = $login."<br>\n".$moving_circles;
		} elseif($action == "changepass") {
			$main = new main();
			$content = $main->changepass();
		} elseif($action == "lostpass_form") {
			$template = new template();
			$content = $template->load("lostpass_form.tpl");
		} elseif($action == "lostpass") {
			$user = htmlspecialchars($_POST['user']);
			$email = htmlspecialchars($_POST['email']);
			if(($user != "") && ($email != "")) {
				$main = new main();
				$login = $main->lostpass($user,$email);
			} else {
				$login = "Kein Benutzername oder E-Mail eingegeben!\n";
			}
			$content = $login."<br>\n".$moving_circles;
		} else {
			if(isset($_SESSION['loggedin'])) {
				$content = $id." module! - Wrong action variable: ".$action." - loggedin\n";
			} else {
				$content = $id." module! - Wrong action variable: ".$action." - not loggedin\n";
			}
		}
		return $content;
	}
}
?>