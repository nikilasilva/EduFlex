<?php
class Announcement extends Controller {
    private $announcementModel;

    public function __construct() {
        // Load the AnnouncementModel
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Ensure session is started
        }
        $this->announcementModel = $this->model('AnnouncementModel');
    }

    public function index() {
        // Redirect to the viewAnnouncement method
        $this->viewAnnouncement();
    }

    public function announcements($page = 1) {
        // Fetch all announcements from the database
        $userRole = $_SESSION['user']['role'] ?? null;
        $regNo = $_SESSION['user']['regNo'] ?? null;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        if (!$userRole) {
            die('User role not defined.');
        }
        elseif ($userRole == 'principal' || $userRole == 'vice-principal') {
            $total = $this->announcementModel->query(
                "SELECT COUNT(*) as count FROM " . $this->announcementModel->getTableName(),
                []
            )[0]->count;
            $announcements = $this->announcementModel->findAllOrdered($limit, $offset);
        }
        else {
            $total = $this->announcementModel->query(
                "SELECT COUNT(*) as count FROM " . $this->announcementModel->getTableName() . " WHERE target_audience LIKE ?",
                ['%' . $userRole . '%']
            )[0]->count;
            $announcements = $this->announcementModel->findByRole($userRole);
        }

        $data = [
            'title' => 'Announcements',
            'announcements' => $announcements,
            'page' => $page,
            'totalPages' => ceil($total / $limit),
            'message' => $_SESSION['message'] ?? ''
        ];
        unset($_SESSION['message']);
        
        $this->view('inc/announcement/announcementModal', $data);
    }

    // Display all announcements
    public function viewAnnouncement($page = 1) {
        checkRole('vice-principal');

        $limit = 10;
        $offset = ($page - 1) * $limit;
        $regNo = $_SESSION['user']['regNo'] ?? null;

        // Fetch all announcements from the database
        $total = $this->announcementModel->query(
            "SELECT COUNT(*) as count FROM " . $this->announcementModel->getTableName() . " WHERE created_by = ?",
            [$regNo]
        )[0]->count;
        $announcements = $this->announcementModel->findByCreator($regNo, $limit, $offset);
    
        // Pass the announcements to the view
        $data = [
            'title' => 'Announcements',
            'announcements' => $announcements,
            'page' => $page,
            'totalPages' => ceil($total / $limit),
            'announcementCount' => count($announcements),
            'announcementTotal' => $total,
            'message' => $_SESSION['message'] ?? ''
        ];
        unset($_SESSION['message']);
    
        $this->view('inc/announcement/viewAnnouncement', $data);
    }

    // Handle announcement submission
    public function submitAnnouncement() {
        checkRole('vice-principal');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Prepare data
            $data = [
                'title' => trim($_POST['announcement-title']),
                'type' => trim($_POST['announcement-type']),
                'target_audience' => isset($_POST['audience']) ? implode(',', $_POST['audience']) : '',
                'content' => trim($_POST['announcement-content']),
                'date' => $_POST['announcement-date'],
                'time' => isset($_POST['announcement-time']) ? substr($_POST['announcement-time'], 0, 5) : '',
                'created_by' => $_SESSION['user']['regNo'],
                'errors' => []
            ];

            // Validate fields
            if (!$this->announcementModel->validate($data)) {
                $data['errors'] = $this->announcementModel->errors;
            }
            
            // Check if there are no errors
            if (empty($data['errors'])) {
                // Save the announcement
                if ($this->announcementModel->insert($data)) {
                    $_SESSION['message'] = 'Announcement created successfully';
                    // Redirect to the announcements page
                    header("Location: " . URLROOT . "/Announcement/viewAnnouncement");
                    exit();
                } else {
                    $data['errors']['general'] = 'Failed to create announcement';
                }
            }
            // Reload the form with errors
            $this->view('inc/announcement/createAnnouncement', $data);
            
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
        checkRole('vice-principal');
        
        // Fetch the existing announcement first to verify ownership
        $announcement = $this->announcementModel->first(['id' => $id]);
        if (!$announcement || $announcement->created_by != $_SESSION['user']['regNo']) {
            $_SESSION['error'] = 'Announcement not found or you are not authorized to edit it';
            header('Location: ' . URLROOT . '/Announcement/viewAnnouncement');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Prepare data
            $data = [
                'id' => $id,
                'title' => trim($_POST['announcement-title']),
                'type' => trim($_POST['announcement-type']),
                'target_audience' => isset($_POST['target_audience']) ? implode(',', $_POST['target_audience']) : '',
                'content' => trim($_POST['announcement-content']),
                'date' => $_POST['announcement-date'],
                'time' => isset($_POST['announcement-time']) ? substr($_POST['announcement-time'], 0, 5) : '',
                'created_by' => $_SESSION['user']['regNo'],
                'errors' => []
            ];

            // Validate fields
            if (!$this->announcementModel->validate($data)) {
                $data['errors'] = $this->announcementModel->errors;
            }

            // Update announcement if there are no errors
            if (empty($data['errors'])) {
                $this->announcementModel->update($id, $data);
                $_SESSION['message'] = 'Announcement updated successfully';
                header('Location: ' . URLROOT . '/Announcement/viewAnnouncement');
                exit;
            }

            // Reload the form with errors
            $this->view('inc/announcement/editAnnouncement', $data);
        } else {
            // Prepare data for the edit form
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
        }
    }

    // Handle announcement deletion
    public function deleteAnnouncement() {
        checkRole('vice-principal');
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? 0;
            
            // Check if the announcement exists and belongs to the current user
            $announcement = $this->announcementModel->first([
                'id' => $id,
                'created_by' => $_SESSION['user']['regNo']
            ]);
    
            if ($announcement && $this->announcementModel->delete($id)) {
                $_SESSION['message'] = 'Announcement deleted successfully';
            } else {
                $_SESSION['error'] = 'Failed to delete announcement or you are not authorized';
            }
    
            header('Location: ' . URLROOT . '/Announcement/viewAnnouncement');
            exit;
        } else {
            // Redirect if not POST
            header('Location: ' . URLROOT . '/Announcement/viewAnnouncement');
            exit;
        }
    }    
}