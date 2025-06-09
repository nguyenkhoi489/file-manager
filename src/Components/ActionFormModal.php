<?php

namespace NguyenKhoi\FileManager\Components;

use Illuminate\View\Component;

class ActionFormModal extends Component
{

    public function __construct(
        public string $modalId,
        public string $modalTitle,
        public string $actionUrl = '',
        public string $method = 'POST',
        public string $submitText = 'Submit',
        public array  $inputs = [],
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('file-manager::components.action-form-modal');
    }
}
