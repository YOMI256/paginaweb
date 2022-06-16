<?php
require '../cnx.php';
$sqlInner = "SELECT * FROM books INNER JOIN categorias ON books.id_cat = categorias.id_cat;";
$psInner = $cnx->prepare($sqlInner);
$psInner->execute();
$resLibro = $psInner->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <Link rel="stylesheet" href="style.css" />
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
                <a href="#" id="Productos-navbar">Productos</a>
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

    <!--Body Center, Aqui va el contenido-->
    <div id="body-content" style="color: black;">
        <div id="btns-header" style="margin-left: 75rem; margin-top: 2rem;">
            <button id="btn-generar" class="btns-header"> <a href="informe.php" style="text-decoration: none; color: #ffffff;">Generar Informe</a> </button>
        </div>
        <div id="body-center">
            <div style=" margin-left: 2rem; margin-top: 2rem;">

                <table id="body-header-static" cellspacing="0" cellpadding="15">
                    <tr id="header-t" style="color:#7e7e7e; font-size:17px;">
                        <td style="padding-right:3rem; width: 20px; height: 20px;"><input style="width: 20px; height: 20px;" type="checkbox" onClick="toggle(this)" name="check0" id="checkbox0"></td>
                        <td style="padding-right:4rem;">Nombre</td>
                        <td>id</td>
                        <td style="padding-right:4rem;">Editorial</td>
                        <td>Categorias</td>
                        <td>Stock</td>
                        <td>Vendidos</td>
                    </tr>
                    
                        <?php foreach ($resLibro as $libros) {?>
                            <tr id="body-header-static1" style="color:black; font-weight: bold; font-size:17px; height: 5.4rem; ">
                                <td class="td-inv"><input style="width: 20px; height: 20px;" type="checkbox" name="check1" id="checkbox1"></td>
                                <td class="td-inv"><?php echo $libros['name_book'] ?></td>
                                <td class="td-inv" style="text-align: center;"><?php echo $libros['id_books'] ?></td>
                                <td class="td-inv"><?php echo $libros['edit_book'] ?></td>
                                <td class="td-inv" style="text-align: center;"><?php echo $libros['name_cat'] ?></td>
                                <td class="td-inv" style="text-align: center;"><?php echo $libros['stock_book'] ?></td>
                                <td class="td-inv" style="text-align: center;"><?php echo $libros['vendidos_book'] ?></td>
                                </td>
                                <form action="../CRUD/vendido.php" action="POST">
                                    <td><button name="id-vendido" id="btn-vendido" style="border:none;" class="btns-center" value="<?php echo $libros['id_books'] ?>">Vendido!</button></td>
                                </form>
                                <td><button type="button" id="btn-modificar" class="btns-center"><a href="..\CRUD\modificar.php?codBook=<?php echo $libros['id_books']; ?>&x=" style="text-decoration: none; color: black; ">Modificar</a></button></td>
                                <td><button type="button" id="btn-eliminar" class="btns-center"><a href="..\CRUD\eliminar.php?codBook=<?php echo $libros['id_books']; ?>&x=" style="text-decoration: none; color:white;">Eliminar</a></button> </td>
                            </tr>
                        <?php } ?>
                </table>


                <!-- <p>Nombre</p>
                    <p>Id</p>
                    <p>Editorial</p>
                    <p>Categoria</p>  
                    <p>Stock</p>
                    <p>Vendidos</p>             
                    
                </div>
                
                <div id="body-header-static1" style="display: inline-flex; margin-left: 2rem; margin-top: 2rem; font-weight: bold;">
                
                    <input type="checkbox" name="check1" id="checkbox1">
                    <p id="nombrelibro">// echo $libros['name_book']?></p>
                    <p id="idlibro">// echo $libros['id_books']?></p>
                    <p id="idEditorial"> //echo $libros['edit_book']?></p>
                    <p id="categorialibro">< //echo $libros['id_cat']?></p>
                    <p id="stocklibro"><// echo $libros['stock_book']?></p>
                    <p id="vendidoslibro">3</p></td>
                    <div class="btn-centro" style="margin-left: 4.5rem; margin-top: -0.5rem;">
                        <button id="btn-vendido" class="btns-center">Vendido!</button>
                        
                        
                        <!--<button id="btn-eliminar" class="btns-center">Eliminar Unidad</button>-->
            </div>

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
                <button id="btn-search"> <img src="..\img\lupa.PNG" alt=""> </button>
            </div>
            <div class="desplegables" id="id">
                <p>ID</p>
                <select id="select" name="selectid">
                    <option class="option" value="value1" selected>Todos</option>
                    <option class="option" value="value2"> hay que poner cosas aki feos</option>
                    <option class="option" value="value3"> hay que poner cosas aki feos</option>
                </select>
            </div>
            <div class="desplegables" id="nombre">
                <p>Nombre</p>
                <select id="select" class="select1" name="selectnombre">
                    <option class="option" value="value1" selected> Todos</option>
                    <option class="option" value="value2"> hay que poner cosas aki feos</option>
                    <option class="option" value="value3"> hay que poner cosas aki feos</option>
                </select>
            </div>
            <div class="desplegables" id="grupo">
                <p>Grupo</p>
                <select id="select" class="select2" name="selectgrupo">
                    <option class="option" value="value1" selected> Todos</option>
                    <option class="option" value="value2"> hay que poner cosas aki feos</option>
                    <option class="option" value="value3"> hay que poner cosas aki feos</option>
                </select>
            </div>
            <div class="desplegables" id="categoria">
                <p>Categoria</p>
                <select id="select" class="select3" name="selectcategoria">
                    <option class="option" value="value1" selected> Todos</option>
                    <option class="option" value="value2"> hay que poner cosas aki feos</option>
                    <option class="option" value="value3"> hay que poner cosas aki feos</option>
                </select>
            </div>
            <div id="asendente-desendente" style="margin-top: 2rem;">
                <input type="radio" id="asendente" name="orden" value="AS">
                <label for="asendente">Asendente</label><br>
                <input type="radio" id="desendente" name="orden" value="DE">
                <label for="desendente">Desendente</label><br>
            </div>
            <div id="botones-sidebar">
                <input style="cursor: pointer;" type="button" id="clean" value="Limpiar Filtros">
                <input style="cursor: pointer;" type="submit" id="apply" value="Aplicar">
            </div>
            <div id="img-logo">
                <img style="width: 5rem; margin-top: 14rem;" src="..\img\libronegro.PNG" alt="">
            </div>
        </div>
    </div>
    <!--Barra Lateral end-->
</body>

</html>
<script>
    window.onload = function() {
        let productos = document.getElementById('Productos-navbar');
        let dash = document.getElementById('Dashboard-navbar');
        let categorias = document.getElementById('Categorias-navbar');
        productos.style.borderBottom = '#ff2163 solid 3px';
        productos.style.fontWeight = 'bold';

        productos.addEventListener('click', function() {
            productos.style.borderBottom = '#ff2163 solid 3px';
            productos.style.fontWeight = 'bold';
            dash.style.borderBottom = 'none';
            dash.style.fontWeight = 'normal';
            categorias.style.borderBottom = 'none';
            categorias.style.fontWeight = 'normal';
        })

        dash.addEventListener('click', function() {
            productos.style.borderBottom = 'none';
            productos.style.fontWeight = 'normal';
            dash.style.borderBottom = '#ff2163 solid 3px';
            dash.style.fontWeight = 'bold';
            categorias.style.borderBottom = 'none';
            categorias.style.fontWeight = 'normal';
        })

        categorias.addEventListener('click', function() {
            productos.style.borderBottom = 'none';
            productos.style.fontWeight = 'normal';
            dash.style.borderBottom = 'none';
            dash.style.fontWeight = 'normal';
            categorias.style.borderBottom = '#ff2163 solid 3px';
            categorias.style.fontWeight = 'bold';
        })
    }

    function toggle(source) {
        checkboxes = document.getElementsByName('check1');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
    }

    document.querySelector("#clean").addEventListener("click", function() {
        document.querySelector("#select").value = "value1";
        document.querySelector(".select1").value = "value1";
        document.querySelector(".select2").value = "value1";
        document.querySelector(".select3").value = "value1";
    })
</script>