<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Cadastrar Mídia</h3>
            </div>

            <!-- /.box-header -->
            <!-- form start -->
            <form  id="formulario" method="post" enctype="multipart/form-data" action="<?php echo BASE_URL; ?>/midia/inserir">
              <div class="box-body">

                <div class="box-footer">
                  <input type="submit" class="btn btn-primary pull-right upload" value="Salvar" onclick="uploadArquivo()" />
                </div>
                
                <div class="col-md-12">
                  <div class="form-group">
                      <label for="arquivos">Imagens</label>
                      <input type="file" name="arquivo[]" class="form-control" id="arquivo" multiple required>
                  </div>
                </div>
                <div class="col-md-9">
                  <progress id="barra-progresso" value="0" max="100" style="width:100%;"></progress>  
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                      <span id="status-upload"></span>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->

            </form>
            
            <script>
              function _(el){
                return document.getElementById(el);
              }

              function uploadArquivo(){
                var arquivo = _("arquivo").files[0];
                          
                var formdata = new FormData();
                formdata.append("arquivo", arquivo);
                
                var requisicao = new XMLHttpRequest();
                requisicao.upload.addEventListener("progress", progressoUpload, false);
                requisicao.addEventListener("load", statusUpload, false);
                
                requisicao.open("POST", "<?php echo BASE_URL; ?>/midia/inserir");
                requisicao.send(formdata);
              }

              function progressoUpload(evento){
                var porcentagem = (evento.loaded / evento.total) * 100;
                _("barra-progresso").value = Math.round(porcentagem);
                _("status-upload").innerHTML = Math.round(porcentagem)+"% concluido... Aguarde!";
              }

              function statusUpload(evento){
                _("status-upload").innerHTML = evento.target.responseText;
              }
            </script>

          </div>
          <!-- /.box -->
        </div>
    </div>
</section>