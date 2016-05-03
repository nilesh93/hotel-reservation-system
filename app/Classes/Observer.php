<?php

namespace App\Classes;

    abstract class Observer
    {

        public function _construct($subject = null)
        {
            if(is_object($subject) && $subject instanceof Subject) {
                $subject->attach($this);
            }
        }

        public function update($subject)
        {
            if(method_exists($this,$subject->getState())) {
                call_user_func_array(array($this,$subject->getState()),array($subject));

            }

        }


    }