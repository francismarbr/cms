<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Grupos de Permissão</h3>

                    <a href="<?php echo BASE_URL; ?>/painel-adm/grupoPermissao/inserir/" class="btn btn-primary pull-right" >Novo Grupo</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Grupo de Permissão</th>
                            <th>Ação</th>
                        </tr>
                        <?php foreach($lista_grupos as $grupo): ?>
                        <tr>
                            <td><?php echo $grupo['id']; ?></td>
                            <td><?php echo $grupo['nome']; ?></td>
                            <td><a href="<?php echo BASE_URL; ?>/painel-adm/grupoPermissao/editar/<?php echo $grupo['id']; ?>" class="btn btn-info" 
                                   >Editar</a>
                                  
                                  <a href="<?php echo BASE_URL; ?>/painel-adm/grupoPermissao/excluir/<?php echo $grupo['id']; ?>" class="btn btn-danger" 
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