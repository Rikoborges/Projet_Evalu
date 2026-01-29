<?php
require_once __DIR__ . '/../php/dao/FieldDAO.php';
require_once __DIR__ . '/../php/entities/Field.php'; // Certifique-se que esse arquivo existe e contém a classe Field

$collectionId = (int)($_GET['collection_id'] ?? 0);

$fieldDAO = new FieldDAO(); // <--- ESTA LINHA FALTAVA

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $field = new Field($_POST);
    $field->collection_id = $collectionId;
    $fieldDAO->create($field);

    header("Location: ../../index.php?action=list");
exit;

}
?>

<h2>Ajouter un champ à la collection #<?= $collectionId ?></h2>
<form method="post">
    <label>Nom</label>
    <input type="text" name="name" required>

    <label>Libellé</label>
    <input type="text" name="label" required>

    <label>Type</label>
    <select name="type">
        <option value="text">Texte</option>
        <option value="number">Nombre</option>
        <option value="textarea">Zone de texte</option>
        <option value="choice">Liste de choix</option>
    </select>

    <label>Description</label>
    <textarea name="description"></textarea>

    <input type="submit" value="Ajouter">
</form>
