create table gp
(
    numero     int          not null,
    piste      varchar(250) not null,
    pays       varchar(250) not null,
    date_debut date         not null,
    date_fin   date         not null,
    constraint gp_numero_uindex
        unique (numero)
);

alter table gp
    add primary key (numero);

create table team
(
    ID              bigint auto_increment,
    name            varchar(250)     not null,
    engine_supplier varchar(250)     not null,
    points          bigint default 0 not null,
    constraint team_ID_uindex
        unique (ID),
    constraint team_name_uindex
        unique (name)
);

alter table team
    add primary key (ID);

create table users
(
    ID       bigint auto_increment,
    email    varchar(50)  not null,
    login    varchar(50)  not null,
    password varchar(250) not null,
    date     date         not null,
    constraint users_ID_uindex
        unique (ID)
);

create table pilotes
(
    number     int          not null,
    first_name varchar(250) not null,
    last_name  varchar(250) not null,
    team       varchar(250) null,
    constraint pilotes_number_uindex
        unique (number)
);

alter table pilotes
    add primary key (number);

create table pronostique
(
    ID      bigint auto_increment,
    user_id bigint   not null,
    gp      bigint   not null,
    date    datetime not null,
    P2      int      not null,
    P3      int      not null,
    P1      int      not null,
    constraint pronostique_ID_uindex
        unique (ID)
);

create index fk_gp
    on pronostique (gp);

create index fk_user_id
    on pronostique (user_id);

alter table pronostique
    add primary key (ID);

create table resultat
(
    gp int not null
        primary key,
    P1 int not null,
    P2 int not null,
    P3 int not null
);

create index fk_P1
    on resultat (P1, P2, P3);

INSERT INTO pronostiques.resultat (gp, P1, P2, P3) VALUES (1, 16, 55, 44);


alter table users
    add primary key (ID);


INSERT INTO pronostiques.gp (numero, piste, pays, date_debut, date_fin) VALUES (1, 'Bahrain', 'Bahrain', '2022-03-18', '2022-03-20');
INSERT INTO pronostiques.gp (numero, piste, pays, date_debut, date_fin) VALUES (2, 'Jeddah', 'Saudi Arabia', '2022-03-25', '2022-03-27');
INSERT INTO pronostiques.gp (numero, piste, pays, date_debut, date_fin) VALUES (3, 'Australia', 'Australia', '2022-04-08', '2022-04-10');

INSERT INTO pronostiques.pilotes (number, first_name, last_name, team) VALUES (44, 'Lewis', 'Hamilton', 'Mercedes AMG Petronas');
INSERT INTO pronostiques.pilotes (number, first_name, last_name, team) VALUES (63, 'George', 'Russel', 'Mercedes AMG Petronas');
INSERT INTO pronostiques.pilotes (number, first_name, last_name, team) VALUES (1, 'Max', 'Verstappen', 'Oracle Redbull Racing');
INSERT INTO pronostiques.pilotes (number, first_name, last_name, team) VALUES (11, 'Sergio', 'Perez', 'Oracle Redbull Racing');
INSERT INTO pronostiques.pilotes (number, first_name, last_name, team) VALUES (16, 'Charles', 'Leclerc', 'Scuderia Ferrari');
INSERT INTO pronostiques.pilotes (number, first_name, last_name, team) VALUES (55, 'Carlos', 'Sainz', 'Scuderia Ferrari');
INSERT INTO pronostiques.pilotes (number, first_name, last_name, team) VALUES (3, 'Daniel', 'Ricciardo', 'McLaren');
INSERT INTO pronostiques.pilotes (number, first_name, last_name, team) VALUES (4, 'Lando', 'Norris', 'McLaren');
INSERT INTO pronostiques.pilotes (number, first_name, last_name, team) VALUES (14, 'Fernando', 'Alonso', 'BWT Alpine F1 Team');
INSERT INTO pronostiques.pilotes (number, first_name, last_name, team) VALUES (31, 'Esteban', 'Ocon', 'BWT Alpine F1 Team');
INSERT INTO pronostiques.pilotes (number, first_name, last_name, team) VALUES (10, 'Pierre', 'Gasly', 'Scuderia Alpha Tauri');
INSERT INTO pronostiques.pilotes (number, first_name, last_name, team) VALUES (22, 'Yuki', 'Tsunoda', 'Scuderia Alpha Tauri');
INSERT INTO pronostiques.pilotes (number, first_name, last_name, team) VALUES (5, 'Sebastian', 'Vettel', 'Aston Martin Aramco Cognizant F1 Team');
INSERT INTO pronostiques.pilotes (number, first_name, last_name, team) VALUES (18, 'Lance', 'Stroll', 'Aston Martin Aramco Cognizant F1 Team');
INSERT INTO pronostiques.pilotes (number, first_name, last_name, team) VALUES (23, 'Alex', 'Albon', 'Williams Racing');
INSERT INTO pronostiques.pilotes (number, first_name, last_name, team) VALUES (6, 'Nicholas', 'Latifi', 'Williams Racing');
INSERT INTO pronostiques.pilotes (number, first_name, last_name, team) VALUES (77, 'Valterri', 'Bottas', 'Alfa Romeo Orlen Racing');
INSERT INTO pronostiques.pilotes (number, first_name, last_name, team) VALUES (24, 'Ghanyu', 'Zhou', 'Alfa Romeo Orlen Racing');
INSERT INTO pronostiques.pilotes (number, first_name, last_name, team) VALUES (20, 'Kevin', 'Magnussen', 'Haas F1 Team');
INSERT INTO pronostiques.pilotes (number, first_name, last_name, team) VALUES (47, 'Mick', 'Schumacher', 'Haas F1 Team');

INSERT INTO pronostiques.pronostique (ID, user_id, gp, date, P2, P3, P1) VALUES (3, 10, 2, '2022-03-21 17:53:24', 5, 44, 31);
INSERT INTO pronostiques.pronostique (ID, user_id, gp, date, P2, P3, P1) VALUES (2, 10, 1, '2022-03-21 17:37:23', 5, 44, 31);
INSERT INTO pronostiques.pronostique (ID, user_id, gp, date, P2, P3, P1) VALUES (4, 10, 3, '2022-03-21 17:53:39', 5, 44, 31);
INSERT INTO pronostiques.pronostique (ID, user_id, gp, date, P2, P3, P1) VALUES (5, 6, 1, '2022-03-21 17:59:57', 55, 1, 16);
INSERT INTO pronostiques.pronostique (ID, user_id, gp, date, P2, P3, P1) VALUES (6, 6, 2, '2022-03-21 18:00:13', 63, 1, 44);
INSERT INTO pronostiques.pronostique (ID, user_id, gp, date, P2, P3, P1) VALUES (7, 6, 3, '2022-03-21 18:01:25', 55, 10, 16);

INSERT INTO pronostiques.users (ID, email, login, password, date) VALUES (10, 'admin@gmail.com', 'admin', '$2y$10$r5iLyGp.H3JnzyCQILUeye1aeUX1XCeTwOFu6lxJaSnOPcUhBS3ii', '2022-03-21');
INSERT INTO pronostiques.users (ID, email, login, password, date) VALUES (6, 'yohann@gmail.com', 'Guepaz', '$2y$10$SZjrqMtNblr40mji5Cclauqju99x9FHAk0MecRRcV2ANE02ll8mrO', '2022-03-20');
INSERT INTO pronostiques.users (ID, email, login, password, date) VALUES (7, 'test@gmail.com', 'Tes', '$2y$10$BJPkKfzCWIWKLwMrtR1BjOHG9yyAWUSMBvjxilCmzMb1Uf4laDBaW', '2022-03-20');
INSERT INTO pronostiques.users (ID, email, login, password, date) VALUES (8, 'test@gmail.com', 'test', '$2y$10$PKX0jUDIyRb/M9wmlafBleOrcY4GMsrqm9ikUpBv7peUC96eAIFZi', '2022-03-20');