<x-guest-layout>
    <div class="auth-container">
        <!-- Session Status -->
        <x-auth-session-status class="status-alert" :status="session('status')" />

        <div class="auth-card">
            <h2 class="auth-title">Welcome Back</h2>
            <p class="auth-subtitle">Sign in to your account</p>

            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf

                <!-- Email -->
                <div class="input-group">
                    <label for="email" class="input-label">Email Address</label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus 
                        autocomplete="username"
                        class="form-input"
                        placeholder="you@example.com"
                    />
                    <x-input-error :messages="$errors->get('email')" class="error-msg" />
                </div>

                <!-- Password -->
                <div class="input-group">
                    <label for="password" class="input-label">Password</label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="current-password"
                        class="form-input"
                        placeholder="Enter your password"
                    />
                    <x-input-error :messages="$errors->get('password')" class="error-msg" />
                </div>

                <!-- Remember + Forgot -->
                <div class="form-options">
                    <label class="remember">
                        <input type="checkbox" name="remember" class="checkbox">
                        <span class="checkmark"></span>
                        <span class="label-text">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Submit -->
                <button type="submit" class="submit-btn">
                    <span>Sign In</span>
                    <div class="ripple"></div>
                </button>
            </form>
        </div>
    </div>

    <!-- ====================== PURE CSS (Wider + Clean) ====================== -->
    <style>
        :root {
            --bg: #0a0a0a;
            --card: #121212;
            --accent: #214ec9;
            --accent-hover: #1a3fa8;
            --text: #ffffff;
            --text-light: #e0e0e0;
            --text-muted: #999999;
            --border: #222222;
            --error: #ff5252;
            --success: #22c55e;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body, html { height: 100%; font-family: 'Inter', 'SF Pro', -apple-system, sans-serif; background: var(--bg); color: var(--text); }

        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            position: relative;
        }

        /* Subtle glow background */
        .auth-container::before {
            content: '';
            position: absolute;
            width: 700px; height: 700px;
            background: radial-gradient(circle, var(--accent) 0%, transparent 65%);
            border-radius: 50%;
            filter: blur(140px);
            opacity: 0.08;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            z-index: 0;
        }

        /* Status */
        .status-alert {
            position: absolute;
            top: 1.5rem; left: 50%; transform: translateX(-50%);
            background: rgba(34, 197, 94, 0.15);
            color: var(--success);
            padding: 0.75rem 1.75rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            backdrop-filter: blur(12px);
            border: 1px solid rgba(34, 197, 94, 0.3);
            z-index: 10;
            animation: fadeDown 0.4s ease-out;
        }

        @keyframes fadeDown {
            from { opacity: 0; transform: translateX(-50%) translateY(-12px); }
            to { opacity: 1; transform: translateX(-50%) translateY(0); }
        }

        /* CARD – WIDER & BALANCED */
.auth-card {
    width: 100%;
    max-width: 500px;
    background: var(--card);
    border-radius: 2rem;
    padding: 2.75rem 3rem;
    box-shadow:
        0 30px 60px rgba(0, 0, 0, 0.5),
        0 0 0 1px rgba(255, 255, 255, 0.06);
    position: relative;
    z-index: 1;
    border: 1px solid var(--border);
}

        .auth-title {
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #ffffff, #bbbbbb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .auth-subtitle {
            font-size: 1rem;
            color: var(--text-muted);
            text-align: center;
            margin-bottom: 2.5rem;
        }

        /* Input Group */
        .input-group {
            margin-bottom: 1.75rem;
        }

        .input-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-light);
            margin-bottom: 0.6rem;
        }

        .form-input {
            width: 100%;
            padding: 1.1rem 1.25rem;
            background: rgba(255, 255, 255, 0.06);
            border: 1.5px solid rgba(255, 255, 255, 0.12);
            border-radius: 1.25rem;
            color: var(--text);
            font-size: 1rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(8px);
        }

        .form-input::placeholder {
            color: var(--text-muted);
            opacity: 0.7;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--accent);
            background: rgba(33, 78, 201, 0.12);
            box-shadow: 0 0 0 4px rgba(33, 78, 201, 0.18);
        }

        .error-msg {
            color: var(--error);
            font-size: 0.8rem;
            margin-top: 0.5rem;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .error-msg[data-error] {
            opacity: 1;
        }

        /* Options Row */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1.75rem 0 2.25rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .remember {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .checkbox {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .checkmark {
            width: 21px;
            height: 21px;
            background: rgba(255, 255, 255, 0.08);
            border: 1.6px solid rgba(255, 255, 255, 0.22);
            border-radius: 7px;
            margin-right: 0.8rem;
            position: relative;
            transition: all 0.3s ease;
        }

        .checkbox:checked ~ .checkmark {
            background: var(--accent);
            border-color: var(--accent);
            box-shadow: 0 0 12px rgba(33, 78, 201, 0.35);
        }

        .checkmark::after {
            content: '';
            position: absolute;
            display: none;
            left: 6.5px; top: 2.5px;
            width: 5.5px; height: 11px;
            border: solid white;
            border-width: 0 2.2px 2.2px 0;
            transform: rotate(45deg);
        }

        .checkbox:checked ~ .checkmark::after {
            display: block;
        }

        .label-text {
            transition: color 0.3s;
        }

        .remember:hover .label-text {
            color: var(--text);
        }

        .forgot-link {
            font-size: 0.9rem;
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.3s;
        }

        .forgot-link:hover {
            color: var(--accent);
        }

        /* Submit Button */
        .submit-btn {
            position: relative;
            width: 100%;
            padding: 1.1rem;
            background: var(--accent);
            border: none;
            border-radius: 1.5rem;
            color: white;
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            overflow: hidden;
            transition: all 0.4s ease;
            box-shadow: 0 10px 24px rgba(33, 78, 201, 0.35);
        }

        .submit-btn:hover {
            background: var(--accent-hover);
            transform: translateY(-3px);
            box-shadow: 0 16px 32px rgba(33, 78, 201, 0.45);
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        .ripple {
            position: absolute;
            inset: 0;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 10%, transparent 10%);
            background-size: 1000% 1000%;
            opacity: 0;
            transition: opacity 0.4s;
        }

        .submit-btn:hover .ripple {
            opacity: 1;
            background-position: 50% 50%;
            animation: ripple 1.2s ease-out;
        }

        @keyframes ripple {
            0% { background-size: 1000% 1000%; }
            100% { background-size: 0% 0%; }
        }

        /* Responsive */
        @media (max-width: 600px) {
            .auth-card {
                padding: 2.5rem 2.5rem;
                border-radius: 1.75rem;
                max-width: 100%;
            }
            .form-options {
                flex-direction: column;
                align-items: flex-start;
            }
            .auth-title { font-size: 1.75rem; }
        }
    </style>

    <!-- Show errors if exist -->
    <script>
        document.querySelectorAll('.error-msg').forEach(el => {
            if (el.innerText.trim()) el.setAttribute('data-error', 'true');
        });
    </script>
</x-guest-layout>