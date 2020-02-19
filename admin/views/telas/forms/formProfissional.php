<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Cadastrar Profissional</h3>
            </div>

            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data" >
              <div class="box-body">

                <div class="box-footer">
                  <input type="submit" value="Salvar" class="btn btn-primary pull-right" />
                </div>
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="txtTitulo">Nome</label>
                    <input type="text" name="nome" class="form-control" id="txtTitulo" placeholder="Digite o título" 
                      value="<?php echo (!empty($info_profissional['id'])) ? $info_profissional['nome'] : ''; ?>" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                      <label for="imagem_capa">Foto</label>
                      <input type="file" name="imagem_capa" class="form-control" id="imagem_capa" />
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                      <label for="alt_imagem_capa">Descrição da foto</label>
                      <input type ="text" name="alt_imagem_capa" class="form-control" id="alt_imagem_capa" 
                        value="<?php echo (!empty($info_profissional['id'])) ? $info_profissional['alt_imagem_capa'] : ''; ?>">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                      <label for="cargo">Cargo</label>
                      <input type ="text" name="cargo" class="form-control" id="cargo" 
                        value="<?php echo (!empty($info_profissional['id'])) ? $info_profissional['cargo'] : ''; ?>">
                  </div>
                </div>

                <div class="col-md-7">
                  <div class="form-group">
                      <label for="slug">Url Amigável</label>
                      <input type="text" name="slug" id="slug" class="form-control" value="<?php echo (!empty($info_profissional['id'])) ? $info_profissional['slug'] : ''; ?>">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                      <label for="descricao">Descrição</label>
                      <textarea name="descricao" class="form-control" id="descricao">
                        <?php echo (!empty($info_profissional['id'])) ? $info_profissional['descricao'] : ''; ?>
                      </textarea>
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