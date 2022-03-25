CREATE
DATABASE chat;

USE chat;

-- auto-generated definition
create table users
(
    user_id   int auto_increment
        primary key,
    unique_id int null,
    fname     varchar(255) null,
    lname     varchar(255) null,
    email     varchar(255) null,
    password  varchar(255) null,
    img       varchar(400) null,
    status    varchar(255) null
);




