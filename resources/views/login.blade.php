<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #ED3237, #CFD1CF);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            display: flex;
            justify-content: flex-end;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 900px;
        }

        .login-container {
            padding: 20px;
            text-align: center;
            width: 244px;
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
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #2575fc;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #6a11cb;
        }
        img{
            width: 616px;
            border-radius: 10px 70px 70px 10px;
        }
        .logo{
            height: 75px;
            width: 70px;
            border-radius: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="{{ asset('img/ojk.jpg') }}" alt="">
        <div class="login-container">
            <img src="{{ asset('img/logodzpl.png') }}" alt="" class="logo">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <label for="name">Username:</label>
                <input type="text" id="name" name="name" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>

</html>