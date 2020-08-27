CREATE database rd5 DEFAULT character set utf8;

USE rd5;

CREATE TABLE member(
    id int not null auto_increment primary key,
    userName varchar(20) not null,
    userPassword varchar(50) not null,
    email varchar(40) not null,
    phone varchar(10) not null,
    userMoney int not null
);

CREATE TABLE member(
    id int not null auto_increment primary key,
    memberId int not null,
    deposit enum('Y','N') not null DEFAULT 'N',
    cash int not null,
    nowTime varchar(20) not null
);