drop database if  exists uptask;

create database if not exists uptask;

use uptask;

create table if not exists rol (
    id_rol int not null auto_increment,
    type_rol varchar(10) not null,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    update_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    primary key (id_rol)
);

create table if not exists user (
    id_user int not null auto_increment,
    name varchar(255) not null,
    username varchar(255) not null,
    password text not null,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    update_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    rol_id int not null,
    primary key (id_user),
    foreign key (rol_id) references rol(id_rol)
);

create table if not exists task (
    id_task int not null auto_increment,
    title varchar(60) not null,
    description varchar(255) not null,
    status varchar(20),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    update_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    primary key (id_task),
    user_id int not null,
    foreign key (user_id) references user(id_user) on delete cascade on update cascade
);

create table if not exists category (
    id_category int not null auto_increment,
    name_category varchar(100) not null,
    description varchar(255) not null,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    update_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    primary key (id_category)
);

-- seccion para las vistas
create view rol_user as
select u.id_user,r.type_rol, u.name, u.username, u.password
from user u, rol r
where u.rol_id = r.id_rol;


insert into rol (id_rol, type_rol) values (1, 'admin');
insert into rol (id_rol, type_rol) values (2, 'user');

insert into user (name, username, password, rol_id) values ('Anthony Solano', 'AnthonySN', '$2y$10$GARfGt0qqIo08fFTXElBLuaoXi3W2OTCAZ6.4DTNs4cPb7kJkZZhW', 1);
insert into user (name, username, password, rol_id) values ('Juan Pablo', 'JuanPablo', '$2y$10$GARfGt0qqIo08fFTXElBLuaoXi3W2OTCAZ6.4DTNs4cPb7kJkZZhW', 2);

-- adios123 = $2y$10$GARfGt0qqIo08fFTXElBLuaoXi3W2OTCAZ6.4DTNs4cPb7kJkZZhW
