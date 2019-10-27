CREATE TABLE "scripture" ("ID" SERIAL PRIMARY KEY, "book" VARCHAR(50) NOT NULL, "chapter" INT NOT NULL, "verse" INT NOT NULL, "content" VARCHAR(666) NOT NULL);
CREATE TABLE "topics" ("id" SERIAL PRIMARY KEY, "name" VARCHAR(50));
CREATE TABLE "link_script" ("id" SERIAL PRIMARY KEY, "topic_id" INT, "script_id" INT);
ALTER TABLE link_script ADD FOREIGN KEY (topic_id) REFERENCES topics(id);
ALTER TABLE link_script ADD FOREIGN KEY (script_id) REFERENCES scripture("ID");


INSERT INTO scripture (book, chapter, verse, content) VALUES ('John', 1, 5, 'And the light shineth in darkness; and the darkness comprehended it not.');
INSERT INTO scripture (book, chapter, verse, content) VALUES ('Doctrine and Covenants', 88, 49, 'The light shineth in darkness, and the darkness comprehendeth it not; nevertheless, the day shall come when you shall comprehend even God, being quickened in him and by him.');
INSERT INTO scripture (book, chapter, verse, content) VALUES ('Doctrine and Covenants', 93, 28, 'He that keepeth his commandments receiveth truth and light, until he is glorified in truth and knoweth all things.');
INSERT INTO scripture (book, chapter, verse, content) VALUES ('Mosiah', 16, 9, 'He is the alight and the life of the world; yea, a light that is endless, that can never be darkened; yea, and also a life which is endless, that there can be no more death.');
INSERT INTO topics (name) VALUES ('Faith');
INSERT INTO topics (name) VALUES ('Sacrifice');
INSERT INTO topics (name) VALUES ('Charity');

/*Example*/
CREATE TABLE person
(
	id SERIAL PRIMARY NULL KEY NOT
	, person_name VARCHAR(50) NOT NULL
);

INSERT INTO person (person_name) VALUES ('John Doe');