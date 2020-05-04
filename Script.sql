create database if not exists api_rest;
use api_rest;

create table if not exists users (
    id int(11) primary key,
    first_name varchar(50) not null,
    last_name varchar(50) not null,
    email varchar(100) null
);