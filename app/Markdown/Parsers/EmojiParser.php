<?php

namespace App\Markdown\Parsers;

use App\Http\Controllers\EmojiController;
use App\Markdown\Elements\EmojiElement;
use League\CommonMark\Inline\Parser\AbstractInlineParser;
use League\CommonMark\InlineParserContext;

class EmojiParser extends AbstractInlineParser
{

    /**
     * @return string[]
     */
    public function getCharacters()
    {
        return [':'];
    }

    /**
     * @param InlineParserContext $inlineContext
     *
     * @return bool
     */
    public function parse(InlineParserContext $inlineContext)
    {
        $emoji = new EmojiController();
        $map = $emoji->getEmoji();
        $cursor = $inlineContext->getCursor();
        $previous = $cursor->peek(-1);
        if ($previous !== null && $previous !== ' ') {
            return false;
        }
        $saved = $cursor->saveState();
        $cursor->advance();
        $handle = $cursor->match('/^[a-z0-9\+\-_]+:/');
        if (!$handle) {
            $cursor->restoreState($saved);
            return false;
        }
        $next = $cursor->peek(0);
        if ($next !== null && $next !== ' ') {
            $cursor->restoreState($saved);
            return false;
        }
        $key = substr($handle, 0, -1);
        if (!array_key_exists($key, $map)) {
            $cursor->restoreState($saved);
            return false;
        }
        $inline = new EmojiElement($map[$key]['img'], $key . ' Emoji');
        $inline->data['attributes'] = ['class' => 'emoji', 'data-emoji' => $key];
        $inlineContext->getContainer()->appendChild($inline);
        return true;
    }
}