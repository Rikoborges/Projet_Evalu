<?php

// Contrôleur pour la gestion des collections

require_once __DIR__ . '/../dao/CollectionDAO.php';
require_once __DIR__ . '/../entities/Collection.php';

// get
$action = $_GET['action'] ?? 'list';

$dao = new CollectionDAO();

switch ($action) {

    // 
    case 'list':
    default:

        $collections = $dao->getAll();


        include __DIR__ . '/../../views/collection_list.php';
        break;


    case 'create':


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $collection = new Collection($_POST);


            $dao->create($collection);


            header('Location: index.php?action=list');
            exit;
        }


        include __DIR__ . '/../../views/collection_form.php';
        break;


    case 'edit':


        $id = (int)($_GET['id'] ?? 0);


        $collection = $dao->getById($id);


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $collection->label = $_POST['label'];
            $collection->description = $_POST['description'];
            $collection->type = $_POST['type'];


            $dao->update($collection);


            header('Location: index.php?action=list');
            exit;
        }


        include __DIR__ . '/../../views/collection_form.php';
        break;
}
