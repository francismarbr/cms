<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Cadastrar Portfolio</h3>
            </div>

            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data" >
              <div class="box-body">

                <div class="box-footer">
                  <input type="submit" value="Salvar" class="btn btn-primary pull-right" />
                </div>
                
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="txtTitulo">Nome</label>
                    <input type="text" name="nome" class="form-control" id="txtTitulo" placeholder="Digite o título" 
                      value="<?php echo (!empty($info_portfolio['id'])) ? $info_portfolio['nome'] : ''; ?>" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                      <label for="imagem_capa">Imagem de Capa</label>
                      <input type="file" name="imagem_capa" class="form-control" id="imagem_capa" />
                  </div>
                </div>

                <div class="col-md-5">
                  <div class="form-group">
                      <label for="alt_imagem_capa">Descrição Img Capa</label>
                      <input type ="text" name="alt_imagem_capa" class="form-control" id="alt_imagem_capa" 
                        value="<?php echo (!empty($info_portfolio['id'])) ? $info_portfolio['alt_imagem_capa'] : ''; ?>">
                  </div>
                </div>

                <div class="col-md-7">
                  <div class="form-group">
                      <label for="slug">Url Amigável</label>
                      <input type="text" name="slug" id="slug" class="form-control" value="<?php echo (!empty($info_portfolio['id'])) ? $info_portfolio['slug'] : ''; ?>">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                      <label for="descricao">Descrição</label>
                      <textarea name="descricao" class="form-control" id="descricao">
                        <?php echo (!empty($info_portfolio['id'])) ? $info_portfolio['descricao'] : ''; ?>
                      </textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                      <label for="fotos">Fotos do portfolio</label>
                      <input type="file" name="fotos[]" class="form-control" id="fotos" multiple />
                  </div>
                </div>
                
                <?php foreach($imagens_portfolio as $item): ?>
                  <div class="col-md-3 imagem_item">
                    
                      <img src="<?php echo BASE_URL.'/uploads/'.$item['nome_imagem']; ?>">
                      <input type="hidden" name="imagens_vinculadas[]" value="<?php echo $item['id'];?>" />
                      <br ><a href="javascript:;">[Remover]</a>
                    
                  </div>
                <?php endforeach; ?>

              </div>
              <!-- /.box-body -->

            </form>
            
            <script type="text/javascript" src="<?php echo BASE_URL; ?>/plugins/ckeditor/ckeditor.js"></script>
            <script type="text/javascript">
              window.onload = function() {
                CKEDITOR.replace("descricao");
              }
            </script>

          </div>
          <!-- /.box -->
        </div>
    </div>
</section>