<?php
    require_once("includes/con_db.php");    
?>
<!DOCTYPE html>
<html lang="mx">

<head>
    <meta charset="UTF-8">
    <!--BOOTSTRAP CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!--ESTILOS-->
    <link rel="stylesheet" href="css/estilos_2.css">
    <!--Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!--MOBILE VIEW-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!--FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,400italic,600,700' rel='stylesheet'
        type='text/css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!--JS-->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.js"></script>
    <script src="js/classyloader.js"></script>
    <title>Cuda</title>
</head>

<body>

    <!--MENÚ-->

    <header class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <img src="img/logo.png" alt="Logotipo " class="img-responsive" id="logotipo">   
            </div>
            <div id="button-movil">
                <i class="fas fa-align-justify"></i>
            </div>
            <nav class="col-lg-7 offset-lg-2 menu-header-principal">
                <div id="menu">
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="#">HOME</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">SERVICES</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">TEAM</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">SKILLS</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">PORTFOLIO</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">CONTACT</a></li>
                </ul>
            </nav>
            <nav class="col-lg-7 offset-lg-2 menu-header-movil">
                <div id="close-movil">
                    <i class="fas fa-times"></i>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="#">HOME</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">SERVICES</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">TEAM</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">SKILLS</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">PORTFOLIO</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">CONTACT</a></li>
                </ul>
            </nav>
        </div>

        <section>
        <div class="container" id="download">
             <div  class="download" align="center">
            <div class="col-md-8 col-md-offset-2 text-center">
    <?php
    global $mysqli;
    $sql = "SELECT header_title, header_link FROM header LIMIT 1";
    $rsl = $mysqli->query($sql);  
    while ($fila = mysqli_fetch_array($rsl)) {
    ?>  
                <h1><?php echo $fila["header_title"];?></h1>
            <p><?php echo $fila["header_link"];?></p>
    <?php } ?>
            </div>
        </div>
        </div>
    </section>

    </header>

    <!--SERVICES-->
    <?php
    global $mysqli;
    $sql = "SELECT titulo, subtitulo FROM services LIMIT 1";
    $rsl = $mysqli->query($sql);  
    while ($fila = mysqli_fetch_array($rsl)) {
    ?>
    <section class="wrapper" id="service">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2><?php echo $fila["titulo"];?></h2>
                    <div class="bottomline"></div>
                    <p><?php echo $fila["subtitulo"];?></p>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
            <?php
                global $mysqli;
                $sql = "SELECT service, service_desc, img_service FROM services LIMIT 4";
                $rsl = $mysqli->query($sql);  
                while ($fila = mysqli_fetch_array($rsl)) {
            ?>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <figure>
                        <div class="imageheight">
                            <img src="<?php echo $fila["img_service"];?>" alt=".">
                        </div>
                        <figcaption>
                            <h3><?php echo $fila["service"];?></h3>
                            <p><?php echo $fila["service_desc"];?></p>
                        </figcaption>
                    </figure>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>


    <!-- TEAM -->
<section class="wrapper" id="team">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h2>MEET OUR BEAUTIFUL TEAM</h2>
                <div class="bottomline"></div>
                <p">We are a small team of designers and developers, who help brands with big ideas.</p>         
            </div>
        </div>
        
        <div class="row">
    <?php
    global $mysqli;
    $sql = "SELECT team_img, team_name, team_position, team_description FROM team LIMIT 4";
    $rsl = $mysqli->query($sql);  
    while ($fila = mysqli_fetch_array($rsl)) {
    ?>
        <div class="col-lg-3 col-md-3 col-sm-3">
            <figure>
                <img src="<?php echo $fila["team_img"];?>" alt="image">          
                <figcaption>
                    <h4><?php echo $fila["team_name"];?></h4>
                    <span><?php echo $fila["team_position"];?></span>
                    <p><?php echo $fila["team_description"];?></p>
                    
                    <div class="social">
                    <a href="#"><img src="img/facebook.png"></a>
                    <a href="#"><img src="img/twitter.png"></a>
                    <a href="#"><img src="img/linkedin.png"></a>
                    <a href="#"><img src="img/correo.png"></a>
                    </div>
               </figcaption>
            </figure>
         </div>
        <?php }?>          
        </div>
    </div>
</section>
    <!--SKILL-->
    <?php
    global $mysqli;
    $sql = "SELECT titulo, subtitulo FROM skills LIMIT 1";
    $rsl = $mysqli->query($sql);  
    while ($fila = mysqli_fetch_array($rsl)) {
    ?>
    <section class="wrapper" id="skill">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2><?php echo $fila["titulo"];?></h2>
                    <div class="bottomline"></div>
                    <p><?php echo $fila["subtitulo"];?></p>
                </div>
            </div>
    <?php }?>
            <div class="row">
                <!--Loader-->
                <?php
                global $mysqli;
                $sql = "SELECT skill, skill_percentage, loader, color FROM skills LIMIT 4";
                $rsl = $mysqli->query($sql);  
                while ($fila = mysqli_fetch_array($rsl)) {
                ?>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div>
                        <div class="clearfix">
                            <canvas class="<?php echo $fila["loader"];?>"></canvas>
                            <script>
                                $(document).ready(function () {
                                    $('.<?php echo $fila["loader"];?>').ClassyLoader({
                                        percentage: <?php echo $fila["skill_percentage"];?>,
                                        speed: 20,
                                        fontSize: '40px',
                                        diameter: 80,
                                        lineColor: '<?php echo $fila["color"];?>',
                                        remainingLineColor: 'rgba(223,232,237,0.4)',
                                        lineWidth: 12
                                    });
                                });
                            </script>

                        </div>
                        <span><?php echo $fila["skill"];?></span>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </section>

    <!--Portafolio-->


    <section class="wrapper" id="portafolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2 class=>OUR PORTFOLIO</h2>
                    <div class="bottomline"></div>
                    <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet consectetur, adipisci velit, sed
                        quia non numquam</p>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.9s">
                        <ul id="portafolio-filter">
                            <li><a href="#all" title="">All</a></li>
                            <li><a href="#web" title="" rel="web">WEB</a></li>
                            <li><a href="#apps" title="" rel="apps">APPS</a></li>
                            <li><a href="#icons" title="" rel="icons">ICONS</a></li>
                        </ul>

                        <ul id="portafolio-lista" class="clearfix">
                            <li style="display: block;" class="web icons">
                                <a href="#"><img src="img/port1.png" alt=""></a>
                                <p>
                                    Isometric Perspective Mock-Up
                                </p>
                            </li>
                            <li style="display: block;" class="apps">
                                <a href="#"><img src="img/port2.png" alt=""></a>
                                <p>
                                    Time Zone App UI
                                </p>
                            </li>
                            <li class="apps icons">
                                <a href="#"><img src="img/port3.png" alt=""></a>
                                <p>
                                    Viro Media Players UI
                                </p>
                            </li>
                            <li class="web icons">
                                <a href="#" title=""><img src="img/port4.png" alt=""></a>
                                <p>
                                    Blog / Magazine Flat UI Kit
                                </p>
                            </li>


                            <li
                                style="overflow: hidden; clear: both; height: 0px; position: relative; float: none; display: block;">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <a class="os-animation btn1 btn-21 btn-2a1">
                        <font color="white">LOAD MORE PROJECT</font>
                    </a>

                </div>
            </div>
        </div>
    </section>



    <!--ABOUT US-->
    <section class="wrapper" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2>WHAT POEPLE SAY ABOUT US</h2>
                    <div class="bottomline"></div>
                    <p>Our clients love us!</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div>
                        <div class="testimage">
                            <img src="img/BlogB.png" alt="">
                        </div>
                        <div class="righttest">
                            <blockquote>
                                “Nullam dapibus blandit orci, viverra gravida dui lobortis eget. Maecenas fringilla urna
                                eu nisl scelerisque.”
                            </blockquote>
                            <span>Chanel Iman</span>
                            <span class="smalltest">CEO of Pinterest</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div>
                        <div class="testimage">
                            <img src="img/BlogB.png" alt="">
                        </div>
                        <div class="righttest">
                            <blockquote>
                                “Vivamus luctus urna sed urna ultricies ac tempor dui sagittis. In condimentum facilisis
                                porta.”
                            </blockquote>
                            <span>ADRIANA LIMA</span>
                            <span class="smalltest">Founder of Instagram</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div>
                        <div class="testimage">
                            <img src="img/BlogB.png" alt="">
                        </div>
                        <div class="righttest">
                            <blockquote>
                                “Vivamus luctus urna sed urna ultricies ac tempor dui sagittis. In condimentum facilisis
                                porta.”
                            </blockquote>
                            <span>ANNE HATHAWAY</span>
                            <span class="smalltest">Lead Designer at Behance</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div>
                        <div class="testimage">
                            <img src="img/BlogB.png" alt="">
                        </div>
                        <div class="righttest">
                            <blockquote>
                                “Phasellus non purus vel arcu tempor commodo. Fusce semper, purus vel luctus molestie,
                                risus sem cursus neque.”
                            </blockquote>
                            <span>EMMA STONE</span>
                            <span class="smalltest">Co-Founder of Shazam</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Contacto-->
    <section class="wrapper" id="contacto">
        <div class="container">
            <!--El encabezado dela parte de abajo-->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2>GET IN TOUCH</h2>
                    <div class="bottomline"></div>
                    <!--boton lineal-->
                    <p>1600 Pennsylvania Ave NW, Washington, DC 20500, United States of America. Tel: (202) 456-1111</p>
                </div>
            </div>
            <div class="spacing">
                <form>
                    <div class="nameemail">
                        <div class="name">
                            <input type="text" name="yourname" placeholder="Your Name*">
                        </div>
                        <div class="email">
                            <input type="email" name="youremail" placeholder="Your Email*">
                        </div>
                    </div>
                    <textarea placeholder="Your Message*"></textarea>
                    <!--<font color="red">*</font>-->
                    <a class="os-animation btn11 btn-211 btn-2a11">
                        <font color="white">SEND MESSAGE</font>
                    </a>
                </form>
            </div>
        </div>
    </section>

    <!--FOOTER---->
    <footer class="wrapper">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <ul>
                    <li><a>
                            <font color="white">Facebook</font>
                        </a></li>
                    <li><a>
                            <font color="white">Twitter</font>
                        </a></li>
                    <li><a>
                            <font color="white">Google+</font>
                        </a></li>
                    <li><a>
                            <font color="white">LinkedIn</font>
                        </a></li>
                    <li><a>
                            <font color="white">Behance</font>
                        </a></li>
                    <li><a>
                            <font color="white">Dribbble</font>
                        </a></li>
                    <li><a>
                            <font color="white">GitHub</font>
                        </a></li>
                </ul>
            </div>
        </div>
    </footer>
    <script>
        $("#button-movil").click(function(){
            $(".menu-header-movil").css("display","flex");
        });
        $("#close-movil").click(function(){
            $(".menu-header-movil").css("display","none");
        });
    </script>
</body>

</html>
