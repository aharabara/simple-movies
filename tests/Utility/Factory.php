<?php

namespace Utility;

use Application\MovieCatalog\Domain\Genre;
use Application\MovieCatalog\Domain\Movie;
use Application\MovieCatalog\Domain\MovieId;
use Application\MovieCatalog\Domain\ReleaseDate;
use Application\MovieCatalog\Domain\Runtime;
use Application\MovieCatalog\Domain\SuitabilityRating;
use Application\MovieCatalog\Domain\Title;
use Application\MovieCatalog\Domain\Year;

class Factory
{
    private $faker;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
    }

    public function createMovie(): Movie
    {
        return new Movie(
            new MovieId(uniqid("movie", true)),
            new Title($this->faker->title),
            new Genre($this->faker->randomElement(Genre::allowedValues())),
            new Year(2009),
            new Runtime(150),
            new SuitabilityRating($this->faker->randomElement(SuitabilityRating::allowedValues())),
            new ReleaseDate()
        );
    }
}