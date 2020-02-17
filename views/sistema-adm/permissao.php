<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Permissões</h3>

                    <a href="<?php echo BASE_URL; ?>/permissao/inserir/" class="btn btn-primary pull-right" >Nova Permissão</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Permissão</th>
                            <th width="150">Ação</th>
                        </tr>
                        <?php foreach($lista_permissoes as $permissao): ?>
                        <tr>
                            <td><?php echo $permissao['id']; ?></td>
                            <td><?php echo $permissao['nome']; ?></td>
                            <td>
                              <a href="<?php echo BASE_URL; ?>/permissao/editar/<?php echo $permissao['id']; ?>" class="btn btn-info" 
                                    >Editar</a>
                              <a href="<?php echo BASE_URL; ?>/permissao/excluir/<?php echo $permissao['id']; ?>" class="btn btn-danger" 
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

    <div class="modal modal-danger fade" id="modal-danger">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Danger Modal</h4>
              </div>
              <div class="modal-body">
                <p>One fine body&hellip;</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

</section>