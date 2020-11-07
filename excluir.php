<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Vaga;

//Validação do ID
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

//Consulta a vaga selecionada
$obVaga = Vaga::getVaga($_GET['id']);

//Validação da vaga
if(!$obVaga instanceof Vaga){
    header('location: index.php?status=error');
    exit;
}

//validação do post
if(isset($_POST['excluir'])){
    
    $obVaga -> excluir();

    header('location: index.php?status=success');
    exit;
    
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/confirmar-exclusao.php';
include __DIR__.'/includes/footer.php';