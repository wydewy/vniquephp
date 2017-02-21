<?php
namespace vnique\base;

/**
 * Controller is the base class for classes containing controller logic.
 * @author wydewy <wydewy@126.com>
 */
class Controller
{
    /**
     * @var string the ID of this controller.
     */
    public $id;
    /**
     * @var Action the action that is currently being executed.
     */
    public $action;
}
