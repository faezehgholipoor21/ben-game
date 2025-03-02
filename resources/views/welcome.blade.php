<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منوی ریسپانسیو</title>
    <style>
        @font-face {
            font-family: 'MyFont';
            src: url('font/b_nazanin.TTF') format('truetype'),
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'MyFont', Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 2000px; /* اضافه شده برای تست اسکرول */
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
        }
        .menu {
            display: flex;
            direction:rtl;
            margin-right:35px;
        }
        .menu a {
            margin: 0 10px;
            border-radius: 10px;
            transition: background-color 0.3s ease-in-out; /* افکت نرم روی هاور */
        }
        .menu a:hover{
            border-radius: 10px;
            background-color: #605d5d;
        }
        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            margin-right:35px;
        }
        .menu-toggle div {
            width: 30px;
            height: 4px;
            background-color: white;
            margin: 5px 0;
        }
        .content {
            margin-top: 30px; /* فضای اضافی برای پایین نیفتادن محتوا */
            padding: 20px;
        }
        @media (max-width: 768px) {
            .menu {
                display: none;
                flex-direction: column;
                width: 100%;
                position: absolute;
                top: 50px;
                left: 0;
                background-color: #333;
            }
            .menu a {
                text-align: center;
                padding: 10px;
                display: block;
            }
            .menu-toggle {
                display: flex;
            }
            .menu.active {
                display: flex;
            }
            .content {
                margin-top: 30px; /* فضای اضافی برای پایین نیفتادن محتوا */
                padding: 20px;
            }
        }
    </style>
</head>
<body>
<nav class="navbar" id="navbar">
    <a href="#">لوگو</a>
    <div class="menu-toggle" onclick="toggleMenu()">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="menu" id="menu">
        <a href="#">خانه</a>
        <a href="#">درباره ما</a>
        <a href="#">خدمات</a>
        <a href="#">تماس</a>
    </div>
</nav>
<div class="content">
    <br>first_line_first_line_first_line_first_line_first_line_first_line_first_line<br>
    <br><br><br><br><br><br><br><br>
    second_line_second_line_second_line_second_line_second_line_second_line_second_line_ <br>
    <br><br><br><br><br><br><br><br>
    third_line_third_line_third_line_third_line_third_line_third_line_third_line_third_line_<br>
    <br><br><br><br><br><br><br><br>
    forth_line_forth_line_forth_line_forth_line_forth_line_forth_line_forth_line_forth_line_<br>
    <br><br><br><br><br><br><br><br>
    five_line_five_line_five_line_five_line_five_line_five_line_five_line_five_line_five_line_<br>
    <br><br><br><br><br><br><br><br>
    six_line_six_line_six_line_six_line_six_line_six_line_six_line_six_line_six_line_six_line_<br>
    <br><br><br><br><br><br><br><br>
</div>
<script>
    function toggleMenu() {
        var menu = document.getElementById("menu");
        menu.classList.toggle("active");
    }
</script>
</body>
</html>
