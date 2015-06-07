<?php
/*
Created by Eloteck.
Thanks for downloaded it.
Thanks you to quote me on your website, twitter or other.

CONTACT :
Website (FR): http://eloteck.fr/
Twitter (FR): @Eloteck

mail : eloteck@outlook.fr
GitHub : Eloteck
*/
?>

<div id="Twitter">
    <?php
        $cache='../app/plugins/Elo_tweets/cache.tmp'; //Definition of "cache" folder
        
        if (time() - filemtime($cache) > 60){ // if cache is older than 1 minute
            // Connection to tweeter API
            require 'twitterconnect/twitteroauth.php';

            $access = require_once 'config/elo_tweets.php';
            //---------------------------------------------------------------------
            
            //################################################################################
            //###Place in config/elo_tweets yours connection ID's for twitter's connection.###
            //################################################################################

            $consumer_key = $access['consumer']; 
            $consumer_secret = $access['consumer_secret']; 
            $access_token = $access['token']; 
            $access_token_secret = $access['token_secret'];
            
            //----------------------------------------------------------------------

            $connexion = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
            // Request timeline
            $tweet = $connexion->get('statuses/user_timeline', array('count'=>3)); //Count = tweet's number
            //Save tweet in cache
            file_put_contents($cache, serialize($tweet));
        } 
        else{
            $tweet = unserialize(file_get_contents($cache)); //show cache
        }
        ?>
        <ul>
            <?php foreach ($tweet as $key => $value) { 
                    $text = $value->text;
                    $twitter_pp = $value->user->profile_image_url;
                    $hashtags = $value->entities->hashtags;
                    $user = $value->entities->user_mentions;
                    $urls = $value->entities->urls;

                   	if (isset($urls)){ //If there is a link in the tweet
                   		foreach ($urls as $key => $external_link){
                        	$url = $external_link->url; //take url
                        	$expanded_url = $external_link->expanded_url;
                        	$link = '<a href="'.$expanded_url.'">'.$url.'</a>'; // link it
                   			$text = str_replace($url, $link, $text ); //replace "no linked user" to "linked user"
                    	}
                   	}

                   	if (isset($hashtags)){ //If there is a hashtag in the tweet
                   		foreach ($hashtags as $key => $hashtag){
                        	$tag = $hashtag->text; //take it
                        	$link = "<a href='http://twitter.com/hashtag/".$tag."' target='blank'>#".$tag."</a>"; //link to hashtag's page
                    		$text = str_replace("#".$tag, $link, $text ); //replace "no linked hashtag" to "linked hashtag"
                    	}
                   	}

                   	if (isset($user)){ //If there is a @user in the tweet
                   		foreach ($user as $key => $mention){
                        	$name = $mention->screen_name; //take name
                        	$link = "<a href='http://twitter.com/".$name."' target='blank'>@".$name."</a>"; // link it
                    		$text = str_replace("@".$name, $link, $text ); //replace "no linked user" to "linked user"
                    	}
                   	}

                    //Time's Separation 
                    $time = explode(" ", $value->created_at);
                    $time_hour = explode(":", $time[3]);

                    $hour = $time_hour[0];
                    $minutes = $time_hour[1];
                    $seconds = $time_hour[2];
                    $day = $time[0];
                    $day_number = $time[2];
                    $month = $time[1];
                    $year = $time[5];


                    //---------------------------------------------------
                    $hour = $hour + 0; //your time's location (0 = UTF) Example : Paris = UTF+1
                    //---------------------------------------------------
                    if($hour == 24){ //Don't want show "24hXX"
                        $hour = "00";
                    }
                    
                    //----------------------------------------------------------------------------------------
                    //Translate to your language (here, french)
                    $month_langage = array("Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre");
                    //Tranlate days to your language (first = Sunday)
                    $day_langage = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
                    //----------------------------------------------------------------------------------------

                    $month_english = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
                    $month = str_replace($month_english, $month_langage, $month); //translation

                    $day_english = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
                    $day = str_replace($day_english, $day_langage, $day); //translation

					$created_at = "Créé à ".$hour.":".$minutes.", le ".$day." ".$day_number." ".$month.".";
                    ?>
                <li>
                	<img src="<?php echo $twitter_pp; ?>" alt="pp" class="tweet_image"/>
                    <div class="tweet_full">
                        <p class='tweet'><?php echo $text; ?></p>
                        <p></p>
                        <p class='tweet_date'><?php echo $created_at;?></p>
                	</div>
                </li>
            <?php } ?>
        </ul>
</div>