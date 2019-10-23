<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Usuários</h3>
                    <a href="<?php echo BASE_URL; ?>/usuario/inserir/" class="btn btn-primary pull-right" >Novo Usuário</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Login</th>
                            <th>Perfil de Acesso</th>
                            <th>Ação</th>
                        </tr>
                        <?php foreach($lista_usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo $usuario['id']; ?></td>
                            <td><?php echo $usuario['nome']; ?></td>
                            <td><?php echo $usuario['email']; ?></td>
                            <td><?php echo $usuario['login']; ?></td>
                            <td><?php echo $usuario['perfil_acesso']; ?></td>
                            <td>
                              <a href="<?php echo BASE_URL; ?>/usuario/editar/<?php echo $usuario['id']; ?>" class="btn btn-info" 
                                  >Editar</a>
                              <a href="<?php echo BASE_URL; ?>/usuario/excluir/<?php echo $usuario['id']; ?>" class="btn btn-danger" 
                                  onclick="return confirm('Deseja realmente excluir este registro?')">Excluir</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        <!-- /.box -->
        </div>
    </div>
</section>