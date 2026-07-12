<?php include 'header.php'; ?>

<style>
    .tool-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 16px;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease;
    }
    
    .tool-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4), 0 0 20px rgba(99, 102, 241, 0.2);
    }
    
    .category-badge {
        background: linear-gradient(135deg, #ec4899, #8b5cf6);
        border: none;
    }
</style>

<div class="container mt-5 pt-4">
    <!-- Header & Filter Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5">
        <h2 class="fw-bold mb-3 mb-md-0">Explore AI Tools</h2>
        
        <div class="glass-panel px-3 py-2" style="border-radius: 12px; min-width: 300px;">
            <div class="input-group">
                <span class="input-group-text bg-transparent border-0 text-white"><i class="bi bi-search">🔍</i></span>
                <input type="text" class="form-control bg-transparent border-0 text-white shadow-none" placeholder="Search or filter...">
            </div>
        </div>
    </div>

    <!-- Tools Grid -->
    <div class="row g-4 mb-5">
        <!-- Placeholder Tool Card -->
        <div class="col-md-4">
            <div class="tool-card p-4 h-100 d-flex flex-column">
                <div class="mb-3">
                    <span class="badge category-badge px-3 py-2 rounded-pill">Code Assistant</span>
                </div>
                <h4 class="fw-bold mb-2">DevMind AI</h4>
                <p class="text-secondary small mb-4 flex-grow-1">An advanced coding assistant that helps you write, debug, and optimize your code in real-time across multiple languages.</p>
                
                <div class="d-flex align-items-center justify-content-between mt-auto">
                    <div class="text-warning small">
                        ★ ★ ★ ★ ☆ <span class="text-secondary ms-1">(4.8)</span>
                    </div>
                    <a href="#" class="btn btn-sm btn-glow rounded-pill px-4 py-2 fw-semibold text-decoration-none">View Tool</a>
                </div>
            </div>
        </div>
        
        <!-- Tool Card 2 -->
        <div class="col-md-4">
            <div class="tool-card p-4 h-100 d-flex flex-column">
                <div class="mb-3">
                    <span class="badge category-badge px-3 py-2 rounded-pill" style="background: linear-gradient(135deg, #10b981, #3b82f6);">Image Generation</span>
                </div>
                <h4 class="fw-bold mb-2">Visionary Studio</h4>
                <p class="text-secondary small mb-4 flex-grow-1">Create stunning, hyper-realistic images from text prompts with our state-of-the-art diffusion model.</p>
                
                <div class="d-flex align-items-center justify-content-between mt-auto">
                    <div class="text-warning small">
                        ★ ★ ★ ★ ★ <span class="text-secondary ms-1">(5.0)</span>
                    </div>
                    <a href="#" class="btn btn-sm btn-glow rounded-pill px-4 py-2 fw-semibold text-decoration-none">View Tool</a>
                </div>
            </div>
        </div>
        
        <!-- Tool Card 3 -->
        <div class="col-md-4">
            <div class="tool-card p-4 h-100 d-flex flex-column">
                <div class="mb-3">
                    <span class="badge category-badge px-3 py-2 rounded-pill" style="background: linear-gradient(135deg, #f59e0b, #ef4444);">Data Analysis</span>
                </div>
                <h4 class="fw-bold mb-2">DataSense Pro</h4>
                <p class="text-secondary small mb-4 flex-grow-1">Automatically clean, analyze, and visualize complex datasets in seconds using natural language queries.</p>
                
                <div class="d-flex align-items-center justify-content-between mt-auto">
                    <div class="text-warning small">
                        ★ ★ ★ ★ ☆ <span class="text-secondary ms-1">(4.5)</span>
                    </div>
                    <a href="#" class="btn btn-sm btn-glow rounded-pill px-4 py-2 fw-semibold text-decoration-none">View Tool</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
