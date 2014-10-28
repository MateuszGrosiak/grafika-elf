<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Zaloguj się</h3>
            </div>
            <div class="panel-body">
                <?php echo $this->Form->create('User', array('action' => 'login', 'role' => 'form')); ?>
                    <fieldset>
                        <div class="form-group">
                            <?php echo $this->Form->input('username', array("placeholder" => "login", "class" => "form-control", "label" => "Login", "autofocus" => "autofocus")) ?>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('password', array("placeholder" => "hasło", "label" => "Hasło", "class" => "form-control")) ?>
                        </div>
                        <!--<div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me">Remember Me
                            </label>
                        </div>-->
                        <?php echo $this->Form->submit("Zaloguj", array("class" => "btn btn-lg btn-success btn-block")) ?>
                    </fieldset>
                <?php echo $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>