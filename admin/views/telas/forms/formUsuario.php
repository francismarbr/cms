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
              <h3 class="box-title">Cadastrar Usuário</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post">
              <div class="box-body">
                <div class="row">
                  
                  <div class="col-xs-3">
                      <label for="txtNome">Nome</label>
                      <input type="text" name="nome" class="form-control" id="txtNome" placeholder="Digite o nome" 
                        value="<?php echo (!empty($info_usuario['id'])) ? $info_usuario['nome'] : ''; ?>" required>
                  </div>

                  <div class="col-xs-3">
                      <label for="txtNome">Email</label>
                      <input type="email" name="email" class="form-control" id="txtEmail" placeholder="Digite o email" 
                        value="<?php echo (!empty($info_usuario['id'])) ? $info_usuario['email'] : ''; ?>" 
                        <?php if(!empty($info_usuario['id'])): ?> 
                        readonly="true"  
                        <?php endif; ?>
                      />
                  </div>
                  
                  <div class="col-xs-3">
                      <label for="txtLogin">Login</label>
                      <input type="text" name="login" class="form-control" id="txtLogin" placeholder="Digite o login para este usuário" 
                        value="<?php echo (!empty($info_usuario['id'])) ? $info_usuario['login'] : ''; ?>" required>
                  </div>
                  
                  <div class="col-xs-3">
                       <label for="txtSenha">Senha</label>
                      <input type="password" name="senha" class="form-control" id="txtSenha" placeholder="Digite a senha" 
                        <?php if(empty($info_usuario['id'])): ?> required <?php endif; ?>>
                  </div>

                </div>

                <div class="row">
                  <div class="col-xs-6">
                    <label>Perfil de Acesso</label>
                    <select class="form-control" name="perfil">
                      <option value="">Selecione um perfil</option>
                    <?php foreach($lista_perfis as $perfil): ?>
                      <option value="<?php echo $perfil['id']; ?>" <?php if(isset($info_usuario['perfil_acesso_id']) && $perfil['id']==$info_usuario['perfil_acesso_id']): ?> selected="selected" <?php endif; ?> >
                      <?php echo $perfil['nome']; ?>
                      </option>
                    <?php endforeach; ?>
                    </select>
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