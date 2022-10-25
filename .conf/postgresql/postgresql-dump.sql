CREATE TABLE IF NOT EXISTS users (
    user_id SERIAL PRIMARY KEY,
    name varchar(255) NULL,
	surname varchar(255) NULL,
	email varchar(255) NULL,
	password varchar(255) NULL,
	image varchar(255) NULL,
	rate FLOAT NULL,
	signup_date TIMESTAMP NULL,
	birthday TIMESTAMP NULL,
	rank INTEGER null,
	status INTEGER NULL
);

INSERT INTO users (name, surname, email, password, image, rate, signup_date, birthday, status)
VALUES ('Shael', 'Knight', 'shael.knight@gmail.com', 123456, 'profile_pic.jpg', 0, '2022-10-18 00:00:00', '1984-09-03 00:00:00', 1),
       ('Joel', 'Knight', 'joel.knight@gmail.com', 123456, 'profile_pic.jpg', 0, '2022-10-18 00:00:00', '1984-09-03 00:00:00', 1);

ALTER TABLE users  
ADD COLUMN rank INTEGER NULL;

select * from users;


CREATE TABLE IF NOT EXISTS river (
	r_id SERIAL PRIMARY KEY,
    user_id INTEGER NULL,
    content varchar(255) NULL
);

INSERT INTO river (user_id, content)
VALUES (1, 'post 1'),
       (2, 'post 2'),
       (3, 'post 3');

select * from river;