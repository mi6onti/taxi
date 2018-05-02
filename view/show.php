<?php
$i = 0;
if(!is_array($this->params)){
    $this->params = array();
}
?>
<div class="container col-md-offset-1 col-md-10 content">
<table class="table table-bordered table-inverse">
    <thead>
    <?php foreach ($this->params as $row => $columns): ?>
        <?php $i++; ?>
        <?php if ($i == 1): ?>
            <tr>
                <?php foreach ($columns as $column => $details): ?>
                    <?php
                    if (isset($details['type']) && $details['type'] === 'password') {
                        continue;
                    }
                    ?>
                    <th><?php echo (isset($details['label'])) ? $details['label'] : '#'; ?></th>
            <?php endforeach; ?>
                <th>Действия</th>
            </tr>
            <?php endif; ?>
    </thead>
    <tbody>
        <tr>
            <?php foreach ($columns as $column => $details): ?>
                <?php
                if (isset($details['type']) && $details['type'] === 'password') {
                    continue;
                }
                ?>
                <td>
        <?php echo (isset($details['sub_ref'])) ? $details['sub_ref']['name']['value'] . ' ' : ''; ?>
            <?php echo (isset($details['ref'])) ? ((isset($details['concatenated_value'])) ? $details['concatenated_value'] : $details['ref']['name']['value']) : $details['value']; ?>
                </td>
    <?php endforeach; ?>
            <td>
                <?php if($this->user_type == \models\UserType::USER_TYPE_TAXI && $this->route_name == 'request'): ?>
                    <?php if(!$columns['to_user_id']['value']): ?>
                    <form action="<?php echo \libs\AltoRouter::getInstance()->generate($this->route_name, array('action' => 'show')); ?>" method="post">
                        <input type="submit" name="save" class="btn btn-success" value="Приеми"/>
                        <input type="hidden" name="id" value="<?php echo $row; ?>"/>
                        <input type="hidden" name="to_user_id" value="<?php echo $this->user_id; ?>"/>
                    </form>
                    <?php endif; ?>
                <?php else: ?>
                    <a class="btn btn-success" href="<?php echo \libs\AltoRouter::getInstance()->generate($this->route_name, array('action' => 'edit', 'id' => $row)); ?>">Редакция</a>
                <?php endif; ?>
            </td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php if($this->user_type !== \models\UserType::USER_TYPE_TAXI || $this->route_name!=='request'): ?>
    <a class="btn btn-default" href="<?php echo \libs\AltoRouter::getInstance()->generate($this->route_name, array('action' => 'add')); ?>">Добавяне на нов запис</a>
<?php endif; ?>
</div>