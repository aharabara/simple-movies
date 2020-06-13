<?php


namespace Application\MovieCatalog\Infrastructure;

use Application\MovieCatalog\Application\Query\SearchMovieQuery;
use Application\MovieCatalog\Domain\Collection\MovieCollection;
use Application\MovieCatalog\Domain\Movie;
use Application\MovieCatalog\Domain\MovieId;
use PDO;

class Repository
{

    /**
     * @var Hydrator
     */
    private $hydrator;
    private $pdo;
    private $perPageAmount;

    public function __construct(Hydrator $hydrator, PDO $pdo, $perPageAmount)
    {
        $this->hydrator = $hydrator;
        $this->pdo = $pdo;
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->perPageAmount = $perPageAmount;
    }

    public function getById(string $id): ?Movie
    {
        $statement = $this->pdo->prepare('SELECT * FROM movies WHERE movie_id = :movie_id LIMIT 1');
        $statement->bindValue(':movie_id', $id);

        $statement->execute();
        $data = $statement->fetch();
        if (empty($data)){
            return null;
        }

        /** @var Movie $movie */
        $movie = $this->hydrator->hydrate(Movie::class, $data);
        return $movie;
    }

    public function search(SearchMovieQuery $query): MovieCollection
    {
        $whereClause = [];
        $values = [];
        if (!empty($query->getTitle())){
            $whereClause[] ='title LIKE :title';
            $values[":title"] = "{$query->getTitle()}%";
        }

        if (!empty($query->getGenre())){
            $whereClause[] ="genre like ':genre'";
            $values[":genre"] = $query->getGenre();
        }

        if (null !== $query->getWeek()){
            $week = $query->getWeek();
            $year = date('Y');
            $values[":start_date"] = strtotime("$year-W{$week}-1");
            $values[":end_date"] = strtotime("$year-W{$week}-7");
            $whereClause[] ="(release_date > :start_date AND release_date < :end_date)";
        }

        $values[":offset"] = 0;
        $values[":per_page"] = $this->perPageAmount;
        if (null !== $query->getPage()){
            $values[":offset"] = $query->getPage() * $this->perPageAmount;
        }

        if (!empty($whereClause)){
            $whereClauseSql = "WHERE ".implode(" AND ", $whereClause);
        }else{
            $whereClauseSql = "";
        }
        $statement = $this->pdo->prepare("SELECT * FROM movies $whereClauseSql LIMIT :per_page OFFSET :offset");

        foreach ($values as $key => $value) {
            $statement->bindValue($key, $value);
        }

        $statement->execute();
        $data = $statement->fetchAll();
        if (empty($data)){
            return new MovieCollection([]);
        }

        /** @var Movie[] $movies */
        $movies = [];
        foreach ($data as $row) {
            $movies[] = $this->hydrator->hydrate(Movie::class, $row);
        }
        return new MovieCollection($movies);
    }

    public function generateId(): MovieId
    {
        return new MovieId(str_replace(".", "-", uniqid("movie-", true)));
    }

    public function save(Movie $movie): void
    {
        $statement = $this->pdo->prepare("
        REPLACE INTO movies (movie_id, title, genre, year, release_date, runtime, suitability_rating) 
        VALUES (:movie_id, :title, :genre, :year, :release_date, :runtime, :suitability_rating);
        ");
        $data = $this->hydrator->extract($movie);
        foreach ($data as $field => $value) {
            $statement->bindValue(":{$field}", $value);
        }
        $statement->execute();
    }

    public function delete(MovieId $movieId)
    {
        $statement = $this->pdo->prepare("DELETE FROM movies WHERE movie_id = :movie_id");
        $statement->bindValue(":movie_id", $movieId);
        $statement->execute();
    }


}