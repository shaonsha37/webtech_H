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
        max-width: 500px;
        width: 100%;
    }
    
    .auth-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px 20px;
        text-align: center;
    }
    
    .auth-header h3 {
        margin: 0;
        font-weight: 600;
        font-size: 1.8rem;
    }
    
    .auth-header .subtitle {
        font-size: 0.9rem;
        opacity: 0.9;
        margin-top: 5px;
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
    
    .form-floating textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }
    
    .form-text {
        color: #6c757d;
        font-size: 0.85rem;
        margin-top: 5px;
        padding-left: 5px;
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
            <h3><i class="fas fa-user-plus me-2"></i>Join Us</h3>
            <div class="subtitle">Create your account</div>
        </div>
        <div class="auth-body">
            <form action="index.php?page=user&action=register" method="POST">
                <div class="form-floating">
                <label for="full_name"><i class="fas fa-user me-2"></i>Full Name</label> <br>   
                <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter your full name" required><br>
                </div>
                <div class="form-floating">
                <label for="email"><i class="fas fa-envelope me-2"></i>Email Address</label> <br>    
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required><br>
                </div>
                <div class="form-floating">
                <label for="password"><i class="fas fa-lock me-2"></i>Password</label> <br>    
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required><br>
                    <div class="form-text">
                        <i class="fas fa-info-circle me-1"></i>Password must be at least 6 characters long
                    </div>
                </div>
                <div class="form-floating">
                <label for="confirm_password"><i class="fas fa-lock me-2"></i>Confirm Password</label> <br>    
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required><br>
                </div>
                <div class="form-floating">
                <label for="address"><i class="fas fa-map-marker-alt me-2"></i>Address</label> <br>    
                <textarea class="form-control" id="address" name="address" placeholder="Enter your address" rows="3" required></textarea><br>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-auth">
                        <i class="fas fa-user-plus me-2"></i>Create Account
                    </button>
                </div>
            </form>
            <div class="auth-footer">
                <p class="mb-0">Already have an account? <a href="index.php?page=user&action=login">Sign in here</a></p>
            </div>
        </div>
    </div>
</div> 