/**
 * initilize variables
 */
const express = require("express");
require('dotenv').config();
const app = express();

const port = process.env.PORT || 5000; //use port stored in PATH or 5000 if none

const { Pool } = require("pg");

const connectionString = process.env.DATABASE_URL; //get DB URL from Path. Local saved in .env
const pool = new Pool({connectionString: connectionString});


/**
 * server commands
 */
app.get('/', (req, res) => {
    res.sendFile('form.html', { root: __dirname});
}) //when there is no trailing url display form.html

app.get("/getScorecards", getScorecards); //use function getScorecards() when url ends with /getScorecards

app.listen(port, () => {
    console.log("Listening on port: " + port);
});


/**
 * server functions
 */
function getScorecards(req, res) {
    console.log("Getting scorecard");

    getScorecardsFromDB((error, result) => {

		if (error || result == null) {
			res.status(500).json({success: false, data: error});
		} else {
			res.status(200).json(result);
		}
	});
}

function getScorecardsFromDB(callback) {
    console.log("db");
    const sql = "SELECT * FROM scorecard";

    pool.query(sql, (err, result) => {
		// If an error occurred...
		if (err) {
			console.log("Error in query: ")
			console.log(err);
			callback(err, null);
		}

		// Log this to the console for debugging purposes.
		console.log("Found result: " + JSON.stringify(result.rows));

		// (The first parameter is the error variable, so we will pass null.)
		callback(null, result.rows);
	});
}

