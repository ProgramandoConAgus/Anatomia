<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('con_db.php');
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
$idCategoria=null;
$firstTime=true;
$sql = "SELECT 
    v.IdVideo,
    v.titulo,
    v.video_path,
    v.idCategoria,
    c.nombre AS categoria_nombre,
    c.descripcion
FROM videos v
JOIN categoria c ON v.idCategoria = c.IdCategoria
JOIN modulos m ON c.idModulo = m.IdModulo
WHERE c.idModulo = ?
Order by v.idCategoria;";
$stmt = $conex->prepare($sql);
$stmt->bind_param("i", $numero_recibido);
$stmt->execute();
$result = $stmt->get_result();

?>


<!DOCTYPE html>
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
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
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
											<li class="nav-item my-3">
												<a class="btn btn-active-light-primary fw-bolder nav-link btn-color-gray-700 px-3 px-lg-8 mx-1 text-uppercase active" href="pantalla-cursos-clases.php?numero=<?=$numero_recibido?>">CONTENIDO</a>
											</li>
											<!--end::Nav item-->
											<!--begin::Nav item-->
											<li class="nav-item my-3">
												<a class="btn btn-active-light-primary fw-bolder nav-link btn-color-gray-700 px-3 px-lg-8 mx-1 text-uppercase" href="pdfs.php?numero=<?=$numero_recibido?>">PDFs</a>
											</li>
											
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
								<!--begin::Home card-->
								<div class="card">
									<!--begin::Body-->
									<div class="card-body p-10 p-lg-15">
										<!--begin::Section-->
										<div class="mb-17">
										<!--begin::Separator-->
											<div class="separator separator-dashed mb-9"></div>
											<!--end::Separator-->
											<!--begin::Row-->
											<div class="row g-10">

											<?php
											if ($result) {
												$idCategoriaAnterior = null; 

												while ($row = mysqli_fetch_assoc($result)) {
													$idCategoriaActual = $row['idCategoria']; // Categoría actual

													// Si la categoría cambia (o es la primera vez)
													if ($idCategoriaActual != $idCategoriaAnterior) {
														// Si ya hay una categoría anterior, cerramos el bloque
														if ($idCategoriaAnterior !== null) {
															echo '</div></div></div></div></div>'; // cierra los divs abiertos del bloque anterior
														}
														?>
														<div class="card-body"> 
															<div class="row">
																<div class="col"> 
																	<!--begin::List widget 2-->
																	<div class="card card-flush h-lg-100" > 
																		<!--begin::Header-->
																		<div class="card-header pt-5">
																			<!--begin::Title-->
																			<h3 class="card-title align-items-start flex-column">
																				<span class="card-label fw-bold text-gray-900"><?=$row['categoria_nombre']?></span>
																				<span class="text-gray-500 mt-1 fw-semibold fs-6"><?=$row['descripcion']?></span>
																			</h3>
																			<!--end::Title-->
																		</div>
																		<!--end::Header-->
																		<!--begin::Body-->
																		<div class="card-body pt-5"> 
														<?php
													}
													?>
													<div class="d-flex justify-content-between align-items-center">
														<!--begin::Title-->
														<a class="text-primary opacity-75-hover fs-6 fw-semibold">
															<?=$row['titulo']?>
														</a>
														<!--end::Title-->

														<!--begin::Action-->
														<div>
															<a data-fslightbox="lightbox-video-tutorials" href="" data-toggle="modal" data-target="#modalVideo<?=$row['IdVideo']?>" class="btn btn-link p-0 me-3">
																Ver clase
															</a>

															<?php if($_SESSION['IdTipoUsuario'] == 2): ?>
																<button class="btn btn-danger er fs-6 px-5 py-3" data-toggle="modal" data-target="#confirmDeleteModal<?=$row['IdVideo']?>">Eliminar</button>
																<?php endif; ?>
														</div>
														<!--end::Action-->
													</div>

													<!-- Modal de Confirmación de Eliminación -->
													<div class="modal fade" id="confirmDeleteModal<?=$row['IdVideo']?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel<?=$row['IdVideo']?>" aria-hidden="true">
														<div class="modal-dialog modal-dialog-centered" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="confirmDeleteLabel<?=$row['IdVideo']?>">Confirmar Eliminación</h5>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																	</button>
																</div>
																<div class="modal-body">
																	¿Estás seguro de que quieres eliminar este video?
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
																	<!-- Al hacer clic en "Eliminar", redirige a delete_video.php con el IdVideo -->
																	<a href="borrarVideo.php?id=<?=$row['IdVideo']?>" class="btn btn-danger">Eliminar</a>
																</div>
															</div>
														</div>
													</div>

													<!--begin::Separator-->
													<div class="separator separator-dashed my-3"></div>
													<!--end::Separator-->

													<!-- Modal -->
													<div class="modal fade" id="modalVideo<?=$row['IdVideo']?>" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel<?=$row['IdVideo']?>" aria-hidden="true">
														<div class="modal-dialog modal-xl" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="videoModalLabel<?=$row['IdVideo']?>"><?=$row['titulo']?></h5>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																	</button>
																</div>
																<div class="modal-body">
																	<!-- Reproductor de video dentro del modal -->
																	<video id="video-<?=$row['IdVideo']?>" width="100%" controls controlslist="nodownload" oncontextmenu="return false;">
																		<source src="<?=$row['video_path']?>" type="video/mp4">
																		Tu navegador no soporta el elemento de video.
																	</video>
																</div>
															</div>
														</div>
													</div>
													<?php

													// Al final de el bucle, actualiza la categoría anterior
													$idCategoriaAnterior = $idCategoriaActual;
												}

												
											}
											?>

											</div>
											<!--end::Row-->
										</div>
										<!--end::Section-->
									</div>
									<!--end::Body-->
								</div>
								<!--end::Home card-->
							</div>
							<!--end::Container-->
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
		<!--end::Main-->
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<i class="ki-duotone ki-arrow-up">
				<span class="path1"></span>
				<span class="path2"></span>
			</i>
		</div>
		<!--end::Scrolltop-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Vendors Javascript(used for this page only)-->
		<script src="assets/plugins/custom/fslightbox/fslightbox.bundle.js"></script>
		<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<!--end::Vendors Javascript-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="assets/js/custom/apps/support-center/tickets/create.js"></script>
		<script src="assets/js/widgets.bundle.js"></script>
		<script src="assets/js/custom/widgets.js"></script>
		<script src="assets/js/custom/apps/chat/chat.js"></script>
		<script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
		<script src="assets/js/custom/utilities/modals/users-search.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

		<script>
			// Función para detener el video cuando se cierra el modal
			$('.modal').on('hidden.bs.modal', function (e) {
				var video = $(this).find('video')[0];
				if (video) {
					video.pause();         // Pausar el video
					video.currentTime = 0; // Reiniciar el tiempo del video
				}
			});
   		</script>
		<script src="./Admins/borrarVideo.js"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>
<?php
?>
