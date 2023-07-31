<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Nombre de la página web -->
    <title>DPW - Actividad Experimental 1</title>

    <!-- Logo en la barra de título -->
    <link rel="icon" href="../img/logo2.png" type="image/x-icon">

    <!-- Importación de los estilos CSS externos y librerías externas-->
    <link rel="stylesheet" href="../internas/styles.css" media="screen" />
</head>

<body>
    <!-- Cabezera -->
    <header>
        <!-- Logo con gradiente y menor tamaño -->
        <img class="logo" src=../img/logo.png alt="logo TW">

        <!-- Título del sitio web-->
        <h1>Actividad Experimental 1: PHP y MySQL AE1</h1>

        <!-- Menú horizontal -->
        <nav>
            <div id="menubar">
                <ul id="menuUl">
                    <li class="menuLi"><a href="../index.php">Inicio<span></span></a></li>
                    <li class="menuLi"><a href="nuevo_parque.php">Ingresar nuevo parque<span></span></a></li>
                    <li class="menuLi"><a href="nuevo_monumento.php">Ingresar nuevo monumento<span></span></a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Sección del contenido de la página actual -->


    <section>
        <!-- Título de la página actual -->
        <h2>Ingresar datos del nuevo monumento</h2>

        <!-- Artículo principal -->
        <article>
            <?php
                if($_GET['error']){
                echo "<h5>". $_GET['error'] ."</h5>";
                }
            ?>
            <div class="formulario">
            <form action="insertar_monumento.php" method="post">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required />
                <br />
                <br />
                <label for="tipo_de_material">Tipo de material:</label>
                <input type="text" name="tipo_de_material" id="tipo_de_material" required />
                <br />
                <br />
                <label for="altura">Altura (metros):</label>
                <input type="number" name="altura" id="altura" required />
                <br />
                <br />
                <label for="ciudad">Ciudad:</label>
                <input type="text" name="ciudad" id="ciudad" required />
                <br />
                <br />

                <input type="submit" class="button" name="enviar" id="enviar" value="Enviar" />
            </form>
            </div>
        </article>
    </section>


    <!-- Pie de página -->
    <footer class="footer">
        <p>
            Federico Huerta. Desarrollo en plataformas web 100-RED UTPL. Abril 2023 - Agosto 2023.
        </p>
    </footer>
</body>


</html>
