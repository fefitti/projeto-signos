<?php
function obterSigno($dataNascimento) {
    $signos = simplexml_load_file('signos.xml');
    $data = DateTime::createFromFormat('Y-m-d', $dataNascimento);
    if (!$data) return null;

    $dia = (int)$data->format('d');
    $mes = (int)$data->format('m');

    foreach ($signos->signo as $signo) {
        $inicio = explode('/', (string)$signo->data_inicio);
        $fim = explode('/', (string)$signo->data_fim);

        $inicioData = DateTime::createFromFormat('d/m', $inicio[0] . '/' . $inicio[1]);
        $fimData = DateTime::createFromFormat('d/m', $fim[0] . '/' . $fim[1]);

        $dataAtual = DateTime::createFromFormat('d/m', $dia . '/' . $mes);

        if ($inicioData <= $fimData) {
            if ($dataAtual >= $inicioData && $dataAtual <= $fimData) {
                return $signo;
            }
        } else {
            if ($dataAtual >= $inicioData || $dataAtual <= $fimData) {
                return $signo;
            }
        }
    }
    return null;
}

include('layouts/header.php');

$signoEncontrado = null;
$descricao = '';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["data_nascimento"])) {
    $signoXML = obterSigno($_POST["data_nascimento"]);
    if ($signoXML !== null) {
        $signoEncontrado = (string)$signoXML->nome;
        $descricao = (string)$signoXML->descricao;
    }
}
?>
<body class="<?php echo $signoEncontrado ? 'signo-' . strtolower($signoEncontrado) : ''; ?>">
    <div class="container text-center mt-5 text-white">
        <?php if ($signoEncontrado): ?>
            <h1>Seu signo é <?php echo $signoEncontrado; ?>!</h1>
            <p class="mt-4"><?php echo $descricao; ?></p>
        <?php else: ?>
            <h1>Data inválida ou signo não encontrado.</h1>
        <?php endif; ?>
        <a href="index.php" class="btn btn-light mt-4">Voltar</a>
    </div>
</body>
</html>

