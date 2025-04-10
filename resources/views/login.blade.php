<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - OJK</title>
  <style>
    /* Reset margin, padding, dan box-sizing */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background: url('{{ asset('img/bg1.jpeg') }}') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    /* Container utama (card) */
    .container {
      width: 1000px;
      background-color: #fff;
      display: flex;
      justify-content: flex-end;
      border-radius: 20px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    /* Gambar sisi kiri */
    .container img.side-image {
      width: 600px;
      object-fit: cover;
    }

    /* Bagian form login */
    .login-container {
      width: 400px;
      padding: 50px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      text-align: center;
      position: relative;
    }

    /* Logo desktop */
    .logo.desktop-logo {
      display: block;
      margin: 0 auto 20px auto;
      height: 75px;
      width: 75px;
    }

    /* Logo mobile */
    .logo.mobile-logo {
      display: none;
    }

    h2 {
      margin-bottom: 20px;
      color: #333;
    }

    label {
      display: block;
      text-align: left;
      margin: 10px 0 5px;
      font-weight: bold;
    }

    input {
      width: 100%;
      height: 35px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 10px;
      padding: 0 10px;
      font-size: 14px;
    }

    button {
      width: 100%;
      padding: 10px;
      background: #E50101;
      color: #fff;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      align-self: flex-start;
    }

    button:hover {
      background: #b40404;
    }

    /* Responsive Styles */
    @media screen and (max-width: 768px) {
      .container {
        width: 90%;
        flex-direction: column;
        border-radius: 20px;
      }

      .container img.side-image {
        width: 100%;
        height: auto;
        margin-bottom: -35px;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
      }

      .login-container {
        width: 100%;
        padding: 30px 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      .logo.desktop-logo {
        display: none;
      }

      .logo.mobile-logo {
        display: block;
        order: 2;
        margin: 25px auto 0 auto;
        height: 65px;
        width: 60px;
      }

      .login-container form {
        order: 1;
        width: 100%;
      }
    }

    @media screen and (max-width: 480px) {
      .login-container {
        padding: 30px 25px;
      }

      input {
        height: 40px;
      }

      button {
        padding: 12px;
        font-size: 18px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Gambar samping -->
    <img src="{{ asset('img/bglog.jpeg') }}" alt="Gambar Samping" class="side-image">

    <div class="login-container">
      <!-- Logo desktop -->
      <img src="{{ asset('img/logodzpl.png') }}" alt="Logo" class="logo desktop-logo">

      <!-- Form login -->
      <form action="{{ route('login') }}" method="POST">
        @csrf
        <label for="name">Username:</label>
        <input type="text" id="name" name="name" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
      </form>

      <!-- Logo mobile -->
      <img src="{{ asset('img/logodzpl.png') }}" alt="Logo" class="logo mobile-logo">
    </div>
  </div>
</body>
</html>