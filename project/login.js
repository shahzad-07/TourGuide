const mysql = require("mysql");
const express = require("express");
const path = require('path');
const bodyParser = require('body-parser');
const bcrypt = require('bcrypt');
const encoder = bodyParser.urlencoded({ extended: true });

const app = express();
app.use(express.static(path.join(__dirname, 'src')));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

const connection = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "Shahzad@07",
    database: "nodejs"
});

connection.connect(function(error) {
    if (error) throw error;
    console.log("Connected Successfully");
});

app.get("/", function(req, res) {
    res.sendFile(path.join(__dirname, 'src', 'index.html'));
});

app.post("/login", encoder, function(req, res) {
    const username = req.body.username;
    const password = req.body.password;

    connection.query("SELECT * FROM loginuser WHERE user_name = ?", [username], function(error, results) {
        if (error) throw error;
        if (results.length > 0) {
            const hashedPassword = results[0].user_pass;
            bcrypt.compare(password, hashedPassword, function(err, result) {
                if (result) {
                    res.redirect("/home");
                } else {
                    res.redirect("/");
                }
                res.end();
            });
        } else {
            res.redirect("/");
            res.end();
        }
    });
});

app.post("/register", encoder, function(req, res) {
    const username = req.body.username;
    const email = req.body.email;
    const password = req.body.password;

    bcrypt.hash(password, 10, function(err, hashedPassword) {
        if (err) throw err;
        const query = "INSERT INTO loginuser (user_name, user_email, user_pass) VALUES (?, ?, ?)";
        connection.query(query, [username, email, hashedPassword], function(error, results) {
            if (error) throw error;
            res.redirect("/");
        });
    });
});

app.get("/home", function(req, res) {
    res.sendFile(path.join(__dirname, 'src', 'home.html'));
});

app.listen(4500, () => {
    console.log('Server is running on http://localhost:4500');
});
