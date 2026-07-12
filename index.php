<?php include 'header.php'; ?>

<style>
    @keyframes antigravity {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-12px); }
        100% { transform: translateY(0px); }
    }
    
    .floating-element {
        animation: antigravity 4s ease-in-out infinite;
    }
    
    .title-gradient-home {
        background: linear-gradient(90deg, #60a5fa, #a78bfa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .search-glass-panel {
        background: rgba(15, 15, 25, 0.4);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.5);
        border-radius: 24px;
    }
    
    .search-input {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #ffffff;
    }
    
    .search-input:focus {
        background: rgba(255, 255, 255, 0.1);
        border-color: #a78bfa;
        color: #ffffff;
        box-shadow: 0 0 15px rgba(167, 139, 250, 0.3);
    }
    
    .search-input::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }
    
    .btn-gradient-home {
        background: linear-gradient(90deg, #6366f1, #8b5cf6);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }
    
    .btn-gradient-home:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.5);
        color: white;
    }
</style>

<div class="container mt-5 pt-5 d-flex flex-column align-items-center justify-content-center" style="min-height: 75vh;">
    <div class="text-center floating-element w-100" style="max-width: 800px;">
        <h1 class="display-4 fw-bolder title-gradient-home mb-3">AI Tool Recommendation Portal</h1>
        <p class="fs-5 mb-5 mx-auto" style="color: rgba(255, 255, 255, 0.7); max-width: 600px;">Discover, compare, and choose the best AI tools for your workflow.</p>
        
        <div class="search-glass-panel p-4 p-md-5 mx-auto">
            <form action="#" method="GET">
                <div class="mb-4 text-start">
                    <label for="searchInput" class="form-label text-white fw-semibold fs-5 mb-3">What do you need?</label>
                    <input type="text" id="searchInput" name="q" class="form-control form-control-lg rounded-pill search-input px-4 py-3" placeholder="e.g. Image generation, Data analysis, Code assistant...">
                </div>
                <div class="text-center mt-2">
                    <button type="submit" class="btn btn-gradient-home rounded-pill px-5 py-3 fs-5 fw-bold w-100">Search Tools</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>