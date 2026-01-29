<?php
require_once __DIR__ . '/../php/dao/CollectionDAO.php';
require_once __DIR__ . '/../php/dao/FieldDAO.php';

$collectionId = (int)($_GET['id'] ?? 0);

$collectionDAO = new CollectionDAO();
$fieldDAO = new FieldDAO();

$collection = $collectionDAO->getById($collectionId);
$fields = $fieldDAO->getFieldsByCollection($collectionId);

// Affichage des données soumises
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<h3>Données reçues :</h3><pre>";
    print_r($_POST);
    echo "</pre>";
}
?>

<h2>Formulaire dynamique - Collection : <?= htmlspecialchars($collection->label) ?></h2>

<form method="post">
<?php foreach ($fields as $field): ?>
    <label><?= htmlspecialchars($field->label) ?> :</label><br>

    <?php if ($field->type === 'text'): ?>
        <input type="text" name="<?= $field->name ?>" maxlength="<?= $field->length ?? '' ?>"><br><br>

    <?php elseif ($field->type === 'number'): ?>
        <input type="number" name="<?= $field->name ?>"
               <?= $field->minimum !== null ? "min=\"$field->minimum\"" : '' ?>
               <?= $field->maximum !== null ? "max=\"$field->maximum\"" : '' ?>><br><br>

    <?php elseif ($field->type === 'textarea'): ?>
        <textarea name="<?= $field->name ?>"></textarea><br><br>

    <?php elseif ($field->type === 'choice' && $field->choiceList): ?>
        <select name="<?= $field->name ?>">
            <?php foreach (explode(',', $field->choiceList) as $choice): ?>
                <option value="<?= trim($choice) ?>"><?= trim($choice) ?></option>
            <?php endforeach; ?>
        </select><br><br>

    <?php else: ?>
        <input type="text" name="<?= $field->name ?>"><br><br>
    <?php endif; ?>
<?php endforeach; ?>

    <button type="submit">Envoyer</button>
</form>
