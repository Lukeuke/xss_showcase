# XSS and MySQLi vulnerability website
> Made for school project

## Installation

### Requirements
1. XAMPP
2. Node.js >= v18.x.x
3. NPM >= 8.19.2

### Installation steps

#### Victim's PC
1. Install XAMPP
2. Open XAMPP's ``htdocs folder``
3. Create folder called ``XSS_Example`` and Open it
4. Clone this repo ```git clone https://github.com/Lukeuke/xss_showcase.git``` or download ZIP and extract into the following folder
5. Create database called ``xss_attack_db`` and import ``xss_attack_db.sql``
6. Open your website on your browser. Url will be probably ``localhost/XSS_Example`` if you did all the steps correctly
7. Then select the ``victim`` folder

#### Attacker's PC
1. Make sure you have ``NODE.js`` and ``NPM`` installed
2. Go to ``attacker`` folder in your cloned repo in htdocs
3. Open Console/Terminal and type ```npm i``` or ```npm install```
4. After this ``node_modules`` folder should be created
5. Open Console/Terminal and type ``ipconfig`` and grab your local network IP. It will be most probably Ethernet or Wireless Adapter and IP probably be something like ``192.168.x.x``
6. In attacker folder open in your code editor of choice file ``server.js`` and change this section to your matching local network IP
```js
36. app.listen(3000, '192.168.1.100'); // Change this -> '192.168.1.100'
```
7. Run the server. In Console/Terminal type ``node server.js``

##### If you did all the steps correctly you should have both attacker and victim page running

## Attacks

### XSS
>hint: Products search is vulnerable for XSS attack. try typing in search input: <script>alert('XSS')</script>

### MySql Injection
> Try to find one. There are RAW sql queries. Not escaped.

### JWT Signature bruteforce
> install https://github.com/lmammino/jwt-cracker and try to bruteforce the JWT Signing Key
