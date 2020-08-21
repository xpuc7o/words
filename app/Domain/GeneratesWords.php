<?php


namespace App\Domain;

use App\Word;
use Illuminate\Database\Eloquent\Collection;


class GeneratesWords
{

    /**
     * @var array
     */
    protected $letters;

    /**
     * @var array
     */
    protected $words = [];

    public function __construct()
    {
        $this->letters = mb_str_split(trim(request('letters', '')));
    }

    public function handle()
    {
        return $this->generate($this->letters)
            ->removeShort()
            ->fetch();
    }

    /**
     * Generates all possible letter combinations.
     *
     * @param array $letters
     * @param string $temp
     * @return $this
     */
    protected function generate(array $letters, string $temp = '')
    {
        if ($temp != "") {
            $this->words[] = $temp;
        }

        $lettersCount = count($letters);

        for ($position = 0; $position < $lettersCount; $position++) {
            $lettersCopy = $letters;

            $letter = array_splice($lettersCopy, $position, 1);

            if (count($lettersCopy) > 0) {
                $this->generate($lettersCopy, $temp . "" . $letter[0]);
            } else {
                $this->words[] = $temp . "" . $letter[0];
            }
        }

        return $this;
    }

    /**
     * Remove words with less that 3 letters.
     *
     * @return $this
     */
    protected function removeShort()
    {
        foreach ($this->words as $key => $word) {
            $length = mb_strlen($word);

            if ($length < 3) {
                unset($this->words[$key]);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    protected function fetch()
    {
        return Word::whereIn('name', $this->words)
            ->orderBy('length')
            ->orderBy('name')
            ->get(['name', 'length']);
    }
}