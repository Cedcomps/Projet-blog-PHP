create database if not exists projet4 character set utf8 collate utf8_unicode_ci;
use projet4;

grant all privileges on projet4.* to 'projet4_user'@'localhost' identified by 'secret';
