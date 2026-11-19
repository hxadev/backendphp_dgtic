<?php
?>

<table>
    <thead>
        <tr>
            <th>Curso</th>
            <th>Horas</th>
            <th>Precio</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($courses as $curso): ?>
            <tr>
                <td><?= $curso["title"] ?></td>
                <td><?= $curso["duration"] ?></td>
                <td><?= $curso["price"] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>