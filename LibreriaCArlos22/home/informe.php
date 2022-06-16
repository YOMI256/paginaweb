<?php
error_reporting(0);
require '../cnx.php';
$suma = 0;
$sqlSelect = "SELECT * FROM `books`;";
$ps = $cnx->prepare($sqlSelect);
$ps->execute();
$resLibro = $ps->fetchAll();

$sqlSelectCat = "SELECT * FROM `categorias`;";
$ps = $cnx->prepare($sqlSelectCat);
$ps->execute();
$resCategoria = $ps->fetchAll();

$sqlSelectL = "SELECT c.id_cat, c.name_cat, l.stock_book, l.id_cat FROM `categorias` c INNER JOIN `books` l ON c.id_cat = l.id_cat;";
$psSelectL = $cnx->prepare($sqlSelectL);
$psSelectL->execute();
$res = $psSelectL->fetchAll();
//echo $psSelectL;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <Link rel="stylesheet" href="style.css"/>
        <title>Sistema de gestion de libros</title>
        <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500&display=swap" rel="stylesheet"> 
        <script src="https://kit.fontawesome.com/62cb099bac.js" crossorigin="anonymous"></script>
    </head>
<body>

    
<!--Barra de navegacion-->
     
    <div id="nav-bar">
        <div id="nav-bar-content" style="margin-left:22rem; display: inline-flex;">

            <div class="pestañas" style="margin-top: 1.3rem; margin-left: 1.5rem;">
                <a href="#" id="Dashboard-navbar">Dashboard</a>
                <a href="..\home\index.php" id="Productos-navbar">Productos</a>
                <a href="#" id="Categorias-navbar">Categorias</a>
            </div>

            <div class="añadirproducto-navbar" style="margin-top: 1rem;">
                <a href="..\CRUD\añadirLibro.php" id="añadirproducto-btn">+ Añadir Producto</a>
            </div>

            <div class="notificacion" style="margin-top: 0.7rem; margin-left: 34rem;">
                <img src="..\img\campana.PNG" alt="no se encontro elemento">
            </div>

            <div class="perfil" style="margin-top: 0.7rem; margin-left: 5rem; display: inline-flex;">
                <a>Perfil</a>

                <ul class="nav">
                    <li><img src="..\img\perfil.PNG" alt="no se encontro elemento">
                        <ul>
                            <li> <a href="..\login.php">Cerrar Sesión</a> </li>
                        </ul>
                    </li>
                </ul>

                
            </div>


        </div>
    </div>

<!--Barra de navegacion end-->
<?php foreach($resLibro as $libro){ 
    $cantidad = $libro['stock_book'];
    $suma = $suma + $cantidad;
    $cantidadVendido = $libro['vendidos_book'];
    $sumabooks += $cantidadVendido;
 } 
 ?>


<!--Body Center, Aqui va el contenido-->
<div id="body-content2" style="color: black;">
    <div id="body-center">
        <div id="body-header-title" style=" margin-left: 0rem; margin-top: 2rem; margin-bottom: 3rem;">
            <p>Informe de inventario</p>
        </div>
        <div id="texto-informe">
            <p>En el presente reporte de inventario se presentara una tabla recopilando el stock disponible.</p>
            <form>  
                <table id="tabla-inv" cellspacing="0" cellpadding="10">
                <tr><td style="font-size:19px; color: #afafaf;">Resumen:</td></tr>
                    <tr>
                        <td style="font-weight: bold;">Total Libros disponibles:</td>
                        <td><?php echo $suma?></td>
                    </tr>
                    
                    <tr>
                    <td style="font-weight: bold;">Categorias:</td>
                        <?php foreach($resCategoria as $cat){ ?>
                        <td><?php echo $cat['name_cat']?></td>
                        <?php } ?>
                    </tr>

                    <tr>
                        <td style="font-weight: bold;">Autores Totales:</td>
                        <td>0</td>
                    </tr>

                    <tr>
                        <td style="font-weight: bold;">Total libros vendidos:</td>
                        <td><?php echo $sumabooks ?></td>
                    </tr>

                    <tr>
                        <td style="font-weight: bold;">Profit:</td>
                        <td style=" color: #04db7e;">+12%</td>
                    </tr>
                    <!-- Aqui esta las categorias disponibles-->
                    <tr>
                        <tr><td style="font-size:19px; color: #afafaf;">Categorias disponibles</td></tr>
                        <?php foreach($res as $cat){ ?>
                        <tr>
                            <td style="font-weight: bold;"><?php echo $cat['name_cat']?></td>
                            <td><?php echo $cat['stock_book']?></td>
                        </tr>
                        <?php } ?>
                    </tr>

                    <tr>
                        <tr><td style="font-size:19px; color: #afafaf;">Nombres de Libros Disponible.</td></tr>
                        <?php foreach($resLibro as $libroDisponible){ ?>
                        <tr>
                            <td style="font-weight: bold;"><?php echo $libroDisponible['name_book']?></td>       
                        </tr>
                        <?php } ?>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!--Body Center end-->

<!--Barra Lateral-->
   <div id="barra-lateral-container">
        <div id="side-bar-content">
            <p style="color: #a9b0bb;">FILTRAR PRODUCTOS</p>

            <div id="search" style="margin-top: 1rem;">
                <input id="buscar-inventario" type="text" placeholder="buscar en inventario">
                <button id="btn-search" > <img src="..\img\lupa.PNG" alt=""> </button>
            </div>

            <form action="paginafea.php">

                <div class="desplegables" id="id">
                <p>ID</p>
                <select id="select" name="selectid" disabled>
                    <option class="option" value="value1"selected >Todos</option>
                    <option  class="option" value="value2"> hay que poner cosas aki feos</option>
                    <option class="option" value="value3"> hay que poner cosas aki feos</option>
                </select>
                </div>

                <div class="desplegables" id="nombre">
                <p>Nombre</p>
                <select id="select" name="selectnombre" disabled>
                    <option class="option" value="value1"selected > Todos</option>
                    <option  class="option" value="value2"> hay que poner cosas aki feos</option>
                    <option class="option" value="value3"> hay que poner cosas aki feos</option>
                </select>
                </div>

                <div class="desplegables" id="grupo">
                <p>Autor</p>
                <select id="select" name="selectgrupo" disabled>
                    <option class="option" value="value1"selected > Todos</option>
                    <option  class="option" value="value2"> hay que poner cosas aki feos</option>
                    <option class="option" value="value3"> hay que poner cosas aki feos</option>
                </select>
                </div>

                <div class="desplegables" id="categoria">
                <p>Categoria</p>
                <select id="select" name="selectcategoria" disabled>
                    <option class="option" value="value1"selected > Todos</option>
                    <option  class="option" value="value2"> hay que poner cosas aki feos</option>
                    <option class="option" value="value3"> hay que poner cosas aki feos</option>
                </select>
                </div>
            

            <div id="asendente-desendente" style="margin-top: 2rem;">
                <input type="radio" id="asendente" name="orden" value="AS" disabled>
                <label for="asendente">Asendente</label><br>
                <input type="radio" id="desendente" name="orden" value="DE" disabled>
                <label for="desendente">Desendente</label><br>
            </div>

            <div id="botones-sidebar">
                <input type="button" id="clean" value="Limpiar Filtros" disabled>
                <input type="submit" id="apply" value="Aplicar" disabled>
            </div>
            <div id="img-logo">
                <img style="width: 5rem; margin-top: 11rem;" src="..\img\libronegro.PNG" alt="">
            </div>

            </form>
        </div>
    </div>
<!--Barra Lateral end-->
    
</body>
</html>

<script>
    window.onload = function(){
        let productos = document.getElementById('Productos-navbar');
        let dash = document.getElementById('Dashboard-navbar');
        let categorias = document.getElementById('Categorias-navbar');

        productos.style.borderBottom = '#ff2163 solid 3px';
        productos.style.fontWeight = 'bold';

        productos.addEventListener('click', function(){
            productos.style.borderBottom = '#ff2163 solid 3px';
        productos.style.fontWeight = 'bold';
            dash.style.borderBottom = 'none';
            dash.style.fontWeight = 'normal';
            categorias.style.borderBottom = 'none';
            categorias.style.fontWeight = 'normal';
        })

        
        dash.addEventListener('click', function(){
            productos.style.borderBottom = 'none';
            productos.style.fontWeight = 'normal';
            dash.style.borderBottom = '#ff2163 solid 3px';
            dash.style.fontWeight = 'bold';
            categorias.style.borderBottom = 'none';
            categorias.style.fontWeight = 'normal';
        })

        categorias.addEventListener('click', function(){
            productos.style.borderBottom = 'none';
            productos.style.fontWeight = 'normal';
            dash.style.borderBottom = 'none';
            dash.style.fontWeight = 'normal';
            categorias.style.borderBottom = '#ff2163 solid 3px';
            categorias.style.fontWeight = 'bold';
        }) 
    }
</script>

<!-- <script>
    window.onload = function(){

        document.getElementById('checkbox0').addEventListener('click', function(){
            document.querySelector("#checkbox1").click();
        })
    }
</script> -->