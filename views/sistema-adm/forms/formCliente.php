<!-- Main content -->
<section class="content">
    <?php if(isset($msg_informativa) && !empty($msg_informativa)): ?>
    <div class="box-body">
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Registro não foi salvo!</h4>
        <?php echo $msg_informativa; ?>
      </div>
    </div>
    <?php endif; ?>

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Cadastrar Cliente</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post">
              <div class="box-body">
                <div class="row">
                  
                  <div class="col-xs-3">
                      <label for="txtNome">Nome</label>
                      <input type="text" name="nome" class="form-control" id="txtNome" placeholder="Digite o nome" 
                        value="<?php echo (!empty($info_cliente['id'])) ? $info_cliente['nome'] : ''; ?>" required>
                  </div>

                  <div class="col-xs-3">
                      <label for="txtNome">Email</label>
                      <input type="email" name="email" class="form-control" id="txtEmail" placeholder="Digite o email" 
                        value="<?php echo (!empty($info_cliente['id'])) ? $info_cliente['email'] : ''; ?>" 
                        <?php if(!empty($info_cliente['id'])): ?> 
                        readonly="true"  
                        <?php endif; ?>
                      />
                  </div>
                  
                  <div class="col-xs-3">
                      <label for="txtTelefone">Telefone</label>
                      <input type="text" name="telefone" class="form-control" id="txtTelefone" placeholder="Digite o telefone" 
                        value="<?php echo (!empty($info_cliente['id'])) ? $info_cliente['telefone'] : ''; ?>" required>
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