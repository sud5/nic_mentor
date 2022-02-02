<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Mentor of Change</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/icon.png" rel="icon">
  <link href="assets/img/icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  
</head>

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../config.php';
require_once('classes/mentor_signup_form.php');

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url('/local/mentor/mentor_signup.php');
$PAGE->set_title('Mentor');
$PAGE->set_heading('Mentor');
$PAGE->set_pagelayout('mentor_register');

echo $OUTPUT->header();
?>

<section id="register" class="portfolio">
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Mentor of Change</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/icon.png" rel="icon">
  <link href="assets/img/icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  
</head>

<body>


  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
        <div class="col-xl-6 col-lg-8">
          <h1>Mentor of Change <span>AIM</span></h1>
          <h2>Join this movement of nation building</h2>
          <a href="#register" class="get-started-btn scrollto mt-3">Register</a>
        </div>
      </div>      

    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <!-- <img src="assets/img/about.jpg" class="img-fluid" alt=""> -->
            <div class="responsive-video">
              <iframe src="https://drive.google.com/file/d/1p6yEqA7UwmhRO9Qf4PlmZU9oBu6oIPUr/preview" allowfullscreen></iframe>
            </div>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
            <h3>What is Mentor of Change</h3>
            <p class="fst-italic">
              Mentor India is a strategic nation building initiative to engage leaders who can guide and mentor students in over 8700 Atal Tinkering Labs that Atal Innovation Mission has established across India. Mentors of Change are proactive leaders who voluntarily give their time and expertise to guide and enable the students to experience, learn and practice future skills such as design and computational thinking. Mentors of Change are instrumental in making the tinkering labs as successful platforms where students can take advice from current industry leaders and bring that knowledge to practice.
            </p>            
          </div>
        </div>

      </div>
    </section><!-- End About Section -->    

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="image col-lg-6" data-aos="fade-right">
            <div class="responsive-video">
              <iframe src="https://www.facebook.com/plugins/video.php?height=313&href=https%3A%2F%2Fwww.facebook.com%2FAIMToInnovate%2Fvideos%2F764754767316586%2F&show_text=false&width=560&t=0" allowfullscreen></iframe>
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">            
              <h3>Eligibility</h3>
              <p class="fst-italic">
                We are looking for leaders who can volunteer on a regular basis in one or more such labs and enable students to experience, learn and practice future skills such as design and computational thinking, critical thinking, and applying what they have learned in classrooms to in a more hands-on setting. Additionally, from such experienced mentors, we hope that students will learn professionalism and life skills.
              </p>
              <p class="fst-italic">
                These labs are non-prescriptive by nature, and mentors are expected to be enablers rather than instructors.
              </p>
              <p class="fst-italic">
                Possible areas of contribution could be, but not limited to: a) Technical Knowhow: building prototypes, b) Innovation and Design: inculcating solution-oriented approach, c) Inspirational: leadership and self-motivation, and d) Business and Entrepreneurship: encouraging ideas and team building
              </p>                          
          </div>
        </div>

      </div>
    </section><!-- End Features Section -->    

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container" data-aos="zoom-in">

        <div class="text-center">
          <h3>Special</h3>
          <p> A part of being a mentor is to ask questions and dig deeper into what you hear the mentee telling you. Maybe this means challenging them on their assumptions and taking them out of their comfort zone.</p>
          <a class="cta-btn" href="#register">Call To Action</a>
        </div>

      </div>
    </section><!-- End Cta Section -->      

    <!-- ======= Portfolio Section ======= -->
<section id="register" class="portfolio">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Registration</h2>
          <p>Register Yourself</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li id="btn1" class="step">General</li>
              <li id="btn2" class="step" >Personal</li>
              <li id="btn3" class="step">Education</li>
              <li id="btn4" class="step">Experience</li>
              <li id="btn4" class="step">Referee</li>
              <li id="btn4" class="step">Intent</li>
            </ul>
          </div>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="200">  

        <form action="mentorsignupprocess.php" method="post" role="form" class="php-email-form" id="regForm">        
          <div class="col-lg-12 tab" id="general">

            
              
              <div class="row">
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" name="firstname" class="form-control" id="firstname" placeholder="First Name" required oninput="this.className = ''">
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last Name" required oninput="this.className = ''">
                </div>
              </div> 

              <div class="row mt-3">
                <div class="col-md-12 form-group">
                  <select name="gender" class="form-control" oninput="this.className = ''">
                    <option disabled selected>Select your Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Transgender</option>
                  </select>
                </div>
              </div> 

              <div class="row mt-3">
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required oninput="this.className = ''">
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="alternateemail" id="alternateemail" placeholder="Alternate Email" required oninput="this.className = ''">
                </div>
              </div>
              
              <div class="row mt-3">
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="tel" class="form-control" name="phonenumber" id="phonenumber" placeholder="Phone Number" required oninput="this.className = ''">
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" onfocus="this.type='date'" class="form-control" name="dob" id="dob" placeholder="Date of Birth" required oninput="this.className = ''">
                </div>
              </div>

              <div class="row mt-3">
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="idtype" id="email" placeholder="ID Type" required oninput="this.className = ''">
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="idnumber" id="email" placeholder="ID Number" required oninput="this.className = ''">
                </div>
              </div>

              <div class="row mt-3">
                <div class="col-md-12 form-group">
                  <input type='file' class="form-control" required oninput="this.className = ''">
                </div>
              </div>
              

          </div>
        

<!--============================End of General fields============================-->
          <div class="col-lg-12 tab" id="personal">
            
              <div class="row mt-3">
                <div class="col-md-12 form-group">
                  <select name="nationality" class="form-control">
                    <option value="" selected>Select your Nationality</option>
                    <option value="indian">Indian</option>
                    <option value="other">Other</option>
                  </select>
                </div>
              </div> 

              <div class="row mt-3">
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="state" id="state" placeholder="State" required oninput="this.className = ''">
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="district" class="form-control" name="district" id="district" placeholder="District" required oninput="this.className = ''">
                </div>
              </div>
              
              <div class="row mt-3">
                <div class="form-group">
                  <textarea class="form-control" name="address1" rows="3" placeholder="Address 1" required oninput="this.className = ''"></textarea>
                </div> 
              </div>
              
              <div class="row mt-3">
                <div class="form-group">
                  <textarea class="form-control" name="address2" rows="3" placeholder="Address 2" required oninput="this.className = ''"></textarea>
                </div> 
              </div>

              <div class="row mt-3">
                <div class="col-md-12 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="pincode" id="pincode" placeholder="Pincode" required oninput="this.className = ''">
                </div>
              </div>

              <div class="row mt-3">
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="linkedinurl" id="linkedinid" placeholder="LinkedIn profile URL" required oninput="this.className = ''">
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="blogposturl" id="blogposturl" placeholder="Webpage/Blogpost URL" required oninput="this.className = ''">
                </div>
              </div>
             
          </div>

          <div class="col-lg-12 tab" id="education">
                                              

              <div class="row mt-3">
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="highestdegree" id="highestdegree" placeholder="Highest Awarded Degree" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="specilization" id="specilization" placeholder="Area of Specialisation" required>
                </div>
              </div>
              
              <div class="row mt-3">
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="institute" id="institute" placeholder="Educational Institute of Highest Awarded Degree" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="yearofcompletion" id="yearofcompletion" placeholder="Year of completion of Highest Awarded Degree" required>
                </div>
              </div>                          

              <div class="row mt-3">
                <div class="col-md-12 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="languages" id="languages" placeholder="Languages conversant in" required>
                </div>
              </div>
              
          </div>

          <div class="col-lg-12 tab" id="mentors">
                                                

              <div class="row mt-3">
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="registeringas" id="registeringas" placeholder="You are registering as" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="aimpartneremployed" id="aimpartneremployed" placeholder="Are you employed by any of the AIM partners?" required>
                </div>
              </div>
              
              <div class="row mt-3">
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="currentorgname" id="currentorgname" placeholder="Name of Current Organization" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="typeoforg" id="typeoforg" placeholder="Type of Organization" required>
                </div>
              </div>
              
              <div class="row mt-3">
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="designation" id="designation" placeholder="Designation with the Current Organization" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="currentwork" id="currentwork" placeholder="Current Area of Work" required>
                </div>
              </div>
              
              <div class="row mt-3">
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="currentworkexperience" id="currentworkexperience" placeholder="Work Experience with Current Organization" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="totalexperience" id="totalexperience" placeholder="Total Work Experience" required>
                </div>
              </div>
              
              <div class="row mt-3">
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="mentoringexperience" id="mentoringexperience" placeholder="Do you have any mentoring experience?" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="preferredmentoringform" id="preferredmentoringform" placeholder="Which form of mentoring would you prefer?" required>
                </div>
              </div>
              
              <div class="row mt-3">
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="noofhourstowork" id="noofhourstowork" placeholder="How many hours are you ready to commit per week?" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="preferredatls" id="preferredatls" placeholder="Please select 4 preferred ATLs to mentor" required>
                </div>
              </div>                            

              <div class="row mt-3">
                <div class="col-md-12 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="reasonformentorofchange" id="reasonformentorofchange" placeholder="Why do you want to be a Mentor of Change and how will your experience position you to be an effective mentor?" required>
                </div>
              </div>
          </div>
<!--End of mentors section-->

          <div class="col-lg-12 tab" id="referee">
           
              <div class="row mt-3">
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="referee1name" id="referee1name" placeholder="Referee 1 Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="referee1email" id="referee1email" placeholder="Referee 1 Email" required>
                </div>
              </div>
              
              <div class="row mt-3">
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="referee1phone" id="referee1phone" placeholder="Referee 1 Phone Number" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="referee1connection" id="referee1connection" placeholder="How do you know them?" required>
                </div>
              </div>                                                        

              <div class="row mt-3">
                <div class="col-md-12 form-group mt-3 mt-md-0">
                  <select name="referee1existingmentor" class="form-control">
                    <option value='' selected>Is the referee an existing Mentor of Change?</option>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                  </select>
                </div>
              </div>
              
              <div class="row mt-3">
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="referee2name" id="referee2name" placeholder="Referee 2 Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="referee2email" id="referee2email" placeholder="Referee 2 Email" required>
                </div>
              </div>
              
              <div class="row mt-3">
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="referee2phone" id="referee2phone" placeholder="Referee 2 Phone Number" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="referee2connection" id="referee2connection" placeholder="How do you know them?" required>
                </div>
              </div>                                                        

              <div class="row mt-3">
                <div class="col-md-12 form-group mt-3 mt-md-0">
                  <select name="referee2existingmentor" class="form-control">
                    <option value='' selected>Is the referee 2 an existing Mentor of Change?</option>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                  </select>
                </div>
              </div>
          </div>
<!--end of referee section-->

          <div class="col-lg-12 tab" id="personality">
            
              <div class="row mt-3">
                <div class="col-md-12 form-group mt-3 mt-md-0">
                  <div class="table-responsive">
                    <table class="table table-borderless">
                      <tr>
                        <th>Question</th>
                        <th>Strongly Agree</th>
                        <th>Agree</th>
                        <th>Neutral</th>
                        <th>Disagree</th>
                        <th>Strongly Disagree</th>
                      </tr>
                      <tr>
                        <td>I’m willing to put in a great deal of effort to excel in my professional life</th>
                        <td><input type="radio" value="1" name="willingtoputeffort"></th>
                        <td><input type="radio" value="2" name="willingtoputeffort"></th>
                        <td><input type="radio" value="3" name="willingtoputeffort"></th>
                        <td><input type="radio" value="4" name="willingtoputeffort"></th>
                        <td><input type="radio" value="5" name="willingtoputeffort"></th>
                      </tr>
                      <tr>
                        <td>Based on my work experience so far, I believe that I can constructively guide and nurture young minds</th>
                        <td><input type="radio" value="1" name="guideyoungminds"></th>
                        <td><input type="radio" value="2" name="guideyoungminds"></th>
                        <td><input type="radio" value="3" name="guideyoungminds"></th>
                        <td><input type="radio" value="4" name="guideyoungminds"></th>
                        <td><input type="radio" value="5" name="guideyoungminds"></th>
                      </tr>
                      <tr>
                        <td>When in meeting and group discussions, I consciously make an effort to listen to others</th>
                        <td><input type="radio" value="1" name="listentoothers"></th>
                        <td><input type="radio" value="2" name="listentoothers"></th>
                        <td><input type="radio" value="3" name="listentoothers"></th>
                        <td><input type="radio" value="4" name="listentoothers"></th>
                        <td><input type="radio" value="5" name="listentoothers"></th>
                      </tr>
                      <tr>
                        <td>In my offline and work environment I am known as someone who goes out of their way to meet my goals</th>
                        <td><input type="radio" value="1" name="goesoutofway"></th>
                        <td><input type="radio" value="2" name="goesoutofway"></th>
                        <td><input type="radio" value="3" name="goesoutofway"></th>
                        <td><input type="radio" value="4" name="goesoutofway"></th>
                        <td><input type="radio" value="5" name="goesoutofway"></th>
                      </tr>
                      <tr>
                        <td>I have experience guiding and mentoring people younger than me</th>
                        <td><input type="radio" value="1" name="guidingexperiencesamebg"></th>
                        <td><input type="radio" value="2" name="guidingexperiencesamebg"></th>
                        <td><input type="radio" value="3" name="guidingexperiencesamebg"></th>
                        <td><input type="radio" value="4" name="guidingexperiencesamebg"></th>
                        <td><input type="radio" value="5" name="guidingexperiencesamebg"></th>
                      </tr>
                      <tr>
                        <td>I have experience guiding and mentoring people who are from different backgrounds than me</th>
                        <td><input type="radio" value="1" name="guidingexperienceotherbg"></th>
                        <td><input type="radio" value="2" name="guidingexperienceotherbg"></th>
                        <td><input type="radio" value="3" name="guidingexperienceotherbg"></th>
                        <td><input type="radio" value="4" name="guidingexperienceotherbg"></th>
                        <td><input type="radio" value="5" name="guidingexperienceotherbg"></th>
                      </tr>
                      <tr>
                        <td>I feel confident in my ability to coordinate with multiple stakeholders</th>
                        <td><input type="radio" value="1" name="confidenttocordinate"></th>
                        <td><input type="radio" value="2" name="confidenttocordinate"></th>
                        <td><input type="radio" value="3" name="confidenttocordinate"></th>
                        <td><input type="radio" value="4" name="confidenttocordinate"></th>
                        <td><input type="radio" value="5" name="confidenttocordinate"></th>
                      </tr>
                      <tr>
                        <td>I feel confident in my ability to find solutions to problems I face or get the support I need</th>
                        <td><input type="radio" value="1" name="confidenttofindsolution"></th>
                        <td><input type="radio" value="2" name="confidenttofindsolution"></th>
                        <td><input type="radio" value="3" name="confidenttofindsolution"></th>
                        <td><input type="radio" value="4" name="confidenttofindsolution"></th>
                        <td><input type="radio" value="5" name="confidenttofindsolution"></th>
                      </tr>
                      <tr>
                        <td>If my mentee does not understand what I’m trying to communicate I will make deliberate attempts to figure out new ways of communicating with them</th>
                        <td><input type="radio" value="1" name="findnewwaystocommunicate"></th>
                        <td><input type="radio" value="2" name="findnewwaystocommunicate"></th>
                        <td><input type="radio" value="3" name="findnewwaystocommunicate"></th>
                        <td><input type="radio" value="4" name="findnewwaystocommunicate"></th>
                        <td><input type="radio" value="5" name="findnewwaystocommunicate"></th>
                      </tr>
                      <tr>
                        <td>I feel comfortable in coordinating with multiple stakeholders like school admin, teachers, parents and students</th>
                        <td><input type="radio" value="1" name="comfortabletocordinate"></th>
                        <td><input type="radio" value="2" name="comfortabletocordinate"></th>
                        <td><input type="radio" value="3" name="comfortabletocordinate"></th>
                        <td><input type="radio" value="4" name="comfortabletocordinate"></th>
                        <td><input type="radio" value="5" name="comfortabletocordinate"></th>
                      </tr>
                      
                    </table>
                  </div>
                </div>                
              </div>                            

              
          </div>

          <div class="text-center">
                <button type="button" class="form-button btn" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button class="form-button btn" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
          </div> 
            
        </form>
        </div>

      </div>

     
    </section><!-- End Portfolio Section -->

    

  </main><!-- End #main -->


  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

<?php
// //Instantiate simplehtml_form 
// $mform = new \mentor_signup_form();

// //Form processing and displaying is done here
// if ($mform->is_cancelled()) {
//     //Handle form cancel operation, if cancel button is present on form
// } else if ($fromform = $mform->get_data()) {
// //    print_object($fromform);die;
//     global $DB;
//     $data = new stdClass();
//     $data->firstname = $fromform->firstname;
//     $data->lastname = $fromform->lastname;
//     $data->email = $fromform->email;
//     $data->gender = $fromform->gender;
//     $data->dob = $fromform->dob;
//     $statename = $DB->get_field('state', 'name', array('id'=> $fromform->state));
//     $data->state = $statename;
//     $cityname = $DB->get_field('city', 'name', array('id'=>$fromform->cityid, 'stateid'=> $fromform->state));
//     $data->city = $cityname;
//     $data->linkedin = $fromform->linkedin;
//     $data->fburl = $fromform->fburl;
//     $data->status = 0;
//     $data->timemodified = time();
//     $data->timecreated = time();
//     $DB->insert_record('mentor_request', $data);
//     $url =new moodle_url('/local/mentor/mentor_signup.php');
//     redirect($url, get_string('requestmessage', 'local_mentor'));
//     //In this case you process validated data. $mform->get_data() returns data posted in form.
// } else {
//     // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
//     // or on the first display of the form.
//     //Set default data (if any)
// //    print_object($mform);die;
// //  $mform->set_data($toform);
//     //displays the form
// }

//$mform->display();
$PAGE->requires->js_call_amd('local_mentor/mentorform', 'setup');
echo $OUTPUT->footer();
?>

<style>
  #regForm {
  background-color: #ffffff;
  margin: 100px auto;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

#register form {
    width: 100%;
}

.form-group {
    margin-bottom: 1rem;
    width: 100%;
}

#register form .form-control{
  font-family: inherit;
}

.form-button {
    color: #151515;
    text-transform: uppercase;
    font-weight: 500;
    background: #ffc451;
    margin-top: 10px;
}
/* Style the input fields */
input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}
</style>
<script>
   var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true; //alert(currentTab);
  x = document.getElementsByClassName("tab");
  //xid = document.getElementById("general");
  console.log(document.getElementsByTagName("input"));
  y = x[currentTab].getElementsByTagName("input");//alert(y.length);
  // A loop that checks every input field in the current tab:
  // for (i = 0; i < y.length; i++) {
  //   // If a field is empty...
  //   //alert(y[i].name);
  //   if (y[i].value == "") {
  //     alert(y[i].name);
  //     // add an "invalid" class to the field:
  //     y[i].className += " invalid";
  //     // and set the current valid status to false:
  //     valid = false;
  //   }
  // }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    //alert('valid');
    document.getElementsByClassName("step")[currentTab].className += " finish";
  } else {
    alert('invalid');
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" filter-active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " filter-active";
}
</script>
