<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('kickstart');
		echo $this->Html->css('style');

		echo $this->Html->script('jquery');
		echo $this->Html->script('kickstart');


		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
<div id="container" class="grid">
    <header>
    <div class="col_4 column ">
        <h1><a href="<?php echo $this->webroot; ?>"><strong>Job</strong>Finds</a></h1>
    </div>
		<div class="col_6 column right welcome">
			<?php if(AuthComponent::user('id')) :?>
				<h6>Welcome:  <strong style="text-transform: capitalize;"><?php echo $userData['first_name'].' '.$userData['last_name']; ?></strong></h6>
				<a href="<?php echo $this->webroot; ?>users/logout">Logout</a>
			<?php endif; ?>
		</div>
    <div class="col_2 column right">
        <form id="add_job_link" action="<?php $this->webroot; ?>jobs/add">
            <button class="green large"><i class="fa fa-plus-square"></i> Add Job </button>
        </form>
    </div>
    </header>
    <div class="col_12 column">
        <!-- Menu Horizontal -->
        <ul class="menu">
			<li <?php echo ( $this->here =='/jobfinds/' || $this->here=='/jobfinds/jobs') ? 'class="current"' :'' ?>><a href="<?php echo $this->webroot; ?>"><i class="fa fa-home"></i> Home </a></li>
            <li <?php echo ( $this->here=='/jobfinds/jobs/browse') ? 'class="current"':'' ?>><a href="<?php echo $this->webroot; ?>jobs/browse"><i class="fa fa-desktop"></i> Browse Jobs</a></li>
            <li <?php echo ( $this->here=='/jobfinds/users/register') ? 'class="current" ':'' ?>><a href="<?php echo $this->webroot; ?>users/register"><i class="fa fa-user"></i> Register</a> </li>
            <li <?php echo ( $this->here=='/jobfinds/users/login') ? 'class="current"':'' ?>><a href="<?php echo $this->webroot; ?>users/login"><i class="fa fa-key"></i> Login</a></li>
        </ul>
    </div>
    <div class="col_12 column">
		<?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
    </div>
    <div class="clearfix"></div>
    <footer>
        <p>Copyright @copy; 2016 JobFinds ,All Rights Reseved</p>
    </footer>



</div> <!-- End Grid -->
</body>
</html>
