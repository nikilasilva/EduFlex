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
        'time'
    ];

    protected $order_column = "CONCAT(date, ' ', time)";

    public function findByRole($role) {
        return $this->findSimilar('target_audience', $role);
    }
}