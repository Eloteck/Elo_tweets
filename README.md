#Elo_tweets

Created by Eloteck.
Name : Elo_tweets. (That's a fun name, isn't it ?)
Contact : eloteck@outlook.fr
Twitter : @Eloteck
GitHub : Eloteck

Website (FR): http://eloteck.fr
Demo : in future

Description : 
Elo_tweets is a way to integrate your timeline on your webside, with the design you want.
There is a default css file available.

Requirement :
You must to have a twitter app. If you haven't it, go to https://apps.twitter.com/

Access level : read only
Callback URL : None
Sign in with twitter : No
Generate Consumer Key and Secret


Installation :
- Place the "Elo_tweets" folder where you want.
- Open "config/elo_tweets.php"
- Enter your consumer key, consumer secret, access token, access token secret
- Enter how many tweets you want to show
- Enter your time's location
- Translate to your language months and days
- Choose cool words for calling date and time

Now, it's done. Don't forget to include "Elo_tweets.php" where you want !

If you want to modify the design, there is a css file available.

If you want to modify time position (Ex : Monday 07 June to Monday June 07)
- Open "elo_tweets.php" and go to line 114
- modify "created_at" value

For time : Wed Aug 29 17:12:58 +0000 2012
- $hour = 17
- $minutes =12
- $seconds = 58
- $day = Wed
- $day_number = 29
- $month = Aug
- $year = 2012

Good luck, and have fun !
