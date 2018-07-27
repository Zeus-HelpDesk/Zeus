<?php

namespace App\Markdown\Elements;

use League\CommonMark\Inline\Element\AbstractWebResource;
use League\CommonMark\Inline\Element\Text;

class EmojiElement extends AbstractWebResource
{
    /**
     * @param string $url
     * @param string|null $label
     * @param string $title
     */
    public function __construct($url, $label = null)
    {
        parent::__construct($url);

        if (is_string($label)) {
            $this->appendChild(new Text($label));
        }
    }
}