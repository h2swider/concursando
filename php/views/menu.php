<nav class="menu navbar navbar-default fixed col-xs-12" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navbar"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> 
        <h1><a class="navbar-brand" href="/">Concursando</a></h1>
    </div>
    <div class="collapse navbar-collapse" id="main-navbar">
        <ul class="nav navbar-nav">
            <li><a href="/participa/">Concursos</a></li>
            <li class="divider">|</li>
            <li><a href="/login/">Cre&aacute; tu concurso</a></li>
        </ul>
        <?php if (isset($_SESSION['userdata'])) { ?>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['userdata']['email']; ?><strong class="caret"></strong></a>
                    <ul class="dropdown-menu">
                        <li><a href="/perfil/">Perfil</a></li>
                        <li><a href="/ayuda/">Ayuda</a></li>
                        <li><a href="/logout/">Cerrar Sesi&oacute;n</a></li>
                    </ul>
                </li>
            </ul>
        <?php } ?>
        <form class="navbar-form navbar-right" role="search">
            <div class="input-group">
                <input type="text" class="search form-control" />
                <span class="input-group-addon glyphicon glyphicon-search"></span>
            </div> 
        </form>
    </div>
</nav>
<div class="container-fluid">
    <div class="row top-buffer-xl">
        <?php if (isset($_SESSION['userdata'])) { ?>
            <nav class="navbar col-xs-12 col-sm-2 fixed pad-top-buffer-md">
                <div class="list-group">
                    <a href="#" class="list-group-item">Crear Concurso</a>
                    <a href="#" class="list-group-item">Mis Concursos</a>
                </div>
            </nav>
        <?php } ?>
        <main class="<?php echo isset($_SESSION['userdata']) ? 'col-xs-10 col-xs-offset-2' : 'col-xs-12'; ?>">

