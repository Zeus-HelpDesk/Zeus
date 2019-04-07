<?php

namespace App\Http\Controllers;

use Cache;
use GrahamCampbell\GuzzleFactory\GuzzleFactory;
use Illuminate\Http\Request;

class EmojiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $emoji = $this->emoji_find($request->query('search'), (array)$this->getEmoji());
        } else {
            $emoji = $this->getEmoji();
        }
        return response()->json($emoji);
    }

    /**
     * Allows searching through the emoji array
     *
     * @param $needle
     * @param array $haystack
     * @param null $column
     * @return array
     */
    private function emoji_find($needle, array $haystack, $column = null)
    {
        if ($needle === null) {
            return [];
        }
        $search = [];
        foreach ($haystack as $key => $value) {
            if (strpos(strtolower($key), strtolower($needle)) !== false) {
                $search[$key] = $haystack[$key];
            }
        }
        return $search;
    }

    /**
     * This function will get the Emoji data and map it to a better format
     *
     * @return mixed
     */
    public function getEmoji()
    {
        return Cache::remember('emoji_short_data', 240, function () {
            $array = [];
            $headers = ['Accept' => 'application/json'];
            $result = GuzzleFactory::make()->get('https://cdn.rawgit.com/iamcal/emoji-data/master/emoji.json', ['headers' => $headers]);
            $raw_data = (array)json_decode((string)$result->getBody(), true);
            foreach ($raw_data as $key => $emoji) {
                $emoji = (object)$emoji;
                // This handles the regular emoji
                if ($emoji->has_img_twitter) {
                    foreach ($emoji->short_names as $shortname) {
                        $array[str_replace('-', '_', $shortname)] = [
                            'img' => 'https://cdn.rawgit.com/iamcal/emoji-data/master/img-twitter-64/' . strtolower($emoji->unified) . '.png',
                            'unicode' => $this->unicode_bytes($emoji->unified)
                        ];
                    }
                }
                // This stuff here handles the emoji skin tones
                if (array_key_exists('skin_variations', (array)$emoji)) {
                    foreach ($emoji->skin_variations as $skin => $skinTone) {
                        $skinTone = (object)$skinTone;
                        switch ($skin) {
                            case '1F3FB':
                                if ($skinTone->has_img_twitter) {
                                    foreach ($emoji->short_names as $shortname) {
                                        $array[str_replace('-', '_', $shortname) . '_tone1']['unicode'] = $this->unicode_bytes($skinTone->unified);
                                        $array[str_replace('-', '_', $shortname . '_tone1')]['img'] = 'https://raw.githubusercontent.com/iamcal/emoji-data/master/img-twitter-64/' . strtolower($skinTone->unified) . '.png';
                                    }
                                }
                                break;
                            case '1F3FC':
                                if ($skinTone->has_img_twitter) {
                                    foreach ($emoji->short_names as $shortname) {
                                        $array[str_replace('-', '_', $shortname) . '_tone2']['unicode'] = $this->unicode_bytes($skinTone->unified);
                                        $array[str_replace('-', '_', $shortname . '_tone2')]['img'] = 'https://raw.githubusercontent.com/iamcal/emoji-data/master/img-twitter-64/' . strtolower($skinTone->unified) . '.png';
                                    }
                                }
                                break;
                            case '1F3FD':
                                if ($skinTone->has_img_twitter) {
                                    foreach ($emoji->short_names as $shortname) {
                                        $array[str_replace('-', '_', $shortname) . '_tone3']['unicode'] = $this->unicode_bytes($skinTone->unified);
                                        $array[str_replace('-', '_', $shortname . '_tone3')]['img'] = 'https://raw.githubusercontent.com/iamcal/emoji-data/master/img-twitter-64/' . strtolower($skinTone->unified) . '.png';
                                    }
                                }
                                break;
                            case '1F3FE':
                                if ($skinTone->has_img_twitter) {
                                    foreach ($emoji->short_names as $shortname) {
                                        $array[str_replace('-', '_', $shortname) . '_tone4']['unicode'] = $this->unicode_bytes($skinTone->unified);
                                        $array[str_replace('-', '_', $shortname . '_tone4')]['img'] = 'https://raw.githubusercontent.com/iamcal/emoji-data/master/img-twitter-64/' . strtolower($skinTone->unified) . '.png';
                                    }
                                }
                                break;
                            case '1F3FF':
                                if ($skinTone->has_img_twitter) {
                                    foreach ($emoji->short_names as $shortname) {
                                        $array[str_replace('-', '_', $shortname) . '_tone5']['unicode'] = $this->unicode_bytes($skinTone->unified);
                                        $array[str_replace('-', '_', $shortname . '_tone5')]['img'] = 'https://raw.githubusercontent.com/iamcal/emoji-data/master/img-twitter-64/' . strtolower($skinTone->unified) . '.png';
                                    }
                                }
                                break;
                        }
                    }
                }
            }
            return $array;
        });
    }

    /**
     * This function will convert the unified data into valid unicode
     *
     * @param string $string
     * @return string
     */
    private function unicode_bytes($string)
    {
        $out = '';
        $cps = explode('-', $string);
        foreach ($cps as $cp) {
            $out .= $this->emoji_utf8_bytes(hexdec($cp));
        }
        return $out;
    }

    /**
     * This helps with the unicode_bytes function for returning valid unicode
     *
     * @param int $cp
     * @return string
     */
    private function emoji_utf8_bytes($cp)
    {
        if ($cp > 0x10000) {
            # 4 bytes
            return chr(0xF0 | (($cp & 0x1C0000) >> 18)) .
                chr(0x80 | (($cp & 0x3F000) >> 12)) .
                chr(0x80 | (($cp & 0xFC0) >> 6)) .
                chr(0x80 | ($cp & 0x3F));
        } else if ($cp > 0x800) {
            # 3 bytes
            return chr(0xE0 | (($cp & 0xF000) >> 12)) .
                chr(0x80 | (($cp & 0xFC0) >> 6)) .
                chr(0x80 | ($cp & 0x3F));
        } else if ($cp > 0x80) {
            # 2 bytes
            return chr(0xC0 | (($cp & 0x7C0) >> 6)) .
                chr(0x80 | ($cp & 0x3F));
        } else {
            # 1 byte
            return chr($cp);
        }
    }
}
