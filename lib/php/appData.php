<?php
function getAppData() {
    $data = array(
        array(
            'title' => 'Jump!',
            'link' => '/apps/jump.html',
            'image' => '/images/jump.jpg',
            'paragraphs' => array(
                '"Jump!" is a very simple game that I decided to put together that is basically serving as a precursor to a much larger game that I wanted to put together. I wanted to figure out the basics around jumping and collision detection.',
                'The game is built using canvas and some free game assets provided by opengameart.org. There are actually a few different canvases used for this game. One canvas contains all of the static elements of the game (background and towers). The second canvas is our animation canvas which is used for our character and the jump indication line used by the user to direct the character.',
                'The game uses some fairly basic math to the arcs of the jump. The position of the character is calculated based on the originating coordinates, speed, angle, and time. As the character moves across the screen during each frame we run our detect collision function. This function detects both good and bad collisions. If the character lands on the next tower a point is awarded or if the character collides with the side or a tower or the edge of the game the game and score is reset.',
                'A few different assets are used in the game. Specifically for the character one image is used when standing, another for collision happens, and two additional images for jumping through the air. As the character is jumping up we use one and then when falling we switch to another image of the character falling. Overall this served as some good practice for a larger project for a side scroller game.'
            )
        ),
        array(
            'title' => 'Stars: An Animated Background Created With Canvas',
            'link' => '/apps/stars.html',
            'image' => '/images/stars.jpg',
            'paragraphs' => array(
                'This is a simple project inspired by the idea of live wallpapers on Android phones. I wanted to see if I could come up with something that could be used for a webpage but I didn’t just want to take the easy way out and use an animated GIF. I wanted something more dynamic and changed every time it was used.',
                'The solution… canvas. I decided to style the canvas to look like a night sky (with a bunch of shooting stars for fun).',
                'The canvas is painted with a gradient ranging from a dark blue to a light blue on the horizon as the sun begins to rise. I maintain two arrays for star objects (shooting & static) which are populated prior to animation. A star object contains a number of properties including x&y coordinates and velocity. These values are generated across a random range so each sky and star is different.',
                'The animation loop happens inside of a throttled call to requestAnimationFrame. Each loop uses the two star arrays to move the shooting stars, using their velocity properties, and to paint the static stars into position.',
                'Overall I find the effect pleasant and I have used it as a background (using position fixed and z-index to cover the viewport and overlay other elements) on a few pages. There are some performance issues with flickering that might be addressed later.'
            )
        ),
        array(
            'title' => '3D Color Cube',
            'link' => '/apps/colorcube.html',
            'image' => '/images/colorcube.jpg',
            'paragraphs' => array(
                'This project stared with a desire to attempt 3D animation on 2D canvas. Even though I have played around with canvas before this was my first experience ever doing something in 3D. I wasn’t originally too concerned with the actual functionality of the application.',
                'I started out by creating a 3D rotating cube.  The math to accomplish the projection of 3D space onto a 2D plane can be seen inside of the Point3D class. Each point contains x, y, and z coordinates, as well as a projection function. These calculations were arrived at through combining a number of different ideas I found around the web.',
                'Once I had the rotating cube I did want to add some functionality to the application even if it was superficial in nature. I decided to use this cube as a visual representation of color breakdown of RGB values. The color black, white, red, green, and blue all sit on vertices of the cube. The subsequent derived colors of cyan, magenta, and yellow also sit on their respective vertices. The result is a cube with a color point on each corner.',
                'Once the cube and color points were positioned I added text boxes for the user to enter any RGB value. The result was then an additional point being added somewhere inside of the cube. The point is the color of the RGB value entered by the user as well as being positioned relatively to the colored vertices. The result is a graph along x, y, and z axis ranging from 0 to 255 showing how each color is actually constructed.'
            )
        ),
        array(
            'title' => '3D Visualization Of A K-Means Machine Leaning Algorithm',
            'link' => '/apps/kmeanscube.html',
            'image' => '/images/kmeans.jpg',
            'paragraphs' => array(
                'Machines learning algorithms are something that have always interested me so when I saw a blog post about machine learning in javascript I was very interested. A lot of the code shown here originated from following the tutorial that Burak Kanber presented here -- http://burakkanber.com/blog/machine-learning-k-means-clustering-in-javascript-part-1/.',
                'I have put my own spin on it by using the previously developed 3D cube to visually represent these points across three dimensions. I also allow the user to define their own data sets by either entering the information manually or uploading a csv file containing their data set. The user also can define their own k value (number of clusters) to see how the algorithm changes based on that.',
                'This application is not currently mobile friendly and does have a few minor layout issues that I will get back to addressing soon. Overall though this is one of the more interesting things I’ve built in my opinion. I have personally uploaded a number of test data sets using baseball stats pulled from fangraphs.com and the clustering done reveals some interesting results and relationships between different players based on statistical results.',
                'I do want to provide a few test csv sets to better demonstrate this application as well as adding some informational text both explaining k-means algorithm as well as how to use the application. For now more information about k-means can be found here: https://en.wikipedia.org/wiki/K-means_clustering'
            )
        ),
        array(
            'title' => 'Draft WAR',
            'link' => 'https://github.com/jcmitch/draftwar',
            'image' => '/images/draftwar.jpg',
            'paragraphs' => array(
                'This project started with a question. It is also specific to baseball statistics, which are a passion of mine. My question was to come up with a way to calculate the success of a teams drafting ability. I knew that baseball-reference.com had total WAR values by team and year so harvesting these values for multiple teams, across multiple seasons, seemed like something just begging to be automated. So I wrote a script.',
                'Some clarification on the question and my attempt at an answer - This isn’t a straightforward question and the answer could take a number of different approaches.  I decided I wanted to approach it from the direction of WAR to keep it simple.  If you were to total up the WAR for all players drafted by each team which team would come out with the best record and which would be the worst.  I assigned WAR values simply based on the team that drafted the player regardless of if they are still on the team or not.  Of course free agency and trades mean that the WAR values being considered aren’t necessarily earned while the player was part of the organization that originally drafted them.  However for this exercise that isn’t what is important.  The idea is to see which teams were best at being able to evaluate that talent early enough to recognize it for the draft.',
                'My script simply curls baseball-reference (thanks guys) and greps the response to pull out the data I need. The script allows the user to define team, start year, and end year all from command line parameters. Once the script was written it was trivial to pull these values anytime I wanted.'
            )
        ),
        array(
            'title' => 'Data Visulization Using Chart.js',
            'link' => '/apps/catstats.php',
            'image' => '/images/catstats.jpg',
            'paragraphs' => array(
                'This project is one of the more ridiculous things I have ever built. The origin of it was a desire to play around with Chart.js, an open sourced data visualization library. The ridiculous part is the actual data set that is being represented.',
                'A friend and I often watch Seattle Mariner games and since we know the other person is also watching we use Facebook messenger to talk about the game as it is going on. After a while, I don’t entirely know how, we developed a habit of using Facebook’s sticker packs to communicate emotion. Specifically we used the Pusheen Cat sticker packs.',
                'We did it so often we became curious about how many of these stickers we had actually sent back and forth to each other. Combine that along with my desire to do something with Chart.js and you get what I’ve called “Cat Stats”.',
                'I had absolutely zero desire to deal with oauth, if Facebook even allows it, so I knew I couldn’t actually pull live stats from this but I also didn’t want to calculate the totals by hand. So I wrote a bit of javascript that could be pasted into Chrome console that would find all of the different stickers and generate me some json that my application could then use.',
                'Once I had the data I wanted to use Chart.js in a number of ways. As you can see I do total counts by user as well as stickers. I also graph stickers over time so we can see which stickers were popular during which times of the year. It is interesting to watch how our sticker trends follow the success and failure of the team.',
                'The application also allows the user to toggle different stickers from the lower panel to view any combination of stickers. The data set is very large so if all stickers are selected there are performance issues with Chart.js but it does eventually work.',
                'It is ridiculous but it is also a fun experiment and implementation of a javascript data visualization library. So there it is – I give you Cat Stats.'
            )
        ),
        array(
            'title' => 'MLB Trivia: Android Application',
            'link' => 'https://github.com/jcmitch/MLBTrivia',
            'image' => '/images/mlbtrivia.jpg',
            'paragraphs' => array(
                'This project started because I couldn’t find a decent ad free version of a MLB trivia app. It had also been awhile since I had done anything with native android development so I wanted to get back into that. Unfortunately the project has never made it as far as I hoped it would but I will hopefully get back to it at some point.',
                'The app itself is a simple one. Right now it only has one set of questions and will ask the user to identify the World Series winner going back to 1970. All the questions are multiple choice with one of the incorrect answers being the other team that played in the World Series and the other two incorrect options being randomly selected.',
                'The answers, and team names, are stored in sql database. I also have a question class, which doesn’t do much other than hold information about each question. There are two activities in this application, one for the quiz itself and one for the results page. The quiz activity maintains a timer and progresses the game and the result activity calculates the final score.',
                'As I said this app needs a lot of work for it to become what I would like it to be but it does serve as a start for some basic Android development principles.'
            )
        )
    );

    return $data;
}
?>