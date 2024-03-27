const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');

const app = express();
const port = 3000;

app.use(bodyParser.urlencoded({ extended: true }));

const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'password',
  database: 'database_name'
});

db.connect((err) => {
  if (err) throw err;
  console.log('Connected to database');
});

app.get('/', (req, res) => {
  res.sendFile(__dirname + '/index.html');
});

app.post('/register', (req, res) => {
  const username = req.body.username;
  const password = req.body.password;

  const query = `INSERT INTO users (username, password) VALUES ('${username}', '${password}')`;

  db.query(query, (err, result) => {
    if (err) throw err;
    res.send('Registered successfully');
  });
});

app.post('/login', (req, res) => {
  const username = req.body.username;
  const password = req.body.password;

  const query = `SELECT * FROM users WHERE username = '${username}' AND password = '${password}'`;

  db.query(query, (err, result) => {
    if (err) throw err;
    if (result.length > 0) {
      res.send('Logged in successfully');
    } else {
      res.send('Invalid credentials');
    }
  });
});

app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});