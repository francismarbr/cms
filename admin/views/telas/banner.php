<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Banner Slider</h3>

                    <a href="<?php echo URL_CMS; ?>/banner/inserir/" class="btn btn-primary pull-right" >Novo Banner</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Mostrar no site?</th>
                            <th>Ordem</th>
                            <th>Nome do Arquivo</th>
                            <th width="150">Ação</th>
                        </tr>
                        <?php foreach($lista_banners as $banner): ?>
                        <tr>
                            <td><?php echo $banner['id']; ?></td>
                            <td><?php echo $banner['nome']; ?></td>
                            <td><?php echo ($banner['mostrar'] == 1) ? "SIM" : "NÃO"; ?></td>
                            <td><?php echo $banner['ordem']; ?></td>
                            <td><?php echo $banner['imagem']; ?></td>
                            <td>
                            <a href="<?php echo URL_CMS; ?>/banner/editar/<?php echo $banner['id']; ?>" class="btn btn-info" >Editar</a>
                              <a href="<?php echo URL_CMS; ?>/banner/excluir/<?php echo $banner['id']; ?>" class="btn btn-danger" 
                                      onclick="return confirm('Deseja realmente excluir este registro?')">Excluir</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        <!-- /.box -->
        </div>
    </div>
</section>