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
			return "Activation";
		} elseif(($_GET['action'] == "lostpass") || ($_GET['action'] == "lostpass_form")) {
			return "Lost password";
		} else {
			return "Register";
		}
	}
	function main() {
		global $id;
		$main = new main();
		$template = new template();
		$moving_circles = $template->load("moving-circles.tpl");
		if(isset($_GET['action']) && $_GET['action'] != "" && $_GET['action'] != "NULL" && $_GET['action'] != "0" && $_GET['action'] != "false") {
			$action = htmlspecialchars($_GET['action'], ENT_QUOTES);
		} else {
			$action = "register_form";
		}
		if($action == "login") {
			$user = htmlspecialchars($_POST['user'], ENT_QUOTES);
			$pass = htmlspecialchars($_POST['pass'], ENT_QUOTES);
			if(($user != "") && ($pass != "")) {
				$main = new main();
				$login = $main->login($user,$pass);
			} else {
				$login = "No Username or Password given!\n";
			}
			$login = $login."<br>\n".$moving_circles;
			$content = $login;
		} elseif($action == "logout") {
			$main->logout();
			$content = "You are now logged out!\n";
			$content = $content."<br>\n".$moving_circles;
		} elseif($action == "register") {
			$user = htmlspecialchars($_POST['user'], ENT_QUOTES);
			$email = htmlspecialchars($_POST['email'], ENT_QUOTES);
			$pass = htmlspecialchars($_POST['pass'], ENT_QUOTES);
			if(($user != "") && ($email != "") && ($pass != "")) {
				$content = $main->register($user,$email,$pass);
			} else {
				$content = "No Username or Password given!";
			}
			$content = $content."<br>\n".$moving_circles;
		} elseif($action == "register_form") {
			if(isset($_GET['anr']) && ($_GET['anr'] == "")) {
				$actnr = htmlspecialchars($_GET['anr'], ENT_QUOTES);
			} else {
				$actnr = "";
			}
			$content = $template->load("register_form.tpl");
		} elseif($action == "activate") {
			$user = htmlspecialchars($_POST['user'], ENT_QUOTES);
			$pass = htmlspecialchars($_POST['pass'], ENT_QUOTES);
			$active = htmlspecialchars($_POST['active'], ENT_QUOTES);
			if(($user != "") && ($pass != "") && ($active != "")) {
				$main = new main();
				$content = $main->activation($user,$pass,$active);
			} else {
				$content = "No Username, Password or Activationnummber given!";
			}
			$content = $content."<br>\n".$moving_circles;
		} elseif($action == "activate_form") {
			if(isset($_GET['anr']) && ($_GET['anr'] != "")) {
				$anr = htmlspecialchars($_GET['anr'], ENT_QUOTES);
			} else {
				$anr = "";
			}
			$content = $template->load("activate_form.tpl");
			$content = str_replace(">>anr<<",$anr,$content);
		} elseif($action == "react_form") {
			$template = new template();
			$content = $template->load("react_form.tpl");
		} elseif($action == "react") {
			$user = htmlspecialchars($_POST['user'], ENT_QUOTES);
			$pass = htmlspecialchars($_POST['pass'], ENT_QUOTES);
			$email = htmlspecialchars($_POST['email'], ENT_QUOTES);
			if(($user != "") && ($pass != "") && ($email != "")) {
				$login = $main->react($user,$pass,$email);
			} else {
				$login = "No Username or Password given!\n";
			}
			$content = $login."<br>\n".$moving_circles;
		} elseif($action == "changepass") {
			$content = $main->changepass();
		} elseif($action == "lostpass_form") {
			$template = new template();
			$content = $template->load("lostpass_form.tpl");
		} elseif($action == "lostpass") {
			$user = htmlspecialchars($_POST['user'], ENT_QUOTES);
			$email = htmlspecialchars($_POST['email'], ENT_QUOTES);
			if(($user != "") && ($email != "")) {
				$login = $main->lostpass($user,$email);
			} else {
				$login = "No Username or Password given!\n";
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