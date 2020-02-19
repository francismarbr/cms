<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Cadastrar Categoria</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post">
              <div class="box-body">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="txtNome">Nome</label>
                  <input type="text" name="nome" class="form-control" id="txtNome" placeholder="Digite o nome da categoria" 
                    value="<?php echo (!empty($info_categoria['id'])) ? $info_categoria['nome'] : ''; ?>" required>
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