<?php

namespace App\Markdown;

use App\Markdown\Parsers\EmojiParser;
use App\Markdown\Parsers\TicketMentionParser;
use App\Markdown\Parsers\UserMentionParser;
use App\Markdown\Renderers\EmojiRenderer;
use League\CommonMark\Block\Parser\BlockParserInterface;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\DocumentProcessorInterface;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Inline\Parser\InlineParserInterface;
use League\CommonMark\Inline\Processor\InlineProcessorInterface;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;

class MarkdownExtension implements ExtensionInterface
{

    /**
     * Returns a list of block parsers to add to the existing list
     *
     * @return BlockParserInterface[]
     */
    public function getBlockParsers()
    {
        return [];
    }

    /**
     * Returns a list of inline parsers to add to the existing list
     *
     * @return InlineParserInterface[]
     */
    public function getInlineParsers()
    {
        return [
            new TicketMentionParser(),
            new UserMentionParser(),
            new EmojiParser(),
        ];
    }

    /**
     * Returns a list of inline processors to add to the existing list
     *
     * @return InlineProcessorInterface[]
     */
    public function getInlineProcessors()
    {
        return [];
    }

    /**
     * Returns a list of document processors to add to the existing list
     *
     * @return DocumentProcessorInterface[]
     */
    public function getDocumentProcessors()
    {
        return [];
    }

    /**
     * Returns a list of block renderers to add to the existing list
     *
     * The list keys are the block class names which the corresponding value (renderer) will handle.
     *
     * @return BlockRendererInterface[]
     */
    public function getBlockRenderers()
    {
        return [];
    }

    /**
     * Returns a list of inline renderers to add to the existing list
     *
     * The list keys are the inline class names which the corresponding value (renderer) will handle.
     *
     * @return InlineRendererInterface[]
     */
    public function getInlineRenderers()
    {
        return [
            'App\Markdown\Elements\EmojiElement' => new EmojiRenderer()
        ];
    }
}