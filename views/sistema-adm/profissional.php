<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Profissional</h3>

                    <a href="<?php echo BASE_URL; ?>/profissional/inserir/" class="btn btn-primary pull-right" >Novo Profissional</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Cargo</th>
                            <th width="150">Ação</th>
                        </tr>
                        <?php foreach($lista_profissionais as $profissional): ?>
                        <tr>
                            <td><?php echo $profissional['id']; ?></td>
                            <td><?php echo $profissional['nome']; ?></td>
                            <td><?php echo $profissional['cargo']; ?></td>
                            <td>
                                <a href="<?php echo BASE_URL; ?>/profissional/editar/<?php echo $profissional['id']; ?>" class="btn btn-info" 
                                    >Editar</a>
                                <a href="<?php echo BASE_URL; ?>/profissional/excluir/<?php echo $profissional['id']; ?>" class="btn btn-danger" 
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