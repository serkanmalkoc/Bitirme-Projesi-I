<style>
header {
            background-color: #14171C;
            color: white;
            padding: 0px 0;
            text-align: center;
        }
        header h1 {
            color: #fff;
            text-align: left;
            padding-left: 20px; /* Sol taraftan biraz boşluk ekleyebilirsin */
            font-family: 'Sharp Grotesk SmBold 20 Regular', sans-serif; /* Fontu kullan */
            padding-right: 50px;
        }
        header nav ul {
            list-style: none;
            padding: 0;
            text-align: center;
            font-family: 'Sharp Grotesk SmBold 20 Regular', sans-serif; /* Fontu kullan */
        }
        header nav ul li {
            display: inline;
            margin-right: 15px;
        }
        header nav ul li a {
            color: #556678;   
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s; /* Geçiş efekti */
        }
        header nav ul li a:hover {
            color: #fff; /* Üzerine gelindiğinde beyaz renk */
        }
        /* Giriş Modalı */
        .modal {
            position: fixed;
            z-index: 1;
            left: 50;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            display: none;
        }
        /* İçerik kısmı */
        .modal-content {
            background-color: #1c1e22;
            color: #f5f5f5;
            margin: 10% auto;
            padding: 20px;
            border: none;
            border-radius: 8px;
            width: 350px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        /* Modal Kapatma Butonu */
        .close {
            color: #888;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover, .close:focus {
            color: #bbb;
            cursor: pointer;
        }
		 input[type="ara"] {
            border: 1px solid #556678; /* Kenar rengi */
            border-radius: 30px; /* Kenar yuvarlama */
            padding: 5px; /* İç boşluk */
            width: 200px; /* Genişlik */
            display: inline-block; /* Inline blok */
        }
		</style>
		<body>
		<div class="container">
        <header>
        <div style="display: flex; align-items: center;">
        <!-- <img src="logo/logo0.png" alt="Sinema Logo" style="width: 50px; height: auto; margin-right: 0px;"> -->
        <h1><a href="index.php" style="color: white; text-decoration: none;">Sinema Arşivi</a></h1>
            <nav>
                <ul>
                    <?php if (isset($_SESSION['username'])): ?>
                    <!-- Kullanıcı giriş yaptıysa çıkış butonu göster -->
                    <li><a href="cikis.php" class="button">ÇIKIŞ YAP</a></li>
                    <?php else: ?>
                    <li><a href="#" id="loginBtn" class="button">GİRİŞ YAP</a></li>
                    <li><a href="#" id="registerBtn" class="button">KAYIT OL</a></li> 
                    <?php endif; ?>
                    <li><a href="filmler.php">FİLMLER</a></li>
                    <li><a href="film_ekle.php">EKLE</a></li>
                </ul>
            </nav>

                    <!-- Film Arama Formu -->
        <form method="GET" action="film_ara.php" style="display: inline; float: right; margin-left: 20px;">
            <input type="ara" name="query" required style="padding: 5px;">
            <button type="submit" style="background: none; border: none; cursor: pointer; padding: 0; margin-left: -30px;">
            </button>
        </form>
        </header>
        </div>
		</body>