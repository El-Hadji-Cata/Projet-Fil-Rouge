<?php
require_once 'src/View/partial/_head.php';
require_once 'src/View/partial/_header.php';
require_once 'src/View/partial/_alert.php';
?>


<main class="chat-main" style="max-width: 1000px; margin: 30px auto; padding: 20px;">
    <h2>Messagerie</h2>

    <div class="chat-layout" style="display: flex; gap: 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); min-height: 500px; padding: 15px;">

        <!-- LISTE DES CONVERSATIONS (AFFICHEE UNIQUEMENT POUR L'ADMIN) -->
        <?php if (isset($_SESSION['admin'])): ?>
            <aside class="sidebar-users" style="width: 30%; border-right: 1px solid #ddd; padding-right: 15px;">
                <h4 style="margin-bottom: 15px; color: #224631;">Conversations</h4>
                <?php if (!empty($conversationsList)): ?>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <?php foreach ($conversationsList as $userItem): ?>
                            <?php $active = ($userItem['id_users'] == ($idUsers ?? null)) ? 'background-color: #224631; color: white;' : 'background-color: #f0f0f0; color: #333;'; ?>
                            <li style="margin-bottom: 8px;">
                                <a href="index.php?page=message&action=conversation&id_users=<?= $userItem['id_users'] ?>"
                                    style="display: block; padding: 10px; border-radius: 5px; text-decoration: none; font-weight: bold; <?= $active ?>">
                                    <i class="fas fa-user"></i> <?= htmlspecialchars($userItem['firstname'] . ' ' . $userItem['lastname']) ?>
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
        <section class="chat-area" style="flex: 1; display: flex; flex-direction: column;">
            <div class="chat-box" style="flex: 1; height: 400px; overflow-y: auto; border: 1px solid #ccc; padding: 15px; border-radius: 5px; background-color: #f9f9f9; margin-bottom: 15px;">
                <?php if (!empty($messages)): ?>
                    <?php foreach ($messages as $msg): ?>
                        <?php
                        $isSenderAdmin = ($msg['message_admin'] == 1);
                        $iAmAdmin = isset($_SESSION['admin']);
                        $isMe = ($iAmAdmin && $isSenderAdmin) || (!$iAmAdmin && !$isSenderAdmin);
                        ?>
                        <div style="display: flex; justify-content: <?= $isMe ? 'flex-end' : 'flex-start' ?>; margin-bottom: 12px;">
                            <div style="max-width: 70%; padding: 10px 14px; border-radius: 12px; background-color: <?= $isMe ? '#224631' : '#e0e0e0' ?>; color: <?= $isMe ? '#ffffff' : '#000000' ?>;">
                                <p style="margin: 0; word-wrap: break-word;"><?= nl2br(htmlspecialchars($msg['message_content'])) ?></p>
                                <small style="font-size: 0.7rem; opacity: 0.75; display: block; text-align: right; margin-top: 4px;">
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
                <form action="index.php?page=message&action=send" method="POST" style="display: flex; gap: 10px;">
                    <?php if (isset($_SESSION['admin'])): ?>
                        <input type="hidden" name="id_users" value="<?= htmlspecialchars($idUsers) ?>">
                    <?php else: ?>
                        <input type="hidden" name="id_admin" value="<?= htmlspecialchars($idAdmin) ?>">
                    <?php endif; ?>

                    <input type="text" name="message_content" placeholder="Écrivez votre message..." required style="flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                    <button type="submit" style="background-color: #224631; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">Envoyer</button>
                </form>
            <?php endif; ?>
        </section>

    </div>
</main>

<?php
require_once 'src/View/partial/_footer.php';
?>