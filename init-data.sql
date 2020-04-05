create database admin;
use admin;

create table admin(
    id int not null auto_increment, 
    username varchar(255),
    password varchar(255),
    website varchar(255), 
    primary key(id)
);

insert into admin (username,password,website) values \
    ('admin', 'admin', 'http://www.baidu.com'), \
    ('test1', 'test1', 'http://www.baidu.com'), \
    ('test2', 'test2', 'http://www.baidu.com');