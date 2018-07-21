<?php

namespace App\Markdown;

use App\Markdown\Parsers\TicketMentionParser;
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
        // TODO: Implement getBlockParsers() method.
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
        ];
    }

    /**
     * Returns a list of inline processors to add to the existing list
     *
     * @return InlineProcessorInterface[]
     */
    public function getInlineProcessors()
    {
        // TODO: Implement getInlineProcessors() method.
    }

    /**
     * Returns a list of document processors to add to the existing list
     *
     * @return DocumentProcessorInterface[]
     */
    public function getDocumentProcessors()
    {
        // TODO: Implement getDocumentProcessors() method.
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
        // TODO: Implement getBlockRenderers() method.
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
        // TODO: Implement getInlineRenderers() method.
    }
}