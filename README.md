# Rotogram
A text adventure game from grade 11 computer science.  

This codebase is really bad. I might clean it up later, but it's like 3 years old and was probably the first major thing I ever wrote.  

## The Game

Rotogram is a text based adventure game. It's nothing special, you get information in the form of text, and perform actions by typing them out. The game is pretty small in both story and content, there's a maximum of 3 or 4 weapons and a few planned encounters during the playthrough of the game. There are 2 endings, you can either defeat Gravity Worm, or Apple Worm both of which result in the same ending, but we all know which should be killed ;3c  


## Key Commands

#### Basic Functions
**Save**    - Saves progress  
**Logout**  - Logouts of the game (close the session)  
**Restart** - Restarts the playthrough  
**Help**    - Lists page 1 of commands  
**Help2**   - Lists page 2 of commands 

#### Core Gameplay 
**North**, **South**, **East**, **West** - Movement commands  
**View**                     - Helps you navigate the area  
**Equip 'item name'**        - Lets you equip weapons, armor, and other items  
**Use 'item name'**          - Lets you use items in certain areas  
**Attack**                   - Attacks with your equipped weapon or fist  



## Meta

There is a very clear meta in this game, this is because there's a best weapon, and setup you are gonna want to greatly increase the odds of actually finishing the game, I don't actually think it's possible without a few key items:

- Shield 
- Shelly's Love
- Axe 
- Apple Cloak / Gravity Cloak

These items are vital to actually killing the final bosses, this is because the combat in the game is very RNG relient. The **Shield** is a very strong item that has a 1/2 chance of completely blocking all damage. This makes surviving the final boss much easier. **Shelly's Love** is a healing item which heals 1-5 HP every time the user inputs a command, this being the only passive healing item in the game makes it very strong. The **Axe** is good because it has the highest damage of all the weapons, and the **Apple Cloack** and **Gravity Cloak** both give the play an extra 100 HP.


## Running The Game

There is a `compose.yml` file, so you can just run `docker compose up` and it should handle everything.

Once the containers are up and running go to [localhost](http://localhost) to play the game. 

You will need to register an account to play, just enter anything, but make sure you wait at least 1 minute before trying to register while the database does its thing.

~~The game is written entirely in PHP with a MySQL database, I used [Xampp](https://www.apachefriends.org/download.html) but you can probably use anything.~~

~~Steps:~~
~~- Install [Xampp](https://www.apachefriends.org/download.html) (you need Apache and MySQL)~~
~~- Run the Xampp Control Panel~~
~~- Click **Config** for Apache, then click **Apache (httpd.conf)**, ctrl+f **DocumentRoot** and change the value of this and the **<Directory "C:\\..">** to the folder you want to run PHP~~
~~- Save the config from above, then **start** for both Apache and MySQL~~
~~- Click **Admin** next to MySQL, then **new** and make a database named **rotogram** with **utf8_general_ci** encoding~~
~~- Click the database on the left and hit **import** at the top, then **browse** and choose [user.sql](database/users.sql), then hit **go**~~
~~- Clone the repo into the folder you chose to run PHP and then navigate to [localhost](http://localhost/)~~
~~- You should see the git repo, enter that and then the **src** directory and index.php should load the game~~
~~- Signup and login, and you're done~~

