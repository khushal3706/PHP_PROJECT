<?php include 'header.php'; ?>
<?php include 'config.php'; ?>

<!-- ═══════════════════════════════════════════════ -->
<!-- PHASE 4: ADMIN DASHBOARD — Semi-transparent     -->
<!--          table rows, 3D background visible      -->
<!-- ═══════════════════════════════════════════════ -->

<style>
  /* Glassmorphic admin table */
  .admin-glass-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 4px;
    text-align: left;
  }

  .admin-glass-table thead th {
    padding: 14px 20px;
    font-size: 0.7rem;
    font-weight: 700;
    color: rgba(255,255,255,0.35);
    text-transform: uppercase;
    letter-spacing: 0.1em;
    border-bottom: 1px solid rgba(255,255,255,0.06);
    white-space: nowrap;
  }

  .admin-glass-table tbody tr {
    background: rgba(255,255,255,0.04);
    backdrop-filter: blur(8px);
    transition: background 0.25s, transform 0.2s;
  }

  .admin-glass-table tbody tr:hover {
    background: rgba(255,255,255,0.09);
    transform: translateX(3px);
  }

  .admin-glass-table tbody td {
    padding: 16px 20px;
    font-size: 0.88rem;
    color: rgba(255,255,255,0.75);
    border-bottom: 1px solid rgba(255,255,255,0.04);
    vertical-align: middle;
  }

  .admin-glass-table tbody td:first-child { border-radius: 12px 0 0 12px; }
  .admin-glass-table tbody td:last-child  { border-radius: 0 12px 12px 0; }

  .badge-cat {
    display: inline-flex;
    align-items: center;
    padding: 3px 10px;
    border-radius: 999px;
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    border: 1px solid rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.06);
    color: rgba(255,255,255,0.7);
  }

  .stat-card {
    background: rgba(255,255,255,0.04);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 20px;
    padding: 1.5rem;
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease, border-color 0.3s;
  }
  .stat-card:hover { transform: translateY(-4px); border-color: rgba(255,255,255,0.16); }
  .stat-card-glow {
    position: absolute; inset: 0; pointer-events: none;
    background: radial-gradient(circle at 80% 20%, var(--glow) 0%, transparent 60%);
    opacity: 0.3;
  }

  .action-btn {
    width: 32px; height: 32px;
    border-radius: 8px;
    border: 0;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
    font-size: 0.85rem;
  }
  .action-btn-edit   { background: rgba(34,211,238,0.1);  color: #22d3ee; }
  .action-btn-delete { background: rgba(239,68,68,0.1);   color: #f87171; }
  .action-btn-edit:hover   { background: rgba(34,211,238,0.2);  box-shadow: 0 0 12px rgba(34,211,238,0.3); }
  .action-btn-delete:hover { background: rgba(239,68,68,0.2);   box-shadow: 0 0 12px rgba(239,68,68,0.3); }

  /* Modal */
  .admin-modal-overlay {
    position: fixed; inset: 0;
    background: rgba(0,0,0,0.55);
    backdrop-filter: blur(8px);
    z-index: 1000;
    display: flex; align-items: center; justify-content: center;
    padding: 1rem;
    opacity: 0; pointer-events: none;
    transition: opacity 0.3s;
  }
  .admin-modal-overlay.open { opacity: 1; pointer-events: auto; }
  .admin-modal {
    background: rgba(10,10,30,0.85);
    backdrop-filter: blur(30px);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 24px;
    padding: 2rem;
    width: 100%; max-width: 480px;
    box-shadow: 0 30px 80px rgba(0,0,0,0.6);
    transform: scale(0.95);
    transition: transform 0.3s;
  }
  .admin-modal-overlay.open .admin-modal { transform: scale(1); }

  .form-select-glass {
    appearance: none;
    background: rgba(255,255,255,0.03) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,0.4)' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E") no-repeat right 14px center;
    border: 1px solid rgba(255,255,255,0.12);
    color: #fff;
    border-radius: 12px;
    padding: 13px 40px 13px 16px;
    width: 100%;
    outline: none;
    font-family: 'Inter', sans-serif;
    font-size: 0.95rem;
    transition: all 0.3s;
    cursor: pointer;
  }
  .form-select-glass:focus {
    border-color: rgba(99,102,241,0.7);
    box-shadow: 0 0 0 3px rgba(99,102,241,0.15);
    background-color: rgba(255,255,255,0.07);
  }
  .form-select-glass option { background: #1e1b4b; color: #fff; }
</style>

<main class="pt-24 pb-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

  <!-- Dashboard header -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
      <h1 class="text-2xl sm:text-3xl font-black text-white mb-1">Admin <span class="text-gradient">Control Panel</span></h1>
      <p class="text-white/40 text-sm">Manage AI tools, users, and platform settings.</p>
    </div>
    <button onclick="openModal()" class="btn-glow px-6 py-2.5 rounded-xl text-sm font-bold relative z-10 self-start sm:self-auto">
      + Add New Tool
    </button>
  </div>

  <!-- Stats row -->
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <?php
    $adminStats = [
      ['Total Tools',    '2,048', '🛠️', '--glow: rgba(34,211,238,0.4)'],
      ['Active Users',   '124.5K','👥', '--glow: rgba(168,85,247,0.4)'],
      ['Daily Searches', '48.2K', '🔍', '--glow: rgba(245,158,11,0.4)'],
      ['Avg Rating',     '4.72 ★','⭐', '--glow: rgba(16,185,129,0.4)'],
    ];
    foreach ($adminStats as [$label, $value, $icon, $glow]):
    ?>
    <div class="stat-card" style="<?= $glow ?>">
      <div class="stat-card-glow"></div>
      <div class="text-2xl mb-3"><?= $icon ?></div>
      <div class="text-2xl font-black text-white"><?= $value ?></div>
      <div class="text-xs text-white/40 uppercase tracking-widest mt-1"><?= $label ?></div>
    </div>
    <?php endforeach; ?>
  </div>

  <!-- Data Table -->
  <div class="glass-deep rounded-2xl overflow-hidden">

    <!-- Table toolbar -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 p-5 border-b border-white/6">
      <div class="text-white font-semibold text-sm">All Tools <span class="text-white/30 font-normal">(3 entries)</span></div>
      <div class="flex items-center gap-2">
        <input type="text" id="adminSearch" placeholder="Filter table…"
               class="glass-input text-sm py-2 px-3 rounded-xl" style="width:200px; padding: 8px 14px;"
               oninput="filterAdminTable(this.value)">
      </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto p-4">
      <table class="admin-glass-table" id="admin-tools-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tool Name</th>
            <th>Category</th>
            <th>Pricing</th>
            <th>Rating</th>
            <th>Status</th>
            <th class="text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $tableTools = [
            ['#1024', 'DevMind AI',       'Code Assistant',    'Freemium', '4.8', 'Live'],
            ['#1025', 'Visionary Studio', 'Image Generation',  'Paid',     '5.0', 'Live'],
            ['#1026', 'DataSense Pro',    'Data Analysis',     'Free',     '4.5', 'Review'],
            ['#1027', 'WordForge AI',     'Writing & Content', 'Freemium', '4.6', 'Live'],
            ['#1028', 'SoundMind',        'Audio & Video',     'Freemium', '4.9', 'Live'],
            ['#1029', 'AgentFlow',        'AI Agents',         'Paid',     '4.3', 'Review'],
          ];
          foreach ($tableTools as [$id, $name, $cat, $price, $rating, $status]):
            $statusColor = $status === 'Live'
              ? 'background:rgba(16,185,129,0.15);color:#34d399;border-color:rgba(16,185,129,0.25)'
              : 'background:rgba(245,158,11,0.15);color:#fbbf24;border-color:rgba(245,158,11,0.25)';
          ?>
          <tr class="admin-row" data-name="<?= strtolower(htmlspecialchars($name)) ?>">
            <td class="text-white/30 text-xs font-mono"><?= htmlspecialchars($id) ?></td>
            <td class="font-semibold text-white"><?= htmlspecialchars($name) ?></td>
            <td><span class="badge-cat"><?= htmlspecialchars($cat) ?></span></td>
            <td class="text-white/55"><?= htmlspecialchars($price) ?></td>
            <td class="text-yellow-400 font-bold"><?= htmlspecialchars($rating) ?></td>
            <td><span class="badge-cat text-xs" style="<?= $statusColor ?>"><?= htmlspecialchars($status) ?></span></td>
            <td class="text-right">
              <button class="action-btn action-btn-edit mr-2" title="Edit">✎</button>
              <button class="action-btn action-btn-delete" title="Delete">🗑</button>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</main>

<!-- Add Tool Modal -->
<div class="admin-modal-overlay" id="addToolModal">
  <div class="admin-modal">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-xl font-black text-white">Add AI Tool</h2>
      <button onclick="closeModal()"
              class="w-8 h-8 rounded-lg flex items-center justify-center text-white/40 hover:text-white hover:bg-white/10 transition-all text-lg border-0 bg-transparent cursor-pointer">
        ✕
      </button>
    </div>

    <form action="#" method="POST">
      <div class="mb-4">
        <label class="auth-label" style="display:block;font-size:.78rem;font-weight:600;color:rgba(255,255,255,.55);text-transform:uppercase;letter-spacing:.07em;margin-bottom:8px;">Tool Name</label>
        <input type="text" class="glass-input" placeholder="e.g. DevMind AI">
      </div>
      <div class="mb-4">
        <label class="auth-label" style="display:block;font-size:.78rem;font-weight:600;color:rgba(255,255,255,.55);text-transform:uppercase;letter-spacing:.07em;margin-bottom:8px;">Website URL</label>
        <input type="url" class="glass-input" placeholder="https://…">
      </div>
      <div class="mb-4">
        <label class="auth-label" style="display:block;font-size:.78rem;font-weight:600;color:rgba(255,255,255,.55);text-transform:uppercase;letter-spacing:.07em;margin-bottom:8px;">Category</label>
        <select class="form-select-glass">
          <option disabled selected>Select a category</option>
          <option>Code Assistant</option>
          <option>Image Generation</option>
          <option>Data Analysis</option>
          <option>Writing & Content</option>
          <option>Audio & Video</option>
          <option>AI Agents</option>
        </select>
      </div>
      <div class="mb-4">
        <label class="auth-label" style="display:block;font-size:.78rem;font-weight:600;color:rgba(255,255,255,.55);text-transform:uppercase;letter-spacing:.07em;margin-bottom:8px;">Pricing</label>
        <select class="form-select-glass">
          <option>Free</option>
          <option>Freemium</option>
          <option>Paid</option>
        </select>
      </div>
      <div class="mb-6">
        <label class="auth-label" style="display:block;font-size:.78rem;font-weight:600;color:rgba(255,255,255,.55);text-transform:uppercase;letter-spacing:.07em;margin-bottom:8px;">Description</label>
        <textarea class="glass-input" rows="3" style="resize:vertical;" placeholder="Brief description of the tool…"></textarea>
      </div>
      <div class="flex gap-3">
        <button type="button" onclick="closeModal()"
                class="flex-1 py-2.5 rounded-xl border border-white/10 text-white/50 hover:text-white hover:bg-white/5 transition-all text-sm font-medium cursor-pointer bg-transparent">
          Cancel
        </button>
        <button type="submit" class="btn-glow flex-1 py-2.5 rounded-xl text-sm font-bold relative z-10">
          Save Tool
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  function openModal() {
    document.getElementById('addToolModal').classList.add('open');
    if (window.AAS3D) {
      window.AAS3D.targetColor = new THREE.Color(0xa855f7);
      window.AAS3D.icoSpeed.x  = 0.009;
    }
  }
  function closeModal() {
    document.getElementById('addToolModal').classList.remove('open');
    if (window.AAS3D) {
      window.AAS3D.targetColor = new THREE.Color(0x6366f1);
      window.AAS3D.icoSpeed.x  = 0.003;
    }
  }
  document.getElementById('addToolModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
  });

  function filterAdminTable(q) {
    document.querySelectorAll('.admin-row').forEach(row => {
      row.style.display = row.dataset.name.includes(q.toLowerCase()) ? '' : 'none';
    });
  }
</script>

<?php include 'footer.php'; ?>
