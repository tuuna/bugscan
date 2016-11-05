CREATE TABLE bug_user (
    `id` int unsigned not null primary key auto_increment,
    `username` varchar(60) not null default '',
    `password` char(32) not null default '',
    `email` varchar(60) not null default '',
    `create_at` int not null default 0,
    UNIQUE bug_users_username_password(`username`, `password`),
    UNIQUE bug_users_username_email(`username`, `email`)
)engine=innodb DEFAULT CHARSET=utf8;
