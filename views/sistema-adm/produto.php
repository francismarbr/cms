<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Produto</h3>

                    <a href="<?php echo BASE_URL; ?>/produto/inserir/" class="btn btn-primary pull-right" >Novo Produto</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Nome do Produto</th>
                            <th width="150">Ação</th>
                        </tr>
                        <?php foreach($lista_produtos as $produto): ?>
                        <tr>
                            <td><?php echo $produto['id']; ?></td>
                            <td><?php echo $produto['nome']; ?></td>
                            <td>
                                <a href="<?php echo BASE_URL; ?>/produto/editar/<?php echo $produto['id']; ?>" class="btn btn-info" 
                                    >Editar</a>
                                <a href="<?php echo BASE_URL; ?>/produto/excluir/<?php echo $produto['id']; ?>" class="btn btn-danger" 
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