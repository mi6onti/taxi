<div class="container col-md-offset-2 col-md-9 content">
    <h3><?php echo ($this->action == 'edit') ? 'Редакция' : ($this->route_name == 'user') ? '' : 'Добавяне на нов запис'; ?></h3>
    <form method="post" action="<?php echo $this->action_url; ?>">
        <table class="table table-bordered table-inverse">
            <?php foreach ($this->params as $field => $details): ?>
                <?php if (!isset($details['readonly']) && isset($details['label'])): ?>
                    <tr>
                        <th><?php echo $details['label']; ?>:</th>
                        <td>
                            <?php if ($details['type'] === 'text' || $details['type'] == 'email' || $details['type'] == 'password'): ?>
                                <input class="form-control input-sm" type="<?php echo $details['type']; ?>" placeholder="Въведи <?php echo mb_strtolower($details['label'], 'UTF-8'); ?>" value="<?php echo (isset($details['value'])) ? $details['value'] : ''; ?>" name="<?php echo $field; ?>" />
                            <?php elseif ($details['type'] === 'select'): ?>
                                <select class="form-control" name="<?php echo $field; ?>">
                                    <?php foreach ($details['ref'] as $ref_id => $ref_fields): ?>
                                        <option <?php echo (isset($details['value']) && $ref_id == $details['value']) ? 'selected' : ''; ?> value="<?php echo $ref_id; ?>">
                                            <?php echo (isset($details['sub_ref'])) ? $details['sub_ref'][$ref_id]['name']['value'] . ' ' : ''; ?>
                                            <?php echo (isset($details['concatenated_value'])) ? $details['concatenated_value'][$ref_id] : $ref_fields['name']['value']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
        <?php if ($this->action === 'edit'): ?> 
            <input type="hidden" value="<?php echo $this->params['id']['value']; ?>" name="id" />
        <?php endif; ?>
        <input class="btn btn-primary" type="submit" name="save" value="<?php echo ($this->action == 'add' && $this->route_name == 'user') ? 'Регистрация' : 'Запиши'; ?>"/>
    </form>
</div>