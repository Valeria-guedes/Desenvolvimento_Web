<?php

session_start();

$exception = null;
$userData = [];
$isUpdate = false;

if (count($_POST) === 0 && isset($_GET['update'])) {
    $usuario = findUsuario($_GET['update']);
    $userData = $usuario->getValues();
    $isUpdate = true;
    addSuccessMessage('Usuario atualizado com sucesso!');
} elseif (count($_POST) > 0) {
    try {
        $usuarioId = $_GET['update'];
        $usuario = $usuarioId != null ? findUsuario($usuarioId) : new Usuario($_POST);
        if ($usuario->id) {
            $isUpdate = true;
            //Autalizando o usuario no banco de dados;
            $usuario->update();
            addSuccessMessage('Usuario atualizado com sucesso!');
            header('Location: /usuario');
            exit();
        } else {
            // Inserindo o usuario no banco de dados;        
            $usuario->insert();
            addSuccessMessage('Usuario cadastrado com sucesso!');
        }

        $_POST = [];
    } catch (Exception $e) {
        $exception = $e;   
    } finally {
        $userData = $_POST;
    }
} elseif (isset($_GET['delete'])) {
    $usuario = findUsuario($_GET['delete']);
    $usuario->delete();
    header('Location: /usuario');
    exit();
}

function findUsuario($usuarioId)
{
    $usuario = Usuario::getOne([
        'id' => $usuarioId
    ]);

    return $usuario;
}

loadTemplateView('cadastrar-usuario', $userData + [
    'exception' => $exception,
    'isUpdate' => $isUpdate
]);
