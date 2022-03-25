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


create table messages
(
    msg_id           int auto_increment,
    incoming_msg_id int(255)      null,
    outgoing_msg_id  int(255)      null,
    msg              varchar(1000) null,
    constraint messages_pk
        primary key (msg_id)
);



