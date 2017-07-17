<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1">
    <title><?php echo bloginfo('name'); ?></title>
    <?php wp_head();?>
</head>

	<nav class=" navbar fixed-top navbar-toggleable-md navbar-inverse bg-inverse">				
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<a class="navbar-brand" href="#" style="font-family: ;">
			<img src="<?php echo esc_url(get_template_directory_uri()."/dist/img/logo.png");?>" class="d-inline-block align-top logo" alt="">
		</a>
		<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a role="button" class="btn btn-outline-secondary admin-button" href="wp/wp-login.php">
						ADMINISTRATOR LOGIN<span class="sr-only">(current)</span>
					</a>
				</li>
			</ul>
		</div>
	</nav>

<body>
    