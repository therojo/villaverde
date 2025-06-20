<?php

namespace app\components;

use yii\base\Component;

class Utilerias extends Component
{
    public function isVariableValida($variable)
    {
        if (isset($variable) && $variable > 0) {
            return true;
        }

        return false;
    }
}