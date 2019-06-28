<?php

namespace App\Markdown\Parsers;

use App\Models\Ticket;
use League\CommonMark\Inline\Element\Link;
use League\CommonMark\Inline\Parser\AbstractInlineParser;
use League\CommonMark\InlineParserContext;
use URL;

class TicketMentionParser extends AbstractInlineParser
{

    /**
     * @return string[]
     */
    public function getCharacters()
    {
        return ['#'];
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
        // Parse the ticket ID
        $handle = $cursor->match('/^[A-Za-z0-9]{1,' . config('hashids.connections.main.length') . '}(?!\w)/');
        if (empty($handle)) {
            // Regex failed to match; this isn't a valid ticket
            $cursor->restoreState($previousState);
            return false;
        }

        $ticket = Ticket::whereHash($handle)->get(['hash'])->first();
        if (empty($ticket)) {
            $cursor->restoreState($previousState);
            return false;
        }
        $ticketUrl = URL::to('/ticket/' . $ticket->hash);
        $inlineContext->getContainer()->appendChild(new Link($ticketUrl, '#' . $ticket->hash));
        return true;
    }
}
