<?php
function renderNav($nomeUsuario = 'Katiana Ferreira - Assistente Social', $cpfUsuario = '032.232.415-05') {
    echo '
    <header>
        <nav>
            <a href="' . BASE_URL . 'home"><p>ISAT - INICIO</p></a>

            <div>
                <span>' . htmlspecialchars($_SESSION['name']) . ' | '. htmlspecialchars($_SESSION['JobPosition']) . '</span>
            </div>

            <div>
                <span>' . htmlspecialchars($_SESSION['cpf']) . '</span>
            </div>

            <button id="switchColor"><p>SWITCH</p></button>

            <a href="' . BASE_URL . 'logout"><p>SAIR</p></a>
        </nav>
    </header>
    ';
}
