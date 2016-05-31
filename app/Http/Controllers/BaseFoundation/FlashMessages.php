<?php namespace App\Http\Controllers\BaseFoundation;

trait FlashMessages
{
    private $errorMessages = [], $infoMessages = [], $successMessages = [], $warningMessages = [];

    protected function _setFlashMessage($message, $type)
    {
        $model = 'infoMessages';
        switch ($type) {
            case 'info':
                {
                    $model = 'infoMessages';
                }break;
            case 'error':
                {
                    $model = 'errorMessages';
                }break;
            case 'danger':
                {
                    $model = 'errorMessages';
                }break;
            case 'success':
                {
                    $model = 'successMessages';
                }break;
            case 'warning':
                {
                    $model = 'warningMessages';
                }break;
        }
        if (is_array($message)) {
            foreach ($message as $key => $value) {
                array_push($this->$model, $value);
            }
        } else {
            array_push($this->$model, $message);
        }
    }

    protected function _getFlashMessages()
    {
        return [
            'errorMessages' => $this->errorMessages,
            'infoMessages' => $this->infoMessages,
            'successMessages' => $this->successMessages,
            'warningMessages' => $this->warningMessages,
        ];
    }

    protected function _showFlashMessages()
    {
        session()->flash('errorMessages', $this->errorMessages);
        session()->flash('infoMessages', $this->infoMessages);
        session()->flash('successMessages', $this->successMessages);
        session()->flash('warningMessages', $this->warningMessages);
    }
}
