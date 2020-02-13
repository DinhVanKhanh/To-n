create table if not exists cates(
	cate_id int primary key auto_increment,
    cate_name varchar(255) unique,
    cate_uri varchar(255) unique
) engine myisam character set utf8 collate utf8_unicode_ci;

create table if not exists posts(
	post_id int primary key auto_increment,
    post_author varchar(255) default '@dp0613',
    post_title varchar(255),
    post_time int,
    post_content mediumtext,
    post_tags text,
    cate_id int,
    post_uri varchar(255) unique,
    post_active tinyint(1) default 1
) engine myisam character set utf8 collate utf8_unicode_ci;

create table if not exists comments(
	cmt_id int primary key auto_increment,
    cmt_time int,
    cmt_author varchar(255),
    cmt_content text,
    post_id int
) engine myisam character set utf8 collate utf8_unicode_ci;

create table if not exists replies(
	rep_id int primary key auto_increment,
    rep_time int,
    rep_author varchar(255),
    rep_content text,
    cmt_id int
) engine myisam character set utf8 collate utf8_unicode_ci;

create table if not exists likes(
	like_id int primary key auto_increment,
    like_ip varchar(255),
    like_time int,
    like_type tinyint(1) default 0, # 0: cmt, 1: reply
    like_for int
) engine myisam character set utf8 collate utf8_unicode_ci;

create table if not exists users(
	user_id int primary key auto_increment,
    user_username varchar(20) unique,
    user_password varchar(255),
    user_key varchar(255),
    user_email varchar(255),
    user_reset varchar(255),
    user_reset_key varchar(255),
    user_active tinyint(1) default 1
) engine innodb character set utf8 collate utf8_unicode_ci;

