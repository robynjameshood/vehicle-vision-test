<?php

/*
  # EXERCISE ONE
*/

class LeagueTable
{
    public function __construct(array $players)
    {
        $this->standings = [];
        foreach ($players as $index => $p) {
            $this->standings[$p] = [
                'index' => $index,
                'games_played' => 0,
                'score' => 0
            ];
        }
    }

    public function recordResult(string $player, int $score): void
    {
        $this->standings[$player]['games_played']++;
        $this->standings[$player]['score'] += $score;
    }

    public function playerRank(int $rank): string
    {
        $position = array();
        $playerRankings = array();

        foreach ($this->standings as $name => $stats) {
            $position[] = $name;

            if (empty($playerRankings)) {
                array_push($playerRankings, $name, $stats);
            }
        }

        $playerRankings = $position;

        for ($outer = 0; $outer < count($playerRankings); $outer++) {
            for ($inner = 0; $inner < count($playerRankings); $inner++) {
                if ($this->standings[$playerRankings[$outer]]['score'] > $this->standings[$playerRankings[$inner]]['score']) {
                    $temp = $playerRankings[$outer];
                    $playerRankings[$outer] = $playerRankings[$inner];
                    $playerRankings[$inner] = $temp;
                }
                if ($this->standings[$playerRankings[$outer]]['score'] == $this->standings[$playerRankings[$inner]]['score']) {
                    if ($this->standings[$playerRankings[$outer]]['games_played'] < $this->standings[$playerRankings[$inner]]['games_played']) {
                        $temp = $playerRankings[$outer];
                        $playerRankings[$outer] = $playerRankings[$inner];
                        $playerRankings[$inner] = $temp;
                    }

                    if ($this->standings[$playerRankings[$outer]]['games_played'] == $this->standings[$playerRankings[$inner]]['games_played']) {

                        if (array_search($position[$outer], $position) < array_search($position[$inner], $position)) {
                            echo "debug";
                            $temp = $playerRankings[$outer];
                            $playerRankings[$outer] = $playerRankings[$inner];
                            $playerRankings[$inner] = $temp;
                        }
                    }
                }
            }
        }

        return $playerRankings[$rank-1];
    }
}

$table = new LeagueTable(array('Mike', 'Chris', 'Arnold'));
$table->recordResult('Mike', 2);
$table->recordResult('Mike', 3);
$table->recordResult('Arnold', 5);
$table->recordResult('Chris', 5);

echo $table->playerRank(1);


/*
  All players have the same score. However, Arnold and Chris have played fewer games than Mike, and as Chris is before Arnold in the 
  list of players, he is ranked first. Therefore, the code above should display "Chris".
*/

?>