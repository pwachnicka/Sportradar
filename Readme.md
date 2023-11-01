# Sportradar

The purpose of this project is to implement a simple Football World Cup Score Board library.

In order to run Sportradar, it is required to install

-   PHP 8.2
-   composer

After that, clone this repo locally. When done, run command listed below to install libraries and to create autoloader.

```sh
composer install
```

Sportradar can be launched by using command

```sh
php game.php
```

To run unit test, use command

```sh
vendor\bin\phpunit tests
```

## Football World Cup Score Board details

You are working on a sports data company. And we would like you to develop a new
Live Football World Cup Score Board that shows matches and scores.

The boards support the following operations:

1. Start a game. When a game starts, it should capture (being initial score 0-0)
    - Home team
    - Away Team
1. Finish a game. It will remove a match from the scoreboard.
1. Update score. Receiving the pair score; home team score and away team score
   updates a game score
1. Get a summary of games by total score. Those games with the same total score
   will be returned ordered by the most recently added to our system.

As an example, being the current data in the system:

<ol type="a">
  <li>Mexico - Canada: 0 – 5</li>
  <li>Spain - Brazil: 10 – 2</li>
  <li>Germany - France: 2 – 2</li>
  <li>Uruguay - Italy: 6 – 6 </li>
  <li>Argentina - Australia: 3 - 1</li>
</ol>

The summary would provide with the following information:

1. Uruguay 6 - Italy 6
1. Spain 10 - Brazil 2
1. Mexico 0 - Canada 5
1. Argentina 3 - Australia 1
1. Germany 2 - France 2

## Project assumptions

-   The data of the match history can be found in the file `data/sourceData.php`. I have assumed that the data there represents the actual goals scored during the match. This is to simulate data obtained from an external API.
-   I assumed that the team names are correctly supplied. If someone supplied Poland-Poland or Poland-'' I assume that these are correct. I made this assumption because the team name does not affect the correct match.
-   I assumed that the responsibility of the `ScoreBoard` class is to `start`, `update` the score status and `finish` the game. However, the functionality of sorting the summary is not the responsibility of the `ScoreBoard` class, so I moved this functionality to a separate class (`ReverseOrderWithLIFOComparator`).
