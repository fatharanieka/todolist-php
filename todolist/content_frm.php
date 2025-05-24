<?php
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

// Menandai tugas sebagai selesai atau menghapus tugas
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_action'])) {
    // Jika ada tugas yang dipilih untuk diselesaikan atau dihapus
    if (isset($_POST['selected_tasks'])) {
        $selected_tasks = $_POST['selected_tasks'];

        if ($_POST['task_action'] === 'complete') {
            // Menandai tugas yang dipilih sebagai selesai
            foreach ($selected_tasks as $task_index) {
                $_SESSION['tasks'][$task_index]['completed'] = true;
            }
        } elseif ($_POST['task_action'] === 'delete') {
            // Menghapus tugas yang dipilih
            foreach ($selected_tasks as $task_index) {
                unset($_SESSION['tasks'][$task_index]);
            }
            $_SESSION['tasks'] = array_values($_SESSION['tasks']); // Reindex array
        }
    }
}
?>

<h4>FORM TAMBAH TUGAS</h4>
<hr>
<form method="POST" action="">
    <div class="form-group">
        <label class="control-label col-sm-3">Tambahkan Tugas Baru :</label>
        <div class="col-sm-9">
            <input type="text" name="new_task" placeholder="Tambahkan Tugas Baru" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <br>
            <button type="submit" class="btn btn-info">Tambah Tugas</button>
            </br>
        </div>
    </div>
</form>

<h4>DAFTAR TUGAS</h4>
<form method="POST" action="">
    <ul class="task-list">
        <?php foreach ($_SESSION['tasks'] as $index => $task) : ?>
            <li class="task-item">
                <!-- Checkbox untuk menandai tugas -->
                <input type="checkbox" name="selected_tasks[]" value="<?= $index ?>" <?= $task['completed'] ? 'checked' : '' ?>> 
                <label class="<?= $task['completed'] ? 'completed' : '' ?>"><?= $task['task'] ?></label>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Tombol untuk menandai tugas selesai atau menghapus tugas -->
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" name="task_action" value="complete" class="btn btn-warning">Tandai Selesai</button>
            <button type="submit" name="task_action" value="delete" class="btn btn-danger">Hapus Tugas</button>
        </div>
    </div>
</form>

<br><br>