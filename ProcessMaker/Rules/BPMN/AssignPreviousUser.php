<?php

namespace ProcessMaker\Rules\BPMN;

use Illuminate\Contracts\Validation\Rule;
use ProcessMaker\Nayra\Storage\BpmnElement;
use ProcessMaker\Providers\WorkflowServiceProvider;

class AssignPreviousUser implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $id
     * @param  mixed  $node
     * @return bool
     */
    public function passes($id, $node)
    {
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('Previous Task Assignee rule can not be used in task ":attribute"');
    }

    /**
     * This rule applies to task and userTask nodes
     *
     * @param BpmnElement $node
     *
     * @return boolean
     */
    public static function applyTo(BpmnElement $node)
    {
        return in_array($node->localName, ['task', 'userTask'])
            && $node->getAttributeNS(WorkflowServiceProvider::PROCESS_MAKER_NS, 'assignment') === 'previous_task_assignee';
    }
}
