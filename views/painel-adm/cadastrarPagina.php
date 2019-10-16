<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Cadastrar Permissão</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post">
              <div class="box-body">
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="txtNome">Nome</label>
                    <input type="text" name="nome" class="form-control" id="txtNome" placeholder="Digite o nome da permissão" 
                      value="<?php echo (!empty($info_permissao['id'])) ? $info_permissao['nome'] : ''; ?>" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                      <label for="imagem_capa">Imagem de Capa</label>
                      <input type="file" name="imagem_capa" class="form-control" id="imagem_capa">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                      <label for="conteudo">Conteúdo</label>
                      <textarea name="conteudo" class="form-control" id="conteudo"></textarea>
                  </div>
                </div>


              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="submit" value="Salvar" class="btn btn-primary pull-right" />
              </div>
            </form>

            <script type="text/javascript" src="<?php echo BASE_URL; ?>/plugins/ckeditor/ckeditor.js"></script>
            <script type="text/javascript">
              window.onload = function() {
                CKEDITOR.replace("conteudo");
              }
            </script>

          </div>
          <!-- /.box -->
        </div>
    </div>
</section>