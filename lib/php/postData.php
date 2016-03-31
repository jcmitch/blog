<?php
function getPostData() {
    $data = array(
        '8' => array(
            'title' => 'Jump!',
            'summary' => '"Jump!" is a very simple game that I decided to put together that is basically serving as a precursor to a much larger game that I wanted to put together. I wanted to figure out the basics around jumping and collision detection.',
            'link' => '/posts.php?postid=8',
            'timestamp' => '1458777600',
            'body' => array(
                array(
                    'node' => 'p',
                    'value' => '"Jump!" is a very simple game that I decided to put together that is basically serving as a precursor to a much larger game that I wanted to put together. I wanted to figure out the basics around jumping and collision detection.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'The game is built using canvas and some free game assets provided by opengameart.org. There are actually a few different canvases used for this game. One canvas contains all of the static elements of the game (background and towers). The second canvas is our animation canvas which is used for our character and the jump indication line used by the user to direct the character.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'A few different assets are used in the game. Specifically for the character one image is used when standing, another for collision happens, and two additional images for jumping through the air. As the character is jumping up we use one and then when falling we switch to another image of the character falling. The images that are used are all pre-loaded and a Promise is used to make sure they are ready before we begin the game.'
                ),
                array(
                    'node' => 'code',
                    'value' => 'function prepareImages() {&#10;    idle.src = \'./images/jump/idle.png\';&#10;    fall.src = \'./images/jump/fall.png\';&#10;    up.src = \'./images/jump/up.png\';&#10;    hit.src = \'./images/jump/hit.png\';&#10;    cap.src = \'./images/jump/tile.png\';&#10;    var loadImage = function(img) {&#10;        var deferred = $.Deferred();&#10;        img.onload = function() {&#10;            deferred.resolve();&#10;        };&#10;        return deferred.promise();&#10;    }&#10;    $.when.apply(null, [loadImage(idle), loadImage(fall), loadImage(up), loadImage(hit), loadImage(cap)]).done(function() {&#10;        drawForeground();&#10;        drawCharacter();&#10;    });&#10;}'
                ),
                array(
                    'node' => 'p',
                    'value' => 'The game uses some fairly basic math to the arcs of the jump. The position of the character is calculated based on the originating coordinates, speed, angle, and time.'
                ),
                array(
                    'node' => 'code',
                    'value' => 'function createMovement() {&#10;    movement = {&#10;        x: startChar.x,&#10;        y: startChar.y,&#10;        speed: Math.sqrt(Math.pow(end.x - startChar.x, 2) + Math.pow(end.y - startChar.y, 2)),&#10;        angle: Math.atan2(-(end.y - startChar.y), end.x - startChar.x) * 180 / Math.PI,&#10;        time: 0&#10;    };&#10;}'
                ),
                array(
                    'node' => 'p',
                    'value' => 'As the character moves across the screen during each frame we run our detect collision function. This function detects both good and bad collisions. If the character lands on the next tower a point is awarded or if the character collides with the side or a tower or the edge of the game the game and score is reset.'
                ),
                array(
                    'node' => 'code',
                    'value' => 'function detectCollision(x, y, adjWidth, adjHeight) {&#10;    var collision = false;&#10;    var landed = false;&#10;    if (x < 0 || y < 0 || x > (700 - adjWidth) || y > (500 - adjHeight)) {&#10;        collision = true;&#10;    }&#10;    if ((x + adjWidth) > towers[1].x && (y + adjHeight) > towers[1].y) {&#10;        collision = true;&#10;    }&#10;    if ((x + adjWidth) > towers[1].x && x < (towers[1].x + towers[1].width) && (y + adjHeight) < (towers[1].y + 5) && (y + adjHeight) > (towers[1].y - 5)) {&#10;        landed = true;&#10;    }&#10;    return {&#10;        collision: collision,&#10;        landed: landed&#10;    };&#10;}'
                ),
                array(
                    'node' => 'p',
                    'value' => 'I think the physics are a little off here but I plan on perfecting that as part of the side-scroller game that I plan on eventually building.'
                )
            )
        ),
        '7' => array(
            'title' => 'Stars: An Animated Background Created With Canvas',
            'summary' => 'This is a simple project inspired by the idea of live wallpapers on Android phones. I wanted to see if I could come up with something that could be used for a webpage but I didn’t just want to take the easy way out and use an animated GIF. The solution… canvas.',
            'link' => '/posts.php?postid=7',
            'timestamp' => '1457568000',
            'body' => array(
                array(
                    'node' => 'p',
                    'value' => 'This is a simple project inspired by the idea of live wallpapers on Android phones. I wanted to see if I could come up with something that could be used for a webpage but I didn’t just want to take the easy way out and use an animated GIF. I wanted something more dynamic and changed every time it was used.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'The solution… canvas. I decided to style the canvas to look like a night sky (with a bunch of shooting stars for fun).'
                ),
                array(
                    'node' => 'code',
                    'value' => '// Sky&#10;ctx.globalCompositeOperation = \'source-over\';&#10;var grad = ctx.createLinearGradient(0, 0, 0, HEIGHT);&#10;grad.addColorStop(0, \'rgba(0,32,162,.3)\');&#10;grad.addColorStop(1, \'rgba(122,235,247,.3)\');&#10;ctx.fillStyle = grad;&#10;ctx.fillRect(0, 0, WIDTH, HEIGHT);&#10;ctx.globalCompositeOperation = \'lighter\';'
                ),
                array(
                    'node' => 'p',
                    'value' => 'In the code shown above we can see how I style the sky. We are simply creating a graident that is assigned to the fillstyle of the canvas. You will also notice that the graident has a 30% opacity on it. This is because we are also using source-over as the globalCompositeOperation value. This combination is what gives our shooting stars their tails as they move.'
                ),
                array(
                    'node' => 'code',
                    'value' => 'function createStar() {&#10;    this.x = Math.random() * WIDTH;&#10;    this.y = Math.random() * HEIGHT;&#10;    this.velX = (Math.random() < 0.5 ? -1 : 1) * Math.random() * 4;&#10;    this.velY = (Math.random() < 0.5 ? -1 : 1) * Math.random() * 4;&#10;    this.color = \'rgb(255,255,255)\';&#10;}'
                ),
                array(
                    'node' => 'p',
                    'value' => 'This is what is contained in our star objects. Each star has a x and y position on the canvas as well as a velocity and direction which is randomized. The color value is hardcoded for now but I have left it here to allow for playing with different colored stars in the future.'
                ),
                array(
                    'node' => 'code',
                    'value' => '// Shooting Stars&#10;shootingStars.forEach(function(curStar) {&#10;    ctx.beginPath();&#10;    ctx.fillStyle = curStar.color;&#10;    ctx.arc(curStar.x, curStar.y, 1, Math.PI * 2, false);&#10;    ctx.fill();&#10;&#10;    curStar.x += curStar.velX;&#10;    curStar.y += curStar.velY;&#10;&#10;    if(curStar.x < -20) curStar.x = WIDTH + 20;&#10;    if(curStar.y < -20) curStar.y = HEIGHT + 20;&#10;    if(curStar.x > WIDTH + 20) curStar.x = -20;&#10;    if(curStar.y > HEIGHT + 20) curStar.y = -20;&#10;});&#10;&#10;// Static Stars&#10;stars.forEach(function(curStar) {&#10;    ctx.beginPath();&#10;    ctx.fillStyle = curStar.color;&#10;    ctx.arc(curStar.x, curStar.y, 1, Math.PI * 2, false);&#10;    ctx.fill();&#10;});'
                ),
                array(
                    'node' => 'p',
                    'value' => 'Finally we see how we paint our stars onto our canvas. The static stars are very simple and we simply iterate over the array and paint them at their x and y positions. For the shooting stars we use their velocity values to move them and assign new x and y values. We then check to make sure they are within bounds.'
                )
            )
        ),
        '6' => array(
            'title' => '3D Visualization Of A K-Means Machine Leaning Algorithm',
            'summary' => 'Machines learning algorithms are something that have always interested me so when I saw a blog post about machine learning in javascript I was very interested. A lot of the code shown here originated the work of Burak Kanber. Find a link to his post in the full body of this post or on the application page.',
            'link' => '/posts.php?postid=6',
            'timestamp' => '1455408000',
            'body' => array(
                array(
                    'node' => 'p',
                    'value' => 'Machines learning algorithms are something that have always interested me so when I saw a blog post about machine learning in javascript I was very interested. A lot of the code shown here originated from following the tutorial that Burak Kanber presented here -- http://burakkanber.com/blog/machine-learning-k-means-clustering-in-javascript-part-1/.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'I have put my own spin on it by using the previously developed 3D cube to visually represent these points across three dimensions. I also allow the user to define their own data sets by either entering the information manually or uploading a csv file containing their data set. The user also can define their own k value (number of clusters) to see how the algorithm changes based on that.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'A lot of this code related to projection of 3D onto 2D canvas I am going to skip over since it was defined previously in the 3D color cube application. This application has the same rotating cube but the interesting part is in the points graphed inside of the cube.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'More information about k-means can be found here: https://en.wikipedia.org/wiki/K-means_clustering'
                ),
                array(
                    'node' => 'p',
                    'value' => 'The k-means algorithm is basically an attempt to categorize items in a data set into a defined number(k) of groups or clusters. We have throttled this calculation so it is easy for the user to see the algorithm taking place as different items are moved to be in different clusters. Our setup function shown here gives an overview of the flow.'
                ),
                array(
                    'node' => 'code',
                    'value' => 'function setup() {&#10;    draw();&#10;    means = [];&#10;    assignments = [];&#10;    canvas = $(\'.myCanvas\');&#10;    if(canvas.get(0) && canvas.get(0).getContext) {&#10;        ctx = canvas.get(0).getContext(\'2d\');&#10;    }&#10;&#10;    var len = data.length;&#10;    var message = len >= MIN_DATA_POINTS ? \'Calculating...\' : \'Waiting for \'+(MIN_DATA_POINTS-len)+\' data points...\';&#10;    $(\'.message\').text(message);&#10;&#10;    if (!data.length || data.length < MIN_DATA_POINTS) {return;}&#10;    dataExtremes = getDataExtremes(data);&#10;    dataRange = getDataRanges(dataExtremes);&#10;    means = initMeans(meansCount);&#10;    makeAssignments();&#10;    setTimeout(run, drawDelay);&#10;}'
                ),
                array(
                    'node' => 'p',
                    'value' => 'We start out by generating the 3D cube. After that there is some basic validation but if all of that passes the important functions for the algorithm are listed. We first calculate the extremes and ranges for our data sets. After that we initialize our means by randomly placing them in the defined bounds. We then make assignments of our data points to specific clusters. This is the basic flow that sets up the initial state.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'Our run function will then begin the work to move our data into the desired clusters. It will continue to recursively call itself until points are no longer being moved between clusters.'
                ),
                array(
                    'node' => 'code',
                    'value' => 'function run() {&#10;    var moved = moveMeans();&#10;    if(moved) {&#10;        calcTimer = setTimeout(run, drawDelay);&#10;    } else {&#10;        $(\'.message\').text(\'Completed.\');&#10;    }&#10;}'
                ),
                array(
                    'node' => 'p',
                    'value' => 'The moveMeans function will again call the makeAssignments function and then we begin the calculation to see which mean each data point is closest to. We will move the means to the best position for all assigned data points and then on the next flow we will see if there are points moved to other clusters because of this adjustment. This process is continued until a no points switch clusters.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'There is potential for getting different answers when running this algorithm but that is common for a number of machine learning algorithms, look up "committee of machines".'
                ),
                array(
                    'node' => 'p',
                    'value' => 'This application also allows the user to define their own data sets manually or by uploading a file. Uploading a file is really the last interesting part of this application. It uses HTML5 fileReader to do this. The application expects a csv file of data with no titles included. It is read as a text file and then parsed.'
                ),
                array(
                    'node' => 'code',
                    'value' => '$(\'#files\').on(\'change\', function(evt) {&#10;    var f = evt.target.files[0];&#10;    var reader = new FileReader();&#10;&#10;  reader.onload = (function(theFile) {&#10;    return function(e) {&#10;        if (e && e.target && e.target.result) {&#10;            var rows = JSON.stringify(e.target.result).split(/\\r/);&#10;            rows.forEach(function(row) {&#10;                var fields = row.split(\',\');&#10;                addData(fields[0], fields.slice(1));&#10;            });&#10;            restart();&#10;        }&#10;    };&#10;  })(f);&#10;&#10;  reader.readAsText(f);&#10;});'
                )
            )
        ),
        '5' => array(
            'title' => '3D Color Cube',
            'summary' => 'This project stared with a desire to attempt 3D animation on 2D canvas. Even though I have played around with canvas before this was my first experience ever doing something in 3D. The result is a 3D rotating cube that shows a visual breakdown of a user requested RGB color.',
            'link' => '/posts.php?postid=5',
            'timestamp' => '1454803200',
            'body' => array(
                array(
                    'node' => 'p',
                    'value' => 'This project stared with a desire to attempt 3D animation on 2D canvas. Even though I have played around with canvas before this was my first experience ever doing something in 3D. I wasn’t originally too concerned with the actual functionality of the application.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'I started out by creating a 3D rotating cube.  The math to accomplish the projection of 3D space onto a 2D plane can be seen inside of the Point3D class. Each point contains x, y, and z coordinates, as well as a projection function. These calculations were arrived at through combining a number of different ideas I found around the web.'
                ),
                array(
                    'node' => 'code',
                    'value' => 'function Point3D(x,y,z) {&#10;    this.x = x;&#10;    this.y = y;&#10;    this.z = z;&#10;&#10;    this.rotateX = function(angle) {&#10;        var rad, cosa, sina, y, z;&#10;        rad = angle * Math.PI / 180;&#10;        cosa = Math.cos(rad);&#10;        sina = Math.sin(rad);&#10;        y = this.y * cosa - this.z * sina;&#10;        z = this.y * sina + this.z * cosa;&#10;        return new Point3D(this.x, y, z);&#10;    };&#10;&#10;    this.rotateY = function(angle) {&#10;        var rad, cosa, sina, x, z;&#10;        rad = angle * Math.PI / 180;&#10;        cosa = Math.cos(rad);&#10;        sina = Math.sin(rad);&#10;        z = this.z * cosa - this.x * sina;&#10;        x = this.z * sina + this.x * cosa;&#10;        return new Point3D(x,this.y, z);&#10;    };&#10;&#10;    this.rotateZ = function(angle) {&#10;        var rad, cosa, sina, x, y;&#10;        rad = angle * Math.PI / 180;&#10;        cosa = Math.cos(rad);&#10;        sina = Math.sin(rad);&#10;        x = this.x * cosa - this.y * sina;&#10;        y = this.x * sina + this.y * cosa;&#10;        return new Point3D(x, y, this.z);&#10;    };&#10;&#10;    this.project = function(viewWidth, viewHeight, fov, viewDistance) {&#10;        var factor, x, y;&#10;        factor = fov / (viewDistance + this.z);&#10;        x = this.x * factor + viewWidth / 2;&#10;        y = this.y * factor + viewHeight / 2;&#10;        return new Point3D(x, y, this.z);&#10;    };&#10;}'
                ),
                array(
                    'node' => 'p',
                    'value' => 'To get the cube to rotate we have our animation function. This function uses a throttled approach to requestAnimationFrame to achieve the desired speed as well as the performance gain of this over a simple setTimeout. The function will use an array of vertices to draw out the different faces of the cube using the projection calculations show above to get the desired 3D look. '
                ),
                array(
                    'node' => 'p',
                    'value' => 'Once I had the rotating cube I did want to add some functionality to the application even if it was superficial in nature. I decided to use this cube as a visual representation of color breakdown of RGB values. The color black, white, red, green, and blue all sit on vertices of the cube. The subsequent derived colors of cyan, magenta, and yellow also sit on their respective vertices. The result is a cube with a color point on each corner.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'Once the cube and color points were positioned I added text boxes for the user to enter any RGB value. The result was then an additional point being added somewhere inside of the cube. The point is the color of the RGB value entered by the user as well as being positioned relatively to the colored vertices. The result is a graph along x, y, and z axis ranging from 0 to 255 showing how each color is actually constructed.'
                )
            )
        ),
        '4' => array(
            'title' => 'MLB Trivia: Android Application',
            'summary' => 'This project started because I couldn’t find a decent ad free version of a MLB trivia app. It had also been awhile since I had done anything with native android development so I wanted to get back into that. Unfortunately the project has never made it as far as I hoped it would but I will hopefully get back to it at some point.',
            'link' => '/posts.php?postid=4',
            'timestamp' => '1442707200',
            'body' => array(
                array(
                    'node' => 'p',
                    'value' => 'This project started because I couldn’t find a decent ad free version of a MLB trivia app. It had also been awhile since I had done anything with native android development so I wanted to get back into that. Unfortunately the project has never made it as far as I hoped it would but I will hopefully get back to it at some point.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'The app itself is a simple one. Right now it only has one set of questions and will ask the user to identify the World Series winner going back to 1970. All the questions are multiple choice with one of the incorrect answers being the other team that played in the World Series and the other two incorrect options being randomly selected.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'The answers, and team names, are stored in sql database. We query the data base for generating our questions.'
                ),
                array(
                    'node' => 'code',
                    'value' => '// Select All Query&#10;String selectQuery = "SELECT  * FROM " + TABLE_WINNERS;&#10;dbase=this.getReadableDatabase();&#10;Cursor cursor = dbase.rawQuery(selectQuery, null);&#10;int randNumb = 0;&#10;if (cursor.moveToFirst()) {&#10; do {&#10;       Question quest = new Question();&#10;        quest.setID(cursor.getInt(0));&#10;        quest.setQUESTION("Who won the World Series in "+cursor.getString(1)+"?");&#10;        quest.setANSWER(cursor.getString(2));&#10;        ansList.add(cursor.getString(2));&#10;        ansList.add(cursor.getString(3));&#10;        while (ansList.size() < 5) {&#10;          randNumb = randInt(0,29);&#10;            if (ansList.indexOf(aryTeams[randNumb]) == -1) {&#10;             ansList.add(aryTeams[randNumb]);&#10;            }&#10;        }&#10;        long seed = System.nanoTime();&#10;        Collections.shuffle(ansList, new Random(seed));&#10;        quest.setOPTA(ansList.get(0));&#10;        quest.setOPTB(ansList.get(1));&#10;        quest.setOPTC(ansList.get(2));&#10;        quest.setOPTD(ansList.get(3));&#10;        quest.setOPTE(ansList.get(4));&#10;        quesList.add(quest);&#10;        ansList.clear();&#10;    } while (cursor.moveToNext());&#10;}'
                ),
                array(
                    'node' => 'p',
                    'value' => 'I also have a question class, which doesn’t do much other than hold information about each question. There are two activities in this application, one for the quiz itself and one for the results page. The quiz activity maintains a timer and progresses the game and the result activity calculates the final score. This is the onCreate function for our quiz activity.'
                ),
                array(
                    'node' => 'code',
                    'value' => 'protected void onCreate(Bundle savedInstanceState) {&#10;    super.onCreate(savedInstanceState);&#10;    setContentView(R.layout.activity_quiz);&#10;    DbHelper db=new DbHelper(this);&#10;    quesList=db.getAllQuestions();&#10;    currentQ=quesList.get(qid);&#10;    txtQuestion=(TextView)findViewById(R.id.textView1);&#10;    scoreText=(TextView)findViewById(R.id.score);&#10;    butA=(Button)findViewById(R.id.button1);&#10;    butB=(Button)findViewById(R.id.button2);&#10;    butC=(Button)findViewById(R.id.button3);&#10;    butD=(Button)findViewById(R.id.button4);&#10;    butE=(Button)findViewById(R.id.button5);&#10;    gameTimer = (Chronometer)findViewById(R.id.gameTimer);&#10;    gameTimer.setBase(SystemClock.elapsedRealtime());&#10;    gameTimer.start();&#10;    setQuestionView();&#10;}'
                ),
                array(
                    'node' => 'p',
                    'value' => 'As I said this app needs a lot of work for it to become what I would like it to be but it does serve as a start for some basic Android development principles.'
                )
            )
        ),
        '3' => array(
            'title' => 'Draft WAR',
            'summary' => 'This project started with a question. It is also specific to baseball statistics, which are a passion of mine. My question was to come up with a way to calculate the success of a teams drafting ability. I knew that baseball-reference.com had total WAR values by team and year so harvesting these values for multiple teams, across multiple seasons, seemed like something just begging to be automated. So I wrote a script.',
            'link' => '/posts.php?postid=3',
            'timestamp' => '1441152000',
            'body' => array(
                array(
                    'node' => 'p',
                    'value' => 'This project started with a question. It is also specific to baseball statistics, which are a passion of mine. My question was to come up with a way to calculate the success of a teams drafting ability. I knew that baseball-reference.com had total WAR values by team and year so harvesting these values for multiple teams, across multiple seasons, seemed like something just begging to be automated. So I wrote a script.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'Some clarification on the question and my attempt at an answer - This isn’t a straightforward question and the answer could take a number of different approaches.  I decided I wanted to approach it from the direction of WAR to keep it simple.  If you were to total up the WAR for all players drafted by each team which team would come out with the best record and which would be the worst.  I assigned WAR values simply based on the team that drafted the player regardless of if they are still on the team or not.  Of course free agency and trades mean that the WAR values being considered aren’t necessarily earned while the player was part of the organization that originally drafted them.  However for this exercise that isn’t what is important.  The idea is to see which teams were best at being able to evaluate that talent early enough to recognize it for the draft.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'My script simply curls baseball-reference (thanks guys) and greps the response to pull out the data I need. The script allows the user to define team, start year, and end year all from command line parameters. Once the script was written it was trivial to pull these values anytime I wanted.'
                ),
                array(
                    'node' => 'code',
                    'value' => 'a=\'http://www.baseball-reference.com/draft/?query_type=franch_year&team_ID=\'&#10;b=\'&year_ID=\'&#10;c=\'&draft_type=junreg\'&#10;team=${1-SEA}&#10;start=${2-2000}&#10;end=${3-2015}&#10;echo "$team WAR Per Year $start-$end"&#10;for ((end;end>=start;end--))&#10;do&#10;&nbsp;&nbsp;&nbsp;&nbsp;url=$a$team$b$end$c&#10;&nbsp;&nbsp;&nbsp;&nbsp;result=$(curl -s $url | grep -o "Total of [^<]*")&#10;&nbsp;&nbsp;&nbsp;&nbsp;echo "$end $result"&#10;done'
                )
            )
        ),
        '2' => array(
            'title' => 'Data Visulization Using Chart.js',
            'summary' => 'This project is one of the more ridiculous things I have ever built. The origin of it was a desire to play around with Chart.js, an open sourced data visualization library. The ridiculous part is the actual data set that is being represented.',
            'link' => '/posts.php?postid=2',
            'timestamp' => '1436918400',
            'body' => array(
                array(
                    'node' => 'p',
                    'value' => 'This project is one of the more ridiculous things I have ever built. The origin of it was a desire to play around with Chart.js, an open sourced data visualization library. The ridiculous part is the actual data set that is being represented.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'A friend and I often watch Seattle Mariner games and since we know the other person is also watching we use Facebook messenger to talk about the game as it is going on. After a while, I don’t entirely know how, we developed a habit of using Facebook’s sticker packs to communicate emotion. Specifically we used the Pusheen Cat sticker packs.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'We did it so often we became curious about how many of these stickers we had actually sent back and forth to each other. Combine that along with my desire to do something with Chart.js and you get what I’ve called “Cat Stats”.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'I had absolutely zero desire to deal with oauth, if Facebook even allows it, so I knew I couldn’t actually pull live stats from this but I also didn’t want to calculate the totals by hand. So I wrote a bit of javascript that could be pasted into Chrome console that would find all of the different stickers and generate me some json that my application could then use. The full script can be seen on github but this is the function that does the heavy lifting.'
                ),
                array(
                    'node' => 'code',
                    'value' => 'function scanPageForMessages() {&#10;  var messages = document.querySelectorAll(".webMessengerMessageGroup"),&#10;      result = [];&#10;&#10;  for (var i = 0; i < messages.length; i++) {&#10;    var message = messages[i],&#10;        catDiv = message.querySelectorAll("div.mvs"),&#10;        timestamp = message.querySelector("abbr.timestamp[data-utime]"),&#10;        profileLink = message.querySelector("strong > a[data-hovercard]");&#10;&#10;    var catUrl = \'\';&#10;   if (catDiv && catDiv.length) {&#10;     catDiv = catDiv[0];&#10;        catUrl = catDiv.style.backgroundImage;&#10;&#10;        var millis = 0;&#10;        if (timestamp) {&#10;           millis = 1000 * parseFloat(timestamp.getAttribute("data-utime"));&#10;      }&#10;&#10;     var curDate = new Date(millis);&#10;        var imgTagId = getImgId(catUrl);&#10;       if (imgTagId) {&#10;            result.push({&#10;                  name: profileLink.textContent,&#10;                 t: curDate,&#10;                tText: isoLocalTime(curDate),&#10;                  text: imgTagId&#10;         });&#10;        } else {&#10;           console.log("UH OH: "+catUrl);&#10;     }&#10;  }&#10;  }&#10;&#10;  return result;&#10;}'
                ),
                array(
                    'node' => 'p',
                    'value' => 'Once I had the data I wanted to use Chart.js in a number of ways. As you can see I do total counts by user as well as stickers. I also graph stickers over time so we can see which stickers were popular during which times of the year. It is interesting to watch how our sticker trends follow the success and failure of the team.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'Chart.js creates these animations with Canvas and offers a number of different chart types out of the box. For example I have a chart that tracks the usage per person for total cats. To do that I simply create a chart object like this.'
                ),
                array(
                    'node' => 'code',
                    'value' => 'var totalCatPie = new Chart(ctx).Pie([&#10;    {&#10;        value: userOneCount,&#10;        label: \'User One\',&#10;        color:"#0F2B51",&#10;        highlight: "#334A69"&#10;    },&#10;    {&#10;        value: userTwoCount,&#10;        label: \'User Two\',&#10;        color: "#065F5D",&#10;        highlight: "#2A7371"&#10;    }&#10;], {animationSteps: 30, animationEasing: "linear"});'
                ),
                array(
                    'node' => 'p',
                    'value' => 'I also have examples of line charts as well that show usage over a period of time. There is also support for segmenting the data sets and generating share urls that use query params to set fields on the server by default.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'The application also allows the user to toggle different stickers from the lower panel to view any combination of stickers. The data set is very large so if all stickers are selected there are performance issues with Chart.js but it does eventually work.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'It is ridiculous but it is also a fun experiment and implementation of a javascript data visualization library. So there it is – I give you Cat Stats.'
                )
            )
        ),
        '1' => array(
            'title' => 'Introduction',
            'summary' => 'This site mainly serves as a personal project as well as a common hosting location for other projects that I have worked on, or plan to work on. If others potentially find this site, hello. I hope that something here might be of use or interest to you. Feel free to contact me using the links on this page.',
            'link' => '/posts.php?postid=1',
            'timestamp' => '1435708800',
            'body' => array(
                array(
                    'node' => 'p',
                    'value' => 'This site mainly serves as a personal project as well as a common hosting location for other projects that I have worked on, or plan to work on.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'I am not sure exactly yet which projects are going to end up here but this is partially an attempt to get my personal projects organized since they are now scattered across github, dropbox, old hard drives, etc. If I at least have this index for them maybe I wont forget about them and it might even encourage me to keep working on some of them that are not yet finished.'
                ),
                array(
                    'node' => 'p',
                    'value' => 'If others potentially find this site, hello. I hope that something here might be of use or interest to you. Feel free to contact me using the links on this page. You can also find a link to a personal bio at the top of the page.'
                )
            )
        )
    );

    return $data;
}
?>