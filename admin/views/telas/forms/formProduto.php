<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Cadastrar Produto</h3>
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
                      value="<?php echo (!empty($info_produto['id'])) ? $info_produto['nome'] : ''; ?>" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                      <label for="imagem_capa">Imagem de Capa</label>
                      <input type="file" name="imagem_capa" class="form-control" id="imagem_capa" />
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                      <label for="tipo">Preço</label>
                      <input type="text" id="preco" name="preco" class="form-control" value="<?php echo (!empty($info_produto['preco'])) ? $info_produto['preco'] : ''; ?>" />
                  </div>
                </div>

                <div class="col-md-5">
                  <div class="form-group">
                      <label for="alt_imagem_capa">Descrição Img Capa</label>
                      <input type ="text" name="alt_imagem_capa" class="form-control" id="alt_imagem_capa" 
                        value="<?php echo (!empty($info_produto['id'])) ? $info_produto['alt_imagem_capa'] : ''; ?>">
                  </div>
                </div>

                <div class="col-md-7">
                  <div class="form-group">
                      <label for="slug">Url Amigável</label>
                      <input type="text" name="slug" id="slug" class="form-control" value="<?php echo (!empty($info_produto['id'])) ? $info_produto['slug'] : ''; ?>">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                      <label for="descricao">Descrição</label>
                      <textarea name="descricao" class="form-control" id="descricao">
                        <?php echo (!empty($info_produto['id'])) ? $info_produto['descricao'] : ''; ?>
                      </textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                      <label for="fotos">Fotos do produto</label>
                      <input type="file" name="fotos[]" class="form-control" id="fotos" multiple />
                  </div>
                </div>
                
                <?php foreach($imagens_produto as $item): ?>
                  <div class="col-md-3 imagem_item">
                    
                      <img src="<?php echo URL_CMS.'/uploads/'.$item['nome_imagem']; ?>">
                      <input type="hidden" name="imagens_vinculadas[]" value="<?php echo $item['id'];?>" />
                      <br ><a href="javascript:;">[Remover]</a>
                    
                  </div>
                <?php endforeach; ?>

              </div>
              <!-- /.box-body -->

            </form>

          </div>
          <!-- /.box -->
        </div>
    </div>
</section>

<script src="https://cdn.tiny.cloud/1/gy6w5juwxko56hp34fy5c9owjed61utwmt00nsqxwrc0kbdp/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
tinymce.init({
  selector: '#descricao',
  height: 300,
  menubar:false,
  plugins:[
    'texcolor image media lists link code'
  ],
  toolbar:'undo redo | formatselect | bold italic backcolor | media image | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat | link | code',
  automatic_uploads:true,
  file_picker_types:'image',
  images_upload_url:'<?php echo URL_CMS; ?>/midia/upload_tinymce'
});
</script>