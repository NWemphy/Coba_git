<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
require 'database.php';
$user_id = $_SESSION['user_id'];
$ToDoList = $conn->query("SELECT * FROM ToDoList WHERE user_id = $user_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>To Do List</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #eef4fa;
            margin: 0;
            padding: 0;
        }

        .todo-container {
            max-width: 700px;
            margin: 60px auto;
            padding: 30px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        header h2 {
            color: #2b3a67;
            margin: 0;
        }

        header a {
            color: #fff;
            background: #2b3a67;
            padding: 6px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
        }

        form {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }

        input[type="text"] {
            flex: 1;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        button {
            background-color: #4285f4;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 16px;
            font-size: 14px;
            cursor: pointer;
        }

        button.disabled {
            background-color: #ccc;
            cursor: default;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            background: #f0f6ff;
            border: 1px solid #d1e3ff;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .done-text {
            text-decoration: line-through;
            color: #888;
        }

        .btn-group {
            display: flex;
            gap: 8px;
        }

        .btn-group a button {
            background-color: #6c9ef8;
        }

        .btn-group a button:hover {
            background-color: #3367d6;
        }

        .btn-group a:last-child button {
            background-color: #e74c3c;
        }

        .btn-group a:last-child button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<div class="todo-container">
    <header>
        <h2>Daftar kegiatan <?= htmlspecialchars($_SESSION['user']) ?></h2>
        <a href="process.php?action=logout">Logout</a>
    </header>

    <form action="process.php" method="POST">
        <input type="text" name="ToDoList" placeholder="Tambahkan Kegiatan?" required>
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <ul>
        <?php while ($row = $ToDoList->fetch_assoc()): ?>
            <li> 
            <span class="<?= $row['status'] === 'done' ? 'done-text' : '' ?>">
                    <?= htmlspecialchars($row['kegiatan']) ?>
                </span>
                <div class="btn-group">
                    <?php if ($row['status'] !== 'done'): ?>
                        <a href="process.php?selesai=<?= $row['id_kegiatan'] ?>"><button>Selesai</button></a>
                    <?php else: ?>
                        <button class="disabled">Selesai</button>
                    <?php endif; ?>
                    <a href="process.php?hapus=<?= $row['id_kegiatan'] ?>"><button>Hapus</button></a>
                </div>
            </li>
        <?php endwhile; ?>
    </ul>
</div>

</body>
</html>
