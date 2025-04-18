<?php
class Announcement extends Controller {
    private $announcementModel;

    public function __construct() {
        // Load the AnnouncementModel
        $this->announcementModel = $this->model('AnnouncementModel');
    }

    public function index() {
        // Redirect to the viewAnnouncement method
        $this->viewAnnouncement();
    }

    public function announcements() {
        // Fetch all announcements from the database
        $announcements = $this->announcementModel->findAll();

        // Pass the announcements to the view
        $data = [
            'title' => 'Announcements',
            'announcements' => $announcements,
        ];
        
        $this->view('inc/announcement/announcementModal', $data);
    }

    // Display all announcements
    public function viewAnnouncement() {
        // Fetch all announcements from the database
        $announcements = $this->announcementModel->findAll();
    
        // Pass the announcements to the view
        $data = [
            'title' => 'Announcements',
            'announcements' => $announcements,
        ];
    
        $this->view('inc/announcement/viewAnnouncement', $data);
    }
    

    // Handle announcement submission
    public function submitAnnouncement() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Prepare data
            $data = [
                'title' => trim($_POST['announcement-title']),
                'type' => trim($_POST['announcement-type']),
                'target_audience' => implode(',', $_POST['audience'] ?? []), // Convert array to string
                'content' => trim($_POST['announcement-content']),
                'date' => $_POST['announcement-date'],
                'time' => $_POST['announcement-time'],
                'errors' => []
            ];

            // Validate fields
            if (empty($data['title'])) {
                $data['errors']['title'] = 'Announcement title is required.';
            }
            if (empty($data['type'])) {
                $data['errors']['type'] = 'Announcement type is required.';
            }
            if (empty($data['target_audience'])) {
                $data['errors']['target_audience'] = 'Target audience is required.';
            }
            if (empty($data['content'])) {
                $data['errors']['content'] = 'Announcement content is required.';
            }
            if (empty($data['date'])) {
                $data['errors']['date'] = 'Announcement date is required.';
            }
            if (empty($data['time'])) {
                $data['errors']['time'] = 'Announcement time is required.';
            }
            
            // Check if there are no errors
            if (empty($data['errors'])) {
                // Save the announcement
                if ($this->announcementModel->insert($data)) {
                    // Redirect to the announcements page
                    header("Location: " . URLROOT . "/Announcement/viewAnnouncement");
                    exit();
                } else {
                    die('Something went wrong.');
                }
            } else {
                // Reload the form with errors
                $this->view('inc/announcement/createAnnouncement', $data);
            }
        } else {
            // Load the form view
            $data = [
                'title' => '',
                'type' => '',
                'target_audience' => '',
                'content' => '',
                'date' => '',
                'time' => '',
                'errors' => []
            ];
            $this->view('inc/announcement/createAnnouncement', $data);
        }
    }

    // Handle announcement updating
    public function updateAnnouncement($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Prepare data
            $data = [
                'id' => $id,
                'title' => trim($_POST['announcement-title']),
                'type' => trim($_POST['announcement-type']),
                'target_audience' => !empty($_POST['target_audience']) ? implode(',', $_POST['target_audience']) : '',
                'content' => trim($_POST['announcement-content']),
                'date' => $_POST['announcement-date'],
                'time' => $_POST['announcement-time'],
                'errors' => []
            ];

            // Validate fields (similar validation as in submission)
            if (empty($data['title'])) {
                $data['errors']['title'] = 'Announcement title is required.';
            }
            if (empty($data['type'])) {
                $data['errors']['type'] = 'Announcement type is required.';
            }
            if (empty($data['target_audience'])) {
                $data['errors']['target_audience'] = 'Target audience is required.';
            }
            if (empty($data['content'])) {
                $data['errors']['content'] = 'Announcement content is required.';
            }
            if (empty($data['date'])) {
                $data['errors']['date'] = 'Announcement date is required.';
            }
            if (empty($data['time'])) {
                $data['errors']['time'] = 'Announcement time is required.';
            }

            // Update announcement if there are no errors
            if (empty($data['errors'])) {
                $this->announcementModel->update($id, $data);
                header("Location: " . URLROOT . "/Announcement/viewAnnouncement");
                exit();
                
            } else {
                // Reload the form with errors
                $this->view('inc/announcement/editAnnouncement', $data);
            }
        } else {
            // Fetch the existing announcement
            $announcement = $this->announcementModel->first(['id' => $id]);
            if ($announcement) {
                $data = [
                    'id' => $announcement->id,
                    'title' => $announcement->title,
                    'type' => $announcement->type,
                    'target_audience' => explode(',', $announcement->target_audience),
                    'content' => $announcement->content,
                    'date' => $announcement->date,
                    'time' => $announcement->time,
                    'errors' => []
                ];
                $this->view('inc/announcement/editAnnouncement', $data);
            } else {
                die('Announcement not found.');
            }
        }
    }

    // Handle announcement deletion
    public function deleteAnnouncement($id) {
        if ($this->announcementModel->delete($id)) {
            // Redirect to the announcements page
            header("Location: " . URLROOT . "/Announcement/viewAnnouncement");
            exit();
        } else {
            die('Something went wrong delete.');
        }
    }
}
