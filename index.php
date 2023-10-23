<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="CSS/main.css">
    </head>
    <body>
        <?php
        // Define softball positions and players
        $positions = ['Pitcher', 'Catcher', '1st', '2nd', 'SS', '3rd', 'LF', 'CLF', 'CRF', 'RF'];
        $players = ['Bentley', 'Alyssa', 'Chloe', 'Elaina', 'Emmy', 'Harper', 'Isla', 'Katelyn', 'Lily', 'Vanessa'];

        // Make sure there are enough players for all positions
        if (count($players) < count($positions)) {
            echo "Not enough players for all positions.";
            exit;
        }

        // Initialize an empty team array
        $team = [];

        // Create an array to keep track of player positions
        $playerPositions = array_fill_keys($players, []);

        // Play 6 innings
        $innings = 6;
        for ($inning = 1; $inning <= $innings; $inning++) {
            // Shuffle players for the current inning
            shuffle($players);

            // Shuffle positions for the current inning
            $availablePositions = $positions;

            // Assign players to positions for the current inning
            $team[$inning] = [];

            foreach ($players as $player) {
                // Find a position that the player has not played before in this game
                $availablePlayerPositions = array_diff($availablePositions, $playerPositions[$player]);
                $position = array_shift($availablePlayerPositions);

                // Assign the player to the position for the current inning
                $team[$inning][$player] = $position;
                $playerPositions[$player][] = $position;

                // Remove the assigned position from available positions
                $availablePositions = array_values(array_diff($availablePositions, [$position]));
            }
        }

        // Output the randomized team for each inning
        foreach ($team as $inning => $players) {
            echo "<div class='inning'><h2>Inning $inning:</h2>\n";
            ksort($players); // Sort players alphabetically
            foreach ($players as $player => $position) {
                echo "<p>$player: $position</p>\n";
            }
            echo "\n</div>";
        }
        ?>
    </body>
</html>
