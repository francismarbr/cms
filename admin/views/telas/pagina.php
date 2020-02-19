<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Páginas e Posts</h3>

                    <a href="<?php echo URL_CMS; ?>/pagina/inserir/" class="btn btn-primary pull-right" >Nova Página</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th width="150">Ação</th>
                        </tr>
                        <?php foreach($lista_paginas as $pagina): ?>
                        <tr>
                            <td><?php echo $pagina['id']; ?></td>
                            <td><?php echo $pagina['titulo']; ?></td>
                            <td><?php echo $pagina['tipo']; ?></td>
                            <td>
                              <a href="<?php echo URL_CMS; ?>/pagina/editar/<?php echo $pagina['id']; ?>" class="btn btn-info" 
                                    >Editar</a>
                              <a href="<?php echo URL_CMS; ?>/pagina/excluir/<?php echo $pagina['id']; ?>" class="btn btn-danger" 
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