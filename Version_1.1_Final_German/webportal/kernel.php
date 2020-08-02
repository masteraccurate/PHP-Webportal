<?php
################################################
# Author:       MasterAccurate                 #
# E-Mail:       masteraccurate@yahoo.com       #
# Website:      http://www.masteraccurate.info #
################################################
# Project-Name: Content-Managment-System       #
# Filename:     kernel.php                     #
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

// Set default id
$std_id = "home";
$includes_dir = "includes";

// Do not edit below if don't know what to do!
if(isset($_GET['id']) && $_GET['id'] != "NULL" && $_GET['id'] != "" && $_GET['id'] != "false" && $_GET['id'] != "0") {
	$id = htmlspecialchars($_GET['id'], ENT_QUOTES);
} else {
	$id = $std_id;
}

class main {
	public function error($eid,$e_var) {
		if($eid == "1") {
			$error = "<p style=\"color:red;font-family:Arial\">Template Error: File ".$e_var." not found!</p>\n";
		} elseif($eid == "2") {
			$error = "<p style=\"color:red;font-family:Arial\">Module Error: File ".$e_var." not found!</p>\n";
		} elseif($eid == "3") {
			$error = "<p style=\"color:red;font-family:Arial\">MySQL-DB Error: Not connected to MySQL-Server with string: ".$e_var."</p>\n";
		} else {
			$error = "<p style=\"color:red;font-family:Arial\">Kernel-Error: Variable eid or e_var in Error-Function not set!</p>\n";
		}
		return $error;
	}
	public function config($config_var) {
		$dir_var = dirname(__FILE__);
		include $dir_var."/config.inc.php";
		return $config[$config_var];
	}
	private function includes() {
		global $includes_dir;
		// Set includes directory
		$dir_var = dirname(__FILE__);
		$idir = $includes_dir;
			$odir = @opendir($dir_var."/".$idir);
		while($file = readdir($odir)) {
			if($file != "." && $file != ".."){
					include $dir_var."/".$idir."/".$file;
			}
		}
		closedir($odir);
	}
	private function module() {
		global $id,$sid;
		if($id != "") {
			$dir_var = dirname(__FILE__);
			$dir = $this->config('mod_dir');
				$module = $dir_var."/".$dir."/".$id.".module.php";
			if(file_exists($module)) {
				include $module;
				$var_id = new $id();
				return $var_id->main();
			} else {
				return $this->error(2,$module);
			}
		} else {
			return $this->error(2,$module);
		}		
	}
	private function title() {
		global $id;
		if($id != "") {
			$dir_var = dirname(__FILE__);
			$dir = $this->config('mod_dir');
				$module = $dir_var."/".$dir."/".$id.".module.php";
			if(file_exists($module)) {
				$var_id = new $id();
				return $var_id->title();
			} else {
				return $this->error(2,$module);
			}
		} else {
			return $this->error(2,$module);
		}
	}
	public function login($user,$pass) {
		$dbpass = base64_decode($this->config('dbpass'));
		$db = new Database($this->config('dbhost'), $this->config('dbuser'), $dbpass, $this->config('dbname'));
		$pass_crypt = crypt($pass,$this->config('salt'));
		$statement = "SELECT user, pass FROM user WHERE user='$user' AND pass='$pass_crypt' AND sid='0'";
		$result = $db->query($statement);
		if($result->num_rows > 0) {
			$_SESSION['user'] = $user;
			$_SESSION['pass'] = $pass;
			$_SESSION['loggedin'] = 1;
			$msg = "Du bist jetzt eingeloggt!\n";
		} else {
			$msg = "Benutzername oder Passwort falsch oder Benutzerkonto nicht aktiviert\n";
		}
		$db->close();
		return $msg;
	}
	public function logout() {
		session_unset();
	}
	public function register($user,$email,$pass) {
		$dbpass = base64_decode($this->config('dbpass'));
		$db = new Database($this->config('dbhost'), $this->config('dbuser'), $dbpass, $this->config('dbname'));
		$statement = "SELECT user FROM user WHERE user='$user'";
		$result = $db->query($statement);
		if($result->num_rows > 0) {
			$msg = "Der Benutzername <b>".$user."</b> ist schon registriert!\n";
		} else {
			if(isset($_POST['email'])) {
				// Validate email
				$email = htmlspecialchars($_POST['email'], ENT_QUOTES);
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$msg = "<b>".$email."</b> ist keine gültige Emailadresse";
				}
			}
			$post_name = htmlspecialchars($_POST['user'], ENT_QUOTES);
			$post_email = htmlspecialchars($email, ENT_QUOTES);
			$post_pass = crypt($_POST['pass'],$this->config('salt'));
			$post_homepage = htmlspecialchars($_POST['homepage'], ENT_QUOTES);
			$random_nr = rand(11111111,99999999);
			$statement = "INSERT INTO user (id,sid,user,pass,email,homepage,admin,mode,opt1,opt2,opt3,comment,signatur) VALUES(NULL,'".$random_nr."','".$post_name."','".$post_pass."','".$post_email."','".$post_homepage."','','','','','','','')";
			$result->close();
			$result = $db->query($statement);
			if(isset($result)) {
				if(mail($email,"Registrierung abschließen", "Benutzername: ".$post_name."\nAktivierungsnummer: ".$random_nr."\n".$this->config('url')."index.php?id=login&action=activate_form&anr=".$random_nr."\n","From: ".$this->config('email')." <".$this->config('email').">")) {
					$activition = "Email mit Aktivierungsnummer wurde versendet an <b>".$post_email."</b><br>\n<a href=\"".$this->config('url')."index.php?id=login&amp;action=activate_form\">Aktivierung</a>\n";
				} else {
					$activition = "Email Fehler. Bitte Administrator kontaktieren!";
				}
				$msg = "Benutzername <b>".$post_name."</b> mit der Emailadresse <b>".$post_email."</b> registriert!<br>\n".$activition;
				
			} else {
				$msg = "REGISTRIERUNGSFEHLER Benutzer: ".$post_name." - E-Mail: ".$post_email." - Passwort: ".$post_pass;
			}
		}
		$db->close();
		return $msg;
	}
	public function activation($user,$pass,$active) {
		$dbpass = base64_decode($this->config('dbpass'));
		$db = new Database($this->config('dbhost'), $this->config('dbuser'), $dbpass, $this->config('dbname'));
		$crypt_pass = crypt($pass,$this->config('salt'));
		$statement = "SELECT user FROM user WHERE user='$user' AND pass='$crypt_pass' AND sid='$active'";
		$result = $db->query($statement);
		if($result->num_rows > 0) {
			$post_name = htmlspecialchars($_POST['user'], ENT_QUOTES);
			$post_pass = htmlspecialchars($_POST['pass'], ENT_QUOTES);
			$post_active = htmlspecialchars($_POST['active'], ENT_QUOTES);
			$statement = "UPDATE user SET sid='0' WHERE user='$user'";
			$result->close();
			$result = $db->query($statement);
			if(isset($result)) {
				$msg = "Benutzer <b>".$user."</b> ist registriert und wurde mit Act-Nr ".$active." aktiviert";			
			} else {
				$msg = "AKTIVIERUNGSFEHLER ".$post_name." ".$post_pass." ".$post_active;
			}
		} else {
			$msg = "Benutzername, Passwort oder Aktivierungsnummer falsch!<br>\n<a href=\"".$this->config('url')."index.php?id=login&amp;action=activate_form\">Ativierung</a>\n";
		}
		$db->close();
		return $msg;
	}
	public function react($user,$pass,$email) {
		$dbpass = base64_decode($this->config('dbpass'));
		$db = new Database($this->config('dbhost'), $this->config('dbuser'), $dbpass, $this->config('dbname'));
		$pass_crypt = crypt($pass,$this->config('salt'));
		$statement = "SELECT user, pass, email FROM user WHERE user='$user' AND pass='$pass_crypt' AND email='$email'";
		$result = $db->query($statement);
		if($result->num_rows > 0) {
			$statement = "SELECT sid FROM user WHERE user='$user'";
			$result->close();
			$result = $db->query($statement);
			if($row = $result->fetch_array(MYSQLI_BOTH)) {
				if(isset($_POST['email'])) {
					// Validate email
					$email = htmlspecialchars($_POST['email'], ENT_QUOTES);
					if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$msg = "<b>".$email."</b> ist keine gültige Emailadresse";
					}
				}
				if($row['sid'] == "0") {
					$msg = "Ihr Benutzerkonto ist bereits aktiviert!<br>\n";
				} else {
					if(mail($email,"Registrierung abschließen", "Benutzername: ".$user."\nAktivierungsnummer: ".$row['sid']."\n".$this->config('url')."index.php?id=login&action=activate_form&anr=".$row['sid']."\n","From: ".$this->config('email')." <".$this->config('email').">")) {
						$msg = "Email mit Aktivierungsnummer wurde versendet an <b>".$email."</b><br>\n<a href=\"".$this->config('url')."index.php?id=login&amp;action=activate_form\">Aktivierung</a>\n";
					} else {
						$msg = "Email Fehler. Bitte Administrator kontaktieren!";
					}					
				}
			} else {
				$msg = "AKTIVIERUNGSFEHLER ".$post_name." ".$post_pass." ".$post_email;
			}
		} else {
			$msg = "Benutzername, Passwort oder E-Mail falsch!\n";
		}
		$db->close();
		return $msg;
	}
	public function lostpass($user,$email) {
		$dbpass = base64_decode($this->config('dbpass'));
		$db = new Database($this->config('dbhost'), $this->config('dbuser'), $dbpass, $this->config('dbname'));
		$statement = "SELECT user, email FROM user WHERE user='$user' AND email='$email' AND sid=0";
		$result = $db->query($statement);
		if($result->num_rows > 0) {
			function createRandomPassword($length=7,$chars="") { 
				if($chars=="")
				$chars = "abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ0123456789!#$%^&*()_-+=}]{[|?"; 
				srand((double)microtime()*1000000); 
				$i = 0; 
				$pass = '' ;
 				while ($i < $length) { 
					$num = rand() % strlen($chars); 
					$tmp = substr($chars, $num, 1); 
					$pass = $pass . $tmp; 
					$i++; 
				} 
				return $pass."%"; 
			}
			$createpass = createRandomPassword();
			$pass_crypt = crypt($createpass,$this->config('salt'));
			$statement = "UPDATE user SET pass='$pass_crypt' WHERE user='$user' AND email='$email'";
			$result->close();
			$result = $db->query($statement);
			if(isset($result)) {
				if(mail($email,"Passwort vergessen", "Benutzername: ".$user."\nE-Mail: ".$email."\nNeues Passwort: ".$createpass."\n","From: ".$this->config('email')." <".$this->config('email').">")) {
					$msg = "Email mit neuem Passwort wurde versendet an <b>".$email."</b>\n";
				} else {
					$msg = "Email Fehler. Bitte Administrator kontaktieren!";
				}
			} else {
				$msg = "DATENBANKFEHLER Email Fehler. Bitte Administrator kontaktieren!";
			}

		} else {
			$msg = "Benutzername oder Passwort falsch oder Benutzerkonto nicht aktiviert\n";
		}
		$db->close();
		return $msg;
	}
	private function portal() {
		global $sid,$id,$counter;
		$this->includes();
		$logs = new logs();
		$logs->create();
		$mod = $this->module();
		$title_var = $this->title();
		$template = new template();
		$br = $template->load("br.tpl");
		$tpl = $template->load("portal.tpl");
		$portal_title = $this->config('title')." - ".$title_var;
		$tpl = str_replace(">>PORTALTITLE<<",$portal_title,$tpl);
		$tpl = str_replace(">>COPYRIGHT<<","Copyrights &copy; 2020 by <a href=\"https://webportal.de.cool\" target=\"_BLANK\">MasterAccurate&reg;</a>, Germany, EU",$tpl);
		$index = $template->load("cell_main.tpl");
		$index = str_replace(">>CELL_TITLE<<",$title_var,$index);
		$index = str_replace(">>CELL_INDEX<<",$mod,$index);
		$svg_logo = $template->load("banner.tpl");
		$svg_logo = str_replace(">>URL<<",$this->config('url')."index.php",$svg_logo);
		$svg_logo = str_replace(">>LOGO_TEXT<<",$this->config('logo_text'),$svg_logo);
		$cell_main = $template->load("menue-main.tpl");
		$cell_search = $template->load("menue-search.tpl");
		$cell_valid = $template->load("valid.tpl");
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "1") {
			$menue_user = $template->load("menue-user.tpl");
			$menue_user = str_replace(">>USER<<",$_SESSION['user'],$menue_user);
			$content_usr = $menue_user;
		} else {
			$cell_login = $template->load("menue-login.tpl");
			$content_usr = $cell_login;
		}
		$cell_tools = $template->load("menue-tools.tpl");
		$cell_tools = str_replace(">>COUNTER<<",$counter,$cell_tools);
		$content = str_replace(">>LOGO<<",$svg_logo,$tpl);
		$content = str_replace(">>CELL_LEFT<<",$cell_main.$content_usr.$cell_search.$cell_tools,$content);
		$content = str_replace(">>CELL_MAIN<<",$index,$content);
		return $content;
	}
	public function output() {
		$render = $this->portal();
		$render = str_replace("\r","",$render);
		$content = str_replace("\n","",$render);
		return $content;
	}
}
?>