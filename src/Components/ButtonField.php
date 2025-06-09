<?php

namespace NguyenKhoi\FileManager\Components;

use Illuminate\View\Component;

class ButtonField extends Component
{

    public function __construct(
        public string $type = 'button',
        public string $class = '',
        public string $text = '',
        public string $icon = '',
        public array  $attrs = [],
    )
    {

    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        // TODO: Implement render() method.
    }
}
