<?php

namespace App\Markdown;
use App\Markdown\Parsers\EmojiParser;
use App\Markdown\Parsers\TicketMentionParser;
use App\Markdown\Parsers\UserMentionParser;
use App\Markdown\Renderers\EmojiRenderer;
use League\CommonMark\ConfigurableEnvironmentInterface;
use League\CommonMark\Extension\ExtensionInterface;

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