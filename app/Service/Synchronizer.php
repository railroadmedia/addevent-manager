<?php

namespace Railroad\AddEventManager;

class Synchronizer
{
    /**
     * @var Doer
     */
    private $doer;
    /**
     * @var Evaluator
     */
    private $evaluator;

    public function __construct(
        Doer $doer,
        Evaluator $evaluator
    )
    {
        $this->doer = $doer;
        $this->evaluator = $evaluator;
    }

    public function synchronize($brand, $type)
    {
        // set brand on...? Doer|Evaluator...? SDK class?


        // set whether or not to use sandbox. Store in|on...? Doer|Evaluator...? SDK class?


        // get content


        // get AddEvent schedule for content type


        // get brand-overview schedule


        // jsonify content
            // some kind of model or class for this?


        // get changed


        // update changed


        // get missing


        // add missing


        // get obsolete


        // delete obsolete


        // return results


    }
}
