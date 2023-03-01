<!DOCTYPE html>
<!--[if lt IE 10]>      <html class="no-js lt-ie11 lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 10]>         <html class="no-js lt-ie11 lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 11]>         <html class="no-js lt-ie11"> <![endif]-->
<!--[if gt IE 11]><!-->
<html class="no-js" lang="en-US"> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->

	<title><?php echo get_bloginfo('name'); ?></title>

	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.min.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/hamburgers.min.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/media.min.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/rslides.min.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/skitter.styles.min.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/animate.min.css">
	<!-- <link type='text/css' rel='stylesheet' href='/calculators/KJECalc/KJE.css' />
	<link type='text/css' rel='stylesheet' href='/calculators/KJECalc/KJESiteSpecific.css' />  -->

	<?php if (is_home() || is_author() || is_category() || is_tag() || is_archive()) { ?>
		<link rel="stylesheet" href="<?php bloginfo("template_url") ?>/css/blog_css/blog-page.css">
	<?php } ?>

	<?php if (is_single()) { ?>
		<link rel="stylesheet" href="<?php bloginfo("template_url") ?>/css/blog_css/blog-single.css">
	<?php } ?>


	<?php if (is_user_logged_in()) { ?>
		<style>
			@media only screen and (max-width : 800px) {
				nav.toggle_right_style {
					top: 32px;
				}
			}

			@media only screen and (max-width : 782px) {
				nav.toggle_right_style {
					top: 46px;
				}
			}
		</style>
	<?php } ?>

	<?php if (is_front_page()) { ?>
		<style>
			.mtc_intro_transition {
				display: none;
				position: fixed;
				width: 100%;
				height: 100%;
				z-index: 1000;
				background: #fff;
				user-select: none;
			}

			.mtc_intro_transition div {
				position: relative;
				width: 100%;
				height: 100%;
				animation: mtc_fadeIn_desktop 2s;
			}

			.mtc_intro_transition figure {
				position: absolute;
				max-width: 600px;
				padding: 0 30px;
				width: 100%;
				left: 50%;
				top: 45%;
				transform: translate(-50%, -50%);
				transform-origin: 0 0;
			}

			@keyframes mtc_fadeIn_desktop {
				0% {
					transform: scale(0.95);
					opacity: 0;
				}

				10% {
					opacity: 1;
				}

				100% {
					transform: scale(1);
				}
			}

			@keyframes mtc_bg {
				0% {
					opacity: 1;
				}

				100% {
					opacity: 0;
				}
			}

			@keyframes mtc_transition_desktop {
				0% {
					top: 45%;
					left: 50%;
					transform: translate(-50%, -50%) scale(1);
					opacity: 1;
				}

				90% {
					top: 0%;
					left: 0%;
					transform: translate(0, 0) scale(0.5);
					opacity: 0;
				}

				100% {
					opacity: 0.2;
				}
			}
		</style>
	<?php } ?>

	<?php if (!is_front_page()) { ?>
		<style>
			.mtc_intro_transition {
				display: none;
			}
		</style>
	<?php } ?>

	<?php wp_head(); ?>
</head>

<body>
	<div class="protect-me">
		<div class="clearfix">

			<div class="mtc_intro_transition">
				<div>
					<div class="wrapper">
						<figure><img src="<?php bloginfo('template_url'); ?>/images/main-logo.png" alt="<?php echo get_bloginfo('name'); ?>" /></figure>
					</div>
				</div>
			</div>

			<!--?php if(is_front_page()) {?>	
	
		<div class="modal">
			<div class="modal-body">
				<a href="javascript:;" class="close-btn">X</a>
				<div class="modal-inner">
					< ?php
						unset($_SESSION);
						@session_start();
						$folder_name = get_template();
						require_once 'wp-content/themes/'.$folder_name.'/forms/FormsClass.php';
						$input = new FormsClass();

						$formname = 'Inquiry Form';
						$prompt_message = '<span style="color:#ff0000;"></span>';
						require_once 'wp-content/themes/'.$folder_name.'/forms/config2.php';
						if (isset($_POST['submit_info2'])) {

							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
							curl_setopt($ch, CURLOPT_POST, 1);
							curl_setopt($ch, CURLOPT_POSTFIELDS, "secret={$recaptcha_privite}&response={$_POST['g-recaptcha-response']}");
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							$server_output = curl_exec($ch);
							$result_recaptcha = json_decode($server_output);
							curl_close($ch);

							$_SESSION['Name'] = (isset($_POST['Name'])) ? $_POST['Name'] : '';
							$_SESSION['Phone_Number'] = (isset($_POST['Phone_Number'])) ? $_POST['Phone_Number'] : '';
							$_SESSION['Email_Address'] = (isset($_POST['Email_Address'])) ? $_POST['Email_Address'] : '';

							if (
								empty($_POST['Name']) ||
								empty($_POST['Phone_Number']) ||
								empty($_POST['Email_Address'])
							) {

								$asterisk = '<span style="color:#FF0000; font-weight:bold;">*&nbsp;</span>';
								$prompt_message = '<div id="error-msg"><div class="message"><p class="fail-check"><span>* Required Fields are empty.</span></p><br/><p class="error-close">x</p></div></div>';
							} else if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", stripslashes(trim($_POST['Email_Address'])))) {
								$prompt_message = '<div id="error-msg"><div class="message"><p class="fail-check"><span>Please enter a valid email address.</span></p><br/><p class="error-close">x</p></div></div>';
							} else if (!$result_recaptcha->success) {
								$prompt_message = '<div id="error-msg"><div class="message"><p class="fail-check"><span>Invalid reCAPTCHA</span></p><br/><p class="error-close">x</p></div></div>';
							} else {

								$body = '<div class="form_table" style="width:700px; height:auto; font-size:12px; color:#333333; letter-spacing:1px; line-height:20px; margin: 0 auto;">
									<div style="border:8px double #c3c3d0; padding:12px;">
									<div align="center" style="font-size:22px; font-family:Times New Roman, Times, serif; color:#051d38;">' . COMP_NAME . '</div>
									<div align="center" style="color:#990000; font-style:italic; font-size:20px; font-family:Arial; margin:bottom: 15px;">(' . $formname . ')</div>

									<table width="90%" cellspacing="2" cellpadding="5" align="center" style="font-family:Verdana; font-size:13px">
										';

								foreach ($_POST as $key => $value) {
									if ($key == 'secode') continue;
									elseif ($key == 'submit_info2') continue;
									elseif ($key == 'g-recaptcha-response') continue;

									if (!empty($value)) {
										$key2 = str_replace('_', ' ', $key);
										if ($value == ':') {
											$body .= '<tr><td colspan="2" style="background:#F0F0F0; line-height:30px"><b>' . $key2 . '</b></td></tr>';
										} else {
											$body .= '<tr><td><b>' . $key2 . '</b>:</td> <td>' . htmlspecialchars(trim($value), ENT_QUOTES) . '</td></tr>';
										}
									}
								}
								$body .= '
									</table>

									</div>
									</div>';

								// for email notification
								include 'wp-content/themes/'.$folder_name.'/forms/send_email_curl.php';

								// save data form on database
								include 'wp-content/themes/'.$folder_name.'/forms/savedb2.php';

								// save data form on database
								$subject = $formname;
								$attachments = array();

								//name of sender
								$name = $_POST['Name'];
								$result = insertDB($name, $subject, $body, $attachments);

								$parameter = array(
									'body' => $body,
									'from' => $from_email,
									'from_name' => $from_name,
									'to' => $to_email,
									'subject' => 'New Message Notification',
									'attachment' => $attachments
								);

								$success_message = '<div id="success"><div class="message"><p class="success-check"><span>THANK YOU</span><br/> <span>for sending us a message!</span><br/><span>We will be in touch with you soon.</span></p><p class="close">x</p></div></div>';
								$failed_message = '<div id="error-msg"><div class="message"><p class="fail-check"><span>Failed to send email. Please try again.</span></p><br/><p class="error-close">x</p></div></div>';

								$prompt_message = send_email($parameter, $success_message, $failed_message);
								unset($_SESSION);
							}
						}
					?>
					< ?php echo $prompt_message; ?>
					<form method="post" id="submit_formmessage" action="#">
						<div id="invalid-msg"></div>

						<input type="text" class="form_name" name="Name" value="< ?php echo $_SESSION['Name']; ?>" placeholder="*Name" required>

						<input type="text" class="form_phone_number" name="Phone_Number" value="< ?php echo $_SESSION['Phone_Number']; ?>" placeholder="*Phone Number" required>
						
						<input type="email" class="form_email" name="Email_Address" value="< ?php echo $_SESSION['Email_Address']; ?>" placeholder="*Email Address" required>

						<div class="captcha-box">
							<div class="g-recaptcha" data-sitekey="< ?php echo $recaptcha_sitekey; ?>"></div>
						</div>

						<button class="form_btn" type="submit" name="submit_info2">Submit</button>
					</form>
				</div>
			</div>
		</div>
		
	< ?php } ?-->