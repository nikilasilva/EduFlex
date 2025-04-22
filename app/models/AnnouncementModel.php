<?php

class AnnouncementModel {
    use Model;

    protected $table = 'announcements';
    protected $allowedColumns = [
        'id',
        'title',
        'type',
        'target_audience',
        'content',
        'date',
        'time',
        'created_by',
        'views_count'
    ];

    protected $order_column = "CONCAT(date, ' ', time) DESC";

    public $errors = [];

    public function validate($data) {
        $this->errors = [];

        if (empty($data['title']) || strlen($data['title']) > 255) {
            $this->errors['title'] = 'Title is required and must be less than 255 characters.';
        }

        if (empty($data['type']) || !in_array($data['type'], ['general', 'academic', 'event', 'emergency', 'sports'])) {
            $this->errors['type'] = 'Valid announcement type is required.';
        }

        if (empty($data['target_audience'])) {
            $this->errors['target_audience'] = 'Target audience is required.';
        } else {
            $validAudiences = ['students', 'teachers', 'parents', 'non-academic staff', 'vice-principals'];
            $audiences = is_array($data['target_audience']) ? $data['target_audience'] : explode(',', $data['target_audience']);
            foreach ($audiences as $audience) {
                if (!in_array(trim($audience), $validAudiences)) {
                    $this->errors['target_audience'] = 'Invalid target audience selected.';
                    break;
                }
            }
        }

        if (empty($data['content'])) {
            $this->errors['content'] = 'Content is required.';
        }

        if (empty($data['date']) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['date'])) {
            $this->errors['date'] = 'Valid date is required (YYYY-MM-DD).';
        }

        if (empty($data['time']) || !preg_match('/^\d{2}:\d{2}$/', $data['time'])) {
            $this->errors['time'] = 'Valid time is required (HH:MM).';
        }

        if (empty($data['created_by']) || !is_numeric($data['created_by'])) {
            $this->errors['created_by'] = 'Valid creator regNo is required.';
        }

        // Validate date and time are not in the past
        if (!empty($data['date']) && !empty($data['time'])) {
            $announcementDateTime = DateTime::createFromFormat('Y-m-d H:i', $data['date'] . ' ' . $data['time']);
            $now = new DateTime();
            if ($announcementDateTime && $announcementDateTime < $now) {
                $this->errors['date'] = 'Announcement date and time cannot be in the past.';
            }
        }

        // Return true if there are no errors, false otherwise
        return empty($this->errors);
    }

    public function findByRole($role) {
        return $this->query(
            "SELECT * FROM $this->table WHERE target_audience LIKE :role",
            ['role' => '%' . $this->sanitize($role) . '%']
        );
    }

    public function findByCreator($creatorId, $limit = 20, $offset = 0) {
        $query = "SELECT * FROM $this->table WHERE created_by = :creatorId ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
        $data = ['creatorId' => $creatorId];
        return $this->query($query, $data);
    }

    public function sanitize($value) {
        return htmlspecialchars(strip_tags($value));
    }

    public function getTableName() {
        return $this->table;
    }
    
    public function findAllOrdered($limit = 20, $offset = 0) {
        $query = "SELECT * FROM $this->table ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
        return $this->query($query);
    }
}