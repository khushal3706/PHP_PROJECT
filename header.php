<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Tool Recommendation Portal — 3D Spatial Edition</title>
    <meta name="description" content="Discover, compare, and choose the best AI tools for your workflow. A premium 3D AI tool recommendation portal.">

    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: { sans: ['Inter', 'sans-serif'] },
            animation: {
              'float': 'float 6s ease-in-out infinite',
              'pulse-glow': 'pulseGlow 3s ease-in-out infinite',
            },
            keyframes: {
              float: { '0%,100%': { transform: 'translateY(0px)' }, '50%': { transform: 'translateY(-10px)' } },
              pulseGlow: { '0%,100%': { opacity: '0.6' }, '50%': { opacity: '1' } },
            }
          }
        }
      }
    </script>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Three.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>

    <style>
      *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
      html { scroll-behavior: smooth; }

      body {
        font-family: 'Inter', sans-serif;
        background: #020617;
        color: #f1f5f9;
        min-height: 100vh;
        overflow-x: hidden;
      }

      /* Fixed 3D canvas behind everything */
      #bg-canvas {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        z-index: -1;
        display: block;
      }

      /* Shared glass utilities */
      .glass {
        background: rgba(255,255,255,0.04);
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
        border: 1px solid rgba(255,255,255,0.09);
      }

      .glass-deep {
        background: rgba(2, 6, 23, 0.55);
        backdrop-filter: blur(32px) saturate(200%);
        -webkit-backdrop-filter: blur(32px) saturate(200%);
        border: 1px solid rgba(255,255,255,0.08);
      }

      /* Gradient text */
      .text-gradient {
        background: linear-gradient(135deg, #22d3ee, #a855f7, #ec4899);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
      }

      .text-gradient-cyan {
        background: linear-gradient(90deg, #22d3ee, #818cf8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
      }

      /* Glow button */
      .btn-glow {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border: none;
        color: white;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
      }
      .btn-glow::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #818cf8, #a78bfa);
        opacity: 0;
        transition: opacity 0.3s;
      }
      .btn-glow:hover::before { opacity: 1; }
      .btn-glow:hover { box-shadow: 0 0 30px rgba(139,92,246,0.6), 0 0 60px rgba(139,92,246,0.2); transform: translateY(-2px); }

      /* Form inputs glass style */
      .glass-input {
        background: rgba(255,255,255,0.03) !important;
        border: 1px solid rgba(255,255,255,0.12) !important;
        color: #fff !important;
        transition: all 0.3s ease;
        border-radius: 12px;
        padding: 14px 18px;
        width: 100%;
        outline: none;
        font-size: 1rem;
        font-family: 'Inter', sans-serif;
      }
      .glass-input::placeholder { color: rgba(255,255,255,0.35); }
      .glass-input:focus {
        background: rgba(255,255,255,0.07) !important;
        border-color: rgba(99,102,241,0.7) !important;
        box-shadow: 0 0 0 3px rgba(99,102,241,0.15), 0 0 20px rgba(99,102,241,0.25) !important;
      }

      /* Scrollbar */
      ::-webkit-scrollbar { width: 6px; }
      ::-webkit-scrollbar-track { background: transparent; }
      ::-webkit-scrollbar-thumb { background: rgba(139,92,246,0.4); border-radius: 999px; }
    </style>
</head>
<body>

<!-- ═══════════════════════════════════════════════ -->
<!-- PHASE 1: THREE.JS 3D BACKGROUND CANVAS         -->
<!-- ═══════════════════════════════════════════════ -->
<canvas id="bg-canvas"></canvas>

<script>
(function() {
  'use strict';

  // ── Scene Setup ──────────────────────────────────────────────
  const canvas  = document.getElementById('bg-canvas');
  const scene   = new THREE.Scene();
  const camera  = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 1000);
  const renderer = new THREE.WebGLRenderer({ canvas, antialias: true, alpha: true });

  renderer.setSize(window.innerWidth, window.innerHeight);
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
  renderer.setClearColor(0x020617, 1);

  camera.position.set(0, 0, 5);

  // ── Lights ───────────────────────────────────────────────────
  const ambientLight = new THREE.AmbientLight(0x1e1b4b, 2);
  scene.add(ambientLight);

  const pointLight1 = new THREE.PointLight(0x6366f1, 6, 20);
  pointLight1.position.set(3, 4, 3);
  scene.add(pointLight1);

  const pointLight2 = new THREE.PointLight(0x22d3ee, 5, 20);
  pointLight2.position.set(-4, -3, 2);
  scene.add(pointLight2);

  const pointLight3 = new THREE.PointLight(0xa855f7, 4, 15);
  pointLight3.position.set(0, 6, -4);
  scene.add(pointLight3);

  // ── Particle Field ────────────────────────────────────────────
  const particleCount = 1800;
  const positions = new Float32Array(particleCount * 3);
  for (let i = 0; i < particleCount * 3; i++) {
    positions[i] = (Math.random() - 0.5) * 40;
  }
  const particleGeo = new THREE.BufferGeometry();
  particleGeo.setAttribute('position', new THREE.BufferAttribute(positions, 3));
  const particleMat = new THREE.PointsMaterial({
    color: 0x6366f1,
    size: 0.06,
    transparent: true,
    opacity: 0.55,
    sizeAttenuation: true
  });
  const particles = new THREE.Points(particleGeo, particleMat);
  scene.add(particles);

  // ── Primary Icosahedron (wireframe) ───────────────────────────
  const icoGeo  = new THREE.IcosahedronGeometry(1.6, 1);
  const icoMat  = new THREE.MeshPhongMaterial({
    color: 0x6366f1,
    emissive: 0x1e1b4b,
    wireframe: true,
    transparent: true,
    opacity: 0.55,
  });
  const icosahedron = new THREE.Mesh(icoGeo, icoMat);
  icosahedron.position.set(2.5, 0.5, -2);
  scene.add(icosahedron);

  // ── Secondary Octahedron (wireframe) ──────────────────────────
  const octGeo = new THREE.OctahedronGeometry(1.1, 0);
  const octMat = new THREE.MeshPhongMaterial({
    color: 0x22d3ee,
    wireframe: true,
    transparent: true,
    opacity: 0.4,
  });
  const octahedron = new THREE.Mesh(octGeo, octMat);
  octahedron.position.set(-3, -1, -3);
  scene.add(octahedron);

  // ── Torus Knot (solid glow) ────────────────────────────────────
  const torusGeo = new THREE.TorusKnotGeometry(0.7, 0.22, 100, 16);
  const torusMat = new THREE.MeshPhongMaterial({
    color: 0xa855f7,
    emissive: 0x4c1d95,
    transparent: true,
    opacity: 0.75,
    shininess: 120,
  });
  const torusKnot = new THREE.Mesh(torusGeo, torusMat);
  torusKnot.position.set(-1.8, 1.5, -4);
  scene.add(torusKnot);

  // ── Global state exposed so page scripts can interact ──────────
  window.AAS3D = {
    scene, camera, renderer,
    icosahedron, octahedron, torusKnot, particles,
    pointLight1, pointLight2,
    // Tweakable speeds
    icoSpeed:    { x: 0.003, y: 0.004 },
    octSpeed:    { x: -0.005, y: 0.003 },
    torusSpeed:  { x: 0.006, y: -0.004 },
    particleOpacity: 0.55,
    targetColor: new THREE.Color(0x6366f1),
  };

  // ── Resize ────────────────────────────────────────────────────
  window.addEventListener('resize', () => {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
  });

  // ── Mouse parallax ────────────────────────────────────────────
  let mouseX = 0, mouseY = 0;
  document.addEventListener('mousemove', e => {
    mouseX = (e.clientX / window.innerWidth  - 0.5) * 0.8;
    mouseY = (e.clientY / window.innerHeight - 0.5) * 0.8;
  });

  // ── Animation Loop ────────────────────────────────────────────
  const clock = new THREE.Clock();
  function animate() {
    requestAnimationFrame(animate);
    const t = clock.getElapsedTime();
    const a = window.AAS3D;

    icosahedron.rotation.x += a.icoSpeed.x;
    icosahedron.rotation.y += a.icoSpeed.y;

    octahedron.rotation.x += a.octSpeed.x;
    octahedron.rotation.y += a.octSpeed.y;

    torusKnot.rotation.x += a.torusSpeed.x;
    torusKnot.rotation.y += a.torusSpeed.y;

    particles.rotation.y  = t * 0.04;
    particles.rotation.x  = Math.sin(t * 0.02) * 0.1;

    // Pulse lights
    pointLight1.intensity = 5 + Math.sin(t * 1.5) * 1.5;
    pointLight2.intensity = 4 + Math.cos(t * 1.2) * 1.5;

    // Gentle camera parallax
    camera.position.x += (mouseX * 0.4 - camera.position.x) * 0.04;
    camera.position.y += (-mouseY * 0.4 - camera.position.y) * 0.04;
    camera.lookAt(scene.position);

    // Lerp primary material color
    if (icoMat.color) icoMat.color.lerp(a.targetColor, 0.02);

    renderer.render(scene, camera);
  }
  animate();
})();
</script>

<!-- ═══════════════════════════════════════════════ -->
<!-- PHASE 1: NAVIGATION BAR (over 3D canvas)        -->
<!-- ═══════════════════════════════════════════════ -->
<nav class="fixed top-0 w-full z-50 backdrop-blur-md bg-black/20 border-b border-white/5" id="main-nav">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">

      <!-- Brand -->
      <a href="index.php" class="flex items-center gap-2 no-underline" id="nav-brand">
        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-cyan-400 to-purple-500 flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-purple-500/30">
          AI
        </div>
        <span class="text-white font-bold text-lg tracking-tight text-gradient">AI Portal</span>
      </a>

      <!-- Desktop links -->
      <div class="hidden md:flex items-center gap-1">
        <a href="index.php"       class="text-white/70 hover:text-white px-4 py-2 rounded-lg hover:bg-white/8 transition-all duration-200 text-sm font-medium no-underline">Home</a>
        <a href="tools.php"       class="text-white/70 hover:text-white px-4 py-2 rounded-lg hover:bg-white/8 transition-all duration-200 text-sm font-medium no-underline">Tools</a>
        <a href="login.php"       class="text-white/70 hover:text-white px-4 py-2 rounded-lg hover:bg-white/8 transition-all duration-200 text-sm font-medium no-underline">Login</a>
        <a href="register.php"    class="btn-glow ml-2 px-5 py-2 rounded-xl text-sm font-semibold no-underline relative z-10">Get Started</a>
      </div>

      <!-- Mobile hamburger -->
      <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg text-white/70 hover:text-white hover:bg-white/10 transition-all">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>

    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden md:hidden pb-3 border-t border-white/10 mt-1">
      <div class="flex flex-col gap-1 pt-3">
        <a href="index.php"    class="text-white/70 hover:text-white px-4 py-2 rounded-lg hover:bg-white/8 transition-all text-sm font-medium no-underline">Home</a>
        <a href="tools.php"    class="text-white/70 hover:text-white px-4 py-2 rounded-lg hover:bg-white/8 transition-all text-sm font-medium no-underline">Tools</a>
        <a href="login.php"    class="text-white/70 hover:text-white px-4 py-2 rounded-lg hover:bg-white/8 transition-all text-sm font-medium no-underline">Login</a>
        <a href="register.php" class="btn-glow px-5 py-2 rounded-xl text-sm font-semibold text-center no-underline relative z-10 mt-1">Get Started</a>
      </div>
    </div>
  </div>
</nav>

<script>
  document.getElementById('mobile-menu-btn').addEventListener('click', () => {
    document.getElementById('mobile-menu').classList.toggle('hidden');
  });
</script>