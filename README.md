Betting Platform v.1.0
===========================
Battleship (also Battleships or Sea Battle[1]) is a guessing game for two players. 
It is known worldwide as a pencil and paper game which dates from World War I. 
It was published by various companies as a pad-and-pencil game in the 1930s, and was released as a plastic board game by Milton Bradley in 1967.

How to install
--------------
    * cd /YOUR_SERVER_WWW/betting-platform-app
    * git fetch --all
    * git stash save "Pre release v1.0.0" 
    * git checkout -b v1.0.0 tags/v1.0.0
    * PATH_TO_PHP composer.phar install --optimize-autoloader

How to use
----------
    * Web URL (YOUR_SITE/betting/Platform/showGame)
    * Request a bet by clicking on a "Bet" link

Whats happens on background
---------------------------
    * User clicks on "Bet" link
    * If User is not logged in - error message displayed and script terminates
    * Ajax call is performed to Controller action which sends an HTTP request to the Operator, related to the current user, asking it to stake money from user's account
    * If stake request failed - Platform keeps retrying 10 times or until gets a successful response. 
    * If stake request succeeded - Platform randomly decides if this user is going to Win or to Lose
    * Upon the previous decision, Platforms send an HTTP request to the Operator asking it to handle betting round.
    * If above request fails - Platform keeps retrying 10 times or until gets a successful response.
    * If above request succeeds - Platform shows to user (Client) if he win or loose.
---------------------------------------------------------------------------------------------------------
    * All HTTP requests are performed using Basic HTTP authorization
    * All available methods are triggered asynchronously by Ajax calls according to user's actions
    * Guzzle HTTP client is used for http communication between the Platform and Operator\s
    * Any successful response is send back to javascript and relevant messsage is shown to the user
    * Any error in response is send back to javascript and relevant message is shown to the user
    

Author
------
Ferhan Ismailov
floorer@gbg.bg
