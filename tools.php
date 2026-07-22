<?php include 'header.php'; ?>

<!-- ═══════════════════════════════════════════════ -->
<!-- PHASE 3: TOOLS DIRECTORY with 3D Card Effects   -->
<!-- ═══════════════════════════════════════════════ -->

<style>
  /* Category color map (injected via JS data attribute) */
  .tool-card[data-category="code"]     { --card-glow: rgba(34,211,238,0.30); --badge-from: #22d3ee; --badge-to: #6366f1; }
  .tool-card[data-category="image"]    { --card-glow: rgba(168,85,247,0.30);  --badge-from: #a855f7; --badge-to: #ec4899; }
  .tool-card[data-category="data"]     { --card-glow: rgba(245,158,11,0.30);  --badge-from: #f59e0b; --badge-to: #ef4444; }
  .tool-card[data-category="writing"]  { --card-glow: rgba(16,185,129,0.30);  --badge-from: #10b981; --badge-to: #3b82f6; }
  .tool-card[data-category="audio"]    { --card-glow: rgba(239,68,68,0.30);   --badge-from: #ef4444; --badge-to: #f97316; }
  .tool-card[data-category="agent"]    { --card-glow: rgba(99,102,241,0.35);  --badge-from: #6366f1; --badge-to: #8b5cf6; }

  .tool-card {
    background: rgba(0,0,0,0.40);
    backdrop-filter: blur(16px) saturate(160%);
    -webkit-backdrop-filter: blur(16px) saturate(160%);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 20px;
    padding: 1.5rem;
    transition: transform 0.45s cubic-bezier(0.34,1.56,0.64,1),
                box-shadow 0.45s ease,
                border-color 0.3s ease;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    height: 100%;
    position: relative;
    overflow: hidden;
  }

  .tool-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 80% 20%, var(--card-glow, rgba(99,102,241,0.2)) 0%, transparent 60%);
    opacity: 0;
    transition: opacity 0.4s ease;
    pointer-events: none;
    border-radius: inherit;
  }

  .tool-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 25px 50px rgba(0,0,0,0.5), 0 0 40px var(--card-glow, rgba(99,102,241,0.25));
    border-color: rgba(255,255,255,0.15);
  }
  .tool-card:hover::before { opacity: 1; }

  .category-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: linear-gradient(135deg, var(--badge-from, #6366f1), var(--badge-to, #a855f7));
    color: #fff;
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    padding: 4px 12px;
    border-radius: 999px;
  }

  .rating-stars { color: #fbbf24; font-size: 0.8rem; letter-spacing: 1px; }

  .search-bar-tools {
    background: rgba(255,255,255,0.04);
    backdrop-filter: blur(16px);
    border: 1px solid rgba(255,255,255,0.09);
    border-radius: 16px;
    padding: 10px 18px;
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 280px;
  }

  .filter-pill {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
    color: rgba(255,255,255,0.6);
    border-radius: 999px;
    padding: 6px 18px;
    font-size: 0.8rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    font-family: 'Inter', sans-serif;
  }
  .filter-pill:hover, .filter-pill.active {
    background: linear-gradient(135deg, #6366f1, #a855f7);
    border-color: transparent;
    color: #fff;
    box-shadow: 0 0 15px rgba(99,102,241,0.4);
  }
</style>

<main class="pt-24 pb-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

  <!-- Page header -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-10">
    <div>
      <h1 class="text-3xl sm:text-4xl font-black text-white mb-1">Explore <span class="text-gradient">AI Tools</span></h1>
      <p class="text-white/45 text-sm">Browse our curated collection of cutting-edge AI tools</p>
    </div>

    <!-- Search bar -->
    <div class="search-bar-tools">
      <svg class="w-4 h-4 text-white/40 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
      </svg>
      <input type="text" id="toolsSearch" placeholder="Search tools…"
             class="bg-transparent border-0 outline-none text-white text-sm placeholder-white/35 w-full font-sans">
    </div>
  </div>

  <!-- Category filter pills -->
  <div class="flex flex-wrap gap-2 mb-8" id="filter-pills">
    <button class="filter-pill active" data-filter="all">All Tools</button>
    <button class="filter-pill" data-filter="code">Code Assistant</button>
    <button class="filter-pill" data-filter="image">Image Generation</button>
    <button class="filter-pill" data-filter="data">Data Analysis</button>
    <button class="filter-pill" data-filter="writing">Writing & Content</button>
    <button class="filter-pill" data-filter="audio">Audio & Video</button>
    <button class="filter-pill" data-filter="agent">AI Agents</button>
  </div>

  <!-- Tools Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="tools-grid">

    <?php
    $tools = [
      ['DevMind AI',       'code',    'Code Assistant',    'An advanced coding companion that writes, debugs, and optimizes code in real-time across 40+ languages.', '★ ★ ★ ★ ☆', '4.8', 'Freemium', '🤖'],
      ['Visionary Studio', 'image',   'Image Generation',  'Create hyper-realistic images from text prompts using state-of-the-art diffusion models with fine-grained control.', '★ ★ ★ ★ ★', '5.0', 'Paid',     '🎨'],
      ['DataSense Pro',    'data',    'Data Analysis',     'Automatically clean, analyze, and visualize complex datasets in seconds using natural language queries.', '★ ★ ★ ★ ☆', '4.5', 'Free',     '📊'],
      ['WordForge AI',     'writing', 'Writing & Content', 'Generate long-form SEO articles, ad copy, and email sequences that match your brand voice perfectly.', '★ ★ ★ ★ ☆', '4.6', 'Freemium', '✍️'],
      ['SoundMind',        'audio',   'Audio & Video',     'AI-powered transcription, voice cloning, and podcast editing with studio-quality output in one click.', '★ ★ ★ ★ ★', '4.9', 'Freemium', '🎵'],
      ['AgentFlow',        'agent',   'AI Agents',         'Build and deploy autonomous AI agents that browse, reason, and execute multi-step tasks 24/7.', '★ ★ ★ ☆ ☆', '4.3', 'Paid',     '⚡'],
      ['PixelCraft AI',    'image',   'Image Generation',  'Transform sketches into photorealistic renders with AI-driven artistic style transfer and depth control.', '★ ★ ★ ★ ☆', '4.7', 'Paid',     '🖼️'],
      ['CodeReview Bot',   'code',    'Code Assistant',    'Automated code review that catches bugs, security issues, and anti-patterns before they hit production.', '★ ★ ★ ★ ★', '4.9', 'Freemium', '🔍'],
      ['NexusAgent',       'agent',   'AI Agents',         'Multi-modal AI agent platform with memory, tool use, and real-time web access for complex research tasks.', '★ ★ ★ ★ ☆', '4.6', 'Paid',     '🌐'],
    ];

    foreach ($tools as [$name, $cat, $label, $desc, $stars, $rating, $pricing, $icon]):
    ?>
    <div class="tool-card" data-category="<?= htmlspecialchars($cat) ?>" data-name="<?= strtolower(htmlspecialchars($name)) ?>">

      <!-- Top row: icon + badge -->
      <div class="flex items-start justify-between mb-4">
        <span class="text-2xl"><?= $icon ?></span>
        <span class="category-badge"><?= htmlspecialchars($label) ?></span>
      </div>

      <!-- Name & description -->
      <h3 class="text-lg font-bold text-white mb-2"><?= htmlspecialchars($name) ?></h3>
      <p class="text-white/45 text-sm leading-relaxed flex-1 mb-5"><?= htmlspecialchars($desc) ?></p>

      <!-- Footer row -->
      <div class="flex items-center justify-between mt-auto pt-4 border-t border-white/8">
        <div>
          <div class="rating-stars"><?= $stars ?></div>
          <div class="text-white/35 text-xs mt-0.5"><?= $rating ?> · <?= $pricing ?></div>
        </div>
        <button class="btn-glow px-4 py-2 rounded-xl text-xs font-bold relative z-10 tool-card-btn"
                data-category="<?= htmlspecialchars($cat) ?>">
          View Tool
        </button>
      </div>
    </div>
    <?php endforeach; ?>

  </div>
</main>

<script>
(function() {
  // ── Filter pills ─────────────────────────────────────────
  const pills = document.querySelectorAll('.filter-pill');
  const cards = document.querySelectorAll('.tool-card');

  pills.forEach(pill => {
    pill.addEventListener('click', () => {
      pills.forEach(p => p.classList.remove('active'));
      pill.classList.add('active');

      const filter = pill.dataset.filter;
      cards.forEach(card => {
        const show = filter === 'all' || card.dataset.category === filter;
        card.style.display = show ? '' : 'none';
      });
    });
  });

  // ── Search filter ────────────────────────────────────────
  document.getElementById('toolsSearch').addEventListener('input', function() {
    const q = this.value.toLowerCase();
    cards.forEach(card => {
      card.style.display = card.dataset.name.includes(q) ? '' : 'none';
    });
  });

  // ── 3D canvas reaction on card hover ─────────────────────
  const categoryColors = {
    code:    new THREE.Color(0x22d3ee),
    image:   new THREE.Color(0xa855f7),
    data:    new THREE.Color(0xf59e0b),
    writing: new THREE.Color(0x10b981),
    audio:   new THREE.Color(0xef4444),
    agent:   new THREE.Color(0x6366f1),
  };
  const defaultColor = new THREE.Color(0x6366f1);

  cards.forEach(card => {
    card.addEventListener('mouseenter', () => {
      if (!window.AAS3D) return;
      const cat = card.dataset.category;
      window.AAS3D.targetColor   = categoryColors[cat] || defaultColor;
      window.AAS3D.icoSpeed.x    = 0.012;
      window.AAS3D.icoSpeed.y    = 0.015;
      window.AAS3D.torusSpeed.x  = 0.014;
    });
    card.addEventListener('mouseleave', () => {
      if (!window.AAS3D) return;
      window.AAS3D.targetColor  = defaultColor;
      window.AAS3D.icoSpeed.x   = 0.003;
      window.AAS3D.icoSpeed.y   = 0.004;
      window.AAS3D.torusSpeed.x = 0.006;
    });
  });
})();
</script>

<?php include 'footer.php'; ?>
