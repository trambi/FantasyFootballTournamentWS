<?php

namespace FantasyFootball\TournamentCoreBundle\Util;

use FantasyFootball\TournamentCoreBundle\Util\Rdvbb\RankingStrategyFirst;
use FantasyFootball\TournamentCoreBundle\Util\Rdvbb\RankingStrategySecondToFifth;
use FantasyFootball\TournamentCoreBundle\Util\Rdvbb\RankingStrategySixthToEighth;
use FantasyFootball\TournamentCoreBundle\Util\Rdvbb\RankingStrategyNinthToTenth;
use FantasyFootball\TournamentCoreBundle\Util\Rdvbb\RankingStrategyEleventh;
use FantasyFootball\TournamentCoreBundle\Util\Rdvbb\RankingStrategyTwelfth;
use FantasyFootball\TournamentCoreBundle\Util\Rdvbb\RankingStrategyThirhteenth;

class RankingStrategyFabric {
    static function getByName($name) {
        $strategy = null;
        if ( 'RdvbbFirst' === $name ) {
            $strategy = new RankingStrategyFirst();
        } else if ( 'RdvbbSecondToFifth' === $name ) {
            $strategy = new RankingStrategySecondToFifth();
        } else if ( 'RdvbbSixthToEighth' === $name ) {
            $strategy = new RankingStrategySixthToEighth();
        } else if ( 'RdvbbNinthToTenth' === $name ) {
            $strategy = new RankingStrategyNinthToTenth();
        } else if ( 'RdvbbEleventh' === $name ) {
            $strategy = new RankingStrategyEleventh();
        } else if ( 'RdvbbTwelfth' === $name ) {
            $strategy = new RankingStrategyTwelfth();
        } else if ( 'RdvbbThirhteenth' === $name ){
            $strategy = new RankingStrategyThirhteenth();
        }
        
        return $strategy;
    }

}