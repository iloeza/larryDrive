<?php
$usuarios = new UsuarioController();
$usuariosArr = $usuarios->getUsuarios(); ?>
<h2>Usuarios</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuariosArr as $k => $v) 
            { 
                $isAdmin = $v['isAdmin'] == 1 ? "Admin" : "Usuario"; ?>
                <tr>
                    <td><?php echo $v['id'] ?></td>
                    <td><?php echo $v['username']?></td>
                    <td><?php echo $isAdmin; ?></td>
                    <td>
                        <button type="button" userId=<?php echo $v['id'] ?> userRol=<?php echo $isAdmin ?> class="btn btn-<?php if ($isAdmin == "Admin") { echo "success"; } else { echo "Warning"; } ?> cambiarRol">Volver <?php if ($isAdmin === "Admin") {echo "Usuario"; } else { echo "Admin";}?></button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>