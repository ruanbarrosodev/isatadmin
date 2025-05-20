<?php
function renderNav($nomeUsuario = 'Katiana Ferreira - Assistente Social', $cpfUsuario = '032.232.415-05') {
    echo '
    <header>
        <nav>
            <a href="' . BASE_URL . 'home"><p>ISAT - INICIO</p></a>

            <div>
                <span>' . htmlspecialchars($nomeUsuario) . '</span>
            </div>

            <div>
                <span>' . htmlspecialchars($cpfUsuario) . '</span>
            </div>

            <button id="switchColor"><p>SWITCH</p></button>

            <a href="' . BASE_URL . 'logout"><p>SAIR</p></a>
        </nav>
    </header>
    ';
}
