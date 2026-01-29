<?php
$id = $_GET['id'] ?? null;
?>

<h2><?= $id ? 'Modifier' : 'Créer' ?> une collection</h2>

<form method="post">
    <label>Nom :</label>
    <input type="text" name="label" value="<?= $collection->label ?? '' ?>" required>

    <label>Description :</label>
    <textarea name="description" required><?= $collection->description ?? '' ?></textarea>

    <label>Type :</label>
    <input type="text" name="type" value="<?= $collection->type ?? '' ?>" required>

    <input type="submit" value="Enregistrer">
</form>

<a href="index.php?action=list" class="btn-back">⬅️ Retour</a>
