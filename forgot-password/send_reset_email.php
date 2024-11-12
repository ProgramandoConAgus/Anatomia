<?php
include '../vendor/autoload.php';
include '../con_db.php'; // Incluir el archivo de conexión a la base de datos
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['recoveryEmail'];

    // Verificar si el email existe en la base de datos
    $result = $conex->query("SELECT * FROM usuarios WHERE email='$email'");
    if ($result->num_rows > 0) {
        $token = bin2hex(random_bytes(50));
        
        // Verificar si el email ya está en la tabla password_resets
        $resultReset = $conex->query("SELECT * FROM password_resets WHERE email='$email'");
        if ($resultReset->num_rows > 0) {
            // Si el email ya está, actualizar el token
            $conex->query("UPDATE password_resets SET token='$token' WHERE email='$email'");
            $date = new DateTime();
            $date= $date->format('Y-m-d H:i:s');
            $conex->query("UPDATE password_resets SET created_at='$date' WHERE email='$email'" );
        } else {
            // Si el email no está, insertar un nuevo registro
            $conex->query("INSERT INTO password_resets (email, token) VALUES ('$email', '$token')");
        }

        // Enviar email con PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Configuración del servidor
            $mail->isSMTP();
            $mail->Host = 'smtp.hostinger.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'educacion@preparandoanato.com';
            $mail->Password = 'Cande2012!';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Destinatarios
            $mail->setFrom('educacion@preparandoanato.com', 'Preparando anato');
            $mail->addAddress($email);

            // Contenido del email
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body = "Click <a href='https://preparandoanato.com/forgot-password/reset-passwordhtml.php?token=$token'>here</a> to reset your password.<br><br>";

            $mail->send();
            $message = 'El link de reestablecimiento fue enviado a tu email.';
            
        } catch (Exception $e) {
            $message = "El mensaje no se pudo enviar. Consulte a servicio Tecnico"/*: {$mail->ErrorInfo}"*/;
        }
    } else {
        $message = 'No se encontro ningun email a ese nombre.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
<base href="../" />
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
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="auth-bg bgi-size-cover bgi-position-center bgi-no-repeat">
    <!--begin::Theme mode setup on page load-->
    <script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page bg image-->
        <style>body { background-image: url('assets/media/auth/bg8.jpg'); } [data-bs-theme="dark"] body { background-image: url('assets/media/auth/bg8-dark.jpg'); }</style>
        <!--end::Page bg image-->
        <!--begin::Authentication - Signup Welcome Message -->
        <div class="d-flex flex-column flex-center flex-column-fluid">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center text-center p-10">
                <!--begin::Wrapper-->
                <div class="card card-flush w-md-650px py-5">
                    <div class="card-body py-15 py-lg-20">
                        <!--begin::Logo-->
                        <div class="mb-7">
                            <a href="./index.php" class="">
                                <img alt="Logo" src="./images/generalidades.png" class="h-80px" />
                            </a>
                        </div>
                        <!--end::Logo-->
                        <h1><?=$message?></h1>
                    </div>
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Authentication - Signup Welcome Message-->
    </div>
    <!--end::Root-->
    <!--end::Main-->
    <!--begin::Javascript-->
    <script>var hostUrl = "assets/";</script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--end::Javascript-->
</body>
<!--end::Body-->
</html>
