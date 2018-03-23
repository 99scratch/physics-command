<img src="https://s9.postimg.org/9qm3kmdr3/logo4.png" width="300">

Physics platform is a tool for hardware systems (e.g: **raspberryPi 3B**).
It retrieves data passing through the network and sends it to a control panel.
It works the same way as a botnet by receiving remote commands.
(you can imagine that as a black box)

### INSTALLATION

  > 1) composer update

  > 2) generate .env with database information
  
  > 3) php artisan migrate
  
  > 4) create user account with php artisan physics:createUser username password
