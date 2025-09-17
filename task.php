<?php
class Task {
 
    private $pdo;

  
    public function __construct($pdo = null)
    {
       
        if ($pdo instanceof \PDO) {
            $this->pdo = $pdo;
        } else {
           
            $configPath = __DIR__ . '/config.php';
            if (file_exists($configPath)) {
                require_once $configPath;
          
                if (isset($pdo) && $pdo instanceof \PDO) {
                    $this->pdo = $pdo;
                }
            }
           
            if (!$this->pdo instanceof \PDO) {
                throw new \RuntimeException('No valid PDO instance available for Task model.');
            }
        }
    }

    public function getAllTasks(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM tasks ORDER BY due_date ASC');
        return $stmt ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [];
    }

    public function getTaskById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM tasks WHERE id = ?');
        $stmt->execute([$id]);
        $task = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $task !== false ? $task : null;
    }

   
     
    public function addTask(string $description, string $due_date, string $priority, string $category): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO tasks (description, due_date, priority, category) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$description, $due_date, $priority, $category]);
    }

    public function updateTask(int $id, string $description, string $due_date, string $priority, string $category): bool
    {
        $stmt = $this->pdo->prepare('UPDATE tasks SET description = ?, due_date = ?, priority = ?, category = ? WHERE id = ?');
        return $stmt->execute([$description, $due_date, $priority, $category, $id]);
    }

    
    public function deleteTask(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM tasks WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
