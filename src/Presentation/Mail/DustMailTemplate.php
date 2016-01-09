<?php

namespace JGimeno\TaskReporter\Presentation\Mail;

use Dust\Dust;
use JGimeno\TaskReporter\Domain\Entity\Task;
use JGimeno\TaskReporter\Domain\Entity\WorkingDay;

class DustMailTemplate implements MailTemplateInterface
{
    /**
     * @var Dust
     */
    private $templateEngine;

    /**
     * @var
     */
    private $templateFile;

    /**
     * DustMailTemplate constructor.
     *
     * @param Dust $templateEngine The engine used to render the template.
     */
    public function __construct(Dust $templateEngine, $templateFile)
    {
        $this->templateEngine = $templateEngine;
        $this->templateFile = $templateFile;
    }

    /**
     * Renders the body of the email.
     *
     * @param WorkingDay $day
     * @return string The subject.
     */
    public function renderSubject(WorkingDay $day)
    {
        // TODO: Implement renderSubject() method.
    }

    /**
     * Renders the body of the email.
     *
     * @param WorkingDay $day
     * @return string the body.
     */
    public function renderBody(WorkingDay $day)
    {
        $template = $this->templateEngine->compileFile($this->templateFile);

        $tasks = $this->formatTasks($day);

        $output = $this->templateEngine->renderTemplate($template, [
            'tasks' => $tasks
        ]);

        return $output;
    }

    private function formatTasks(WorkingDay $day)
    {
        $tasks = [];

        /**
         * @var $task Task
         */
        foreach ($day->getTasks() as $task) {
            $tasks[] = ['task' => $task];
        }

        return $tasks;
    }
}