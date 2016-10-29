<div class="page-header">
    <h3><?= $this->url->link(t('My tasks'), 'DashboardController', 'tasks', array('user_id' => $user['id'])) ?> (<?= $paginator->getTotal() ?>)</h3>
</div>
<?php if ($paginator->isEmpty()): ?>
    <p class="alert"><?= t('There is nothing assigned to you.') ?></p>
<?php else: ?>
    <table class="table-striped table-small table-scrolling">
        <tr>
            <th class="column-5"><?= $paginator->order(t('Id'), \Hiject\Model\TaskModel::TABLE.'.id') ?></th>
            <th class="column-10"><?= $paginator->order(t('Project'), 'project_name') ?></th>
            <th class="column-22"><?= $paginator->order(t('Title'), \Hiject\Model\TaskModel::TABLE.'.title') ?></th>
            <th class="column-8"><?= $paginator->order(t('Priority'), \Hiject\Model\TaskModel::TABLE.'.priority') ?></th>
            <th class="column-8"><?= $paginator->order(t('Status'), \Hiject\Model\TaskModel::TABLE.'.is_active') ?></th>
            <th class="column-25"><?= t('Time tracking') ?></th>
            <th class="column-12"><?= $paginator->order(t('Due date'), \Hiject\Model\TaskModel::TABLE.'.date_due') ?></th>
            <th><?= $paginator->order(t('Column'), 'column_title') ?></th>
        </tr>
        <?php foreach ($paginator->getCollection() as $task): ?>
        <tr>
            <td class="task-table color-<?= $task['color_id'] ?>">
                <?= $this->render('task/dropdown', array('task' => $task)) ?>
            </td>
            <td>
                <?= $this->url->link($this->text->e($task['project_name']), 'BoardViewController', 'show', array('project_id' => $task['project_id'])) ?>
            </td>
            <td>
                <?= $this->url->link($this->text->e($task['title']), 'TaskViewController', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>
            </td>
            <td>
                <?php if ($task['priority'] != null): ?>
                    <?= $this->text->e(t('P'.$task['priority'])) ?>
                <?php endif?>
            </td>
            <td>
                <?php if ($task['is_active'] == \Hiject\Model\TaskModel::STATUS_OPEN): ?>
                        <?= t('Open') ?>
                    <?php else: ?>
                        <?= t('Closed') ?>
                <?php endif ?>
            </td>
            <td><small>
                <?php if (! empty($task['time_spent'])): ?>
                    <?= t('Time spent:') ?><strong><?= $this->text->e($task['time_spent']).t('hours') ?></strong>, 
                <?php endif ?>

                <?php if (! empty($task['time_estimated'])): ?>
                    <?= t('Time estimated:') ?><strong><?= $this->text->e($task['time_estimated']).t('hours') ?></strong>
                <?php endif ?>
            </small></td>
            <td>
                <?= $this->dt->date($task['date_due']) ?>
            </td>
            <td>
                <?= $this->text->e($task['column_title']) ?>
            </td>
        </tr>
        <?php endforeach ?>
    </table>

    <?= $paginator ?>
<?php endif ?>
