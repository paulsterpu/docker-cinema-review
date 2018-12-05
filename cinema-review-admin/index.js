var express = require('express')
var app = express()
var mysql = require('mysql')
var cors = require('cors')

app.use(cors())

var connection = mysql.createConnection({
  host     : 'mysql',
  user     : 'root',
  password : 'root',
  database : 'cinema-review'
});

connection.connect()

app.get('/', function (req, res) {
  
	connection.query('SELECT movies.id, movies.name, round(avg(reviews.grade), 2) grade from movies inner join reviews on movies.id = reviews.movie_id group by movies.id, movies.name', function (err, rows, fields) {
	  if (err) throw err

        res.send(rows);
	})

})

app.post('/set-grade', function(req, res) {
    
    console.log(req.query.movie_id);
    console.log(req.query.grade);

	connection.query('update reviews set grade=' + req.query.grade + ' where movie_id=' + req.query.movie_id, function (err, rows, fields) {
	  if (err) throw err

        res.send('success');
	})
})

app.listen(5000, function() {
	console.log('listenting on port 5000');
})
