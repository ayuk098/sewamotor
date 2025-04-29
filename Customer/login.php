<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f5f5;
    }
    .login-card {
    border-radius: 15px;
    padding: 2rem;
    position: relative;
    background-color: white;
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    z-index: 1;
    border: 1.5px solid  #0a3b7e;
  }
  .login-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(to right, #0F4181, #0dcaf0);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: -40px;
    left: 50%;
    transform: translateX(-50%);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    z-index: 10;
  }
    .login-icon img {
      width: 40px;
      height: 40px;
    }
    .login-button {
      width: 100%;
      padding: 0.5rem;
      border: none;
      background: none;
      color: #0F4181;
      font-weight: 500;
      box-shadow: 0 -8px 20px rgba(0,0,0,0.1);
      border-bottom-left-radius: 40px;
      border-bottom-right-radius: 40px;
      border: 1.5px solid  #0a3b7e;
    }
    
    .form-control {
      border: 1.5px solid  #0a3b7e;
    }
  </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="position-relative" style="width: 100%; max-width: 400px;">
    
    <div class="login-icon">
      <img src="https://cdn-icons-png.flaticon.com/512/747/747376.png" alt="icon">
    </div>
    
    <div class="login-card text-center pt-5">
      <form>
        <div class="mb-3 text-start">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" placeholder="Masukkan email">
        </div>
        <div class="mb-3 text-start">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Masukkan password">
        </div>
      </form>
    </div>

    <button class="login-button">Login</button>
    
  </div>
</div>

</body>
</html>
