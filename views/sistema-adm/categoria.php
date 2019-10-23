<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Categorias</h3>

                    <a href="<?php echo BASE_URL; ?>/categoria/inserir/" class="btn btn-primary pull-right" >Nova Categoria</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Permissão</th>
                            <th>Ação</th>
                        </tr>
                        <?php foreach($lista_categorias as $categoria): ?>
                        <tr>
                            <td><?php echo $categoria['id']; ?></td>
                            <td><?php echo $categoria['nome']; ?></td>
                            <td>
                              <a href="<?php echo BASE_URL; ?>/painel-adm/categoria/editar/<?php echo $categoria['id']; ?>" class="btn btn-info" 
                                    >Editar</a>
                              <a href="<?php echo BASE_URL; ?>/painel-adm/categoria/excluir/<?php echo $categoria['id']; ?>" class="btn btn-danger" 
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