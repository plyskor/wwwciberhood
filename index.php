<?php
if(!empty($_POST['email'])){
$para      = 'contacto@ciberhood.com';
$titulo    = '[PETICIÓN] Cliente página web.        '.'Nombre: '.$_POST['name'];
$mensaje   = $_POST['message']."\r\n".'El correo del cliente es: '.$_POST['email'];
$cabeceras = 'From: webmaster @ciberhood.com'."\r\n".'X-Mailer: PHP/'.phpversion();

mail($para, $titulo, $mensaje, $cabeceras);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>CiberHood, tu tienda de servicios digitales en Lavapiés</title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/et-line-font.css">
	<link rel="stylesheet" href="css/nivo-lightbox.css">
	<link rel="stylesheet" href="css/nivo_themes/default/default.css">
	<link rel="stylesheet" href="css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500' rel='stylesheet' type='text/css'>
</head>
<body data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

<!-- preloader section -->
<div class="preloader">
	<div class="sk-spinner sk-spinner-circle">
       <div class="sk-circle1 sk-circle"></div>
       <div class="sk-circle2 sk-circle"></div>
       <div class="sk-circle3 sk-circle"></div>
       <div class="sk-circle4 sk-circle"></div>
       <div class="sk-circle5 sk-circle"></div>
       <div class="sk-circle6 sk-circle"></div>
       <div class="sk-circle7 sk-circle"></div>
       <div class="sk-circle8 sk-circle"></div>
       <div class="sk-circle9 sk-circle"></div>
       <div class="sk-circle10 sk-circle"></div>
       <div class="sk-circle11 sk-circle"></div>
       <div class="sk-circle12 sk-circle"></div>
    </div>
</div>

<!-- navigation section -->
<section class="navbar navbar-fixed-top custom-navbar" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
			</button>
			<a href="#" class="navbar-brand">CiberHood</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#inicio" class="smoothScroll">INICIO</a></li>
				<li><a href="#wedo" class="smoothScroll">TRABAJOS</a></li>
				<li><a href="#tienda" class="smoothScroll">TIENDA</a></li>
				<li><a href="#equipo" class="smoothScroll">EQUIPO</a></li>
				<li><a href="#portfolio" class="smoothScroll">PORTFOLIO</a></li>
				<li><a href="#pricing" class="smoothScroll">PRECIOS</a></li>
				<li><a href="#contact" class="smoothScroll">CONTACTO</a></li>
			</ul>
		</div>
	</div>
</section>

<!-- home section -->
<section id="inicio">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
                                <h1>CiberHood</h1>
				<h3>Tu tienda de servicios digitales en el corazón de Madrid</h3>
				<hr>
				<a href="#wedo" class="smoothScroll btn btn-danger">¿Qué hacemos?</a>
				<a href="#contact" class="smoothScroll btn btn-default">Contáctenos</a>
			</div>
		</div>
	</div>		
</section>

<!-- work section -->
<section id="wedo">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="section-title">
					<strong>01</strong>
					<h1 class="heading bold">¿QUÉ HACEMOS?</h1>
					<hr>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s">
				<i class="icon-cloud medium-icon"></i>
					<h3>SERVICIOS DE RED PARA PYMES</h3>
					<hr>
					<p>Puesta a punto de servidores web, servidores de correo, servidores de mensajería, almacenamiento...</p>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.9s">
				<i class="icon-mobile medium-icon"></i>
					<h3>DISEÑO &amp; DESARROLLO WEB Y DE APLICACIONES</h3>
					<hr>
					<p>Diseñamos y desarrollamos tu sitio web y tus aplicaciones para diversas plataformas.</p>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="1s">
				<i class="icon-laptop medium-icon"></i>
					<h3>CLÍNICA DIGITAL</h3>
					<hr>
					<p>Diagnóstico, presupuestado y reparación de dispositivos y entornos tanto en nuestras instalaciones como a domicilio</p>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="1s">
				<i class="icon-compass medium-icon"></i>
					<h3>SERVICIOS WEB</h3>
					<hr>
					<p>¿Necesitas crear un negocio online? ¿Quizás una campaña de crowfunding? ¿Y de marketing online? Déjanos ayudarte con los preparativos.</p>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="1s">
				<i class="icon-chat medium-icon"></i>
					<h3>ASESORAMIENTO INFORMÁTICO PARA PYMES Y PARTICULARES</h3>
					<hr>
					<p>¿Necesitas consejo sobre cómo sacar más partido a las tecnologías con las que te enfrentas cada día? Te ayudamos a comprender mejor lo que necesitas y cómo utilizarlo.</p>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="1s">
				<i class="icon-browser medium-icon"></i>
					<h3>GESTIONES ON-LINE</h3>
					<hr>
					<p>Contacta con nosotros en la web y nos pondremos en contacto contigo sin necesitar que nos visites. Comprueba on-line el estado de tu pedido.</p>
			</div>
		</div>
	</div>
</section>

<!-- about section -->
<section id="tienda">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 text-center">
				<div class="section-title">
					<strong>02</strong>
					<h1 class="heading bold">NUESTRAS INSTALACIONES</h1>
					<hr>
				</div>
			</div>
			<div class="col-md-6 col-sm-12">
				<img src="images/about-img.jpg" class="img-responsive" alt="about img">
			</div>
			<div class="col-md-6 col-sm-12">
				<h3 class="bold">CiberHood</h3>
				<h1 class="heading bold">En Tirso de Molina, a tan sólo 5 minutos de la Puerta del Sol</h1>
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="active"><a href="#comercio" aria-controls="comercio" role="tab" data-toggle="tab">COMERCIO</a></li>
					<li><a href="#locutorio" aria-controls="locutorio" role="tab" data-toggle="tab">LOCUTORIO</a></li>
					<li><a href="#hospital" aria-controls="hosptal" role="tab" data-toggle="tab">REPARACIONES</a></li>
				</ul>
				<!-- tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="comercio">
						<p>Venta de componentes informáticos (Hardware & Software) en nuestra tienda. Serás atendido y asesorado en las mejores condiciones por nuestros trabajadores y trabajadoras.</p>
						<p></p>
					</div>
					<div role="tabpanel" class="tab-pane" id="locutorio">
						<p>También puedes visitarnos para hacer tus recargas de telefonía prepago y para hacer tus envíos de dinero al extranjero (para esto último se requiere identificaión).</p>
						<p>Además podrás utilizar nuestra red en local para todo tipo de usos (navegación, mensajería, transferencias de archivos, juegos on-line...)</p>
					</div>
					<div role="tabpanel" class="tab-pane" id="hospital">
						<p>Trae los dispositvos que te estén dando problemas y nosotros los diagnosticaremos y repararemos lo antes posible a un precio competente.</p>
						<p>Pide cita on-line con uno de nuestros ingenieros, tanto para encontraros en nuestra tienda como también a domicilio.</p>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>

<!-- team section -->
<section id="equipo">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="section-title">
					<strong>03</strong>
					<h1 class="heading bold">NUESTRO EQUIPO</h1>
					<hr>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 wow fadeIn" data-wow-delay="0.9s">
				<div class="team-wrapper">
					<img src="images/team1.png" class="img-responsive" alt="team img">
						<div class="team-des">
							<h4>Eliana María</h4>
							<h3>Atención al cliente</h3>
							<hr>
							<ul class="social-icon">
								<li><a href="#" class="fa fa-facebook wow fadeIn" data-wow-delay="0.3s"></a></li>
								<li><a href="#" class="fa fa-twitter wow fadeIn" data-wow-delay="0.6s"></a></li>
								<li><a href="#" class="fa fa-dribbble wow fadeIn" data-wow-delay="0.9s"></a></li>
							</ul>
						</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 wow fadeIn" data-wow-delay="1.3s">
				<div class="team-wrapper">
					<img src="images/team2.png" class="img-responsive" alt="team img">
						<div class="team-des">
							<h4>Jose Antonio García</h4>
							<h3>Ingeniero Informático</h3>
							<hr>
							<ul class="social-icon">
								<li><a href="#" class="fa fa-facebook wow fadeIn" data-wow-delay="0.3s"></a></li>
								<li><a href="#" class="fa fa-twitter wow fadeIn" data-wow-delay="0.6s"></a></li>
								<li><a href="#" class="fa fa-dribbble wow fadeIn" data-wow-delay="0.9s"></a></li>
							</ul>
						</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 wow fadeIn" data-wow-delay="1.6s">
				<div class="team-wrapper">
					<img src="images/team3.png" class="img-responsive" alt="team img">
						<div class="team-des">
							<h4>Makhtar Diop</h4>
							<h3>Administración</h3>
							<hr>
							<ul class="social-icon">
								<li><a href="#" class="fa fa-facebook wow fadeIn" data-wow-delay="0.3s"></a></li>
								<li><a href="#" class="fa fa-twitter wow fadeIn" data-wow-delay="0.6s"></a></li>
								<li><a href="#" class="fa fa-dribbble wow fadeIn" data-wow-delay="0.9s"></a></li>
							</ul>
						</div>
				</div>
			</div>
			<!--<div class="col-md-3 col-sm-6 wow fadeIn" data-wow-delay="1.6s">
				<div class="team-wrapper">
					<img src="images/team4.jpg" class="img-responsive" alt="team img">
						<div class="team-des">
							<h4>Sandar</h4>
							<h3>Accountant</h3>
							<hr>
							<ul class="social-icon">
								<li><a href="#" class="fa fa-facebook wow fadeIn" data-wow-delay="0.3s"></a></li>
								<li><a href="#" class="fa fa-twitter wow fadeIn" data-wow-delay="0.6s"></a></li>
								<li><a href="#" class="fa fa-dribbble wow fadeIn" data-wow-delay="0.9s"></a></li>
							</ul>
						</div>
				</div>
			</div>-->
		</div>
	</div>
</section>

<!-- portfolio section -->
<div id="portfolio">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="section-title">
					<strong>04</strong>
					<h1 class="heading bold">NUESTRO PORTFOLIO</h1>
					<hr>
				</div>
				<!-- ISO section -->
				<div class="iso-section">
					<ul class="filter-wrapper clearfix">
                   		 <li><a href="#" data-filter="*" class="selected opc-main-bg">Todo</a></li>
                   		 <li><a href="#" class="opc-main-bg" data-filter=".html">HTML</a></li>
                   		 <li><a href="#" class="opc-main-bg" data-filter=".photoshop">Photoshop</a></li>
                    	 <li><a href="#" class="opc-main-bg" data-filter=".wordpress">Wordpress</a></li>
                    	 <li><a href="#" class="opc-main-bg" data-filter=".mobile">Mobile</a></li>
               		</ul>
               		<div class="iso-box-section wow fadeIn" data-wow-delay="0.9s">
               			<div class="iso-box-wrapper col4-iso-box">

               				 <div class="iso-box html wordpress mobile col-lg-4 col-md-4 col-sm-6">
               				 	<a href="images/portfolio-img1.jpg" data-lightbox-gallery="portfolio-gallery"><img src="images/portfolio-img1.jpg" alt="portfolio img"></a>
               				 </div>

               				 <div class="iso-box wordpress col-lg-4 col-md-4 col-sm-6">
               				 	<a href="images/portfolio-img2.jpg" data-lightbox-gallery="portfolio-gallery"><img src="images/portfolio-img2.jpg" alt="portfolio img"></a>
               				 </div>

               				 <div class="iso-box html mobile col-lg-4 col-md-4 col-sm-6">
               				 	<a href="images/portfolio-img3.jpg" data-lightbox-gallery="portfolio-gallery"><img src="images/portfolio-img3.jpg" alt="portfolio img"></a>
               				 </div>

               				 <div class="iso-box wordpress col-lg-4 col-md-4 col-sm-6">
               				 	<a href="images/portfolio-img4.jpg" data-lightbox-gallery="portfolio-gallery"><img src="images/portfolio-img4.jpg" alt="portfolio img"></a>
               				 </div>

               				 <div class="iso-box html photoshop col-lg-4 col-md-4 col-sm-6">
               				 	<a href="images/portfolio-img5.jpg" data-lightbox-gallery="portfolio-gallery"><img src="images/portfolio-img5.jpg" alt="portfolio img"></a>
               				 </div>

               				 <div class="iso-box photoshop col-lg-4 col-md-4 col-sm-6">
               				 	<a href="images/portfolio-img6.jpg" data-lightbox-gallery="portfolio-gallery"><img src="images/portfolio-img6.jpg" alt="portfolio img"></a>
               				 </div>

               			</div>
               		</div>

				</div>
			</div>
		</div>
	</div>
</div>		

<!-- pricing section -->
<section id="pricing">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 text-center">
				<div class="section-title">
					<strong>05</strong>
					<h1 class="heading bold">Nuestros Precios</h1>
					<hr>
				</div>
			</div>
			<div class="col-md-4 col-sm-6">
				<div class="plan plan-one wow bounceIn" data-wow-delay="0.3s">
					<div class="plan_title">
						<i class="icon-mobile medium-icon"></i>
						<h3>BASIC</h3>
						<h2>150€ <span>/año</span></h2>
					</div>
					<ul>
                    	<li>100 GB Cloud Storage</li>
						<li>5 Pro Websites</li>
						<li>10 Secured Emails</li>
                        <li>24-hour Support</li>
					</ul>
					<button class="btn btn-warning">Comprar</button>
				</div>
			</div>
			<div class="col-md-4 col-sm-6">
				<div class="plan plan-two wow bounceIn" data-wow-delay="0.3s">
					<div class="plan_title">
						<i class="icon-desktop medium-icon"></i>
						<h3>BUSINESS</h3>
						<h2>260€ <span>/año</span></h2>
					</div>
					<ul>
						<li>200 GB Cloud Storage</li>
						<li>10 Pro Websites</li>
						<li>20 Secured Emails</li>
                        <li>30-Minute Support</li>
					</ul>
					<button class="btn btn-warning">Comprar</button>
				</div>
			</div>
			<div class="col-md-4 col-sm-6">
				<div class="plan plan-three wow bounceIn" data-wow-delay="0.3s">
					<div class="plan_title">
						<i class="icon-cloud medium-icon"></i>
						<h3>PROFESSIONAL</h3>
						<h2>380€ <span>/año</span></h2>
					</div>
					<ul>
						<li>500 GB Cloud Storage</li>
						<li>20 Pro Websites</li>
						<li>40 Secured Emails</li>
                        <li>Live Support</li>
					</ul>
					<button class="btn btn-warning">Comprar</button>
				</div>
			</div>
		</div>
	</div>		
</section>

<!-- contact section -->
<section id="contact">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 text-center">
				<div class="section-title">
					<strong>06</strong>
					<h1 class="heading bold">CONTÁCTANOS</h1>
					<hr>
				</div>
			</div>
			<div class="col-md-6 col-sm-12 contact-info">
				<h2 class="heading bold">INFORMACIÓN DE CONTACTO</h2>
				<p>CiberHood Lavapiés </p>
                                <p>Calle Amparo Nº8, 28012</p>
                                <p>MADRID</p>
                                <p>Metro: Tirso de Molina (L1), Lavapiés (L3)</p>
				<div class="col-md-6 col-sm-4">
					<h3><i class="icon-envelope medium-icon wow bounceIn" data-wow-delay="0.6s"></i> EMAIL</h3>
					<p>info@ciberhood.com</p>
				</div>
				<div class="col-md-6 col-sm-4">
					<h3><i class="icon-phone medium-icon wow bounceIn" data-wow-delay="0.6s"></i> TELÉFONOS</h3>
					<p>(+34) 91 XXX XXXXX</p><p>(+34) 6XX XXX XXX</p>
				</div>
			</div>
			<div class="col-md-6 col-sm-12">
				<form action="#" method="post" class="wow fadeInUp" data-wow-delay="0.6s">
					<div class="col-md-6 col-sm-6">
						<input type="text" class="form-control" placeholder="Nombre" name="name">
					</div>
					<div class="col-md-6 col-sm-6">
						<input type="email" class="form-control" placeholder="E-mail" name="email">
					</div>
					<div class="col-md-12 col-sm-12">
						<textarea class="form-control" placeholder="Mensaje" rows="7" name="message"></textarea>
					</div>
					<div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8">
						<input type="submit" class="form-control" value="SEND MESSAGE">
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<!-- footer section -->
<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<p>Copyright © CiberHood</p>
				<hr>
				<ul class="social-icon">
					<li><a href="#" class="fa fa-facebook wow fadeIn" data-wow-delay="0.3s"></a></li>
					<li><a href="#" class="fa fa-twitter wow fadeIn" data-wow-delay="0.6s"></a></li>
					<li><a href="#" class="fa fa-dribbble wow fadeIn" data-wow-delay="0.9s"></a></li>
					<li><a href="#" class="fa fa-behance wow fadeIn" data-wow-delay="0.9s"></a></li>
					<li><a href="#" class="fa fa-tumblr wow fadeIn" data-wow-delay="0.9s"></a></li>
				</ul>
			</div>
		</div>
	</div>
</footer>


<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/isotope.js"></script>
<script src="js/imagesloaded.min.js"></script>
<script src="js/nivo-lightbox.min.js"></script>
<script src="js/jquery.backstretch.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>