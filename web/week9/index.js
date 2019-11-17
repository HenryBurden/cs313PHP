const express = require('express');

var getRate = require('./getRate.js');
var app = express();

app.set('port', process.env.PORT || 5000)
    .use(express.static(__dirname + '/public'))
    .set('views', __dirname + '/views')
    .set('view engine', 'ejs')
    .get('/', (req, res) => {
        res.sendFile('form.html', { root: __dirname + '/public'});
});

app.get('/rate', getRate.getRate)
.listen(app.get('port'), () => {
    console.log('Listening on port: ' + app.get('port'));
})
