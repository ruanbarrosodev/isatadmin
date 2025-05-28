<?php
    session_start();
    if (!isset($_SESSION['name'])) {
        header('Location: /'); 
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISAT - PAINEL</title>
    <link type="text/css" rel="stylesheet" href="/public/css/main.css">
    <link type="text/css" rel="stylesheet" href="/public/css/editarpaciente.css">
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.ico">
    <?php 
    require_once __DIR__ . '/../config/bootstrap.php';
    require_once __DIR__ . '/../utils/menu.php';
    require_once __DIR__ . '/../utils/nav.php';

    ?>
</head>
<body>
    <?php 
        renderNav("Katiana Ferreira", "041.525.525-04");
    ?>
<main>   
    <section class="main-body">
        <?php 
            renderMenu($menuItems, $currentUri);
        ?>
        <div class="content">
            <div class="container">
                <form id="multi-step-form">
                    <div class="form-step active">
                    <h2>Novo/Edição de Usuário</h2>
                    <div class="form-grid">
                        <div class="form-group">
                        <label>Nome Completo</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>RG</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>CPF</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>dsadas</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Phone 2</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Email</label>
                        <input type="email">
                        </div>
                        <div class="form-group">
                        <label>Home Value</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Current Loan Amount</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Employer</label>
                        <input type="text">
                        </div>
                    </div>
                    <div class="form-nav">
                        <div></div>
                        <button type="button" class="next">Next</button>
                    </div>
                    </div>

                    <div class="form-step">
                    <h2>Add a new lead - Step 2</h2>
                    <div class="form-grid">
                        <div class="form-group">
                        <label>Address</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>ZIP</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Income</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>SSN</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>City</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>State</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Property Type</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Current Loan Type</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Stage</label>
                        <input type="text">
                        </div>
                    </div>
                    <div class="form-nav">
                        <button type="button" class="prev">Back</button>
                        <button type="button" class="next">Next</button>
                    </div>
                    </div>

                    <div class="form-step">
                    <h2>Add a new lead - Step 3</h2>
                    <div class="form-grid">
                        <div class="form-group">
                        <label>Revenue</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Refinance Expectation</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Current Rate</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Credit Range</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Co-Borrower First Name</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Co-Borrower Last Name</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Closing Date</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>HOA Fee</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Description</label>
                        <textarea></textarea>
                        </div>
                    </div>
                    <div class="form-nav">
                        <button type="button" class="prev">Back</button>
                        <button type="submit">Submit</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
</body>
<script src="public/js/editarpaciente.js"></script>
<script src="public/js/main.js"></script>
</html>