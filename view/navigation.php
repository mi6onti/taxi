<!-- Sidebar -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <?php foreach ($this->navigation as $key_route => $label): ?>
            <?php if($key_route == 'index' || (isset($this->user_type) && ($this->user_type == \models\UserType::USER_TYPE_ADMIN || (in_array($key_route, $this->permissions[$this->user_type]))))): ?>
            <li class="sidebar-brand">
                <a href = "<?php echo \libs\AltoRouter::getInstance()->generate($key_route, array('action' => 'show')); ?>" >
                    <?php echo $label; ?>
                </a>
            </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>
<!-- /#sidebar-wrapper -->