<?php
require_once 'src/View/partial/_head.php';
require_once 'src/View/partial/_header.php';
require_once 'src/View/partial/_alert.php';
?>

<main class="chat-main" style="width: 100%; max-width: 850px; margin: 30px auto; padding: 0 20px;">
    <h2 style="color: #224631; text-align: center; margin-bottom: 25px; font-weight: bold;">Messagerie</h2>

    <div class="chat-layout" style="display: flex; gap: 20px; background: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); min-height: 550px; padding: 25px; width: 100%;">

        <!-- LISTE DES CONVERSATIONS (AFFICHEE UNIQUEMENT POUR L'ADMIN) -->
        <?php if (isset($_SESSION['admin'])): ?>
            <aside class="sidebar-users" style="width: 280px; flex-shrink: 0; border-right: 1px solid #eee; padding-right: 20px;">
                <h4 style="margin-bottom: 15px; color: #224631; font-weight: bold;">Conversations</h4>
                <?php if (!empty($conversationsList)): ?>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <?php foreach ($conversationsList as $userItem): ?>
                            <?php $active = ($userItem['id_users'] == ($idUsers ?? null)) ? 'background-color: #224631; color: white;' : 'background-color: #f8f9fa; color: #333;'; ?>
                            <li style="margin-bottom: 8px;">
                                <a href="index.php?page=message&action=conversation&id_users=<?= $userItem['id_users'] ?>"
                                    style="display: block; padding: 12px 15px; border-radius: 8px; text-decoration: none; font-weight: 500; transition: all 0.2s; <?= $active ?>">
                                    <i class="fas fa-user me-2"></i> <?= htmlspecialchars($userItem['firstname'] . ' ' . $userItem['lastname']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p style="font-size: 0.9rem; color: #777;">Aucun message d'utilisateur pour l'instant.</p>
                <?php endif; ?>
            </aside>
        <?php endif; ?>

        <!-- ZONE DE DISCUSSION -->
        <section class="chat-area" style="flex: 1; display: flex; flex-direction: column; width: 100%;">
            <div class="chat-box" style="flex: 1; height: 480px; overflow-y: auto; border: 1px solid #e0e0e0; padding: 20px; border-radius: 8px; background-color: #f9fbf9; margin-bottom: 20px;">
                <?php if (!empty($messages)): ?>
                    <?php foreach ($messages as $msg): ?>
                        <?php
                        $isSenderAdmin = ($msg['message_admin'] == 1);
                        $iAmAdmin = isset($_SESSION['admin']);
                        $isMe = ($iAmAdmin && $isSenderAdmin) || (!$iAmAdmin && !$isSenderAdmin);
                        ?>
                        <div style="display: flex; justify-content: <?= $isMe ? 'flex-end' : 'flex-start' ?>; margin-bottom: 14px;">
                            <div style="max-width: 65%; padding: 12px 16px; border-radius: 12px; background-color: <?= $isMe ? '#224631' : '#e9ecef' ?>; color: <?= $isMe ? '#ffffff' : '#212529' ?>; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                                <p style="margin: 0; word-wrap: break-word; line-height: 1.4;"><?= nl2br(htmlspecialchars($msg['message_content'])) ?></p>
                                <small style="font-size: 0.7rem; opacity: 0.75; display: block; text-align: right; margin-top: 5px;">
                                    <?= date('d/m/Y H:i', strtotime($msg['message_date'])) ?>
                                </small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align: center; color: #888; margin-top: 50px;">Sélectionnez une conversation ou envoyez votre premier message.</p>
                <?php endif; ?>
            </div>

            <!-- FORMULAIRE D'ENVOI -->
            <?php if (!empty($idUsers) && !empty($idAdmin)): ?>
                <form action="index.php?page=message&action=send" method="POST" style="display: flex; gap: 12px; width: 100%;">
                    <?php if (isset($_SESSION['admin'])): ?>
                        <input type="hidden" name="id_users" value="<?= htmlspecialchars($idUsers) ?>">
                    <?php else: ?>
                        <input type="hidden" name="id_admin" value="<?= htmlspecialchars($idAdmin) ?>">
                    <?php endif; ?>

                    <input type="text" name="message_content" placeholder="Écrivez votre message..." required style="flex: 1; padding: 12px 16px; border: 1px solid #ced4da; border-radius: 8px; font-size: 0.95rem; outline: none;">
                    <button type="submit" style="background-color: #224631; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-weight: bold; transition: background-color 0.2s;">Envoyer</button>
                </form>
            <?php endif; ?>
        </section>

    </div>
</main>

<?php
require_once 'src/View/partial/_footer.php';
?>