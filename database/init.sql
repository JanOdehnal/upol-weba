create table if not exists users(
    id int auto_increment primary key,
    jmeno varchar(255) not null,
    surname varchar(255) not null,
    email varchar(255) not null unique,
    password varchar(255) not null,
    phone_number varchar(20) not null,
    class varchar(100) not null,
    description text not null,
    role enum('student', 'teacher') not null default 'student',
    last_login TIMESTAMP NULL DEFAULT NULL default NOW()
);

insert into users (jmeno, surname, email, password, phone_number, class, description, role) values
('John', 'Doe', 'john.doe@example.com', '1234', '123456789', 'Class A', 'Student in Class A', 'student');

insert into users (jmeno, surname, email, password, phone_number, class, description, role) values
('Jane', 'Smith', 'jane.smith@example.com', '1234', '987654321', 'Class B', 'Student in Class B', 'student');

insert into users (jmeno, surname, email, password, phone_number, class, description, role) values
('J', 'O', 'j.o@example.com', '1234', '555555555', 'Class C', 'Student in Class C', 'student');

insert into users (jmeno, surname, email, password, phone_number, class, description, role) values
('Alice', 'Johnson', 'alice.johnson@example.com', '1234', '111111111', 'Class D', 'Student in Class D', 'teacher');

insert into users (jmeno, surname, email, password, phone_number, class, description, role) values
('Jo', 'Od', 'jo.od@example.com', '1234', '111111111', 'Class D', 'Student in Class D', 'teacher');