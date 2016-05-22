SELECT * FROM users;
SELECT * FROM pokes;

INSERT INTO pokes (poker_id, poked_id, created_at, updated_at) VALUES (7,8,NOW(),NOW());

    
-- other people user may want to poke, history
SELECT users.id AS poked_id,users.name AS poked, users.alias AS poked_alias, users.email AS poked_email, users2.name as poker, COUNT(users2.id) 
AS pokes_count
	FROM users LEFT JOIN pokes
    ON users.id = pokes.poked_id
    LEFT JOIN users as users2
    ON users2.id = pokes.poker_id
    WHERE users.id != 1 GROUP BY poked DESC;

-- how many people poked you and how many times
SELECT users.name AS poker, COUNT(users.id) AS pokes_count, users2.name AS poked
    FROM users LEFT JOIN pokes
    ON users.id = pokes.poker_id
    LEFT JOIN users AS users2
    ON users2.id = pokes.poked_id
    WHERE users2.id = 1 GROUP BY poker;

-- total pokes for user
SELECT COUNT(poked) AS total_pokes FROM (
	SELECT users.name AS poker, users2.name AS poked
    FROM users LEFT JOIN pokes
    ON users.id = pokes.poker_id
    LEFT JOIN users AS users2
    ON users2.id = pokes.poked_id
    WHERE users2.id = 1 GROUP BY poker)as table1;

