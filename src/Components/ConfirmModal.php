<?php

namespace NguyenKhoi\FileManager\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmModal extends Component
{

    public function __construct(
        public string  $modalId,
        public string  $modalTitle,
        public array   $modalAttributes = [],
        public array   $inputField = [],
        public bool    $addField = false,
        public ?string $field = '',
        public array   $buttons = [],
        public bool    $isForm = false,
        public array   $formFields = [],
        public ?string $icon = null,
        public string  $slotHtml = '',
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('file-manager::components.confirm-modal');
    }
}
