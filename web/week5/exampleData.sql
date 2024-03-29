CREATE TABLE "scorecard" ("scorecard_id" SERIAL PRIMARY KEY NOT NULL);
CREATE TABLE "player" ("player_id" SERIAL PRIMARY KEY NOT NULL, "player_name" VARCHAR(60), "scorecard_id" INT);
CREATE TABLE "round" ("round_id" SERIAL PRIMARY KEY NOT NULL, "bet" INT, "score" INT, "round_number" INT, "player_id" INT);


INSERT INTO person (person_name) VALUES ('John Doe');


INSERT INTO scorecard(scorecard_id) VALUES (1);
INSERT INTO player(player_name, scorecard_id) VALUES('Henry', 1);
INSERT INTO round(bet, score, round_number, player_id) VALUES(4, 10, 1, 2);
INSERT INTO round(bet, score, round_number, player_id) VALUES(2, 20, 2, 2);
INSERT INTO round(bet, score, round_number, player_id) VALUES(5, -50, 3, 2);
INSERT INTO round(bet, score, round_number, player_id) VALUES(5, 100, 4, 2);

INSERT INTO player(player_name, scorecard_id) VALUES('Hank', 1);
INSERT INTO round(bet, score, round_number, player_id) VALUES(1, 10, 1, 3);
INSERT INTO round(bet, score, round_number, player_id) VALUES(4, 40, 2, 3);
INSERT INTO round(bet, score, round_number, player_id) VALUES(5, 100, 3, 3);
INSERT INTO round(bet, score, round_number, player_id) VALUES(5, -30, 4, 3);