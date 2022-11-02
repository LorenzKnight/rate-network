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

-- INSERT INTO users (name, surname, email, password, image, rate, signup_date, birthday, status)
-- VALUES ('Lorenz', 'Knight', 'lorenz.knight@gmail.com', 123456, 'profile_pic.jpg', 0, '2022-10-18 00:00:00', '1984-09-03 00:00:00', 1),
--        ('Joel', 'Knight', 'joel.knight@gmail.com', 123456, 'profile_pic.jpg', 0, '2022-10-18 00:00:00', '1984-09-03 00:00:00', 1),
--        ('Shael', 'Knight', 'shael.knight@gmail.com', 123456, 'profile_pic.jpg', 0, '2022-10-18 00:00:00', '1984-09-03 00:00:00', 1);

-- select * from users;

-- ALTER TABLE users  
-- ADD COLUMN image varchar(255) NULL;

-- update users set name = 'Lorenz', image = 'profile_pic.jpg' where user_id = 1
     
CREATE TABLE IF NOT EXISTS river (
	r_id SERIAL PRIMARY KEY,
    user_id INTEGER NULL,
    content varchar(255) null,
    media_id INTEGER null,
    status INTEGER NULL
);

-- INSERT INTO river (user_id, content, media_id, status)
-- VALUES (1, 'post 1', 1, 1),
--        (2, 'post 2', 2, 1),
--        (3, 'post 3', 3, 1);
       
-- select * from river;

CREATE TABLE IF NOT EXISTS rates (
	rate_id SERIAL PRIMARY KEY,
	stars INTEGER null,
	rate_bonus FLOAT NULL,
	user_id INTEGER NULL,
	to_user_id INTEGER NULL,
	post_id INTEGER NULL,
	comment_id INTEGER null,
	rate_date TIMESTAMP NULL
);

-- INSERT INTO rates (stars, rate_bonus, user_id, post_id, rate_date)
-- VALUES (4, 0.2, 2, 3, '2022-10-18 00:00:00'),
--        (3, 0.5, 3, 3, '2022-10-18 00:00:00');

-- select * from rates;