<?php
require_once __DIR__ . '/../Model/MessageModel.php';

class MessageCtrl
{
    private $messageModel;

    public function __construct($db)
    {
        $this->messageModel = new MessageModel($db);
    }

    public function manage()
    {
        $action = filter_input(INPUT_GET, 'action') ?? 'conversation';

        switch ($action) {
            case 'send':
                $this->send();
                break;
            case 'conversation':
            default:
                $this->conversation();
                break;
        }
    }

    private function conversation()
    {
        $isAdmin = isset($_SESSION['admin']);
        $isUser = isset($_SESSION['users']) || isset($_SESSION['user']);

        if (!$isAdmin && !$isUser) {
            header('Location: index.php?page=user&action=signInAdmin');
            exit();
        }

        $defaultAdminId = $this->messageModel->getDefaultAdminId();
        $conversationsList = [];
        $idUsers = null;
        $idAdmin = null;

        if ($isAdmin) {
            $idAdmin = $_SESSION['admin']['id'] ?? $_SESSION['admin']['admin_id'] ?? $_SESSION['admin']['id_admin'] ?? $defaultAdminId;

            // Liste de tous les utilisateurs pour le volet de gauche
            $conversationsList = $this->messageModel->getAllUsersWithMessages();

            // Identifiant de l'utilisateur sélectionné
            $idUsers = filter_input(INPUT_GET, 'id_users', FILTER_VALIDATE_INT);
            if (!$idUsers && !empty($conversationsList)) {
                $idUsers = $conversationsList[0]['id_users'];
            }
        } else {
            $idUsers = $_SESSION['users']['id'] ?? $_SESSION['users']['id_users'] ?? $_SESSION['user']['id'] ?? null;
            $idAdmin = filter_input(INPUT_GET, 'id_admin', FILTER_VALIDATE_INT) ?? $defaultAdminId;
        }

        $messages = [];
        if ($idUsers && $idAdmin) {
            $this->messageModel->markAsRead($idUsers, $isAdmin);
            $messages = $this->messageModel->getConversation($idUsers, $idAdmin);
        }

        // Transmet les variables à la vue
        require_once __DIR__ . '/../View/chat.php';
    }

    private function send()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = trim($_POST['message_content'] ?? '');
            $isAdminSender = isset($_SESSION['admin']) ? 1 : 0;
            $defaultAdminId = $this->messageModel->getDefaultAdminId();

            if ($isAdminSender) {
                $idAdmin = $_SESSION['admin']['id'] ?? $_SESSION['admin']['admin_id'] ?? $_SESSION['admin']['id_admin'] ?? $defaultAdminId;
                $idUsers = filter_input(INPUT_POST, 'id_users', FILTER_VALIDATE_INT);
            } else {
                $idUsers = $_SESSION['users']['id'] ?? $_SESSION['users']['id_users'] ?? $_SESSION['user']['id'] ?? null;
                $idAdmin = filter_input(INPUT_POST, 'id_admin', FILTER_VALIDATE_INT) ?? $defaultAdminId;
            }

            if (!empty($content) && $idUsers && $idAdmin) {
                $this->messageModel->sendMessage($idUsers, $idAdmin, $content, $isAdminSender);
            }

            $redirectUrl = "index.php?page=message&action=conversation";
            $redirectUrl .= $isAdminSender ? "&id_users=" . $idUsers : "&id_admin=" . $idAdmin;

            header("Location: " . $redirectUrl);
            exit();
        }
    }
}
