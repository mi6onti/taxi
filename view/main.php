<div class="container main-view">
    <?php if (!isset($this->user_id)): ?> 
        <div class="row-fluid col-md-12">
            <form method="post" action="<?php echo \libs\AltoRouter::getInstance()->generate('index', array('action' => 'show')); ?>">
                <label for="password" class="col-md-1">E-mail: </label>
                <div class="col-md-3">
                    <input id="email" class="form-control input-md" type="email" name="email" placeholder="Въведи email"/>
                </div> 
                <label for="password" class="col-md-1">Парола: </label>
                <div class="col-md-2">
                    <input id="password" class="form-control input-md" type="password" name="password" placeholder="Въведи парола"/>
                </div> 
                <div class="col-md-2">
                    <input type="submit" name="enter" value="Влез" class="btn btn-success">
                </div> 
            </form>
            <div class="col-md-3">
                <a href="<?php echo \libs\AltoRouter::getInstance()->generate('user', array('action' => 'add')); ?>" class="btn btn-default">Регистрирай се</a>
            </div> 
        </div>
    <?php endif; ?>
    <div class="row-fluid col-md-12">
        <h2 class="col-md-7"><?php echo ($this->route_name == 'index' && isset($this->user_id)) ? 'Добре дошъл, ' . $this->username : (($this->route_name == 'user' && $this->action == 'add') ? '' : $this->navigation[$this->route_name]); ?></h2>
        <?php if (isset($this->user_id)): ?>
            <div class="col-md-5">
                <a href="<?php echo \libs\AltoRouter::getInstance()->generate('user', array('action' => 'edit', 'id'=>$this->user_id)); ?>">
                    <?php echo $this->email; ?>
                </a>
                (<?php echo $this->user_type_label; ?>)
                <a href="<?php echo \libs\AltoRouter::getInstance()->generate('index', array('action' => 'logout')); ?>" style="" class="btn btn-primary">Изход</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php if ($this->route_name == 'index'): ?>
    <img src="<?php echo $this->getHostPath(); ?>/public/images/taxi.png" />
<?php endif; ?>
