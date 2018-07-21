<?php

namespace App\Markdown\Parsers;

use App\User;
use League\CommonMark\Inline\Element\Link;
use League\CommonMark\Inline\Parser\AbstractInlineParser;
use League\CommonMark\InlineParserContext;

class UserMentionParser extends AbstractInlineParser
{

    /**
     * @return string[]
     */
    public function getCharacters()
    {
        return ['@'];
    }

    /**
     * @param InlineParserContext $inlineContext
     *
     * @return bool
     */
    public function parse(InlineParserContext $inlineContext)
    {
        $cursor = $inlineContext->getCursor();
        // The @ symbol must not have any other characters immediately prior
        $previousChar = $cursor->peek(-1);
        if ($previousChar !== null && $previousChar !== ' ') {
            // peek() doesn't modify the cursor, so no need to restore state first
            return false;
        }
        // Save the cursor state in case we need to rewind and bail
        $previousState = $cursor->saveState();
        // Advance past the @ symbol to keep parsing simpler
        $cursor->advance();
        // Parse the user slug
        $handle = $cursor->match('/^[A-Za-z0-9.]{1,255}(?!\w)/');
        if (empty($handle)) {
            // Regex failed to match; this isn't a valid ticket
            $cursor->restoreState($previousState);
            return false;
        }

        $user = User::whereSlug($handle)->get(['slug'])->first();
        if (empty($user)) {
            $cursor->restoreState($previousState);
            return false;
        }
        $ticketUrl = config('app.url') . '/user/' . $user->slug;
        $inlineContext->getContainer()->appendChild(new Link($ticketUrl, '@' . $user->slug));
        return true;
    }
}