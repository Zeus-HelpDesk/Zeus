<?php

namespace App\Markdown;

use App\Markdown\Elements\EmojiElement;
use App\Markdown\Parsers\EmojiParser;
use App\Markdown\Parsers\TicketMentionParser;
use App\Markdown\Parsers\UserMentionParser;
use App\Markdown\Renderers\EmojiRenderer;
use League\CommonMark\Block\Parser\BlockParserInterface;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\ConfigurableEnvironmentInterface;
use League\CommonMark\DocumentProcessorInterface;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Inline\Parser\InlineParserInterface;
use League\CommonMark\Inline\Processor\InlineProcessorInterface;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;

class MarkdownExtension implements ExtensionInterface
{

    public function register(ConfigurableEnvironmentInterface $environment)
    {
        $environment->addInlineParser(new EmojiParser());
        $environment->addInlineParser(new TicketMentionParser());
        $environment->addInlineParser(new UserMentionParser());
        $environment->addInlineRenderer('App\Markdown\Elements\EmojiElement', new EmojiRenderer());
    }
}