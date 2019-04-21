create database todo charset utf8mb4;

use todo;


create table t_user (
	`fid` int not null auto_increment primary key,
	`fusername` varchar(64) not null default '',
	`fnickname` varchar(64) not null default '',
	`fpassword` varchar(64) not null default '',
	`fstatus` tinyint not null default 0,
	`faddtime` timestamp not null default current_timestamp

) engine=innodb charset utf8mb4;

create table t_project (
	`fid` int not null auto_increment primary key,
	`fuid` int not null default 0,
	`fname` varchar(64) not null default '',
	`fstatus` tinyint not null default 0,
	`faddtime` timestamp not null default current_timestamp

) engine=innodb charset utf8mb4;

create table t_activity (
	`fid` int not null auto_increment primary key,
	`fproject_id` int not null default 0,
	`fcontent` varchar(256) not null default '',
	`fstatus` tinyint not null default 0,
	`faddtime` timestamp not null default current_timestamp

) engine=innodb charset utf8mb4;