<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Perfis de Acesso</h3>

                    <a href="<?php echo BASE_URL; ?>/perfilAcesso/inserir/" class="btn btn-primary pull-right" >Novo Perfil</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Perfil de Acesso</th>
                            <th>Ação</th>
                        </tr>
                        <?php foreach($lista_perfis as $perfil): ?>
                        <tr>
                            <td><?php echo $perfil['id']; ?></td>
                            <td><?php echo $perfil['nome']; ?></td>
                            <td><a href="<?php echo BASE_URL; ?>/perfilAcesso/editar/<?php echo $perfil['id']; ?>" class="btn btn-info" 
                                   >Editar</a>
                                  
                                  <a href="<?php echo BASE_URL; ?>/perfilAcesso/excluir/<?php echo $perfil['id']; ?>" class="btn btn-danger" 
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