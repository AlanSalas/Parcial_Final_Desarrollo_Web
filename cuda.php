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
    <link rel="stylesheet" href="css/estilos.css">
    <!--Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!--MOBILE VIEW-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!--FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,400italic,600,700' rel='stylesheet'
        type='text/css'>
    <!--JS-->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.js"></script>
    <script src="js/classyloader.js"></script>
    <title>Cuda</title>
</head>

<body>

    <!--MENÚ-->

    <div id="div1">
        <header>
            <div id="logo">
                <img src="img/logo.png">
            </div>

            <div id="menu">
                <ul>
                    <li>HOME</li>
                    <li>ABOUT</li>
                    <li>WORK</li>
                    <li>BOLG</li>
                    <li>CONTACT</li>
                </ul>
            </div>
        </header>
        <!-- Texto que esta en el medio -->
        <div id="div1-1">
            <h1>Hi there! We are rhe new kids on the block <br> and bluid awesome websites and mobile apps.</h1>

            <!-- Botón naranjado -->
            <p>WORK WITH US!</p>
        </div>
    </div>

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

    <div id="div2">
        <div id="div2-1">
            <!-- Texto GIGANTE esta en el medio -->
            <h1>MEET OUR BEAUTIFUL TEAM
                <hr>
            </h1>
                     
            <!-- Texto que esta en el medio -->
            <p>We are a small team of designers and developers, who help brands with big ideas.</p>

        </div>
        <!-- Integrantes con sus puestos de trabajos y caracteristicas -->
        <div id="div2-2">
            <ul>
                <!-- Integrante -->

                <li><img src="img/team.png"></li>
                <li>
                    <h3>ANNE HATHWAY</h3>
                </li>
                <li>
                    <h4>CEO / Marketing Guru</h4>
                </li>
                <li>Lurem ipsum dolor sit amet,<br>consectetuer adipiscing eit,<br>sed diam nonummy nibh <br>euismod
                    tincidunt ut laoreet<br>dolore magna.</li>
                <ul class="iconos">
                    <!-- Redes sociales -->
                    <li><img src="img/facebook.png"></li>
                    <li><img src="img/twitter.png"></li>
                    <li><img src="img/linkedin.png"></li>
                    <li><img src="img/correo.png"></li>
                </ul>
            </ul>

            <ul>
                <!-- Integrante -->

                <li><img src="img/team.png"></li>
                <li>
                    <h3>KATE UPTON</h3>
                </li>
                <li>
                    <h4>Creative Director</h4>
                </li>
                <li>Duis aute irure dolor in in <br>voluptate velit esse cillum<br>dolor fugiat nulla
                    pariatur.<br>Excepteur sint occaecat non<br>diam proident.</li>

                <ul class="iconos">
                    <!-- Redes sociales -->
                    <li><img src="img/twitter.png"></li>
                    <li><img src="img/linkedin.png"></li>
                    <li><img src="img/correo.png"></li>
                </ul>
            </ul>

            <ul>
                <!-- Integrante -->

                <li><img src="img/team.png"></li>
                <li>
                    <h3>OLIVIA WILDE</h3>
                </li>
                <li>
                    <h4>Lead Designer</h4>
                </li>
                <li>Nemo enim ipsam voluptas<br>sit aspernatur aut odit aut<br>fugit, sed quia consequuntur<br>magni
                    dolores eos qui ratione<br>voluptatem nesciunt.</li>

                <ul class="iconos">
                    <!-- Redes sociales -->
                    <li><img src="img/facebook.png"></li>
                    <li><img src="img/twitter.png"></li>
                    <li><img src="img/correo.png"></li>

                </ul>
            </ul>

            <ul>
                <!-- Integrante -->

                <li><img src="img/team.png"></li>
                <li>
                    <h3>ASHLEY GREENE</h3>
                </li>
                <li>
                    <h4>SEO / Developer</h4>
                </li>
                <li>Sed ut perspiciatis unde<br>omnis iste natus error sit<br>voluptatem accusantium,<br>doloremque
                    laudantium<br>totam rem aperiam.</li>

                <ul class="iconos">
                    <!-- Redes sociales -->
                    <li><img src="img/facebook.png"></li>
                    <li><img src="img/twitter.png"></li>
                    <li><img src="img/linkedin.png"></li>
                    <li><img src="img/correo.png"></li>


                </ul>
            </ul>

        </div>

    </div>



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
    <?php
    global $mysqli;
    $sql = "SELECT titulo_us, subtitulo_us FROM about LIMIT 1";
    $rsl = $mysqli->query($sql);  
    while ($fila = mysqli_fetch_array($rsl)) {
    ?>
    <section class="wrapper" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2><?php echo $fila["titulo_us"];?></h2>
                    <div class="bottomline"></div>
                    <p><?php echo $fila["subtitulo_us"];?></p>
                    <?php } ?>
                </div>
            </div>
           <div class="row">
            <?php
                global $mysqli;
                $sql = "SELECT descrip_us, nombre_us, cargo_us, img_us FROM about LIMIT 4";
                $rsl = $mysqli->query($sql);  
                while ($fila = mysqli_fetch_array($rsl)) {
            ?>
               <div class="col-lg-6 col-md-6 col-sm-6">
                 <div>
                        <div class="testimage">
                            <img src="<?php echo $fila["img_us"];?>" alt="">
                        </div>
                   <div class="righttest">
                            <blockquote>
                               <?php echo $fila["descrip_us"];?>
                            </blockquote>
                            <span><?php echo $fila["nombre_us"];?></span>
                            <span class="smalltest"><?php echo $fila["cargo_us"];?></span>
                     </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    </section>

    <!--Contacto-->
    <section class="wrapper" id="contacto">
        <div class="container">
            <!--El encabezado dela parte de abajo-->
           <?php
    global $mysqli;
    $sql = "SELECT titulo, subtitulo FROM contacto LIMIT 1";
    $rsl = $mysqli->query($sql);  
    while ($fila = mysqli_fetch_array($rsl)) {
    ?>
    <section class="wrapper" id="contacto">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2><?php echo $fila["titulo"];?></h2>
                    <div class="bottomline"></div>
                    <p><?php echo $fila["subtitulo"];?></p>
                    <?php } ?>
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
    <script src="js/fastclick.js"></script>
    <script src="js/scroll.js"></script>
    <script src="js/fixed-responsive-nav.js"></script>

</body>

</html>
