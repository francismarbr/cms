<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Cadastrar Página</h3>
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
                    <label for="txtTitulo">Título</label>
                    <input type="text" name="titulo" class="form-control" id="txtTitulo" placeholder="Digite o título" 
                      value="<?php echo (!empty($info_pagina['id'])) ? $info_pagina['titulo'] : ''; ?>" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                      <label for="imagem_capa">Imagem de Capa</label>
                      <input type="file" name="imagem_capa" class="form-control" id="imagem_capa">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                      <label for="tipo">Tipo</label>
                      <select name="tipo" id = "tipo" class="form-control">
                        <option value="post" <?php if(!empty($info_pagina['tipo']) && $info_pagina['tipo'] == "post") { echo "selected"; } ?> >Post</option>
                        <option value="pagina" <?php if(!empty($info_pagina['tipo']) && $info_pagina['tipo'] == "pagina") { echo "selected"; } ?>>Página</option>
                      </select>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                      <label for="conteudo">Conteúdo</label>
                      <textarea name="conteudo" class="form-control" id="conteudo">
                        <?php echo (!empty($info_pagina['id'])) ? $info_pagina['conteudo'] : ''; ?>
                      </textarea>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                      <label for="alt_imagem_capa">Descrição Img Capa</label>
                      <input type ="text" name="alt_imagem_capa" class="form-control" id="alt_imagem_capa" 
                        value="<?php echo (!empty($info_pagina['id'])) ? $info_pagina['alt_imagem_capa'] : ''; ?>">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                      <label for="categoria">Categoria</label>
                      <select name="categoria" id="categoria" class="form-control">
                        <option value="">Selecione</option>
                        <?php foreach($lista_categorias as $categoria): ?>
                        <option value="<?php echo $categoria['id']; ?>" <?php if (!empty($info_pagina['id_categoria']) && $categoria['id']==$info_pagina['id_categoria']) { echo "selected"; }?>>
                          <?php echo $categoria['nome']; ?>
                        </option>
                        <?php endforeach; ?>
                      </select>
                  </div>
                </div>

                <div class="col-md-5">
                  <div class="form-group">
                      <label for="slug">Url Amigável</label>
                      <input type="text" name="slug" id="slug" class="form-control" value="<?php echo (!empty($info_pagina['id'])) ? $info_pagina['slug'] : ''; ?>">
                  </div>
                </div>

                <div class="col-md-1">
                  <div class="form-group">
                      <label for="views">Nº Views</label><br />
                        <?php echo (!empty($info_pagina['id'])) ? $info_pagina['views'] : '0'; ?>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                      <label for="descricao">Descrição S.E.O</label><br />
                      <input type="text" name="descricao" id="descricao" class="form-control"
                        value="<?php echo (!empty($info_pagina['id'])) ? $info_pagina['descricao'] : ''; ?>">
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
  selector: '#conteudo',
  height: 300,
  menubar:false,
  plugins:[
    'texcolor image media lists code'
  ],
  toolbar:'undo redo | formatselect | bold italic backcolor | media image | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat | code',
  automatic_uploads:true,
  file_picker_types:'image',
  images_upload_url:'<?php echo BASE_URL; ?>/midia/upload_tinymce'
});
</script>