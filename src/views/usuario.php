<?php

$sql = 'select * from usuarios';
$result = DatabaseHandler::getResultFromQuery($sql);

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">usuarios</h1>
        <a href="/usuario/create" class="d-none d-sm-inline-block btn btn-outline-primary shadow-sm"><i class="fas fa-plus"></i> Cadastrar Usuario</a>
    </div>

    <div class="container-fluid">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered display" id="productTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Ações</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['nome']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td class="d-sm-flex align-items-center justify-content-between">
                                    <a href="/usuario/create?update=<?= $row['id'] ?>" class="btn btn-sm btn-warning rounded-circle m-1">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <!-- <a href="/usuario/create?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger rounded-circle m-1">
                                        <i class="fa fa-trash"></i>
                                    </a> -->
                                    <a href="#" class="btn btn-sm btn-danger rounded-circle m-1" data-toggle="modal" data-target="#deleteConfirmationModal" data-id="<?= $row['id'] ?>">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Your modal HTML -->
<div class="modal" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModal">Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Têm certeza que deseja deletar este Usuario ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-outline-danger" id="confirmDelete">Deletar</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the modal and buttons
        var deleteConfirmationModal = document.getElementById('deleteConfirmationModal');
        var confirmDeleteButton = document.getElementById('confirmDelete');

        // Attach click event to the "Delete" button in the modal
        confirmDeleteButton.addEventListener('click', function() {
            // Get the product ID directly from the modal trigger button's data-id attribute
            var deleteButton = document.querySelector('.btn-danger');
            var usuarioID = deleteButton.getAttribute('data-id');

            // Make sure usuarioID is defined before proceeding
            if (usuarioID === undefined || usuarioID === null) {
                // If not defined, try to get it from the last clicked delete button
                var lastClickedDeleteButton = document.querySelector('.btn-danger[data-id]');
                if (lastClickedDeleteButton) {
                    usuarioID = lastClickedDeleteButton.getAttribute('data-id');
                } else {
                    console.error('Product ID is still undefined or null');
                    return;
                }
            }

            // Make an AJAX call to the deletion URL
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/usuario/create?delete=' + usuarioID, true);
            xhr.onload = function() {
                // Handle the success response (you might want to refresh the page or update the UI)
                if (xhr.status === 200) {
                    // Refresh the page
                    window.location.reload();
                }
            };
            xhr.onerror = function() {
                // Handle the error response
                console.error('Error making the request');
            };
            xhr.send();

            // Close the modal
            var bootstrapModal = new bootstrap.Modal(deleteConfirmationModal);
            bootstrapModal.hide();
        });
    });
</script>
