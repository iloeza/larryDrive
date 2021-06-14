        <?php
        $archivos = new ArchivoController(); ?>

        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#crearDirModal">
            <img src="Public/assets/foldericon.png" alt="" width="30" height="30">
            Crear carpeta
        </button>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#subirArchivoModal">
            <img src="Public/assets/archivoicon.png" alt="" width="30" height="30">
            Subir archivo
        </button>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <?php $rutasActivas = empty($_SESSION['ruta']) ? false : true; ?>
                <li class="breadcrumb-item <?php echo $rutasActivas ? "" : "active"; ?>"><span class="getDir" point="-1">Home</span></li>
                <?php if ($rutasActivas !== "active") {
                    $point = 0; ?>
                    <?php foreach ($_SESSION['ruta'] as $ruta) { ?>
                        <li class="breadcrumb-item active"><span class="getDir" point=<?php echo $point; ?>><?php echo $ruta; ?></span></li>
                <?php
                        $point++;
                    }
                } ?>
            </ol>
        </nav>
        <?php $archivosDir = $archivos->GetArchivos(); ?>
        </div>

        <h1 class="h2">Carpetas</h1>
        <div class="container">
            <div class="row">
                <?php if (empty($archivosDir['dirs'])) { ?>
                    <div class="col-12">
                        <div class="text-center">
                            <h4 class="text-secondary">Oops... Nada por aquí, nada por allá.</h4>
                        </div>
                    </div>
                    <?php } else {

                    foreach ($archivosDir['dirs'] as $k => $v) { ?>
                        <div class="col-3">
                            <div class="text-center">
                                <img class="mb-4" src="Public/assets/folder.png" alt="" width="72" height="72">
                                <p class='getDir'><b><?php echo $v['NombreDir'] ?></b></p>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>

        <h2>Archivos</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Nombre de archivos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($archivosDir['files'] as $k => $v) { ?>
                        <tr>
                            <td><a href="<?php echo $v['Ruta'] ?>" download><?php echo $v['NombreArchivo'] ?></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>