<h2>Liste des collections</h2>

<a href="index.php?action=create">➕ Nouvelle collection</a>

<ul>
<?php foreach ($collections as $col): ?>
    <li>
        <div class="collection-info">
            <?= htmlspecialchars($col->label) ?> (<?= htmlspecialchars($col->type) ?>)
        </div>
        <div class="collection-actions">
            <a href="index.php?action=edit&id=<?= $col->id ?>" class="btn">✏️ Modifier</a>
            <a href="views/field_form.php?collection_id=<?= $col->id ?>" class="btn">➕ Ajouter champ</a>
        </div>
    </li>
<?php endforeach; ?>
</ul>



