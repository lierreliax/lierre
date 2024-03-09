<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ivy Rivera</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    
    
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="#" class="logo">Ivy Rivera</a>
            <div class="menu">
                <a href="#" class="logo">Ivy Rivera</a>
                <div>
                    <a href="#home">Home</a>
                    <a href="#about">About</a>
                    <a href="#skills">Skills</a>
                    <a href="#contact">Contact</a>
                </div>
                <?php if(isset($_SESSION["user"])): ?>
                        <!-- If user is logged in, show comment button that triggers a function to redirect to comment.php -->
                        <div class="comment-btn">
                            <button onclick="redirectToComment()">Comment</button>
                        </div>
                    <?php else: ?>
                        <!-- If user is not logged in, display a disabled button that prompts the user to log in -->
                        <div class="comment-btn">
                            <button onclick="redirectToLogin()">Login to Comment</button>
                        </div>
                    <?php endif; ?>
            </div>
    
        </div>
    </nav>

    <main>
        <section class="card" id="home">
            <div class="home-container">
                <img class="home-img" src="ivy_home.png">

                <div class="lierre_quote">
                    <img src="lierre.png">

                    <p>
                        "Let your life intertwine with challenges,
                        climbing towards the light of
                        <span class="highlight-blue">growth</span>,
                        for in every twist and turn, you find
                        <span class="highlight-blue">strength</span>
                        and
                        <span class="highlight-blue">beauty</span>."
                    </p>

                </div>
            </div>

        </section>

        <section class="card" id="about"> 
            <div class="about-container">
                <div class="about-me">

                    <div class="text">
                        <h1> WHO AM I?</h1>
                    </div>

                    <div class="text">
                        <p> I am <span class="highlight-dark-blue"> Ivy Rivera</span>, 
                            a BSIT student and Mobile Development Officer of Google Developer Student Clubs.</p>
                    </div>

                    <div class="text">
                        <h3> <strong>Why did I join GDSC?</strong> <br><br> I joined GDSC because I believe in my untapped potential. My goal is to refine and unleash my capabilities, 
                            actively participating in an organization that not only enhances my technical skills but also fosters the development of my communication abilities. </h3>
                    </div>
                </div>
                    <img src="ivy_about.png">
            </div>
        </section>


        <section class="card" id="education"> 
            <div class="educ-container">
                <div class="text">
                    <h1>EDUCATIONAL BACKGROUND</h1>
                </div>
            
                <div class="graduate-container">
                    <div class="graduate-img">
                        <img src="kinder.png" alt="Kindergarten graduate-img">

                        <div class="year-school">
                            <p class="year">2009</p>
                            <p class="school">Oriole Learning School Inc.</p>
                        </div>
                        
                    </div>

                    <div class="graduate-img">
                        <img src="elem.png" alt="Elementary graduate-img">

                        <div class="year-school">
                            <p class="year">2010 - 2016</p>
                            <p class="school">Oriole Learning School Inc.</p>
                        </div>
                    </div>

                    <div class="graduate-img">
                        <img src="highschool.png" alt="High School graduate-img">

                        <div class="year-school">
                            <p class="year">2016 - 2022</p>
                            <p class="school">Batasan Hills National High School</p>
                        </div>
                    </div>

                    
                </div>
            </div>
        </section>

        <section class="card" id="education"> 
            <div class="current-educ-container">
                <div class="text">
                    <h1> CURRENT EDUCATION </h1>
                </div>
            
                <div class="educ-content">
                    <div class="educ-description">
        
                        <p><strong> Why did I choose NU-Fairvew?</strong>  <br><br>I decided to pursue my college education 
                            at (university) due to its convenient proximity to our residence. 
                            <br> <br>It is also a renowned and long-established institution, leading me to believe 
                            it provides a high-quality education.</p> <br>

                        <p><strong> Why did I pursue BSIT?</strong> <br><br>  As I delved into various technological aspects, I found myself excelling in understanding 
                            and working with the latest innovations. This realization motivated me to channel my passion 
                            into a formal education in BSIT, where I believe I can further develop my skills and contribute 
                            meaningfully to the ever-evolving field of information technology.</p>
                    </div>
                        <img src="nu.png">
                </div>
    
            </div>
        </section>

        <section class="card"> 
            <div class="hobbies-container">
                <img src="hobbies.png">
                <div class="hobbies-content">
                    <div class="text">
                        <h1> HOBBIES</h1>
                    </div>

                    <div class="hobbies-description"> 
                        <p> Recently, I find myself frequently scrolling through my phone during downtime. 
                            However, when blessed with ample free time, these are the <span class="highlight-blue">activities I really enjoy doing</span>.</p>
                    </div>

                    <div class="hobby">
                        <div class="hobby-box">
                            <p> Playing Guitar</p>
                        </div>
    
                        <div class="hobby-box">
                            <p> Listening to Music</p>
                        </div>

                        <div class="hobby-box">
                            <p> Reading Books</p>
                        </div>
                        <div class="hobby-box">
                            <p> Dancing </p>
                        </div>

                        <div class="hobby-box">
                            <p> Watching Movies </p>
                        </div>

                        <div class="hobby-box">
                            <p> Singing </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        

        <section class="card" id="cats"> 
            <div class="pets-container">
                <div class="pets-content">
                    <div class="text">
                        <h1> PETS</h1>
                    </div>

                    <div class="pets-description"> 
                        <p> I've loved cats since childhood, but my mom initially wouldn't let me have them. 
                            Fortunately, I managed to convince her two years ago to adopt one from the streets. <br> <br>
                            A few months later, it became pregnant, and now we have a total of six cats, although 
                            sadly, three of them passed away last year. <br> <br>
                        
                            Their playful antics and affectionate nature bring immense joy to my daily life. 
                        </p>
                    </div>

                </div>

                <div class="cat-column">
                    <div class="cats-row">
                        <div class="cats-container">
                            <img src="cream-o.png">
                            
                        </div>
    
                        <div class="cats-container">
                            <img src="oreo.png">
                           
                        </div>
    
                        <div class="cats-container">
                            <img src="chuck.png">
                            
                        </div>
    
                    </div>

                    <div class="cats-row">
                        <div class="cats-container">
                            <img src="hoshi.png">
                            
                        </div>
    
                        <div class="cats-container">
                            <img src="ginger.png">
                            
                        </div>
    
                        <div class="cats-container">
                            <img src="snow.png">
                            
                        </div>
    
                    </div>

                </div>
                
            </div>
           
        </section>

        <section class="card" id="skills"> 
            <div class="skill-sec-container">

                <div class="text">
                    <h1> SKILLS</h1>
                </div>

                <div class="row-container">
                    <div class="sub-container">
                        <div class="text-box">
                            <h6> Languages I used / Familiar With:</h6>
                        </div>
        
                        <div class="skills-container">
                        
                            <div class="box">
                                <i class="fa-brands fa-html5"></i>
                                <p> HTML 5 </p>
                            </div>
        
                            <div class="box">
                                <i class="fa-solid fa-code"></i>
                                <p> Kotlin </p>
                            </div>
                            
                            <div class="box">
                                <i class="fa-brands fa-linux"></i>
                                <p> Bash </p>
                            </div>
                            <div class="box">
                                <i class="fa-solid fa-database"></i>
                                <p> SQL </p>
                            </div>
            
                            <div class="box">
                                <i class="fa-brands fa-python"></i>
                                <p> Python </p>
                            </div>
        
                            <div class="box">
                                <i class="fa-brands fa-js"></i>
                                <p> Javascript </p>
                            </div>
            
                            <div class="box">
                                <i class="fa-brands fa-css3-alt"></i>
                                <p> CSS</p>
                            </div>
        
                            <div class="box">
                                <i class="fa-brands fa-java"></i>
                                <p> Java </p>
                            </div>
            
                            
                        </div>
                    </div>
    
                    <div class="sub-container">
                        <div class="text-box">
                            <h6> Tools I Use: </h6>
                        </div>
            
                        <div class="skills-container">
                            
                            <div class="box">
                                <i class="fa-brands fa-github"></i>
                                <p> GitHub</p>
                            </div>
                            <div class="box">
                                <i class="fa-brands fa-figma"></i>
                                <p> Figma </p>
                            </div>
            
                            <div class="box">
                                <i class="fa-solid fa-file-code"></i>
                                <p> VS Code</p>
                            </div>
                            <div class="box">
                                <i class="fa-brands fa-android"></i>
                                <p> Android Studio </p>
                            </div>
                        </div>

                        <div class="note">
                            <p> <strong> <span class="highlight-blue"> Note: </span> </strong> My expertise currently lies in mastering foundational principles. 
                                I am continuously expanding my skills to tackle diverse challenges and solve problems 
                                in the near future.</p>

                        </div>
    
                    </div>
                </div>

            

            

        </div> 

        </section>


        <section class="card" id="contact"> 
            <div class="contact-container">
                <div class="contact-description">

                    <h1> CONTACTS </h1>

                    <h2> Let's Connect</h2>

                    <p> If you're interested in collaboration or simply want to learn more, feel 
                        free to reach out by sending a message through any of the following accounts </p>
                </div>

                <div class="accounts">
                            
                    <a href="https://www.facebook.com/ivy.rivera.9674" target="_blank" class="contact-box">
                            <i class="fa-brands fa-facebook"></i>
                            <p> Facebook </p>
                    </a>
                    
                    <a href="https://github.com/lierreliax" target="_blank" class="contact-box">
                            <i class="fa-brands fa-github"></i>
                            <p> GitHub</p>
                    </a>
                    
                    <a href="https://www.linkedin.com/in/ivy-rivera-78b8b7252/" target="_blank" class="contact-box">
                            <i class="fa-brands fa-linkedin"></i>
                            <p> LinkedIn</p>
                    </a>
                    

                </div>

            </div>
           
        </section>

    </main>

    <footer>
            <p>&copy; 2024 Ivy Rivera. All rights reserved.</p>
        </p>
    </footer>

  
    

</body>

    <script>
        // const menuBTN = document.querySelector(".menu-btn");

        const menu = document.querySelector(".menu");

        // menuBTN.addEventListener("click", () => {
        //     menuBTN.firstElementChild.classList.toggle('fa-times');

        //     menu.classList.toggle("menu-open");

        // });

        document.addEventListener('DOMContentLoaded', function () {
        var cards = document.querySelectorAll('.card');
        var noStickyLinks = document.querySelectorAll('.navbar a');

        window.addEventListener('scroll', function () {
            var scrollPosition = window.scrollY;
            var threshold = 100;

            cards.forEach(function(card) {
                if (scrollPosition > threshold) {
                    card.classList.add('sticky');
                }
            });
        });

        noStickyLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                // Remove the "sticky" class from all cards
                cards.forEach(function(card) {
                    card.classList.remove('sticky');
                });
            });
        });
    });

        document.addEventListener("keydown", function (event){
    if (event.ctrlKey){
       event.preventDefault();
    }
    if(event.keyCode == 123){
       event.preventDefault();
    }
});

    function redirectToLogin() {
        // Redirect the user to the login page
        window.location.href = "login.php";
    }

    function redirectToComment() {
        // Redirect the user to comment.php
        window.location.href = "comment.php";
    }



    </script>

</html>
