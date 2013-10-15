
<?php echo $this->getContent(); ?>

<div class="login-or-signup">
    <div class="row">

        <div class="span6">
            <div class="page-header">
                <h2>Log In</h2>
            </div>
            <?php echo Phalcon\Tag::form(array('session/start', 'class' => 'form-inline')); ?>
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="email">Username/Email</label>
                        <div class="controls">
                            <?php echo Phalcon\Tag::textField(array('email', 'size' => '30', 'class' => 'input-xlarge')); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="password">Password</label>
                        <div class="controls">
                            <?php echo Phalcon\Tag::passwordField(array('password', 'size' => '30', 'class' => 'input-xlarge')); ?>
                        </div>
                    </div>
                    <div class="form-actions">
                        <?php echo Phalcon\Tag::submitButton(array('Login', 'class' => 'btn btn-primary btn-large')); ?>
                    </div>
                </fieldset>
            </form>
        </div>

        <div class="span6">
            <div class="page-header">
                <h2>Don't have an account yet?</h2>
            </div>
            <div class="clearfix center">
                <?php echo Phalcon\Tag::linkTo(array('session/register', 'Sign Up', 'class' => 'btn btn-primary btn-large btn-success')); ?>
            </div>
        </div>

    </div>
</div>
