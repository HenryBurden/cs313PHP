CREATE TABLE "scorecard" ("scorecard_id" SERIAL PRIMARY KEY NOT NULL);
CREATE TABLE "player" ("player_id" SERIAL PRIMARY KEY NOT NULL, "player_name" VARCHAR(60), "scorecard_id" INT);
ALTER TABLE player ADD FOREIGN KEY (scorecard_id) REFERENCES public.scorecard(scorecard_id);
CREATE TABLE "round" ("round_id" SERIAL PRIMARY KEY NOT NULL, "bet" INT, "score" INT, "round_number" INT, "player_id" INT);
ALTER TABLE round ADD FOREIGN KEY (player_id) REFERENCES public.player(player_id); 

