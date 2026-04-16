<?php
session_start();
include 'database/db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

$stmt = $conn->prepare("SELECT id, title, description, deadline, status, priority, created_at 
                        FROM tasks 
                        WHERE user_id = ? 
                        ORDER BY 
                        CASE WHEN deadline IS NULL THEN 1 ELSE 0 END,
                        deadline ASC,
                        created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$resultTasks = $stmt->get_result();

$tasks = [];
while ($row = $resultTasks->fetch_assoc()) {
    $tasks[] = $row;
}
$stmt->close();

$totalTasks = count($tasks);
$completedTasks = 0;
$inProgressTasks = 0;
$todoTasks = 0;

foreach ($tasks as $task) {
    if ($task['status'] === 'finalizat') {
        $completedTasks++;
    } elseif ($task['status'] === 'in_progres') {
        $inProgressTasks++;
    } else {
        $todoTasks++;
    }
}

$progressPercent = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

$currentMonth = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('n');
$currentYear = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');

if ($currentMonth < 1 || $currentMonth > 12) {
    $currentMonth = (int)date('n');
}
if ($currentYear < 2020 || $currentYear > 2100) {
    $currentYear = (int)date('Y');
}

$firstDayOfMonth = mktime(0, 0, 0, $currentMonth, 1, $currentYear);
$daysInMonth = (int)date('t', $firstDayOfMonth);
$monthName = date('F Y', $firstDayOfMonth);
$startDayOfWeek = (int)date('N', $firstDayOfMonth);

$monthNamesRo = [
    'January' => 'Ianuarie',
    'February' => 'Februarie',
    'March' => 'Martie',
    'April' => 'Aprilie',
    'May' => 'Mai',
    'June' => 'Iunie',
    'July' => 'Iulie',
    'August' => 'August',
    'September' => 'Septembrie',
    'October' => 'Octombrie',
    'November' => 'Noiembrie',
    'December' => 'Decembrie'
];

$monthName = strtr($monthName, $monthNamesRo);

$taskDates = [];
foreach ($tasks as $task) {
    if (!empty($task['deadline'])) {
        $taskDates[$task['deadline']][] = $task;
    }
}

$prevMonth = $currentMonth - 1;
$prevYear = $currentYear;
if ($prevMonth < 1) {
    $prevMonth = 12;
    $prevYear--;
}

$nextMonth = $currentMonth + 1;
$nextYear = $currentYear;
if ($nextMonth > 12) {
    $nextMonth = 1;
    $nextYear++;
}

$today = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Study Planner</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

<header class="navbar">
    <div class="logo">
        <span class="logo-black">Study</span><span class="logo-green"> Planner</span>
    </div>

    <div class="nav-right">
        <span class="welcome-text">Bun venit, <?php echo e($username); ?>!</span>
        <a href="php/logout.php" class="logout-btn">Logout</a>
    </div>
</header>

<main class="page">
    <section class="page-header">
        <h1>Dashboard</h1>
        <p>Planifică-ți taskurile, urmărește progresul și vezi toate deadline-urile într-un singur loc.</p>
    </section>

    <section class="stats-grid">
        <div class="stat-card">
            <h3>Total taskuri</h3>
            <div class="stat-number"><?php echo $totalTasks; ?></div>
        </div>

        <div class="stat-card">
            <h3>Finalizate</h3>
            <div class="stat-number"><?php echo $completedTasks; ?></div>
        </div>

        <div class="stat-card">
            <h3>În progres</h3>
            <div class="stat-number"><?php echo $inProgressTasks; ?></div>
        </div>

        <div class="stat-card">
            <h3>Progres general</h3>
            <div class="stat-number"><?php echo $progressPercent; ?>%</div>
            <div class="progress-bar-wrap">
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo $progressPercent; ?>%;"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="main-grid">
        <aside class="left-column">
            <div class="card">
                <h2 class="card-title">Adaugă task nou</h2>

                <form action="php/add_task.php" method="POST" class="task-form">
                    <label for="title">Titlu task</label>
                    <input type="text" id="title" name="title" placeholder="Ex: Finalizează laboratorul la SQL" required>

                    <label for="description">Descriere</label>
                    <textarea id="description" name="description" placeholder="Scrie detalii despre task..."></textarea>

                    <label for="deadline">Deadline</label>
                    <input type="date" id="deadline" name="deadline">

                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="de_facut">De realizat</option>
                        <option value="in_progres">În progres</option>
                        <option value="finalizat">Finalizat</option>
                    </select>

                    <label for="priority">Prioritate</label>
                    <select id="priority" name="priority">
                        <option value="mica">Mică</option>
                        <option value="medie" selected>Medie</option>
                        <option value="mare">Mare</option>
                    </select>

                    <button type="submit" class="submit-btn">Adaugă task</button>
                </form>
            </div>
        </aside>

        <section class="right-column">
            <div class="card calendar-card">
                <div class="calendar-top">
                    <div class="calendar-month"><?php echo e($monthName); ?></div>
                    <div class="calendar-nav">
                        <a href="dashboard.php?month=<?php echo $prevMonth; ?>&year=<?php echo $prevYear; ?>">← Luna precedentă</a>
                        <a href="dashboard.php?month=<?php echo $nextMonth; ?>&year=<?php echo $nextYear; ?>">Luna următoare →</a>
                    </div>
                </div>

                <div class="calendar-grid">
                    <div class="day-name">Lun</div>
                    <div class="day-name">Mar</div>
                    <div class="day-name">Mie</div>
                    <div class="day-name">Joi</div>
                    <div class="day-name">Vin</div>
                    <div class="day-name">Sâm</div>
                    <div class="day-name">Dum</div>

                    <?php
                    for ($blank = 1; $blank < $startDayOfWeek; $blank++) {
                        echo '<div class="calendar-day empty"></div>';
                    }

                    for ($day = 1; $day <= $daysInMonth; $day++) {
                        $currentDate = sprintf('%04d-%02d-%02d', $currentYear, $currentMonth, $day);
                        $classes = 'calendar-day';

                        if ($currentDate === $today) {
                            $classes .= ' today';
                        }

                        if (isset($taskDates[$currentDate])) {
                            $classes .= ' has-task';
                        }

                        echo '<div class="' . $classes . '">';
                        echo '<div class="day-number">' . $day . '</div>';

                        if (isset($taskDates[$currentDate])) {
                            $limit = 0;
                            foreach ($taskDates[$currentDate] as $calendarTask) {
                                if ($limit >= 3) {
                                    echo '<span class="task-dot">+' . (count($taskDates[$currentDate]) - 3) . ' taskuri</span>';
                                    break;
                                }

                                echo '<span class="task-dot priority-' . e($calendarTask['priority']) . '">' . e($calendarTask['title']) . '</span>';
                                $limit++;
                            }
                        }

                        echo '</div>';
                    }
                    ?>
                </div>
            </div>

            <div class="card">
                <h2 class="card-title">Taskurile mele</h2>

                <div class="tasks-list">
                    <?php if (count($tasks) > 0): ?>
                        <?php foreach ($tasks as $task): ?>
                            <div class="task-item">
                                <div class="task-item-top">
                                    <div>
                                        <div class="task-title"><?php echo e($task['title']); ?></div>
                                        <div class="task-description">
                                            <?php echo $task['description'] !== '' ? e($task['description']) : 'Fără descriere.'; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="task-meta">
                                    <span class="badge status">Status: <?php echo e(str_replace('_', ' ', $task['status'])); ?></span>
                                    <span class="badge priority">Prioritate: <?php echo e($task['priority']); ?></span>
                                    <span class="badge deadline">
                                        Deadline:
                                        <?php echo !empty($task['deadline']) ? e($task['deadline']) : 'Nesetat'; ?>
                                    </span>
                                </div>

                                <div class="task-actions">
                                    <form action="php/update_task.php" method="POST" class="status-form">
                                        <input type="hidden" name="task_id" value="<?php echo (int)$task['id']; ?>">
                                        <select name="new_status">
                                            <option value="de_facut" <?php echo $task['status'] === 'de_facut' ? 'selected' : ''; ?>>De făcut</option>
                                            <option value="in_progres" <?php echo $task['status'] === 'in_progres' ? 'selected' : ''; ?>>În progres</option>
                                            <option value="finalizat" <?php echo $task['status'] === 'finalizat' ? 'selected' : ''; ?>>Finalizat</option>
                                        </select>
                                        <button type="submit" class="small-btn update-btn">Actualizează</button>
                                    </form>

                                    <form action="php/delete_task.php" method="POST" onsubmit="return confirm('Sigur vrei să ștergi acest task?');">
                                        <input type="hidden" name="task_id" value="<?php echo (int)$task['id']; ?>">
                                        <button type="submit" class="delete-btn">Șterge</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="empty-text">Nu ai taskuri încă. Adaugă primul tău task din formularul din stânga.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </section>
</main>

</body>
</html>