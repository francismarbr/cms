<!-- Main content -->
<section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Cadastrar Grupo de Permissões</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post">
              <div class="box-body">
                <div class="col-md-6">
                  
                  <div class="form-group">
                    <label for="txtNome">Nome do Grupo</label>
                    <input type="text" name="nome" class="form-control" id="txtNome" 
                      value="<?php  echo (!empty($info_grupo['id'])) ? $info_grupo['nome'] : ''; ?>" placeholder="Digite o nome do grupo" required>
                  </div>
                  
                  <div class="box box-success">
                    <div class="box-header">
                      <h3 class="box-title">Selecione as Permissões desse Grupo</h3>
                    </div>
                    
                    <div class="box-body">
                      <?php foreach($lista_permissoes as $permissao): ?>
                      <div class="form-group">
                        <label>
                          <input type="checkbox" name="permissoes[]" value="<?php echo $permissao['id']; ?>" class="minimal"
                            <?php
                              //se existir informações do grupo significa que um pedido de edição foi feito 
                              if(!empty($info_grupo['id'])) {
                                //verifica se a permissão existe dentro das permissões do grupo selecionado, caso sim, marca com checked 
                                echo (in_array($permissao['id'], $info_grupo['permissoes'])) ? 'checked="checked"':''; 
                              }
                            ?>
                          />
                        <?php echo $permissao['nome']; ?>
                        </label>
                      </div>
                      <?php endforeach; ?>
                    </div>
                    
                  </div>    

                </div>
              </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <input type="submit" value="Salvar" class="btn btn-primary pull-right" />
            </div>
          </form>
        </div>
        <!-- /.box -->
      </div>
    </div>
</section>