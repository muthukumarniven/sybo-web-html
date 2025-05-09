<?php
$api_base_url = 'https://test.lovedones.ai/api-v1/account';
$api_key = 'xuwCbE1U.mTbo3Rn5Sl6EOAvD0KpGC36a752UUg5c';
if(isset($_POST['submit'])) {
    $email = $_POST['email_phone'];

    $url = $api_base_url.'/resend-otp';
    $data = array('email' => $email);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    // Add x-api-key to the header
    $headers = array(
        'x-api-key: '.$api_key,
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $result = json_decode($response, true);
    //echo "<pre>"; print_r($result); exit;
    if($result['status'] == '1') {
        $user_id = $result['user_id'];
        header('Location: delete-me.php?verify_otp=1&user_id='.$user_id); 

    } else {
        header('Location: delete-me.php?error=1'); 
    }

    curl_close($ch);
}
if(isset($_POST['submit_otp'])) {
    $user_id = $_POST['user_id'];
    $code = $_POST['code'];
    //echo "<pre>"; print_r($_POST); exit;

    $url = $api_base_url.'/verify-code';
    $data = array('user_id' => $user_id,'otp'=>$code);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    // Add x-api-key to the header
    $headers = array(
        'x-api-key: '.$api_key,
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $result = json_decode($response, true);
    if($result['status'] == 'true') {
        $access_token = $result['access'];
        //header('Location: delete-me.php?verify_otp=1&email='.$email); 
        $url = $api_base_url.'/remove-user'; // Replace with your URL
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $headers = array(
            'Authorization: Bearer ' . $access_token, 
            'x-api-key: '.$api_key,

        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($ch);
        $result = json_decode($response, true);
        if($result['status'] == '1') {
            header('Location: delete-me.php?success=1'); 
        } else {
            header('Location: delete-me.php?error=1'); 
        }

        curl_close($ch);
    } else {
        header('Location: delete-me.php?error=1'); 
    }
   
    curl_close($ch);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover">
    <title>LovedOnes.ai</title>
    <meta name="author" content="LovedOnes.ai">
    <meta name="description" content="LovedOnes.ai is a brand new way of generating an AI video of your loved ones that have passed away. LovedOnes.ai is a video (with voice over and text to video) generator tool for creating custom videos. The app takes a photo that you submit of your loved one plus an audio or video file of your loved ones voice, along with the text that you submit and then using AI technology  generates a custom video bringing your loved one back virtually! 
    We make it simple to generate a custom video of your loved one that has passed away. Although you can't be with them physically, LovedOnes.ai connects you to them virtually! ">
    <meta name="keywords" content="lovedones.ai, ai video, ai voice clone, video conference, deceased father, deceased mother, passed away, dead loved one, ai avatar, deceased grandmother, deceased grandfather, deceased uncle, bring back the dead, video generator, deceased, passed away, RIP, mourning your loved ones, new way to mournAI video generator
    Virtual memories, Loved ones remembrance,Custom video creation,voice-over video creation,Text-to-video technology,Virtual connection,Personalized video creation,AI-powered memories,macOS compatibility,Intuitive design,Virtual presence,Emotional video creation,Legacy preservation,Photo and audio integration,Video tribute,Remembering loved ones,AI-powered storytelling,         Digital legacy,Emotional connection">
   <link rel="icon" href="include/images/favicon.png" sizes="32x32" />
	<link rel="apple-touch-icon" sizes="180x180" href="include/images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="include/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="include/images/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">  
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&display=swap" rel="stylesheet">
    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="include/css/bootstrap.min.css" type="text/css">
    <!-- Swiper Css -->
    <link rel="stylesheet" href="include/css/swiper-bundle.min.css" type="text/css">
    <!-- Write your Css here -->
    <link href="include/css/style.css" rel="stylesheet" type="text/css">
    <!-- Script for Font Awesome icons-->
    <script src="https://kit.fontawesome.com/db98e7ed59.js" crossorigin="anonymous" defer></script>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-TXT7LQTZDV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-TXT7LQTZDV');
</script>
    <style>
        #g-recaptcha-response {
  display: block !important;
  position: absolute;
  margin: -78px 0 0 0 !important;
  width: 302px !important;
  height: 76px !important;
  z-index: -999999;
  opacity: 0;
}
    </style>
</head>
<body>
<!-- ============================ HEADER START ============================== -->
<header id="header">
    <nav class="navbar navbar-expand-xl">
        <div class="container">
            <div class="nav-inside d-flex align-items-center justify-content-between">
                <a class="navbar-brand" href="index.html"><img src="include/images/logo.png" alt=""></a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="mainNav">
                    <div class="navbar-inside">
                        <ul class="navbar-nav me-xl-5">
                            <li class="nav-item"><a class="nav-link" href="how-it-works.html">How it works</a></li>
                            <li class="nav-item"><a class="nav-link" href="company.html">Company</a></li>
                            <li class="nav-item"><a class="nav-link" href="download.html">Download</a></li>
                            <li class="nav-item"><a class="nav-link" href="support.html">Support</a></li> 
                        </ul>
                    </div>
                </div> 
            </div>
        </div>
    </nav>
</header>
<!-- ============================ HEADER END ============================== -->
<div id="smooth-wrapper">
    <div id="smooth-content">

           <!-- ============================ Hero Start ============================ -->
           <div class="inner-hero-container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 d-flex align-items-center">
                        <div class="inner-hero-text animate-child">
                            <h2 class="mb-0">Delete Me</h2>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <!-- ============================ Hero End ============================ -->
       
        <!-- ============================ Content Start ============================ -->
        <div class="content-container pb-0">
            <div class="container">
                <div class="row animate-child">
                    
                <?php if(isset($_GET['verify_otp'])) { ?>
                    
                    <div class="col-lg-6 offset-lg-1">
                        <div class="form-container">
                            <h4 class="mb-2">Verify</h4>
                            <p>Please enter your Code</p>
                            <form class="needs-validation" action="" method="POST" id="delete-me-form">
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" name="code" id="code" placeholder="Code" required>
                                <label for="code">Code</label>
                                <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $_GET['user_id'];?>">

                            </div>
                           
                            <div class="col">
                                <button class="btn btn-primary" type="submit" name="submit_otp">Submit <em class="btn-arrow"></em></button>
                            </div>
                        </form>
                        </div>
                    </div>

                <?php } else { ?>

                    <div class="col-lg-6 offset-lg-1">
                        <div class="form-container">
                            <h4 class="mb-2">Verify</h4>
                            <p>Please enter your email address</p>
                            <form class="needs-validation" action="" method="POST" id="delete-me-form">
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" name="email_phone" id="email_phone" placeholder="Email Address or Phone Number" required>
                                <label for="email_phone">Email Address or Phone Number</label>
                            </div>
                            <div class="form-floating mb-4 d-none">
                                <input type="text" class="form-control" name="code" id="code" placeholder="Code">
                                <label for="code">Code</label>
                            </div>
                            <div class="form-floating mb-4">
                                <div class="g-recaptcha" data-sitekey="6Lf7Av4mAAAAAGajliGIrRp7PoruHgZ8Qg7ZCkvO"></div>
                             </div> 
                            <div class="col">
                                <button class="btn btn-primary" type="submit" name="submit">Submit <em class="btn-arrow"></em></button>
                            </div>
                        </form>
                        </div>
                    </div>
                <?php }?>
                </div>
            </div>
        </div>
        <!-- ============================ Content End ============================ -->
       

        <!-- ============================ CTA Start ============================ -->
          <div class="content-container cta-container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 animate-child">
                        <div class="cta-content d-flex justify-content-center align-items-center flex-column">
                            <h3>Get the App</h3>
                            <div class="download-cta d-flex align-items-center flex-wrap">
                                <a href="https://play.google.com/store/apps/details?id=com.elnova.lovedones&pcampaignid=web_share" target="_blank"><img src="include/images/google-play.png" alt=""></a>
                                <a href="https://apps.apple.com/in/app/lovedones-ai/id6477915352" target="_blank"><img src="include/images/app-store.png" alt=""></a>
                            </div> 
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <!-- ============================ CTA End ============================ -->
       
        <!-- ============================ Footer Start ============================ -->
        <footer id="footer" class="d-flex flex-column">
            <div class="footer-bottom mt-auto">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer-bottom-upper d-md-flex justify-content-md-center align-items-md-center">
                                <ul class="footer-nav d-flex flex-wrap">
                                    <li class="mx-3"><a href="how-it-works.html">How it works</a></li>
                                    <li class="mx-3"><a href="company.html">Company</a></li>
                                    <li class="mx-3"><a href="download.html">Download</a></li> 
                                    <li class="mx-3"><a href="support.html">Support</a></li>  
                                    <li class="mx-3"><a href="privacy-policy.html">Privacy Policy</a></li>
                                    <li class="mx-3"><a href="terms-conditions.html">Terms &amp; Conditions</a></li>                            
                                </ul> 
                            </div>
                            <div class="footer-bottom-lower d-md-flex justify-content-md-center align-items-md-center">
                                <a href="index.html" class="footer-logo"><img src="include/images/logo-white.png" alt="LovedOnes.ai appliction"></a>

                                <div class="copyright">&copy; All rights reserved.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- ============================ Footer End ============================ -->
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!--  Bootstrap Js  -->
    <script src="include/js/bootstrap.bundle.min.js"></script>
    <!--  Tilt Js  -->
    <script src="include/js/vanilla-tilt.min.js"></script>
    <!-- Swiper JS -->
    <script src="include/js/swiper-bundle.min.js"></script>
    <!--  GSAP libraries here -->
    <script src="include/js/gsap.min.js"></script>
    <!--  Write you Js here -->
    <script src="include/js/custom.js"></script>
    <script>
        window.onload = function() {
        var $recaptcha = document.querySelector('#g-recaptcha-response');
        
        if($recaptcha) {
        $recaptcha.setAttribute("required", "required");
        }
        };
        </script>
</body>
</html>
