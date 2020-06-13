-- auto-generated definition
create table movies
(
    movie_id           string not null
        constraint movies_pk
        primary key,
    title              string,
    genre              string,
    year               int    not null,
    release_date       date   not null,
    runtime            int    not null,
    suitability_rating string
);

create unique index movies_movie_id_uindex
    on movies (movie_id);

