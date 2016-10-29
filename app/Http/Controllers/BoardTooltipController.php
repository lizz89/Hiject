<?php

/*
 * This file is part of Hiject.
 *
 * Copyright (C) 2016 Hiject Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hiject\Controller;

use Hiject\Model\UserMetadataModel;

/**
 * Board Tooltip
 */
class BoardTooltipController extends BaseController
{
    /**
     * Get links on mouseover
     *
     * @access public
     */
    public function tasklinks()
    {
        $task = $this->getTask();
        $this->response->html($this->template->render('board/tooltip_tasklinks', array(
            'links' => $this->taskLinkModel->getAllGroupedByLabel($task['id']),
            'task' => $task,
        )));
    }

    /**
     * Get links on mouseover
     *
     * @access public
     */
    public function externallinks()
    {
        $task = $this->getTask();
        $this->response->html($this->template->render('board/tooltip_external_links', array(
            'links' => $this->taskExternalLinkModel->getAll($task['id']),
            'task' => $task,
        )));
    }

    /**
     * Get subtasks on mouseover
     *
     * @access public
     */
    public function subtasks()
    {
        $task = $this->getTask();
        $this->response->html($this->template->render('board/tooltip_subtasks', array(
            'subtasks' => $this->subtaskModel->getAll($task['id']),
            'task' => $task,
        )));
    }

    /**
     * Display all attachments during the task mouseover
     *
     * @access public
     */
    public function attachments()
    {
        $task = $this->getTask();

        $this->response->html($this->template->render('board/tooltip_files', array(
            'files' => $this->taskFileModel->getAll($task['id']),
            'task' => $task,
        )));
    }

    /**
     * Display comments during a task mouseover
     *
     * @access public
     */
    public function comments()
    {
        $task = $this->getTask();
        $commentSortingDirection = $this->userMetadataCacheDecorator->get(UserMetadataModel::KEY_COMMENT_SORTING_DIRECTION, 'ASC');

        $this->response->html($this->template->render('board/tooltip_comments', array(
            'task' => $task,
            'comments' => $this->commentModel->getAll($task['id'], $commentSortingDirection)
        )));
    }

    /**
     * Display task description
     *
     * @access public
     */
    public function description()
    {
        $task = $this->getTask();

        $this->response->html($this->template->render('board/tooltip_description', array(
            'task' => $task
        )));
    }

    /**
     * Get recurrence information on mouseover
     *
     * @access public
     */
    public function recurrence()
    {
        $task = $this->getTask();

        $this->response->html($this->template->render('task_recurrence/info', array(
            'task' => $task,
            'recurrence_trigger_list' => $this->taskRecurrenceModel->getRecurrenceTriggerList(),
            'recurrence_timeframe_list' => $this->taskRecurrenceModel->getRecurrenceTimeframeList(),
            'recurrence_basedate_list' => $this->taskRecurrenceModel->getRecurrenceBasedateList(),
        )));
    }

    /**
     * Display swimlane description in tooltip
     *
     * @access public
     */
    public function swimlane()
    {
        $this->getProject();
        $swimlane = $this->swimlaneModel->getById($this->request->getIntegerParam('swimlane_id'));
        $this->response->html($this->template->render('board/tooltip_description', array('task' => $swimlane)));
    }
}
