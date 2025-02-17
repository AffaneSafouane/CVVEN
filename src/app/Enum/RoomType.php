<?php

namespace App\Enum;

enum RoomType: string
{
    case Housing = 'Housing';
    case DoubleRoom = 'Double Room';
    case TripleRoom = 'Triple Room';
    case QuadrupleRoom = 'Quadruple Room';
    case HandicapRoom = 'Handicap Room';

    public function getLabel(): string
    {
        return match ($this) {
            self::Housing => 'Logement',
            self::DoubleRoom => 'Chambre Double',
            self::TripleRoom => 'Chambre Triple',
            self::QuadrupleRoom => 'Chambre Quadruple',
            self::HandicapRoom => 'Chambre Accessible',
        };
    }
}
