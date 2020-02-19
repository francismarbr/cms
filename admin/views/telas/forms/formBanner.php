<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Cadastrar Banner</h3>
            </div>

            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <div class="box-footer">
                  <input type="submit" value="Salvar" class="btn btn-primary pull-right" />
                </div>
                
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="txtBanner">Nome Banner</label>
                    <input type="text" name="nome" class="form-control" id="txtBanner" placeholder="Digite o nome do banner" 
                      value="<?php echo (!empty($info_banner['id'])) ? $info_banner['nome'] : ''; ?>" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                      <label for="banner">Carregar Banner</label>
                      <input type="file" name="imagem_banner" class="form-control">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                      <label for="mostrar">Mostrar</label>
                      <select name="mostrar" id = "mostrar" class="form-control">
                        <option value="1" <?php if(!empty($info_banner['id']) && $info_banner['mostrar'] == "1") { echo "selected"; } ?> >SIM</option>
                        <option value="0" <?php if(!empty($info_banner['id']) && $info_banner['mostrar'] == "0") { echo "selected"; } ?>>NÃO</option>
                      </select>
                  </div>
                </div>

                <div class="col-md-5">
                  <div class="form-group">
                    <label>Ordem</label>
                    <input type="number" name="ordem" class="form-control"
                      value="<?php echo (!empty($info_banner['id'])) ? $info_banner['ordem'] : ''; ?>" required>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->

              
            </form>

          </div>
          <!-- /.box -->
        </div>
    </div>
</section>