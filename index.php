<?php

// PROSSIMAMENTE DISPONIBILE LA WIKI SU GITHUB
// SE NON SAI COME MODIFICARE I PARAMETRI
// CONTATTA @Takabrycheri34 SU TELEGRAM!

require("./src/TakaBot.php");
$TakaBot = new TakaBot(file_get_contents("php://input"));
require("./src/variabili_easy.php");
require("./src/impostazioni.php");
require("comandi.php");