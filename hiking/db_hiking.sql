create table hiking
(
    id                int auto_increment
        primary key,
    name              varchar(400) not null,
    difficulty        char(30)     not null,
    distance          int          not null,
    duration          time         not null,
    height_difference int          not null
);

