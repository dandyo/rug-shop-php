<div class="settings-nav">
    <div class="list-group list-group-flush">
        <a href="<?= URLROOT ?>admin/settings" class="list-group-item <?= ($data['nav'] == 'index') ? 'active' : ''; ?>"><span class="icon-cog me-2"></span> General</a>
        <a href="<?= URLROOT ?>admin/settings/users" class="list-group-item <?= ($data['nav'] == 'users') ? 'active' : ''; ?>"><span class="icon-user me-2"></span> Users</a>
        <a href="<?= URLROOT ?>admin/settings/variables" class="list-group-item <?= ($data['nav'] == 'variables') ? 'active' : ''; ?>"><span class="icon-circle-down me-2"></span> Variables</a>
    </div>
</div>