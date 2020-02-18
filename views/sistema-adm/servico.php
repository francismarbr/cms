<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Serviços</h3>

                    <a href="<?php echo BASE_URL; ?>/servico/inserir/" class="btn btn-primary pull-right" >Novo Serviço</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>                            
                            <th width="150">Ação</th>
                        </tr>
                        <?php foreach($lista_servicos as $servico): ?>
                        <tr>
                            <td><?php echo $servico['id']; ?></td>
                            <td><?php echo $servico['nome']; ?></td>
                            <td>
                                <a href="<?php echo BASE_URL; ?>/servico/editar/<?php echo $servico['id']; ?>" class="btn btn-info" 
                                    >Editar</a>
                                <a href="<?php echo BASE_URL; ?>/servico/excluir/<?php echo $servico['id']; ?>" class="btn btn-danger" 
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