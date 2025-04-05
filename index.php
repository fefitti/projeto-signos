<?php include('layouts/header.php'); ?>
<body class="pagina-inicial">
    <div class="container text-center mt-5">
        <h1 class="text-white">Descubra seu Signo</h1>
        <form id="signo-form" method="POST" action="show_zodiac_sign.php" class="mt-4">
            <div class="mb-3">
                <label for="data_nascimento" class="form-label text-white">Data de Nascimento:</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
            </div>
            <button type="submit" class="btn btn-light">Consultar Signo</button>
        </form>
    </div>
</body>
</html>
