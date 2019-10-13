CREATE TABLE "scorecard" ("scorecard_id" SERIAL PRIMARY KEY NOT NULL);
CREATE TABLE "player" ("player_id" SERIAL PRIMARY KEY NOT NULL, "player_name" VARCHAR, "scorecard_id" INT);
ALTER TABLE public.player ADD FOREIGN KEY (scorecard_id) REFERENCES public.scorecard(scorecard_id);
CREATE TABLE "round" ("round_id" SERIAL PRIMARY KEY NOT NULL, "bet" INT, "score" INT, "player_id" INT);
ALTER TABLE public.round ADD FOREIGN KEY (player_id) REFERENCES public.player(player_id); 

