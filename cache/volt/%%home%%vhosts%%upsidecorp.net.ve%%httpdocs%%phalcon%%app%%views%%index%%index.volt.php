
<?php echo $this->getContent(); ?>

<div class="hero-unit">
    <h1>Welcome to EasyTasks++</h1>
    <p><?php echo Phalcon\Tag::linkTo(array('session/register', 'Try it for Free &raquo;', 'class' => 'btn btn-primary btn-large btn-success')); ?></p>
    <p><?php echo Phalcon\Tag::linkTo(array('session', 'Login', 'class' => 'btn btn-primary btn-large btn-success')); ?></p>
</div>