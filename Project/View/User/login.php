<style>
    .auth-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    
    .auth-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: none;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 400px;
        width: 100%;
    }
    
    .auth-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px 20px;
        text-align: center;
        position: relative;
    }
    
    .auth-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    }
    
    .auth-header h3 {
        margin: 0;
        font-weight: 600;
        font-size: 1.8rem;
        position: relative;
        z-index: 1;
    }
    
    .auth-header .subtitle {
        font-size: 0.9rem;
        opacity: 0.9;
        margin-top: 5px;
        position: relative;
        z-index: 1;
    }
    
    .auth-body {
        padding: 40px 30px;
    }
    
    .form-floating {
        margin-bottom: 20px;
    }
    
    .form-floating .form-control {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 15px 20px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }
    
    .form-floating .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        background: white;
    }
    
    .form-floating label {
        padding: 15px 20px;
        color: #6c757d;
        font-weight: 500;
    }
    
    .btn-auth {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        padding: 15px;
        font-weight: 600;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn-auth::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    
    .btn-auth:hover::before {
        left: 100%;
    }
    
    .btn-auth:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }
    
    .auth-footer {
        text-align: center;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
    }
    
    .auth-footer a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }
    
    .auth-footer a:hover {
        color: #764ba2;
    }
    
    .input-group-text {
        background: transparent;
        border: 2px solid #e9ecef;
        border-right: none;
        border-radius: 12px 0 0 12px;
        color: #6c757d;
    }
    
    .input-group .form-control {
        border-left: none;
        border-radius: 0 12px 12px 0;
    }
    
    .input-group .form-control:focus + .input-group-text {
        border-color: #667eea;
    }
    
    @media (max-width: 576px) {
        .auth-container {
            padding: 10px;
        }
        
        .auth-body {
            padding: 30px 20px;
        }
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h3><i class="fas fa-sign-in-alt me-2"></i>Welcome Back</h3>
            <div class="subtitle">Sign in to your account</div>
        </div>
        <div class="auth-body">
            <form action="index.php?page=user&action=login" method="POST">
                <div class="form-floating">
                <label for="email"><i class="fas fa-envelope me-2"></i>Email Address</label>    
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required><br>
                </div>
                <div class="form-floating">
                <label for="password"><i class="fas fa-lock me-2"></i>Password</label>    
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required><br>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-auth">
                        <i class="fas fa-sign-in-alt me-2"></i>Sign In
                    </button>
                </div>
            </form>
            <div class="auth-footer">
                <p class="mb-0">Don't have an account? <a href="index.php?page=user&action=register">Create one here</a></p>
            </div>
        </div>
    </div>
</div> 