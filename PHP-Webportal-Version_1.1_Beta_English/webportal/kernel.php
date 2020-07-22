<?php
################################################
# Author:       MasterAccurate                 #
# E-Mail:       masteraccurate@yahoo.com       #
# Website:      http://webportal.de.cool       #
################################################
# Project-Name: PHP-Webportal                  #
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
	function error($eid,$e_var) {
		if($eid == "1") {
			$error = "<font color=\"#FF0000\" face=\"Arial\">Template Error: File ".$e_var." not found!</font><br>\n";
		} elseif($eid == "2") {
			$error = "<font color=\"#FF0000\" face=\"Arial\">Module Error: File ".$e_var." not found!</font><br>\n";
		} elseif($eid == "3") {
			$error = "<font color=\"#FF0000\" face=\"Arial\">MySQL-DB Error: Not connected to MySQL-Server with string: ".$e_var."</font><br>\n";
		} else {
			$error = "<font color=\"#FF0000\" face=\"Arial\">Kernel-Error: Variable eid or e_var in Error-Function not set!</font><br>\n";
		}
		return $error;
	}
	function config($config_var) {
		$dir_var = dirname(__FILE__);
		include $dir_var."/config.inc.php";
		return $config[$config_var];
	}
	function includes() {
		global $includes_dir;
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
	function module() {
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
	function title() {
		global $id,$config;
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
	function login($user,$pass) {
		$dbpass = base64_decode($this->config('dbpass'));
		$connect = mysqli_connect($this->config('dbhost'), $this->config('dbuser'), $dbpass, $this->config('dbname'));
		$pass_crypt = crypt($pass,$this->config('salt'));
		$result = mysqli_query($connect,"SELECT user, pass FROM user WHERE user='$user' AND pass='$pass_crypt' AND sid=0");
		if(mysqli_num_rows($result) > 0) {
			$_SESSION['user'] = $user;
			$_SESSION['pass'] = $pass;
			$_SESSION['loggedin'] = 1;
			$msg = "You are loggedin!\n";
		} else {
			$msg = "Username oder Password wrong or Useraccount not activated\n";
		}
		mysqli_close($connect);
		return $msg;
	}
	function logout() {
		session_unset();
	}
	function register($user,$email,$pass) {
		$dbpass = base64_decode($this->config('dbpass'));
		$connect = mysqli_connect($this->config('dbhost'), $this->config('dbuser'), $dbpass, $this->config('dbname'));
		$result = mysqli_query($connect,"SELECT user FROM user WHERE user='$user'");
		if(mysqli_num_rows($result) > 0) {
			$msg = "Username <b>".$user."</b> is allready registred!\n";
		} else {
			if(isset($_POST['email'])) {
				// Validate email
				$email = htmlspecialchars($_POST['email'], ENT_QUOTES);
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$msg = "<b>".$email."</b> is not a valid Emailaddress";
				}
			}
			$post_name = htmlspecialchars($_POST['user'], ENT_QUOTES);
			$post_email = htmlspecialchars($email, ENT_QUOTES);
			$post_pass = crypt($_POST['pass'],$this->config('salt'));
			$post_homepage = htmlspecialchars($_POST['homepage'], ENT_QUOTES);
			$random_nr = rand(11111111,99999999);
			$statement = "INSERT INTO user (id,sid,user,pass,email,homepage,admin,mode,opt1,opt2,opt3,comment,signatur) VALUES(NULL,'".$random_nr."','".$post_name."','".$post_pass."','".$post_email."','".$post_homepage."','','','','','','','')";
			$result = mysqli_query($connect,$statement);
			if(isset($result)) {
				if(mail($email,"Finish registration", "Username: ".$post_name."\nActivationnumber: ".$random_nr."\n".$this->config('url')."index.php?id=login&action=activate_form&anr=".$random_nr."\n","From: ".$this->config('email')." <".$this->config('email').">")) {
					$activition = "Email with Activationnuber was send to <b>".$post_email."</b><br>\n<a href=\"".$this->config('url')."index.php?id=login&amp;action=activate_form\">Activation</a>\n";
				} else {
					$activition = "Email Error. Please contact Administrator!";
				}
				$msg = "Username <b>".$post_name."</b> with Emailaddress <b>".$post_email."</b> registred!<br>\n".$activition;
				
			} else {
				$msg = "REGISTRATIONERROR User: ".$post_name." - E-Mail: ".$post_email." - Password: ".$post_pass;
			}
		}
		mysqli_close($connect);
		return $msg;
	}
	function activation($user,$pass,$active) {
		$dbpass = base64_decode($this->config('dbpass'));
		$connect = mysqli_connect($this->config('dbhost'), $this->config('dbuser'), $dbpass, $this->config('dbname'));
		$crypt_pass = crypt($pass,$this->config('salt'));
		$result = mysqli_query($connect,"SELECT user FROM user WHERE user='$user' AND pass='$crypt_pass' AND sid='$active'");
		if(mysqli_num_rows($result) > 0) {
			$post_name = htmlspecialchars($_POST['user'], ENT_QUOTES);
			$post_pass = htmlspecialchars($_POST['pass'], ENT_QUOTES);
			$post_active = htmlspecialchars($_POST['active'], ENT_QUOTES);
			$statement = "UPDATE user SET sid='0' WHERE user='".$user."'";
			$result = mysqli_query($connect,$statement);
			if(isset($result)) {
				$msg = "User <b>".$user."</b> is registred and is activated with Act-Nr ".$active." ";			
			} else {
				$msg = "ACTIVATION ERROR ".$post_name." ".$post_pass." ".$post_active;
			}
		} else {
			$msg = "Username, Password or Activationnummber wrong!<br>\n<a href=\"".$this->config('url')."index.php?id=login&amp;action=activate_form\">Activation</a>\n";
		}
		mysqli_close($connect);
		return $msg;
	}
	function react($user,$pass,$email) {
		$dbpass = base64_decode($this->config('dbpass'));
		$connect = mysqli_connect($this->config('dbhost'), $this->config('dbuser'), $dbpass, $this->config('dbname'));
		$pass_crypt = crypt($pass,$this->config('salt'));
		$result = mysqli_query($connect,"SELECT user, pass, email FROM user WHERE user='$user' AND pass='$pass_crypt' AND email='$email'");
		if(mysqli_num_rows($result) > 0) {
			$result = mysqli_query($connect,"SELECT sid FROM user WHERE user='".$user."'");
			if($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
				if(isset($_POST['email'])) {
					// Validate email
					$email = htmlspecialchars($_POST['email'], ENT_QUOTES);
					if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$msg = "<b>".$email."</b> is not a valid Emailaddress";
					}
				}
				if($row['sid'] == "0") {
					$msg = "Your Useraccount is allready activated!<br>\n";
				} else {
					if(mail($email,"Finish registration", "Username: ".$user."\nActivationnumber: ".$row['sid']."\n".$this->config('url')."index.php?id=login&action=activate_form&anr=".$row['sid']."\n","From: ".$this->config('email')." <".$this->config('email').">")) {
						$msg = "Email with Activationnumber was send to <b>".$email."</b><br>\n<a href=\"".$this->config('url')."index.php?id=login&amp;action=activate_form\">Activation</a>\n";
					} else {
						$msg = "EMAIL ERROR. Please contact Administrator!";
					}					
				}
			} else {
				$msg = "ACTIVATION ERROR ".$post_name." ".$post_pass." ".$post_email;
			}
		} else {
			$msg = "Username, Password or E-Mail wrong!\n";
		}
		mysqli_close($connect);
		return $msg;
	}
	function lostpass($user,$email) {
		$dbpass = base64_decode($this->config('dbpass'));
		$connect = mysqli_connect($this->config('dbhost'), $this->config('dbuser'), $dbpass, $this->config('dbname'));
		$result = mysqli_query($connect,"SELECT user, email FROM user WHERE user='$user' AND email='$email' AND sid=0");
		if(mysqli_num_rows($result) > 0) {
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
			$statement = "UPDATE user SET pass='".$pass_crypt."' WHERE user='".$user."' AND email='".$email."'";
			$result = mysqli_query($connect,$statement);
			if(isset($result)) {
				if(mail($email,"Lost password", "Username: ".$user."\nE-Mail: ".$email."\nNew Password: ".$createpass."\n","From: ".$this->config('email')." <".$this->config('email').">")) {
					$msg = "E-Mail with new password was send to <b>".$email."</b>\n";
				} else {
					$msg = "EMAIL ERROR. Please contact Administrator!";
				}
			} else {
				$msg = "DATABASE EMAIL ERROR. Please contact Administrator!";
			}

		} else {
			$msg = "Username or Password wrong or Useraccount not activated\n";
		}
		mysqli_close($connect);
		return $msg;
	}
	function portal() {
		global $id,$counter;
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
		$logo = $template->load("img.tpl");
		$img = "images/banner.png";
		$svg_logo = $template->load("banner.tpl");
		$svg_logo = str_replace(">>URL<<",$this->config('url')."index.php",$svg_logo);
		$svg_logo = str_replace(">>LOGO_TEXT<<",$this->config('logo_text'),$svg_logo);
		$logo = str_replace(">>IMG<<",$img,$svg_logo);
		$cell_left = $template->load("menue-left1.tpl");
		$cell_search = $template->load("menue-search.tpl");
		$cell_valid = $template->load("valid.tpl");
		$cell_login = $template->load("menue-login.tpl");
		$cell_right = $template->load("menue-right1.tpl");
		$cell_right = str_replace(">>COUNTER<<",$counter,$cell_right);
		$content = str_replace(">>LOGO<<",$logo,$tpl);
		$content = str_replace(">>CELL_LEFT<<",$cell_left.$br.$cell_search.$cell_valid,$content);
		$content = str_replace(">>CELL_MAIN<<",$index,$content);
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "1") {
			$menue_user = $template->load("menue-user.tpl");
			$menue_user = str_replace(">>USER<<",$_SESSION['user'],$menue_user);
			$content = str_replace(">>CELL_RIGHT<<",$menue_user.$br.$cell_right,$content);
		} else {
			$content = str_replace(">>CELL_RIGHT<<",$cell_login.$br.$cell_right,$content);
		}
		return $content;
	}
	function output() {
		$render = $this->portal();
		$render = str_replace("\r","",$render);
		$content = str_replace("\n","",$render);
		return $content;
	}
}
?>