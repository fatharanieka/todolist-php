<?php
// Menyimpan daftar tugas dalam array (seharusnya menggunakan database untuk aplikasi lebih besar)
session_start();

// Inisialisasi daftar tugas dalam sesi jika belum ada
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

// Menambahkan tugas baru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_task'])) {
    $new_task = htmlspecialchars($_POST['new_task']);
    $_SESSION['tasks'][] = ['task' => $new_task, 'completed' => false];
}

// Menandai tugas sebagai selesai
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['completed'])) {
    $task_index = $_POST['completed'];
    $_SESSION['tasks'][$task_index]['completed'] = true;
}

// Menghapus tugas
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_task'])) {
    $task_index = $_POST['delete_task'];
    unset($_SESSION['tasks'][$task_index]);
    $_SESSION['tasks'] = array_values($_SESSION['tasks']); // Reindex array
}
?>


<h4>SELAMAT DATANG DI WEB TO DO LIST!</h4>
<hr>

<table class="table table-bordered">
	<thead>
	<tr>
		<th width=2%>No</th>
		<th>Daftar Tugas</th>
		<th>Action</th>
	</tr>
	</thead>
	<tbody>
	<ul class="task-list">
        <?php foreach ($_SESSION['tasks'] as $index => $task) : ?>
            <li class="task-item">
                <!-- Menandai tugas selesai -->
                <form method="POST" style="display:inline;">
                    <input type="checkbox" name="completed" value="<?= $index ?>" <?= $task['completed'] ? 'checked' : '' ?>>
                    <label class="<?= $task['completed'] ? 'completed' : '' ?>"><?= $task['task'] ?></label>
                    <button type="submit" class="task-actions">Tandai Selesai</button>
                </form>

                <!-- Tombol untuk menghapus tugas -->
                <form method="POST" style="display:inline;">
                    <button type="submit" name="delete_task" value="<?= $index ?>" class="task-actions">Hapus</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
	
	</tbody>
</table>
<br>
<br>