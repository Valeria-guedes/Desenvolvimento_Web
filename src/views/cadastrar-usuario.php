<!-- Begin Page Content -->
<div class="container">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= !$isUpdate ? 'Cadastrar Novo' : 'Atualizar' ?> Usuario</h1>
        <a href="/usuario" class="d-none d-sm-inline-block btn btn-outline-primary shadow-sm"><i class="fas fa-list"></i> Usuarios</a>
    </div>
    <?php
    include(TEMPLATE_PATH . '/messages.php');
    ?>

    <div class="row">
        <form class="row g-3" action="#" method="post">
          
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= isset($nome) ? $nome : null ?>" required>
                <!-- <div class="valid-feedback">
                    Looks good!
                </div> -->
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= isset($email) ? $email : null ?>" required>
                <!-- <div class="valid-feedback">
                    Looks good!
                </div> -->
            </div>
            <div class="col-md-6">
                <label for="senha" class="form-label">Senha</label>
                <input type="text" class="form-control" id="senha" name="senha" value="<?= isset($senha) ? $senha : null ?>" required>
                <!-- <div class="valid-feedback">
                    Looks good!
                </div> -->
            </div>
            <div class="col-12 mt-4">
                <button class="btn <?= !$isUpdate ? 'btn-outline-primary' : 'btn-outline-success' ?>" 
                type="submit"><?= !$isUpdate ? 'Cadastrar' : 'Atualizar' ?></button>
            </div>
        </form>
    </div>


</div>
<!-- /.container-fluid -->