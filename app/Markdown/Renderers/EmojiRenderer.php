<?php

namespace App\Markdown\Renderers;

use App\Markdown\Elements\Emoji;
use App\Markdown\Elements\EmojiElement;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\HtmlElement;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;

class EmojiRenderer implements InlineRendererInterface
{
    /**
     * @param AbstractInline $inline
     * @param ElementRendererInterface $htmlRenderer
     *
     * @return HtmlElement|string
     */
    public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
    {
        if (!($inline instanceof EmojiElement)) {
            throw new \InvalidArgumentException('Incompatible inline type: ' . get_class($inline));
        }

        $attrs = [];
        $attrs['src'] = $inline->getUrl();
        $attrs['class'] = "emoji";
        $attrs['alt'] = $htmlRenderer->renderInlines($inline->children());
        //$attrs['style'] = "background-image: url('" . $inline->getUrl() . "')";
        return new HtmlElement('img', $attrs);
    }
}