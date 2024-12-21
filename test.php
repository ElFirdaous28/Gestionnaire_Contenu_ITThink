<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
    <div class="text-sm leading-5 text-gray-900 w-full"><?= $user['title'] !== null ? htmlspecialchars($user['title']) : ''; ?></div>
</td>

<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
    <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to change the status of this user?');">
        <input type="hidden" name="block_user_id" value="<?= $user['id_utilisateur']; ?>">
        <button type="submit" class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
            <?= $user['is_active'] == 1 ? "Active" : "blocked" ?>
        </button>
    </form>
</td>

<td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
    <?= $user['role'] == 2 ? "Client" : "Freelancer"; ?>
</td>

<td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
    <?= $user['role'] == 2 ? "Client" : "Freelancer"; ?>
</td>

<td class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
    <!-- Remove User Form with Confirmation -->
    <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to remove this user?');">
        <input type="hidden" name="remove_user" value="<?= $user['id_utilisateur']; ?>">
        <button type="submit" class="text-indigo-600 hover:text-indigo-900">Remove</button>
    </form>
</td>