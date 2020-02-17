<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Clientes</h3>
                    <?php if($add_cliente) : ?>
                    <a href="<?php echo BASE_URL; ?>/cliente/inserir/" class="btn btn-primary pull-right" >Novo Cliente</a>
                    <?php endif; ?>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th width="150">Ação</th>
                        </tr>
                        <?php foreach($lista_clientes as $cliente): ?>
                        <tr>
                            <td><?php echo $cliente['id']; ?></td>
                            <td><?php echo $cliente['nome']; ?></td>
                            <td><?php echo $cliente['email']; ?></td>
                            <td><?php echo $cliente['telefone']; ?></td>
                            <td>
                              <a href="<?php echo BASE_URL; ?>/cliente/editar/<?php echo $cliente['id']; ?>" class="btn btn-info" 
                                  >Editar</a>
                              <a href="<?php echo BASE_URL; ?>/cliente/excluir/<?php echo $cliente['id']; ?>" class="btn btn-danger" 
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