<?php

namespace App;

class DiffString
{
    const NONE = -1;
    const SIMILAR = 0;
    const DELETED = 1;
    const MODIFIED = 2;
    const INSERTED = 3;

    public $data;
    public $type;

    public function __construct($data, $type = self::NONE)
    {
        $this->data = $data;
        $this->type = $type;
    }

    public function similar_to($s)
    {
        $percent = 0;
        similar_text($this->data, $s, $percent);
        return $percent;
    }
}

class TextDiffer
{
    const SIMILAR_PERCENT = 95.0;
    const MODIFIED_PERCENT = 80.0;

    public function compare($text1, $text2)
    {
        $result = [];
        $strings1 = $this->split_text($text1);
        $strings2 = $this->split_text($text2);

        foreach ($strings2 as $i => $s2) {
            $result[] = new DiffString($s2);
        }

        foreach ($strings1 as $i => $s1) {
            $most_similar = [
                'index' => -1,
                'percent' => 0
            ];

            foreach ($result as $j => $str) {
                if ($str->type !== DiffString::NONE) {
                    continue;
                }

                $percent = $str->similar_to($s1);
                if ($percent >= self::MODIFIED_PERCENT && $percent > $most_similar['percent']) {
                    $most_similar['index'] = $j;
                    $most_similar['percent'] = $percent;
                }
            }

            if ($most_similar['index'] === -1) {
                $str = new DiffString($s1, DiffString::DELETED);
                array_splice($result, $i, 0, [$str]);
            } else {
                $str = $result[$most_similar['index']];
                if ($most_similar['percent'] >= self::SIMILAR_PERCENT) {
                    $str->type = DiffString::SIMILAR;
                } elseif ($most_similar['percent'] >= self::MODIFIED_PERCENT) {
                    $str->type = DiffString::MODIFIED;
                }
            }
        }

        foreach ($result as $str) {
            if ($str->type === DiffString::NONE) {
                $str->type = DiffString::INSERTED;
            }
        }

        // error_log(print_r($result, true));
        return $result;
    }

    private function split_text($text)
    {
        // FIXME: explode('\n', ...);
        return preg_split('/\r\n|\r|\n/', $text);
    }
}
