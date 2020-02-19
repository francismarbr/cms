<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Portfolio</h3>

                    <a href="<?php echo URL_CMS; ?>/portfolio/inserir/" class="btn btn-primary pull-right" >Novo Portfolio</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Nome do Portfolio</th>
                            <th width="150">Ação</th>
                        </tr>
                        <?php foreach($lista_portfolios as $portfolio): ?>
                        <tr>
                            <td><?php echo $portfolio['id']; ?></td>
                            <td><?php echo $portfolio['nome']; ?></td>
                            <td>
                                <a href="<?php echo URL_CMS; ?>/portfolio/editar/<?php echo $portfolio['id']; ?>" class="btn btn-info" 
                                    >Editar</a>
                                <a href="<?php echo URL_CMS; ?>/portfolio/excluir/<?php echo $portfolio['id']; ?>" class="btn btn-danger" 
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