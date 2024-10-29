<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("con_db.php");	

$numeroLocomotor=1;
$numeroEspla=2;
$numeroNeuro=3;

$numero_recibido = $_GET['numero'];

if($numero_recibido!=1&&$numero_recibido!=2&&$numero_recibido!=3){
	header('Location: panel-inicial.php?id=' . $_SESSION['idUsuario']);
}

if($_SESSION['habilitado']!=1){
	header('Location: usuario-no-encontrado.php');
}
$idUsuario=$_SESSION['idUsuario'];
$stmt = $conex->prepare("SELECT email FROM usuarios WHERE IdUsuario=? AND last_time_connected > NOW() - INTERVAL 2 HOUR");
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$result = $stmt->get_result();
if (isset($_SESSION['loggedin'])&&isset($_SESSION['idUsuario']) && $_SESSION['loggedin'] === true && $result->num_rows > 0) {		
} else {
   	header("Location: index.php");
   	exit;
}

?>



<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic 
Product Version: 8.2.1
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head>
<base href="./" />
<title>Medicina y Anatomia</title>

	<link rel="icon" type="image/png" href="./images/logo-anato.png">
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - The World's #1 Selling Bootstrap Admin Template - Metronic by KeenThemes" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Metronic by Keenthemes" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="../src/media/pcalogo.png" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Vendor Stylesheets(used for this page only)-->
		<link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="page-bg-image-lg header-fixed header-tablet-and-mobile-fixed">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" class="header align-items-stretch mb-5 mb-lg-10" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
					<!--begin::Container-->
						<div class="container-xxl d-flex align-items-center">
							<!--begin::Heaeder menu toggle-->
							<div class="d-flex topbar align-items-center d-lg-none ms-n2 me-3" title="Show aside menu">
								<div class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px" id="kt_header_menu_mobile_toggle">
									<i class="ki-duotone ki-abstract-14 fs-1">
										<span class="path1"></span>
										<span class="path2"></span>
									</i>
								</div>
							</div>
							<!--end::Heaeder menu toggle-->
							<!--begin::Header Logo-->
							<div class="header-logo me-5 me-md-10 flex-grow-1 flex-lg-grow-0">
								<a href="panel-inicial.php?id=<?=$_SESSION['idUsuario']?>">
									<img alt="Logo" src="./images/logo-anato.png" class="logo-default h-35px" />
									<img alt="Logo" src="./images/logo-anato.png" class="logo-sticky h-35px" />
								</a>
							</div>
							<!--end::Header Logo-->
							<!--begin::Wrapper-->
							<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
							<!--begin::Navbar-->
								<div class="d-flex align-items-stretch" id="kt_header_nav">
									<!--begin::Menu wrapper-->
									<div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
										<!--begin::Menu-->
										<div class="menu menu-rounded menu-column menu-lg-row menu-active-bg menu-title-gray-700 menu-state-primary menu-arrow-gray-500 fw-semibold my-5 my-lg-0 align-items-stretch px-2 px-lg-0" id="#kt_header_menu" data-kt-menu="true">
										<?php
											switch($_SESSION['moduloPermitido']){
												case 1:
										?>
										<!--begin:Menu item-->
											<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
												<!--begin:Menu link-->
												<span class="menu-link py-3">
													<span class="menu-title"><?=$_SESSION['nombreCurso']?></span>
													<span class="menu-arrow d-lg-none"></span>
												</span>
												<!--end:Menu link-->
												<!--begin:Menu sub-->
												<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0 w-100 w-lg-850px">
													<!--begin:Dashboards menu-->
													<div class="menu-state-bg menu-extended overflow-hidden overflow-lg-visible" data-kt-menu-dismiss="true">
														<!--begin:Row-->
														<div class="row">
															<!--begin:Col-->
															<div class="col-lg-12 mb-3 mb-lg-0 py-3 px-3 py-lg-6 px-lg-6">
																<!--begin:Row-->
																<div class="row">
																<!--begin:Col-->
																	<div class="col-lg-6 mb-3">
																		<!--begin:Menu item-->
																		<div class="menu-item p-0 m-0">
																			<!--begin:Menu link-->
																			<a href="pantalla-cursos-clases.php?numero=<?=$numeroLocomotor?>" class="menu-link">
																				<span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
																					<img src="./images/locomotor-removebg-preview.png" width="40px" height="40px" alt="">
																				</span>
																				<span class="d-flex flex-column">
																					<span class="fs-6 fw-bold text-gray-800">Locomotor</span>
																					<span class="fs-7 fw-semibold text-muted">Huesos,  músculos, tendones y ligamentos</span>
																				</span>
																			</a>
																			<!--end:Menu link-->
																		</div>
																		<!--end:Menu item-->
																	</div>
																	<!--end:Col-->
																</div>
																<!--end:Row-->
																<?php
																if(strlen($_SESSION['linkWhatsapp'])!=0){
																	?>
																<div class="separator separator-dashed mx-5 my-5"></div>
																<!--begin:Landing-->
																<div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-2 mx-5">
																	<div class="d-flex flex-column me-5">
																		<div class="fs-6 fw-bold text-gray-800">Grupo de Whatsapp</div>
																	</div>
																	<a href="<?=$_SESSION['linkWhatsapp']?>" class="btn btn-sm btn-primary fw-bold" target="_blank">Unirme</a>
																</div>
																<!--end:Landing-->
																<?php
																}
																?>
																<?php
																if(strlen($_SESSION['linkDrive'])!=0){
																	?>
																<div class="separator separator-dashed mx-5 my-5"></div>
																<!--begin:Landing-->
																<div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-2 mx-5">
																	<div class="d-flex flex-column me-5">
																		<div class="fs-6 fw-bold text-gray-800">Drive</div>
																	</div>
																	<a href="<?=$_SESSION['linkDrive']?>" class="btn btn-sm btn-primary fw-bold" target="_blank">Unirme</a>
																</div>
																<!--end:Landing-->
																<?php
																}
																?>
																
															</div>
															<!--end:Col-->
														</div>
														<!--end:Row-->
													</div>
													<!--end:Dashboards menu-->
												</div>
												<!--end:Menu sub-->
											</div>
											<!--end:Menu item-->
											<?php
											break;
											case 2:
											?>
											<!--begin:Menu item-->
											<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
												<!--begin:Menu link-->
												<span class="menu-link py-3">
													<span class="menu-title"><?=$_SESSION['nombreCurso']?></span>
													<span class="menu-arrow d-lg-none"></span>
												</span>
												<!--end:Menu link-->
												<!--begin:Menu sub-->
												<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0 w-100 w-lg-850px">
													<!--begin:Dashboards menu-->
													<div class="menu-state-bg menu-extended overflow-hidden overflow-lg-visible" data-kt-menu-dismiss="true">
														<!--begin:Row-->
														<div class="row">
															<!--begin:Col-->
															<div class="col-lg-12 mb-3 mb-lg-0 py-3 px-3 py-lg-6 px-lg-6">
																<!--begin:Row-->
																<div class="row">
																	<!--begin:Col-->
																	<div class="col-lg-6 mb-3">
																		<!--begin:Menu item-->
																		<div class="menu-item p-0 m-0">
																			<!--begin:Menu link-->
																			<a href="pantalla-cursos-clases.php?numero=<?=$numeroEspla?>"class="menu-link">
																				<span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
																					<img src="./images/espac-removebg-preview.png" height="40px" width="40px" alt="">
																				</span>
																				<span class="d-flex flex-column">
																					<span class="fs-6 fw-bold text-gray-800">Esplacnología</span>
																					<span class="fs-7 fw-semibold text-muted">Estudio y descripción de las vísceras</span>
																				</span>
																			</a>
																			<!--end:Menu link-->
																		</div>
																		<!--end:Menu item-->
																	</div>
																	<!--end:Col-->
																</div>
																<!--end:Row-->
																<?php
																if(strlen($_SESSION['linkWhatsapp'])!=0){
																	?>
																<div class="separator separator-dashed mx-5 my-5"></div>
																<!--begin:Landing-->
																<div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-2 mx-5">
																	<div class="d-flex flex-column me-5">
																		<div class="fs-6 fw-bold text-gray-800">Grupo de Whatsapp</div>
																	</div>
																	<a href="<?=$_SESSION['linkWhatsapp']?>" class="btn btn-sm btn-primary fw-bold" target="_blank">Unirme</a>
																</div>
																<!--end:Landing-->
																<?php
																}
																?>
																<?php
																if(strlen($_SESSION['linkDrive'])!=0){
																	?>
																<div class="separator separator-dashed mx-5 my-5"></div>
																<!--begin:Landing-->
																<div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-2 mx-5">
																	<div class="d-flex flex-column me-5">
																		<div class="fs-6 fw-bold text-gray-800">Drive</div>
																	</div>
																	<a href="<?=$_SESSION['linkDrive']?>" class="btn btn-sm btn-primary fw-bold" target="_blank">Unirme</a>
																</div>
																<!--end:Landing-->
																<?php
																}
																?>
															</div>
															<!--end:Col-->
															
														</div>
														<!--end:Row-->
													</div>
													<!--end:Dashboards menu-->
												</div>
												<!--end:Menu sub-->
											</div>
											<!--end:Menu item-->
												<?php
													break;
													case 3:
												?>
											<!--begin:Menu item-->
											<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
												<!--begin:Menu link-->
												<span class="menu-link py-3">
													<span class="menu-title"><?=$_SESSION['nombreCurso']?></span>
													<span class="menu-arrow d-lg-none"></span>
												</span>
												<!--end:Menu link-->
												<!--begin:Menu sub-->
												<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0 w-100 w-lg-850px">
													<!--begin:Dashboards menu-->
													<div class="menu-state-bg menu-extended overflow-hidden overflow-lg-visible" data-kt-menu-dismiss="true">
														<!--begin:Row-->
														<div class="row">
															<!--begin:Col-->
															<div class="col-lg-12 mb-3 mb-lg-0 py-3 px-3 py-lg-6 px-lg-6">
																<!--begin:Row-->
																<div class="row">
																	<!--begin:Col-->
																	<div class="col-lg-6 mb-3">
																		<!--begin:Menu item-->
																		<div class="menu-item p-0 m-0">
																			<!--begin:Menu link-->
																			<a href="pantalla-cursos-clases.php?numero=<?=$numeroNeuro?>" class="menu-link">
																				<span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
																					<img src="./images/neuro-removebg-preview.png" height="40px" width="40px" alt="">
																				</span>
																				<span class="d-flex flex-column">
																					<span class="fs-6 fw-bold text-gray-800">Neuroanatomía</span>
																					<span class="fs-7 fw-semibold text-muted">Estructura y organización del sistema nervioso</span>
																				</span>
																			</a>
																			<!--end:Menu link-->
																		</div>
																		<!--end:Menu item-->
																	</div>
																	<!--end:Col-->
																</div>
																<?php
																if(strlen($_SESSION['linkWhatsapp'])!=0){
																	?>
																<div class="separator separator-dashed mx-5 my-5"></div>
																<!--begin:Landing-->
																<div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-2 mx-5">
																	<div class="d-flex flex-column me-5">
																		<div class="fs-6 fw-bold text-gray-800">Grupo de Whatsapp</div>
																	</div>
																	<a href="<?=$_SESSION['linkWhatsapp']?>" class="btn btn-sm btn-primary fw-bold" target="_blank">Unirme</a>
																</div>
																<!--end:Landing-->
																<?php
																}
																?>
																<?php
																if(strlen($_SESSION['linkDrive'])!=0){
																	?>
																<div class="separator separator-dashed mx-5 my-5"></div>
																<!--begin:Landing-->
																<div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-2 mx-5">
																	<div class="d-flex flex-column me-5">
																		<div class="fs-6 fw-bold text-gray-800">Drive</div>
																	</div>
																	<a href="<?=$_SESSION['linkDrive']?>" class="btn btn-sm btn-primary fw-bold" target="_blank">Unirme</a>
																</div>
																<!--end:Landing-->
																<?php
																}
																?>
															</div>
															<!--end:Col-->
														</div>
														<!--end:Row-->
													</div>
													<!--end:Dashboards menu-->
												</div>
												<!--end:Menu sub-->
											</div>
											<?php
												break;
												case 4:
											?>
											<!--begin:Menu item-->
											<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
												<!--begin:Menu link-->
												<span class="menu-link py-3">
													<span class="menu-title">Curso Final</span>
													<span class="menu-arrow d-lg-none"></span>
												</span>
												<!--end:Menu link-->
												<!--begin:Menu sub-->
												<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0 w-100 w-lg-850px">
													<!--begin:Dashboards menu-->
													<div class="menu-state-bg menu-extended overflow-hidden overflow-lg-visible" data-kt-menu-dismiss="true">
														<!--begin:Row-->
														<div class="row">
															<!--begin:Col-->
															<div class="col-lg-12 mb-3 mb-lg-0 py-3 px-3 py-lg-6 px-lg-6">
																<!--begin:Row-->
																<div class="row">
																<!--begin:Col-->
																<!--begin:Col-->
																	<div class="col-lg-6 mb-3">
																		<!--begin:Menu item-->
																		<div class="menu-item p-0 m-0">
																			<!--begin:Menu link-->
																			<a href="pantalla-cursos-clases.php?numero=<?=$numeroLocomotor?>" class="menu-link">
																				<span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
																					<img src="./images/locomotor-removebg-preview.png" width="40px" height="40px" alt="">
																				</span>
																				<span class="d-flex flex-column">
																					<span class="fs-6 fw-bold text-gray-800">Locomotor</span>
																					<span class="fs-7 fw-semibold text-muted">Huesos,  músculos, tendones y ligamentos</span>
																				</span>
																			</a>
																			<!--end:Menu link-->
																		</div>
																		<!--end:Menu item-->
																	</div>
																	<!--end:Col-->
																	<!--begin:Col-->
																	<div class="col-lg-6 mb-3">
																		<!--begin:Menu item-->
																		<div class="menu-item p-0 m-0">
																			<!--begin:Menu link-->
																			<a href="pantalla-cursos-clases.php?numero=<?=$numeroEspla?>"class="menu-link">
																				<span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
																					<img src="./images/espac-removebg-preview.png" height="40px" width="40px" alt="">
																				</span>
																				<span class="d-flex flex-column">
																					<span class="fs-6 fw-bold text-gray-800">Esplacnología</span>
																					<span class="fs-7 fw-semibold text-muted">Estudio y descripción de las vísceras</span>
																				</span>
																			</a>
																			<!--end:Menu link-->
																		</div>
																		<!--end:Menu item-->
																	</div>
																	<!--end:Col-->
																	<!--begin:Col-->
																	<div class="col-lg-6 mb-3">
																		<!--begin:Menu item-->
																		<div class="menu-item p-0 m-0">
																			<!--begin:Menu link-->
																			<a href="pantalla-cursos-clases.php?numero=<?=$numeroNeuro?>" class="menu-link">
																				<span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
																					<img src="./images/neuro-removebg-preview.png" height="40px" width="40px" alt="">
																				</span>
																				<span class="d-flex flex-column">
																					<span class="fs-6 fw-bold text-gray-800">Neuroanatomía</span>
																					<span class="fs-7 fw-semibold text-muted">Estructura y organización del sistema nervioso</span>
																				</span>
																			</a>
																			<!--end:Menu link-->
																		</div>
																		<!--end:Menu item-->
																	</div>
																	<!--end:Col-->
																</div>
																<!--end:Row-->
															</div>
															<?php
																if(strlen($_SESSION['linkWhatsapp'])!=0){
																	?>
																<div class="separator separator-dashed mx-5 my-5"></div>
																<!--begin:Landing-->
																<div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-2 mx-5">
																	<div class="d-flex flex-column me-5">
																		<div class="fs-6 fw-bold text-gray-800">Grupo de Whatsapp</div>
																	</div>
																	<a href="<?=$_SESSION['linkWhatsapp']?>" class="btn btn-sm btn-primary fw-bold" target="_blank">Unirme</a>
																</div>
																<!--end:Landing-->
																<?php
																}
																?>
																<?php
																if(strlen($_SESSION['linkDrive'])!=0){
																	?>
																<div class="separator separator-dashed mx-5 my-5"></div>
																<!--begin:Landing-->
																<div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-2 mx-5">
																	<div class="d-flex flex-column me-5">
																		<div class="fs-6 fw-bold text-gray-800">Drive</div>
																	</div>
																	<a href="<?=$_SESSION['linkDrive']?>" class="btn btn-sm btn-primary fw-bold" target="_blank">Unirme</a>
																</div>
																<!--end:Landing-->
																<?php
																}
																?>
															<!--end:Col-->
														</div>
														<!--end:Row-->
													</div>
													<!--end:Dashboards menu-->
												</div>
												<!--end:Menu sub-->
											</div>
											<!--end:Menu item-->
											<?php
											break;

											}
											?>
											
										</div>
										<!--end::Menu-->
										
									</div>
									<!--end::Menu wrapper-->

								</div>
								<!--end::Navbar-->
								<!--begin::Toolbar wrapper-->
								<div class="topbar d-flex align-items-stretch flex-shrink-0">
									
									
								
									<!--begin::Quick links-->
									<div class="d-flex align-items-center ms-1 ms-lg-3">
										<!--begin::Menu wrapper-->
										<div class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
											<i class="ki-duotone ki-element-11 fs-1">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
												<span class="path4"></span>
											</i>
										</div>
										<!--begin::Menu-->
										<div class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px" data-kt-menu="true">
											<!--begin::Heading-->
											<div class="d-flex flex-column flex-center bgi-no-repeat rounded-top px-9 py-10" style="background-image:url('assets/media/patterns/portada-anato.png')">
												<!--begin::Title-->
												<h3 class="text-white fw-semibold mb-3">Módulos Completos</h3>
												<!--end::Title-->
												<!--begin::Status-->
												<span class="badge bg-primary text-inverse-primary py-2 px-3">¿Por donde comenzar?</span>
												<!--end::Status-->
											</div>
											<!--end::Heading-->
											<!--begin:Nav-->
											<div class="row g-0">
											<?php
											if($_SESSION['moduloPermitido']==4 ||$_SESSION['moduloPermitido']==1 ){
												?>
												<!--begin:Item-->
												<div class="col-6">
													<a href="pantalla-cursos-clases.php?numero=<?=$numeroLocomotor?>" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end border-bottom">
													<img alt="Logo" src="./images/locomotor-removebg-preview.png" class="logo-sticky h-25px" />
														<span class="fs-5 fw-semibold text-gray-800 mb-0">Locomotor</span>
													</a>
												</div>
												<!--end:Item-->
												<?php
											}
											if($_SESSION['moduloPermitido']==4 ||$_SESSION['moduloPermitido']==2 ){
												
											?>
												<!--begin:Item-->
												<div class="col-6">
													<a href="pantalla-cursos-clases.php?numero=<?=$numeroEspla?>" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end">
														<img alt="Logo" src="./images/espac-removebg-preview.png" class="logo-sticky h-25px" />
														<span class="fs-5 fw-semibold text-gray-800 mb-0">Esplacnología</span>
													</a>
												</div>
												<!--end:Item-->
												<?php
											}
											if($_SESSION['moduloPermitido']==4 ||$_SESSION['moduloPermitido']==3 ){
												?>
												<!--begin:Item-->
												<div class="col-6">
													<a href="pantalla-cursos-clases.php?numero=<?=$numeroNeuro?>" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-bottom">
														<img alt="Logo" src="./images/neuro-removebg-preview.png" class="logo-sticky h-25px" />
														<span class="fs-5 fw-semibold text-gray-800 mb-0">Neuroanatomía</span>
													</a>
												</div>
												<!--end:Item-->
												<?php
											}
											?>
											</div>
											<!--end:Nav-->
										</div>
										<!--end::Menu-->
										<!--end::Menu wrapper-->
									</div>
									<!--end::Quick links-->
									<!--begin::User-->
									<div class="d-flex align-items-center me-lg-n2 ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
										<!--begin::Menu wrapper-->
										<div class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
											<img class="h-30px w-30px rounded" src="./images/brain.png" alt="" />
										</div>
										<!--begin::User account menu-->
										<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
											<!--begin::Menu item-->
											<div class="menu-item px-3">
												<div class="menu-content d-flex align-items-center px-3">
													<!--begin::Avatar-->
													<div class="symbol symbol-50px me-5">
														<img alt="Logo" src="./images/brain.png" />
													</div>
													<!--end::Avatar-->
													<!--begin::Username-->
													<div class="d-flex flex-column">
														<div class="fw-bold d-flex align-items-center fs-5"> <?= ucfirst($_SESSION['nombre'])?> <?= ucfirst($_SESSION['apellido']) ?> <br>
													
														
                                                       
															<span class="badge badge-light-warning fw-bold fs-8 px-2 py-1 ms-2">Acceso Total</span>
													
														</div>
													</div>
													<!--end::Username-->
												</div>
											</div>
											<!--end::Menu item-->
											<!--begin::Menu separator-->
											<div class="separator my-2"></div>
											<!--end::Menu separator-->
											<?php
												if($_SESSION['IdTipoUsuario']==2){
											?>
											
											<!--begin::Menu item-->
											<div class="menu-item px-5">
												<a href="./Admins/panel-admin.php" class="menu-link px-5">Opciones</a>
											</div>
											<!--end::Menu item-->
											<?php
												}
											?>
											<div class="menu-item px-5">
												<a href="change-password.php" class="menu-link px-5">Cambiar Contraseña</a>
											</div>
											<!--begin::Menu item-->
											<div class="menu-item px-5">
												<a href="index.php" class="menu-link px-5">Cerrar Sesión</a>
											</div>
											<!--end::Menu item-->
											
										</div>
										<!--end::User account menu-->
										<!--end::Menu wrapper-->
									</div>
									<!--end::User -->
									<!--begin::Aside mobile toggle-->
									<!--end::Aside mobile toggle-->
								</div>
								<!--end::Toolbar wrapper-->
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->
					<!--begin::Container-->
					<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start">
						<!--begin::Post-->
						<div class="content flex-row-fluid" id="kt_content">
                        <!--begin::Hero-->
							<div class="bgi-no-repeat bgi-position-center bgi-size-cover d-flex flex-column h-400px h-lg-500px">
								
								<!--begin::Container-->
								<div class="container pt-10 pt-lg-13">
                             
								<?php
                                if ($numero_recibido==1) {
									# code...
								
								?>

                                <div class="text-center">
                                    <img src="./images/locomotor-removebg-preview.png" width="70px" height="70px" alt="">
                                    </div>
									<!--begin::Title-->
									<h3 class="fs-2x fw-bold text-white text-center mb-10 mb-lg-13 my-3">Módulo Locomotor</h3>
									<!--end::Title-->
									<!--begin::Input group-->
                                   
									<!--end::Input group-->
								</div>
								<!--end::Container-->

								<?php
								}
								?>

								<?php
                                if ($numero_recibido==2) {
									# code...
								
								?>

                                <div class="text-center">
                                    <img src="./images/espac-removebg-preview.png" width="70px" height="70px" alt="">
                                    </div>
									<!--begin::Title-->
									<h3 class="fs-2x fw-bold text-white text-center mb-10 mb-lg-13 my-3">Módulo Esplacnología</h3>
									<!--end::Title-->
									<!--begin::Input group-->
                                   
									<!--end::Input group-->
								</div>
								<!--end::Container-->

								<?php
								}
								?>


								<?php
                                if ($numero_recibido==3) {
									# code...
								
								?>

                                <div class="text-center">
                                    <img src="./images/neuro-removebg-preview.png" width="70px" height="70px" alt="">
                                    </div>
									<!--begin::Title-->
									<h3 class="fs-2x fw-bold text-white text-center mb-10 mb-lg-13 my-3">Módulo Neuroanatomía</h3>
									<!--end::Title-->
									<!--begin::Input group-->
                                   
									<!--end::Input group-->
								</div>
								<!--end::Container-->

								<?php
								}
								?>

							</div>
							<!--end::Hero-->
							<!--begin::Svg-->
							<div class="mt-n15 text-page-bg">
								<svg width="100%" height="56px" viewBox="0 0 100 100" version="1.1" preserveAspectRatio="none" class="">
									<path d="M0,0 C16.6666667,66 33.3333333,99 50,99 C66.6666667,99 83.3333333,66 100,0 L100,100 L0,100 L0,0 Z" fill="currentColor"></path>
								</svg>
							</div>
							<!--end::Svg-->
							<!--begin::Container-->
							<div class="container">
								<!--begin::Card-->
								<div class="card translate-middle-y mt-n10 mt-lg-n10">
									<!--begin::Card body-->
									<div class="card-body">
									
									
										<!--begin::Nav-->
										<ul class="nav mx-auto flex-shrink-0 flex-center flex-wrap border-transparent fs-6 fw-bold">
                                        <!--begin::Nav item-->
											<!--end::Nav item-->
											<!--begin::Nav item-->
											<li class="nav-item my-3">
												<a class="btn btn-active-light-primary fw-bolder nav-link btn-color-gray-700 px-3 px-lg-8 mx-1 text-uppercase" href="pantalla-cursos-clases.php?numero=<?=$numero_recibido?>">CONTENIDO</a>
											</li>
											<!--end::Nav item-->
											<!--begin::Nav item-->
											<li class="nav-item my-3">
												<a class="btn btn-active-light-primary fw-bolder nav-link btn-color-gray-700 px-3 px-lg-8 mx-1 text-uppercase active" href="pdfs.php?numero=<?=$numero_recibido?>">PDFs</a>
											</li>
											<!--end::Nav item-->
											
										</ul>
										<!--end::Nav-->


								

									</div>
									<!--end::Card body-->
								</div>
								<!--end::Card-->
							</div>
							<!--end::Container-->
							<!--begin::Container-->
							<div class="container">
								<!--begin::Card-->
								<div class="card">
									<!--begin::Card body-->
									<div class="card-body">
										<!--begin::Layout-->
										<div class="d-flex flex-column flex-xl-row p-7">
											<!--begin::Content-->
											<div class="flex-lg-row-fluid me-xl-15 mb-20 mb-xl-0">
												<!--begin::Tickets-->
												<div class="mb-0">
													<!--begin::Heading-->
													<!--end::Heading-->
													


													<?php
													if ($numero_recibido == 1) {
														# code...
													
													?>


<div class="card card-flush mb-xxl-10">
										<!--begin::Header-->
										<div class="card-header pt-5">
											<!--begin::Title-->
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label fw-bold text-gray-900">Separados por Temas</span>
											</h3>
											<!--end::Title-->
										</div>
										<!--end::Header-->
										<!--begin::Body-->
										<div class="card-body">
											<!--begin::Nav-->
											<ul class="nav nav-pills nav-pills-custom mb-3" role="tablist">
												
												<!--begin::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4 active" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_200" aria-selected="false" role="tab" tabindex="-1">
													<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="" >
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-700 fw-bold fs-6 lh-1">General</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												
													<!--begin::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4 " data-bs-toggle="pill" href="#kt_stats_widget_1_tab_2" aria-selected="false" role="tab" tabindex="-1">
													<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="" >
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-700 fw-bold fs-6 lh-1">Hombro</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_3" aria-selected="false" role="tab" tabindex="-1">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Brazo</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_90" aria-selected="true" role="tab" tabindex="-1">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Mano</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->

												<!--begin::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_4" aria-selected="true" role="tab" tabindex="-1">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Cadera</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->

												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_5" aria-selected="true" role="tab" tabindex="-1">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Rodilla</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_6" aria-selected="true" role="tab" tabindex="-1">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Pierna</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_7" aria-selected="true" role="tab" tabindex="-1">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Cráneo</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_8" aria-selected="true" role="tab" tabindex="-1">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Dorso</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_9" aria-selected="true" role="tab" tabindex="-1">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Planner</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												
											</ul>
											<!--end::Nav-->
											<!--begin::Tab Content-->
											<!--begin::Tap pane-->
												<div class="tab-pane fade active show" id="kt_stats_widget_1_tab_200" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
														<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Temas a priorizar</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Generalidades</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/generalidades-loco/Lista de temas a priorizar de generalidades.pdf" download="Lista de temas a priorizar de generalidades.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Diapositivas - Generalidades de anatomía</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-warning fs-7 fw-bold">Generalidades</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/generalidades-loco/1. Diapositivas - Generalidades de anatomía..pdf" download="1. Diapositivas - Generalidades de anatomía..pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Generalidades - Articulaciones</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Generalidades</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/generalidades-loco/2. Generalidades - Articulaciones_.pdf" download="2. Generalidades - Articulaciones_.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Resumen de generalidades de anatomía</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Generalidades</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/generalidades-loco/3. Resumen de generalidades de anatomía_.pdf" download="3. Resumen de generalidades de anatomía_.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Generalidades de imágenes</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Generalidades</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/generalidades-loco/4. Generalidades de imágenes.pdf" download="4. Generalidades de imágenes.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">¿Cómo presentar preparados_ Tips de oratoria</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Generalidades</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/generalidades-loco/5. ¿Cómo presentar preparados_ Tips de oratoria.pdf" download="5. ¿Cómo presentar preparados_ Tips de oratoria.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">¿Cómo presentar imágenes_ Tips de oratoria?</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Generalidades</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/generalidades-loco/6. ¿Cómo presentar imágenes_ Tips de oratoria.pdf" download="6. ¿Cómo presentar imágenes_ Tips de oratoria.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Tp 1 - aplicación clínica - CAT 1</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Generalidades</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/generalidades-loco/7. Tp 1 - aplicación clínica - CAT 1.pdf" download="7. Tp 1 - aplicación clínica - CAT 1.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
											<div class="tab-content">
												<!--begin::Tap pane-->
												<div class="tab-pane fade" id="kt_stats_widget_1_tab_2" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
														<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Diapositivas Hombros</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Hombro</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/hombro/1. Diapositivas hombro.pdf" download="diapositivas-hombro.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Tips preparados de hombro</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-warning fs-7 fw-bold">Hombro</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/hombro/2. Tips preparados de hombro.pdf" download="Tips preparados de hombro.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">TP Hombro - Clinica - CAT 1</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Hombro</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/hombro/3. TP hombro - clínica - CAT 1.pdf" download="TP-Hombro-Clinica-CAT 1.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Biomecánica de hombro - CAT 3</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Hombro</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/hombro/4. Biomecánica de hombro - CAT 3.pdf" download="Biomecánica-hombro-CAT-3.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Px branquial - colaterales</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Hombro</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/hombro/5. Px braquial - colaterales.PDFx" download="Px-braquial - colaterales.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Temas a priorizar</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Hombro</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/hombro/Lista de temas a priorizar hombro.pdf" download="temas-a-priorizar-hombro.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
												<!--begin::Tap pane-->
												<div class="tab-pane fade" id="kt_stats_widget_1_tab_3" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Imagenes brazo</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Brazo/Codo/Antebrazo</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/brazo/2. Imágenes brazo - codo - AB.pdf" download="Imagenes brazo.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Tips preparados de brazo</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-warning fs-7 fw-bold">Brazo/Codo/Antebrazo</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/brazo/2. Imágenes brazo - codo - AB.pdf" download="Tips-preparados-brazo.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">B - C - AB - Clinica - CAT 1</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Brazo/Codo/Antebrazo</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/brazo/4. B - C - AB - CLÍNICA - CAT 1.pdf" download="B - C - AB-Clinica-CAT 1.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Biomecánica de codo - CAT 3 - Kapandji</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Brazo/Codo/Antebrazo</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/hombro/4. Biomecánica de hombro - CAT 3.pdf" download="Biomecánica de codo - CAT 3 - Kapandji.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Círculos anastomóticos del codo y de la rodilla</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Brazo/Codo/Antebrazo</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/brazo/6. Círculos anastomóticos del codo y de la rodilla.pdf" download="Círculos anastomóticos del codo y de la rodilla.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Temas a priorizar</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Brazo/Codo/Antebrazo</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/brazo/1. Brazo - codo - AB.pdf" download="temas-a-priorizar-brazo-codo-ab.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
												<!--begin::Tap pane-->
												<div class="tab-pane fade" id="kt_stats_widget_1_tab_90" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Integración MMSS</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Mano</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/mano/2. Integración MMSS.pdf" download="Integracion-MMSS.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Tips preparados de muñeca</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-warning fs-7 fw-bold">Mano</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/mano/7. Tips preparados muñeca - mano.pdf" download="Tips-preparados-muñeca.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Drenaje venoso linfatico</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Mano</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/mano/3. Drenajes venoso y linfático de miembros.pdf" download="Drenaje-venoso-linfatico.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">CAT 3 - Drenaje linfático mmss - Ciucci</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Mano</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/mano/4. CAT 3 - Drenaje linfático mmss - Ciucci.pdf" download="4. CAT 3 - Drenaje linfático mmss - Ciucci.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Biomecánica de muñeca - CAT 3</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Mano</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/mano/5. Biomecánica de muñeca - CAT 3.pdf" download="Biomecánica de muñeca - CAT 3.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Clínica TP muñeca - mano - CAT 1</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Mano</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/mano/6. Clínica TP muñeca - mano - CAT 1.pdf" download="Clínica TP muñeca - mano - CAT 1.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Temas a priorizar</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Mano</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/mano/Lista de temas a priorizar de mano.pdf" download="temas-a-priorizar-mano.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->

												<!--begin::Tap pane-->
												<div class="tab-pane fade" id="kt_stats_widget_1_tab_4" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Región Glútea</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Cadera</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cadera/1. Región glútea - cadera.pdf" download="Región-Glútea.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Imagenes de miembro inferior</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-warning fs-7 fw-bold">Cadera</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cadera/2. Imágenes de miembro inferior.pdf" download="Imagenes de miembro inferior.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Tips Glútea y Px Lumbar</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Cadera</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cadera/3. Tips preparados glútea - px lumbar.pdf" download="Tips Glútea y Px Lumbar.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Biomecánica de la cadera</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Cadera</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cadera/4. Biomecánica de la cadera.pdf" download="Biomecánica de la cadera.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Biomecánica sacroilíaca</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Cadera</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cadera/5. Biomecánica sacroilíaca.pdf" download="Biomecánica sacroilíaca.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Clínica TP glútea - cadera - CAT 1</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Cadera</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cadera/6. Clínica TP glútea - cadera - CAT 1.pdf" download="Clínica TP glútea - cadera - CAT 1.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Temas a priorizar</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Cadera</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cadera/Lista de temas a priorizar glútea - cadera.pdf" download="temas-a-priorizar-cadera.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
												<!--begin::Tap pane-->
												<div class="tab-pane fade" id="kt_stats_widget_1_tab_5" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Muslo y Rodilla</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Rodilla</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/rodilla/Copia de 1. Muslo y rodilla.pdf" download="Muslo y Rodilla.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Tips preparados muslo y rodilla</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-warning fs-7 fw-bold">Rodilla</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/rodilla/Copia de 2. Tips preparados muslo - rodilla.pdf" download="Tips preparados muslo y rodilla.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Clínica TP muslo - rodilla - CAT 1</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Rodilla</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/rodilla/Copia de 3. Clínica TP muslo - rodilla - CAT 1.pdf" download="Clínica TP muslo - rodilla - CAT 1.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Biomecánica de rodilla - CAT 3</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Rodilla</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/rodilla/Copia de 4. Biomecánica de rodilla - CAT 3.pdf" download="Biomecánica de rodilla - CAT 3.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Temas a priorizar</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Rodilla</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/rodilla/Lista de temas a priorizar muslo - rodilla.pdf" download="temas-a-priorizar-rodilla.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
												<!--begin::Tap pane-->
												<div class="tab-pane fade" id="kt_stats_widget_1_tab_6" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Pierna - Tobillo - Pie</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Pierna</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/pierna/1. Pierna - tobillo - pie.pdf" download="Pierna - Tobillo - Pie.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Resumen de inervación de mmii</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-warning fs-7 fw-bold">Pierna</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/pierna/2. Resumen de inervación de mmii.pdf" download="Resumen de inervación de mmii.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Resumen de bóveda plantar</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Pierna</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/pierna/3. Resumen de bóveda plantar.pdf" download="Resumen de bóveda plantar.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Tips pierna - tob - pie</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Pierna</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/pierna/4. Tips preparados pierna - tob - pie.pdf" download="Tips pierna - tob - pie.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Clínica TP pierna- tobillo - pie - CAT 1</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Pierna</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/pierna/5. Clínica TP pierna - tobillo - pie - CAT 1.pdf" download="Clínica TP pierna- tobillo - pie - CAT 1.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Drenaje linfático mmii - CAT 3</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Pierna</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/pierna/6. Drenaje linfático mmii - CAT 3 - Ciucci.pdf" download="Drenaje linfático mmii - CAT 3.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Biomecánica de tobillo y pie</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Pierna</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/pierna/8. Biomecánica de tobillo y pie_.pdf" download="Biomecánica de tobillo y pie.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Temas a priorizar</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Pierna</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/pierna/Lista de temas a priorizar pierna - tobillo - pie.pdf" download="temas-a-priorizar-Pierna.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
												<!--begin::Tap pane-->
												<div class="tab-pane fade" id="kt_stats_widget_1_tab_7" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Cráneo</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Craneo</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/craneo/1. Cráneo.pdf" download="Craneo.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Clínica TP cráneo - CAT 1</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Craneo</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/craneo/2. Clínica TP cráneo - CAT 1.pdf" download="Clínica TP cráneo - CAT 1.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Temas a priorizar</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Craneo</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/craneo/Lista de temas a priorizar cráneo.pdf" download="temas-a-priorizar-Craneo.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
												<!--begin::Tap pane-->
												<div class="tab-pane fade" id="kt_stats_widget_1_tab_8" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Diapositivas - dorso</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Dorso</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/dorso/1. Diapositivas - dorso.pdf" download="Diapositivas - dorso.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Imagenes Dorso</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-warning fs-7 fw-bold">Dorso</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/dorso/2. Imágenes dorso.pdf" download="Imagenes Dorso.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Resumen Dorso</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Dorso</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/dorso/3. Resumen dorso.pdf" download="Resumen Dorso.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Tips dorso</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Dorso</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/dorso/4. Tips preparados dorso.pdf" download="Tips dorso.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Biomecánica de dorso - CAT 3</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Dorso</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/dorso/6. Biomecánica de dorso - CAT 3 - Kapandji.pdf" download="Biomecánica de dorso - CAT 3.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">TP dorso - clínica - CAT 1</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Dorso</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/dorso/5. Tp dorso - clínica - CAT 1.pdf" download="TP dorso - clínica - CAT 1.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
												<!--begin::Tap pane-->
												<div class="tab-pane fade" id="kt_stats_widget_1_tab_9" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
														<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
															    <tr>
																	<td>
																		<a class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Lista de temas tomados en teórico locomotor</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Planner</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/planner-loco/1. Lista de temas tomados en teórico locomotor.pdf" download="1. Lista de temas tomados en teórico locomotor.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Modelos de exámenes teóricos locomotor</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Planner</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/planner-loco/2. Modelos de exámenes teóricos locomotor (1).pdf" download="2. Modelos de exámenes teóricos locomotor (1).pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Check list locomotor</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Planner</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/planner-loco/Check list locomotor.pdf" download="Check list locomotor.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Cronograma de clases sincrónicas - final diciembre</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Planner</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/hombro/Cronograma de clases sincrónicas - final diciembre.pdf" download="diapositivas-hombro.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Planner final de diciembre</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-warning fs-7 fw-bold">Planner</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/hombro/Planner final de diciembre.pdf" download="Planner final de diciembre.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
											</div>
											<!--end::Tab Content-->
										</div>
										<!--end: Card Body-->
									</div>

													<?php
													}

													?>



													<?php
													if ($numero_recibido == 2) {
														# code...
													
													?>
											<div class="card card-flush mb-xxl-10">
										<!--begin::Header-->
										<div class="card-header pt-5">
											<!--begin::Title-->
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label fw-bold text-gray-900">Separados por Temas</span>
											</h3>
											<!--end::Title-->
										</div>
										<!--end::Header-->
										<!--begin::Body-->
										<div class="card-body">
											<!--begin::Nav-->
											<ul class="nav nav-pills nav-pills-custom mb-3" role="tablist">
												
												<!--begin::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4 active" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_2" aria-selected="false" role="tab" tabindex="-1">
													<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="" >
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-700 fw-bold fs-6 lh-1">Cara</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_3" aria-selected="false" role="tab" tabindex="-1">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Cuello</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_90" aria-selected="true" role="tab">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Torax</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->

												<!--begin::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_4" aria-selected="true" role="tab">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Mediastino</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->

												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_5" aria-selected="true" role="tab">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Paredes Abdomen</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_6" aria-selected="true" role="tab">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Abdomen Infra</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_7" aria-selected="true" role="tab">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Pelvis</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_8" aria-selected="true" role="tab">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Modelos Examen</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_11" aria-selected="true" role="tab">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Abdomen Supra</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												
											</ul>
											<!--end::Nav-->
											<!--begin::Tab Content-->
											<div class="tab-content">
												<!--begin::Tap pane-->
												<div class="tab-pane fade active show" id="kt_stats_widget_1_tab_2" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
														<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Diapositivas cara - Parte I</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Cara</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cara/1. Diapositivas cara - Parte I.pdf" download="Diapositivas cara - Parte I.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Diapositivas cara - Parte II</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Cara</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cara/2. Diapositivas cara - Parte II.pdf" download="Diapositivas cara - Parte II.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Tips practicos cara y cuello</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-warning fs-7 fw-bold">Cara</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cara/3. Tips prácticos - cara y cuello .pdf" download="Tips practicos cara y cuello.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Resumen cara</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-warning fs-7 fw-bold">Cara</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cara/4. Resumen cara.pdf" download="Resumen cara.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Preparados de cara</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-warning fs-7 fw-bold">Cara</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cara/5. Preparados de cara.pdf" download="Preparados de cara.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Cara - aplicación Clinica - CAT 1</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Cara</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cara/6. Cara, aplicación clínica, CAT 1.pdf" download="Cara - aplicación Clinica - CAT 1.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Temas a priorizar</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Cara</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cara/TEMAS A PRIORIZAR - CARA (1).pdf" download="temas-a-priorizar-Cara.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
												<!--begin::Tap pane-->
												<div class="tab-pane fade" id="kt_stats_widget_1_tab_3" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Diapositivas Cuello Parte I</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Cuello</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cuello/1. Diapos cuello- primera parte.pdf" download="1. Diapos cuello- primera parte.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Diapositivas Cuello Parte II</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-warning fs-7 fw-bold">Cuello</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cuello/2. Diapositivas cuello - parte II.pdf" download="Diapositivas Cuello Parte II.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Tips prácticos - cara y cuello</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Cuello</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cuello/3. Tips prácticos - cara y cuello.pdf" download="Tips prácticos - cara y cuello.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Arterias de cara y cuello</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Cuello</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cuello/4.Arterias de cara y cuello.pdf" download="Arterias de cara y cuello.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Triangulos cuello</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Cuello</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cuello/5.triangulos cuello.pdf" download="Triangulos cuello.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Nervios craneales</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Cuello</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cuello/6. Nervios craneales - esplacnología.pdf" download="Nervios craneales.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Cuadros - nervios craneales</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Cuello</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cuello/7. Cuadros - nervios craneales.pdf" download="Cuadros - nervios craneales.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Preparando cuello</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Cuello</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cuello/8. Preparados cuello.pdf" download="Preparando cuello.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Cuello, aplicación clínica , CAT 1</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Cuello</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cuello/9. Cuello, aplicación clínica, CAT 1.pdf" download="Cuello, aplicación clínica , CAT 1.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Temas a priorizar</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Cuello</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/cuello/TEMAS A PRIORIZAR - CUELLO (1).pdf" download="temas-a-priorizar-Cuello.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
												<!--begin::Tap pane-->
												<div class="tab-pane" id="kt_stats_widget_1_tab_90" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Diapositivas Tórax</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Torax</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/torax/1. Diapositivas tórax.pdf" download="Diapositivas Tórax.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Resumen de Tórax</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-warning fs-7 fw-bold">Torax</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/torax/2. Resumen de tórax.pdf" download="Resumen de Tórax.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Tips practicos tórax y mediastino</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Torax</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/torax/3. Tips practicos torax y mediastino.pdf" download="Tips practicos tórax y mediastino.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Nervio frénico</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Torax</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/torax/4. Nervio frénico.pdf" download="Nervio frénico.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Preparados Tórax</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Torax</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/torax/5. Preparados tórax.pdf" download="Preparados Tórax.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Tórax, aplicación clínica - CAT 1</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Torax</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/torax/6. Tórax, aplicación clínica, CAT 1.pdf" download="Tórax, aplicación clínica - CAT 1.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Temas a priorizar</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Torax</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/torax/TEMAS A PRIORIZAR - TÓRAX (1).pdf" download="temas-a-priorizar-Torax.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->

												<!--begin::Tap pane-->
												<div class="tab-pane" id="kt_stats_widget_1_tab_4" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Diapositivas Mediastino</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Mediastino</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/mediastino/1. Diapositivas mediastino.pdf" download="Diapositivas Mediastino.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Tips practicos Torax y Mediastino</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Mediastino</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/mediastino/2. Tips practicos torax y mediastino .pdf" download="Tips practicos Torax y Mediastino.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Mediastino - Martinez - Casiraghi (Para CAT 3)</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Mediastino</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/mediastino/3. Mediastino - Martinez - Casiraghi LEER SI SOS CAT3.pdf" download="Biomecánica de muñeca - CAT 3.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Preparados Mediastino</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Mediastino</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/mediastino/4. Preparados mediastino.pdf" download="Preparados Mediastino.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Temas a priorizar</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Mediastino</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/mediastino/TEMAS A PRIORIZAR - MEDIASTINO (1).pdf" download="temas-a-priorizar-Mediastino.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
												<!--begin::Tap pane-->
												<div class="tab-pane" id="kt_stats_widget_1_tab_5" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Diapositivas Paredes de Abdomen</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Paredes de Abdomen</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/paredes-abdomen/1. Diapositivas paredes de abdomen - peritoneo.pdf" download="Diapositivas Paredes de Abdomen.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Peritoneo - Casiragui (Solo CAT 1)</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-warning fs-7 fw-bold">Paredes de Abdomen</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/paredes-abdomen/2. Peritoneo - Casiraghi LEER SI SOS CAT1_3.pdf" download="Peritoneo - Casiragui (Solo CAT 1).pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Disecciones paredes de abdomen</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Paredes de Abdomen</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/paredes-abdomen/3. Disecciones paredes de abdomen.pdf" download="Disecciones paredes de abdomen.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Conducto inguinal</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Paredes de Abdomen</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/paredes-abdomen/4. Conducto inguinal - preparandoanato.pdf" download="Conducto inguinal.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Temas a priorizar</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Paredes de Abdomen</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/paredes-abdomen/TEMAS A PRIORIZAR - PAREDES DE ABDOMEN (1).pdf" download="temas-a-priorizar-Paredes de Abdomen.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
												<!--begin::Tap pane-->
												<div class="tab-pane" id="kt_stats_widget_1_tab_6" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Diapositivas abdomen infra</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Abdomen Inframeso</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/inframeso/1. Diapositivas abdomen infra - retro.pdf" download="Diapositivas abdomen infra.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Anastomosis portocava</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Abdomen Inframeso</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/inframeso/2. Anastomosis portocava.pdf" download="Anastomosis portocava.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Tips practicos inframesocolico y retroperitoneo</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Abdomen Inframeso</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/inframeso/3. Tips practicos inframesocolico y retroperitoneo.pdf" download="Tips practicos inframesocolico y retroperitoneo.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Disecciones abdomen infra-retroperitoneo</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Abdomen Inframeso</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/inframeso/4. Disecciones abdomen infra-retroperitoneo.pdf" download="Disecciones abdomen infra-retroperitoneo.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Temas a priorizar</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Abdomen Inframeso</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/inframeso/TEMAS A PRIORIZAR - ABDOMEN INFRAMESOCOLICO Y RETROPERITONEO (1).pdf" download="temas-a-priorizar-Abdomen Inframeso.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
												<!--begin::Tap pane-->
												<div class="tab-pane" id="kt_stats_widget_1_tab_7" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Diapositivas pelvis</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Pelvis</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/pelvis/1. Diapositivas pelvis.pdf" download="Diapositivas pelvis.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Px celíaco - hipogástrico</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Pelvis</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/pelvis/2. Px celíaco - hipogástrico - Candela Casado.pdf" download="Px celíaco - hipogástrico.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Tips practicos pelvis</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Pelvis</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/pelvis/3. Tips practicos pelvis.pdf" download="Tips practicos pelvis.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Disecciones pelvis y periné</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Pelvis</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/pelvis/4. Disecciones pelvis y periné.pdf" download="4. Disecciones pelvis y periné.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Temas a priorizar</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Pelvis</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/pelvis/TEMAS A PRIORIZAR - PELVIS (1).pdf" download="TEMAS A PRIORIZAR - PELVIS.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
												<!--begin::Tap pane-->
												<div class="tab-pane " id="kt_stats_widget_1_tab_8" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Checklist</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Modelo Exámen</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/modelos-espa/Check list esplacnología.pdf" download="Check list esplacnología.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Modelos de exámen teorico</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-warning fs-7 fw-bold">Modelo Exámen</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/modelos-espa/Modelos de examen teórico esplacnologia.pdf" download="Modelos de examen teórico esplacnologia.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Temas tomados teorico</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Modelo Exámen</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/modelos-espa/Temas tomados teorico esplacno.pdf" download="Temas tomados teorico esplacno.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
												<!--begin::Tap pane-->
												<div class="tab-pane" id="kt_stats_widget_1_tab_11" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Diapositivas abdomen supramesocólico</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Abdomen Supramesocolico</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/suprameso/1. Diapositivas abdomen supramesocólico.pdf" download="1. Diapositivas abdomen supramesocólico.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																	<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Segmentacion hepatica + TAC RNM</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Abdomen Supramesocolico</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/suprameso/2. Segmentacion hepatica + TAC RNM.pdf" download="2. Segmentacion hepatica + TAC RNM.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																	<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Tips practicos</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Abdomen Supramesocolico</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/suprameso/3. Tips practicos abdomen supramesocolico.pdf" download="3. Tips practicos abdomen supramesocolico.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																	<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Preparados </a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Abdomen Supramesocolico</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/suprameso/4. Preparados abdomen supramesocólico.pdf" download="4. Preparados abdomen supramesocólico.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																	<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">TEMAS A PRIORIZAR </a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Abdomen Supramesocolico</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/suprameso/TEMAS A PRIORIZAR - ABDOMEN SUPRAMESOCOLICO (1).pdf" download="TEMAS A PRIORIZAR - ABDOMEN SUPRAMESOCOLICO (1).pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
											</div>
											<!--end::Tab Content-->
										</div>
										<!--end: Card Body-->
									</div>

													<?php
													}

													?>



													<?php
													if ($numero_recibido == 3) {
														# code...
													
													?>
									<div class="card card-flush mb-xxl-10">
										<!--begin::Header-->
										<div class="card-header pt-5">
											<!--begin::Title-->
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label fw-bold text-gray-900">Separados por Temas</span>
											</h3>
											<!--end::Title-->
										</div>
										<!--end::Header-->
										<!--begin::Body-->
										<div class="card-body">
											<!--begin::Nav-->
											<ul class="nav nav-pills nav-pills-custom mb-3" role="tablist">
												
												<!--begin::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4 active" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_2" aria-selected="false" role="tab" tabindex="-1">
													<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="" >
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-700 fw-bold fs-6 lh-1">Tronco Cerebelo</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_3" aria-selected="false" role="tab" tabindex="-1">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Nervios Craneales</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_90" aria-selected="true" role="tab">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Prosence</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->

												<!--begin::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_4" aria-selected="true" role="tab">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Vías</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->

												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_5" aria-selected="true" role="tab">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Vascu</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_6" aria-selected="true" role="tab">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Sensorial</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_7" aria-selected="true" role="tab">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Diencefalo</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_8" aria-selected="true" role="tab">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Planner</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_9" aria-selected="true" role="tab">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Imagenes</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
													<!--begin::Link-->
													<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_10" aria-selected="true" role="tab">
														<!--begin::Icon-->
														<div class="nav-icon">
															<img alt="" src="./images/pdf.png" class="nav-icon">
														</div>
														<!--end::Icon-->
														<!--begin::Subtitle-->
														<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Generalidad</span>
														<!--end::Subtitle-->
														<!--begin::Bullet-->
														<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
														<!--end::Bullet-->
													</a>
													<!--end::Link-->
												</li>
												<!--end::Item-->
												
											</ul>
											<!--end::Nav-->
											<!--begin::Tab Content-->
											<div class="tab-content">
												<!--begin::Tap pane-->
												<div class="tab-pane fade active show" id="kt_stats_widget_1_tab_2" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
														<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Diapositivas tronco y cerebelo</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Tronco Cerebelo</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/tronco-cerebelo/1. Diapositivas - tronco y cerebelo.pdf" download="1. Diapositivas - tronco y cerebelo.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Vías - Cuitcuitos cerebelosos</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-warning fs-7 fw-bold">Tronco Cerebelo</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/tronco-cerebelo/2. VÍAS - Módulos_circuitos cerebelosos.pdf" download="Vías - Cuitcuitos cerebelosos.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Repaso Tronco del encéfalo y cerebelo</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Tronco Cerebelo</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/tronco-cerebelo/3.  Repaso práctico – Tronco del encéfalo y cerebelo.pdf" download="3.  Repaso práctico – Tronco del encéfalo y cerebelo.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Anatomía del ángulo pontocerebeloso</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Tronco Cerebelo</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/tronco-cerebelo/Anatomia del angulo pontocerebeloso.pdf" download="Anatomia del angulo pontocerebeloso.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
												<!--begin::Tap pane-->
												<div class="tab-pane fade" id="kt_stats_widget_1_tab_3" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Nervios Craneales Parte I</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Nervios Craneales</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/nervios-craneales/1. Nervios craneales parte 1.pdf" download="1. Nervios craneales parte 1.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Nervios Craneales Parte II</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-warning fs-7 fw-bold">Nervios Craneales</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/nervios-craneales/2. Nervios craneales parte 2.pdf" download="2. Nervios craneales parte 2.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Resumen Nervios Craneales</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Nervios Craneales</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/nervios-craneales/3. Resumen - nervios craneales.pdf" download="3. Resumen - nervios craneales.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Casos clínicos Nervios Craneales</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Nervios Craneales</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/nervios-craneales/4. Casos clínicos nervios craneales.pdf" download="4. Casos clínicos nervios craneales.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
												<!--begin::Tap pane-->
												<div class="tab-pane" id="kt_stats_widget_1_tab_90" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Diapositivas - Prosencéfalo</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Prosencefalo</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/prosencefalo/1. Diapositivas - Prosencéfalo.pdf" download="1. Diapositivas - Prosencéfalo.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->

												<!--begin::Tap pane-->
												<div class="tab-pane" id="kt_stats_widget_1_tab_4" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Diapositivas Vías</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Vías</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/vias/1. Diapositivas - vías.pdf" download="1. Diapositivas - vías.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Resumen Vías</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-warning fs-7 fw-bold">Vías</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/vias/2. Resumen vías.pdf" download="2. Resumen vías.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
												<!--begin::Tap pane-->
												<div class="tab-pane" id="kt_stats_widget_1_tab_5" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Diapositivas Vascularización</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Vascularización</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/vascularizacion/1. Diapositivas - vascularización.pdf" download="1. Diapositivas - vascularización.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Resumen cisternas subarancnoideas</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-warning fs-7 fw-bold">Vascularización</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/vascularizacion/2. Resumen cisternas subaracnoideas.pdf" download="2. Resumen cisternas subaracnoideas.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Pro-Forlizzi - Cisternas</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Vascularización</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/vascularizacion/3. Pro-Forlizzi - Cisternas.pdf" download="3. Pro-Forlizzi - Cisternas.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
												<!--begin::Tap pane-->
												<div class="tab-pane" id="kt_stats_widget_1_tab_6" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Gusto - Visón - Audición</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Sensorial</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/sensorial/1. Gusto - visión - audición.pdf" download="1. Gusto - visión - audición.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Audición</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-warning fs-7 fw-bold">Sensorial</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/sensorial/2. Audición.pdf" download="2. Audición.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Sistema Vestibular</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Sensorial</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/sensorial/Sistema vestibular.pdf" download="Sistema vestibular.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
												<!--begin::Tap pane-->
												<div class="tab-pane" id="kt_stats_widget_1_tab_7" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Diapositivas Diencéfalo - sna - olfato</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Diencefalo</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/diencefalo/1. Diapositivas - Diencéfalo - sna - olfato.pdf" download="1. Diapositivas - Diencéfalo - sna - olfato.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Sistema Límbico</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-primary fs-7 fw-bold">Diencefalo</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/diencefalo/2. Sistema límbico.pdf" download="Sistema Límbico.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
												<!--begin::Tap pane-->
												<div class="tab-pane " id="kt_stats_widget_1_tab_8" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Temas a priorizar neuro</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Modelos Exámen</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/modelo-neuro/3. TEMAS A PRIORIZAR NEURO.pdf" download=". TEMAS A PRIORIZAR NEURO.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Modelo de examen neuro</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Modelos Exámen</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/modelo-neuro/4. MODELOS DE EXAMEN NEURO.pdf" download="4. MODELOS DE EXAMEN NEURO.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Planner Parcial neuro</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Modelos Exámen</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/modelo-neuro/5. PLANNER PARCIAL NEURO.pdf" download="5. PLANNER PARCIAL NEURO.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<?php
																if($_SESSION['IdCurso']==6){
																    ?>
																    <tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Cronograma clases sincronicas</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Modelos Exámen</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/modelo-neuro/6. CRONOGRAMA CLASES SINCRÓNICAS.pdf" download="6. CRONOGRAMA CLASES SINCRÓNICAS.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																    
																    <?php
																}
																?>
																
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
												<!--begin::Tap pane-->
												<div class="tab-pane fade" id="kt_stats_widget_1_tab_9" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Imagenes</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">NeuroImagenes</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/imagenes/FICHAS DE NEUROIMÁGENES.pdf" download="FICHAS DE NEUROIMÁGENES.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
													<!--begin::Tap pane-->
												<div class="tab-pane fade" id="kt_stats_widget_1_tab_10" role="tabpanel">
													<!--begin::Table container-->
													<div class="table-responsive">
													<!--begin::Table-->
														<table class="table align-middle gs-0 gy-4 my-0">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-500">
																	<th class="p-0 min-w-150px d-block pt-3">Nombre Archivo</th>
																	<th class="text-end min-w-140px pt-3">Módulo</th>
																	<th class="pe-0 text-end min-w-120px pt-3">Descargar</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Generalidades de neuroanatomía médula espinal reflejo miotático</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Generalidades</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/generalidades-neuro/1. Generalidades de neuroanatomía médula espinal reflejo miotático.pdf" download="1. Generalidades de neuroanatomía médula espinal reflejo miotático.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Repaso práctico – generalidades de neuroanatomía</a>
																	</td>
																	<td class="text-end">
																		<span class="badge badge-light-success fs-7 fw-bold">Generalidades</span>
																	</td>
																	<td class="text-end">
																		<span class="text-gray-800 fw-bold d-block fs-6"><a href="./materiales/generalidades-neuro/2. Repaso práctico – generalidades de neuroanatomía.pdf" download="2. Repaso práctico – generalidades de neuroanatomía.pdf">Descargar PDF</a></span>
																	</td>
																</tr>
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->
												</div>
												<!--end::Tap pane-->
											</div>
											<!--end::Tab Content-->
										</div>
										<!--end: Card Body-->
									</div>

													<?php
													}

													?>

												</div>
												<!--end::Tickets-->
											</div>
											<!--end::Content-->
										</div>
										<!--end::Layout-->
									</div>
									<!--end::Card body-->
								</div>
								<!--end::Card-->
							</div>
							<!--end::Container-->
							<!--begin::Modal - Support Center - Create Ticket-->
							<div class="modal fade" id="kt_modal_new_ticket" tabindex="-1" aria-hidden="true">
								<!--begin::Modal dialog-->
								<div class="modal-dialog modal-dialog-centered mw-750px">
									<!--begin::Modal content-->
									<div class="modal-content rounded">
										<!--begin::Modal header-->
										<div class="modal-header pb-0 border-0 justify-content-end">
											<!--begin::Close-->
											<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
												<i class="ki-duotone ki-cross fs-1">
													<span class="path1"></span>
													<span class="path2"></span>
												</i>
											</div>
											<!--end::Close-->
										</div>
										<!--begin::Modal header-->
										<!--begin::Modal body-->
										<div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
											<!--begin:Form-->
											<form id="kt_modal_new_ticket_form" class="form" action="#">
												<!--begin::Heading-->
												<div class="mb-13 text-center">
													<!--begin::Title-->
													<h1 class="mb-3">Create Ticket</h1>
													<!--end::Title-->
													<!--begin::Description-->
													<div class="text-gray-500 fw-semibold fs-5">If you need more info, please check 
													<a href="" class="fw-bold link-primary">Support Guidelines</a>.</div>
													<!--end::Description-->
												</div>
												<!--end::Heading-->
												<!--begin::Input group-->
												<div class="d-flex flex-column mb-8 fv-row">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
														<span class="required">Subject</span>
														<span class="ms-2" data-bs-toggle="tooltip" title="Specify a subject for your issue">
															<i class="ki-duotone ki-information fs-7">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="path3"></span>
															</i>
														</span>
													</label>
													<!--end::Label-->
													<input type="text" class="form-control form-control-solid" placeholder="Enter your ticket subject" name="subject" />
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="row g-9 mb-8">
													<!--begin::Col-->
													<div class="col-md-6 fv-row">
														<label class="required fs-6 fw-semibold mb-2">Product</label>
														<select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select a product" name="product">
															<option value="">Select a product...</option>
															<option value="1">HTML Theme</option>
															<option value="1">Angular App</option>
															<option value="1">Vue App</option>
															<option value="1">React Theme</option>
															<option value="1">Figma UI Kit</option>
															<option value="3">Laravel App</option>
															<option value="4">Blazor App</option>
															<option value="5">Django App</option>
														</select>
													</div>
													<!--end::Col-->
													<!--begin::Col-->
													<div class="col-md-6 fv-row">
														<label class="required fs-6 fw-semibold mb-2">Assign</label>
														<select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select a Team Member" name="user">
															<option value="">Select a user...</option>
															<option value="1">Karina Clark</option>
															<option value="2">Robert Doe</option>
															<option value="3">Niel Owen</option>
															<option value="4">Olivia Wild</option>
															<option value="5">Sean Bean</option>
														</select>
													</div>
													<!--end::Col-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="row g-9 mb-8">
													<!--begin::Col-->
													<div class="col-md-6 fv-row">
														<label class="required fs-6 fw-semibold mb-2">Status</label>
														<select class="form-select form-select-solid" data-control="select2" data-placeholder="Open" data-hide-search="true">
															<option value=""></option>
															<option value="1" selected="selected">Open</option>
															<option value="2">Pending</option>
															<option value="3">Resolved</option>
															<option value="3">Closed</option>
														</select>
													</div>
													<!--end::Col-->
													<!--begin::Col-->
													<div class="col-md-6 fv-row">
														<label class="required fs-6 fw-semibold mb-2">Due Date</label>
														<!--begin::Input-->
														<div class="position-relative d-flex align-items-center">
															<!--begin::Icon-->
															<div class="symbol symbol-20px me-4 position-absolute ms-4">
																<span class="symbol-label bg-secondary">
																	<i class="ki-duotone ki-element-11">
																		<span class="path1"></span>
																		<span class="path2"></span>
																		<span class="path3"></span>
																		<span class="path4"></span>
																	</i>
																</span>
															</div>
															<!--end::Icon-->
															<!--begin::Datepicker-->
															<input class="form-control form-control-solid ps-12" placeholder="Select a date" name="due_date" />
															<!--end::Datepicker-->
														</div>
														<!--end::Input-->
													</div>
													<!--end::Col-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="d-flex flex-column mb-8 fv-row">
													<label class="fs-6 fw-semibold mb-2">Description</label>
													<textarea class="form-control form-control-solid" rows="4" name="description" placeholder="Type your ticket description"></textarea>
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<label class="fs-6 fw-semibold mb-2">Attachments</label>
													<!--begin::Dropzone-->
													<div class="dropzone" id="kt_modal_create_ticket_attachments">
														<!--begin::Message-->
														<div class="dz-message needsclick align-items-center">
															<!--begin::Icon-->
															<i class="ki-duotone ki-file-up fs-3hx text-primary">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
															<!--end::Icon-->
															<!--begin::Info-->
															<div class="ms-4">
																<h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
																<span class="fw-semibold fs-7 text-gray-500">Upload up to 10 files</span>
															</div>
															<!--end::Info-->
														</div>
													</div>
													<!--end::Dropzone-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="mb-15 fv-row">
													<!--begin::Wrapper-->
													<div class="d-flex flex-stack">
														<!--begin::Label-->
														<div class="fw-semibold me-5">
															<label class="fs-6">Notifications</label>
															<div class="fs-7 text-gray-500">Allow Notifications by Phone or Email</div>
														</div>
														<!--end::Label-->
														<!--begin::Checkboxes-->
														<div class="d-flex align-items-center">
															<!--begin::Checkbox-->
															<label class="form-check form-check-custom form-check-solid me-10">
																<input class="form-check-input h-20px w-20px" type="checkbox" name="notifications[]" value="email" checked="checked" />
																<span class="form-check-label fw-semibold">Email</span>
															</label>
															<!--end::Checkbox-->
															<!--begin::Checkbox-->
															<label class="form-check form-check-custom form-check-solid">
																<input class="form-check-input h-20px w-20px" type="checkbox" name="notifications[]" value="phone" />
																<span class="form-check-label fw-semibold">Phone</span>
															</label>
															<!--end::Checkbox-->
														</div>
														<!--end::Checkboxes-->
													</div>
													<!--end::Wrapper-->
												</div>
												<!--end::Input group-->
												<!--begin::Actions-->
												<div class="text-center">
													<button type="reset" id="kt_modal_new_ticket_cancel" class="btn btn-light me-3">Cancel</button>
													<button type="submit" id="kt_modal_new_ticket_submit" class="btn btn-primary">
														<span class="indicator-label">Submit</span>
														<span class="indicator-progress">Please wait... 
														<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
													</button>
												</div>
												<!--end::Actions-->
											</form>
											<!--end:Form-->
										</div>
										<!--end::Modal body-->
									</div>
									<!--end::Modal content-->
								</div>
								<!--end::Modal dialog-->
							</div>
							<!--end::Modal - Support Center - Create Ticket-->
						</div>
						<!--end::Post-->
					</div>
					<!--end::Container-->
					<!--begin::Footer-->
					<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
						<!--begin::Container-->
						<div class="container-xxl d-flex flex-column flex-md-row align-items-center justify-content-between">
							<!--begin::Copyright-->
							<div class="text-gray-900 order-2 order-md-1">
								<span class="text-muted fw-semibold me-1">2023&copy;</span>
								<a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">PCA</a>
							</div>
							<!--end::Copyright-->
							<!--begin::Menu-->
							<ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
								<li class="menu-item">
									<a href="https://keenthemes.com" target="_blank" class="menu-link text-primary px-2">Instagram</a>
								</li>
								<li class="menu-item">
									<a href="https://devs.keenthemes.com" target="_blank" class="menu-link text-danger px-2">Youtube</a>
								</li>
								<li class="menu-item">
									<a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link text-success px-2">Whatsapp</a>
								</li>
							</ul>
							<!--end::Menu-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
		<!--begin::Drawers-->
		<!--begin::Activities drawer-->
		<div id="kt_activities" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="activities" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'lg': '900px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_activities_toggle" data-kt-drawer-close="#kt_activities_close">
			<div class="card shadow-none border-0 rounded-0">
				<!--begin::Header-->
				<div class="card-header" id="kt_activities_header">
					<h3 class="card-title fw-bold text-gray-900">Activity Logs</h3>
					<div class="card-toolbar">
						<button type="button" class="btn btn-sm btn-icon btn-active-light-primary me-n5" id="kt_activities_close">
							<i class="ki-duotone ki-cross fs-1">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</button>
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body position-relative" id="kt_activities_body">
					<!--begin::Content-->
					<div id="kt_activities_scroll" class="position-relative scroll-y me-n5 pe-5" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_activities_body" data-kt-scroll-dependencies="#kt_activities_header, #kt_activities_footer" data-kt-scroll-offset="5px">
						<!--begin::Timeline items-->
						<div class="timeline timeline-border-dashed">
							<!--begin::Timeline item-->
							<div class="timeline-item">
								<!--begin::Timeline line-->
								<div class="timeline-line"></div>
								<!--end::Timeline line-->
								<!--begin::Timeline icon-->
								<div class="timeline-icon">
									<i class="ki-duotone ki-message-text-2 fs-2 text-gray-500">
										<span class="path1"></span>
										<span class="path2"></span>
										<span class="path3"></span>
									</i>
								</div>
								<!--end::Timeline icon-->
								<!--begin::Timeline content-->
								<div class="timeline-content mb-10 mt-n1">
									<!--begin::Timeline heading-->
									<div class="pe-3 mb-5">
										<!--begin::Title-->
										<div class="fs-5 fw-semibold mb-2">There are 2 new tasks for you in “AirPlus Mobile App” project:</div>
										<!--end::Title-->
										<!--begin::Description-->
										<div class="d-flex align-items-center mt-1 fs-6">
											<!--begin::Info-->
											<div class="text-muted me-2 fs-7">Added at 4:23 PM by</div>
											<!--end::Info-->
											<!--begin::User-->
											<div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Nina Nilson">
												<img src="assets/media/avatars/300-14.jpg" alt="img" />
											</div>
											<!--end::User-->
										</div>
										<!--end::Description-->
									</div>
									<!--end::Timeline heading-->
									<!--begin::Timeline details-->
									<div class="overflow-auto pb-5">
										<!--begin::Record-->
										<div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
											<!--begin::Title-->
											<a href="apps/projects/project.html" class="fs-5 text-gray-900 text-hover-primary fw-semibold w-375px min-w-200px">Meeting with customer</a>
											<!--end::Title-->
											<!--begin::Label-->
											<div class="min-w-175px pe-2">
												<span class="badge badge-light text-muted">Application Design</span>
											</div>
											<!--end::Label-->
											<!--begin::Users-->
											<div class="symbol-group symbol-hover flex-nowrap flex-grow-1 min-w-100px pe-2">
												<!--begin::User-->
												<div class="symbol symbol-circle symbol-25px">
													<img src="assets/media/avatars/300-2.jpg" alt="img" />
												</div>
												<!--end::User-->
												<!--begin::User-->
												<div class="symbol symbol-circle symbol-25px">
													<img src="assets/media/avatars/300-14.jpg" alt="img" />
												</div>
												<!--end::User-->
												<!--begin::User-->
												<div class="symbol symbol-circle symbol-25px">
													<div class="symbol-label fs-8 fw-semibold bg-primary text-inverse-primary">A</div>
												</div>
												<!--end::User-->
											</div>
											<!--end::Users-->
											<!--begin::Progress-->
											<div class="min-w-125px pe-2">
												<span class="badge badge-light-primary">In Progress</span>
											</div>
											<!--end::Progress-->
											<!--begin::Action-->
											<a href="apps/projects/project.html" class="btn btn-sm btn-light btn-active-light-primary">View</a>
											<!--end::Action-->
										</div>
										<!--end::Record-->
										<!--begin::Record-->
										<div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-0">
											<!--begin::Title-->
											<a href="apps/projects/project.html" class="fs-5 text-gray-900 text-hover-primary fw-semibold w-375px min-w-200px">Project Delivery Preparation</a>
											<!--end::Title-->
											<!--begin::Label-->
											<div class="min-w-175px">
												<span class="badge badge-light text-muted">CRM System Development</span>
											</div>
											<!--end::Label-->
											<!--begin::Users-->
											<div class="symbol-group symbol-hover flex-nowrap flex-grow-1 min-w-100px">
												<!--begin::User-->
												<div class="symbol symbol-circle symbol-25px">
													<img src="assets/media/avatars/300-20.jpg" alt="img" />
												</div>
												<!--end::User-->
												<!--begin::User-->
												<div class="symbol symbol-circle symbol-25px">
													<div class="symbol-label fs-8 fw-semibold bg-success text-inverse-primary">B</div>
												</div>
												<!--end::User-->
											</div>
											<!--end::Users-->
											<!--begin::Progress-->
											<div class="min-w-125px">
												<span class="badge badge-light-success">Completed</span>
											</div>
											<!--end::Progress-->
											<!--begin::Action-->
											<a href="apps/projects/project.html" class="btn btn-sm btn-light btn-active-light-primary">View</a>
											<!--end::Action-->
										</div>
										<!--end::Record-->
									</div>
									<!--end::Timeline details-->
								</div>
								<!--end::Timeline content-->
							</div>
							<!--end::Timeline item-->
							<!--begin::Timeline item-->
							<div class="timeline-item">
								<!--begin::Timeline line-->
								<div class="timeline-line"></div>
								<!--end::Timeline line-->
								<!--begin::Timeline icon-->
								<div class="timeline-icon me-4">
									<i class="ki-duotone ki-flag fs-2 text-gray-500">
										<span class="path1"></span>
										<span class="path2"></span>
									</i>
								</div>
								<!--end::Timeline icon-->
								<!--begin::Timeline content-->
								<div class="timeline-content mb-10 mt-n2">
									<!--begin::Timeline heading-->
									<div class="overflow-auto pe-3">
										<!--begin::Title-->
										<div class="fs-5 fw-semibold mb-2">Invitation for crafting engaging designs that speak human workshop</div>
										<!--end::Title-->
										<!--begin::Description-->
										<div class="d-flex align-items-center mt-1 fs-6">
											<!--begin::Info-->
											<div class="text-muted me-2 fs-7">Sent at 4:23 PM by</div>
											<!--end::Info-->
											<!--begin::User-->
											<div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Alan Nilson">
												<img src="assets/media/avatars/300-1.jpg" alt="img" />
											</div>
											<!--end::User-->
										</div>
										<!--end::Description-->
									</div>
									<!--end::Timeline heading-->
								</div>
								<!--end::Timeline content-->
							</div>
							<!--end::Timeline item-->
							<!--begin::Timeline item-->
							<div class="timeline-item">
								<!--begin::Timeline line-->
								<div class="timeline-line"></div>
								<!--end::Timeline line-->
								<!--begin::Timeline icon-->
								<div class="timeline-icon">
									<i class="ki-duotone ki-disconnect fs-2 text-gray-500">
										<span class="path1"></span>
										<span class="path2"></span>
										<span class="path3"></span>
										<span class="path4"></span>
										<span class="path5"></span>
									</i>
								</div>
								<!--end::Timeline icon-->
								<!--begin::Timeline content-->
								<div class="timeline-content mb-10 mt-n1">
									<!--begin::Timeline heading-->
									<div class="mb-5 pe-3">
										<!--begin::Title-->
										<a  class="fs-5 fw-semibold text-gray-800 text-hover-primary mb-2">3 New Incoming Project Files:</a>
										<!--end::Title-->
										<!--begin::Description-->
										<div class="d-flex align-items-center mt-1 fs-6">
											<!--begin::Info-->
											<div class="text-muted me-2 fs-7">Sent at 10:30 PM by</div>
											<!--end::Info-->
											<!--begin::User-->
											<div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Jan Hummer">
												<img src="assets/media/avatars/300-23.jpg" alt="img" />
											</div>
											<!--end::User-->
										</div>
										<!--end::Description-->
									</div>
									<!--end::Timeline heading-->
									<!--begin::Timeline details-->
									<div class="overflow-auto pb-5">
										<div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-700px p-5">
											<!--begin::Item-->
											<div class="d-flex flex-aligns-center pe-10 pe-lg-20">
												<!--begin::Icon-->
												<img alt="" class="w-30px me-3" src="assets/media/svg/files/pdf.svg" />
												<!--end::Icon-->
												<!--begin::Info-->
												<div class="ms-1 fw-semibold">
													<!--begin::Desc-->
													<a href="apps/projects/project.html" class="fs-6 text-hover-primary fw-bold">Finance KPI App Guidelines</a>
													<!--end::Desc-->
													<!--begin::Number-->
													<div class="text-gray-500">1.9mb</div>
													<!--end::Number-->
												</div>
												<!--begin::Info-->
											</div>
											<!--end::Item-->
											<!--begin::Item-->
											<div class="d-flex flex-aligns-center pe-10 pe-lg-20">
												<!--begin::Icon-->
												<img alt="apps/projects/project.html" class="w-30px me-3" src="assets/media/svg/files/doc.svg" />
												<!--end::Icon-->
												<!--begin::Info-->
												<div class="ms-1 fw-semibold">
													<!--begin::Desc-->
													<a  class="fs-6 text-hover-primary fw-bold">Client UAT Testing Results</a>
													<!--end::Desc-->
													<!--begin::Number-->
													<div class="text-gray-500">18kb</div>
													<!--end::Number-->
												</div>
												<!--end::Info-->
											</div>
											<!--end::Item-->
											<!--begin::Item-->
											<div class="d-flex flex-aligns-center">
												<!--begin::Icon-->
												<img alt="apps/projects/project.html" class="w-30px me-3" src="assets/media/svg/files/css.svg" />
												<!--end::Icon-->
												<!--begin::Info-->
												<div class="ms-1 fw-semibold">
													<!--begin::Desc-->
													<a  class="fs-6 text-hover-primary fw-bold">Finance Reports</a>
													<!--end::Desc-->
													<!--begin::Number-->
													<div class="text-gray-500">20mb</div>
													<!--end::Number-->
												</div>
												<!--end::Icon-->
											</div>
											<!--end::Item-->
										</div>
									</div>
									<!--end::Timeline details-->
								</div>
								<!--end::Timeline content-->
							</div>
							<!--end::Timeline item-->
							<!--begin::Timeline item-->
							<div class="timeline-item">
								<!--begin::Timeline line-->
								<div class="timeline-line"></div>
								<!--end::Timeline line-->
								<!--begin::Timeline icon-->
								<div class="timeline-icon">
									<i class="ki-duotone ki-abstract-26 fs-2 text-gray-500">
										<span class="path1"></span>
										<span class="path2"></span>
									</i>
								</div>
								<!--end::Timeline icon-->
								<!--begin::Timeline content-->
								<div class="timeline-content mb-10 mt-n1">
									<!--begin::Timeline heading-->
									<div class="pe-3 mb-5">
										<!--begin::Title-->
										<div class="fs-5 fw-semibold mb-2">Task 
										<a  class="text-primary fw-bold me-1">#45890</a>merged with 
										<a  class="text-primary fw-bold me-1">#45890</a>in “Ads Pro Admin Dashboard project:</div>
										<!--end::Title-->
										<!--begin::Description-->
										<div class="d-flex align-items-center mt-1 fs-6">
											<!--begin::Info-->
											<div class="text-muted me-2 fs-7">Initiated at 4:23 PM by</div>
											<!--end::Info-->
											<!--begin::User-->
											<div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Nina Nilson">
												<img src="assets/media/avatars/300-14.jpg" alt="img" />
											</div>
											<!--end::User-->
										</div>
										<!--end::Description-->
									</div>
									<!--end::Timeline heading-->
								</div>
								<!--end::Timeline content-->
							</div>
							<!--end::Timeline item-->
							<!--begin::Timeline item-->
							<div class="timeline-item">
								<!--begin::Timeline line-->
								<div class="timeline-line"></div>
								<!--end::Timeline line-->
								<!--begin::Timeline icon-->
								<div class="timeline-icon">
									<i class="ki-duotone ki-pencil fs-2 text-gray-500">
										<span class="path1"></span>
										<span class="path2"></span>
									</i>
								</div>
								<!--end::Timeline icon-->
								<!--begin::Timeline content-->
								<div class="timeline-content mb-10 mt-n1">
									<!--begin::Timeline heading-->
									<div class="pe-3 mb-5">
										<!--begin::Title-->
										<div class="fs-5 fw-semibold mb-2">3 new application design concepts added:</div>
										<!--end::Title-->
										<!--begin::Description-->
										<div class="d-flex align-items-center mt-1 fs-6">
											<!--begin::Info-->
											<div class="text-muted me-2 fs-7">Created at 4:23 PM by</div>
											<!--end::Info-->
											<!--begin::User-->
											<div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Marcus Dotson">
												<img src="assets/media/avatars/300-2.jpg" alt="img" />
											</div>
											<!--end::User-->
										</div>
										<!--end::Description-->
									</div>
									<!--end::Timeline heading-->
									<!--begin::Timeline details-->
									<div class="overflow-auto pb-5">
										<div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-700px p-7">
											<!--begin::Item-->
											<div class="overlay me-10">
												<!--begin::Image-->
												<div class="overlay-wrapper">
													<img alt="img" class="rounded w-150px" src="assets/media/stock/600x400/img-29.jpg" />
												</div>
												<!--end::Image-->
												<!--begin::Link-->
												<div class="overlay-layer bg-dark bg-opacity-10 rounded">
													<a  class="btn btn-sm btn-primary btn-shadow">Explore</a>
												</div>
												<!--end::Link-->
											</div>
											<!--end::Item-->
											<!--begin::Item-->
											<div class="overlay me-10">
												<!--begin::Image-->
												<div class="overlay-wrapper">
													<img alt="img" class="rounded w-150px" src="assets/media/stock/600x400/img-31.jpg" />
												</div>
												<!--end::Image-->
												<!--begin::Link-->
												<div class="overlay-layer bg-dark bg-opacity-10 rounded">
													<a  class="btn btn-sm btn-primary btn-shadow">Explore</a>
												</div>
												<!--end::Link-->
											</div>
											<!--end::Item-->
											<!--begin::Item-->
											<div class="overlay">
												<!--begin::Image-->
												<div class="overlay-wrapper">
													<img alt="img" class="rounded w-150px" src="assets/media/stock/600x400/img-40.jpg" />
												</div>
												<!--end::Image-->
												<!--begin::Link-->
												<div class="overlay-layer bg-dark bg-opacity-10 rounded">
													<a  class="btn btn-sm btn-primary btn-shadow">Explore</a>
												</div>
												<!--end::Link-->
											</div>
											<!--end::Item-->
										</div>
									</div>
									<!--end::Timeline details-->
								</div>
								<!--end::Timeline content-->
							</div>
							<!--end::Timeline item-->
							<!--begin::Timeline item-->
							<div class="timeline-item">
								<!--begin::Timeline line-->
								<div class="timeline-line"></div>
								<!--end::Timeline line-->
								<!--begin::Timeline icon-->
								<div class="timeline-icon">
									<i class="ki-duotone ki-sms fs-2 text-gray-500">
										<span class="path1"></span>
										<span class="path2"></span>
									</i>
								</div>
								<!--end::Timeline icon-->
								<!--begin::Timeline content-->
								<div class="timeline-content mb-10 mt-n1">
									<!--begin::Timeline heading-->
									<div class="pe-3 mb-5">
										<!--begin::Title-->
										<div class="fs-5 fw-semibold mb-2">New case 
										<a  class="text-primary fw-bold me-1">#67890</a>is assigned to you in Multi-platform Database Design project</div>
										<!--end::Title-->
										<!--begin::Description-->
										<div class="overflow-auto pb-5">
											<!--begin::Wrapper-->
											<div class="d-flex align-items-center mt-1 fs-6">
												<!--begin::Info-->
												<div class="text-muted me-2 fs-7">Added at 4:23 PM by</div>
												<!--end::Info-->
												<!--begin::User-->
												<a  class="text-primary fw-bold me-1">Alice Tan</a>
												<!--end::User-->
											</div>
											<!--end::Wrapper-->
										</div>
										<!--end::Description-->
									</div>
									<!--end::Timeline heading-->
								</div>
								<!--end::Timeline content-->
							</div>
							<!--end::Timeline item-->
							<!--begin::Timeline item-->
							<div class="timeline-item">
								<!--begin::Timeline line-->
								<div class="timeline-line"></div>
								<!--end::Timeline line-->
								<!--begin::Timeline icon-->
								<div class="timeline-icon">
									<i class="ki-duotone ki-pencil fs-2 text-gray-500">
										<span class="path1"></span>
										<span class="path2"></span>
									</i>
								</div>
								<!--end::Timeline icon-->
								<!--begin::Timeline content-->
								<div class="timeline-content mb-10 mt-n1">
									<!--begin::Timeline heading-->
									<div class="pe-3 mb-5">
										<!--begin::Title-->
										<div class="fs-5 fw-semibold mb-2">You have received a new order:</div>
										<!--end::Title-->
										<!--begin::Description-->
										<div class="d-flex align-items-center mt-1 fs-6">
											<!--begin::Info-->
											<div class="text-muted me-2 fs-7">Placed at 5:05 AM by</div>
											<!--end::Info-->
											<!--begin::User-->
											<div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Robert Rich">
												<img src="assets/media/avatars/300-4.jpg" alt="img" />
											</div>
											<!--end::User-->
										</div>
										<!--end::Description-->
									</div>
									<!--end::Timeline heading-->
									<!--begin::Timeline details-->
									<div class="overflow-auto pb-5">
										<!--begin::Notice-->
										<div class="notice d-flex bg-light-primary rounded border-primary border border-dashed min-w-lg-600px flex-shrink-0 p-6">
											<!--begin::Icon-->
											<i class="ki-duotone ki-devices-2 fs-2tx text-primary me-4">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
											</i>
											<!--end::Icon-->
											<!--begin::Wrapper-->
											<div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
												<!--begin::Content-->
												<div class="mb-3 mb-md-0 fw-semibold">
													<h4 class="text-gray-900 fw-bold">Database Backup Process Completed!</h4>
													<div class="fs-6 text-gray-700 pe-7">Login into Admin Dashboard to make sure the data integrity is OK</div>
												</div>
												<!--end::Content-->
												<!--begin::Action-->
												<a  class="btn btn-primary px-6 align-self-center text-nowrap">Proceed</a>
												<!--end::Action-->
											</div>
											<!--end::Wrapper-->
										</div>
										<!--end::Notice-->
									</div>
									<!--end::Timeline details-->
								</div>
								<!--end::Timeline content-->
							</div>
							<!--end::Timeline item-->
							<!--begin::Timeline item-->
							<div class="timeline-item">
								<!--begin::Timeline line-->
								<div class="timeline-line"></div>
								<!--end::Timeline line-->
								<!--begin::Timeline icon-->
								<div class="timeline-icon">
									<i class="ki-duotone ki-basket fs-2 text-gray-500">
										<span class="path1"></span>
										<span class="path2"></span>
										<span class="path3"></span>
										<span class="path4"></span>
									</i>
								</div>
								<!--end::Timeline icon-->
								<!--begin::Timeline content-->
								<div class="timeline-content mt-n1">
									<!--begin::Timeline heading-->
									<div class="pe-3 mb-5">
										<!--begin::Title-->
										<div class="fs-5 fw-semibold mb-2">New order 
										<a  class="text-primary fw-bold me-1">#67890</a>is placed for Workshow Planning & Budget Estimation</div>
										<!--end::Title-->
										<!--begin::Description-->
										<div class="d-flex align-items-center mt-1 fs-6">
											<!--begin::Info-->
											<div class="text-muted me-2 fs-7">Placed at 4:23 PM by</div>
											<!--end::Info-->
											<!--begin::User-->
											<a  class="text-primary fw-bold me-1">Jimmy Bold</a>
											<!--end::User-->
										</div>
										<!--end::Description-->
									</div>
									<!--end::Timeline heading-->
								</div>
								<!--end::Timeline content-->
							</div>
							<!--end::Timeline item-->
						</div>
						<!--end::Timeline items-->
					</div>
					<!--end::Content-->
				</div>
				<!--end::Body-->
				<!--begin::Footer-->
				<div class="card-footer py-5 text-center" id="kt_activities_footer">
					<a href="pages/user-profile/activity.html" class="btn btn-bg-body text-primary">View All Activities 
					<i class="ki-duotone ki-arrow-right fs-3 text-primary">
						<span class="path1"></span>
						<span class="path2"></span>
					</i></a>
				</div>
				<!--end::Footer-->
			</div>
		</div>
		<!--end::Activities drawer-->
		<!--begin::Chat drawer-->
		<div id="kt_drawer_chat" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="chat" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'md': '500px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_drawer_chat_toggle" data-kt-drawer-close="#kt_drawer_chat_close">
			<!--begin::Messenger-->
			<div class="card w-100 border-0 rounded-0" id="kt_drawer_chat_messenger">
				<!--begin::Card header-->
				<div class="card-header pe-5" id="kt_drawer_chat_messenger_header">
					<!--begin::Title-->
					<div class="card-title">
						<!--begin::User-->
						<div class="d-flex justify-content-center flex-column me-3">
							<a  class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Brian Cox</a>
							<!--begin::Info-->
							<div class="mb-0 lh-1">
								<span class="badge badge-success badge-circle w-10px h-10px me-1"></span>
								<span class="fs-7 fw-semibold text-muted">Active</span>
							</div>
							<!--end::Info-->
						</div>
						<!--end::User-->
					</div>
					<!--end::Title-->
					<!--begin::Card toolbar-->
					<div class="card-toolbar">
						<!--begin::Menu-->
						<div class="me-0">
							<button class="btn btn-sm btn-icon btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
								<i class="ki-duotone ki-dots-square fs-2">
									<span class="path1"></span>
									<span class="path2"></span>
									<span class="path3"></span>
									<span class="path4"></span>
								</i>
							</button>
							<!--begin::Menu 3-->
							<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
								<!--begin::Heading-->
								<div class="menu-item px-3">
									<div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Contacts</div>
								</div>
								<!--end::Heading-->
								<!--begin::Menu item-->
								<div class="menu-item px-3">
									<a  class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_users_search">Add Contact</a>
								</div>
								<!--end::Menu item-->
								<!--begin::Menu item-->
								<div class="menu-item px-3">
									<a  class="menu-link flex-stack px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">Invite Contacts 
									<span class="ms-2" data-bs-toggle="tooltip" title="Specify a contact email to send an invitation">
										<i class="ki-duotone ki-information fs-7">
											<span class="path1"></span>
											<span class="path2"></span>
											<span class="path3"></span>
										</i>
									</span></a>
								</div>
								<!--end::Menu item-->
								<!--begin::Menu item-->
								<div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
									<a  class="menu-link px-3">
										<span class="menu-title">Groups</span>
										<span class="menu-arrow"></span>
									</a>
									<!--begin::Menu sub-->
									<div class="menu-sub menu-sub-dropdown w-175px py-4">
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<a  class="menu-link px-3" data-bs-toggle="tooltip" title="Coming soon">Create Group</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<a  class="menu-link px-3" data-bs-toggle="tooltip" title="Coming soon">Invite Members</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<a  class="menu-link px-3" data-bs-toggle="tooltip" title="Coming soon">Settings</a>
										</div>
										<!--end::Menu item-->
									</div>
									<!--end::Menu sub-->
								</div>
								<!--end::Menu item-->
								<!--begin::Menu item-->
								<div class="menu-item px-3 my-1">
									<a  class="menu-link px-3" data-bs-toggle="tooltip" title="Coming soon">Settings</a>
								</div>
								<!--end::Menu item-->
							</div>
							<!--end::Menu 3-->
						</div>
						<!--end::Menu-->
						<!--begin::Close-->
						<div class="btn btn-sm btn-icon btn-active-color-primary" id="kt_drawer_chat_close">
							<i class="ki-duotone ki-cross-square fs-2">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</div>
						<!--end::Close-->
					</div>
					<!--end::Card toolbar-->
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
				<div class="card-body" id="kt_drawer_chat_messenger_body">
					<!--begin::Messages-->
					<div class="scroll-y me-n5 pe-5" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_drawer_chat_messenger_header, #kt_drawer_chat_messenger_footer" data-kt-scroll-wrappers="#kt_drawer_chat_messenger_body" data-kt-scroll-offset="0px">
						<!--begin::Message(in)-->
						<div class="d-flex justify-content-start mb-10">
							<!--begin::Wrapper-->
							<div class="d-flex flex-column align-items-start">
								<!--begin::User-->
								<div class="d-flex align-items-center mb-2">
									<!--begin::Avatar-->
									<div class="symbol symbol-35px symbol-circle">
										<img alt="Pic" src="assets/media/avatars/300-25.jpg" />
									</div>
									<!--end::Avatar-->
									<!--begin::Details-->
									<div class="ms-3">
										<a  class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">Brian Cox</a>
										<span class="text-muted fs-7 mb-1">2 mins</span>
									</div>
									<!--end::Details-->
								</div>
								<!--end::User-->
								<!--begin::Text-->
								<div class="p-5 rounded bg-light-info text-gray-900 fw-semibold mw-lg-400px text-start" data-kt-element="message-text">How likely are you to recommend our company to your friends and family ?</div>
								<!--end::Text-->
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Message(in)-->
						<!--begin::Message(out)-->
						<div class="d-flex justify-content-end mb-10">
							<!--begin::Wrapper-->
							<div class="d-flex flex-column align-items-end">
								<!--begin::User-->
								<div class="d-flex align-items-center mb-2">
									<!--begin::Details-->
									<div class="me-3">
										<span class="text-muted fs-7 mb-1">5 mins</span>
										<a  class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a>
									</div>
									<!--end::Details-->
									<!--begin::Avatar-->
									<div class="symbol symbol-35px symbol-circle">
										<img alt="Pic" src="assets/media/avatars/300-1.jpg" />
									</div>
									<!--end::Avatar-->
								</div>
								<!--end::User-->
								<!--begin::Text-->
								<div class="p-5 rounded bg-light-primary text-gray-900 fw-semibold mw-lg-400px text-end" data-kt-element="message-text">Hey there, we’re just writing to let you know that you’ve been subscribed to a repository on GitHub.</div>
								<!--end::Text-->
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Message(out)-->
						<!--begin::Message(in)-->
						<div class="d-flex justify-content-start mb-10">
							<!--begin::Wrapper-->
							<div class="d-flex flex-column align-items-start">
								<!--begin::User-->
								<div class="d-flex align-items-center mb-2">
									<!--begin::Avatar-->
									<div class="symbol symbol-35px symbol-circle">
										<img alt="Pic" src="assets/media/avatars/300-25.jpg" />
									</div>
									<!--end::Avatar-->
									<!--begin::Details-->
									<div class="ms-3">
										<a  class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">Brian Cox</a>
										<span class="text-muted fs-7 mb-1">1 Hour</span>
									</div>
									<!--end::Details-->
								</div>
								<!--end::User-->
								<!--begin::Text-->
								<div class="p-5 rounded bg-light-info text-gray-900 fw-semibold mw-lg-400px text-start" data-kt-element="message-text">Ok, Understood!</div>
								<!--end::Text-->
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Message(in)-->
						<!--begin::Message(out)-->
						<div class="d-flex justify-content-end mb-10">
							<!--begin::Wrapper-->
							<div class="d-flex flex-column align-items-end">
								<!--begin::User-->
								<div class="d-flex align-items-center mb-2">
									<!--begin::Details-->
									<div class="me-3">
										<span class="text-muted fs-7 mb-1">2 Hours</span>
										<a  class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a>
									</div>
									<!--end::Details-->
									<!--begin::Avatar-->
									<div class="symbol symbol-35px symbol-circle">
										<img alt="Pic" src="assets/media/avatars/300-1.jpg" />
									</div>
									<!--end::Avatar-->
								</div>
								<!--end::User-->
								<!--begin::Text-->
								<div class="p-5 rounded bg-light-primary text-gray-900 fw-semibold mw-lg-400px text-end" data-kt-element="message-text">You’ll receive notifications for all issues, pull requests!</div>
								<!--end::Text-->
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Message(out)-->
						<!--begin::Message(in)-->
						<div class="d-flex justify-content-start mb-10">
							<!--begin::Wrapper-->
							<div class="d-flex flex-column align-items-start">
								<!--begin::User-->
								<div class="d-flex align-items-center mb-2">
									<!--begin::Avatar-->
									<div class="symbol symbol-35px symbol-circle">
										<img alt="Pic" src="assets/media/avatars/300-25.jpg" />
									</div>
									<!--end::Avatar-->
									<!--begin::Details-->
									<div class="ms-3">
										<a  class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">Brian Cox</a>
										<span class="text-muted fs-7 mb-1">3 Hours</span>
									</div>
									<!--end::Details-->
								</div>
								<!--end::User-->
								<!--begin::Text-->
								<div class="p-5 rounded bg-light-info text-gray-900 fw-semibold mw-lg-400px text-start" data-kt-element="message-text">You can unwatch this repository immediately by clicking here: 
								<a href="https://keenthemes.com">Keenthemes.com</a></div>
								<!--end::Text-->
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Message(in)-->
						<!--begin::Message(out)-->
						<div class="d-flex justify-content-end mb-10">
							<!--begin::Wrapper-->
							<div class="d-flex flex-column align-items-end">
								<!--begin::User-->
								<div class="d-flex align-items-center mb-2">
									<!--begin::Details-->
									<div class="me-3">
										<span class="text-muted fs-7 mb-1">4 Hours</span>
										<a  class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a>
									</div>
									<!--end::Details-->
									<!--begin::Avatar-->
									<div class="symbol symbol-35px symbol-circle">
										<img alt="Pic" src="assets/media/avatars/300-1.jpg" />
									</div>
									<!--end::Avatar-->
								</div>
								<!--end::User-->
								<!--begin::Text-->
								<div class="p-5 rounded bg-light-primary text-gray-900 fw-semibold mw-lg-400px text-end" data-kt-element="message-text">Most purchased Business courses during this sale!</div>
								<!--end::Text-->
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Message(out)-->
						<!--begin::Message(in)-->
						<div class="d-flex justify-content-start mb-10">
							<!--begin::Wrapper-->
							<div class="d-flex flex-column align-items-start">
								<!--begin::User-->
								<div class="d-flex align-items-center mb-2">
									<!--begin::Avatar-->
									<div class="symbol symbol-35px symbol-circle">
										<img alt="Pic" src="assets/media/avatars/300-25.jpg" />
									</div>
									<!--end::Avatar-->
									<!--begin::Details-->
									<div class="ms-3">
										<a  class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">Brian Cox</a>
										<span class="text-muted fs-7 mb-1">5 Hours</span>
									</div>
									<!--end::Details-->
								</div>
								<!--end::User-->
								<!--begin::Text-->
								<div class="p-5 rounded bg-light-info text-gray-900 fw-semibold mw-lg-400px text-start" data-kt-element="message-text">Company BBQ to celebrate the last quater achievements and goals. Food and drinks provided</div>
								<!--end::Text-->
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Message(in)-->
						<!--begin::Message(template for out)-->
						<div class="d-flex justify-content-end mb-10 d-none" data-kt-element="template-out">
							<!--begin::Wrapper-->
							<div class="d-flex flex-column align-items-end">
								<!--begin::User-->
								<div class="d-flex align-items-center mb-2">
									<!--begin::Details-->
									<div class="me-3">
										<span class="text-muted fs-7 mb-1">Just now</span>
										<a  class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a>
									</div>
									<!--end::Details-->
									<!--begin::Avatar-->
									<div class="symbol symbol-35px symbol-circle">
										<img alt="Pic" src="assets/media/avatars/300-1.jpg" />
									</div>
									<!--end::Avatar-->
								</div>
								<!--end::User-->
								<!--begin::Text-->
								<div class="p-5 rounded bg-light-primary text-gray-900 fw-semibold mw-lg-400px text-end" data-kt-element="message-text"></div>
								<!--end::Text-->
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Message(template for out)-->
						<!--begin::Message(template for in)-->
						<div class="d-flex justify-content-start mb-10 d-none" data-kt-element="template-in">
							<!--begin::Wrapper-->
							<div class="d-flex flex-column align-items-start">
								<!--begin::User-->
								<div class="d-flex align-items-center mb-2">
									<!--begin::Avatar-->
									<div class="symbol symbol-35px symbol-circle">
										<img alt="Pic" src="assets/media/avatars/300-25.jpg" />
									</div>
									<!--end::Avatar-->
									<!--begin::Details-->
									<div class="ms-3">
										<a  class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">Brian Cox</a>
										<span class="text-muted fs-7 mb-1">Just now</span>
									</div>
									<!--end::Details-->
								</div>
								<!--end::User-->
								<!--begin::Text-->
								<div class="p-5 rounded bg-light-info text-gray-900 fw-semibold mw-lg-400px text-start" data-kt-element="message-text">Right before vacation season we have the next Big Deal for you.</div>
								<!--end::Text-->
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Message(template for in)-->
					</div>
					<!--end::Messages-->
				</div>
				<!--end::Card body-->
				<!--begin::Card footer-->
				<div class="card-footer pt-4" id="kt_drawer_chat_messenger_footer">
					<!--begin::Input-->
					<textarea class="form-control form-control-flush mb-3" rows="1" data-kt-element="input" placeholder="Type a message"></textarea>
					<!--end::Input-->
					<!--begin:Toolbar-->
					<div class="d-flex flex-stack">
						<!--begin::Actions-->
						<div class="d-flex align-items-center me-2">
							<button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" title="Coming soon">
								<i class="ki-duotone ki-paper-clip fs-3"></i>
							</button>
							<button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" title="Coming soon">
								<i class="ki-duotone ki-cloud-add fs-3">
									<span class="path1"></span>
									<span class="path2"></span>
								</i>
							</button>
						</div>
						<!--end::Actions-->
						<!--begin::Send-->
						<button class="btn btn-primary" type="button" data-kt-element="send">Send</button>
						<!--end::Send-->
					</div>
					<!--end::Toolbar-->
				</div>
				<!--end::Card footer-->
			</div>
			<!--end::Messenger-->
		</div>
		<!--end::Chat drawer-->
		<!--begin::Chat drawer-->
		<div id="kt_shopping_cart" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="cart" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'md': '500px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_drawer_shopping_cart_toggle" data-kt-drawer-close="#kt_drawer_shopping_cart_close">
			<!--begin::Messenger-->
			<div class="card card-flush w-100 rounded-0">
				<!--begin::Card header-->
				<div class="card-header">
					<!--begin::Title-->
					<h3 class="card-title text-gray-900 fw-bold">Shopping Cart</h3>
					<!--end::Title-->
					<!--begin::Card toolbar-->
					<div class="card-toolbar">
						<!--begin::Close-->
						<div class="btn btn-sm btn-icon btn-active-light-primary" id="kt_drawer_shopping_cart_close">
							<i class="ki-duotone ki-cross fs-2">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</div>
						<!--end::Close-->
					</div>
					<!--end::Card toolbar-->
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
				<div class="card-body hover-scroll-overlay-y h-400px pt-5">
					<!--begin::Item-->
					<div class="d-flex flex-stack">
						<!--begin::Wrapper-->
						<div class="d-flex flex-column me-3">
							<!--begin::Section-->
							<div class="mb-3">
								<a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-4 fw-bold">Iblender</a>
								<span class="text-gray-500 fw-semibold d-block">The best kitchen gadget in 2022</span>
							</div>
							<!--end::Section-->
							<!--begin::Section-->
							<div class="d-flex align-items-center">
								<span class="fw-bold text-gray-800 fs-5">$ 350</span>
								<span class="text-muted mx-2">for</span>
								<span class="fw-bold text-gray-800 fs-5 me-3">5</span>
								<a  class="btn btn-sm btn-light-success btn-icon-success btn-icon w-25px h-25px me-2">
									<i class="ki-duotone ki-minus fs-4"></i>
								</a>
								<a  class="btn btn-sm btn-light-success btn-icon w-25px h-25px">
									<i class="ki-duotone ki-plus fs-4"></i>
								</a>
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Wrapper-->
						<!--begin::Pic-->
						<div class="symbol symbol-70px symbol-2by3 flex-shrink-0">
							<img src="assets/media/stock/600x400/img-1.jpg" alt="" />
						</div>
						<!--end::Pic-->
					</div>
					<!--end::Item-->
					<!--begin::Separator-->
					<div class="separator separator-dashed my-6"></div>
					<!--end::Separator-->
					<!--begin::Item-->
					<div class="d-flex flex-stack">
						<!--begin::Wrapper-->
						<div class="d-flex flex-column me-3">
							<!--begin::Section-->
							<div class="mb-3">
								<a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-4 fw-bold">SmartCleaner</a>
								<span class="text-gray-500 fw-semibold d-block">Smart tool for cooking</span>
							</div>
							<!--end::Section-->
							<!--begin::Section-->
							<div class="d-flex align-items-center">
								<span class="fw-bold text-gray-800 fs-5">$ 650</span>
								<span class="text-muted mx-2">for</span>
								<span class="fw-bold text-gray-800 fs-5 me-3">4</span>
								<a  class="btn btn-sm btn-light-success btn-icon-success btn-icon w-25px h-25px me-2">
									<i class="ki-duotone ki-minus fs-4"></i>
								</a>
								<a  class="btn btn-sm btn-light-success btn-icon w-25px h-25px">
									<i class="ki-duotone ki-plus fs-4"></i>
								</a>
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Wrapper-->
						<!--begin::Pic-->
						<div class="symbol symbol-70px symbol-2by3 flex-shrink-0">
							<img src="assets/media/stock/600x400/img-3.jpg" alt="" />
						</div>
						<!--end::Pic-->
					</div>
					<!--end::Item-->
					<!--begin::Separator-->
					<div class="separator separator-dashed my-6"></div>
					<!--end::Separator-->
					<!--begin::Item-->
					<div class="d-flex flex-stack">
						<!--begin::Wrapper-->
						<div class="d-flex flex-column me-3">
							<!--begin::Section-->
							<div class="mb-3">
								<a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-4 fw-bold">CameraMaxr</a>
								<span class="text-gray-500 fw-semibold d-block">Professional camera for edge</span>
							</div>
							<!--end::Section-->
							<!--begin::Section-->
							<div class="d-flex align-items-center">
								<span class="fw-bold text-gray-800 fs-5">$ 150</span>
								<span class="text-muted mx-2">for</span>
								<span class="fw-bold text-gray-800 fs-5 me-3">3</span>
								<a  class="btn btn-sm btn-light-success btn-icon-success btn-icon w-25px h-25px me-2">
									<i class="ki-duotone ki-minus fs-4"></i>
								</a>
								<a  class="btn btn-sm btn-light-success btn-icon w-25px h-25px">
									<i class="ki-duotone ki-plus fs-4"></i>
								</a>
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Wrapper-->
						<!--begin::Pic-->
						<div class="symbol symbol-70px symbol-2by3 flex-shrink-0">
							<img src="assets/media/stock/600x400/img-8.jpg" alt="" />
						</div>
						<!--end::Pic-->
					</div>
					<!--end::Item-->
					<!--begin::Separator-->
					<div class="separator separator-dashed my-6"></div>
					<!--end::Separator-->
					<!--begin::Item-->
					<div class="d-flex flex-stack">
						<!--begin::Wrapper-->
						<div class="d-flex flex-column me-3">
							<!--begin::Section-->
							<div class="mb-3">
								<a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-4 fw-bold">$D Printer</a>
								<span class="text-gray-500 fw-semibold d-block">Manfactoring unique objekts</span>
							</div>
							<!--end::Section-->
							<!--begin::Section-->
							<div class="d-flex align-items-center">
								<span class="fw-bold text-gray-800 fs-5">$ 1450</span>
								<span class="text-muted mx-2">for</span>
								<span class="fw-bold text-gray-800 fs-5 me-3">7</span>
								<a  class="btn btn-sm btn-light-success btn-icon-success btn-icon w-25px h-25px me-2">
									<i class="ki-duotone ki-minus fs-4"></i>
								</a>
								<a  class="btn btn-sm btn-light-success btn-icon w-25px h-25px">
									<i class="ki-duotone ki-plus fs-4"></i>
								</a>
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Wrapper-->
						<!--begin::Pic-->
						<div class="symbol symbol-70px symbol-2by3 flex-shrink-0">
							<img src="assets/media/stock/600x400/img-26.jpg" alt="" />
						</div>
						<!--end::Pic-->
					</div>
					<!--end::Item-->
					<!--begin::Separator-->
					<div class="separator separator-dashed my-6"></div>
					<!--end::Separator-->
					<!--begin::Item-->
					<div class="d-flex flex-stack">
						<!--begin::Wrapper-->
						<div class="d-flex flex-column me-3">
							<!--begin::Section-->
							<div class="mb-3">
								<a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-4 fw-bold">MotionWire</a>
								<span class="text-gray-500 fw-semibold d-block">Perfect animation tool</span>
							</div>
							<!--end::Section-->
							<!--begin::Section-->
							<div class="d-flex align-items-center">
								<span class="fw-bold text-gray-800 fs-5">$ 650</span>
								<span class="text-muted mx-2">for</span>
								<span class="fw-bold text-gray-800 fs-5 me-3">7</span>
								<a  class="btn btn-sm btn-light-success btn-icon-success btn-icon w-25px h-25px me-2">
									<i class="ki-duotone ki-minus fs-4"></i>
								</a>
								<a  class="btn btn-sm btn-light-success btn-icon w-25px h-25px">
									<i class="ki-duotone ki-plus fs-4"></i>
								</a>
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Wrapper-->
						<!--begin::Pic-->
						<div class="symbol symbol-70px symbol-2by3 flex-shrink-0">
							<img src="assets/media/stock/600x400/img-21.jpg" alt="" />
						</div>
						<!--end::Pic-->
					</div>
					<!--end::Item-->
					<!--begin::Separator-->
					<div class="separator separator-dashed my-6"></div>
					<!--end::Separator-->
					<!--begin::Item-->
					<div class="d-flex flex-stack">
						<!--begin::Wrapper-->
						<div class="d-flex flex-column me-3">
							<!--begin::Section-->
							<div class="mb-3">
								<a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-4 fw-bold">Samsung</a>
								<span class="text-gray-500 fw-semibold d-block">Profile info,Timeline etc</span>
							</div>
							<!--end::Section-->
							<!--begin::Section-->
							<div class="d-flex align-items-center">
								<span class="fw-bold text-gray-800 fs-5">$ 720</span>
								<span class="text-muted mx-2">for</span>
								<span class="fw-bold text-gray-800 fs-5 me-3">6</span>
								<a  class="btn btn-sm btn-light-success btn-icon-success btn-icon w-25px h-25px me-2">
									<i class="ki-duotone ki-minus fs-4"></i>
								</a>
								<a  class="btn btn-sm btn-light-success btn-icon w-25px h-25px">
									<i class="ki-duotone ki-plus fs-4"></i>
								</a>
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Wrapper-->
						<!--begin::Pic-->
						<div class="symbol symbol-70px symbol-2by3 flex-shrink-0">
							<img src="assets/media/stock/600x400/img-34.jpg" alt="" />
						</div>
						<!--end::Pic-->
					</div>
					<!--end::Item-->
					<!--begin::Separator-->
					<div class="separator separator-dashed my-6"></div>
					<!--end::Separator-->
					<!--begin::Item-->
					<div class="d-flex flex-stack">
						<!--begin::Wrapper-->
						<div class="d-flex flex-column me-3">
							<!--begin::Section-->
							<div class="mb-3">
								<a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-4 fw-bold">$D Printer</a>
								<span class="text-gray-500 fw-semibold d-block">Manfactoring unique objekts</span>
							</div>
							<!--end::Section-->
							<!--begin::Section-->
							<div class="d-flex align-items-center">
								<span class="fw-bold text-gray-800 fs-5">$ 430</span>
								<span class="text-muted mx-2">for</span>
								<span class="fw-bold text-gray-800 fs-5 me-3">8</span>
								<a  class="btn btn-sm btn-light-success btn-icon-success btn-icon w-25px h-25px me-2">
									<i class="ki-duotone ki-minus fs-4"></i>
								</a>
								<a  class="btn btn-sm btn-light-success btn-icon w-25px h-25px">
									<i class="ki-duotone ki-plus fs-4"></i>
								</a>
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Wrapper-->
						<!--begin::Pic-->
						<div class="symbol symbol-70px symbol-2by3 flex-shrink-0">
							<img src="assets/media/stock/600x400/img-27.jpg" alt="" />
						</div>
						<!--end::Pic-->
					</div>
					<!--end::Item-->
				</div>
				<!--end::Card body-->
				<!--begin::Card footer-->
				<div class="card-footer">
					<!--begin::Item-->
					<div class="d-flex flex-stack">
						<span class="fw-bold text-gray-600">Total</span>
						<span class="text-gray-800 fw-bolder fs-5">$ 1840.00</span>
					</div>
					<!--end::Item-->
					<!--begin::Item-->
					<div class="d-flex flex-stack">
						<span class="fw-bold text-gray-600">Sub total</span>
						<span class="text-primary fw-bolder fs-5">$ 246.35</span>
					</div>
					<!--end::Item-->
					<!--end::Action-->
					<div class="d-flex justify-content-end mt-9">
						<a  class="btn btn-primary d-flex justify-content-end">Pleace Order</a>
					</div>
					<!--end::Action-->
				</div>
				<!--end::Card footer-->
			</div>
			<!--end::Messenger-->
		</div>
		<!--end::Chat drawer-->
		<!--end::Drawers-->
		<!--end::Main-->
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<i class="ki-duotone ki-arrow-up">
				<span class="path1"></span>
				<span class="path2"></span>
			</i>
		</div>
		<!--end::Scrolltop-->
		<!--begin::Modals-->
		<!--begin::Modal - Upgrade plan-->
		<div class="modal fade" id="kt_modal_upgrade_plan" tabindex="-1" aria-hidden="true">
			<!--begin::Modal dialog-->
			<div class="modal-dialog modal-xl">
				<!--begin::Modal content-->
				<div class="modal-content rounded">
					<!--begin::Modal header-->
					<div class="modal-header justify-content-end border-0 pb-0">
						<!--begin::Close-->
						<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
							<i class="ki-duotone ki-cross fs-1">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</div>
						<!--end::Close-->
					</div>
					<!--end::Modal header-->
					<!--begin::Modal body-->
					<div class="modal-body pt-0 pb-15 px-5 px-xl-20">
						<!--begin::Heading-->
						<div class="mb-13 text-center">
							<h1 class="mb-3">Upgrade a Plan</h1>
							<div class="text-muted fw-semibold fs-5">If you need more info, please check 
							<a  class="link-primary fw-bold">Pricing Guidelines</a>.</div>
						</div>
						<!--end::Heading-->
						<!--begin::Plans-->
						<div class="d-flex flex-column">
							<!--begin::Nav group-->
							<div class="nav-group nav-group-outline mx-auto" data-kt-buttons="true">
								<button class="btn btn-color-gray-500 btn-active btn-active-secondary px-6 py-3 me-2 active" data-kt-plan="month">Monthly</button>
								<button class="btn btn-color-gray-500 btn-active btn-active-secondary px-6 py-3" data-kt-plan="annual">Annual</button>
							</div>
							<!--end::Nav group-->
							<!--begin::Row-->
							<div class="row mt-10">
								<!--begin::Col-->
								<div class="col-lg-6 mb-10 mb-lg-0">
									<!--begin::Tabs-->
									<div class="nav flex-column">
										<!--begin::Tab link-->
										<label class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 active mb-6" data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_startup">
											<!--end::Description-->
											<div class="d-flex align-items-center me-2">
												<!--begin::Radio-->
												<div class="form-check form-check-custom form-check-solid form-check-success flex-shrink-0 me-6">
													<input class="form-check-input" type="radio" name="plan" checked="checked" value="startup" />
												</div>
												<!--end::Radio-->
												<!--begin::Info-->
												<div class="flex-grow-1">
													<div class="d-flex align-items-center fs-2 fw-bold flex-wrap">Startup</div>
													<div class="fw-semibold opacity-75">Best for startups</div>
												</div>
												<!--end::Info-->
											</div>
											<!--end::Description-->
											<!--begin::Price-->
											<div class="ms-5">
												<span class="mb-2">$</span>
												<span class="fs-3x fw-bold" data-kt-plan-price-month="39" data-kt-plan-price-annual="399">39</span>
												<span class="fs-7 opacity-50">/ 
												<span data-kt-element="period">Mon</span></span>
											</div>
											<!--end::Price-->
										</label>
										<!--end::Tab link-->
										<!--begin::Tab link-->
										<label class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_advanced">
											<!--end::Description-->
											<div class="d-flex align-items-center me-2">
												<!--begin::Radio-->
												<div class="form-check form-check-custom form-check-solid form-check-success flex-shrink-0 me-6">
													<input class="form-check-input" type="radio" name="plan" value="advanced" />
												</div>
												<!--end::Radio-->
												<!--begin::Info-->
												<div class="flex-grow-1">
													<div class="d-flex align-items-center fs-2 fw-bold flex-wrap">Advanced</div>
													<div class="fw-semibold opacity-75">Best for 100+ team size</div>
												</div>
												<!--end::Info-->
											</div>
											<!--end::Description-->
											<!--begin::Price-->
											<div class="ms-5">
												<span class="mb-2">$</span>
												<span class="fs-3x fw-bold" data-kt-plan-price-month="339" data-kt-plan-price-annual="3399">339</span>
												<span class="fs-7 opacity-50">/ 
												<span data-kt-element="period">Mon</span></span>
											</div>
											<!--end::Price-->
										</label>
										<!--end::Tab link-->
										<!--begin::Tab link-->
										<label class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_enterprise">
											<!--end::Description-->
											<div class="d-flex align-items-center me-2">
												<!--begin::Radio-->
												<div class="form-check form-check-custom form-check-solid form-check-success flex-shrink-0 me-6">
													<input class="form-check-input" type="radio" name="plan" value="enterprise" />
												</div>
												<!--end::Radio-->
												<!--begin::Info-->
												<div class="flex-grow-1">
													<div class="d-flex align-items-center fs-2 fw-bold flex-wrap">Enterprise 
													<span class="badge badge-light-success ms-2 py-2 px-3 fs-7">Popular</span></div>
													<div class="fw-semibold opacity-75">Best value for 1000+ team</div>
												</div>
												<!--end::Info-->
											</div>
											<!--end::Description-->
											<!--begin::Price-->
											<div class="ms-5">
												<span class="mb-2">$</span>
												<span class="fs-3x fw-bold" data-kt-plan-price-month="999" data-kt-plan-price-annual="9999">999</span>
												<span class="fs-7 opacity-50">/ 
												<span data-kt-element="period">Mon</span></span>
											</div>
											<!--end::Price-->
										</label>
										<!--end::Tab link-->
										<!--begin::Tab link-->
										<label class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_custom">
											<!--end::Description-->
											<div class="d-flex align-items-center me-2">
												<!--begin::Radio-->
												<div class="form-check form-check-custom form-check-solid form-check-success flex-shrink-0 me-6">
													<input class="form-check-input" type="radio" name="plan" value="custom" />
												</div>
												<!--end::Radio-->
												<!--begin::Info-->
												<div class="flex-grow-1">
													<div class="d-flex align-items-center fs-2 fw-bold flex-wrap">Custom</div>
													<div class="fw-semibold opacity-75">Requet a custom license</div>
												</div>
												<!--end::Info-->
											</div>
											<!--end::Description-->
											<!--begin::Price-->
											<div class="ms-5">
												<a  class="btn btn-sm btn-success">Contact Us</a>
											</div>
											<!--end::Price-->
										</label>
										<!--end::Tab link-->
									</div>
									<!--end::Tabs-->
								</div>
								<!--end::Col-->
								<!--begin::Col-->
								<div class="col-lg-6">
									<!--begin::Tab content-->
									<div class="tab-content rounded h-100 bg-light p-10">
										<!--begin::Tab Pane-->
										<div class="tab-pane fade show active" id="kt_upgrade_plan_startup">
											<!--begin::Heading-->
											<div class="pb-5">
												<h2 class="fw-bold text-gray-900">What’s in Startup Plan?</h2>
												<div class="text-muted fw-semibold">Optimal for 10+ team size and new startup</div>
											</div>
											<!--end::Heading-->
											<!--begin::Body-->
											<div class="pt-1">
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Up to 10 Active Users</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Up to 30 Project Integrations</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Analytics Module</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-muted flex-grow-1">Finance Module</span>
													<i class="ki-duotone ki-cross-circle fs-1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-muted flex-grow-1">Accounting Module</span>
													<i class="ki-duotone ki-cross-circle fs-1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-muted flex-grow-1">Network Platform</span>
													<i class="ki-duotone ki-cross-circle fs-1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center">
													<span class="fw-semibold fs-5 text-muted flex-grow-1">Unlimited Cloud Space</span>
													<i class="ki-duotone ki-cross-circle fs-1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::Tab Pane-->
										<!--begin::Tab Pane-->
										<div class="tab-pane fade" id="kt_upgrade_plan_advanced">
											<!--begin::Heading-->
											<div class="pb-5">
												<h2 class="fw-bold text-gray-900">What’s in Startup Plan?</h2>
												<div class="text-muted fw-semibold">Optimal for 100+ team size and grown company</div>
											</div>
											<!--end::Heading-->
											<!--begin::Body-->
											<div class="pt-1">
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Up to 10 Active Users</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Up to 30 Project Integrations</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Analytics Module</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Finance Module</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Accounting Module</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-muted flex-grow-1">Network Platform</span>
													<i class="ki-duotone ki-cross-circle fs-1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center">
													<span class="fw-semibold fs-5 text-muted flex-grow-1">Unlimited Cloud Space</span>
													<i class="ki-duotone ki-cross-circle fs-1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::Tab Pane-->
										<!--begin::Tab Pane-->
										<div class="tab-pane fade" id="kt_upgrade_plan_enterprise">
											<!--begin::Heading-->
											<div class="pb-5">
												<h2 class="fw-bold text-gray-900">What’s in Startup Plan?</h2>
												<div class="text-muted fw-semibold">Optimal for 1000+ team and enterpise</div>
											</div>
											<!--end::Heading-->
											<!--begin::Body-->
											<div class="pt-1">
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Up to 10 Active Users</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Up to 30 Project Integrations</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Analytics Module</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Finance Module</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Accounting Module</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Network Platform</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Unlimited Cloud Space</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::Tab Pane-->
										<!--begin::Tab Pane-->
										<div class="tab-pane fade" id="kt_upgrade_plan_custom">
											<!--begin::Heading-->
											<div class="pb-5">
												<h2 class="fw-bold text-gray-900">What’s in Startup Plan?</h2>
												<div class="text-muted fw-semibold">Optimal for corporations</div>
											</div>
											<!--end::Heading-->
											<!--begin::Body-->
											<div class="pt-1">
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Unlimited Users</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Unlimited Project Integrations</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Analytics Module</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Finance Module</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Accounting Module</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Network Platform</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center">
													<span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Unlimited Cloud Space</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::Tab Pane-->
									</div>
									<!--end::Tab content-->
								</div>
								<!--end::Col-->
							</div>
							<!--end::Row-->
						</div>
						<!--end::Plans-->
						<!--begin::Actions-->
						<div class="d-flex flex-center flex-row-fluid pt-12">
							<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary" id="kt_modal_upgrade_plan_btn">
								<!--begin::Indicator label-->
								<span class="indicator-label">Upgrade Plan</span>
								<!--end::Indicator label-->
								<!--begin::Indicator progress-->
								<span class="indicator-progress">Please wait... 
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								<!--end::Indicator progress-->
							</button>
						</div>
						<!--end::Actions-->
					</div>
					<!--end::Modal body-->
				</div>
				<!--end::Modal content-->
			</div>
			<!--end::Modal dialog-->
		</div>
		<!--end::Modal - Upgrade plan-->
		<!--begin::Modal - Users Search-->
		<div class="modal fade" id="kt_modal_users_search" tabindex="-1" aria-hidden="true">
			<!--begin::Modal dialog-->
			<div class="modal-dialog modal-dialog-centered mw-650px">
				<!--begin::Modal content-->
				<div class="modal-content">
					<!--begin::Modal header-->
					<div class="modal-header pb-0 border-0 justify-content-end">
						<!--begin::Close-->
						<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
							<i class="ki-duotone ki-cross fs-1">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</div>
						<!--end::Close-->
					</div>
					<!--begin::Modal header-->
					<!--begin::Modal body-->
					<div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
						<!--begin::Content-->
						<div class="text-center mb-13">
							<h1 class="mb-3">Search Users</h1>
							<div class="text-muted fw-semibold fs-5">Invite Collaborators To Your Project</div>
						</div>
						<!--end::Content-->
						<!--begin::Search-->
						<div id="kt_modal_users_search_handler" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="inline">
							<!--begin::Form-->
							<form data-kt-search-element="form" class="w-100 position-relative mb-5" autocomplete="off">
								<!--begin::Hidden input(Added to disable form autocomplete)-->
								<input type="hidden" />
								<!--end::Hidden input-->
								<!--begin::Icon-->
								<i class="ki-duotone ki-magnifier fs-2 fs-lg-1 text-gray-500 position-absolute top-50 ms-5 translate-middle-y">
									<span class="path1"></span>
									<span class="path2"></span>
								</i>
								<!--end::Icon-->
								<!--begin::Input-->
								<input type="text" class="form-control form-control-lg form-control-solid px-15" name="search" value="" placeholder="Search by username, full name or email..." data-kt-search-element="input" />
								<!--end::Input-->
								<!--begin::Spinner-->
								<span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner">
									<span class="spinner-border h-15px w-15px align-middle text-muted"></span>
								</span>
								<!--end::Spinner-->
								<!--begin::Reset-->
								<span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5 d-none" data-kt-search-element="clear">
									<i class="ki-duotone ki-cross fs-2 fs-lg-1 me-0">
										<span class="path1"></span>
										<span class="path2"></span>
									</i>
								</span>
								<!--end::Reset-->
							</form>
							<!--end::Form-->
							<!--begin::Wrapper-->
							<div class="py-5">
								<!--begin::Suggestions-->
								<div data-kt-search-element="suggestions">
									<!--begin::Heading-->
									<h3 class="fw-semibold mb-5">Recently searched:</h3>
									<!--end::Heading-->
									<!--begin::Users-->
									<div class="mh-375px scroll-y me-n7 pe-7">
										<!--begin::User-->
										<a  class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
											<!--begin::Avatar-->
											<div class="symbol symbol-35px symbol-circle me-5">
												<img alt="Pic" src="assets/media/avatars/300-6.jpg" />
											</div>
											<!--end::Avatar-->
											<!--begin::Info-->
											<div class="fw-semibold">
												<span class="fs-6 text-gray-800 me-2">Emma Smith</span>
												<span class="badge badge-light">Art Director</span>
											</div>
											<!--end::Info-->
										</a>
										<!--end::User-->
										<!--begin::User-->
										<a  class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
											<!--begin::Avatar-->
											<div class="symbol symbol-35px symbol-circle me-5">
												<span class="symbol-label bg-light-danger text-danger fw-semibold">M</span>
											</div>
											<!--end::Avatar-->
											<!--begin::Info-->
											<div class="fw-semibold">
												<span class="fs-6 text-gray-800 me-2">Melody Macy</span>
												<span class="badge badge-light">Marketing Analytic</span>
											</div>
											<!--end::Info-->
										</a>
										<!--end::User-->
										<!--begin::User-->
										<a  class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
											<!--begin::Avatar-->
											<div class="symbol symbol-35px symbol-circle me-5">
												<img alt="Pic" src="assets/media/avatars/300-1.jpg" />
											</div>
											<!--end::Avatar-->
											<!--begin::Info-->
											<div class="fw-semibold">
												<span class="fs-6 text-gray-800 me-2">Max Smith</span>
												<span class="badge badge-light">Software Enginer</span>
											</div>
											<!--end::Info-->
										</a>
										<!--end::User-->
										<!--begin::User-->
										<a  class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
											<!--begin::Avatar-->
											<div class="symbol symbol-35px symbol-circle me-5">
												<img alt="Pic" src="assets/media/avatars/300-5.jpg" />
											</div>
											<!--end::Avatar-->
											<!--begin::Info-->
											<div class="fw-semibold">
												<span class="fs-6 text-gray-800 me-2">Sean Bean</span>
												<span class="badge badge-light">Web Developer</span>
											</div>
											<!--end::Info-->
										</a>
										<!--end::User-->
										<!--begin::User-->
										<a  class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
											<!--begin::Avatar-->
											<div class="symbol symbol-35px symbol-circle me-5">
												<img alt="Pic" src="assets/media/avatars/300-25.jpg" />
											</div>
											<!--end::Avatar-->
											<!--begin::Info-->
											<div class="fw-semibold">
												<span class="fs-6 text-gray-800 me-2">Brian Cox</span>
												<span class="badge badge-light">UI/UX Designer</span>
											</div>
											<!--end::Info-->
										</a>
										<!--end::User-->
									</div>
									<!--end::Users-->
								</div>
								<!--end::Suggestions-->
								<!--begin::Results(add d-none to below element to hide the users list by default)-->
								<div data-kt-search-element="results" class="d-none">
									<!--begin::Users-->
									<div class="mh-375px scroll-y me-n7 pe-7">
										<!--begin::User-->
										<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="0">
											<!--begin::Details-->
											<div class="d-flex align-items-center">
												<!--begin::Checkbox-->
												<label class="form-check form-check-custom form-check-solid me-5">
													<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='0']" value="0" />
												</label>
												<!--end::Checkbox-->
												<!--begin::Avatar-->
												<div class="symbol symbol-35px symbol-circle">
													<img alt="Pic" src="assets/media/avatars/300-6.jpg" />
												</div>
												<!--end::Avatar-->
												<!--begin::Details-->
												<div class="ms-5">
													<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Emma Smith</a>
													<div class="fw-semibold text-muted">smith@kpmg.com</div>
												</div>
												<!--end::Details-->
											</div>
											<!--end::Details-->
											<!--begin::Access menu-->
											<div class="ms-2 w-100px">
												<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
													<option value="1">Guest</option>
													<option value="2" selected="selected">Owner</option>
													<option value="3">Can Edit</option>
												</select>
											</div>
											<!--end::Access menu-->
										</div>
										<!--end::User-->
										<!--begin::Separator-->
										<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
										<!--end::Separator-->
										<!--begin::User-->
										<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="1">
											<!--begin::Details-->
											<div class="d-flex align-items-center">
												<!--begin::Checkbox-->
												<label class="form-check form-check-custom form-check-solid me-5">
													<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='1']" value="1" />
												</label>
												<!--end::Checkbox-->
												<!--begin::Avatar-->
												<div class="symbol symbol-35px symbol-circle">
													<span class="symbol-label bg-light-danger text-danger fw-semibold">M</span>
												</div>
												<!--end::Avatar-->
												<!--begin::Details-->
												<div class="ms-5">
													<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Melody Macy</a>
													<div class="fw-semibold text-muted">melody@altbox.com</div>
												</div>
												<!--end::Details-->
											</div>
											<!--end::Details-->
											<!--begin::Access menu-->
											<div class="ms-2 w-100px">
												<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
													<option value="1" selected="selected">Guest</option>
													<option value="2">Owner</option>
													<option value="3">Can Edit</option>
												</select>
											</div>
											<!--end::Access menu-->
										</div>
										<!--end::User-->
										<!--begin::Separator-->
										<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
										<!--end::Separator-->
										<!--begin::User-->
										<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="2">
											<!--begin::Details-->
											<div class="d-flex align-items-center">
												<!--begin::Checkbox-->
												<label class="form-check form-check-custom form-check-solid me-5">
													<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='2']" value="2" />
												</label>
												<!--end::Checkbox-->
												<!--begin::Avatar-->
												<div class="symbol symbol-35px symbol-circle">
													<img alt="Pic" src="assets/media/avatars/300-1.jpg" />
												</div>
												<!--end::Avatar-->
												<!--begin::Details-->
												<div class="ms-5">
													<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Max Smith</a>
													<div class="fw-semibold text-muted">max@kt.com</div>
												</div>
												<!--end::Details-->
											</div>
											<!--end::Details-->
											<!--begin::Access menu-->
											<div class="ms-2 w-100px">
												<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
													<option value="1">Guest</option>
													<option value="2">Owner</option>
													<option value="3" selected="selected">Can Edit</option>
												</select>
											</div>
											<!--end::Access menu-->
										</div>
										<!--end::User-->
										<!--begin::Separator-->
										<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
										<!--end::Separator-->
										<!--begin::User-->
										<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="3">
											<!--begin::Details-->
											<div class="d-flex align-items-center">
												<!--begin::Checkbox-->
												<label class="form-check form-check-custom form-check-solid me-5">
													<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='3']" value="3" />
												</label>
												<!--end::Checkbox-->
												<!--begin::Avatar-->
												<div class="symbol symbol-35px symbol-circle">
													<img alt="Pic" src="assets/media/avatars/300-5.jpg" />
												</div>
												<!--end::Avatar-->
												<!--begin::Details-->
												<div class="ms-5">
													<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Sean Bean</a>
													<div class="fw-semibold text-muted">sean@dellito.com</div>
												</div>
												<!--end::Details-->
											</div>
											<!--end::Details-->
											<!--begin::Access menu-->
											<div class="ms-2 w-100px">
												<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
													<option value="1">Guest</option>
													<option value="2" selected="selected">Owner</option>
													<option value="3">Can Edit</option>
												</select>
											</div>
											<!--end::Access menu-->
										</div>
										<!--end::User-->
										<!--begin::Separator-->
										<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
										<!--end::Separator-->
										<!--begin::User-->
										<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="4">
											<!--begin::Details-->
											<div class="d-flex align-items-center">
												<!--begin::Checkbox-->
												<label class="form-check form-check-custom form-check-solid me-5">
													<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='4']" value="4" />
												</label>
												<!--end::Checkbox-->
												<!--begin::Avatar-->
												<div class="symbol symbol-35px symbol-circle">
													<img alt="Pic" src="assets/media/avatars/300-25.jpg" />
												</div>
												<!--end::Avatar-->
												<!--begin::Details-->
												<div class="ms-5">
													<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Brian Cox</a>
													<div class="fw-semibold text-muted">brian@exchange.com</div>
												</div>
												<!--end::Details-->
											</div>
											<!--end::Details-->
											<!--begin::Access menu-->
											<div class="ms-2 w-100px">
												<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
													<option value="1">Guest</option>
													<option value="2">Owner</option>
													<option value="3" selected="selected">Can Edit</option>
												</select>
											</div>
											<!--end::Access menu-->
										</div>
										<!--end::User-->
										<!--begin::Separator-->
										<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
										<!--end::Separator-->
										<!--begin::User-->
										<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="5">
											<!--begin::Details-->
											<div class="d-flex align-items-center">
												<!--begin::Checkbox-->
												<label class="form-check form-check-custom form-check-solid me-5">
													<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='5']" value="5" />
												</label>
												<!--end::Checkbox-->
												<!--begin::Avatar-->
												<div class="symbol symbol-35px symbol-circle">
													<span class="symbol-label bg-light-warning text-warning fw-semibold">C</span>
												</div>
												<!--end::Avatar-->
												<!--begin::Details-->
												<div class="ms-5">
													<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Mikaela Collins</a>
													<div class="fw-semibold text-muted">mik@pex.com</div>
												</div>
												<!--end::Details-->
											</div>
											<!--end::Details-->
											<!--begin::Access menu-->
											<div class="ms-2 w-100px">
												<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
													<option value="1">Guest</option>
													<option value="2" selected="selected">Owner</option>
													<option value="3">Can Edit</option>
												</select>
											</div>
											<!--end::Access menu-->
										</div>
										<!--end::User-->
										<!--begin::Separator-->
										<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
										<!--end::Separator-->
										<!--begin::User-->
										<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="6">
											<!--begin::Details-->
											<div class="d-flex align-items-center">
												<!--begin::Checkbox-->
												<label class="form-check form-check-custom form-check-solid me-5">
													<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='6']" value="6" />
												</label>
												<!--end::Checkbox-->
												<!--begin::Avatar-->
												<div class="symbol symbol-35px symbol-circle">
													<img alt="Pic" src="assets/media/avatars/300-9.jpg" />
												</div>
												<!--end::Avatar-->
												<!--begin::Details-->
												<div class="ms-5">
													<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Francis Mitcham</a>
													<div class="fw-semibold text-muted">f.mit@kpmg.com</div>
												</div>
												<!--end::Details-->
											</div>
											<!--end::Details-->
											<!--begin::Access menu-->
											<div class="ms-2 w-100px">
												<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
													<option value="1">Guest</option>
													<option value="2">Owner</option>
													<option value="3" selected="selected">Can Edit</option>
												</select>
											</div>
											<!--end::Access menu-->
										</div>
										<!--end::User-->
										<!--begin::Separator-->
										<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
										<!--end::Separator-->
										<!--begin::User-->
										<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="7">
											<!--begin::Details-->
											<div class="d-flex align-items-center">
												<!--begin::Checkbox-->
												<label class="form-check form-check-custom form-check-solid me-5">
													<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='7']" value="7" />
												</label>
												<!--end::Checkbox-->
												<!--begin::Avatar-->
												<div class="symbol symbol-35px symbol-circle">
													<span class="symbol-label bg-light-danger text-danger fw-semibold">O</span>
												</div>
												<!--end::Avatar-->
												<!--begin::Details-->
												<div class="ms-5">
													<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Olivia Wild</a>
													<div class="fw-semibold text-muted">olivia@corpmail.com</div>
												</div>
												<!--end::Details-->
											</div>
											<!--end::Details-->
											<!--begin::Access menu-->
											<div class="ms-2 w-100px">
												<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
													<option value="1">Guest</option>
													<option value="2" selected="selected">Owner</option>
													<option value="3">Can Edit</option>
												</select>
											</div>
											<!--end::Access menu-->
										</div>
										<!--end::User-->
										<!--begin::Separator-->
										<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
										<!--end::Separator-->
										<!--begin::User-->
										<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="8">
											<!--begin::Details-->
											<div class="d-flex align-items-center">
												<!--begin::Checkbox-->
												<label class="form-check form-check-custom form-check-solid me-5">
													<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='8']" value="8" />
												</label>
												<!--end::Checkbox-->
												<!--begin::Avatar-->
												<div class="symbol symbol-35px symbol-circle">
													<span class="symbol-label bg-light-primary text-primary fw-semibold">N</span>
												</div>
												<!--end::Avatar-->
												<!--begin::Details-->
												<div class="ms-5">
													<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Neil Owen</a>
													<div class="fw-semibold text-muted">owen.neil@gmail.com</div>
												</div>
												<!--end::Details-->
											</div>
											<!--end::Details-->
											<!--begin::Access menu-->
											<div class="ms-2 w-100px">
												<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
													<option value="1" selected="selected">Guest</option>
													<option value="2">Owner</option>
													<option value="3">Can Edit</option>
												</select>
											</div>
											<!--end::Access menu-->
										</div>
										<!--end::User-->
										<!--begin::Separator-->
										<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
										<!--end::Separator-->
										<!--begin::User-->
										<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="9">
											<!--begin::Details-->
											<div class="d-flex align-items-center">
												<!--begin::Checkbox-->
												<label class="form-check form-check-custom form-check-solid me-5">
													<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='9']" value="9" />
												</label>
												<!--end::Checkbox-->
												<!--begin::Avatar-->
												<div class="symbol symbol-35px symbol-circle">
													<img alt="Pic" src="assets/media/avatars/300-23.jpg" />
												</div>
												<!--end::Avatar-->
												<!--begin::Details-->
												<div class="ms-5">
													<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Dan Wilson</a>
													<div class="fw-semibold text-muted">dam@consilting.com</div>
												</div>
												<!--end::Details-->
											</div>
											<!--end::Details-->
											<!--begin::Access menu-->
											<div class="ms-2 w-100px">
												<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
													<option value="1">Guest</option>
													<option value="2">Owner</option>
													<option value="3" selected="selected">Can Edit</option>
												</select>
											</div>
											<!--end::Access menu-->
										</div>
										<!--end::User-->
										<!--begin::Separator-->
										<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
										<!--end::Separator-->
										<!--begin::User-->
										<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="10">
											<!--begin::Details-->
											<div class="d-flex align-items-center">
												<!--begin::Checkbox-->
												<label class="form-check form-check-custom form-check-solid me-5">
													<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='10']" value="10" />
												</label>
												<!--end::Checkbox-->
												<!--begin::Avatar-->
												<div class="symbol symbol-35px symbol-circle">
													<span class="symbol-label bg-light-danger text-danger fw-semibold">E</span>
												</div>
												<!--end::Avatar-->
												<!--begin::Details-->
												<div class="ms-5">
													<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Emma Bold</a>
													<div class="fw-semibold text-muted">emma@intenso.com</div>
												</div>
												<!--end::Details-->
											</div>
											<!--end::Details-->
											<!--begin::Access menu-->
											<div class="ms-2 w-100px">
												<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
													<option value="1">Guest</option>
													<option value="2" selected="selected">Owner</option>
													<option value="3">Can Edit</option>
												</select>
											</div>
											<!--end::Access menu-->
										</div>
										<!--end::User-->
										<!--begin::Separator-->
										<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
										<!--end::Separator-->
										<!--begin::User-->
										<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="11">
											<!--begin::Details-->
											<div class="d-flex align-items-center">
												<!--begin::Checkbox-->
												<label class="form-check form-check-custom form-check-solid me-5">
													<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='11']" value="11" />
												</label>
												<!--end::Checkbox-->
												<!--begin::Avatar-->
												<div class="symbol symbol-35px symbol-circle">
													<img alt="Pic" src="assets/media/avatars/300-12.jpg" />
												</div>
												<!--end::Avatar-->
												<!--begin::Details-->
												<div class="ms-5">
													<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Ana Crown</a>
													<div class="fw-semibold text-muted">ana.cf@limtel.com</div>
												</div>
												<!--end::Details-->
											</div>
											<!--end::Details-->
											<!--begin::Access menu-->
											<div class="ms-2 w-100px">
												<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
													<option value="1" selected="selected">Guest</option>
													<option value="2">Owner</option>
													<option value="3">Can Edit</option>
												</select>
											</div>
											<!--end::Access menu-->
										</div>
										<!--end::User-->
										<!--begin::Separator-->
										<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
										<!--end::Separator-->
										<!--begin::User-->
										<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="12">
											<!--begin::Details-->
											<div class="d-flex align-items-center">
												<!--begin::Checkbox-->
												<label class="form-check form-check-custom form-check-solid me-5">
													<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='12']" value="12" />
												</label>
												<!--end::Checkbox-->
												<!--begin::Avatar-->
												<div class="symbol symbol-35px symbol-circle">
													<span class="symbol-label bg-light-info text-info fw-semibold">A</span>
												</div>
												<!--end::Avatar-->
												<!--begin::Details-->
												<div class="ms-5">
													<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Robert Doe</a>
													<div class="fw-semibold text-muted">robert@benko.com</div>
												</div>
												<!--end::Details-->
											</div>
											<!--end::Details-->
											<!--begin::Access menu-->
											<div class="ms-2 w-100px">
												<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
													<option value="1">Guest</option>
													<option value="2">Owner</option>
													<option value="3" selected="selected">Can Edit</option>
												</select>
											</div>
											<!--end::Access menu-->
										</div>
										<!--end::User-->
										<!--begin::Separator-->
										<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
										<!--end::Separator-->
										<!--begin::User-->
										<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="13">
											<!--begin::Details-->
											<div class="d-flex align-items-center">
												<!--begin::Checkbox-->
												<label class="form-check form-check-custom form-check-solid me-5">
													<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='13']" value="13" />
												</label>
												<!--end::Checkbox-->
												<!--begin::Avatar-->
												<div class="symbol symbol-35px symbol-circle">
													<img alt="Pic" src="assets/media/avatars/300-13.jpg" />
												</div>
												<!--end::Avatar-->
												<!--begin::Details-->
												<div class="ms-5">
													<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">John Miller</a>
													<div class="fw-semibold text-muted">miller@mapple.com</div>
												</div>
												<!--end::Details-->
											</div>
											<!--end::Details-->
											<!--begin::Access menu-->
											<div class="ms-2 w-100px">
												<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
													<option value="1">Guest</option>
													<option value="2">Owner</option>
													<option value="3" selected="selected">Can Edit</option>
												</select>
											</div>
											<!--end::Access menu-->
										</div>
										<!--end::User-->
										<!--begin::Separator-->
										<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
										<!--end::Separator-->
										<!--begin::User-->
										<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="14">
											<!--begin::Details-->
											<div class="d-flex align-items-center">
												<!--begin::Checkbox-->
												<label class="form-check form-check-custom form-check-solid me-5">
													<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='14']" value="14" />
												</label>
												<!--end::Checkbox-->
												<!--begin::Avatar-->
												<div class="symbol symbol-35px symbol-circle">
													<span class="symbol-label bg-light-success text-success fw-semibold">L</span>
												</div>
												<!--end::Avatar-->
												<!--begin::Details-->
												<div class="ms-5">
													<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Lucy Kunic</a>
													<div class="fw-semibold text-muted">lucy.m@fentech.com</div>
												</div>
												<!--end::Details-->
											</div>
											<!--end::Details-->
											<!--begin::Access menu-->
											<div class="ms-2 w-100px">
												<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
													<option value="1">Guest</option>
													<option value="2" selected="selected">Owner</option>
													<option value="3">Can Edit</option>
												</select>
											</div>
											<!--end::Access menu-->
										</div>
										<!--end::User-->
										<!--begin::Separator-->
										<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
										<!--end::Separator-->
										<!--begin::User-->
										<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="15">
											<!--begin::Details-->
											<div class="d-flex align-items-center">
												<!--begin::Checkbox-->
												<label class="form-check form-check-custom form-check-solid me-5">
													<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='15']" value="15" />
												</label>
												<!--end::Checkbox-->
												<!--begin::Avatar-->
												<div class="symbol symbol-35px symbol-circle">
													<img alt="Pic" src="assets/media/avatars/300-21.jpg" />
												</div>
												<!--end::Avatar-->
												<!--begin::Details-->
												<div class="ms-5">
													<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Ethan Wilder</a>
													<div class="fw-semibold text-muted">ethan@loop.com.au</div>
												</div>
												<!--end::Details-->
											</div>
											<!--end::Details-->
											<!--begin::Access menu-->
											<div class="ms-2 w-100px">
												<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
													<option value="1" selected="selected">Guest</option>
													<option value="2">Owner</option>
													<option value="3">Can Edit</option>
												</select>
											</div>
											<!--end::Access menu-->
										</div>
										<!--end::User-->
										<!--begin::Separator-->
										<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
										<!--end::Separator-->
										<!--begin::User-->
										<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="16">
											<!--begin::Details-->
											<div class="d-flex align-items-center">
												<!--begin::Checkbox-->
												<label class="form-check form-check-custom form-check-solid me-5">
													<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='16']" value="16" />
												</label>
												<!--end::Checkbox-->
												<!--begin::Avatar-->
												<div class="symbol symbol-35px symbol-circle">
													<img alt="Pic" src="assets/media/avatars/300-13.jpg" />
												</div>
												<!--end::Avatar-->
												<!--begin::Details-->
												<div class="ms-5">
													<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">John Miller</a>
													<div class="fw-semibold text-muted">miller@mapple.com</div>
												</div>
												<!--end::Details-->
											</div>
											<!--end::Details-->
											<!--begin::Access menu-->
											<div class="ms-2 w-100px">
												<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
													<option value="1">Guest</option>
													<option value="2">Owner</option>
													<option value="3" selected="selected">Can Edit</option>
												</select>
											</div>
											<!--end::Access menu-->
										</div>
										<!--end::User-->
									</div>
									<!--end::Users-->
									<!--begin::Actions-->
									<div class="d-flex flex-center mt-15">
										<button type="reset" id="kt_modal_users_search_reset" data-bs-dismiss="modal" class="btn btn-active-light me-3">Cancel</button>
										<button type="submit" id="kt_modal_users_search_submit" class="btn btn-primary">Add Selected Users</button>
									</div>
									<!--end::Actions-->
								</div>
								<!--end::Results-->
								<!--begin::Empty-->
								<div data-kt-search-element="empty" class="text-center d-none">
									<!--begin::Message-->
									<div class="fw-semibold py-10">
										<div class="text-gray-600 fs-3 mb-2">No users found</div>
										<div class="text-muted fs-6">Try to search by username, full name or email...</div>
									</div>
									<!--end::Message-->
									<!--begin::Illustration-->
									<div class="text-center px-5">
										<img src="assets/media/illustrations/sigma-1/1.png" alt="" class="w-100 h-200px h-sm-325px" />
									</div>
									<!--end::Illustration-->
								</div>
								<!--end::Empty-->
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Search-->
					</div>
					<!--end::Modal body-->
				</div>
				<!--end::Modal content-->
			</div>
			<!--end::Modal dialog-->
		</div>
		<!--end::Modal - Users Search-->
		<!--begin::Modal - Invite Friends-->
		<div class="modal fade" id="kt_modal_invite_friends" tabindex="-1" aria-hidden="true">
			<!--begin::Modal dialog-->
			<div class="modal-dialog mw-650px">
				<!--begin::Modal content-->
				<div class="modal-content">
					<!--begin::Modal header-->
					<div class="modal-header pb-0 border-0 justify-content-end">
						<!--begin::Close-->
						<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
							<i class="ki-duotone ki-cross fs-1">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</div>
						<!--end::Close-->
					</div>
					<!--begin::Modal header-->
					<!--begin::Modal body-->
					<div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
						<!--begin::Heading-->
						<div class="text-center mb-13">
							<!--begin::Title-->
							<h1 class="mb-3">Invite a Friend</h1>
							<!--end::Title-->
							<!--begin::Description-->
							<div class="text-muted fw-semibold fs-5">If you need more info, please check out 
							<a  class="link-primary fw-bold">FAQ Page</a>.</div>
							<!--end::Description-->
						</div>
						<!--end::Heading-->
						<!--begin::Google Contacts Invite-->
						<div class="btn btn-light-primary fw-bold w-100 mb-8">
						<img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="h-20px me-3" />Invite Gmail Contacts</div>
						<!--end::Google Contacts Invite-->
						<!--begin::Separator-->
						<div class="separator d-flex flex-center mb-8">
							<span class="text-uppercase bg-body fs-7 fw-semibold text-muted px-3">or</span>
						</div>
						<!--end::Separator-->
						<!--begin::Textarea-->
						<textarea class="form-control form-control-solid mb-8" rows="3" placeholder="Type or paste emails here"></textarea>
						<!--end::Textarea-->
						<!--begin::Users-->
						<div class="mb-10">
							<!--begin::Heading-->
							<div class="fs-6 fw-semibold mb-2">Your Invitations</div>
							<!--end::Heading-->
							<!--begin::List-->
							<div class="mh-300px scroll-y me-n7 pe-7">
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<img alt="Pic" src="assets/media/avatars/300-6.jpg" />
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Emma Smith</a>
											<div class="fw-semibold text-muted">smith@kpmg.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2" selected="selected">Owner</option>
											<option value="3">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<span class="symbol-label bg-light-danger text-danger fw-semibold">M</span>
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Melody Macy</a>
											<div class="fw-semibold text-muted">melody@altbox.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
											<option value="1" selected="selected">Guest</option>
											<option value="2">Owner</option>
											<option value="3">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<img alt="Pic" src="assets/media/avatars/300-1.jpg" />
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Max Smith</a>
											<div class="fw-semibold text-muted">max@kt.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2">Owner</option>
											<option value="3" selected="selected">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<img alt="Pic" src="assets/media/avatars/300-5.jpg" />
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Sean Bean</a>
											<div class="fw-semibold text-muted">sean@dellito.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2" selected="selected">Owner</option>
											<option value="3">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<img alt="Pic" src="assets/media/avatars/300-25.jpg" />
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Brian Cox</a>
											<div class="fw-semibold text-muted">brian@exchange.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2">Owner</option>
											<option value="3" selected="selected">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<span class="symbol-label bg-light-warning text-warning fw-semibold">C</span>
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Mikaela Collins</a>
											<div class="fw-semibold text-muted">mik@pex.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2" selected="selected">Owner</option>
											<option value="3">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<img alt="Pic" src="assets/media/avatars/300-9.jpg" />
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Francis Mitcham</a>
											<div class="fw-semibold text-muted">f.mit@kpmg.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2">Owner</option>
											<option value="3" selected="selected">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<span class="symbol-label bg-light-danger text-danger fw-semibold">O</span>
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Olivia Wild</a>
											<div class="fw-semibold text-muted">olivia@corpmail.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2" selected="selected">Owner</option>
											<option value="3">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<span class="symbol-label bg-light-primary text-primary fw-semibold">N</span>
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Neil Owen</a>
											<div class="fw-semibold text-muted">owen.neil@gmail.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
											<option value="1" selected="selected">Guest</option>
											<option value="2">Owner</option>
											<option value="3">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<img alt="Pic" src="assets/media/avatars/300-23.jpg" />
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Dan Wilson</a>
											<div class="fw-semibold text-muted">dam@consilting.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2">Owner</option>
											<option value="3" selected="selected">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<span class="symbol-label bg-light-danger text-danger fw-semibold">E</span>
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Emma Bold</a>
											<div class="fw-semibold text-muted">emma@intenso.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2" selected="selected">Owner</option>
											<option value="3">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<img alt="Pic" src="assets/media/avatars/300-12.jpg" />
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Ana Crown</a>
											<div class="fw-semibold text-muted">ana.cf@limtel.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
											<option value="1" selected="selected">Guest</option>
											<option value="2">Owner</option>
											<option value="3">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<span class="symbol-label bg-light-info text-info fw-semibold">A</span>
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Robert Doe</a>
											<div class="fw-semibold text-muted">robert@benko.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2">Owner</option>
											<option value="3" selected="selected">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<img alt="Pic" src="assets/media/avatars/300-13.jpg" />
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">John Miller</a>
											<div class="fw-semibold text-muted">miller@mapple.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2">Owner</option>
											<option value="3" selected="selected">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<span class="symbol-label bg-light-success text-success fw-semibold">L</span>
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Lucy Kunic</a>
											<div class="fw-semibold text-muted">lucy.m@fentech.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2" selected="selected">Owner</option>
											<option value="3">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<img alt="Pic" src="assets/media/avatars/300-21.jpg" />
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Ethan Wilder</a>
											<div class="fw-semibold text-muted">ethan@loop.com.au</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
											<option value="1" selected="selected">Guest</option>
											<option value="2">Owner</option>
											<option value="3">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<img alt="Pic" src="assets/media/avatars/300-13.jpg" />
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a  class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">John Miller</a>
											<div class="fw-semibold text-muted">miller@mapple.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2">Owner</option>
											<option value="3" selected="selected">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
							</div>
							<!--end::List-->
						</div>
						<!--end::Users-->
						<!--begin::Notice-->
						<div class="d-flex flex-stack">
							<!--begin::Label-->
							<div class="me-5 fw-semibold">
								<label class="fs-6">Adding Users by Team Members</label>
								<div class="fs-7 text-muted">If you need more info, please check budget planning</div>
							</div>
							<!--end::Label-->
							<!--begin::Switch-->
							<label class="form-check form-switch form-check-custom form-check-solid">
								<input class="form-check-input" type="checkbox" value="1" checked="checked" />
								<span class="form-check-label fw-semibold text-muted">Allowed</span>
							</label>
							<!--end::Switch-->
						</div>
						<!--end::Notice-->
					</div>
					<!--end::Modal body-->
				</div>
				<!--end::Modal content-->
			</div>
			<!--end::Modal dialog-->
		</div>
		<!--end::Modal - Invite Friend-->
		<!--end::Modals-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Vendors Javascript(used for this page only)-->
		<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<!--end::Vendors Javascript-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="assets/js/custom/apps/support-center/tickets/create.js"></script>
		<script src="assets/js/widgets.bundle.js"></script>
		<script src="assets/js/custom/widgets.js"></script>
		<script src="assets/js/custom/apps/chat/chat.js"></script>
		<script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
		<script src="assets/js/custom/utilities/modals/users-search.js"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>

<?php


?>